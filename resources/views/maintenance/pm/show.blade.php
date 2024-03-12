@extends('adminlte::page')

@section('title', 'สัญญา')

@section('content_header')

    <div class="row">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark">
                <i class="fad fa-solid fa-ballot-check"></i> ข้อมูลการเข้า PM
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

    <div class="">
        <div class="arrow-steps clearfix mb-3">
            <div class="step"><span> <i class="fas fa-list-ul"></i> &nbsp;<a
                        href="{{route('maintenances.index')}}">ข้อมูลการเข้า PM</a></span></div>
            <div class="step current"><span><i class="fas fa-toolbox"></i> &nbsp;Maintenance</span></div>
            <div class="step"><span><i class="fas fa-edit"></i>&nbsp; ใบรายงาน</span></div>
        </div>
    </div>

    <blockquote class="quote-info ml-0 mr-0">
        <p><b>เลขที่สัญญา : </b>{{ $maintenance->agreement->code }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <b>ชื่อบริษัท : </b>{{ $maintenance->agreement->customer->organization_name }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>PM
                ครั้งที่ : </b>{{ $maintenance->round_pm }}</p>
    </blockquote>

    <div class="row">
        <div class="col-md-3">
            <div class="card card-outline card-info">
                <div class="card-header">
                    <h3 class="card-title">เลือกสินค้าที่ต้องการเข้า PM</h3>
                </div>
                <div class="card-body">
                    @foreach($agreement_items as $item)
                        @if($item->product_serial_id == null || $item->product_id == null)
                        @else
                            <a href="{{ route('maintenances.product.pm.create', ['maintenance' => $maintenance->id,'product'=>$item->id] ) }}"
                               class="btn btn-outline-primary btn-block" value="{{$item->id}}">
                                สินค้า {{$item->product->title }} /
                                หมายเลขเครื่อง {{$item->productSerial->serial_name ?? " " }}
                            </a>
                        @endif
                    @endforeach
                </div>
            </div>
            <!-- /.card-body -->
        </div>
        <div class="col-md-9">
            <div class="card">
                <div class="card-body">
                    <table class="table table-bordered table-sm table-striped nowrap text-center" id="tableReport"
                           style="width: 100%">
                        <thead>
                        <tr>
                            <th>
                                #
                            </th>
                            <th>
                                วันที่เข้า PM
                            </th>
                            <th>
                                สินค้าที่เข้า PM
                            </th>
                            <th>
                                สถานะ
                            </th>
                            <th>
                                สถานะการตรวจงาน
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
@endsection
@section('css')

    <style>
        .arrow-steps .step {
            font-size: 14px;
            text-align: center;
            color: #666;
            cursor: pointer;
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
@section('plugins.Select2', true)
@section('plugins.Datatables', true)
@section('js')
    <script>

        $('.select2').select2({
            width: '100%'
        });



        var table = $('#tableReport').DataTable({
            responsive: true,
            language: {
                url: "//cdn.datatables.net/plug-ins/1.10.20/i18n/Thai.json"
            },
            processing: true,
            serverSide: true,
            ajax: "{{route('maintenances.product.index', ['maintenance' => $maintenance->id])}}",
            columns: [
                {data: 'DT_RowIndex', name: 'id'},
                {data: 'date_format', name: 'date_format'},
                {data: 'product_format', name: 'product_format'},
                {data: 'status_format', name: 'status'},
                {data: 'status_lead_check_format', name: 'status_report'},
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
                            url: "{{route('maintenances.product.index', ['maintenance' => $maintenance->id])}}/" + id,
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
@endsection
