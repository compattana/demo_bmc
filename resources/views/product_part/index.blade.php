@extends('adminlte::page')

@section('title', 'อะไหล่')

@section('content_header')
    <div class="row">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark">
                <i class="fad fa-fw fa-puzzle-piece"></i> อะไหล่
            </h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{route('home')}}">หน้าแรก</a></li>
                <li class="breadcrumb-item active">อะไหล่</li>
            </ol>
        </div>
    </div>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <a class="btn  btn-outline-primary mb-2" href="{{route('product_parts.create')}}"><i class="fas fa-fw fa-plus"></i>
                เพิ่มข้อมูล</a>
            <div class="card">
                <div class="card-body">
                    <table class="table table-bordered table-sm table-striped nowrap text-center" id="table" style="width: 100%">
                        <thead>
                        <tr>
                            <th>
                                #
                            </th>
                            <th>
                                ชื่ออะไหล่
                            </th>
                            <th>
                                เลขที่อะไหล่
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
                <!-- /.card-body -->
            </div>
        </div>
    </div>

@stop

@section('css')
@stop
@section('plugins.Datatables', true)
@section('js')
    <script>

        var table = $('#table').DataTable({
            responsive: true,
            language: {
                url: "//cdn.datatables.net/plug-ins/1.10.20/i18n/Thai.json"
            },
            processing: true,
            serverSide: true,
            ajax: "{{route('product_parts.index')}}",
            columns: [
                {data: 'DT_RowIndex', name: 'id'},
                {data: 'title', name: 'title'},
                {data: 'part_no', name: 'part_no'},
                {data: 'status_format', name: 'status'},
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
                            url: "{{url('product_parts')}}/" + id,
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
