<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductPart;
use App\Models\ProductSerial;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ProductSerialController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = ProductSerial::query();
            return DataTables::eloquent($data)
                ->addIndexColumn()
                ->addColumn('product_format', function (ProductSerial $product_serial){
                    return $product_serial->product->title;
                })
                ->addColumn('status_format', function (ProductSerial $product_serial) {
                    if ($product_serial->serial_status == ProductSerial::STATUS_ACTIVE) {
                        return '<span class="badge badge-success">ใช้งาน</span>';
                    } else {
                        return '<span class="badge badge-warning">ไม่ใช้งาน</span>';
                    }
                })
                ->addColumn('action', function (ProductSerial $product_serial) {
                    $edit = '<a class="btn btn-default bg-white btn-xs" href="' . route('product_serials.edit', ['product_serial' => $product_serial->id]) . '"><i class="fas fa-fw fa-pen text-primary"></i></a>';
                    $delete = '<button class="btn btn-default bg-white btn-xs " onclick="deleteConfirmation(' . $product_serial->id . ');"><i class="fas fa-fw fa-trash text-danger"></i></button>';
                    return $edit . ' ' . $delete;
                })
                ->rawColumns(['product_format','status_format', 'action'])
                ->make(true);
        }
        return view('product_serial.index');
    }

    public function create()
    {
        $product_parts = ProductPart::query()->where('status', ProductPart::STATUS_ACTIVE)->get();
        $products = Product::query()->where('status',Product::STATUS_ACTIVE)->get();
        return view('product_serial.create',compact('products','product_parts'));
    }

    public function store(Request $request)
    {
        $rules = [
            'serial_name' => 'required',
            'code' => 'required',
            'product_id' => 'required',
        ];

        $messages = [
            'serial_name.required' => 'กรุณากรอกชื่อ',
            'code.required' => 'กรุณากรอกรหัส',
            'product_id.required' => 'กรุณากรอกชื่อสินค้า',
        ];

        $this->validate($request, $rules, $messages);

        $product_serial = new ProductSerial();
        $product_serial->serial_name = $request->serial_name;
        $product_serial->code = $request->code;
        $product_serial->serial_status = $request->serial_status;
        $product_serial->product_id = $request->product_id;
        $product_serial->save();

        if ($request->part_id) {
            $product_parts = $request->input('part_id');
            $product_serial->product_parts()->sync($product_parts);
        }

        if ($product_serial->save()) {
            alert()->success('สำเร็จ', 'เพิ่มข้อมูลเรียบร้อยแล้ว')->autoClose(0)->animation(false, false);
            return redirect()->route('product_serials.index');
        }
        return redirect()->refresh();
    }

    public function edit(ProductSerial $product_serial)
    {
        $products = Product::query()->where('status',Product::STATUS_ACTIVE)->get();
        return view('product_serial.edit',compact('product_serial','products'));
    }

    public function update(Request $request, ProductSerial $product_serial)
    {
        $rules = [
            'serial_name' => 'required',
            'code' => 'required',
            'product_id' => 'required',
        ];

        $messages = [
            'serial_name.required' => 'กรุณากรอกชื่อ',
            'code.required' => 'กรุณากรอกรหัส',
            'product_id.required' => 'กรุณากรอกชื่อสินค้า',
        ];

        $this->validate($request, $rules, $messages);

        $product_serial->serial_name = $request->serial_name;
        $product_serial->code = $request->code;
        $product_serial->serial_status = $request->serial_status;
        $product_serial->product_id = $request->product_id;

        if ($product_serial->save()) {
            alert()->success('สำเร็จ', 'เพิ่มข้อมูลเรียบร้อยแล้ว')->autoClose(0)->animation(false, false);
            return redirect()->route('product_serials.index');
        }
        return redirect()->refresh();
    }

    public function destroy(ProductSerial $product_serial, Request $request){
        $status = false;
        $message = 'ไม่สามารถลบข้อมูลได้';
        if ($product_serial->delete()){
            $status = true;
            $message = 'ลบข้อมูลเรียบร้อยแล้ว';
        }
        if ($request->ajax()){
            return response()->json(['status' => $status, 'message' => $message]);
        }else{
            alert()->success('สำเร็จ', 'ลบข้อมูลเรียบร้อยแล้ว')->autoClose(0)->animation(false, false);
            return redirect()->route('product_serials.index');
        }
    }
}
