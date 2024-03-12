<?php

namespace App\Http\Controllers;

use App\Mail\SendMail;
use App\Models\Agreement;
use App\Models\AgreementItem;
use App\Models\CompressorItem;
use App\Models\Customer;
use App\Models\DryerItem;
use App\Models\Inspection;
use App\Models\InspectionItem;
use App\Models\MaintenanceSchedule;
use App\Models\PartChangeItem;
use App\Models\PreventiveItem;
use App\Models\PreventiveMaintenance;
use App\Models\PreventiveReplacementItem;
use App\Models\Product;
use App\Models\ProductModel;
use App\Models\ProductModelItem;
use App\Models\ProductSerial;
use App\Models\TechnicianPm;
use App\Models\TechnicianReport;
use App\Models\TechnicianReportItem;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Mail;

class CustomerViewController extends Controller
{

    public function index($token)
    {
        $customer = Customer::query()->where('status', Customer::STATUS_ACTIVE)->where('token', $token)->first();

        $technician_report = $customer->technicianReport()->where('customer_id', $customer->id)->get();
        $agreements_all = $customer->agreements()->orderBy('created_at', 'desc')->get();
        $agreements = $customer->agreements()->first();
        $schedules = '';
        if ($agreements != null) {
            $agreements_expire = Carbon::parse($agreements->end_contract)->diffInDays(\Carbon\Carbon::now()->translatedFormat('Y-m-d'));
            $schedules = MaintenanceSchedule::has('agreement')->where('type', MaintenanceSchedule::TYPE_MAINTENANCE_PM)
                ->where('agreement_id', $agreements->id)
                ->where('status', MaintenanceSchedule::STATUS_PENDING)
                ->get();
        } else $agreements_expire = '';

        // ใบรายงานล่าสุด
        $report_pm = TechnicianReport::has('maintenanceSchedule.agreement')->where('customer_id', $customer->id)->where('type', TechnicianReport::TYPE_MAINTENANCE_PM)->orderBy('created_at', 'desc')->get();
        $report_other = TechnicianReport::has('customer')->where('customer_id', $customer->id)->where('type', '!=', TechnicianReport::TYPE_MAINTENANCE_PM)->orderBy('created_at', 'desc')->get();


        return view('customer_view.index', compact('customer', 'technician_report', 'agreements', 'agreements_expire',
            'schedules', 'report_other', 'report_pm', 'agreements_all'));
    }

    function sendMail(Request $request)
    {

        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
        ]);

        $data = array(
            'name' => $request->name,
            'message' => $request->message,
            'link' => URL(Route('preview', ['name' => $request->name, 'token' => $request->token])),
        );

        Mail::to($request->email)->send(new SendMail($data));
        alert()->success('สำเร็จ', 'ส่งข้อมูลเรียบร้อยแล้ว')->autoClose(0)->animation(false, false);
        return redirect()->back();
//        return back()->with('success', 'Thanks for contacting us!');

    }

    public function pm(Request $request)
    {
        $maintenance_report = TechnicianReport::where('id', $request->maintenance_report)->first();

        $type = $request->get('type');
        $type_name = '';
        // type name blade
        if ($type == \App\Models\MaintenanceSchedule::TYPE_NO_CONTRACT) {
            $type_name = 'นอก Contract';
        } elseif ($type == \App\Models\MaintenanceSchedule::TYPE_REWORK) {
            $type_name = 'Rework';
        } elseif ($type == \App\Models\MaintenanceSchedule::TYPE_INSTALL) {
            $type_name = 'ติดตั้ง';
        } elseif ($type == \App\Models\MaintenanceSchedule::TYPE_EMERGENCY) {
            $type_name = 'ฉุกเฉิน';
        }
        $technicians = TechnicianPm::has('report')->where('report_id', $maintenance_report->id)->get();
        $compressor_items = CompressorItem::query()->where('technician_report_id', $maintenance_report->id)->pluck('compressor_id');
        $dryer_items = DryerItem::query()->where('technician_report_id', $maintenance_report->id)->pluck('dryer_id');
        $part_change_present = PartChangeItem::query()->where('technician_report_id', $maintenance_report->id)->where('type', '=', 'present')->get();
        $part_change_future = PartChangeItem::query()->where('technician_report_id', $maintenance_report->id)->where('type', '=', 'future')->get();
        $preventive = PreventiveMaintenance::query()->where('technician_report_id', $maintenance_report->id)->first();
        $model_items = ProductModelItem::query()->where('pm_id', $preventive->id)->get();
        $count_model = ProductModel::selectRaw("COUNT('id') as total, type")->groupBy('type')->pluck('total');
        $preventive_items = PreventiveItem::query()->where('preventive_id', $preventive->id)->get();
        $inspection_items = InspectionItem::query()->where('pm_id', $preventive->id)->get();
        $count_inspection = Inspection::selectRaw("COUNT('id') as total, type")->groupBy('type')->pluck('total');
        $preventive_replacement = PreventiveReplacementItem::query()->where('preventive_id', $preventive->id)->first();
        $technician_report_items = TechnicianReportItem::query()->where('technician_report_id', $maintenance_report->id)->first();

        return view('customer_view.pm', compact('maintenance_report', 'type', 'type_name', 'technicians',
            'compressor_items', 'dryer_items', 'part_change_present', 'part_change_future', 'preventive', 'model_items',
            'count_model', 'preventive_items', 'inspection_items', 'count_inspection', 'preventive_replacement', 'technician_report_items'));
    }

    public function agreement(Request $request)
    {
        $agreement = Agreement::query()->where('id', $request->id)->with('customer')->whereHas('customer', function ($q) use ($request) {
            $q->where('token', $request->token);
        })->first();


        $items = AgreementItem::query()->where('agreement_id', $agreement->id)->get();


        $product_show = Product::query()->where('status', Product::STATUS_ACTIVE)->orderBy('created_at', 'desc')->get();
        $products = Product::query()->where('status', Product::STATUS_ACTIVE)->get();
        $product_serials = ProductSerial::query()->where('serial_status', ProductSerial::STATUS_ACTIVE)->get();

        $customers = Customer::query()->where('status', Agreement::STATUS_ACTIVE)->orderBy('created_at', 'desc')->get();
        $imagesMedia = $agreement->getMedia('images');
        $images = $imagesMedia->sortBy(function ($media, $key) {
            return $media->getCustomProperty('order');
        });
        return view('customer_view.agreement', compact('agreement', 'customers', 'items', 'products',
            'product_serials', 'product_show', 'images', 'imagesMedia'));
    }
}
