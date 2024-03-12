<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductModel;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ProductModelController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = ProductModel::query()->orderBy('created_at','desc');
            return DataTables::eloquent($data)
                ->addIndexColumn()
                ->addColumn('type_format', function (ProductModel $product_model) {
                    foreach (\App\Models\ProductModel::getTypeArray() as $key => $value){
                        if($product_model->type == $key){
                            return $value;
                        }
                    }
                })
                ->addColumn('status_format', function (ProductModel $product_model) {
                    if ($product_model->status == ProductModel::STATUS_ACTIVE) {
                        return '<span class="badge badge-success">ใช้งาน</span>';
                    } else {
                        return '<span class="badge badge-warning">ไม่ใช้งาน</span>';
                    }
                })
                ->addColumn('action', function (ProductModel $product_model) {
                    $edit = '<a class="btn btn-default bg-white btn-xs" href="' . route('product_models.edit', ['product_model' => $product_model->id]) . '"><i class="fas fa-fw fa-pen text-primary"></i></a>';
                    $delete = '<button class="btn btn-default bg-white btn-xs " onclick="deleteConfirmation(' . $product_model->id . ');"><i class="fas fa-fw fa-trash text-danger"></i></button>';
                    return $edit . ' ' . $delete;
                })
                ->rawColumns(['status_format', 'action'])
                ->make(true);
        }
        return view('product_model.index');
    }

    public function create()
    {
        $products = Product::query()->where('status', Product::STATUS_ACTIVE)->get();
        return view('product_model.create', compact('products'));
    }

    public function store(Request $request)
    {
        $rules = [
            'title' => 'required',
            'limit_value' => 'required',
            'type' => 'required',
//            'product_id' => 'required',
        ];

        $messages = [
            'title.required' => 'กรุณากรอกชื่อ',
            'type.required' => 'กรุณาเลือกประเภท',
//            'product_id.required' => 'กรุณาเลือก Product Serial',
        ];

        $this->validate($request, $rules, $messages);

        $product_model = new ProductModel();
        $product_model->title = $request->title;
        $product_model->type = $request->type;
        $product_model->limit_value = $request->limit_value;
        $product_model->status = $request->status;
//        $product_model->product_id = $request->product_id;

        if ($product_model->save()) {
            alert()->success('สำเร็จ', 'เพิ่มข้อมูลเรียบร้อยแล้ว')->autoClose(0)->animation(false, false);
            return redirect()->route('product_models.index');
        }
        return redirect()->refresh();
    }


    public function edit(ProductModel $product_model)
    {
        $products = Product::query()->where('status', Product::STATUS_ACTIVE)->get();
        return view('product_model.edit',compact('product_model','products'));
    }

    public function update(Request $request, ProductModel $product_model)
    {
        $rules = [
            'title' => 'required',
            'limit_value' => 'required',
            'type' => 'required',
//            'product_id' => 'required',
        ];

        $messages = [
            'title.required' => 'กรุณากรอกชื่อ',
            'type.required' => 'กรุณาเลือกประเภท',
//            'product_id.required' => 'กรุณาเลือก Product Serial',
        ];

        $this->validate($request, $rules, $messages);

        $product_model->title = $request->title;
        $product_model->type = $request->type;
        $product_model->limit_value = $request->limit_value;
        $product_model->status = $request->status;
//        $product_model->product_id = $request->product_id;

        if ($product_model->save()) {
            alert()->success('สำเร็จ', 'เพิ่มข้อมูลเรียบร้อยแล้ว')->autoClose(0)->animation(false, false);
            return redirect()->route('product_models.index');
        }
        return redirect()->refresh();
    }

    public function destroy(ProductModel $product_model, Request $request){
        $status = false;
        $message = 'ไม่สามารถลบข้อมูลได้';
        if ($product_model->delete()){
            $status = true;
            $message = 'ลบข้อมูลเรียบร้อยแล้ว';
        }
        if ($request->ajax()){
            return response()->json(['status' => $status, 'message' => $message]);
        }else{
            alert()->success('สำเร็จ', 'ลบข้อมูลเรียบร้อยแล้ว')->autoClose(0)->animation(false, false);
            return redirect()->route('product_models.index');
        }
    }
}
