@extends('adminlte::page')

@section('title', 'สัญญา - เพิ่มข้อมูล')

@section('content_header')
    <div class="row">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark">
                <i class="fad fa-fw fa-tasks"></i> ตารางการเข้า PM
            </h1>
        </div>
        <div class="col-sm-6">

            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{route('home')}}">หน้าแรก</a></li>
                {{--                <li class="breadcrumb-item"><a href="{{route('maintenances.index')}}">ข้อมูลการ PM</a></li>--}}
                <li class="breadcrumb-item active">ข้อมูลการ PM</li>
            </ol>
        </div>
    </div>

@stop

@section('content')
    <div class="row">
        <div class="col-sm-12 ">
            <div class="arrow-steps clearfix mb-3">
                <div class="step current"><span> <i class="fas fa-list-ul"></i> &nbsp;ข้อมูลการ PM </span></div>
                <div class="step"><span><i class="fas fa-toolbox"></i> &nbsp;Maintenance</span></div>
                <div class="step"><span><i class="fas fa-edit"></i>&nbsp; ใบรายงาน</span></div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-sm table-striped nowrap text-center" id="tableShow"
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
                                    วันที่ต้องเข้า PM
                                </th>
                                <th>
                                    PM ครั้งที่
                                </th>

                                {{--                            <th>--}}
                                {{--                                สถานะ--}}
                                {{--                            </th>--}}
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
    </div>
@stop


@section('css')
    <style>
        .arrow-steps .step {
            font-size: 14px;
            text-align: center;
            color: #666;
            cursor: default;
            margin: 0 3px;
            padding: 5px 5px 5px 10px;
            min-width: 180px;
            float: left;
            position: relative;
            background-color: #d9e3f7;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            transition: background-color 0.2s ease;
        }

        .arrow-steps .step:after,
        .arrow-steps .step:before {
            content: " ";
            position: absolute;
            top: 0;
            right: -17px;
            width: 0;
            height: 0;
            border-top: 14px solid transparent;
            border-bottom: 17px solid transparent;
            border-left: 17px solid #d9e3f7;
            z-index: 2;
            transition: border-color 0.2s ease;
        }

        .arrow-steps .step:before {
            right: auto;
            left: 0;
            border-left: 17px solid #fff;
            z-index: 0;
        }

        .arrow-steps .step:first-child:before {
            border: none;
        }

        .arrow-steps .step:first-child {
            border-top-left-radius: 4px;
            border-bottom-left-radius: 4px;
        }

        .arrow-steps .step span {
            position: relative;
        }

        .arrow-steps .step span:before {
            opacity: 0;
            content: "✔";
            position: absolute;
            top: -2px;
            left: -20px;
        }

        .arrow-steps .step.done span:before {
            opacity: 1;
            -webkit-transition: opacity 0.3s ease 0.5s;
            -moz-transition: opacity 0.3s ease 0.5s;
            -ms-transition: opacity 0.3s ease 0.5s;
            transition: opacity 0.3s ease 0.5s;
        }

        .arrow-steps .step.current {
            color: #fff;
            background-color: #23468c;
            cursor: pointer;
        }

        .arrow-steps .step.current:after {
            border-left: 17px solid #23468c;
        }
    </style>
@stop
@section('plugins.Datatables', true)
@section('js')
    <script>
        var table = $('#tableShow').DataTable({
            responsive: true,
            language: {
                url: "//cdn.datatables.net/plug-ins/1.10.20/i18n/Thai.json"
            },
            processing: true,
            serverSide: true,
            ajax: "{{route('maintenances.index')}}",
            columns: [
                {data: 'DT_RowIndex', name: 'id'},
                {data: 'customer_format', name: 'agreement.customer.organization_name'},
                {data: 'appointment_format', name: 'appointment_format'},
                {data: 'round_pm', name: 'round_pm'},
                // {data: 'status_format', name: 'status'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ],
            columnDefs: [],
        })

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
                        $('#formStore').submit();
                    })
                }
            })
        }
    </script>
@stop
