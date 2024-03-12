@extends('adminlte::page')

@section('title', 'ลูกค้า - แก้ไขข้อมูล')

@section('content_header')
    <div class="row">
        <div class="col-sm-6">
{{--            <h1 class="m-0 text-dark">--}}
{{--                <i class="fad fa-fw fa-person-booth"></i> ลูกค้า {{$customer->organization_name}}--}}
{{--            </h1>--}}
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{route('home')}}">หน้าแรก</a></li>
                <li class="breadcrumb-item"><a href="{{route('customers.index')}}">จัดการลูกค้า</a></li>
                <li class="breadcrumb-item active">แก้ไขข้อมูล - {{$customer->organization_name}}</li>
            </ol>
        </div>
    </div>
@stop

@section('content')

    <div class="row">
        <div class="col-lg-6 col-sm-6">
            <div class="info-box bg-white">
                <span class="info-box-icon" style="width: 100px"><img src="{{asset('images/office-building.png')}}"
                                                                      width="50"></span>
                <div class="info-box-content">
                    <span class="info-box-text">ชื่อบริษัท</span>
                    <span class="info-box-number " style="font-size: 20px">{{ $customer->organization_name }}</span>
                    <div class="progress">
                        <div class="progress-bar bg-gradient-light" style="width:100%"></div>
                    </div>
                    <span class=" progress-description">
                       <p>เบอร์โทรติดต่อ : {{ $customer->tel }}</p>
                    </span>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-sm-6">
            <div class="info-box bg-white">
                {{--                <span class="info-box-icon" style="width: 150px"><img src="{{asset('images/office-building.png')}}"--}}
                {{--                                                                      width="90"></span>--}}
                <div class="info-box-content">
                    <span class="info-box-text">วันที่เริ่มสัญญา - วันที่จบสัญญา</span>
                    @if( $agreements == null)
                        <span class="info-box-number "
                              style="font-size: 20px">ไม่มีสัญญา</span>
                    @else
                        <span class="info-box-number "
                              style="font-size: 20px">{{ \Carbon\Carbon::parse($agreements->start_contract)->thaidate('d/m/Y') . ' - ' . \Carbon\Carbon::parse($agreements->end_contract)->thaidate('d/m/Y')}}</span>
                    @endif
                    <div class="progress">
                        <div class="progress-bar bg-gradient-light" style="width:100%"></div>
                    </div>
                    <span class=" progress-description">
                         @if( $agreements == null)
                            <p>คงเหลือสัญญา : &nbsp; - วัน </p>
                        @else
                            <p>คงเหลือสัญญา : &nbsp;
                           @if( $agreements_expire <=60 && $agreements_expire > 30)
                                    <span style="font-size: 100%" class="badge badge-warning">{{ $agreements_expire }} วัน</span>
                                @elseif($agreements_expire <= 30)
                                    <span style="font-size: 100%" class="badge badge-danger">{{ $agreements_expire }} วัน</span>
                                @else <span style="font-size: 100%" class="badge badge-success">{{ $agreements_expire }} วัน</span>
                                @endif
                       </p>
                        @endif
                    </span>
                </div>
            </div>
        </div>
        <div class="col-lg-2 col-sm-6">
            <div class="info-box bg-white">
                {{--                <span class="info-box-icon" style="width: 150px"><img src="{{asset('images/office-building.png')}}" width="90"></span>--}}
                <div class="info-box-content">
                    <span class="info-box-text text-center">ลิงค์สำหรับลูกค้า</span>
                    <span class="info-box-number text-center" style="font-size: 20px">
{{--                        {!! QrCode::size(80)->generate(route('customers.show', ['customer' => $customer->id, 'name' => $customer->organization_name,'code' => $customer->code])) !!}--}}
                    </span>
                    <div class="progress">
                        <div class="progress-bar bg-gradient-light" style="width:100%"></div>
                    </div>
                    <span class=" progress-description text-center">
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <form method="post"
                                      action="{{route('sendmail', ['email' => $customer->email, 'name'=> $customer->organization_name, 'token' => $customer->token])}}"
                                      enctype="multipart/form-data" id="formSendMail">
                                    @csrf
                                    <input type="submit" name="send" onclick="confirmSendMail()" class="btn btn-outline-success" value="Send Link"/>
                                </form>
                            </div>
                            <div class="col-md-12 text-center pt-2">
                                <input style="display:none" type="text"
                                       value="{{route('preview',['name'=>$customer->organization_name, 'token'=>$customer->token])}}"
                                       id="myInput">
                                <button class="btn btn-outline-primary" onclick="myFunction()">Copy Link</button>
                            </div>



{{--                        <input type="hidden"--}}
                            {{--                               value="{{route('customers.show', ['customer' => $customer->id, 'name' => $customer->organization_name,'code' => $customer->code])}}"--}}
                            {{--                               id="myInput">--}}

                        </div>

                    </span>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-3">
            <div class="card card-outline card-orange">
                <div class="card-header">
                    <h3 class="card-title">
                        <img src="{{asset('svg/schedule.svg')}}" width="25" class="mr-2">
                        <span class="align-middle">ประวัติการทำสัญญา</span>
                    </h3>
                </div>
                <div class="card-body">
                    <table class="table table-hover table-sm" id="history">
                        <thead>
                        <tr>
                            <th>
                                #
                            </th>
                            <th class="text-center">
                                เลขที่
                            </th>
                            <th class="text-center">
                                ครั้ง/ปี
                            </th>
                            <th class="text-center">
                                สถานะ
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @php
                            $i = 1
                        @endphp
                        @if ($agreements == null)
                            <tr>
                                <td colspan="4" style="text-align: center"> ไม่มีข้อมูล</td>
                            </tr>
                        @else
                            @foreach($agreements_all as $agreement)
                                <tr class='clickable-row'
                                    data-href='{{route('agreements.show', ['agreement' => $agreement->id])}}'
                                    style="cursor: pointer;">
                                    <td>{{$i.'.'}}</td> @php $i++ @endphp
                                    <td class="text-center">{{ $agreement->code }}</td>
                                    <td class="text-center">{{ $agreement->contract }}</td>
                                    @if( \Carbon\Carbon::parse($agreement->end_contract) <= \Carbon\Carbon::now()->translatedFormat('Y-m-d') )
                                        <td class="text-center"><span style="font-size: 100%"
                                                                      class="badge badge-danger"> หมดอายุ</span></td>
                                    @else
                                        <td class="text-center">คงเหลือ <span style="font-size: 100%"
                                                                              class="badge badge-success">{{\Carbon\Carbon::parse($agreement->end_contract)->diffInDays(\Carbon\Carbon::now()->translatedFormat('Y-m-d'))}} วัน</span>
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-3">
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
                    <table class="table table-hover table-sm" id="schedule">
                        <thead>
                        <tr>
                            <th>
                                #
                            </th>
                            <th class="text-center">
                                ครั้งที่
                            </th>
                            <th class="text-center">
                                เดือนที่ต้องเข้า
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @php
                            $i = 1
                        @endphp
                        @if ($schedules == null)
                            <tr>
                                <td colspan="3" style="text-align: center"> ไม่มีข้อมูล</td>
                            </tr>
                        @else
                            @foreach($schedules as $schedule)
                                <tr class='clickable-row'
                                    data-href='{{route('schedules.edit', ['schedule' => $schedule->id])}}'
                                    style="cursor: pointer;">
                                    <td>{{$i.'.'}}</td> @php $i++ @endphp
                                    <td class="text-center">{{ $schedule->round_pm .'/'. $agreements->contract }}</td>
                                    <td class="text-center">{{\Carbon\Carbon::createFromFormat('Y-m-d', $schedule->month_pm)->translatedFormat('M y')}}</td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-6">
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
                            <table class="table table-hover table-sm" id="report_pm">
                                <thead>
                                <tr>
                                    <th>
                                        #
                                    </th>
                                    <th class="text-center">
                                        ครั้งที่
                                    </th>
                                    <th class="text-center">
                                        วันที่เข้า
                                    </th>
                                    <th>
                                        สถานะ
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
                                        <td>{{$i.'.'}}</td>@php $i++ @endphp
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
                            <table class="table table-hover  table-striped table-sm" id="report_other">
                                <thead>
                                <tr>
                                    <th>
                                        #
                                    </th>
                                    <th>
                                        สถานะ
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
                                        <td>{{$i.'.'}}</td> @php $i++ @endphp
                                        <td>{{$other->status_report }}</td>
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

    </div>

@stop

@section('footer')
@endsection

@section('css')
@stop

@section('plugins.Datatables', true)
@section('js')
    <script>
        $('#report_pm').DataTable();
        $('#report_other').DataTable();
        $('#history').DataTable({
            searching: false, info: false
        });
        $('#schedule').DataTable({
            searching: false, info: false
        });

        jQuery(document).ready(function ($) {
            $(".clickable-row").click(function () {
                window.location = $(this).data("href");
            });
        });

        function myFunction() {
            /* Get the text field */
            var copyText = document.getElementById("myInput");
            /* Select the text field */
            copyText.select();
            copyText.setSelectionRange(0, 99999); /* For mobile devices */
            /* Copy the text inside the text field */
            navigator.clipboard.writeText(copyText.value);
            /* Alert the copied text */
            // alert("Copied the text: " + copyText.value);
        }

        function confirmSendMail() {
            Swal.fire({
                icon: 'success',
                title: 'ลิงค์ข้อมูลสำหรับลูกค้า',
                text: 'ยืนยันการส่งอีเมลล์หาลูกค้า',
                showCancelButton: true,
                confirmButtonText: 'ยืนยัน',
                cancelButtonText: 'ยกเลิก',
                showLoaderOnConfirm: true,
                animation: false,
                preConfirm: (e) => {
                    return new Promise(function (resolve) {
                        $('#formSendMail').submit();
                    })
                }
            })
        }

    </script>
@stop
