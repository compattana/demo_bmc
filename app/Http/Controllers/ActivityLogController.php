<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Spatie\Activitylog\Models\Activity;
use Illuminate\Http\Request;
use DataTables;

class ActivityLogController extends Controller
{
    public function index(Request $request)
    {

        if ($request->ajax()) {
            $data = Activity::query()->where('causer_id','!=',null);
            return DataTables::eloquent($data)
                ->addIndexColumn()
                ->addColumn('created_format', function (Activity $act) {
                    return Carbon::createFromFormat('Y-m-d H:i:s', $act->created_at)->translatedFormat('d F Y');
                })
                ->addColumn('description_format', function (Activity $act) {
                    if ($act->description=='created'){
                        return '<span class="badge badge-success">เพิ่มข้อมูล</span>';
                    }elseif($act->description=='updated'){
                        return '<span class="badge badge-warning">อัพเดตข้อมูล</span>';
                    }elseif($act->description=='deleted'){
                        return '<span class="badge badge-danger">ลบข้อมูล</span>';
                    }else{
                       return $act->description;
                    }
                })
                ->addColumn('causerBy', function (Activity $act) {

                    if ($act->causer_type!=''){
                        $user = $act->causer_type::find($act->causer_id);
                        return $user->name;
                    }else{
                        return '';
                    }

                })
                ->addColumn('data', function (Activity $act) {
                    $array = [
                        'id',
                        'created_at',
                        'updated_at',
                        'password',
                        'remember_token',
                        'two_factor_code',
                        'two_factor_expires_at',
                        'email_verified_at'
                    ];
                    $text_old = '';
                    $text_new = '';
                    if (count($act->properties)>0){
                        if (isset(json_decode($act->properties)->old)){
                            foreach (json_decode($act->properties)->old as $key => $value) {
                                if (in_array($key,$array)){
                                    continue;
                                }
                                $text_old.= '<li><strong>'.$key.'</strong> : '.$value.'&nbsp;&nbsp;&nbsp;'.'</li>';
                            }
                        }
                    }

                    if (count($act->properties)>0){
                        foreach (json_decode($act->properties)->attributes as $key => $value) {
                            if (in_array($key,$array)){
                                continue;
                            }
                            $text_new.= '<li><strong>'.$key.'</strong> : '.$value.'&nbsp;&nbsp;&nbsp;'.'</li>';
                        }
                    }

                    return '<button class="btn btn-info btn-xs modal_more" data-new="'.$text_new.'" data-old="'.$text_old.'"><i></i> เพิ่มเติม</button>';
                })
                ->addColumn('information', function (Activity $act) {
                    $text = '';
                    if ($act->subject_type!=''){
                        $text = $act->subject_type::INFO_DB;
                    }
                    return $text;
                })
                ->addColumn('created_format', function (Activity $act) {
                    return Carbon::createFromFormat('Y-m-d H:i:s', $act->created_at)->translatedFormat('d F Y H:i');
                })
                ->rawColumns(['information','description_format','data'])
                ->make(true);
        }
        return view('activities.index');
    }
}
