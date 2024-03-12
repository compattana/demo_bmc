@extends('adminlte::page')

@section('title', 'Permissions')

@section('content_header')
    <div class="row">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark">Permissions</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{route('home')}}">หน้าแรก</a></li>
                <li class="breadcrumb-item active">Permissions</li>
            </ol>
        </div>
    </div>
@stop

@section('content')

    <div class="row">
        <div class="col-md-12">
            <a class="btn btn-lg btn-flat mb-2 btn-info" href="{{route('permissions.create')}}"><i class="fas fa-plus mr-2"></i>Add</a>
            <div class="card">
                <div class="card-body">
                    <table class="table table-striped table-sm" id="table" style="width: 100%">
                        <thead>
                        <tr>
                            <th style="width: 50px">
                                #
                            </th>
                            <th>
                                permission
                            </th>
                            <th>
                                description
                            </th>
                            <th>
                                guard name
                            </th>
                            <th style="width: 150px;">

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
            // language: {
            //     url: "//cdn.datatables.net/plug-ins/1.10.20/i18n/Thai.json"
            // },
            processing: true,
            serverSide: true,
            ajax: "{{route('permissions.index')}}",
            columns: [
                {data: 'DT_RowIndex', name: 'id'},
                {data: 'name', name: 'name'},
                {data: 'description', name: 'description'},
                {data: 'guard_name', name: 'guard_name'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ],
            columnDefs: [
                { className: 'text-center', targets: [3,4] },
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
                            url: "{{url('permissions')}}/" + id,
                            data: {_token: CSRF_TOKEN},
                            dataType: 'JSON',
                            success: function (results) {
                                if (results.status === true) {
                                    Swal.fire({
                                        icon: 'success',
                                        title: results.message,
                                        animation:false,
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

