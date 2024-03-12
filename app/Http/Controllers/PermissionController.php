<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use DataTables;

class PermissionController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Permission::query();
            return DataTables::eloquent($data)
                ->addIndexColumn()
                ->addColumn('description',function (Permission $permission) {
                    return $permission->description;
                })
                ->addColumn('action', function ($row) {

                    $edit = '<a class="btn btn-default bg-white btn-xs" href="'.route('permissions.edit',['permission'=>$row['id']]).'"><i class="fas fa-fw fa-pen"></i></a>';
                    $delete = '<a type="button" href="#" class="btn btn-default bg-white btn-xs" onClick="deleteConfirmation(' . $row['id'] . ');"><i class="fas fa-fw fa-trash text-danger"></i></a>';

                    return $edit . ' ' . $delete;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('permission.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('permission.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:permissions|max:255',
        ]);

        $permission = new Permission();
        $permission->name = $request->get('name');
        $permission->description = $request->get('description');
        $permission->guard_name = $request->get('guard_name');

        if ($permission->save()) {
            alert()->success('สำเร็จ', 'บันทึกข้อมูลเรียบร้อยแล้ว')->autoClose(0)->animation(false, false);
            return redirect()->route('permissions.index')->with('success', 'บันทึกข้อมูลเรียบร้อยแล้ว');
        }

        return redirect()->refresh();
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Permission $permission
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Permission $permission)
    {
        return view('permission.edit',compact('permission'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Permission $permission
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, Permission $permission)
    {
        $this->validate($request, [
            'name' => 'required|unique:permissions,name,'.$permission->id.'|max:255',
        ]);

        $permission->name = $request->get('name');
        $permission->description = $request->get('description');
        $permission->guard_name = $request->get('guard_name');

        if ($permission->save()) {
            alert()->success('สำเร็จ', 'บันทึกข้อมูลเรียบร้อยแล้ว')->autoClose(0)->animation(false, false);
            return redirect()->route('permissions.index')->with('success', 'บันทึกข้อมูลเรียบร้อยแล้ว');
        }

        return redirect()->refresh();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Permission $permission)
    {
        $status = false;
        $message = 'ไม่สามารถลบข้อมูลได้';
        if ($permission->delete()){
            $status = true;
            $message = 'ลบข้อมูลเรียบร้อยแล้ว';
        }
        return response()->json(['status'=>$status,'message'=>$message]);
    }
}
