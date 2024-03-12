<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use DataTables;
use Spatie\Permission\Models\Role;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            if (auth()->user()->hasRole(User::ROLE_SUPER_MAN)) {
                $data = User::query();
            } else {
                $data = User::role([User::ROLE_ADMIN, User::ROLE_SUPER_ADMIN]);
            }
            return DataTables::eloquent($data)
                ->addIndexColumn()
                ->addColumn('active_format', function (User $user) {
                    if ($user->active == User::USER_ACTIVE) {
                        return '<span class="badge badge-success">active</span>';
                    } else {
                        return '<span class="badge badge-warning">Unactivated</span>';
                    }

                })
                ->addColumn('role_format', function (User $user) {
                    $text = '';
                    if ($user->roles) {
                        foreach ($user->roles as $role) {
                            $text .= '<span class="badge badge-primary mr-2 mb-2">' . $role->title . '</span>';
                        }
                    }
                    return $text;

                })
                ->addColumn('action', function (User $user) {
                    $edit = '<a class="btn btn-default bg-white btn-xs" href="' . route('admins.edit', ['admin' => $user->id]) . '"><i class="fas fa-fw fa-pen text-primary"></i></a>';
                    $delete = '<button class="btn btn-default bg-white btn-xs" onClick="deleteConfirmation(' . $user->id . ');"><i class="fas fa-fw fa-trash text-danger"></i></button>';
                    return $edit . ' ' . $delete;
                })
                ->rawColumns(['action', 'active_format', 'role_format'])
                ->make(true);
        }
        return view('admins.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('admins.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $rules = [
            'username' => 'required|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
            'name' => 'required',
        ];

        $this->validate($request, $rules);

        $admin = new User(); //ใช้ User เพราะ ต้องเช็ค permission จากโมเดล
        $admin->username = $request->get('username');
        $admin->name = $request->get('name');
        $admin->active = $request->get('active');
        $admin->email = $request->get('email');
        $admin->password = bcrypt($request->get('password'));

        if ($admin->save()) {
            if ($request->roles) {
                $admin->syncRoles($request->roles);
            } else {
                $admin->assignRole('admin');
            }
            alert()->success('สำเร็จ', 'เพิ่มข้อมูลเรียบร้อยแล้ว')->autoClose(0)->animation(false, false);
            return redirect()->route('admins.index');
        }
        return redirect()->refresh();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $admin)
    {
        $myrole = $admin->roles()->pluck('name')->toArray();
        return view('admins.edit', compact('admin', 'myrole'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $admin)
    {
        $rules = [
            'username' => 'required|max:255|unique:users,username,' . $admin->id,
            'name' => 'required',
        ];
        if ($request->has('username') && $admin->username != $request->username) {
            $admin->username = $request->get('username');
        }
        if ($request->get('password')) {
            $rules['password'] = 'required|confirmed|min:6';
        }
        $this->validate($request, $rules);
        $admin->name = $request->get('name');
        $admin->active = $request->get('active');


        if ($request->get('password')) {
            $admin->password = bcrypt($request->get('password'));
        }

        if ($admin->save()) {
            if ($request->roles) {
                $admin->syncRoles($request->roles);
            } else {
                $admin->syncRoles([]);
            }
            alert()->success('สำเร็จ', 'แก้ไขข้อมูลเรียบร้อยแล้ว')->autoClose(0)->animation(false, false);
            return redirect()->back();

        }
        return redirect()->refresh();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, User $admin)
    {
        $status = false;
        $message = 'ไม่สามารถลบข้อมูลได้';
        if ($admin->delete()) {
            $status = true;
            $message = 'ลบข้อมูลเรียบร้อยแล้ว';
        }
        if ($request->ajax()) {
            return response()->json(['status' => $status, 'message' => $message]);
        } else {
            alert()->success('สำเร็จ', 'ลบข้อมูลเรียบร้อยแล้ว')->autoClose(0)->animation(false, false);
            return redirect()->route('admin.admins.index');
        }
    }
}
