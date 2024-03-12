<?php

namespace App\Http\Controllers;

use App\Models\MaintenanceSchedule;
use App\Models\ScheduleOther;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

use function PHPUnit\Framework\isNull;

class CalendarController extends Controller
{
    public function index(Request $request)
    {
        $events = array();
        $type = $request->get('type');

        $bookings = MaintenanceSchedule::query()->where('appointment_date', '!=', null)->whereNull('deleted_at')->get();

        if ($request->user_id) {
            $bookings = MaintenanceSchedule::with('technicianPm')
                ->where('appointment_date', '!=', null)
                ->whereHas('technicianPm', function ($q) use ($request) {
                    $q->where('technician_pms.technician_id', $request->user_id);
                })->get();
        }

        if ($request->type) {
            $bookings = MaintenanceSchedule::with('technicianPm')
                ->where('appointment_date', '!=', null)
                ->where('type', $type)
                ->get();
        }

        foreach ($bookings as $booking) {
            if (isset($booking->agreement->customer) == null) {
                if ($booking->type == 'emergency') {
                    $color = '#ffe5e5';
                    $text_color = '#b30000';
                    if (empty($booking->customer->organization_name)) {
                        $customer = '';
                    } else {
                        $customer = $booking->customer->organization_name; //. "\n" . 'เข้าซ่อม : ติดตั้ง'
                    }//. "\n" . 'เข้าซ่อม : ฉุกเฉิน'
                    $route = url('maintenance_reports/create?maintenance_schedule_id=' . $booking->id . '&type=' . \App\Models\TechnicianReport::TYPE_EMERGENCY);
                    if (count($booking->technicianReports) >= 1) {
                        $route = url('maintenance_reports/' . $booking->technicianReports->first()->id . '?type=' . \App\Models\TechnicianReport::TYPE_EMERGENCY);
                    }
                    //$route = url('maintenance_reports?type=' . \App\Models\TechnicianReport::TYPE_EMERGENCY);
                } elseif ($booking->type == 'install') {
                    $color = '#eafaee';
                    $text_color = '#22903e';
                    if (empty($booking->customer->organization_name)) {
                        $customer = '';
                    } else {
                        $customer = $booking->customer->organization_name; //. "\n" . 'เข้าซ่อม : ติดตั้ง'
                    }
                    $route = url('maintenance_reports/create?maintenance_schedule_id=' . $booking->id . '&type=' . \App\Models\TechnicianReport::TYPE_INSTALL);
                    if (count($booking->technicianReports) >= 1) {
                        $route = url('maintenance_reports/' . $booking->technicianReports->first()->id . '?type=' . \App\Models\TechnicianReport::TYPE_INSTALL);
                    }
                    //  $route = url('maintenance_reports?type=' . \App\Models\TechnicianReport::TYPE_INSTALL);
                } elseif ($booking->type == 'no_contract') {
                    $color = '#e8f9fc';
                    $text_color = '#0f6271';
                    if (empty($booking->customer->organization_name)) {
                        $customer = '';
                    } else {
                        $customer = $booking->customer->organization_name; //. "\n" . 'เข้าซ่อม : นอก contract'
                    }
                    $route = url('maintenance_reports/create?maintenance_schedule_id=' . $booking->id . '&type=' . \App\Models\TechnicianReport::TYPE_NO_CONTRACT);
                    if (count($booking->technicianReports) >= 1) {
                        $route = url('maintenance_reports/' . $booking->technicianReports->first()->id . '?type=' . \App\Models\TechnicianReport::TYPE_NO_CONTRACT);
                    }
                } elseif ($booking->type == 'rework') {
                    $color = '#f1f2f3';
                    $text_color = '#838c95';
                    if (empty($booking->customer->organization_name)) {
                        $customer = '';
                    } else {
                        $customer = $booking->customer->organization_name; //. "\n" . 'เข้าซ่อม : ติดตั้ง'
                    } // . "\n" . 'เข้าซ่อม :  rework'
                    $route = url('maintenance_reports/create?maintenance_schedule_id=' . $booking->id . '&type=' . \App\Models\TechnicianReport::TYPE_REWORK);
                    if (count($booking->technicianReports) >= 1) {
                        $route = url('maintenance_reports/' . $booking->technicianReports->first()->id . '?type=' . \App\Models\TechnicianReport::TYPE_REWORK);
                    }
                    //$route = url('maintenance_reports?type=' . \App\Models\TechnicianReport::TYPE_REWORK);
                } elseif ($booking->type == 'other') {
                    $schedule_other = ScheduleOther::query()->where('maintenance_schedule_id', $booking->id)->first();
                    $color = '#fce6ff';
                    $text_color = '#6527BE';
                    $customer = $schedule_other->customer_name ?? ''; // . "\n" . 'เข้าซ่อม :  rework'
                    $route = route('schedule_others.show', ['schedule_other' => $booking->id , 'type' => 'other']);
                }
            } else {
                $customer = $booking->agreement->customer->organization_name; //. "\n" . 'เข้าซ่อม : ตามสัญญา' . "\n" . 'ครั้งที่ : ' . $booking->round_pm
                $color = '#e5e5ff';
                $text_color = '#0000e6';
                $route = route('maintenances.product.index', ['maintenance' => $booking->id]);
            }

            if ($booking->status == MaintenanceSchedule::STATUS_IN_PROGRESS || $booking->status == MaintenanceSchedule::STATUS_PENDING) {
                $icon = '&nbsp;<i class="fa-duotone fa-spinner"></i>&nbsp;&nbsp;';
            } elseif ($booking->status == MaintenanceSchedule::STATUS_REPORT_NO_APPROVE) {
                $icon = '&nbsp;<i class="fa-solid fa-eye"></i>&nbsp;&nbsp;';
            } elseif ($booking->status == MaintenanceSchedule::STATUS_JOB_CLOSE || $booking->status == MaintenanceSchedule::STATUS_REPORT_APPROVE) {
                $icon = '&nbsp;<i class="fa-solid fa-circle-check"></i>&nbsp;&nbsp;';
            } elseif ($booking->status == MaintenanceSchedule::STATUS_OTHER) {
                $icon = '&nbsp;<i class="fa-solid fa-message-dots"></i>&nbsp;&nbsp;';
            } elseif ($booking->status == MaintenanceSchedule::STATUS_REWORK) {
                $icon = '&nbsp;<i class="fa-sharp fa-solid fa-flag" style="color: #ff0000;"></i>&nbsp;&nbsp;';
            } elseif ($booking->status == MaintenanceSchedule::STATUS_WARRANTY) {
                $icon = '&nbsp;<i class="fa-sharp fa-solid fa-flag" style="color: #fbae09;"></i>&nbsp;&nbsp;';
            } elseif ($booking->status == MaintenanceSchedule::STATUS_WAIT_PRICE) {
                $icon = '&nbsp;<i class="fa-sharp fa-solid fa-flag" style="color: #464749;"></i>&nbsp;&nbsp;';
            }

            $events[] = [
                'title' => $customer,
                'start' => Carbon::createFromFormat('Y-m-d H:i:s', $booking->appointment_date)->translatedFormat('Y-m-d'),
                'url' => $route,
                'color' => $color,
                'customHtml' => $icon,
                'textColor' => $text_color
            ];
        }

        $technicians = User::role('technicians')->where('active', User::USER_ACTIVE)->get();
        return view('calendar', ['technicians' => $technicians, 'events' => $events, 'type' => $type]);
    }
}
