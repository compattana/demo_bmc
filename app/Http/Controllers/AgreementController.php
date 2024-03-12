<?php

namespace App\Http\Controllers;

use App\Models\Agreement;
use App\Models\AgreementItem;
use App\Models\Customer;
use App\Models\Maintenance;
use App\Models\MaintenanceSchedule;
use App\Models\PreventiveMaintenance;
use App\Models\Product;
use App\Models\ProductSerial;
use App\Models\TechnicianReport;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class AgreementController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:agreement-view|agreement-create|agreement-update|agreement-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:agreement-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:agreement-update', ['only' => ['edit', 'update']]);
        $this->middleware('permission:agreement-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $customers = Customer::query()->where('status', Customer::STATUS_ACTIVE)->get();
        $request_type = $request->get('type');
        $request_customer = $request->get('customer_id');
        $request_status = $request->status;
        if ($request->ajax()) {
            $data = Agreement::with('customer')->select('agreements.*')->orderBy('created_at', 'desc');
            if ($request->archive == 1) {
                $data = $data->where('archive', 1);
            } else {
                $data = $data->where('archive', null);
            }

            if ($request->customer_id) {
                $data = $data->where('customer_id', $request->customer_id)->orderBy('created_at', 'desc');
            }

            if ($request->status == 'success') {
                $data = $data->whereRaw('DATEDIFF(agreements.end_contract,Now())>=60');
            }
            if ($request_status == 'warning') {
                $data = $data->where(function($q){
                    $q->whereRaw('DATEDIFF(agreements.end_contract,Now())>0')->whereRaw('DATEDIFF(agreements.end_contract,Now())<60');
                });
            }
            if ($request->status == 'danger') {
                $data = $data->whereDate('end_contract', '<', Carbon::now());
            }

            if ($request->type) {
                $data = $data->where('contract_type', $request->type);
            }
            return DataTables::eloquent($data)
                ->addIndexColumn()
                ->addColumn('company_format', function (Agreement $agreement) {
                    return $agreement->customer->organization_name;
                })
                ->addColumn('type_format', function (Agreement $agreement) {
                    if ($agreement->contract_type == Agreement::CONTRACT_MONTH) {
                        return '<span class="badge badge-success" style="background-color: #FF8551">รายเดือน</span>';
                    } elseif ($agreement->contract_type == Agreement::CONTRACT_YEAR) {
                        return '<span class="badge badge-success" style="background-color: #974EC3">รายปี</span>';
                    } elseif ($agreement->contract_type == Agreement::CONTRACT_YEAR_FREE) {
                        return '<span class="badge badge-secondary" style="background-color: #7091F5">รายปี (แถม)</span>';
                    }
                })
                ->addColumn('status_format', function (Agreement $agreement) {
                    if ($agreement->status == Agreement::STATUS_ACTIVE) {
                        return '<span class="badge badge-success">ใช้งาน</span>';
                    } else {
                        return '<span class="badge badge-warning">ไม่ใช้งาน</span>';
                    }
                })
                ->addColumn('start_contract_format', function (Agreement $agreement) {
                    return Carbon::createFromFormat('Y-m-d', $agreement->start_contract)->translatedFormat('d F Y');
                })
                ->addColumn('end_contract_format', function (Agreement $agreement) {
                    return Carbon::createFromFormat('Y-m-d', $agreement->end_contract)->translatedFormat('d F Y');
                })
                ->addColumn('agreement_expire_format', function (Agreement $agreement) {
                    $agreements_expire = Carbon::parse($agreement->end_contract)->diffInDays(\Carbon\Carbon::now()->translatedFormat('Y-m-d'));
                    $end_contract = Carbon::createFromFormat('Y-m-d', $agreement->end_contract);
                    if(Carbon::now()->gte($end_contract)){
                        return '<span class="badge badge-danger">หมดอายุ</span>';
                    }elseif ($end_contract->diffInDays(Carbon::now()->translatedFormat('Y-m-d')) > 0 && $end_contract->diffInDays(Carbon::now()->translatedFormat('Y-m-d')) < 60){
                        return '<span class="badge badge-warning">' . $agreements_expire . '</span>';
                    }elseif($end_contract->diffInDays(Carbon::now()->translatedFormat('Y-m-d')) >= 60){
                        return '<span class="badge badge-success">'.$agreements_expire.'</span>';
                    }
                })
                ->addColumn('action', function (Agreement $agreement) {
                    $edit = '<a class="btn btn-default shadow bg-white btn-xs" href="' . route('agreements.edit', ['agreement' => $agreement->id]) . '"><i class="fad fa-fw fa-pen text-wargning"></i> </a>';
                    $show = '<a class="btn btn-default shadow bg-white btn-xs" href="' . route('agreements.show', ['agreement' => $agreement->id]) . '"><i class="fad fa-fw fa-eye text-info"></i> </a>';
                    $archive = '<button class="btn btn-default bg-white btn-xs " onclick="archiveConfirmation(' . $agreement->id . ');"><i class="fad fa-fw fa-box text-primary"></i> </button>';

                    $delete = '<button class="btn btn-default bg-white btn-xs " onclick="deleteConfirmation(' . $agreement->id . ');"><i class="fad fa-fw fa-trash text-danger"></i> </button>';
                    return $edit . ' ' . $show . ' ' . $archive . ' | ' . $delete;
                })
                ->rawColumns(['date_format', 'type_format', 'company_format', 'start_contract_format', 'end_contract_format', 'status_format', 'agreement_expire_format', 'action'])
                ->make(true);
        }
        return view('agreement.index', compact('customers', 'request_customer', 'request_type', 'request_status'));
    }

    public function create()
    {
        //        $data = Product::query()
        //            ->where('id',9)
        //            ->with('productSerials')
        //            ->whereHas('productSerials', function ($q)  {
        //                $q->where('product_serials.serial_status', ProductSerial::STATUS_ACTIVE);
        //            })
        //            ->orderBy('created_at', 'desc')
        //            ->get();
        //        dd($data);
        $products = Product::where('status', Product::STATUS_ACTIVE)->pluck('title', 'id');
        $product_serials = ProductSerial::query()->where('serial_status', ProductSerial::STATUS_ACTIVE)->orderBy('created_at', 'desc')->get();
        $product_show = Product::query()->where('status', Product::STATUS_ACTIVE)->orderBy('created_at', 'desc')->get();
        $customers = Customer::query()->where('status', Agreement::STATUS_ACTIVE)->orderBy('created_at', 'desc')->get();
        return view('agreement.create', compact('customers', 'products', 'product_serials', 'product_show'));
    }

    public function getProduct(Request $request)
    {
        $search = $request->search;
        if ($search == '') {
            $data = Product::query()
                ->where('status', Product::STATUS_ACTIVE)
                ->orderBy('created_at', 'desc')
                ->select('id', 'title', 'code')
                ->get();
        } else {
            $data = Product::query()
                ->where('status', Product::STATUS_ACTIVE)
                ->orderby('created_at', 'desc')
                ->select('id', 'title', 'code')
                ->where('title', 'like', '%' . $search . '%')
                ->orWhere('code', 'like', '%' . $search . '%')
                ->get();
        }

        $response = array();
        foreach ($data as $item) {
            $response[] = array(
                "id" => $item->id,
                "text" => $item->title
            );
        }
        return response()->json($response);
    }

    public function getProductSerial(Request $request)
    {
        $search = $request->search;

        $data = [];

        if ($search == '') {
            $data = ProductSerial::query()->where('product_id', $request->product_id)->get();
        } else {

            $data = ProductSerial::query()->where('product_id', $request->product_id)->get();
        }

        $response = [];
        foreach ($data as $item) {
            $response[] = [
                "id" => $item->id,
                "text" => $item->serial_name
            ];
        }
        return response()->json($response);
    }

    public function store(Request $request)
    {

        $messages = [];

        if (!$request->get('product_id')) {
            $messages['agreement_items.product_id'] = 'กรุณาเลือกสินค้าอย่างน้อย1ชิ้น';
            return redirect()->back()->withInput()->withErrors($messages);
        }


        $agreement = new Agreement();

        $agreement->code = $request->code;
        $agreement->tax_invoice = $request->tax_invoice;
        $agreement->contract = $request->contract;
        $agreement->price = $request->price;
        $agreement->contract_type = $request->contract_type;
        $agreement->start_contract = $request->start_contract_submit;
        $agreement->end_contract = $request->end_contract_submit;
        $agreement->customer_id = $request->customer_id;
        $agreement->status = $request->status;
        $agreement->note = $request->note;

        if ($agreement->save()) {
            if ($request->product_id == null) {
                return redirect()->back()->withInput()->withErrors($messages);
            }
            for ($i = 0; $i < count($request->product_id); $i++) {

                $items[] = [
                    'agreement_id' => $agreement->id,
                    'product_id' => $request->product_id[$i],
                    'product_serial_id' => $request->product_serial_id[$i],
                    'created_at' => now(),
                    'updated_at' => now()
                ];
            }
            AgreementItem::insert($items);


            // คำนวนระยะห่างจำนวนเดือน
            $month_start = Carbon::parse($agreement->start_contract)->format('m');
            $month_end = Carbon::parse($agreement->end_contract)->format('m');
            $year_start = Carbon::parse($agreement->start_contract)->format('Y');
            $year_end = Carbon::parse($agreement->end_contract)->format('Y');
            $period = ((($year_end - $year_start) * 12) + ($month_end - $month_start));

            // คำนวนว่าในสัญญาจะต้องเข้า maintenance_pm ในแต่ละครั้ง ห่างกันกี่เดือน
            $month_pm = $period / $agreement->contract;
            $plus_month = 0;
            for ($i = 0; $i < $agreement->contract; $i++) {
                $maintenance_schedule = new MaintenanceSchedule();
                $maintenance_schedule->agreement_id = $agreement->id;
                $maintenance_schedule->round_pm = $i + 1;
                $maintenance_schedule->month_pm = Carbon::parse($agreement->start_contract)->addMonthsNoOverflow($plus_month);
                $maintenance_schedule->status = 'pending';
                $maintenance_schedule->save();
                $plus_month = $plus_month + $month_pm;
            }

            // store images
            $i = 0;
            $medies_original_name = $request->input('images_original_name', []);
            foreach ($request->input('images', []) as $file) {
                $agreement->addMedia(storage_path('tmp/uploads/' . $file))
                    ->withCustomProperties(['order' => ''])
                    ->setName($medies_original_name[$i])
                    ->toMediaCollection('images');
                $i++;
            }

            alert()->success('สำเร็จ', 'เพิ่มข้อมูลเรียบร้อยแล้ว')->autoClose(0)->animation(false, false);
            return redirect()->route('agreements.index');
        }
        return redirect()->refresh();
    }

    public function show(Agreement $agreement)
    {

        $product_show = Product::query()->where('status', Product::STATUS_ACTIVE)->orderBy('created_at', 'desc')->get();
        $products = Product::query()->where('status', Product::STATUS_ACTIVE)->get();
        $product_serials = ProductSerial::query()->where('serial_status', ProductSerial::STATUS_ACTIVE)->get();
        $items = AgreementItem::query()->has('productSerial')->where('agreement_id', $agreement->id)->get();

        $customers = Customer::query()->where('status', Agreement::STATUS_ACTIVE)->orderBy('created_at', 'desc')->get();
        $imagesMedia = $agreement->getMedia('images');
        $images = $imagesMedia->sortBy(function ($media, $key) {
            return $media->getCustomProperty('order');
        });
        return view('agreement.show', compact(
            'agreement',
            'customers',
            'items',
            'products',
            'product_serials',
            'product_show',
            'images',
            'imagesMedia'
        ));
    }

    public function edit(Agreement $agreement)
    {
        $product_show = Product::query()->where('status', Product::STATUS_ACTIVE)->orderBy('created_at', 'desc')->get();
        $products = Product::query()->where('status', Product::STATUS_ACTIVE)->get();
        $product_serials = ProductSerial::query()->where('serial_status', ProductSerial::STATUS_ACTIVE)->get();
        $items = AgreementItem::query()->has('productSerial')->where('agreement_id', $agreement->id)->get();
        $customers = Customer::query()->where('status', Agreement::STATUS_ACTIVE)->orderBy('created_at', 'desc')->get();
        $imagesMedia = $agreement->getMedia('images');
        $images = $imagesMedia->sortBy(function ($media, $key) {
            return $media->getCustomProperty('order');
        });
        return view('agreement.edit', compact(
            'agreement',
            'customers',
            'items',
            'products',
            'product_serials',
            'product_show',
            'images',
            'imagesMedia'
        ));
    }

    public function update(Request $request, Agreement $agreement)
    {

//        if (!$request->get('product_id')) {
//            $messages['agreement_items.product_id'] = 'กรุณาเลือกสินค้าอย่างน้อย1ชิ้น';
//            return redirect()->back()->withInput()->withErrors($messages);
//        }

        $rules = [
            'customer_id' => 'required',
            'code' => 'required',
        ];

        $messages = [
            'customer_id.required' => 'กรุณากรอกข้อมูลลูกค้า',
            'code.required' => 'กรุณากรอกเลขที่สัญญา',
        ];

        $this->validate($request, $rules, $messages);

        $agreement->code = $request->code;
        $agreement->tax_invoice = $request->tax_invoice;
        $agreement->price = $request->price;
        $agreement->contract_type = $request->contract_type;
        $agreement->status = $request->status;
        $agreement->note = $request->note;
        if ($agreement->save()) {

            // delete old items
            $old_items = AgreementItem::where('agreement_id', $agreement->id)->pluck('id')->toArray();
            $new_items = [];
            if ($request->id) {
                $new_items = $request->id;
            }
            $delete_items = array_diff($old_items, $new_items);


            if ($delete_items) {
                AgreementItem::query()->whereIn('id', $delete_items)->delete();
            }

            // update old data
            if ($request->id) {
                foreach ($request->id as $key => $value) {
                    $items = AgreementItem::find($request->id[$key]);
                    $items->product_id = $request->product_id[$key];
                    $items->product_serial_id = $request->product_serial_id[$key];
                    $items->save();
                }
            }


            // insert new data
            if ($request->new) {
                $start = 0;
                if ($request->id) {
                    $start = count($request->id);
                }
                for ($i = $start; $i < count($request->product_id); $i++) {
                    $item_new = new AgreementItem();
                    $item_new->agreement_id = $agreement->id;
                    $item_new->product_id = $request->product_id[$i];
                    $item_new->product_serial_id = $request->product_serial_id[$i];
                    $item_new->save();
                }
            }

            // delete null
            $item_null = AgreementItem::query()->where('agreement_id', $agreement->id)->where('product_id', null);
            $item_null->delete();


            // เช็คภาพที่ลบ เพื่อลบออก
            $medies = $agreement->getMedia('images');
            if (count($medies) > 0) {
                foreach ($medies as $media) {
                    if (!in_array($media->file_name, $request->input('images', []))) {
                        $media->delete();
                    }
                }
            }

            // เพิ่มรูปภาพที่เข้ามาใหม่
            $i = 1;
            $medies = $agreement->getMedia('images')->pluck('file_name')->toArray();
            $medies_original_name = $request->input('images_original_name', []);
            foreach ($request->input('images', []) as $file) {
                //เพิ่มรูปภาพใหม่
                if (count($medies) === 0 || !in_array($file, $medies)) {
                    $agreement->addMedia(storage_path('tmp/uploads/' . $file))
                        ->withCustomProperties(['order' => $i])
                        ->setName($medies_original_name[$i - 1])
                        ->toMediaCollection('images');
                } else {
                    //รูปภาพที่มีอยู่แล้ว ให้ get ออกมาแล้ว กำหนด order ใหม่
                    $image = $agreement->getMedia('images')->where('file_name', $file)->first();
                    $image->setCustomProperty('order', $i);
                    $image->save();
                }
                // เพิ่มจำนวนใหม่
                $i++;
            }

            alert()->success('สำเร็จ', 'เพิ่มข้อมูลเรียบร้อยแล้ว')->autoClose(0)->animation(false, false);
            return redirect()->back();
        }
        return redirect()->refresh();
    }

    public function destroy(Agreement $agreement, Request $request)
    {
        $status = false;
        $message = 'ไม่สามารถลบข้อมูลได้';
        if ($agreement->delete()) {
            $status = true;
            $message = 'ลบข้อมูลเรียบร้อยแล้ว';
        }
        if ($request->ajax()) {
            return response()->json(['status' => $status, 'message' => $message]);
        } else {
            alert()->success('สำเร็จ', 'ลบข้อมูลเรียบร้อยแล้ว')->autoClose(0)->animation(false, false);
            return redirect()->route('agreements.index');
        }
    }

    public function archive(Agreement $agreement, Request $request)
    {
        $status = false;
        $message = 'ไม่สามารถย้ายเข้าแฟ้มเอกสารได้';
        $agreement->archive = 1;
        if ($agreement->save()) {
            $status = true;
            $message = 'ย้ายเข้าแฟ้มเอกสารเรียบร้อยแล้ว';
        }
        if ($request->ajax()) {
            return response()->json(['status' => $status, 'message' => $message]);
        } else {
            alert()->success('สำเร็จ', 'ย้ายเข้าแฟ้มเอกสารเรียบร้อยแล้ว')->autoClose(0)->animation(false, false);
            return redirect()->route('agreements.index');
        }
    }
}
