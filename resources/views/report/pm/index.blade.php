@extends('adminlte::page')

@section('title', 'รายงานสรุปการเข้า PM')

@section('content_header')
    <div class="row">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark">
                <i class="fas fa-duotone fa-solid fa-file-chart-column"></i> รายงานสรุปการเข้า PM
            </h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{route('home')}}">หน้าแรก</a></li>
                <li class="breadcrumb-item active">รายงานสรุปการเข้า PM</li>
            </ol>
        </div>
    </div>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <blockquote class="quote-info ml-0 mr-0">
                        <p><u>สามารถเลือกดูรายงานสรุปตามประเภทการเข้า PM และวันที่เข้า PM ได้</u></p>
                    </blockquote>
                    <div class="col-md-12">
                        <form action="">
                            <div class="row">
                                <div class="col-md-3">
                                    <label>ชื่อลูกค้า</label>
                                    <div class="form-group">
                                        <select class="form-control select2" name="customer_id" id="customer_id">
                                            <option value="" selected>ทั้งหมด</option>
                                            @foreach($customers as $customer)
                                                <option @if($request_customer==$customer->id) selected
                                                        @endif value="{{$customer->id}}">{{$customer->organization_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label>ประเภทงาน</label>
                                    <div class="form-group">
                                        <select class="form-control select2" name="type" id="type">
                                            <option value="" selected>ทั้งหมด</option>
                                            @foreach( \App\Models\TechnicianReport::type as $key => $type)
                                                <option @if($request_type == $key) selected
                                                        @endif value="{{$key}}">{{$type}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label>สถานะงาน</label>
                                    <div class="form-group">
                                        <select class="form-control select2" name="status" id="status">
                                            <option value="" selected>ทั้งหมด</option>
                                            @foreach( \App\Models\TechnicianReport::status as $key => $status)
                                                <option @if($request_status == $key) selected
                                                        @endif value="{{$key}}">{{$status}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3"></div>
                                <div class="col-md-3">
                                    <label>รายชื่อช่าง</label>
                                    <div class="form-group">
                                        <select class="form-control select2" name="technician" id="technician">
                                            <option value="" selected>ทั้งหมด</option>
                                            @foreach( $technicians as $technician)
                                                <option @if($request_technician == $technician->id) selected
                                                        @endif value="{{$technician->id}}">{{$technician->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="">วันที่สั่งซื้อ</label>
                                        <div class="input-group" style="padding-top: 1px">
                                            <button type="button" class="w-100 btn btn-default btn-sm float-right"
                                                    id="daterange-record">
                                                <i class="fad fa-calendar-alt"></i> เลือกวันที่สั่งซื้อ
                                                <i class="fas fa-caret-down"></i>
                                            </button>
                                        </div>
                                        <input type="hidden" name="start" id="start">
                                        <input type="hidden" name="end" id="end">
                                    </div>
                                </div>
                                <div class="col-md-3 pl-3">
                                    <label>&nbsp;</label>
                                    <div class="form-group">
                                        <a href="{{route('reports_pm.index')}}" class="btn btn-info"><i></i>
                                            ดูทั้งหมด</a>
                                    </div>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <table class="table table-bordered table-sm table-striped nowrap text-center" id="table"
                           style="width: 100%">
                        <thead>
                        <tr>
                            <th>
                                #
                            </th>
                            <th>
                                ชื่อบริษัท
                            </th>
                            <th>
                                ประเภท
                            </th>
                            <th>
                                วันที่เข้าซ่อมบำรุง
                            </th>
                            <th>
                                สถานะ
                            </th>
                            <th>
                                จัดการ
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
@stop
@section('css')
    <style>
        .picker__select--month, .picker__select--year {
            border: 1px solid #b7b7b7;
            height: 2em;
            padding: 0em;
            margin-left: 0.25em;
            margin-right: 0.25em;
            text-align: center;
        }

    </style>
@stop
@section('plugins.Datatables', true)
@section('plugins.pickadatejs',true)
@section('plugins.Select2',true)
@section('plugins.momentjs',true)
@section('plugins.daterangpicker', true)
@section('js')
    <script>

        $('#daterange-record').daterangepicker({
                locale: {
                    format: 'DD-MM-YYYY',
                    daysOfWeek: [
                        "อา",
                        "จ",
                        "อ",
                        "พ",
                        "พฤ",
                        "ศ",
                        "ส"
                    ],
                    monthNames: [
                        "มกราคม",
                        "กุมภาพันธ์",
                        "มีนาคม",
                        "เมษายน",
                        "พฤษภาคม",
                        "มิถุนายน",
                        "กรกฎาคม",
                        "สิงหาคม",
                        "กันยายน",
                        "ตุลาคม",
                        "พฤศจิกายน",
                        "ธันวาคม"
                    ],
                },
                ranges: {
                    'วันนี้': [moment(), moment()],
                    'เมื่อวานนี้': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    '7 วันล่าสุด': [moment().subtract(6, 'days'), moment()],
                    '30 วันล่าสุด': [moment().subtract(29, 'days'), moment()],
                    'เดือนนี้': [moment().startOf('month'), moment().endOf('month')],
                    'เดือนที่แล้ว': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month')
                        .endOf(
                            'month')
                    ]
                },
                startDate: moment().subtract(29, 'days'),
                endDate: moment()
            },
            function (start, end) {
                $('#daterange-record').html(start.format('DD/MM/YYYY') + ' - ' + end.format('DD/MM/YYYY'))
                $('#start').val(start.format('YYYY-MM-DD'))
                $('#end').val(end.format('YYYY-MM-DD'))
                table.draw();
            }
        )
        $("#customer_id").change(function () {
            table.draw();
        });

        $("#status").change(function () {

            table.draw();
        });

        $("#type").change(function () {
            table.draw();
        });

        $("#technician").change(function () {
            table.draw();
        });


        var table = $('#table').DataTable({
            responsive: true,
            language: {
                url: "//cdn.datatables.net/plug-ins/1.10.20/i18n/Thai.json"
            },
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{route('reports_pm.index')}}",
                headers: {'X-CSRF-Token': $('meta[name=_token]').attr('content')},
                data: {
                    customer_id: function () {
                        return $('#customer_id').val()
                    },
                    status: function () {
                        return $('#status').val()
                    },
                    type: function () {
                        return $('#type').val()
                    },
                    technician: function () {
                        return $('#technician').val()
                    },
                    start_date: function () {
                        return $('#start').val()
                    },
                    end_date: function () {
                        return $('#end').val()
                    },
                }
            },
            columns: [
                {data: 'DT_RowIndex', name: 'id'},
                {data: 'customer_format', name: 'maintenanceSchedule.customer.organization_name'},
                {data: 'type_format', name: 'type'},
                {data: 'date_format', name: 'date'},
                {data: 'status_format', name: 'maintenanceSchedule.status'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ],
            columnDefs: [],
        })

        // calendar
        $('.datepicker').pickadate({
            formatSubmit: 'yyyy-mm-dd',
            selectMonths: true,
            selectYears: 60,
            // min: new Date,
        })

        $('.select2').select2();

        function deleteConfirmation(id) {
            Swal.fire({
                icon: 'info',
                title: 'ลบข้อมูล',
                text: 'ยืนยันการลบข้อมูล',
                showCancelButton: true,
                confirmButtonText: 'ยืนยัน',
                cancelButtonText: 'ยกเลิก',
                showLoaderOnConfirm: true,
                animation: false,
                preConfirm: (e) => {
                    return new Promise(function (resolve) {
                        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                        $.ajax({
                            type: 'DELETE',
                            url: "{{url('reports_pm')}}/" + id,
                            data: {_token: CSRF_TOKEN},
                            dataType: 'JSON',
                            success: function (results) {
                                if (results.status === true) {
                                    Swal.fire({
                                        icon: 'success',
                                        title: results.message,
                                        animation: false,
                                    })
                                    table.ajax.reload();
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: results.message,
                                        animation: false,
                                    })
                                }
                            }
                        });
                    })
                },
            })
        }

    </script>
@stop
