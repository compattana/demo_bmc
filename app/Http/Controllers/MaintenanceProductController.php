<?php

namespace App\Http\Controllers;

use App\Models\AgreementItem;
use App\Models\MaintenanceSchedule;
use App\Models\ProductSerial;
use App\Models\TechnicianReport;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class MaintenanceProductController extends Controller
{

    public function index(MaintenanceSchedule $maintenance, Request $request)
    {

        if ($request->ajax()) {
            $data = TechnicianReport::where('maintenance_schedule_id', $maintenance->id);
            return DataTables::eloquent($data)
                ->addIndexColumn()
                ->addColumn('date_format', function (TechnicianReport $technicianReport) {
                    return Carbon::createFromFormat('Y-m-d', $technicianReport->date)->translatedFormat('d F Y');
                })
                ->addColumn('product_format', function (TechnicianReport $technicianReport) {
                    return 'สินค้า ' . $technicianReport->agreementItem->product->title . ' / หมายเลขเครื่อง ' . $technicianReport->agreementItem->productSerial->serial_name;
                })
                ->addColumn('status_format', function (TechnicianReport $technicianReport) {
                    if ($technicianReport->status == TechnicianReport::STATUS_FINISHED) {
                        return '<span class="badge badge-success">งานเรียบร้อย</span>';
                    } else  return '<span class="badge badge-warning">งานยังไม่เรียบร้อย</span>';
                })
                ->addColumn('status_lead_check_format', function (TechnicianReport $technicianReport) {
                    if ($technicianReport->status_report == TechnicianReport::STATUS_REPORT_NO_APPROVE) {
                        return '<span class="badge badge-warning">หัวหน้างานยังไม่ตรวจสอบ</span>';
                    } elseif ($technicianReport->status_report == TechnicianReport::STATUS_REPORT_APPROVE) {
                        return '<span class="badge badge-success">หัวหน้างานตรวจสอบแล้ว</span>';
                    } elseif ($technicianReport->status_report == TechnicianReport::STATUS_REPORT_IN_PROGRESS) {
                        return '<span class="badge badge-secondary">รอดำเนินการ</span>';
                    } elseif ($technicianReport->status_report == TechnicianReport::STATUS_REPORT_WARRANTY) {
                        return '<span class="badge badge-success" style="background-color: #7A316F">Warranty</span>';
                    } elseif ($technicianReport->status_report == TechnicianReport::STATUS_REPORT_WAIT_PRICE) {
                        return '<span class="badge badge-success" style="background-color: #6C3428">รอเสนอราคา</span>';
                    } elseif ($technicianReport->status_report == TechnicianReport::STATUS_REPORT_REWORK) {
                        return '<span class="badge badge-success" style="background-color: #557A46">Rework</span>';
                    } elseif ($technicianReport->status_report == TechnicianReport::STATUS_REPORT_JOB_CLOSE) {
                        return '<span class="badge badge-success">Job Close</span>';
                    } elseif ($technicianReport->status_report == TechnicianReport::STATUS_REPORT_OTHER) {
                        return '<span class="badge badge-success" style="background-color: #6527BE">อื่นๆ</span>';
                    } else return '';
                })
                ->addColumn('action', function (TechnicianReport $technicianReport) use ($request) {
                    $edit = '<a class="btn btn-default bg-white btn-xs" href="' . route('maintenances.product.pm.edit', ['maintenance' => $technicianReport->maintenance_schedule_id, 'product' => $technicianReport->agreement_item_id, 'pm' => $technicianReport->id]) . '"><i class="fa-duotone fa-eye text-primary"></i> ตรวจสอบงาน</a>';
                    $show = '<a class="btn btn-default bg-white btn-xs" href="' . route('maintenance_reports.show', ['maintenance_report' => $technicianReport->id, 'type' => $request->get('type')]) . '"><i class="fa-duotone fa-eye text-primary"></i> ตรวจสอบงาน</a>';

                    $delete = '<button class=
                    "btn btn-default bg-white btn-xs " onclick="deleteConfirmation(' . $technicianReport->id . ');"><i class="fas fa-fw fa-trash text-danger"></i> ลบ</button>';
                    return $edit . ' ' . $delete;
                })
                ->rawColumns(['technician_format', 'date_format', 'product_format', 'status_format', 'status_lead_check_format', 'action'])
                ->make(true);
        }

        $agreement_items = AgreementItem::query()->has('productSerial')->where('agreement_id', $maintenance->agreement_id)->get();

        $technicians = User::query()->role(User::ROLE_TECHNICIAN)->get();
        return view('maintenance.pm.show', compact('maintenance', 'agreement_items', 'technicians'));
    }

    public function destroy(MaintenanceSchedule $maintenance, TechnicianReport $product, Request $request)
    {
        $status = false;
        $message = 'ไม่สามารถลบข้อมูลได้';
        if ($product->delete()) {
            $status = true;
            $message = 'ลบข้อมูลเรียบร้อยแล้ว';
        }
        if ($request->ajax()) {
            return response()->json(['status' => $status, 'message' => $message]);
        } else {
            alert()->success('สำเร็จ', 'ลบข้อมูลเรียบร้อยแล้ว')->autoClose(0)->animation(false, false);
            return redirect()->route('maintenances.product.index', ['maintenance' => $maintenance->id]);
        }
    }
}
