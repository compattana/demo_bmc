<?php

namespace App\Http\Controllers;

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
use App\Models\ScheduleOther;
use App\Models\TechnicianPm;
use App\Models\TechnicianReport;
use App\Models\TechnicianReportItem;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;
use function PHPUnit\Framework\isEmpty;
use function PHPUnit\Framework\isNull;

class MaintenanceReportController extends Controller
{
    //------------------- เมนู นอกเหนือ PM ที่ไม่ใช่ "ทั้งหมด" --------------------------------//
    public function index(Request $request)
    {

        $type = $request->get('type');

        if ($request->ajax()) {
            $data = MaintenanceSchedule::query()->with('technicianReports', 'customer')
            ->select('maintenance_schedules.*')
            ->where('type', $type)
            ->whereNull('deleted_at')
            ->orderBy('created_at', 'desc');
            return DataTables::eloquent($data)
                ->addIndexColumn()
                ->addColumn('date_format', function (MaintenanceSchedule $schedule) {
                    return Carbon::createFromFormat('Y-m-d H:i:s', $schedule->appointment_date)->translatedFormat('วันD ที่ d F Y');
                })
                ->addColumn('note_format', function (MaintenanceSchedule $schedule) {
                    if ($schedule->note == null) {
                        return '';
                    } else {
                        return '<button class="showNote btn btn-xs" style="cursor: pointer; background-color: transparent" value="' . $schedule->id . '" data-toggle="modal" data-target=".bd-example-modal-sm-' . $schedule->id . '"  ><i class="fa-sharp fa-solid fa-circle-exclamation" style="color: #e61919; font-size: 16px"></i></a>';
                    }
                })
                ->addColumn('customer_format', function (MaintenanceSchedule $schedule) {
                    if ($schedule->customer_id == null) {
                        if ($schedule->type == MaintenanceSchedule::TYPE_OTHER) {
                            $customer = ScheduleOther::query()->where('maintenance_schedule_id', $schedule->id)->pluck('customer_name')->first();
                        } else $customer = '';
                    } else {
                        $customer = $schedule->customer->organization_name;
                    }
                    return $customer;
                })
                ->addColumn('status_format', function (MaintenanceSchedule $schedule) {
                    if ($schedule->status == TechnicianReport::STATUS_REPORT_NO_APPROVE) {
                        return '<span class="badge badge-warning">หัวหน้างานยังไม่ตรวจสอบ</span>';
                    } elseif ($schedule->status == TechnicianReport::STATUS_REPORT_APPROVE) {
                        return '<span class="badge badge-success">หัวหน้างานตรวจสอบแล้ว</span>';
                    } elseif ($schedule->status == TechnicianReport::STATUS_REPORT_IN_PROGRESS) {
                        return '<span class="badge badge-secondary">รอดำเนินการ</span>';
                    } elseif ($schedule->status == TechnicianReport::STATUS_REPORT_WARRANTY) {
                        return '<span class="badge badge-success" style="background-color: #0B666A">Warranty</span>';
                    } elseif ($schedule->status == TechnicianReport::STATUS_REPORT_WAIT_PRICE) {
                        return '<span class="badge badge-success" style="background-color: #65451F">รอเสนอราคา</span>';
                    } elseif ($schedule->status == TechnicianReport::STATUS_REPORT_REWORK) {
                        return '<span class="badge badge-success" style="background-color: #5C469C">Rework</span>';
                    } elseif ($schedule->status == TechnicianReport::STATUS_REPORT_JOB_CLOSE) {
                        return '<span class="badge badge-success">Job Close</span>';
                    } elseif ($schedule->status == TechnicianReport::STATUS_REPORT_OTHER) {
                        return '<span class="badge badge-success" style="background-color: #8294C4">อื่นๆ</span>';
                    } else return '';
                })
                ->addColumn('action', function (MaintenanceSchedule $schedule) use ($type) {

                    $edit_report = TechnicianReport::query()->where('maintenance_schedule_id', $schedule->id)->first();
                    $edit_time = '<a class="btn btn-default bg-white btn-xs" href="' . route('schedules_other_edit', ['schedule' => $schedule->id, 'type' => $type]) . '"><i class="far fa-calendar-plus text-primary"></i> แก้ไขเวลา</a>';
                    $create = '<a class="btn btn-default bg-white btn-xs" href="' . route('maintenance_reports.create', ['maintenance_schedule_id' => $schedule->id, 'type' => $type]) . '"><i class="fa-duotone fa-pen-alt text-primary"></i> เข้าซ่อม</a>';
                    if ($edit_report) {
                        $edit = '<a class="btn btn-default bg-white btn-xs" href="' . route('maintenance_reports.edit', ['maintenance_report' => $edit_report->id, 'type' => $type]) . '"><i class="fa-duotone fa-pen-alt text-primary"> </i></a>';
                        $show = '<a class="btn btn-default bg-white btn-xs" href="' . route('maintenance_reports.show', ['maintenance_report' => $edit_report->id, 'type' => $type]) . '"><i class="fa-duotone fa-eye text-primary"></i> ตรวจสอบงาน</a>';
                    }
                    $delete = '<button class="btn btn-default bg-white btn-xs " onclick="deleteConfirmation(' . $schedule->id . ');"><i class="fas fa-fw fa-trash text-danger"></i> ลบ</button>';
                    if ($schedule->type == MaintenanceSchedule::TYPE_OTHER) {

                        $schedule_other = ScheduleOther::query()->where('maintenance_schedule_id', $schedule->id)->first();
                        $edit = '<a class="btn btn-default bg-white btn-xs" href="' . route('schedule_others.edit', ['schedule_other' => $schedule->id, 'type' => 'other']) . '"><i class="fa-duotone fa-pen-alt text-primary"></i> แก้ไข</a>';
                        $show = '<a class="btn btn-default bg-white btn-xs" href="' . route('schedule_others.show', ['schedule_other' => $schedule->id, 'type' => 'other']) . '"><i class="fa-duotone fa-eye text-primary"></i> ตรวจสอบงาน</a>';
                        return $show . ' ' . $edit . ' ' . $delete;
                    } elseif (count($schedule->technicianReports) >= 1) {
                        return $show . ' ' . $delete;
                    } else  return $edit_time . ' ' . $create . ' ' . $delete;
                })
                ->rawColumns(['date_format', 'customer_format', 'note_format', 'status_format', 'action'])
                ->make(true);
        }
        return view('maintenance.non_pm.index', compact('type'));
    }

    public function showModal($id)
    {
        $schedule = MaintenanceSchedule::find($id);
        return response()->json([
            'status' => 200,
            'note' => $schedule->note,
        ]);
    }

    public function create(Request $request)
    {
        $type = $request->get('type');
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

        $maintenance_schedule_id = $request->get('maintenance_schedule_id');
        $schedule = MaintenanceSchedule::query()->where('id', $maintenance_schedule_id)->first();
        $customers = Customer::query()->where('status', Customer::STATUS_ACTIVE)->get();
        $technicians = User::query()->role(User::ROLE_TECHNICIAN)->get();
        $technicians_selected = TechnicianPm::query()->where('maintenance_schedule_id', $maintenance_schedule_id)->get();
        $product_show = Product::query()->where('status', Product::STATUS_ACTIVE)->orderBy('created_at', 'desc')->get();
        $products = Product::query()->where('status', Product::STATUS_ACTIVE)->get();
        $product_serials = ProductSerial::query()->where('serial_status', Product::STATUS_ACTIVE)->get();
        $product_models = ProductModel::query()->where('status', ProductModel::STATUS_ACTIVE)->get();
        $count_model = ProductModel::selectRaw("COUNT('id') as total, type")->groupBy('type')->pluck('total');
        $inspections = Inspection::query()->where('status', Inspection::STATUS_ACTIVE)->get();
        $count_inspection = Inspection::selectRaw("COUNT('id') as total, type")->groupBy('type')->pluck('total');

        return view('maintenance.non_pm.create', compact(
            'technicians',
            'customers',
            'products',
            'type',
            'product_serials',
            'maintenance_schedule_id',
            'schedule',
            'technicians_selected',
            'type_name',
            'product_show',
            'product_models',
            'count_model',
            'inspections',
            'count_inspection'
        ));
    }

    public function store(Request $request)
    {
        $rules = [];

        $messages = [];

        $this->validate($request, $rules, $messages);
        $type = $request->get('type');
        $maintenance_schedule_id = $request->get('maintenance_schedule_id');
        //ใบรายงานช่าง
        $technician_report = new TechnicianReport();
        $technician_report->type = $type;
        $technician_report->status = $request->status;
        $technician_report->status_report = $request->status_report;
        $technician_report->date = $request->date_submit;
        $technician_report->pm_no = $request->pm_no;
        $technician_report->maintenance_no = $request->maintenance_no;
        $technician_report->contract = $request->contract;
        $technician_report->end_contract = $request->end_contract_submit;
        $technician_report->customer_id = $request->customer_id;
        $technician_report->product_id = $request->product_id;
        $technician_report->service_round = $request->service_round;
        $technician_report->product_serial_id = $request->product_serial_id;
        $technician_report->car_no = $request->car_no;
        $technician_report->pressure_load = $request->pressure_load;
        $technician_report->hour_used = $request->hour_used;
        $technician_report->hour_load = $request->hour_load;
        $technician_report->prefilter = $request->prefilter;
        $technician_report->last_change_prefilter_date = $request->last_change_prefilter_date_submit;
        $technician_report->after_filter = $request->after_filter;
        $technician_report->last_change_after_filter_date = $request->last_change_after_filter_date_submit;
        $technician_report->compressor_check = $request->compressor_check;
        $technician_report->compressor_check_detail = $request->compressor_check_detail;
        $technician_report->max_pressure = $request->max_pressure;
        $technician_report->compressor_other_check = $request->compressor_other_check;
        $technician_report->compressor_other = $request->compressor_other;
        $technician_report->dryer_serial_no = $request->dryer_serial_no;
        $technician_report->dryer_other_check = $request->dryer_other_check;
        $technician_report->dryer_other = $request->dryer_other;
        $technician_report->detail = $request->detail;
        $technician_report->normal_start_time = $request->normal_start_time_hour . ':' . $request->normal_start_time_minute . ':00';
        $technician_report->normal_end_time = $request->normal_end_time_hour . ':' . $request->normal_end_time_minute . ':00';
        $technician_report->total_normal_work_time = $request->total_normal_work_time;
        $technician_report->ot_start_time = $request->ot_start_time_hour . ':' . $request->ot_start_time_minute . ':00';
        $technician_report->ot_end_time = $request->ot_end_time_hour . ':' . $request->ot_end_time_minute . ':00';
        $technician_report->total_ot_work_time = $request->total_ot_work_time;
        $technician_report->travel_time = $request->travel_time;
        $technician_report->return_time = $request->return_time;
        $technician_report->maintenance_schedule_id = $maintenance_schedule_id;
        if ($technician_report->save()) {

            $schedule = MaintenanceSchedule::query()->where('id', $maintenance_schedule_id)->first();
            $schedule->status = $request->status_report;
            $schedule->customer_id = $request->customer_id;
            $schedule->save();

            $technician_report_item = new TechnicianReportItem();
            $technician_report_item->technician_report_id = $technician_report->id;
            $technician_report_item->note = $request->note;
            $technician_report_item->other_detail = $request->other_detail;
            $technician_report_item->ms = $request->boolean('ms');
            $technician_report_item->wty = $request->boolean('wty');
            $technician_report_item->job_close = $request->boolean('job_close');
            $technician_report_item->file = $request->boolean('file');
            $technician_report_item->ass = $request->boolean('ass');
            $technician_report_item->cust = $request->boolean('cust');
            $technician_report_item->other_check = $request->boolean('other_check');
            if ($technician_report_item->save()) {
                for ($i = 0; $i < count($request->technician_id); $i++) {
                    $technician = new TechnicianPm();
                    $technician->report_id = $technician_report->id;
                    $technician->technician_id = $request->technician_id[$i];
                    $technician->save();
                }
                $compressor_items = $request->compressor_id;
                if (is_array($compressor_items) || is_object($compressor_items)) {
                    foreach ($compressor_items as $items) {
                        $compressor_item = new CompressorItem();
                        $compressor_item->technician_report_id = $technician_report->id;
                        $compressor_item->compressor_id = $items;
                        $compressor_item->save();
                    }
                }

                // insert dryer
                $dryer_items = $request->dryer_id;
                if (is_array($dryer_items) || is_object($dryer_items)) {
                    foreach ($dryer_items as $dryer_item) {
                        $dryer_items = new DryerItem();
                        $dryer_items->technician_report_id = $technician_report->id;
                        $dryer_items->dryer_id = $dryer_item;
                        $dryer_items->save();
                    }
                }
                if ($request->product_part_present || $request->product_part_no_present) {
                    for ($i = 0; $i < count($request->product_part_present); $i++) {
                        $present[] = [
                            'technician_report_id' => $technician_report->id,
                            'type' => 'present',
                            'product_part_id' => null,
                            'product_part_no' => $request->product_part_present[$i],
                            'quantity' => $request->quantity_present[$i],
                            'created_at' => now(),
                            'updated_at' => now()
                        ];
                    }
                    PartChangeItem::insert($present);
                }
                if ($request->product_part_future || $request->product_part_no_future) {
                    for ($i = 0; $i < count($request->product_part_future); $i++) {
                        $future[] = [
                            'technician_report_id' => $technician_report->id,
                            'type' => 'future',
                            'product_part_id' => null,
                            'product_part_no' => $request->product_part_future[$i],
                            'quantity' => $request->quantity_future[$i],
                            'created_at' => now(),
                            'updated_at' => now()
                        ];
                    }
                    PartChangeItem::insert($future);
                }

                // ใบ PM
                $pm = new PreventiveMaintenance();
                $pm->report_no = $request->report_no;
                $pm->compressor_type = $request->compressor_type;
                $pm->contract_person = $request->contract_person;
                $pm->maintenance_schedule_id = $maintenance_schedule_id;
                $pm->technician_report_id = $technician_report->id;
                $pm->running = $request->running;
                $pm->load1 = $request->load1;
                $pm->load2 = $request->load2;
                $pm->load3 = $request->load3;
                $pm->loading = $request->loading;
                $pm->unload1 = $request->unload1;
                $pm->unload2 = $request->unload2;
                $pm->unload3 = $request->unload3;
                $pm->result_pm = $request->result_pm;
                if ($pm->save()) {

                    //point
                    for ($i = 0; $i < count($request->point); $i++) {
                        $preventive_items[] = [
                            'preventive_id' => $pm->id,
                            'point' => $request->point[$i],
                            'dbi' => $request->dbi[$i],
                            'dbm1' => $request->dbm1[$i],
                            'dbc1' => $request->dbc1[$i],
                            'dbm2' => $request->dbm2[$i],
                            'dbc2' => $request->dbc2[$i],
                            'other' => $request->pm_other[$i],
                            'created_at' => Carbon::now(),
                            'updated_at' => Carbon::now(),
                        ];
                    }
                    PreventiveItem::insert($preventive_items);

                    //filter type
                    $preventive_replacement_items = new PreventiveReplacementItem();
                    $preventive_replacement_items->preventive_id = $pm->id;
                    $preventive_replacement_items->filter_type = $request->filter_type;
                    $preventive_replacement_items->last_replacement = $request->last_replacement;
                    $preventive_replacement_items->next_replacement = $request->next_replacement;
                    $preventive_replacement_items->save();

                    $product_models = ProductModel::query()->where('status', ProductModel::STATUS_ACTIVE)->pluck('id');
                    for ($i = 0; $i < count($product_models); $i++) {
                        $model_items[] = [
                            'product_model_id' => $product_models[$i],
                            'pm_id' => $pm->id,
                            'last_record' => $request->last_record[$i],
                            'present_record' => $request->present_record[$i],
                            'result' => $request->result[$i]
                        ];
                    }
                    ProductModelItem::insert($model_items);

                    $inspections = Inspection::query()->where('status', Inspection::STATUS_ACTIVE)->pluck('id');
                    for ($i = 0; $i < count($inspections); $i++) {
                        $inspection[] = [
                            'inspection_id' => $inspections[$i],
                            'pm_id' => $pm->id,
                            'last_record_inspection' => $request->last_record_inspection[$i],
                            'checked' => $request->checked[$i] ?? 0,
                            'cleaned' => $request->cleaned[$i] ?? 0,
                            'adjust' => $request->adjust[$i] ?? 0,
                            'repair' => $request->repair[$i] ?? 0,
                            'replace' => $request->replace[$i] ?? 0,
                            'remarks' => $request->remarks[$i] ?? 0,
                        ];
                    }
                    InspectionItem::insert($inspection);

                    //store image signature report maintenance
                    if ($request->sig1_value) {
                        $folderPath = storage_path('tmp/uploads/');
                        $image = explode(";base64,", $request->sig1_value);
                        $image_type = explode("image/", $image[0]);
                        $image_type_png = $image_type[1];
                        $image_base64 = base64_decode($image[1]);
                        $name = uniqid() . '.' . $image_type_png;
                        $file = $folderPath . $name;
                        $data = file_put_contents($file, $image_base64);
                        $technician_report->addMedia($file)->toMediaCollection('signed');
                    }
                    // store images
                    $i = 0;
                    $medies_original_name = $request->input('images1_original_name', []);
                    foreach ($request->input('images1', []) as $file) {
                        $technician_report->addMedia(storage_path('tmp/uploads/' . $file))
                            ->withCustomProperties(['order' => ''])
                            ->setName($medies_original_name[$i])
                            ->toMediaCollection('images');
                        $i++;
                    }

                    //store image signature pm
                    if ($request->sig2_value) {
                        $folderPath = storage_path('tmp/uploads/');
                        $image = explode(";base64,", $request->sig2_value);
                        $image_type = explode("image/", $image[0]);
                        $image_type_png = $image_type[1];
                        $image_base64 = base64_decode($image[1]);
                        $name = uniqid() . '.' . $image_type_png;
                        $file = $folderPath . $name;
                        // $data = file_put_contents($file, $image_base64);
                        $pm->addMedia($file)->toMediaCollection('signed');
                    }

                    // store images
                    $i = 0;
                    $medies_original_name = $request->input('images2_original_name', []);
                    foreach ($request->input('images2', []) as $file) {
                        $pm->addMedia(storage_path('tmp/uploads/' . $file))
                            ->withCustomProperties(['order' => ''])
                            ->setName($medies_original_name[$i])
                            ->toMediaCollection('images');
                        $i++;
                    }

                    alert()->success('สำเร็จ', 'เพิ่มข้อมูลเรียบร้อยแล้ว')->autoClose(0)->animation(false, false);
                    return redirect()->route('maintenance_reports.index', ['type' => $type]);
                }
            }
        }
        return redirect()->refresh();
    }

    public function show(Request $request, TechnicianReport $maintenance_report)
    {
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
        if ($preventive) {
            $model_items = ProductModelItem::query()->where('pm_id', $preventive->id)->get();
            $count_model = ProductModel::selectRaw("COUNT('id') as total, type")->groupBy('type')->pluck('total');
            $preventive_items = PreventiveItem::query()->where('preventive_id', $preventive->id)->get();
            $preventive_items2 = PreventiveItem::query()->where('preventive_id', $preventive->id)->where(function ($query) {
                $query->where('point', '=', 'mot1')->orWhere('point', '=', 'mot2');
            })->get();
            $inspection_items = InspectionItem::query()->where('pm_id', $preventive->id)->get();
            $count_inspection = Inspection::selectRaw("COUNT('id') as total, type")->groupBy('type')->pluck('total');
            $preventive_replacement = PreventiveReplacementItem::query()->where('preventive_id', $preventive->id)->first();
            $imagesMedia2 = $preventive->getMedia('images');
            $images2 = $imagesMedia2->sortBy(function ($media, $key) {
                return $media->getCustomProperty('order');
            });
        } else {
            $model_items = [];
            $count_model = null;
            $inspection_items = [];
            $count_inspection = null;
            $preventive_items = [];
            $preventive_items2 = [];
            $preventive_replacement = null;
            $images2 = null;
            $imagesMedia2 = null;
        }

        $technician_report_items = TechnicianReportItem::query()->where('technician_report_id', $maintenance_report->id)->first();

        $imagesMedia = $maintenance_report->getMedia('images');
        $images = $imagesMedia->sortBy(function ($media, $key) {
            return $media->getCustomProperty('order');
        });

        return view('maintenance.non_pm.show', compact(
            'maintenance_report',
            'type',
            'type_name',
            'technicians',
            'compressor_items',
            'dryer_items',
            'part_change_present',
            'part_change_future',
            'preventive',
            'model_items',
            'count_model',
            'preventive_items',
            'inspection_items',
            'count_inspection',
            'preventive_replacement',
            'technician_report_items',
            'preventive_items2',
            'images',
            'images2',
            'imagesMedia',
            'imagesMedia2'
        ));
    }

    public function edit(Request $request, TechnicianReport $maintenance_report)
    {

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
        $schedule = MaintenanceSchedule::query()->where('id', $maintenance_report->id)->first();
        $customers = Customer::query()->where('status', Customer::STATUS_ACTIVE)->get();
        $maintenance_schedule_id = $request->get('maintenance_schedule_id');
        $technician_report = $maintenance_report;
        $technician_report_items = TechnicianReportItem::query()->where('technician_report_id', $technician_report->id)->first();
        //        dd($technician_report_items);
        $technicians = User::query()->role(User::ROLE_TECHNICIAN)->get();
        $technician_pm = TechnicianPm::query()->where('report_id', $maintenance_report->id)->get();
        $compressor_items = CompressorItem::query()->where('technician_report_id', $maintenance_report->id)->pluck('compressor_id');
        $dryer_items = DryerItem::query()->where('technician_report_id', $maintenance_report->id)->pluck('dryer_id');
        $part_change_present = PartChangeItem::query()->where('technician_report_id', $technician_report->id)->where('type', '=', 'present')->get();
        $part_change_future = PartChangeItem::query()->where('technician_report_id', $technician_report->id)->where('type', '=', 'future')->get();
        $product_models = ProductModel::query()->where('status', ProductModel::STATUS_ACTIVE)->get();
        $count_model = ProductModel::selectRaw("COUNT('id') as total, type")->groupBy('type')->pluck('total');
        $inspections = Inspection::query()->where('status', Inspection::STATUS_ACTIVE)->get();

        $count_inspection = Inspection::selectRaw("COUNT('id') as total, type")->groupBy('type')->pluck('total');

        $preventive = PreventiveMaintenance::query()->where('technician_report_id', $maintenance_report->id)->first();
        $model_items = ProductModelItem::query()->where('pm_id', $preventive->id)->get();
        $preventive_items = PreventiveItem::query()->where('preventive_id', $preventive->id)->get();
        $inspection_items = InspectionItem::query()->where('pm_id', $preventive->id)->get();
        $preventive_replacement = PreventiveReplacementItem::query()->where('preventive_id', $preventive->id)->first();

        return view(
            'maintenance.non_pm.edit',
            compact(
                'maintenance_report',
                'type',
                'type_name',
                'customers',
                'schedule',
                'technician_report',
                'technician_report_items',
                'part_change_present',
                'part_change_future',
                'technicians',
                'technician_pm',
                'maintenance_schedule_id',
                'product_models',
                'count_model',
                'inspections',
                'count_inspection',
                'compressor_items',
                'dryer_items',
                'preventive',
                'model_items',
                'preventive_items',
                'inspection_items',
                'preventive_replacement'
            )
        );
    }

    public function update(Request $request, TechnicianReport $maintenance_report)
    {

        $rules = [];

        $messages = [];

        $this->validate($request, $rules, $messages);
        // $maintenance_report->customer_id = $request->customer_id;
        // $maintenance_report->save();

        // $schedule = MaintenanceSchedule::query()->where('id', $maintenance_report->maintenance_schedule_id)->first();
        // $schedule->customer_id = $request->customer_id;
        // $schedule->save();
        if ($request->status_report) {

            $maintenance_report->status_report = $request->status_report;
            $maintenance_report->save();


            $schedule = MaintenanceSchedule::query()->where('id', $maintenance_report->maintenance_schedule_id)->first();
            // $schedule->customer_id = $maintenance_report->customer_id;
            $schedule->status = $request->status_report;
            $schedule->save();
        }

        $type = $request->get('type');
        $technician_report_item = TechnicianReportItem::query()->where('technician_report_id', $maintenance_report->id)->first();


        $technician_report_item->technician_report_id = $maintenance_report->id;
        $technician_report_item->note = $request->note;
        $technician_report_item->other_detail = $request->other_detail;
        $technician_report_item->ms = $request->boolean('ms');
        $technician_report_item->wty = $request->boolean('wty');
        $technician_report_item->job_close = $request->boolean('job_close');
        $technician_report_item->file = $request->boolean('file');
        $technician_report_item->ass = $request->boolean('ass');
        $technician_report_item->cust = $request->boolean('cust');
        $technician_report_item->other_check = $request->boolean('other_check');

        if ($technician_report_item->save()) {
            $preventive = PreventiveMaintenance::where('technician_report_id', $maintenance_report->id)->first();

            //store image signature report maintenance
            if ($request->sig1_value) {
                $folderPath = storage_path('tmp/uploads/');
                $image = explode(";base64,", $request->sig1_value);
                $image_type = explode("image/", $image[0]);
                $image_type_png = $image_type[1];
                $image_base64 = base64_decode($image[1]);
                $name = uniqid() . '.' . $image_type_png;
                $file = $folderPath . $name;
                $data = file_put_contents($file, $image_base64);
                $maintenance_report->addMedia($file)->toMediaCollection('signed');
            }

            // store images
            // เช็คภาพที่ลบ เพื่อลบออก
            $medies = $maintenance_report->getMedia('images');
            if (count($medies) > 0) {
                foreach ($medies as $media) {
                    if (!in_array($media->file_name, $request->input('images', []))) {
                        $media->delete();
                    }
                }
            }

            // เพิ่มรูปภาพที่เข้ามาใหม่
            $i = 1;
            $medies = $maintenance_report->getMedia('images')->pluck('file_name')->toArray();
            $medies_original_name = $request->input('images1_original_name', []);
            foreach ($request->input('images1', []) as $file) {
                //เพิ่มรูปภาพใหม่
                if (count($medies) === 0 || !in_array($file, $medies)) {
                    $maintenance_report->addMedia(storage_path('tmp/uploads/' . $file))
                        ->withCustomProperties(['order' => $i])
                        ->setName($medies_original_name[$i - 1])
                        ->toMediaCollection('images');
                } else {
                    //รูปภาพที่มีอยู่แล้ว ให้ get ออกมาแล้ว กำหนด order ใหม่
                    $image = $maintenance_report->getMedia('images')->where('file_name', $file)->first();
                    $image->setCustomProperty('order', $i);
                    $image->save();
                }
                // เพิ่มจำนวนใหม่
                $i++;
            }

            //store image signature pm
            if ($request->sig2_value) {
                $folderPath = storage_path('tmp/uploads/');
                $image = explode(";base64,", $request->sig2_value);
                $image_type = explode("image/", $image[0]);
                $image_type_png = $image_type[1];
                $image_base64 = base64_decode($image[1]);
                $name = uniqid() . '.' . $image_type_png;
                $file = $folderPath . $name;
                $data = file_put_contents($file, $image_base64);
                $preventive->addMedia($file)->toMediaCollection('signed');
            }

            // store images
            $medies = $preventive->getMedia('images');
            if (count($medies) > 0) {
                foreach ($medies as $media) {
                    if (!in_array($media->file_name, $request->input('images', []))) {
                        $media->delete();
                    }
                }
            }

            // เพิ่มรูปภาพที่เข้ามาใหม่
            $i = 1;
            $medies = $preventive->getMedia('images')->pluck('file_name')->toArray();
            $medies_original_name = $request->input('images2_original_name', []);
            foreach ($request->input('images2', []) as $file) {
                //เพิ่มรูปภาพใหม่
                if (count($medies) === 0 || !in_array($file, $medies)) {
                    $preventive->addMedia(storage_path('tmp/uploads/' . $file))
                        ->withCustomProperties(['order' => $i])
                        ->setName($medies_original_name[$i - 1])
                        ->toMediaCollection('images');
                } else {
                    //รูปภาพที่มีอยู่แล้ว ให้ get ออกมาแล้ว กำหนด order ใหม่
                    $image = $preventive->getMedia('images')->where('file_name', $file)->first();
                    $image->setCustomProperty('order', $i);
                    $image->save();
                }
                // เพิ่มจำนวนใหม่
                $i++;
            }


            //            if ($technician_report_item->ms == 1 || $technician_report_item->wty == 1 || $technician_report_item->job_close == 1 || $technician_report_item->file == 1
            //                || $technician_report_item->ass == 1 || $technician_report_item->cust == 1 || $technician_report_item->other_check == 1) {
            //                $maintenance_report->status_report = 'approved';
            //                $maintenance_report->save();
            //                $schedule->status = 'approved';
            //                $schedule->save();
            //            } else {
            //                $maintenance_report->status_report = 'no_approve';
            //                $maintenance_report->save();
            //                $schedule->status = 'no_approve';
            //                $schedule->save();
            //            }

            alert()->success('สำเร็จ', 'เพิ่มข้อมูลเรียบร้อยแล้ว')->autoClose(0)->animation(false, false);
            return redirect()->route('maintenance_reports.index', ['type' => $type]);
        }
        return redirect()->refresh();
    }

    public function destroy(TechnicianReport $maintenance_report, Request $request)
    {
        $status = false;
        $message = 'ไม่สามารถลบข้อมูลได้';
        if ($maintenance_report->delete()) {
            $status = true;
            $message = 'ลบข้อมูลเรียบร้อยแล้ว';
        }
        if ($request->ajax()) {
            return response()->json(['status' => $status, 'message' => $message]);
        } else {
            alert()->success('สำเร็จ', 'ลบข้อมูลเรียบร้อยแล้ว')->autoClose(0)->animation(false, false);
            return redirect()->route('maintenance_reports.index');
        }
    }
}
