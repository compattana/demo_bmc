@extends('adminlte::page')

@section('title', 'บทบาทการใช้งาน')

@section('content_header')

    <div class="row">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark"> <i class="fas  fa-user-shield"></i> บทบาทการใช้งาน</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{route('home')}}">หน้าแรก</a></li>
                <li class="breadcrumb-item active">บทบาทการใช้งาน</li>
            </ol>
        </div>
    </div>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <a class="btn btn-outline-primary" href="{{route('roles.create')}}"><i class="fas fa-fw fa-plus "></i> เพิ่มข้อมูล</a>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-sm table-bordered" id="table" style="width: 100%">
                        <thead>
                        <tr>
                            <th class="text-center" style="width: 50px;max-width: 50px">
                                #
                            </th>
                            <th >
                                ชื่อ
                            </th>
                            <th style="width: 100px;max-width: 100px">
                                จัดการ
                            </th>
                        </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop
@section('plugins.Datatables', true)
@section('plugins.Sweetalert2', true)
@section('js')
    <script>
        var table = $('#table').DataTable({
            responsive: true,
            language: {
                url: "//cdn.datatables.net/plug-ins/1.10.20/i18n/Thai.json"
            },
            processing: true,
            serverSide: true,
            ajax: "{{route('roles.index')}}",
            columns: [
                {data: 'DT_RowIndex', name: 'id'},
                {data: 'title', name: 'title'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ],
            columnDefs: [
                { className: 'text-center', targets: [0,2] },
            ],
        })

        function deleteConfirmation(id){
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
                            url: "{{url('roles')}}/" + id,
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
                                        animation:false,
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
