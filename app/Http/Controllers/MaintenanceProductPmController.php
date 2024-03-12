<?php

namespace App\Http\Controllers;

use App\Models\AgreementItem;
use App\Models\CompressorItem;
use App\Models\DryerItem;
use App\Models\Inspection;
use App\Models\InspectionItem;
use App\Models\MaintenanceSchedule;
use App\Models\PartChangeItem;
use App\Models\PreventiveItem;
use App\Models\PreventiveMaintenance;
use App\Models\PreventiveReplacementItem;
use App\Models\ProductModel;
use App\Models\ProductModelItem;
use App\Models\ProductPart;
use App\Models\TechnicianPm;
use App\Models\TechnicianReport;
use App\Models\TechnicianReportItem;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class MaintenanceProductPmController extends Controller
{
    public function create(MaintenanceSchedule $maintenance, $item)
    {

        $agreement_items = AgreementItem::with('product', 'productSerial')->where('id', $item)->first();

        $technicians = User::query()->role(User::ROLE_TECHNICIAN)->get();

        $product_models = ProductModel::query()->where('status', ProductModel::STATUS_ACTIVE)->get();

        $inspections = Inspection::query()->where('status', Inspection::STATUS_ACTIVE)->get();

        $count_model = ProductModel::selectRaw("COUNT('id') as total, type")->groupBy('type')->pluck('total');
        $count_inspection = Inspection::selectRaw("COUNT('id') as total, type")->groupBy('type')->pluck('total');

        //last record
        $technician_report = TechnicianReport::query()->where('agreement_item_id', $item)->latest()->first();

        $model_last_record = null;
        if ($technician_report) {
            $preventive = PreventiveMaintenance::query()->where('technician_report_id', $technician_report->id)->first();
            if ($preventive) {
                $model_last_record = ProductModelItem::query()->where('pm_id', $preventive->id)->pluck('present_record');
            }
        }

        return view('maintenance.pm.create', compact(
            'maintenance',
            'item',
            'agreement_items',
            'technicians',
            'product_models',
            'inspections',
            'count_model',
            'count_inspection',
            'model_last_record'
        ));
    }

    public function store(Request $request, MaintenanceSchedule $maintenance, $item)
    {

        $rules = [];

        $messages = [];

        $this->validate($request, $rules, $messages);

        //ใบรายงานช่าง
        $technician_report = new TechnicianReport();
        $technician_report->type = 'maintenance_pm';
        $technician_report->status = $request->status;
        $technician_report->status_report = $request->status_report;
        $technician_report->date = $request->date_pm_submit;
        $technician_report->car_no = $request->car_no;
        $technician_report->product_id = $request->product_id;
        $technician_report->product_serial_id = $request->product_serial_id;
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
        $technician_report->detail = $request->detail;
        $technician_report->normal_start_time = $request->normal_start_time_hour . ':' . $request->normal_start_time_minute . ':00';
        $technician_report->normal_end_time = $request->normal_end_time_hour . ':' . $request->normal_end_time_minute . ':00';
        $technician_report->total_normal_work_time = $request->total_normal_work_time;
        $technician_report->ot_start_time = $request->ot_start_time_hour . ':' . $request->ot_start_time_minute . ':00';
        $technician_report->ot_end_time = $request->ot_end_time_hour . ':' . $request->ot_end_time_minute . ':00';
        $technician_report->total_ot_work_time = $request->total_ot_work_time;
        $technician_report->travel_time = $request->travel_time;
        $technician_report->return_time = $request->return_time;
        $technician_report->maintenance_schedule_id = $maintenance->id;
        $technician_report->customer_id = $maintenance->agreement->customer_id;
        $technician_report->agreement_item_id = $item;
        //        $technician_report->technician_id = $request->user()->id;
        if ($technician_report->save()) {
            $schedules = MaintenanceSchedule::query()->where('id', $maintenance->id)->first();

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
            $technician_report_item->save();

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
        }
        // ใบ PM
        $pm = new PreventiveMaintenance();
        $pm->report_no = $request->report_no;
        $pm->compressor_type = $request->compressor_type;
        $pm->contract_person = $request->contract_person;
        $pm->maintenance_schedule_id = $maintenance->id;
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
        $pm->agreement_item_id = $item;
        if ($pm->save()) {

            //point
            for ($i = 0; $i < count($request->point); $i++) {
                $preventive_items = new PreventiveItem();
                $preventive_items->preventive_id = $pm->id;
                $preventive_items->point = $request->point[$i];
                $preventive_items->dbi = $request->dbi[$i];
                $preventive_items->dbm1 = $request->dbm1[$i];
                $preventive_items->dbc1 = $request->dbc1[$i];
                $preventive_items->dbm2 = $request->dbm2[$i];
                $preventive_items->dbc2 = $request->dbc2[$i];
                $preventive_items->other = $request->pm_other[$i];
                $preventive_items->save();
            }

            //filter type
            $preventive_replacement_items = new PreventiveReplacementItem();
            $preventive_replacement_items->preventive_id = $pm->id;
            $preventive_replacement_items->filter_type = $request->filter_type;
            $preventive_replacement_items->last_replacement = $request->last_replacement;
            $preventive_replacement_items->next_replacement = $request->next_replacement;
            $preventive_replacement_items->save();

            $product_models = ProductModel::query()->where('status', ProductModel::STATUS_ACTIVE)->pluck('id');
            for ($i = 0; $i < count($product_models); $i++) {
                $model_items = new ProductModelItem();
                $model_items->product_model_id = $product_models[$i];
                $model_items->pm_id = $pm->id;
                $model_items->last_record = $request->last_record[$i];
                $model_items->present_record = $request->present_record[$i];
                $model_items->result = $request->result[$i];
                $model_items->save();
            }
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
                $data = file_put_contents($file, $image_base64);
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
            return redirect()->route('maintenances.product.index', ['maintenance' => $maintenance->id]);
        }
        return redirect()->refresh();
    }

    public function edit(MaintenanceSchedule $maintenance, AgreementItem $product, TechnicianReport $pm)
    {

        $maintenance_report = $pm;
        $compressor_items = CompressorItem::query()->where('technician_report_id', $pm->id)->pluck('compressor_id');
        $technicians = TechnicianPm::has('report')->where('report_id', $maintenance_report->id)->get();
        $technician_pm = TechnicianPm::query()->where('report_id', $pm->id)->get();
        $dryer_items = DryerItem::query()->where('technician_report_id', $pm->id)->pluck('dryer_id');
        $part_change_present = PartChangeItem::query()->where('technician_report_id', $pm->id)->where('type', '=', 'present')->get();
        $part_change_future = PartChangeItem::query()->where('technician_report_id', $pm->id)->where('type', '=', 'future')->get();
        $preventive = PreventiveMaintenance::query()->where('technician_report_id', $pm->id)->first();

        $product_models = ProductModel::query()->where('status', ProductModel::STATUS_ACTIVE)->get();
        $inspections = Inspection::query()->where('status', Inspection::STATUS_ACTIVE)->get();
        $count_model = ProductModel::selectRaw("COUNT('id') as total, type")->groupBy('type')->pluck('total');
        $count_inspection = Inspection::selectRaw("COUNT('id') as total, type")->groupBy('type')->pluck('total');

        $model_items = [];
        $inspection_items = [];
        $preventive_items = [];
        $preventive_items2 = [];
        $preventive_replacement = null;
        $images2 = null;
        $imagesMedia2 = null;
        if ($preventive) {
            $model_items = ProductModelItem::query()->where('pm_id', $preventive->id)->get();
            $inspection_items = InspectionItem::query()->where('pm_id', $preventive->id)->get();
            $preventive_items = PreventiveItem::query()->where('preventive_id', $preventive->id)->get();
            $preventive_items2 = PreventiveItem::query()->where('preventive_id', $preventive->id)->where(function ($query) {
                $query->where('point', '=', 'mot1')->orWhere('point', '=', 'mot2');
            })->get();
            $preventive_replacement = PreventiveReplacementItem::query()->where('preventive_id', $preventive->id)->first();
            $imagesMedia2 = $preventive->getMedia('images');
            $images2 = $imagesMedia2->sortBy(function ($media, $key) {
                return $media->getCustomProperty('order');
            });
        }


        $technician_report_items = TechnicianReportItem::query()->where('technician_report_id', $pm->id)->first();

        $imagesMedia = $pm->getMedia('images');

        $images = $imagesMedia->sortBy(function ($media, $key) {
            return $media->getCustomProperty('order');
        });



        return view('maintenance.pm.edit', compact(
            'maintenance',
            'technicians',
            'product',
            'pm',
            'preventive',
            'compressor_items',
            'dryer_items',
            'part_change_present',
            'part_change_future',
            'product_models',
            'inspections',
            'count_model',
            'count_inspection',
            'model_items',
            'inspection_items',
            'technician_pm',
            'preventive_replacement',
            'preventive_items',
            'technician_report_items',
            'maintenance_report',
            'preventive_items2',
            'images',
            'images2',
            'imagesMedia2',
            'imagesMedia'
        ));
    }

    public function update(Request $request, MaintenanceSchedule $maintenance, AgreementItem $product, TechnicianReport $pm)
    {
        $rules = [];

        $messages = [];

        $this->validate($request, $rules, $messages);

        try {
            if ($request->status_report) {
                $pm->status_report = $request->status_report;
                if ($pm->save()) {
                    $maintenance->status = $request->status_report;
                    $maintenance->save();
                }
            }

            $preventive = PreventiveMaintenance::where('technician_report_id', $pm->id)->first();

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
                $pm->addMedia($file)->toMediaCollection('signed');
            }

            // store images
            // เช็คภาพที่ลบ เพื่อลบออก
            $medies = $pm->getMedia('images');
            if (count($medies) > 0) {
                foreach ($medies as $media) {
                    if (!in_array($media->file_name, $request->input('images', []))) {
                        $media->delete();
                    }
                }
            }

            // เพิ่มรูปภาพที่เข้ามาใหม่
            $i = 1;
            $medies = $pm->getMedia('images')->pluck('file_name')->toArray();
            $medies_original_name = $request->input('images1_original_name', []);
            foreach ($request->input('images1', []) as $file) {
                //เพิ่มรูปภาพใหม่
                if (count($medies) === 0 || !in_array($file, $medies)) {
                    $pm->addMedia(storage_path('tmp/uploads/' . $file))
                        ->withCustomProperties(['order' => $i])
                        ->setName($medies_original_name[$i - 1])
                        ->toMediaCollection('images');
                } else {
                    //รูปภาพที่มีอยู่แล้ว ให้ get ออกมาแล้ว กำหนด order ใหม่
                    $image = $pm->getMedia('images')->where('file_name', $file)->first();
                    $image->setCustomProperty('order', $i);
                    $image->save();
                }
                // เพิ่มจำนวนใหม่
                $i++;
            }

            if ($preventive) {
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

                // เช็คภาพที่ลบ เพื่อลบออก
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
            }

            alert()->success('สำเร็จ', 'เพิ่มข้อมูลเรียบร้อยแล้ว')->autoClose(0)->animation(false, false);
            return redirect()->route('maintenances.product.index', ['maintenance' => $maintenance->id]);
        } catch (Exception $e) {
            echo $e->getMessage();
            return redirect()->refresh();
        }
    }
}
