@extends('adminlte::page')

@section('title', 'สัญญา')

@section('content_header')
    <div class="row">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark">
                <i class="fad fa-fw fa-file-signature"></i> เปิดสัญญา
            </h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{route('home')}}">หน้าแรก</a></li>
                <li class="breadcrumb-item active">สัญญา</li>
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
                        <p><u>ค้นหาสัญญา</u></p>
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
                                <div class="col-md-2">
                                    <label>ประเภทสัญญา</label>
                                    <div class="form-group">
                                        <select class="form-control select2" name="type" id="type">
                                            <option value="" selected>ทั้งหมด</option>
                                            @foreach( \App\Models\Agreement::type as $key => $type)
                                                <option @if($request_type == $key) selected
                                                        @endif value="{{$key}}">{{$type}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <label>สถานะสัญญา</label>
                                    <div class="form-group">
                                        <select class="form-control select2" name="status" id="status">
                                            <option value="" selected>ทั้งหมด</option>
                                            @foreach( \App\Models\Agreement::status as $key => $status)
                                                <option @if($request_status == $key) selected
                                                        @endif value="{{$key}}">{{$status}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3 pl-3">
                                    <label>&nbsp;</label>
                                    <div class="form-group">
                                        <a href="{{route('agreements.index')}}" class="btn btn-info"><i></i>
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
                <div class="card-header">
                    <div class="row">
                        <div class="col-6">
                            <a class="btn  btn-primary shadow" href="{{route('agreements.create')}}"><i class="fas fa-fw fa-plus"></i>
                                เพิ่มข้อมูล</a>
                        </div>
                        <div class="col-6 text-right">
                            <i class="fad fa-pen fa-fw text-warning"></i>แก้ไขข้อมูล
                            |
                            <i class="fad fa-eye fa-fw text-info"></i>ดูข้อมูล
                            |
                            <i class="fad fa-box fa-fw text-primary"></i>นำเข้าแฟ้มเอกสาร
                            |
                            <i class="fad fa-trash fa-fw text-danger"></i>ลบข้อมูล
                            @if (request()->get('archive')==1)
                            |
                            <a class="btn  btn-info shadow" href="{{route('agreements.index')}}"><i class="fad fa-fw fa-list"></i>
                                ทั้งหมด</a>
                            @else
                            |
                            <a class="btn  btn-info shadow" href="{{route('agreements.index',['archive'=>1])}}"><i class="fad fa-fw fa-box"></i>
                                แฟ้มเอกสาร</a>
                            @endif

                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-sm table-striped nowrap text-center" id="table" style="width: 100%">
                        <thead>
                        <tr>
                            <th>
                                #
                            </th>
                            <th>
                                ชื่อบริษัท
                            </th>
                            <th>
                                เลขที่สัญญา
                            </th>
                            <th>
                                ประเภทสัญญา
                            </th>
                            <th>
                                วันที่เริ่มสัญญา
                            </th>
                            <th>
                                วันที่หมดสัญญา
                            </th>
                            <th>
                                คงเหลือ (วัน)
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

        $('.select2').select2();

        $("#customer_id").change(function () {
            table.draw();
        });

        $("#status").change(function () {
            // console.log($('#status').val());
            table.draw();
        });

        $("#type").change(function () {
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
                url : "{{route('agreements.index')}}",
                headers: {'X-CSRF-Token': $('meta[name=_token]').attr('content')},
                data: {
                    archive: function() {
                        return '{{ request()->get('archive') }}'
                    },
                    customer_id: function () {
                        return $('#customer_id').val()
                    },
                    status: function () {
                        return $('#status').val()
                    },
                    type: function () {
                        return $('#type').val()
                    },
                }
            },
            columns: [
                {data: 'DT_RowIndex', name: 'id'},
                {data: 'company_format', name: 'customer.organization_name'},
                {data: 'code', name: 'code'},
                {data: 'type_format', name: 'contract_type', searchable: false},
                {data: 'start_contract_format', name: 'start_contract', searchable: false},
                {data: 'end_contract_format', name: 'end_contract', searchable: false},
                {data: 'agreement_expire_format', name: 'end_contract', searchable: false},
                // {data: 'status_format', name: 'status'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ],
            columnDefs: [],
        })

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
                            url: "{{url('agreements')}}/" + id,
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


        function archiveConfirmation(id) {
            Swal.fire({
                icon: 'info',
                title: 'ย้ายแข้าแฟ้มเอกสาร',
                text: 'ยืนยันการย้ายแฟ้มเอกสารหรือไม่',
                showCancelButton: true,
                confirmButtonText: 'ยืนยัน',
                cancelButtonText: 'ยกเลิก',
                showLoaderOnConfirm: true,
                animation: false,
                preConfirm: (e) => {
                    return new Promise(function (resolve) {
                        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                        $.ajax({
                            type: 'post',
                            url: "{{url('agreement/archive')}}/" + id,
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
