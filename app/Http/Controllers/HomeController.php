<?php

namespace App\Http\Controllers;

use App\Models\Agreement;
use App\Models\Customer;
use App\Models\MaintenanceSchedule;
use App\Models\TechnicianReport;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $count_customer = Customer::where('status', Customer::STATUS_ACTIVE)->count();
        $count_schedule_pending = MaintenanceSchedule::has('agreement')->where('deleted_at','=',null)->where('status', MaintenanceSchedule::STATUS_PENDING)->count();
        $count_pm_schedule_progress = MaintenanceSchedule::has('agreement')->where('deleted_at','=',null)->where('type', MaintenanceSchedule::TYPE_MAINTENANCE_PM)->where('status', MaintenanceSchedule::STATUS_IN_PROGRESS)->count();
        $count_other_schedule_progress = MaintenanceSchedule::has('agreement')->where('deleted_at','=',null)->where('type', MaintenanceSchedule::TYPE_MAINTENANCE_PM)->where('status', MaintenanceSchedule::STATUS_IN_PROGRESS)->count();

        $count_agreement = Agreement::query()->where('status', Agreement::STATUS_ACTIVE)->count();

        //สรุปสัญญาที่กำลังจะหมดอายุ
        $now = Carbon::parse(now())->translatedFormat('Y-m-d');
        $agreements_expire = Agreement::where('status', Agreement::STATUS_ACTIVE)->get()
            ->filter(function ($agreements) use ($now) {
                return Carbon::parse($agreements->end_contract)->diffInMonths($now) <= 4;
            });

        // ใบรายงานล่าสุด
        $report_pm = TechnicianReport::has('maintenanceSchedule.agreement')
            ->where('type', TechnicianReport::TYPE_MAINTENANCE_PM)
            ->orderBy('created_at', 'desc')->limit(8)
            ->get();
        $report_other = TechnicianReport::has('customer')->whereHas('maintenanceSchedule',function ($q){
            $q->where('deleted_at','=',null);
        })
//            ->where('maintenance_schedules.deleted_at', '=', null)
            ->where('type', '!=', TechnicianReport::TYPE_MAINTENANCE_PM)
            ->orderBy('created_at', 'desc')->limit(8)
            ->get();

        // รอการลงเวลา
        $schedules = MaintenanceSchedule::has('agreement')->where('type', MaintenanceSchedule::TYPE_MAINTENANCE_PM)->where('status', MaintenanceSchedule::STATUS_PENDING)->orderBy('month_pm')->limit(8)->get();

        //ผลรวมประจำเดือน
        $total_report_pm = TechnicianReport::has('maintenanceSchedule.agreement')->where('type', TechnicianReport::TYPE_MAINTENANCE_PM)->get()
            ->filter(function ($technician_report) use ($now) {
                return Carbon::createFromFormat('Y-m-d',$technician_report->date)->translatedFormat('m') == Carbon::now()->translatedFormat('m');
            })->count();
        $total_report_other = TechnicianReport::has('maintenanceSchedule')->where('type', '!=',TechnicianReport::TYPE_MAINTENANCE_PM)->get()
            ->filter(function ($technician_report) use ($now) {
                return Carbon::createFromFormat('Y-m-d',$technician_report->date)->translatedFormat('m') == Carbon::now()->translatedFormat('m');
            })->count();
        $total_agreement = Agreement::where('status', Agreement::STATUS_ACTIVE)->get()
            ->filter(function ($agreement) use ($now) {
            return Carbon::createFromFormat('Y-m-d',$agreement->start_contract)->translatedFormat('m') == Carbon::now()->translatedFormat('m');
        })->count();
//        $total_price = Agreement::where('status', Agreement::STATUS_ACTIVE)->get()
//            ->filter(function ($agreement) use ($now) {
//                return Carbon::createFromFormat('Y-m-d H:i:s',$agreement->created_at)->translatedFormat('m') == Carbon::now()->translatedFormat('m');
//            })->sum('price');
        // ผลต่างสัญญาในเดือนก่อน
        $different_agreement = Agreement::where('status', Agreement::STATUS_ACTIVE)->get()
            ->filter(function ($agreement) use ($now) {
                return Carbon::createFromFormat('Y-m-d',$agreement->start_contract)->translatedFormat('m') == Carbon::now()->subMonth(1)->translatedFormat('m');
            })
            ->count();


        return view('home', compact('count_customer', 'count_schedule_pending',
            'count_agreement', 'count_pm_schedule_progress', 'count_other_schedule_progress','agreements_expire', 'report_pm', 'report_other',
            'schedules', 'total_report_other', 'total_report_pm', 'total_agreement', 'different_agreement'));
    }
}
