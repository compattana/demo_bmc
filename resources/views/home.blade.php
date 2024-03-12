@extends('adminlte::page')

@section('title', 'หน้าแรก')

@section('content_header')
    <div class="row">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark">
                <i class="fa-duotone fa-fw fa-gauge-max"></i> แดชบอร์ด
            </h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item active"><a href="{{route('home')}}">หน้าแรก</a></li>
            </ol>
        </div>
    </div>
@stop
@section('content')
    @hasexactroles('technicians')
    <div class="row">
        <div class="col-12">
            <a href="{{ route('calendars.index') }}">
                <div class="small-box bg-gradient-info border ">
                    <div class="inner">
                        <h2 class="font-weight-bold">ตารางงาน</h2>
                        <p>&nbsp;</p>
                    </div>
                    <div class="icon">
                        <i class="fa-solid fa-calendar"></i>
                    </div>
                </div>
            </a>

        </div>
        <div class="col-6">
            <a href="{{ route('schedules.index', [ 'type' => 'maintenance_pm']) }}">
                <div class="small-box bg-gradient-primary border">
                    <div class="inner">
                        <h2 class="font-weight-bold">ลงเวลา </h2>
                        <p>(PM)</p>
                    </div>
                    <div class="icon">
                        <i class="fa-solid fa-calendar-clock"></i>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-6">
            <a href="{{ route('maintenances.index', [ 'type' => 'maintenance_pm']) }}">
                <div class="small-box bg-gradient-primary ">
                    <div class="inner">
                        <h2 class="font-weight-bold">ซ่อมบำรุง</h2>
                        <p>(PM)</p>
                    </div>
                    <div class="icon">
                        <i class="fa-solid fa-file-signature"></i>
                    </div>
                </div>
            </a>

        </div>
        <div class="col-6">
            <a href="{{ route('schedules_other', [ 'type' => 'general']) }}">
                <div class="small-box  bg-gradient-olive  border border-success">
                    <div class="inner">
                        <h2 class="font-weight-bold">ลงเวลา</h2>
                        <p>(นอกเหนือ PM)</p>
                    </div>
                    <div class="icon">
                        <i class="fa-solid fa-calendar-clock"></i>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-6">
            <a href="{{ route('schedules_other', [ 'type' => 'general']) }}">
                <div class="small-box bg-gradient-olive ">
                    <div class="inner">
                        <h2 class="font-weight-bold">ซ่อมบำรุง</h2>
                        <p>(นอกเหนือ PM)</p>
                    </div>
                    <div class="icon">
                        <i class="fa-solid fa-file-signature"></i>
                    </div>
                </div>
            </a>
        </div>
    </div>
    @else
        <div class="row">
            <div class="col-md-6">
                <div class="row">
                    <div class="col-lg-6 col-sm-6">
                        <div class="info-box bg-white">
                            <span class="info-box-icon" style="width: 150px">
                                <img src="{{asset('svg/man.svg')}}" width="100">
                            </span>
                            <div class="info-box-content">
                                <span class="info-box-text">ลูกค้าทั้งหมด</span>
                                <span class="info-box-number " style="font-size: 20px">{{$count_customer}}</span>
                                <div class="progress">
                                    <div class="progress-bar bg-gradient-light" style="width:100%">
                                    </div>
                                </div>
                                <span class=" progress-description">
                        <small><a href="{{ route('customers.index') }}">ดูข้อมูล <i
                                    class="fad fa-arrow-circle-right"></i></a></small>
                    </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6">
                        <div class="info-box bg-white">
                 <span class="info-box-icon" style="width: 150px">
                       <img src="{{asset('svg/agreement.svg')}}" width="100">
                 </span>
                            <div class="info-box-content">
                                <span class="info-box-text">สัญญาทั้งหมด</span>
                                <span class="info-box-number " style="font-size: 20px">{{$count_agreement}}</span>
                                <div class="progress">
                                    <div class="progress-bar bg-gradient-light" style="width:100%">
                                    </div>
                                </div>
                                <span class=" progress-description">
                        <small><a href="{{ route('agreements.index') }}">ดูข้อมูล <i
                                    class="fad fa-arrow-circle-right"></i></a></small>
                    </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6">
                        <div class="info-box bg-white">
                 <span class="info-box-icon" style="width: 150px">
                       <img src="{{asset('svg/schedule.svg')}}" width="100">
                 </span>
                            <div class="info-box-content">
                                <span class="info-box-text">รอการลงเวลา (PM)</span>
                                <span class="info-box-number text-orange"
                                      style="font-size: 20px">{{$count_schedule_pending}}</span>
                                <div class="progress">
                                    <div class="progress-bar bg-gradient-orange" style="width:100%">
                                    </div>
                                </div>
                                <span class=" progress-description">
                        <small><a href="{{ route('schedules.index') }}">ดูข้อมูล <i
                                    class="fad fa-arrow-circle-right"></i></a></small>
                    </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6">
                        <div class="info-box bg-white">
                            <div class="info-box-content">
                                <span class="info-box-text">รอดำเนินการเข้าซ่อม</span>
                                <div class="row">
                                    <div class="col-md-6">
                                    <span class="info-box-number text-primary"
                                          style="font-size: 12px">PM :
                                    <span class="info-box-number text-primary"
                                          style="font-size: 20px">{{$count_pm_schedule_progress}}</span></span>
                                        <div class="progress">
                                            <div class="progress-bar bg-gradient-primary" style="width:100%"></div>
                                        </div>
                                        <span class=" progress-description"><small><a
                                                    href="{{ route('maintenances.index') }}">ดูข้อมูล <i
                                                        class="fad fa-arrow-circle-right"></i></a></small></span>
                                    </div>
                                    <div class="col-md-6">
                                    <span class="info-box-number text-primary"
                                          style="font-size: 12px">นอกเหนือ PM : </span>
                                        <span class="info-box-number text-primary"
                                              style="font-size: 20px">{{$count_other_schedule_progress}}</span>
                                        <div class="progress">
                                            <div class="progress-bar bg-gradient-primary" style="width:100%"></div>
                                        </div>
                                        <span class=" progress-description"><small><a
                                                    href="{{ url('schedules_other?type=general') }}">ดูข้อมูล <i
                                                        class="fad fa-arrow-circle-right"></i></a></small></span>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">ผลรวมประจำเดือน
                            วันที่ {{\Carbon\Carbon::now()->translatedFormat('d F Y')}}</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="small-box bg-light border border-success">
                            <div class="inner">
                                <h4 class="font-weight-bold">{{$total_report_pm}}</h4>
                                <p>ใบรายงานช่าง (PM)</p>
                            </div>
                            <div class="icon">
                                <i class="fad fa-check"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="small-box bg-light border border-success">
                            <div class="inner">
                                <h4 class="font-weight-bold">{{$total_report_other}}</h4>
                                <p>ใบรายงานช่าง (นอกเหนือ PM)</p>
                            </div>
                            <div class="icon">
                                <i class="fad fa-check"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="small-box bg-light ">
                            <div class="inner">
                                <h4 class="font-weight-bold">{{$total_agreement}}</h4>
                                <p>สัญญาใหม่</p>
                            </div>
                            <div class="icon">
                                <i class="fad fa-alarm-clock"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="small-box bg-light ">
                            <div class="inner">
                                <h4 class="font-weight-bold">{{ number_format($different_agreement) }} </h4>
                                <p>จำนวนสัญญาในเดือน {{ \Carbon\Carbon::now()->subMonth(1)->translatedFormat('F') }}</p>
                            </div>
                            <div class="icon">
                                <i class="fa-solid fa-file-contract"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="card card-outline card-danger">
                    <div class="card-header">
                        <h3 class="card-title">
                            <img src="{{asset('svg/alert.svg')}}" width="25" class="mr-2">
                            <span class="align-middle">
                            สัญญาที่กำลังจะหมดอายุ
                        </span>

                        </h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-hover table-sm">
                            <thead>
                            <tr>
                                <th>
                                    #
                                </th>
                                <th>
                                    บริษัท
                                </th>
                                <th class="text-center">
                                    วันที่หมดสัญญา
                                </th>
                                <th class="text-center">
                                    คงเหลือ (วัน)
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @php
                                $i = 1
                            @endphp
                            @foreach($agreements_expire as $expire)
                                @if($expire->end_contract >= \Carbon\Carbon::now()->translatedFormat('Y-m-d'))
                                    <tr class='clickable-row'
                                        data-href='{{route('agreements.show', ['agreement' => $expire->id])}}'
                                        style="cursor: pointer;">
                                        <td>{{$i}}</td> @php $i++ @endphp
                                        <td>{{ \Illuminate\Support\Str::limit($expire->customer->organization_name,25) }}</td>
                                        <td class="text-center">{{ \Carbon\Carbon::parse($expire->end_contract)->translatedFormat('d F Y') }}</td>
                                        <td class="text-center">{{\Carbon\Carbon::parse($expire->end_contract)->diffInDays(\Carbon\Carbon::now()->translatedFormat('Y-m-d'))}} </td>
                                    </tr>
                                @endif
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card card-primary card-outline card-outline-tabs">
                    <div class="card-header p-0 border-bottom-0">
                        <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="custom-tabs-four-home-tab" data-toggle="pill"
                                   href="#custom-tabs-four-home" role="tab" aria-controls="custom-tabs-four-home"
                                   aria-selected="true">
                                    <img src="{{asset('svg/document.svg')}}" width="25" class="mr-2">
                                    <span class="align-middle">
                                   ใบ PM ล่าสุด
                        </span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="custom-tabs-four-profile-tab" data-toggle="pill"
                                   href="#custom-tabs-four-profile" role="tab" aria-controls="custom-tabs-four-profile"
                                   aria-selected="false"> <img src="{{asset('svg/checklist.svg')}}" width="25"
                                                               class="mr-2">
                                    <span class="align-middle">
                                นอกเหนือ PM ล่าสุด
                        </span></a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content" id="custom-tabs-four-tabContent">
                            <div class="tab-pane fade active show" id="custom-tabs-four-home" role="tabpanel"
                                 aria-labelledby="custom-tabs-four-home-tab">
                                <table class="table table-hover table-sm">
                                    <thead>
                                    <tr>
                                        <th>
                                            #
                                        </th>
                                        <th>
                                            บริษัท
                                        </th>
                                        <th class="text-center">
                                            ครั้งที่
                                        </th>
                                        <th class="text-center">
                                            วันที่เข้า
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php
                                        $i = 1
                                    @endphp
                                    @foreach($report_pm as $pm)
                                        <tr class='clickable-row'
                                            data-href='{{route('maintenances.product.pm.edit', ['maintenance' => $pm->maintenance_schedule_id, 'product' => $pm->agreement_item_id, 'pm' => $pm->id])}}'
                                            style="cursor: pointer;">
                                            <td>{{$i}}</td>@php $i++ @endphp
                                            <td>{{ \Illuminate\Support\Str::limit($pm->maintenanceSchedule->agreement->customer->organization_name,25) }}</td>
                                            <td class="text-center">{{ $pm->maintenanceSchedule->round_pm .'/'. $pm->maintenanceSchedule->agreement->contract }}</td>
                                            <td class="text-center">{{\Carbon\Carbon::parse($pm->date)->translatedFormat('d F Y')}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane fade" id="custom-tabs-four-profile" role="tabpanel"
                                 aria-labelledby="custom-tabs-four-profile-tab">
                                <table class="table table-hover table-sm">
                                    <thead>
                                    <tr>
                                        <th>
                                            #
                                        </th>
                                        <th>
                                            บริษัท
                                        </th>
                                        <th class="text-center">
                                            ประเภท
                                        </th>
                                        <th class="text-center">
                                            วันที่เข้า
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php
                                        $i = 1
                                    @endphp
                                    @foreach($report_other as $other)
                                        <tr class='clickable-row'
                                            data-href='{{route('maintenance_reports.show', ['maintenance_report' => $other->id])}}'
                                            style="cursor: pointer;">
                                            <td>{{$i}}</td> @php $i++ @endphp
                                            <td>{{ \Illuminate\Support\Str::limit($other->customer->organization_name,25) }}</td>
                                            <td class="text-center">
                                                @if( $other->type == \App\Models\TechnicianReport::TYPE_NO_CONTRACT )
                                                    <span class="badge badge-info">นอก contract</span>
                                                @elseif( $other->type == \App\Models\TechnicianReport::TYPE_EMERGENCY )
                                                    <span class="badge badge-danger">ฉุกเฉิน</span>
                                                @elseif( $other->type == \App\Models\TechnicianReport::TYPE_INSTALL )
                                                    <span class="badge badge-success">ติดตั้ง</span>
                                                @elseif( $other->type == \App\Models\TechnicianReport::TYPE_REWORK )
                                                    <span class="badge badge-secondary">Rework</span>
                                                @endif
                                            </td>
                                            <td class="text-center">{{\Carbon\Carbon::parse($other->date)->translatedFormat('d F Y')}}</td>
                                        </tr>

                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card card-outline card-orange">
                    <div class="card-header">
                        <h3 class="card-title">
                            <img src="{{asset('svg/schedule.svg')}}" width="25" class="mr-2">
                            <span class="align-middle">
                                    รอการลงเวลา (PM)
                                </span>
                        </h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-hover table-sm">
                            <thead>
                            <tr>
                                <th>
                                    #
                                </th>
                                <th>
                                    บริษัท
                                </th>
                                <th class="text-center">
                                    ครั้งที่
                                </th>
                                <th class="text-center">
                                    เดือนที่ต้องเข้า PM
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @php
                                $i = 1
                            @endphp
                            @foreach($schedules as $schedule)
                                <tr class='clickable-row'
                                    data-href='{{route('schedules.edit', ['schedule' => $schedule->id])}}'
                                    style="cursor: pointer;">
                                    <td>{{$i}}</td> @php $i++ @endphp
                                    <td>{{ \Illuminate\Support\Str::limit($schedule->agreement->customer->organization_name,25) }}</td>
                                    <td class="text-center">{{ $schedule->round_pm .'/'. $schedule->agreement->contract }}</td>
                                    <td class="text-center">{{\Carbon\Carbon::createFromFormat('Y-m-d', $schedule->month_pm)->translatedFormat('F Y')}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
        @endhasexactroles



@endsection
@section('js')
    <script>
        jQuery(document).ready(function ($) {
            $(".clickable-row").click(function () {
                window.location = $(this).data("href");
            });
        });
    </script>
@stop
