@extends('adminlte::page')

@section('title', 'ประวัติการเข้าใช้งาน')

@section('content_header')
    <div class="row">
        <div class="col-md-6">
            <h1 class="m-0 text-dark">
                <i class="fas nav-icon fa-fw fa-user-tag"></i> ประวัติการเข้าใช้งาน
            </h1>
        </div>
        <div class="col-md-6">
            <ol class="breadcrumb float-right">
                <li class="breadcrumb-item"><a href="{{route('home')}}">หน้าแรก</a></li>
                <li class="breadcrumb-item active">ประวัติการเข้าใช้งาน</li>
            </ol>
        </div>
    </div>


@stop

@section('content')
    @if(session()->get('success'))
        <div class="alert alert-success ">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            {{ session()->get('success') }}
        </div>
    @endif
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body table-responsive">
                    <table class="table table-striped nowrap table-sm" id="table" style="width: 100%">
                        <thead>
                        <tr>
                            <th>
                                #
                            </th>
                            <th style="min-width: 150px;">
                                Activity
                            </th>

                            <th>
                                ข้อมูล
                            </th>
                            <th style="min-width: 150px;">
                                โดย
                            </th>
                            <th style="min-width: 150px;">
                                วันที่บันทึก
                            </th>
                            <th>
                                ข้อมูลเพิ่มเติม
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

    <!-- /.modal more อ่านข้อมูลเพิ่มเติม -->
    <div class="modal fade" id="modal-more">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">ข้อมูล</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="modal-more-text">
                    <p><i class="fas fa-cube"></i> ข้อมูลก่อนหน้า</p>
                    <div id="data-old">

                    </div>
                    <hr>
                    <p><i class="fas fa-cube"></i> ข้อมูลปัจจุบัน</p>
                    <div id="data-new">

                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
                </div>
            </div>
        </div>
    </div>
    <!-- /.modal more อ่านข้อมูลเพิ่มเติม -->
@stop
@section('plugins.Datatables', true)
@section('plugins.Sweetalert2', true)
@section('js')
    <script>

        $(document).on('click', '.modal_more', function () {
            var data_new = $(this).data('new')
            var data_old = $(this).data('old')
            $('#data-new').html(data_new)
            $('#data-old').html(data_old)
            $('#modal-more').modal('show')
        });

        var table = $('#table').DataTable({
            responsive: true,
            language: {
                url: "//cdn.datatables.net/plug-ins/1.10.20/i18n/Thai.json"
            },
            processing: true,
            serverSide: true,
            ajax: "{{route('activities.index')}}",
            columns: [
                {data: 'DT_RowIndex', name: 'id'},
                {data: 'description_format', name: 'description'},
                {data: 'information', name: 'information'},
                {data: 'causerBy', name: 'causerBy'},
                {data: 'created_format', name: 'created_format'},
                {data: 'data', name: 'data'},
            ],
            order: [[0, 'desc']]
        })
    </script>
@endsection
