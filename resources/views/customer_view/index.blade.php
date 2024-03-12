<!doctype html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <meta name="author" content="Meeting Creative"/>

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>
        @yield('title',$customer->organization_name)
    </title>
    <!-- Stylesheets & Fonts -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.css">
    <link rel="stylesheet" href="{{ asset('fontawesome/css/all.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@200;400&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/ad8cf8f9e0.js" crossorigin="anonymous"></script>
    <style type="text/css">
        @import url('https://fonts.googleapis.com/css2?family=Sarabun:wght@500;700&display=swap');

        body {
            font-family: 'Sarabun', sans-serif !important;
            background-color: #f3f3f3;
            font-size: 14px;
        }

        footer {
            position: fixed;

            bottom: 0px;
            left: 0px;
            right: 0px;
            background-color: white;
            margin-bottom: 0px;
            padding: 10px;
        }
    </style>
</head>
<body>

<div class="body-inner">
    <div class="p-5">
        <div class="row">
            <div class="col-lg-6 col-sm-6">
                <div class="info-box bg-white">
                <span class="info-box-icon" style="width: 100px"><img src="{{asset('images/office-building.png')}}"
                                                                      width="50"></span>
                    <div class="info-box-content">
                        {{--                        <span class="info-box-text">ชื่อบริษัท</span>--}}
                        <span class="info-box-number " style="font-size: 20px">{{ $customer->organization_name }}</span> <span class="info-box-text">เบอร์โทรติดต่อ : {{ $customer->tel }}</span>
                        {{--                        <div class="progress">--}}
                        {{--                            <div class="progress-bar bg-gradient-light" style="width:100%"></div>--}}
                        {{--                        </div>--}}

                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-sm-6">
                <div class="info-box bg-white"><span class="info-box-icon" style="width: 100px"><img src="{{asset('svg/schedule2.svg')}}"
                                                                                                     width="50"></span>
                    <div class="info-box-content">
                        <span class="info-box-text">วันที่เริ่มสัญญา - วันที่จบสัญญา</span>
                        @if( $agreements == null)
                            <span class="info-box-number "
                                  style="font-size: 20px">ไม่มีสัญญา</span>
                        @else
                            <span class="info-box-number "
                                  style="font-size: 20px">{{ \Carbon\Carbon::parse($agreements->start_contract)->thaidate('d F Y') . ' - ' . \Carbon\Carbon::parse($agreements->end_contract)->thaidate('d F Y')}}</span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-sm-6 text-center">
                <div class="info-box bg-white">
                    <div class="info-box-content" style=" display: block !important;">
                        @if( $agreements == null)
                            <span>คงเหลือสัญญา : &nbsp; - วัน </span>
                        @else
                            <span class="info-box-text">คงเหลือสัญญา   </span>
                            @if( $agreements_expire <=60 && $agreements_expire > 30)
                                <span style="font-size: 20px; margin-top: 6px;"
                                      class="badge badge-warning">{{ $agreements_expire }} วัน</span>
                            @elseif($agreements_expire <= 30)
                                <span style="font-size: 20px; margin-top: 6px;"
                                      class=" badge badge-danger">{{ $agreements_expire }} วัน</span>
                            @else <span style="font-size: 20px; margin-top: 6px;" class="badge badge-success">{{ $agreements_expire }} วัน</span>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="card card-outline card-orange">
                    <div class="card-header">
                        <h3 class="card-title">
                            <img src="{{asset('svg/contract2.svg')}}" width="25" class="mr-2">
                            <span class="align-middle">ประวัติการทำสัญญา</span>
                        </h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-hover table-bordered table-sm" id="history">
                            <thead>
                            <tr>
                                <th>
                                    #
                                </th>
                                <th class="text-center">
                                    เลขที่
                                </th>
{{--                                <th class="text-center">--}}
{{--                                    ครั้ง/ปี--}}
{{--                                </th>--}}
                                <th class="text-center">
                                    สถานะ
                                </th>
                            </tr>
                            </thead>
                            <tbody class="text-center">
                            @php
                                $i = 1
                            @endphp
                            @if ($agreements == null)
                                <tr>
                                    <td colspan="4"> ไม่มีข้อมูล</td>
                                </tr>
                            @else
                                @foreach($agreements_all as $agreement)
                                    <tr class='clickable-row'
                                        data-href='{{ route('agreements', ['id' => $agreement->id,'name' => $agreement->customer->organization_name ,'token' => $agreement->customer->token]) }}'
                                        style="cursor: pointer;">
                                        <td>{{$i}}</td> @php $i++ @endphp
                                        <td class="text-center">{{ $agreement->code }}</td>
{{--                                        <td class="text-center">{{ $agreement->contract }}</td>--}}
                                        @if( \Carbon\Carbon::parse($agreement->end_contract) <= \Carbon\Carbon::now() )
                                            <td class="text-center">หมดสัญญา</td>
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
                            <img src="{{asset('svg/checklist2.svg')}}" width="25" class="mr-2">
                            <span class="align-middle">
                                    รอการลงเวลา (PM)
                                </span>
                        </h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-hover table-bordered table-sm" id="schedule">
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
                            <tbody class="text-center">
                            @php
                                $i = 1
                            @endphp
                            @if ($schedules == null)
                                <tr>
                                    <td colspan="3" style="text-align: center"> ไม่มีข้อมูล</td>
                                </tr>
                            @else
                                @foreach($schedules as $schedule)
                                    <tr>
                                        <td>{{$i}}</td> @php $i++ @endphp
                                        <td class="text-center">{{ $schedule->round_pm .'/'. $agreements->contract }}</td>
                                        <td class="text-center">{{\Carbon\Carbon::createFromFormat('Y-m-d', $schedule->month_pm)->translatedFormat('F Y')}}</td>
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
                                    <img src="{{asset('svg/contract3.svg')}}" width="25" class="mr-2">
                                    <span class="align-middle">
                                   ใบ PM ล่าสุด
                        </span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="custom-tabs-four-profile-tab" data-toggle="pill"
                                   href="#custom-tabs-four-profile" role="tab" aria-controls="custom-tabs-four-profile"
                                   aria-selected="false"> <img src="{{asset('svg/document2.svg')}}" width="25"
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
                                <table class="table table-hover table-bordered table-sm text-center" id="report_pm">
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
                                            data-href='{{route('reports', ['token' => $pm->customer->token,'maintenance' => $pm->maintenance_schedule_id, 'product' => $pm->agreement_item_id, 'pm' => $pm->id])}}'
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
                                <table class="table table-hover table-bordered table-striped table-sm text-center" id="report_other">
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
                                            data-href='{{route('reports', ['token' => $other->customer->token, 'maintenance_report' => $other->id])}}'
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
    </div>
</div>

<footer>
    <div class="text-right">
        <a href="tel:0622015054" class="btn btn-success"><i
                class="fas fa-duotone fa-fw fa-phone mr-2"></i>
            ติดต่อ BMC
        </a>
    </div>
</footer>

<script src="{{asset('js/client/jquery.js')}}"></script>
<script src="{{asset('js/client/plugins.js')}}"></script>
<!--Template functions-->
<script src="{{asset('js/client/functions.js')}}"></script>
<!-- jQuery Validate plugin files-->
<script src="{{asset('plugins/validate/validate.min.js')}}"></script>
<!-- jQuery Steps plugin files-->
<link href="{{asset('plugins/jquery-steps/jquery.steps.css')}}" rel="stylesheet">
<script src="{{asset('plugins/jquery-steps/jquery.steps.min.js')}}"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script src="{{asset('fontawesome/js/all.min.js')}}" crossorigin="anonymous"></script>
<script
    src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
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

</script>
</body>
</html>
