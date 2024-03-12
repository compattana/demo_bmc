<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class TechnicianController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = User::query()->role(User::ROLE_TECHNICIAN);
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
                    $edit = '<a class="btn btn-default bg-white btn-xs" href="' . route('admins.edit', ['admin' => $user->id]) . '"><i class="fas fa-fw fa-pen text-primary"></i> แก้ไข</a>';
                    $delete = '<button class="btn btn-default bg-white btn-xs" onClick="deleteConfirmation(' . $user->id . ');"><i class="fas fa-fw fa-trash text-danger"></i> ลบ</button>';
                    return $edit . ' ' . $delete;
                })
                ->rawColumns(['action', 'active_format', 'role_format'])
                ->make(true);
        }
        return view('technician.index');
    }
}
