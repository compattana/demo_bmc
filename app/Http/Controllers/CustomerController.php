<?php

namespace App\Http\Controllers;

use App\Mail\SendMail;
use App\Models\Agreement;
use App\Models\Customer;
use App\Models\MaintenanceSchedule;
use App\Models\TechnicianReport;
use Carbon\Carbon;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;


class CustomerController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Customer::query();
            return DataTables::eloquent($data)
                ->addIndexColumn()
                ->addColumn('status_format', function (Customer $customer) {
                    if ($customer->status == Customer::STATUS_ACTIVE) {
                        return '<span class="badge badge-success">ใช้งาน</span>';
                    } else {
                        return '<span class="badge badge-warning">ไม่ใช้งาน</span>';
                    }
                })
                ->addColumn('action', function (Customer $customer) {
                    $edit = '<a class="btn btn-default bg-white btn-xs" href="' . route('customers.edit', ['customer' => $customer->id]) . '"><i class="fas fa-fw fa-pen-to-square text-primary"></i> แก้ไข</a>';
                    $show = '<a class="btn btn-default bg-white btn-xs" href="' . route('customers.show', ['customer'=> $customer->id, 'name' => $customer->organization_name]) . '"><i class="fas fa-fw fa-solid fa-rectangle-history-circle-user text-primary"></i> แฟ้มข้อมูล</a>';

                    $show_customer = '<a class="btn btn-default bg-white btn-xs" href="' . route('preview', ['name'=> $customer->organization_name, 'token' => $customer->token]) . '"><i class="fas fa-fw fa-solid fa-rectangle-history-circle-user text-primary"></i> แฟ้มข้อมูล</a>';
                    $delete = '<button class="btn btn-default bg-white btn-xs " onclick="deleteConfirmation(' . $customer->id . ');"><i class="fas fa-fw fa-trash text-danger"></i>ลบ</button>';
                    return $show . ' ' . $edit . ' ' . $delete;
                })
                ->rawColumns(['status_format', 'action'])
                ->make(true);
        }
        return view('customer.index');
    }

    public function create()
    {
        return view('customer.create');
    }

    public function store(Request $request)
    {
        $rules = [
            'organization_name' => 'required',
        ];

        $messages = [
            'organization_name.required' => 'กรุณากรอกชื่อหน่วยงาน',
        ];

        $this->validate($request, $rules, $messages);

        $customer = new Customer();
        $customer->name = $request->name;
        $customer->organization_name = $request->organization_name;
        $customer->code = $request->code;
        $customer->status = $request->status;
        $customer->tel = $request->tel;
        $customer->email = $request->email;
        $customer->address = $request->address;
        $customer->tax_number = $request->tax_number;
        $customer->contact_name = $request->contact_name;
        $customer->contact_tel = $request->contact_tel;
        $customer->token = bcrypt(Str::random(50));
        if ($customer->save()) {
            alert()->success('สำเร็จ', 'เพิ่มข้อมูลเรียบร้อยแล้ว')->autoClose(0)->animation(false, false);
            return redirect()->route('customers.index');
        }
        return redirect()->refresh();
    }

    public function show(Customer $customer)
    {
//        $customer = Customer::query()->where('status', Customer::STATUS_ACTIVE)->where('token', $token)->first();

        $technician_report = $customer->technicianReport()->where('customer_id', $customer->id)->get();
        $agreements_all = $customer->agreements()->get();
        $agreements = $customer->agreements()->first();
        $schedules = '';
        if ($agreements != null) {
            $agreements_expire = Carbon::parse($agreements->end_contract)->diffInDays(\Carbon\Carbon::now()->translatedFormat('Y-m-d'));
            $schedules = MaintenanceSchedule::has('customer')->where('type', MaintenanceSchedule::TYPE_MAINTENANCE_PM)
                ->where('agreement_id', $agreements->id)
                ->where('status', MaintenanceSchedule::STATUS_PENDING)
                ->get();
        } else $agreements_expire = '';

        // ใบรายงานล่าสุด
        $report_pm = TechnicianReport::has('maintenanceSchedule.agreement')->where('customer_id', $customer->id)->where('type', TechnicianReport::TYPE_MAINTENANCE_PM)->orderBy('created_at', 'desc')->get();
        $report_other = TechnicianReport::has('customer')->where('customer_id', $customer->id)->where('type', '!=', TechnicianReport::TYPE_MAINTENANCE_PM)->orderBy('created_at', 'desc')->get();


        return view('customer.show', compact('customer', 'technician_report', 'agreements', 'agreements_expire',
            'schedules', 'report_other', 'report_pm', 'agreements_all'));
    }



    public function edit(Customer $customer)
    {
        return view('customer.edit', compact('customer'));
    }

    public function update(Request $request, Customer $customer)
    {
        $rules = [
            'organization_name' => 'required',
        ];

        $messages = [
            'organization_name.required' => 'กรุณากรอกชื่อหน่วยงาน',
        ];

        $this->validate($request, $rules, $messages);

        $customer->name = $request->name;
        $customer->organization_name = $request->organization_name;
        $customer->code = $request->code;
        $customer->status = $request->status;
        $customer->tel = $request->tel;
        $customer->email = $request->email;
        $customer->address = $request->address;
        $customer->tax_number = $request->tax_number;
        $customer->contact_name = $request->contact_name;
        $customer->contact_tel = $request->contact_tel;

        if ($customer->save()) {
            alert()->success('สำเร็จ', 'เพิ่มข้อมูลเรียบร้อยแล้ว')->autoClose(0)->animation(false, false);
            return redirect()->route('customers.index');
        }
        return redirect()->refresh();
    }

    public function destroy(Customer $customer, Request $request)
    {
        $status = false;
        $message = 'ไม่สามารถลบข้อมูลได้';
        if ($customer->delete()) {
            $status = true;
            $message = 'ลบข้อมูลเรียบร้อยแล้ว';
        }
        if ($request->ajax()) {
            return response()->json(['status' => $status, 'message' => $message]);
        } else {
            alert()->success('สำเร็จ', 'ลบข้อมูลเรียบร้อยแล้ว')->autoClose(0)->animation(false, false);
            return redirect()->route('agreements.index');
        }
    }
}
