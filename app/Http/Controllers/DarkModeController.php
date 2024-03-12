<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cookie;

class DarkModeController extends Controller
{
    public function setCookie(Request $request){
        $response = new Response('Set Darkmode');
//        $response;
//        return $response;
//        $response = new Response('Set Darkmode');
//        $cookie = Cookie::make('darkmode', 1, 1080,'/',env('app_url'),null,false);
//        alert()->success('สำเร็จ', 'เปลี่ยนรูปแบบการแสดงผลเรียบร้อยแล้ว [Dark Mode]')->autoClose(0)->animation(false, false);
        return redirect()->back()->withCookie(cookie('darkmode', 1,420));
    }

    public function deleteCookie(Request $request){
        $response = new Response('Set Darkmode');
//        $response->withCookie( Cookie::forget('darkmode'));
//        return $response;
//        alert()->success('สำเร็จ', 'เปลี่ยนรูปแบบการแสดงผลเรียบร้อยแล้ว [Bright Mode]')->autoClose(0)->animation(false, false);
        return redirect()->back()->withCookie(Cookie::forget('darkmode'));
    }
}
