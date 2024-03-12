<?php

namespace App\Http\Controllers;

use App\Models\MaintenanceSchedule;
use App\Models\TechnicianPm;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class MaintenanceController extends Controller
{
    /// เมนู PM -> Maintenance
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = MaintenanceSchedule::has('agreement')->with('agreement', 'agreement.customer')->select('maintenance_schedules.*')
                ->where('type', MaintenanceSchedule::TYPE_MAINTENANCE_PM)
                ->where('maintenance_schedules.status', MaintenanceSchedule::STATUS_IN_PROGRESS)
                ->orderBy('appointment_date', 'desc');
            return DataTables::eloquent($data)
                ->addIndexColumn()
                ->addColumn('appointment_format', function (MaintenanceSchedule $maintenance_schedule) {
                    return Carbon::createFromFormat('Y-m-d H:i:s', $maintenance_schedule->appointment_date)->translatedFormat('วันD ที่ d F Y');
                })
                ->addColumn('customer_format', function (MaintenanceSchedule $maintenance_schedule) {
                    return $maintenance_schedule->agreement->customer->organization_name;
                })
                ->addColumn('status_format', function (MaintenanceSchedule $maintenance_schedule) {
                    if ($maintenance_schedule->status == MaintenanceSchedule::STATUS_IN_PROGRESS) {
                        return '<span class="badge badge-warning">กำลังดำเนินการ</span>';
                    }
                })
                ->addColumn('action', function (MaintenanceSchedule $maintenance_schedule) {
                    $edit_time = '<a class="btn btn-default bg-white btn-xs" href="' . route('schedules.edit', ['schedule' => $maintenance_schedule->id]) . '"><i class="fa-fw fas fa-calendar-plus text-primary"></i> แก้ไขเวลา</a>';

                    $pm = '<a class="btn btn-default bg-white btn-xs" href="' . route('maintenances.product.index', ['maintenance' => $maintenance_schedule->id]) . '"><i class="fas fa-tasks text-primary"></i> PM </a>';
                    //     $delete = '<button class="btn btn-default bg-white btn-xs " onclick="deleteConfirmation(' . $maintenance_schedule->id . ');"><i class="fas fa-fw fa-trash text-danger"></i></button>';
                    return $edit_time . ' ' . $pm;
                })
                ->rawColumns(['technician_format', 'appointment_format', 'status_format', 'action'])
                ->make(true);
        }
        return view('maintenance.pm.index');
    }

}
