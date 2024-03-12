@extends('adminlte::page')

@section('title', 'ลงเวลา - เพิ่มข้อมูล')

@section('content_header')
    <div class="row">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark">
                <i class="fad fa-fw fa-calendar-plus"></i> ลงเวลา
            </h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{route('home')}}">หน้าแรก</a></li>
                {{--                <li class="breadcrumb-item"><a href="{{route('maintenances.index')}}">ข้อมูลการ PM</a></li>--}}
                <li class="breadcrumb-item active">ข้อมูลการลงเวลา</li>
            </ol>
        </div>
    </div>
@stop

@section('content')
    <div class="row">
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
                                    PM ครั้งที่
                                </th>
                                <th>
                                    เดือนที่ต้องเข้า PM
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
    </div>
@stop

@section('css')
@stop
@section('plugins.Datatables', true)
@section('plugins.Select2',true)

@section('js')
    <script>

        var table = $('#tableShow').DataTable({
            responsive: true,
            language: {
                url: "//cdn.datatables.net/plug-ins/1.10.20/i18n/Thai.json"
            },
            processing: true,
            serverSide: true,
            ajax: "{{route('schedules.index')}}",
            columns: [
                {data: 'DT_RowIndex', name: 'id'},
                {data: 'customer_pm_format', name: 'agreement.customer.organization_name'},
                {data: 'round_pm', name: 'round_pm'},
                {data: 'month_format', name: 'month_pm'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ],
            columnDefs: [],
        })

        function confirmSubmit() {
            Swal.fire({
                icon: 'info',
                title: 'การลงเวลา',
                text: 'ยืนยันการลงเวลา',
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
@stop
