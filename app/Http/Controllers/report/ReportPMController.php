<?php

namespace App\Http\Controllers\report;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\MaintenanceSchedule;
use App\Models\ScheduleOther;
use App\Models\Technician;
use App\Models\TechnicianPm;
use App\Models\TechnicianReport;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ReportPMController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $customers = Customer::query()->where('status', Customer::STATUS_ACTIVE)->get();
        $technicians = User::role('technicians')->where('active', User::USER_ACTIVE)->get();
        $request_type = $request->get('type');
        $request_customer = $request->get('customer_id');
        $request_status = $request->get('status');
        $request_technician = $request->get('technician');

        if ($request->ajax()) {
            $data = TechnicianReport::query()
                ->has('maintenanceSchedule')
                ->with('maintenanceSchedule', 'maintenanceSchedule.agreement')
                ->orderBy('id', 'desc');

            if ($request->start_date) {
                $data = $data->whereBetween('date', [$request->start_date . ' 00:00:00', $request->end_date . ' 23:59:59']);
            }
            if ($request->customer_id) {
                $data = $data->where('customer_id', $request->customer_id);
            }
            if ($request->status) {
                $data = $data->where('status_report', $request->status);
            }
            if ($request->type) {
                $data = $data->where('type', $request->type);
            }
            if ($request->technician) {
                $report = TechnicianPm::query()->where('technician_id', $request_technician)->whereNotNull('report_id')->pluck('report_id');
                $data = $data->whereIn('id', $report);
            }

            return DataTables::eloquent($data)
                ->addIndexColumn()
                ->addColumn('customer_format', function (TechnicianReport $report) {
                    if ($report->type == TechnicianReport::TYPE_OTHER) {
                        $schedule_other = ScheduleOther::query()->where('maintenance_schedule_id', $report->maintenance_schedule_id)->first();
                        $customer = $schedule_other->customer_name;
                    }
                    else {
                        if ($report->maintenanceSchedule->customer_id == null) {
                            $customer = $report->maintenanceSchedule->agreement->customer->organization_name ?? '';
                        } else {
                            $customer = $report->maintenanceSchedule->customer->organization_name ?? '';
                        }
                    }
                    return $customer;
                })
                ->addColumn('type_format', function (TechnicianReport $report) {
                    if ($report->type === TechnicianReport::TYPE_MAINTENANCE_PM) {
                        return '<span class="badge badge-primary">PM</span>';
                    } elseif ($report->type == TechnicianReport::TYPE_REWORK) {
                        return '<span class="badge badge-secondary">Rework</span>';
                    } elseif ($report->type == TechnicianReport::TYPE_INSTALL) {
                        return '<span class="badge badge-success">ติดตั้ง</span>';
                    } elseif ($report->type == TechnicianReport::TYPE_EMERGENCY) {
                        return '<span class="badge badge-danger">ฉุกเฉิน</span>';
                    } elseif ($report->type == TechnicianReport::TYPE_NO_CONTRACT) {
                        return '<span class="badge badge-info">นอก contract</span>';
                    }
                    if ($report->type == MaintenanceSchedule::TYPE_OTHER) {
                        return '<span class="badge badge-info" style="background-color: #6527BE ">งานอื่นๆ</span>';
                    }
                })
                ->addColumn('status_format', function (TechnicianReport $report) {
                    if ($report->status_report == TechnicianReport::STATUS_REPORT_NO_APPROVE) {
                        return '<span class="badge badge-warning">หัวหน้างานยังไม่ตรวจสอบ</span>';
                    } elseif ($report->status_report == TechnicianReport::STATUS_REPORT_APPROVE) {
                        return '<span class="badge badge-success">หัวหน้างานตรวจสอบแล้ว</span>';
                    } elseif ($report->status_report == TechnicianReport::STATUS_REPORT_IN_PROGRESS) {
                        return '<span class="badge badge-secondary">รอดำเนินการ</span>';
                    } elseif ($report->status_report == TechnicianReport::STATUS_REPORT_WARRANTY) {
                        return '<span class="badge badge-success" style="background-color: #7A316F">Warranty</span>';
                    } elseif ($report->status_report == TechnicianReport::STATUS_REPORT_WAIT_PRICE) {
                        return '<span class="badge badge-success" style="background-color: #6C3428">รอเสนอราคา</span>';
                    } elseif ($report->status_report == TechnicianReport::STATUS_REPORT_REWORK) {
                        return '<span class="badge badge-success" style="background-color: #557A46">Rework</span>';
                    } elseif ($report->status_report == TechnicianReport::STATUS_REPORT_JOB_CLOSE) {
                        return '<span class="badge badge-success">Job Close</span>';
                    } elseif ($report->status_report == TechnicianReport::STATUS_REPORT_OTHER) {
                        return '<span class="badge badge-success" style="background-color: #6527BE">อื่นๆ</span>';
                    } else return '';
                })
                ->addColumn('date_format', function (TechnicianReport $report) {
                    return Carbon::createFromFormat('Y-m-d', $report->date)->translatedFormat('วันD ที่ d F Y');
                })
                ->addColumn('action', function (TechnicianReport $report) use ($request_type) {
                    //                    $edit_report = TechnicianReport::query()->where('maintenance_schedule_id', $report->maintenanceSchedule->id)->first();
                    if ($report->type === TechnicianReport::TYPE_MAINTENANCE_PM) {
                        $edit = '<a class="btn btn-default bg-white btn-xs" href="' . route('maintenances.product.pm.edit', ['maintenance' => $report->maintenance_schedule_id, 'product' => $report->agreement_item_id, 'pm' => $report->id]) . '"><i class="fa-duotone fa-eye text-primary"></i></a>';
                        $show = '<a class="btn btn-default bg-white btn-xs" href="' . route('maintenances.product.pm.edit', ['maintenance' => $report->maintenance_schedule_id, 'product' => $report->agreement_item_id, 'pm' => $report->id]) . '"><i class="fa-duotone fa-eye text-primary"></i> ตรวจสอบงาน</a>';
                    } elseif ($report->type == TechnicianReport::TYPE_OTHER) {
                        $schedule_other = ScheduleOther::query()->has('schedule')->where('maintenance_schedule_id', $report->maintenance_schedule_id)->first();
                        $edit = '<a class="btn btn-default bg-white btn-xs" href="' . route('schedule_others.edit', ['schedule_other' => $schedule_other->schedule->id, 'type' => 'other']) . '"><i class="fa-duotone fa-pen-alt text-primary"></i> แก้ไข</a>';
                        $show = '<a class="btn btn-default bg-white btn-xs" href="' . route('schedule_others.show', ['schedule_other' => $schedule_other->schedule->id, 'type' => 'other']) . '"><i class="fa-duotone fa-eye text-primary"></i> ตรวจสอบงาน</a>';
                        return $show;
                    } else {
                        $edit = '<a class="btn btn-default bg-white btn-xs" href="' . route('maintenance_reports.edit', ['maintenance_report' => $report->id]) . '"><i class="fa-duotone fa-eye text-primary"></i></a>';
                        $show = '<a class="btn btn-default bg-white btn-xs" href="' . route('maintenance_reports.show', ['maintenance_report' => $report->id, 'type' => $request_type]) . '"><i class="fa-duotone fa-eye text-primary"></i> ตรวจสอบงาน</a>';
                    }
                    //                    $delete = '<button class="btn btn-default bg-white btn-xs " onclick="deleteConfirmation(' . $report->id . ');"><i class="fas fa-fw fa-trash text-danger"></i></button>';
                    return $show;
                })
                ->rawColumns(['date_format', 'customer_format', 'type_format', 'status_format', 'action'])
                ->make(true);
        }
        return view('report.pm.index', compact('request_type', 'customers', 'request_customer', 'request_status', 'technicians', 'request_technician'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public
    function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public
    function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public
    function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public
    function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public
    function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public
    function destroy($id)
    {
        //
    }
}
