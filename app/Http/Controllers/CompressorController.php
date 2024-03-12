<?php

namespace App\Http\Controllers;

use App\Models\Compressor;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CompressorController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Compressor::query();
            return DataTables::eloquent($data)
                ->addIndexColumn()
                ->addColumn('status_format', function (Compressor $compressor) {
                    if ($compressor->status == Compressor::STATUS_ACTIVE) {
                        return '<span class="badge badge-success">ใช้งาน</span>';
                    } else {
                        return '<span class="badge badge-warning">ไม่ใช้งาน</span>';
                    }
                })
                ->addColumn('action', function (Compressor $compressor) {
                    $edit = '<a class="btn btn-default bg-white btn-xs" href="' . route('compressors.edit', ['compressor' => $compressor->id]) . '"><i class="fas fa-fw fa-pen text-primary"></i></a>';
                    $delete = '<button class="btn btn-default bg-white btn-xs " onclick="deleteConfirmation(' . $compressor->id . ');"><i class="fas fa-fw fa-trash text-danger"></i></button>';
                    return $edit . ' ' . $delete;
                })
                ->rawColumns(['status_format', 'action'])
                ->make(true);
        }
        return view('compressor.index');
    }

    public function create()
    {
        return view('compressor.create');
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

        $compressor = new Compressor();
        $compressor->title = $request->title;
        $compressor->status = $request->status;

        if ($compressor->save()) {
            alert()->success('สำเร็จ', 'เพิ่มข้อมูลเรียบร้อยแล้ว')->autoClose(0)->animation(false, false);
            return redirect()->route('compressors.index');
        }
        return redirect()->refresh();
    }

    public function edit(Compressor $compressor)
    {
        return view('compressor.edit',compact('compressor'));
    }

    public function update(Request $request, Compressor $compressor)
    {
        $rules = [
            'title' => 'required',
        ];

        $messages = [
            'title.required' => 'กรุณากรอกอาการ Compressor',
        ];

        $this->validate($request, $rules, $messages);

        $compressor->title = $request->title;
        $compressor->status = $request->status;

        if ($compressor->save()) {
            alert()->success('สำเร็จ', 'เพิ่มข้อมูลเรียบร้อยแล้ว')->autoClose(0)->animation(false, false);
            return redirect()->route('compressors.index');
        }
        return redirect()->refresh();
    }

    public function destroy(Compressor $compressor, Request $request){
        $status = false;
        $message = 'ไม่สามารถลบข้อมูลได้';
        if ($compressor->delete()){
            $status = true;
            $message = 'ลบข้อมูลเรียบร้อยแล้ว';
        }
        if ($request->ajax()){
            return response()->json(['status' => $status, 'message' => $message]);
        }else{
            alert()->success('สำเร็จ', 'ลบข้อมูลเรียบร้อยแล้ว')->autoClose(0)->animation(false, false);
            return redirect()->route('compressors.index');
        }
    }
}
