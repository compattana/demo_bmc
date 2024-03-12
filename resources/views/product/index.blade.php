@extends('adminlte::page')

@section('title', 'สินค้า')

@section('content_header')
    <div class="row">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark">
                <i class="fad fa-fw fa-box"></i>   สินค้า
{{--                <i class="fas fa-fw fa-shipping-fast"></i>  --}}
            </h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{route('home')}}">หน้าแรก</a></li>
                <li class="breadcrumb-item active">สินค้า</li>
            </ol>
        </div>
    </div>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <a class="btn  btn-outline-primary mb-2" href="{{route('products.create')}}"><i class="fas fa-fw fa-plus"></i>
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
                                ชื่อสินค้า
                            </th>
                            <th>
                                รหัสสินค้า
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
    <script src="https://cdn.lordicon.com/xdjxvujz.js"></script>
    <script>

        var table = $('#table').DataTable({
            responsive: true,
            language: {
                url: "//cdn.datatables.net/plug-ins/1.10.20/i18n/Thai.json"
            },
            processing: true,
            serverSide: true,
            ajax: "{{route('products.index')}}",
            columns: [
                {data: 'DT_RowIndex', name: 'id'},
                {data: 'title', name: 'title'},
                {data: 'code', name: 'code'},
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
                            url: "{{url('products')}}/" + id,
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
