<?php

namespace App\Http\Controllers;

use App\Models\Agreement;
use App\Models\AgreementItem;
use App\Models\Customer;
use App\Models\Maintenance;
use App\Models\MaintenanceSchedule;
use App\Models\ScheduleOther;
use App\Models\TechnicianPm;
use App\Models\TechnicianReport;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class MaintenanceScheduleController extends Controller
{
    public function index(Request $request)
    {

        $type = $request->get('type');
        if ($request->ajax()) {
            $data = MaintenanceSchedule::has('agreement')->with('agreement', 'agreement.customer')
                ->where('type', MaintenanceSchedule::TYPE_MAINTENANCE_PM)
                ->where('status', MaintenanceSchedule::STATUS_PENDING)
                ;
            return DataTables::eloquent($data)
                ->addIndexColumn()
                ->addColumn('customer_pm_format', function (MaintenanceSchedule $maintenance_schedule) {
                    return $maintenance_schedule->agreement->customer->organization_name;
                })
                ->addColumn('month_format', function (MaintenanceSchedule $maintenance_schedule) {
                    return Carbon::createFromFormat('Y-m-d', $maintenance_schedule->month_pm)->translatedFormat('F Y');
                })
                ->addColumn('action', function (MaintenanceSchedule $maintenance_schedule) use ($type, $request) {
                    $edit = '<a class="btn btn-default bg-white btn-xs" href="' . route('schedules.edit', ['schedule' => $maintenance_schedule->id, 'type' => $type]) . '"><i class="far fa-calendar-plus text-primary"></i> ลงเวลา</a>';
                    //     $delete = '<button class="btn btn-default bg-white btn-xs " onclick="deleteConfirmation(' . $maintenance_schedule->id . ');"><i class="fas fa-fw fa-trash text-danger"></i></button>';
                    return $edit;
                })
                ->rawColumns(['customer_pm_format', 'month_format', 'action'])
                ->make(true);
        }
        return view('maintenance.appointment.index', compact('type'));
    }

    ///------------------------ เมนูนอกเหนือ PM -> ทั้งหมด -----------------------///
    public function index_non_pm(Request $request)
    {
        $type = $request->get('type');
        if ($request->ajax()) {
            $data = MaintenanceSchedule::with('technicianReports', 'customer')
            ->where('type', '!=', MaintenanceSchedule::TYPE_MAINTENANCE_PM)
            ->orderBy('created_at', 'desc');
            return DataTables::eloquent($data)
                ->addIndexColumn()
                ->addColumn('customer_other_format', function (MaintenanceSchedule $maintenance_schedule) {
                    if ($maintenance_schedule->customer_id == null) {
                        if ($maintenance_schedule->type == MaintenanceSchedule::TYPE_OTHER) {
                            $schedule_other = ScheduleOther::query()->has('schedule')->where('maintenance_schedule_id', $maintenance_schedule->id)->first();
                            return $schedule_other->customer_name ?? '';
                        } else return '';
                    }  else return $maintenance_schedule->customer->organization_name;
                })
                ->addColumn('type_format', function (MaintenanceSchedule $maintenance_schedule) {
                    if ($maintenance_schedule->type == MaintenanceSchedule::TYPE_REWORK) {
                        return '<span class="badge badge-secondary">Rework</span>';
                    }
                    if ($maintenance_schedule->type == MaintenanceSchedule::TYPE_INSTALL) {
                        return '<span class="badge badge-success">ติดตั้ง</span>';
                    }
                    if ($maintenance_schedule->type == MaintenanceSchedule::TYPE_EMERGENCY) {
                        return '<span class="badge badge-danger">ฉุกเฉิน</span>';
                    }
                    if ($maintenance_schedule->type == MaintenanceSchedule::TYPE_NO_CONTRACT) {
                        return '<span class="badge badge-info">นอก contract</span>';
                    }
                    if ($maintenance_schedule->type == MaintenanceSchedule::TYPE_OTHER) {
                        return '<span class="badge badge-info" style="background-color: #6527BE ">งานอื่นๆ</span>';
                    }
                })
                ->addColumn('appointment_format', function (MaintenanceSchedule $maintenance_schedule) {
                    return Carbon::createFromFormat('Y-m-d H:i:s', $maintenance_schedule->appointment_date)->translatedFormat('วันD ที่ d F Y');
                })
                ->addColumn('status_format', function (MaintenanceSchedule $schedule) {
                    if ($schedule->status == TechnicianReport::STATUS_REPORT_NO_APPROVE) {
                        return '<span class="badge badge-warning">หัวหน้างานยังไม่ตรวจสอบ</span>';
                    } elseif ($schedule->status == TechnicianReport::STATUS_REPORT_APPROVE) {
                        return '<span class="badge badge-success">หัวหน้างานตรวจสอบแล้ว</span>';
                    } elseif ($schedule->status == TechnicianReport::STATUS_REPORT_IN_PROGRESS) {
                        return '<span class="badge badge-secondary">รอดำเนินการ</span>';
                    } elseif ($schedule->status == TechnicianReport::STATUS_REPORT_WARRANTY) {
                        return '<span class="badge badge-success" style="background-color: #7A316F">Warranty</span>';
                    } elseif ($schedule->status == TechnicianReport::STATUS_REPORT_WAIT_PRICE) {
                        return '<span class="badge badge-success" style="background-color: #6C3428">รอเสนอราคา</span>';
                    } elseif ($schedule->status == TechnicianReport::STATUS_REPORT_REWORK) {
                        return '<span class="badge badge-success" style="background-color: #557A46">Rework</span>';
                    } elseif ($schedule->status == TechnicianReport::STATUS_REPORT_JOB_CLOSE) {
                        return '<span class="badge badge-success">Job Close</span>';
                    } elseif ($schedule->status == TechnicianReport::STATUS_REPORT_OTHER) {
                        return '<span class="badge badge-success" style="background-color: #6527BE">อื่นๆ</span>';
                    } else return '';
                })
                ->addColumn('note_format', function (MaintenanceSchedule $maintenance_schedule) {
                    if ($maintenance_schedule->note == null) {
                        return '';
                    } else {
                        return '<button class="showNote btn btn-xs" style="cursor: pointer; background-color: transparent" value="' . $maintenance_schedule->id . '" data-toggle="modal" data-target=".bd-example-modal-sm-' . $maintenance_schedule->id . '"  ><i class="fa-sharp fa-solid fa-circle-exclamation" style="color: #e61919; font-size: 16px"></i></a>';
                    }
                })
                ->addColumn('action', function (MaintenanceSchedule $maintenance_schedule) use ($request) {
                    $edit_report = TechnicianReport::query()->where('maintenance_schedule_id', $maintenance_schedule->id)->first();
                    $report = TechnicianReport::query()->where('maintenance_schedule_id', $maintenance_schedule->id)->get();

                    $edit_time = '<a class="btn btn-default bg-white btn-xs" href="' . route('schedules_other_edit', ['schedule' => $maintenance_schedule->id, 'type' => $maintenance_schedule->type]) . '"><i class="far fa-calendar-plus text-primary"></i> แก้ไขเวลา</a>';
                    $create = '<a class="btn btn-default bg-white btn-xs" href="' . route('maintenance_reports.create', ['maintenance_schedule_id' => $maintenance_schedule->id, 'type' => $maintenance_schedule->type]) . '"><i class="fa-duotone fa-pen-alt text-primary"></i> เข้าซ่อม</a>';
                    if ($edit_report) {
                        $edit = '<a class="btn btn-default bg-white btn-xs" href="' . route('maintenance_reports.edit', ['maintenance_report' => $edit_report->id, 'type' => $maintenance_schedule->type]) . '"><i class="fa-duotone fa-pen-alt text-primary"></i></a>';
                        $show = '<a class="btn btn-default bg-white btn-xs" href="' . route('maintenance_reports.show', ['maintenance_report' => $edit_report->id, 'type' => $maintenance_schedule->type]) . '"><i class="fa-duotone fa-eye text-primary"></i> ตรวจสอบงาน</a>';
                    }
                    $delete = '<button class="btn btn-default bg-white btn-xs " onclick="deleteConfirmation(' . $maintenance_schedule->id . ');"><i class="fas fa-fw fa-trash text-danger"></i> ลบ</button>';
                    if ($maintenance_schedule->type == MaintenanceSchedule::TYPE_OTHER) {
                        $schedule_other = ScheduleOther::query()->has('schedule')->where('maintenance_schedule_id', $maintenance_schedule->id)->first();
                        $edit = '<a class="btn btn-default bg-white btn-xs" href="' . route('schedule_others.edit', ['schedule_other' => $maintenance_schedule->id,'type' => 'other']) . '"><i class="fa-duotone fa-pen-alt text-primary"></i> แก้ไข</a>';
                        $show = '<a class="btn btn-default bg-white btn-xs" href="' . route('schedule_others.show', ['schedule_other' => $maintenance_schedule->id, 'type' => 'other']) . '"><i class="fa-duotone fa-eye text-primary"></i> ตรวจสอบงาน</a>';
                        return $show. ' ' . $edit . ' ' . $delete;
                    }elseif (count($maintenance_schedule->technicianReports) >= 1) {
                        return $show . ' ' . $delete;
                    } else  return $edit_time . ' ' . $create . ' ' . $delete;

                })
                ->rawColumns(['customer_other_format', 'type_format', 'appointment_format', 'month_format', 'status_format', 'note_format', 'action'])
                ->make(true);
        }
        return view('maintenance.non_pm.appointment.index', compact('type'));
    }

    public function create(Request $request)
    {
        $type = $request->get('type');
        $type_name = '';
        if ($type == \App\Models\MaintenanceSchedule::TYPE_NO_CONTRACT) {
            $type_name = 'นอก Contract';
        } elseif ($type == \App\Models\MaintenanceSchedule::TYPE_REWORK) {
            $type_name = 'Rework';
        } elseif ($type == \App\Models\MaintenanceSchedule::TYPE_INSTALL) {
            $type_name = 'ติดตั้ง';
        } elseif ($type == \App\Models\MaintenanceSchedule::TYPE_EMERGENCY) {
            $type_name = 'ฉุกเฉิน';
        }
        $technicians = User::query()->role(User::ROLE_TECHNICIAN)->get();
        $customers = Customer::query()->where('status', Customer::STATUS_ACTIVE)->get();

        return view('maintenance.non_pm.appointment.create', compact('technicians', 'type', 'customers', 'type_name'));
    }

    public function store(Request $request)
    {
        $rules = [
            'technician_id' => 'required',
            'appointment_date_submit' => 'required',
        ];

        $messages = [
            'technician_id.required' => 'กรุณาเลือกพนักงาน',
            'appointment_date_submit.required' => 'กรุณาเลือกวันที่ต้องการเข้า PM',
        ];

        if (!$request->start_hour) {
            $request->start_hour = 00;
        }
        if (!$request->start_minute) {
            $request->start_minute = 00;
        }
        $this->validate($request, $rules, $messages);

        $type = $request->get('type');

        $schedule = new MaintenanceSchedule();
        $schedule->appointment_date = $request->appointment_date_submit . ' ' . $request->start_hour . ':' . $request->start_minute . ':00';
        $schedule->customer_id = $request->customer_id;
        $schedule->type = $type;
        $schedule->note = $request->note;
        $schedule->status = 'in_progress';

        if ($schedule->save()) {
            if ($request->technician_id) {
                $schedule->technicianPm()->delete();
                for ($i = 0; $i < count($request->technician_id); $i++) {
                    $technician = new TechnicianPm();
                    $technician->maintenance_schedule_id = $schedule->id;
                    $technician->technician_id = $request->technician_id[$i];
                    $technician->save();
                }
            }


            alert()->success('สำเร็จ', 'เพิ่มข้อมูลเรียบร้อยแล้ว')->autoClose(0)->animation(false, false);
            return redirect()->route('maintenance_reports.index', ['type' => $type]);
        }
        return redirect()->refresh();
    }

    public function edit(MaintenanceSchedule $schedule)
    {
        $agreement_items = AgreementItem::query()->where('agreement_id', $schedule->agreement_id)->get();
        $technicians = User::query()->role(User::ROLE_TECHNICIAN)->get();

        return view('maintenance.appointment.edit', compact('schedule', 'agreement_items', 'technicians'));
    }

    public function edit_non_pm(Request $request, MaintenanceSchedule $schedule)
    {
        $type = $request->get('type');
        $type_name = $schedule->type;

        if ($type == \App\Models\MaintenanceSchedule::TYPE_NO_CONTRACT || $type_name == \App\Models\MaintenanceSchedule::TYPE_NO_CONTRACT) {
            $type_name = 'นอก Contract';
        } elseif ($type == \App\Models\MaintenanceSchedule::TYPE_REWORK || $type_name == \App\Models\MaintenanceSchedule::TYPE_REWORK) {
            $type_name = 'Rework';
        } elseif ($type == \App\Models\MaintenanceSchedule::TYPE_INSTALL || $type_name == \App\Models\MaintenanceSchedule::TYPE_INSTALL) {
            $type_name = 'ติดตั้ง';
        } elseif ($type == \App\Models\MaintenanceSchedule::TYPE_EMERGENCY || $type_name == \App\Models\MaintenanceSchedule::TYPE_EMERGENCY) {
            $type_name = 'ฉุกเฉิน';
        }

        $agreement_items = AgreementItem::query()->where('agreement_id', $schedule->agreement_id)->get();
        $technicians = User::query()->role(User::ROLE_TECHNICIAN)->get();
        $customers = Customer::query()->where('status', Customer::STATUS_ACTIVE)->get();
        $type = $request->get('type');
        return view('maintenance.non_pm.appointment.edit', compact('schedule',
            'agreement_items', 'technicians', 'customers', 'type_name', 'type'));
    }

    public function update(Request $request, MaintenanceSchedule $schedule)
    {
        $type = $request->get('type');
        $rules = [
            'technician_id' => 'required',
            'appointment_date_submit' => 'required',
        ];

        $messages = [
            'technician_id.required' => 'กรุณาเลือกพนักงาน',
            'appointment_date_submit.required' => 'กรุณาเลือกวันที่ต้องการเข้า PM',
        ];

        if (!$request->start_hour) {
            $request->start_hour = 00;
        }
        if (!$request->start_minute) {
            $request->start_minute = 00;
        }

        $this->validate($request, $rules, $messages);

        $schedule->appointment_date = $request->appointment_date_submit . ' ' . $request->start_hour . ':' . $request->start_minute . ':00';
        $schedule->customer_id = $request->customer_id;
        $schedule->type = $schedule->type;
        $schedule->note = $request->note;
        $schedule->status = 'in_progress';

        if ($schedule->save()) {
            if ($request->technician_id) {
                $schedule->technicianPm()->delete();
                for ($i = 0; $i < count($request->technician_id); $i++) {
                    $technician = new TechnicianPm();
                    $technician->maintenance_schedule_id = $schedule->id;
                    $technician->technician_id = $request->technician_id[$i];
                    $technician->save();
                }
            }

            alert()->success('สำเร็จ', 'เพิ่มข้อมูลเรียบร้อยแล้ว')->autoClose(0)->animation(false, false);
            return redirect()->route('schedules_other', ['type' => 'general']);
        }
        return redirect()->refresh();
    }

    public function destroy(MaintenanceSchedule $schedule, Request $request)
    {
        $status = false;
        $message = 'ไม่สามารถลบข้อมูลได้';
        if ($schedule->delete()) {
//            dd(555555);
            $status = true;
            $message = 'ลบข้อมูลเรียบร้อยแล้ว';
        }
        if ($request->ajax()) {
            return response()->json(['status' => $status, 'message' => $message]);
        } else {
            alert()->success('สำเร็จ', 'ลบข้อมูลเรียบร้อยแล้ว')->autoClose(0)->animation(false, false);
            return redirect()->route('schedules_other');
        }
    }
}
