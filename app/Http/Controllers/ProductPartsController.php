<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductHasPart;
use App\Models\ProductPart;
use App\Models\ProductSerial;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ProductPartsController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = ProductPart::query()->orderBy('updated_at','desc');
            return DataTables::eloquent($data)
                ->addIndexColumn()
                ->addColumn('type_format', function (ProductPart $product_part) {
                    foreach (\App\Models\ProductPart::getTypeArray() as $key => $value){
                        if($product_part->type == $key){
                            return $value;
                        }
                    }
                })
                ->addColumn('status_format', function (ProductPart $product_part) {
                    if ($product_part->status == ProductPart::STATUS_ACTIVE) {
                        return '<span class="badge badge-success">ใช้งาน</span>';
                    } else {
                        return '<span class="badge badge-warning">ไม่ใช้งาน</span>';
                    }
                })
                ->addColumn('action', function (ProductPart $product_part) {
                    $edit = '<a class="btn btn-default bg-white btn-xs" href="' . route('product_parts.edit', ['product_part' => $product_part->id]) . '"><i class="fas fa-fw fa-pen text-primary"></i> แก่ไข</a>';
                    $delete = '<button class="btn btn-default bg-white btn-xs " onclick="deleteConfirmation(' . $product_part->id . ');"><i class="fas fa-fw fa-trash text-danger"></i> ลบ</button>';
                    return $edit . ' ' . $delete;
                })
                ->rawColumns(['status_format', 'action'])
                ->make(true);
        }
        return view('product_part.index');
    }

    public function create()
    {
        return view('product_part.create');
    }

    public function store(Request $request)
    {
        $rules = [
            'title' => 'required',
            'part_no' => 'required',
            'limit_value' => 'required',
        ];

        $messages = [
            'title.required' => 'กรุณากรอกชื่ออะไหล่',
            'part_no.required' => 'กรุณากรอกเลขที่อะไหล่',
            'limit_value.required' => 'กรุณากรอกค่าจำกัด',
        ];

//        if($request->product_id[0] == null){
//            $messages['product_has_parts.product_id'] = 'กรุณาเลือกสินค้าอย่างน้อย 1 ชิ้น';
//            return redirect()->back()->withInput()->withErrors($messages);
//        }

        $this->validate($request, $rules, $messages);

        $product_part = new ProductPart();
        $product_part->title = $request->title;
        $product_part->part_no = $request->part_no;
        $product_part->limit_value = $request->limit_value;
        $product_part->status = $request->status;

        if ($product_part->save()) {
            if ($request->product_id != null){
                for ($i = 0; $i < count($request->product_id); $i++) {
                    $items[] = [
                        'part_id' => $product_part->id,
                        'product_id' => $request->product_id[$i],
                        'created_at' => now(),
                        'updated_at' => now()
                    ];
                }
                ProductHasPart::insert($items);

            }
            alert()->success('สำเร็จ', 'เพิ่มข้อมูลเรียบร้อยแล้ว')->autoClose(0)->animation(false, false);
            return redirect()->route('product_parts.index');
        }
        return redirect()->refresh();
    }

    public function edit(ProductPart $product_part)
    {
        $products = Product::query()->where('status', Product::STATUS_ACTIVE)->get();
        $items = ProductHasPart::query()->where('part_id', $product_part->id)->get();
        return view('product_part.edit', compact('product_part', 'items','products'));
    }

    public function update(Request $request, ProductPart $product_part)
    {
        $rules = [
            'title' => 'required',
            'part_no' => 'required',
            'limit_value' => 'required',
        ];

        $messages = [
            'title.required' => 'กรุณากรอกชื่ออะไหล่',
            'part_no.required' => 'กรุณากรอกเลขที่อะไหล่',
            'limit_value.required' => 'กรุณากรอกค่าจำกัด',
        ];

//        if($request->product_id[0] == null){
//            $messages['product_has_parts.product_id'] = 'กรุณาสินค้าอย่างน้อย 1 ชิ้น';
//            return redirect()->back()->withInput()->withErrors($messages);
//        }

        $this->validate($request, $rules, $messages);

        $product_part->title = $request->title;
        $product_part->part_no = $request->part_no;
        $product_part->limit_value = $request->limit_value;
        $product_part->status = $request->status;

        if ($product_part->save()) {
            if ($request->product_id != null){
                $product_part->products()->detach();
                for ($i = 0; $i < count($request->product_id); $i++) {
                    $items[] = [
                        'part_id' => $product_part->id,
                        'product_id' => $request->product_id[$i],
                        'updated_at' => now()
                    ];
                }
                ProductHasPart::insert($items);
            }

            alert()->success('สำเร็จ', 'เพิ่มข้อมูลเรียบร้อยแล้ว')->autoClose(0)->animation(false, false);
            return redirect()->route('product_parts.index');
        }
        return redirect()->refresh();
    }

    public function getProductPart(Request $request)
    {
        $search = $request->search;
        if ($search == '') {
            $data = ProductPart::query()
                ->where('status', ProductPart::STATUS_ACTIVE)
                ->orderBy('created_at', 'desc')
                ->select('id', 'title','part_no')
                ->get();
        } else {
            $data = ProductPart::query()
                ->where('status', ProductPart::STATUS_ACTIVE)
                ->orderby('created_at', 'desc')
                ->select('id', 'title','part_no')
                ->where('title', 'like', '%' . $search . '%')
                ->get();
        }

        $response = array();
        foreach ($data as $item) {
            $response[] = array(
                "id" => $item->title,
                "text" => $item->title . ' / Part number: ' . $item->part_no
            );
        }
        return response()->json($response);
    }

    public function destroy(ProductPart $product_part, Request $request)
    {
        $status = false;
        $message = 'ไม่สามารถลบข้อมูลได้';
        if ($product_part->delete()) {
            $status = true;
            $message = 'ลบข้อมูลเรียบร้อยแล้ว';
        }
        if ($request->ajax()) {
            return response()->json(['status' => $status, 'message' => $message]);
        } else {
            alert()->success('สำเร็จ', 'ลบข้อมูลเรียบร้อยแล้ว')->autoClose(0)->animation(false, false);
            return redirect()->route('product_parts.index');
        }
    }
}
