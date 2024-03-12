<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\MaintenanceSchedule;
use App\Models\ScheduleOther;
use App\Models\TechnicianPm;
use App\Models\TechnicianReport;
use App\Models\User;
use Illuminate\Http\Request;

class MaintenanceScheduleOtherController extends Controller
{

    public function index()
    {
    }

    public function create(Request $request)
    {
        $type = $request->get('type');

        $technicians = User::query()->role(User::ROLE_TECHNICIAN)->get();
        $customers = Customer::query()->where('status', Customer::STATUS_ACTIVE)->get();

        return view('maintenance.non_pm.type_other.create', compact('technicians', 'type', 'customers'));
    }

    public function store(Request $request)
    {
        $type = 'other';
        $rules = [
            'appointment_date_submit' => 'required',
        ];

        $this->validate($request, $rules);

        if (!$request->start_hour) {
            $request->start_hour = 00;
        }
        if (!$request->start_minute) {
            $request->start_minute = 00;
        }

        $schedule = new MaintenanceSchedule();
        $schedule->appointment_date = $request->appointment_date_submit . ' ' . $request->start_hour . ':' . $request->start_minute . ':00';
        // dd($request->appointment_date_submit . ' ' . $request->start_hour . ':' . $request->start_minute . ':00');
        $schedule->type = 'other';
        $schedule->note = $request->description;
        $schedule->status = $request->status_report;
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

            $schedule_other = new ScheduleOther();
            $schedule_other->maintenance_schedule_id = $schedule->id;
            $schedule_other->date = $request->appointment_date_submit . ' ' . $request->start_hour . ':' . $request->start_minute . ':00';
            $schedule_other->status = $request->status;
            $schedule_other->customer_name = $request->customer_name;
            $schedule_other->organization_name = $request->organization_name;
            $schedule_other->product_model = $request->product_model;
            $schedule_other->product_number = $request->product_number;
            $schedule_other->car_no = $request->car_no;
            $schedule_other->normal_start_time = $request->normal_start_time_hour . ':' . $request->normal_start_time_minute . ':00';
            $schedule_other->normal_end_time = $request->normal_end_time_hour . ':' . $request->normal_end_time_minute . ':00';
            $schedule_other->total_normal_work_time = $request->total_normal_work_time;
            $schedule_other->ot_start_time = $request->ot_start_time_hour . ':' . $request->ot_start_time_minute . ':00';
            $schedule_other->ot_end_time = $request->ot_end_time_hour . ':' . $request->ot_end_time_minute . ':00';
            $schedule_other->total_ot_work_time = $request->total_ot_work_time;
            $schedule_other->travel_time = $request->travel_time;
            $schedule_other->return_time = $request->return_time;
            if ($schedule_other->save()) {

                // store images
                $i = 0;
                $medies_original_name = $request->input('images_original_name', []);
                foreach ($request->input('images', []) as $file) {
                    $schedule_other->addMedia(storage_path('tmp/uploads/' . $file))
                        ->withCustomProperties(['order' => ''])
                        ->setName($medies_original_name[$i])
                        ->toMediaCollection('images');
                    $i++;
                }

                $technician_report = new TechnicianReport();
                $technician_report->maintenance_schedule_id = $schedule->id;
                $technician_report->type = TechnicianReport::TYPE_OTHER;
                $technician_report->status = $request->status;
                $technician_report->status_report = $request->status_report;
                $technician_report->date = $request->appointment_date_submit . ' ' . $request->start_hour . ':' . $request->start_minute . ':00';
                $technician_report->save();
            }


            alert()->success('สำเร็จ', 'เพิ่มข้อมูลเรียบร้อยแล้ว')->autoClose(0)->animation(false, false);
            return redirect()->route('maintenance_reports.index', ['type' => $type]);
        }
        return redirect()->refresh();
    }

    public function show(Request $request, $maintenance_schedule_other)
    {
        $type = $request->get('type');
        $schedule = MaintenanceSchedule::query()->where('id', $maintenance_schedule_other)->whereNull('deleted_at')->first();

        $schedule_other = ScheduleOther::query()->where('maintenance_schedule_id', $schedule->id)->first();
        if ($schedule_other) {
            $technicians = TechnicianPm::where('maintenance_schedule_id', $schedule->id)->get();
            $imagesMedia = $schedule_other->getMedia('images');
            $images = $imagesMedia->sortBy(function ($media, $key) {
                return $media->getCustomProperty('order');
            });
        } else {
            $technicians = TechnicianPm::where('maintenance_schedule_id', $schedule->id)->get();
            $imagesMedia = null;
            $images = null;
        }


        return view('maintenance.non_pm.type_other.show', compact(
            'schedule_other',
            'maintenance_schedule_other',
            'schedule',
            'type',
            'technicians',
            'images'
        ));
    }

    public function edit(Request $request, $maintenance_schedule_other)
    {

        $type = $request->get('type');
        $schedule = MaintenanceSchedule::query()->where('id', $maintenance_schedule_other)->whereNull('deleted_at')->first();
        //dd($schedule->id);
        $schedule_other = ScheduleOther::query()->where('maintenance_schedule_id', $schedule->id)->first();
        $technicians = User::query()->role(User::ROLE_TECHNICIAN)->get();
        $customers = Customer::query()->where('status', Customer::STATUS_ACTIVE)->get();
        if ($schedule_other) {
            $imagesMedia = $schedule_other->getMedia('images');
            $images = $imagesMedia->sortBy(function ($media, $key) {
                return $media->getCustomProperty('order');
            });
        } else {
            $images = null;
        }
        return view('maintenance.non_pm.type_other.edit', compact(
            'maintenance_schedule_other',
            'type',
            'technicians',
            'customers',
            'schedule',
            'schedule_other',
            'images'
        ));
    }

    public function update(Request $request, $schedule_other)
    {
        $schedule = MaintenanceSchedule::query()->where('id', $schedule_other)->first();
        $type = 'other';


        if (count($request->except('status_report', '_token', '_method')) > 0) {
            $rules = [
                'appointment_date_submit' => 'required',
            ];

            if (!$request->start_hour) {
                $request->start_hour = 00;
            }
            if (!$request->start_minute) {
                $request->start_minute = 00;
            }

            $this->validate($request, $rules);


            $schedule->appointment_date = $request->appointment_date_submit . ' ' . $request->start_hour . ':' . $request->start_minute . ':00';
            $schedule->type = 'other';
            $schedule->note = $request->description;
            $schedule->status = $request->status_report;
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

                $schedule_other->maintenance_schedule_id = $schedule->id;
                $schedule_other->date = $request->appointment_date_submit . ' ' . $request->start_hour . ':' . $request->start_minute . ':00';
                $schedule_other->status = $request->status;
                $schedule_other->customer_name = $request->customer_name;
                $schedule_other->organization_name = $request->organization_name;
                $schedule_other->product_model = $request->product_model;
                $schedule_other->product_number = $request->product_number;
                $schedule_other->car_no = $request->car_no;
                $schedule_other->normal_start_time = $request->normal_start_time_hour . ':' . $request->normal_start_time_minute . ':00';
                $schedule_other->normal_end_time = $request->normal_end_time_hour . ':' . $request->normal_end_time_minute . ':00';
                $schedule_other->total_normal_work_time = $request->total_normal_work_time;
                $schedule_other->ot_start_time = $request->ot_start_time_hour . ':' . $request->ot_start_time_minute . ':00';
                $schedule_other->ot_end_time = $request->ot_end_time_hour . ':' . $request->ot_end_time_minute . ':00';
                $schedule_other->total_ot_work_time = $request->total_ot_work_time;
                $schedule_other->travel_time = $request->travel_time;
                $schedule_other->return_time = $request->return_time;
                $schedule_other->save();

                // เช็คภาพที่ลบ เพื่อลบออก
                $medies = $schedule_other->getMedia('images');
                if (count($medies) > 0) {
                    foreach ($medies as $media) {
                        if (!in_array($media->file_name, $request->input('images', []))) {
                            $media->delete();
                        }
                    }
                }

                // เพิ่มรูปภาพที่เข้ามาใหม่
                $i = 1;
                $medies = $schedule_other->getMedia('images')->pluck('file_name')->toArray();
                $medies_original_name = $request->input('images_original_name', []);
                foreach ($request->input('images', []) as $file) {
                    //เพิ่มรูปภาพใหม่
                    if (count($medies) === 0 || !in_array($file, $medies)) {
                        $schedule_other->addMedia(storage_path('tmp/uploads/' . $file))
                            ->withCustomProperties(['order' => $i])
                            ->setName($medies_original_name[$i - 1])
                            ->toMediaCollection('images');
                    } else {
                        //รูปภาพที่มีอยู่แล้ว ให้ get ออกมาแล้ว กำหนด order ใหม่
                        $image = $schedule_other->getMedia('images')->where('file_name', $file)->first();
                        $image->setCustomProperty('order', $i);
                        $image->save();
                    }
                    // เพิ่มจำนวนใหม่
                    $i++;
                }
            }

            alert()->success('สำเร็จ', 'เพิ่มข้อมูลเรียบร้อยแล้ว')->autoClose(0)->animation(false, false);
            return redirect()->route('maintenance_reports.index', ['type' => $type]);
        } else {
            $schedule->status = $request->status_report;
            if ($schedule->save()) {
                alert()->success('สำเร็จ', 'เพิ่มข้อมูลเรียบร้อยแล้ว')->autoClose(0)->animation(false, false);
                return redirect()->route('maintenance_reports.index', ['type' => $type]);
            }
        }
        return redirect()->refresh();
    }

    public function destroy($id)
    {
        //
    }
}
