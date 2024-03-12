<?php

namespace App\Http\Controllers;

use App\Models\Inspection;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class InspectionController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Inspection::query()->orderBy('created_at','desc');
            return DataTables::eloquent($data)
                ->addIndexColumn()
                ->addColumn('type_format', function (Inspection $inspection) {
                    foreach (\App\Models\Inspection::getTypeArray() as $key => $value){
                        if($inspection->type == $key){
                            return $value;
                        }
                    }
                })
                ->addColumn('status_format', function (Inspection $inspection) {
                    if ($inspection->status == Inspection::STATUS_ACTIVE) {
                        return '<span class="badge badge-success">ใช้งาน</span>';
                    } else {
                        return '<span class="badge badge-warning">ไม่ใช้งาน</span>';
                    }
                })
                ->addColumn('action', function (Inspection $inspection) {
                    $edit = '<a class="btn btn-default bg-white btn-xs" href="' . route('inspections.edit', ['inspection' => $inspection->id]) . '"><i class="fas fa-fw fa-pen text-primary"></i></a>';
                    $delete = '<button class="btn btn-default bg-white btn-xs " onclick="deleteConfirmation(' . $inspection->id . ');"><i class="fas fa-fw fa-trash text-danger"></i></button>';
                    return $edit . ' ' . $delete;
                })
                ->rawColumns(['status_format', 'action'])
                ->make(true);
        }
        return view('inspection.index');
    }

    public function create()
    {
        return view('inspection.create');
    }

    public function store(Request $request)
    {
        $rules = [
            'title' => 'required',
            'type' => 'required',

        ];

        $messages = [
            'title.required' => 'กรุณากรอกชื่อ',
            'type.required' => 'กรุณาเลือกประเภท',
        ];

        $this->validate($request, $rules, $messages);

        $inspection = new Inspection();
        $inspection->title = $request->title;
        $inspection->type = $request->type;
        $inspection->limit_value = $request->limit_value;
        $inspection->status = $request->status;


        if ($inspection->save()) {
            alert()->success('สำเร็จ', 'เพิ่มข้อมูลเรียบร้อยแล้ว')->autoClose(0)->animation(false, false);
            return redirect()->route('inspections.index');
        }
        return redirect()->refresh();
    }

    public function show($id)
    {
        //
    }

    public function edit(Inspection $inspection)
    {
        return view('inspection.edit',compact('inspection'));
    }

    public function update(Request $request, Inspection $inspection)
    {
        $rules = [
            'title' => 'required',
            'type' => 'required',

        ];

        $messages = [
            'title.required' => 'กรุณากรอกชื่อ',
            'type.required' => 'กรุณาเลือกประเภท',
        ];

        $this->validate($request, $rules, $messages);

        $inspection->title = $request->title;
        $inspection->type = $request->type;
        $inspection->limit_value = $request->limit_value;
        $inspection->status = $request->status;


        if ($inspection->save()) {
            alert()->success('สำเร็จ', 'เพิ่มข้อมูลเรียบร้อยแล้ว')->autoClose(0)->animation(false, false);
            return redirect()->route('inspections.index');
        }
        return redirect()->refresh();
    }

    public function destroy(Request $request, Inspection $inspection)
    {
        $status = false;
        $message = 'ไม่สามารถลบข้อมูลได้';
        if ($inspection->delete()){
            $status = true;
            $message = 'ลบข้อมูลเรียบร้อยแล้ว';
        }
        if ($request->ajax()){
            return response()->json(['status' => $status, 'message' => $message]);
        }else{
            alert()->success('สำเร็จ', 'ลบข้อมูลเรียบร้อยแล้ว')->autoClose(0)->animation(false, false);
            return redirect()->route('inspections.index');
        }
    }
}
