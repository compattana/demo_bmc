<!doctype html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <meta name="author" content="Meeting Creative"/>

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>
                @yield('title', 'ใบรายงานช่าง '.$maintenance_report->customer->organization_name)
    </title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/iCheck/1.0.3/skins/all.min.css">
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

        table {
            line-height: 2;
        }

        .table th, .table td {
            padding: 2px !important;
        }

        small, .small {
            font-size: 60%;
            font-weight: 400;
        }

        .border_bottom_dot {
            border-bottom: 1.5px dotted #bababa;
            color: #00F;
            -webkit-print-color-adjust: exact;
            margin-right: 15px;
        }

        .border_bottom_dot_white {
            color: #000;
            border-bottom: 3px solid #ffffff;
            display: inline-table;
            margin-bottom: -2px;
            margin-right: 5px;

        }

        .invoice-info {
            line-height: 2;
        }
    </style>
</head>
<body>

<div class="body-inner">
    <div class="p-5">
        <form
            action="{{route('maintenance_reports.update',['maintenance_report' => $maintenance_report->id,'type' => $type])}}"
            method="post" id="formUpdate" enctype="multipart/form-data">
            @csrf
            @method('patch')
            <div class="card card-primary card-outline card-outline-tabs">
                <div class="card-header p-0 border-bottom-0 no-print">
                    <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active " id="tabs-report" data-toggle="pill" href="#tabs-goto-report"
                               role="tab" aria-controls="tabs-goto-report"
                               aria-selected="true">ใบรายงานช่าง</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="tabs-pm" data-toggle="pill" href="#tabs-goto-pm"
                               role="tab"
                               aria-controls="tabs-goto-description"
                               aria-selected="false">ใบ Preventive Maintenance</a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content" id="custom-tabs-four-tabContent">
                        <div class="tab-pane fade show active" id="tabs-goto-report" role="tabpanel"
                             aria-labelledby="tabs-report">
                            @include('customer_view.partials.show.technician_report')
                        </div>
                        <div class="tab-pane fade" id="tabs-goto-pm" role="tabpanel"
                             aria-labelledby="tabs-pm">
                            @include('customer_view.partials.show.pm')
                        </div>
                    </div>
                </div>
            </div>
            @if (!auth()->user()->isTechnician())
                <div class="card card-outline card-blue no-print">
                    <div class="card-header">
                        <h3 class="card-title">อื่น ๆ</h3>
                        {{--                <div class="card-tools">--}}
                        {{--                    <button type="button" class="btn btn-tool" data-card-widget="collapse">--}}
                        {{--                        <i class="fas fa-minus"></i>--}}
                        {{--                    </button>--}}
                        {{--                </div>--}}
                    </div>
                    <div class="card-body">
                        <div class="border_bottom_dot">
                            <div class="border_bottom_dot_white"> หมายเหตุ :</div>
                            @if($technician_report_items->note == null)
                                @php
                                    $note = old('note') ;
                                @endphp
                            @else
                                @php
                                    $note = $technician_report_items->note;
                                @endphp
                            @endif
                            {{ $note }}
                        </div>
                        <br/>
                        <label for="note">หัวหน้างานตรวจสอบ <span class="text-danger">*</span> </label>
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group clearfix">
                                    <div class="icheck-primary d-inline">
                                        <input type="checkbox" id="ms" name="ms" disabled
                                               {{isset($technician_report_items->ms) && $technician_report_items->ms == 1 ? 'checked' : ''}} value="1">
                                        <label for="ms">
                                            M/S
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group clearfix">
                                    <div class="icheck-primary d-inline">
                                        <input type="checkbox" id="wty" name="wty" disabled
                                               {{isset($technician_report_items->wty) && $technician_report_items->wty == 1 ? 'checked' : ''}} value="1">
                                        <label for="wty">
                                            WTY
                                        </label>
                                    </div>

                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group clearfix">
                                    <div class="icheck-primary d-inline">
                                        <input type="checkbox" id="job_close" name="job_close" disabled
                                               {{isset($technician_report_items->job_close) && $technician_report_items->job_close == 1 ? 'checked' : ''}} value="1">
                                        <label for="job_close">
                                            Job Close
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group clearfix">
                                    <div class="icheck-primary d-inline">
                                        <input type="checkbox" id="file" name="file" disabled
                                               {{isset($technician_report_items->file) && $technician_report_items->file == 1 ? 'checked' : ''}} value="1">
                                        <label for="file">
                                            File
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group clearfix">
                                    <div class="icheck-primary d-inline">
                                        <input type="checkbox" id="ass" name="ass" disabled
                                               {{isset($technician_report_items->ass) && $technician_report_items->ass == 1 ? 'checked' : ''}} value="1">
                                        <label for="ass">
                                            Ass
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group clearfix">
                                    <div class="icheck-primary d-inline">
                                        <input type="checkbox" id="cust" name="cust" disabled
                                               {{isset($technician_report_items->cust) && $technician_report_items->cust == 1 ? 'checked' : ''}} value="1">
                                        <label for="cust">
                                            Cust
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group clearfix">
                                    <div class="icheck-primary d-inline">
                                        <input type="checkbox" name="other_check" id="other_check" disabled
                                               {{isset($technician_report_items->other_check) && $technician_report_items->other_check == 1 ? 'checked' : ''}} value="1">
                                        <label for="other_check">
                                            @if(isset($technician_report_items->other_detail) == null)
                                                @php
                                                    $other_detail = old('other_detail');
                                                @endphp
                                            @else
                                                @php
                                                    $other_detail = $technician_report_items->other_detail;
                                                @endphp
                                            @endif
                                            <div class="border_bottom_dot">{{$other_detail}}</div>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </form>
    </div>
</div>
<footer>
    <div class="text-right">
        <button type="button" class="btn btn-primary print-window no-print">
            <i class="fas fa-fw fa-duotone fa-print mr-2"></i>
            พิมพ์เอกสาร
        </button>
        <button type="button" class="btn btn-success print-window no-print">
            <i class="fas fa-fw fa-duotone fa-phone mr-2"></i>
            ติดต่อ BMC Techno Air
        </button>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/iCheck/1.0.3/icheck.min.js"></script>
<script>
    $('.print-window').click(function () {
        window.print();
    });

    function confirmSubmit() {
        Swal.fire({
            icon: 'info',
            title: 'เพิ่มข้อมูล',
            text: 'ยืนยันการเพิ่มข้อมูล',
            showCancelButton: true,
            confirmButtonText: 'ยืนยัน',
            cancelButtonText: 'ยกเลิก',
            showLoaderOnConfirm: true,
            animation: false,
            preConfirm: (e) => {
                return new Promise(function (resolve) {
                    $('#formUpdate').submit();
                })
            }
        })
    }
</script>
</body>
</html>
