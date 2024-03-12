<?php

namespace App\Http\Controllers;

use App\Models\AgreementItem;
use App\Models\PartChangeItem;
use App\Models\Product;
use App\Models\ProductSerial;
use App\Models\TechnicianReport;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Product::query()->orderBy('created_at','desc');
            return DataTables::eloquent($data)
                ->addIndexColumn()
                ->addColumn('status_format', function (Product $product) {
                    if ($product->status == Product::STATUS_ACTIVE) {
                        return '<span class="badge badge-success">ใช้งาน</span>';
                    } else {
                        return '<span class="badge badge-warning">ไม่ใช้งาน</span>';
                    }
                })
                ->addColumn('action', function (Product $product) {
                    $edit = '<a class="btn btn-default bg-white btn-xs" href="' . route('products.edit', ['product' => $product->id]) . '"><i class="fas fa-fw fa-pen text-primary"></i> แก้ไข</a>';
                    $delete = '<button class="btn btn-default bg-white btn-xs " onclick="deleteConfirmation(' . $product->id . ');"><i class="fas fa-fw fa-trash text-danger"></i> ลบ</button>';
                    return $edit . ' ' . $delete;
                })
                ->rawColumns(['status_format', 'action'])
                ->make(true);
        }
        return view('product.index');
    }

    public function create()
    {
        return view('product.create');
    }

    public function store(Request $request)
    {
        $rules = [
            'title' => 'required',
            'code' => 'required',
        ];

        $messages = [
            'title.required' => 'กรุณากรอกชื่อสินค้า',
            'code.required' => 'กรุณากรอกรหัสสินค้า',
        ];

        if($request->serial_name[0] == null){
            $messages['product_serials.serial_name'] = 'กรุณากรอกหมายเลขเครื่องอย่างน้อย 1 เครื่อง';
            return redirect()->back()->withInput()->withErrors($messages);
        }

        $this->validate($request, $rules, $messages);

        $product = new Product();
        $product->title = $request->title;
        $product->code = $request->code;
        $product->status = $request->status;
        if ($product->save()) {

                for ($i = 0; $i < count($request->serial_name); $i++) {
                    $items[] = [
                        'product_id' => $product->id,
                        'serial_name' => $request->serial_name[$i],
                        'serial_status' => $request->serial_status[$i],
                        'created_at' => now(),
                        'updated_at' => now()
                    ];
                }


            ProductSerial::insert($items);

            alert()->success('สำเร็จ', 'เพิ่มข้อมูลเรียบร้อยแล้ว')->autoClose(0)->animation(false, false);
            return redirect()->route('products.index');
        }
        return redirect()->refresh();
    }

    public function edit(Product $product)
    {
        $product_serials = ProductSerial::query()->where('product_id', $product->id)->get();
        return view('product.edit', compact('product', 'product_serials'));
    }

    public function update(Request $request, Product $product)
    {
        $rules = [
            'title' => 'required',
            'code' => 'required',
        ];

        $messages = [
            'title.required' => 'กรุณากรอกชื่อสินค้า',
            'code.required' => 'กรุณากรอกรหัสสินค้า',
        ];


        $this->validate($request, $rules, $messages);

        $product->title = $request->title;
        $product->code = $request->code;
        $product->status = $request->status;

        if ($product->save()) {

            $array_serial_items = $request->serial_items;
            $array_old_serial_name = $request->old_serial_name;
            $array_remove_serial_id = $request->remove_serial_id;

            //เช็คอัพเดตแก้ไข product serial เพื่อลบใบรายงานช่าง
            $old2_serial_name = $request->old2_serial_name;

            // อัพเดท
            for ($i = 0; $i < count($array_old_serial_name); $i++) {
                //เช็คอัพเดตแก้ไข product และ product serial เพื่อลบใบรายงานช่าง
                if ($array_old_serial_name[$i] != $old2_serial_name[$i]) {
                    AgreementItem::query()->where('product_serial_id', $request->serial_items)->delete();
                    TechnicianReport::query()->where('product_serial_id', $request->serial_items)->delete();
                }
                $item = ProductSerial::query()->where('id', $array_serial_items[$i])->first();
                $item->product_id = $product->id;
                $item->serial_name = $array_old_serial_name[$i];
                $item->save();

            }

            if ($array_remove_serial_id) {
                for ($i = 0; $i < count($array_remove_serial_id); $i++) {
                    ProductSerial::query()->where('id', $array_remove_serial_id[$i])->delete();
                    AgreementItem::query()->where('product_serial_id', $array_remove_serial_id[$i])->delete();
                    TechnicianReport::query()->where('agreement_item_id', $array_remove_serial_id[$i])->delete();
                }
            }

            if (isset($request->serial_name)) {
                for ($i = 0; $i < count($request->serial_name); $i++) {
                    if ($request->serial_name[$i] == null) {
                        $messages['serial_name'] = 'กรุณาเลือกสินค้าอย่างน้อย1ชิ้น';
                        return redirect()->back()->withInput()->withErrors($messages);
                    }
                    $items[] = [
                        'product_id' => $product->id,
                        'serial_name' => $request->serial_name[$i],
                        'serial_status' => $request->serial_status[$i],
                        'updated_at' => now()
                    ];
                }
                ProductSerial::insert($items);
            }



            alert()->success('สำเร็จ', 'เพิ่มข้อมูลเรียบร้อยแล้ว')->autoClose(0)->animation(false, false);
            return redirect()->route('products.index');
        }
        return redirect()->refresh();
    }

    public function destroy(Product $product, Request $request)
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
            return redirect()->route('products.index');
        }
    }
}
