@extends('adminlte::page')

@section('title', 'ใบรายงานช่าง')

@section('content_header')
    <div class="row">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark">
                <i class="fad fa-fw fa-file-signature"></i> ข้อมูลการเข้าซ่อมบำรุง :
                @if( $type == \App\Models\MaintenanceSchedule::TYPE_NO_CONTRACT )
                    นอก Contract
                @elseif( $type == \App\Models\MaintenanceSchedule::TYPE_EMERGENCY )
                    ฉุกเฉิน
                @elseif( $type == \App\Models\MaintenanceSchedule::TYPE_INSTALL )
                    ติดตั้ง
                @elseif( $type == \App\Models\MaintenanceSchedule::TYPE_REWORK )
                    Rework
                @elseif( $type == \App\Models\MaintenanceSchedule::TYPE_OTHER )
                    งานอื่นๆ
                @endif
            </h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{route('home')}}">หน้าแรก</a></li>
                <li class="breadcrumb-item active">ใบรายงานช่าง</li>
            </ol>
        </div>
    </div>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            @if( $type == \App\Models\MaintenanceSchedule::TYPE_OTHER )
                <a class="btn  btn-outline-primary mb-2" href="{{route('schedule_others.create')}}"><i
                        class="fas fa-fw fa-plus"></i>
                    เพิ่มข้อมูล</a>
            @else
            <a class="btn  btn-outline-primary mb-2" href="{{route('schedules.create',['type'=> $type])}}"><i
                    class="fas fa-fw fa-plus"></i>
                เพิ่มข้อมูล</a>
            @endif
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-sm table-striped nowrap text-center" id="table"
                               style="width: 100%">
                            <thead>
                            <tr>
                                <th>
                                    #
                                </th>
                                <th>
                                    วันที่นัดเข้า PM
                                </th>
                                <th>
                                    ขื่อบริษัท
                                </th>
                                <th>
                                    หมายเหตุ
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
    </div>

    <div class="modal fade" tabindex="-1" role="dialog" id="showNote" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">หมายเหตุ</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p id="note"></p>
                </div>
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
            ajax: {
                url: "{{route('maintenance_reports.index')}}",
                data: {
                    type: '{{ $type }}'
                },
            },
            columns: [
                {data: 'DT_RowIndex', name: 'id'},
                {data: 'date_format', name: 'appointment_date'},
                {data: 'customer_format', name: 'customer.organization_name'},
                {data: 'note_format', name: 'maintenance_schedules.note', searchable: false},
                {data: 'status_format', name: 'status_format'},
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
                            url: "{{url('schedules')}}/" + id,
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

        $(document).ready(function () {
            $(document).on('click', '.showNote', function (){
                var note_id = $(this).val();
                console.log(note_id);
                $('#showNote').modal('show');

                $.ajax({
                    type: "GET",
                    url: "/showModal/" + note_id,
                    success: function (response) {
                        console.log(response)
                        document.getElementById("note").innerHTML = response.note;
                    }
                })
            });
        });

    </script>
@stop
