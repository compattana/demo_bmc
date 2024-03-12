<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\New_;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use DataTables;

class RoleController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:role-per-view|role-per-create|role-per-update|role-per-delete', ['only' => ['index','show']]);
        $this->middleware('permission:role-per-create', ['only' => ['create','store']]);
        $this->middleware('permission:role-per-update', ['only' => ['edit','update']]);
        $this->middleware('permission:role-per-delete', ['only' => ['destroy']]);
    }
    public function index(Request $request)
    {
        if ($request->ajax()) {
            if (auth()->user()->hasRole(User::ROLE_SUPER_MAN)) {
                $data = Role::query();
            } else {
                $data = Role::where('name', '!=', User::ROLE_SUPER_MAN);
            }

            return DataTables::eloquent($data)
                ->addIndexColumn()
                ->addColumn('name', function (Role $role) {
                    return $role->name;
                })
                ->addColumn('title', function (Role $role) {
                    return $role->title;
                })
                ->addColumn('permissions', function ($row) {
                    $role = Role::find($row['id']);
                    $rolePermissionHtml = '';
                    $rolePermission = $role->permissions->all();
                    foreach ($rolePermission as $permission) {
                        $rolePermissionHtml .= '<span style="font-size: 12px" class="badge badge-primary m-1">' . $permission->description . '</span>';
                    }
                    return $rolePermissionHtml;
                })
                ->addColumn('action', function ($row) {
                    $edit = '';
                    $delete = '';
                    if (!in_array($row['name'], [User::ROLE_SUPER_ADMIN, User::ROLE_SUPER_MAN])) {
                        $edit = '<a class="btn btn-default bg-white btn-xs" href="' . route('roles.edit', ['role' => $row['id']]) . '"><i class="fas fa-fw fa-pen text-primary"></i></a>';
                        $delete = '<a type="button" href="#" class="btn btn-default bg-white btn-xs" onClick="deleteConfirmation(' . $row['id'] . ');"><i class="fas fa-fw fa-trash text-danger"></i></a>';
                    }

                    return $edit . ' ' . $delete;
                })
                ->rawColumns(['action', 'permissions'])
                ->make(true);
        }
        return view('role.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $permissions = Permission::all();
        return view('role.create', compact('permissions'));
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
            'name' => 'required|unique:roles|max:255',
        ]);

        $role = new Role();
        $role->name = $request->get('name');
        $role->title = $request->get('name');
        $role->guard_name = 'web';

        if ($role->save()) {
            if ($request->get('permissions')) {
                foreach ($request->get('permissions') as $name) {
                    $permission = Permission::query()->where('name', $name)->first();
                    if (!$permission) {
                        $permission = Permission::create(['name' => $name]);
                    }
                }
            }
            $role->syncPermissions($request->get('permissions'));
            alert()->success('สำเร็จ', 'แก้ไขข้อมูลเรียบร้อยแล้ว')->autoClose(0)->animation(false, false);
            return redirect()->route('roles.index');
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
     * @param Role $role
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Role $role)
    {
        $permissions = Permission::all();
        $rolePermission = $role->permissions->pluck('id')->toArray();

        return view('role.edit', compact('role', 'permissions', 'rolePermission'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Role $role
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, Role $role)
    {
        $this->validate($request, [
            'name' => 'required|unique:roles,name,' . $role->id . '|max:255',
        ]);

        $role->name = $request->get('name');
        $role->title = $request->get('name');

        if ($role->save()) {
            if ($request->get('permissions')) {
                foreach ($request->get('permissions') as $name) {
                    $permission = Permission::query()->where('name', $name)->first();
                    if (!$permission) {
                        $permission = Permission::create(['name' => $name]);
                    }
                }
            }
            $role->syncPermissions($request->get('permissions'));
            alert()->success('สำเร็จ', 'แก้ไขข้อมูลเรียบร้อยแล้ว')->autoClose(0)->animation(false, false);
            return redirect()->route('roles.index');
        }

        return redirect()->refresh();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Role $role
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public
    function destroy(Role $role)
    {
        $status = false;
        $message = 'ไม่สามารถลบข้อมูลได้';
        if ($role->delete()) {
            $status = true;
            $message = 'ลบข้อมูลเรียบร้อยแล้ว';
        }
        return response()->json(['status' => $status, 'message' => $message]);
    }
}
