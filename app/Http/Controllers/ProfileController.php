<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $admin = auth()->user();
        $myrole = $admin->roles()->pluck('name')->toArray();
        return view('profiles.index',compact('admin','myrole'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $admin = auth()->user();
        $rules = [
            'username' => 'required|max:255|unique:users,username,'.$admin->id,
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
        $admin->syncRoles($request->roles);

        if ($request->get('password')) {
            $admin->password = bcrypt($request->get('password'));
        }

        if ($admin->save()) {
            alert()->success('สำเร็จ', 'แก้ไขข้อมูลเรียบร้อยแล้ว')->autoClose(0)->animation(false, false);
            return redirect()->back();

        }
        return redirect()->refresh();
    }
}
