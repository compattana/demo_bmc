<?php

namespace App\Http\Controllers;

use App\Models\Dryer;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class DryerController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Dryer::query();
            return DataTables::eloquent($data)
                ->addIndexColumn()
                ->addColumn('status_format', function (Dryer $dryer) {
                    if ($dryer->status == Dryer::STATUS_ACTIVE) {
                        return '<span class="badge badge-success">ใช้งาน</span>';
                    } else {
                        return '<span class="badge badge-warning">ไม่ใช้งาน</span>';
                    }
                })
                ->addColumn('action', function (Dryer $dryer) {
                    $edit = '<a class="btn btn-default bg-white btn-xs" href="' . route('dryers.edit', ['dryer' => $dryer->id]) . '"><i class="fas fa-fw fa-pen text-primary"></i></a>';
                    $delete = '<button class="btn btn-default bg-white btn-xs " onclick="deleteConfirmation(' . $dryer->id . ');"><i class="fas fa-fw fa-trash text-danger"></i></button>';
                    return $edit . ' ' . $delete;
                })
                ->rawColumns(['status_format', 'action'])
                ->make(true);
        }
        return view('dryer.index');
    }

    public function create()
    {
        return view('dryer.create');
    }

    public function store(Request $request)
    {
        $rules = [
            'title' => 'required',
        ];

        $messages = [
            'title.required' => 'กรุณากรอกอาการ Compressor',
        ];

        $this->validate($request, $rules, $messages);

        $dryer = new Dryer();
        $dryer->title = $request->title;
        $dryer->status = $request->status;

        if ($dryer->save()) {
            alert()->success('สำเร็จ', 'เพิ่มข้อมูลเรียบร้อยแล้ว')->autoClose(0)->animation(false, false);
            return redirect()->route('dryers.index');
        }
        return redirect()->refresh();
    }

    public function edit(Dryer $dryer)
    {
        return view('dryer.edit',compact('dryer'));
    }

    public function update(Request $request, Dryer $dryer)
    {
        $rules = [
            'title' => 'required',
        ];

        $messages = [
            'title.required' => 'กรุณากรอกอาการ Compressor',
        ];

        $this->validate($request, $rules, $messages);

        $dryer->title = $request->title;
        $dryer->status = $request->status;

        if ($dryer->save()) {
            alert()->success('สำเร็จ', 'เพิ่มข้อมูลเรียบร้อยแล้ว')->autoClose(0)->animation(false, false);
            return redirect()->route('dryers.index');
        }
        return redirect()->refresh();
    }

    public function destroy(Dryer $dryer, Request $request){
        $status = false;
        $message = 'ไม่สามารถลบข้อมูลได้';
        if ($dryer->delete()){
            $status = true;
            $message = 'ลบข้อมูลเรียบร้อยแล้ว';
        }
        if ($request->ajax()){
            return response()->json(['status' => $status, 'message' => $message]);
        }else{
            alert()->success('สำเร็จ', 'ลบข้อมูลเรียบร้อยแล้ว')->autoClose(0)->animation(false, false);
            return redirect()->route('dryers.index');
        }
    }
}
