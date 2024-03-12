@extends('adminlte::page')

@section('title', 'ประเภทงาน : งานอื่นๆ - ดูข้อมูล')

@section('content_header')
    <div class="row">
        <div class="col-md-6">
            <h1 class="m-0 text-dark">
                <i class="fad fa-fw fa-calendar-plus"></i> ประเภทงาน : งานอื่นๆ
            </h1>
        </div>
        <div class="col-md-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">หน้าแรก</a></li>
                <li class="breadcrumb-item">
                    <a href="{{ route('maintenance_reports.index', ['type' => $type]) }}">
                        ตารางการเข้าซ่อม : งานอื่นๆ
                    </a>
                </li>
                <li class="breadcrumb-item active">ตรวจสอบงาน</li>
            </ol>
        </div>
    </div>
@stop
@push('css')
    <style>
        table {
            line-height: 2;
        }

        .table th,
        .table td {
            padding: 2px !important;
        }

        small,
        .small {
            font-size: 60%;
            font-weight: 400;
        }

        .border_bottom_dot {
            border-bottom: 1.5px dotted #bababa;
            color: #00F;
            -webkit-print-color-adjust: exact;
            margin-right: 15px;
        }

        .border_bottom_dot_white {
            color: #000;
            border-bottom: 3px solid #ffffff;
            display: inline-table;
            margin-bottom: -2px;
            margin-right: 5px;

        }

        .invoice-info {
            line-height: 2;
        }
    </style>
@endpush

@section('content')
    <div class="d-flex justify-content-center">
        <div class="col-10">
            <div class="card">
                <div class="card-body">
                    <section class="content">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-12">
                                    <h4>
                                        <img class="img-fluid " src="{{ asset('/logo/BMC-logo.png') }}"
                                            style="border: white" width="10%">
                                        <small class="float-right mt-2">Technoair Service+</small>
                                    </h4>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <h3 class="text-center">
                                        ใบรายงานช่าง
                                    </h3>
                                </div>
                            </div>
                            <br />
                            <div class="row invoice-info">
                                <div class="col-12 col-xl-4 invoice-col mt-3">
                                    <div class="border_bottom_dot">
                                        <div class="border_bottom_dot_white"> วันที่ :</div>
                                        @if ($schedule->appointment_date == null)
                                            @php
                                                $date = old('date');
                                            @endphp
                                        @else
                                            @php
                                                $date = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $schedule->appointment_date)->translatedFormat('d F Y');
                                            @endphp
                                        @endif
                                        {{ $date }}
                                    </div>
                                </div>
                                <div class="col-12 col-xl-4 invoice-col mt-3">
                                    <div class="border_bottom_dot">
                                        <div class="border_bottom_dot_white"> ชื่อลูกค้า :</div>
                                        @if (empty($schedule_other->customer_name))
                                            @php
                                                $customer = old('customer_name');
                                            @endphp
                                        @else
                                            @php
                                                $customer = $schedule_other->customer_name;
                                            @endphp
                                        @endif
                                        {{ $customer }}
                                    </div>
                                </div>
                                <div class="col-12 col-xl-4 invoice-col mt-3">
                                    <div class="border_bottom_dot">
                                        <div class="border_bottom_dot_white"> ชื่อบริษัท :</div>
                                        @if (empty($schedule_other->organization_name))
                                            @php
                                                $organization_name = old('organization_name');
                                            @endphp
                                        @else
                                            @php
                                                $organization_name = $schedule_other->organization_name;
                                            @endphp
                                        @endif
                                        {{ $organization_name }}
                                    </div>
                                </div>
                                <div class="col-12 col-xl-4 invoice-col mt-3">
                                    <div class="border_bottom_dot">
                                        <div class="border_bottom_dot_white"> ช่างผู้ดูแล :</div>
                                        @foreach ($technicians as $technician)
                                            {{ $technician->user->name }},
                                        @endforeach
                                    </div>
                                </div>
                                <div class="col-4 col-xl-2 invoice-col mt-3">
                                    <div class="border_bottom_dot">
                                        <div class="border_bottom_dot_white"> รถบริการ No :</div>
                                        @if (empty($schedule_other->car_no))
                                            @php
                                                $car_no = old('car_no');
                                            @endphp
                                        @else
                                            @php
                                                $car_no = $schedule_other->car_no;
                                            @endphp
                                        @endif
                                        {{ $car_no }}
                                    </div>
                                </div>
                                <div class="col-4 col-xl-3 invoice-col mt-3">
                                    <div class="border_bottom_dot">
                                        <div class="border_bottom_dot_white"> รุ่น :</div>
                                        @if (empty($schedule_other->product_model))
                                            @php
                                                $product_name = old('product_model');
                                            @endphp
                                        @else
                                            @php
                                                $product_name = $schedule_other->product_model;
                                            @endphp
                                        @endif
                                        {{ $product_name }}
                                    </div>
                                </div>
                                <div class="col-4 col-xl-3 invoice-col mt-3">
                                    <div class="border_bottom_dot">
                                        <div class="border_bottom_dot_white"> หมายเลขเครื่อง :</div>
                                        @if (empty($schedule_other->product_number))
                                            @php
                                                $product_number = old('product_number');
                                            @endphp
                                        @else
                                            @php
                                                $product_number = $schedule_other->product_number;
                                            @endphp
                                        @endif
                                        {{ $product_number }}
                                    </div>
                                </div>
                                <div class="col-xl-12 invoice-col mt-3">
                                    <div class="border_bottom_dot">
                                        <div class="border_bottom_dot_white"> รายละเอียด :</div>
                                        @if ($schedule->note == null)
                                            @php
                                                $note = old('note');
                                            @endphp
                                        @else
                                            @php
                                                $note = $schedule->note;
                                            @endphp
                                        @endif
                                        {{ $note }}
                                    </div>
                                </div>
                                <div class="col-6 col-xl-3 invoice-col mt-3">
                                    <div class="border_bottom_dot">
                                        <div class="border_bottom_dot_white"> เวลาทำงานปกติ :</div>
                                        @if (empty($schedule_other->normal_start_time))
                                            @php
                                                $normal_start_time = old('normal_start_time');
                                            @endphp
                                        @else
                                            @php
                                                $normal_start_time = \Carbon\Carbon::createFromFormat('H:i:s', $schedule_other->normal_start_time)->translatedFormat('H:i');
                                            @endphp
                                        @endif
                                        @if (empty($schedule_other->normal_end_time))
                                            @php
                                                $normal_end_time = old('normal_end_time');
                                            @endphp
                                        @else
                                            @php
                                                $normal_end_time = \Carbon\Carbon::createFromFormat('H:i:s', $schedule_other->normal_end_time)->translatedFormat('H:i');
                                            @endphp
                                        @endif
                                        {{ $normal_start_time }} - {{ $normal_end_time }} น.
                                    </div>
                                </div>
                                <div class="col-6 col-xl-3 invoice-col mt-3">
                                    <div class="border_bottom_dot">
                                        <div class="border_bottom_dot_white"> รวม :</div>
                                        @if (empty($schedule_other->total_normal_work_time))
                                            @php
                                                $total_normal_work_time = old('total_normal_work_time');
                                            @endphp
                                        @else
                                            @php
                                                $total_normal_work_time = $schedule_other->total_normal_work_time;
                                            @endphp
                                        @endif
                                        {{ $total_normal_work_time }} ชั่วโมง
                                    </div>
                                </div>
                                <div class="col-6 col-xl-3 invoice-col mt-3">
                                    <div class="border_bottom_dot">
                                        <div class="border_bottom_dot_white"> เวลาทำงานล่วงเวลา :</div>
                                        @if (empty($schedule_other->ot_start_time))
                                            @php
                                                $ot_start_time = '';
                                            @endphp
                                        @else
                                            @php
                                                $ot_start_time = \Carbon\Carbon::createFromFormat('H:i:s', $schedule_other->ot_start_time)->translatedFormat('H:i');
                                            @endphp
                                        @endif
                                        @if (empty($schedule_other->ot_end_time))
                                            @php
                                                $ot_end_time = '';
                                            @endphp
                                        @else
                                            @php
                                                $ot_end_time = \Carbon\Carbon::createFromFormat('H:i:s', $schedule_other->ot_end_time)->translatedFormat('H:i');
                                            @endphp
                                        @endif
                                        {{ $ot_start_time }} - {{ $ot_end_time }} น.
                                    </div>
                                </div>
                                <div class="col-6 col-xl-3 invoice-col mt-3">
                                    <div class="border_bottom_dot">
                                        <div class="border_bottom_dot_white"> รวม :</div>
                                        @if (empty($schedule_other->total_ot_work_time))
                                            @php
                                                $total_ot_work_time = '';
                                            @endphp
                                        @else
                                            @php
                                                $total_ot_work_time = $schedule_other->total_ot_work_time;
                                            @endphp
                                        @endif
                                        {{ $total_ot_work_time }} ชั่วโมง
                                    </div>
                                </div>
                                <div class="col-6 col-xl-3 invoice-col mt-3">
                                    <div class="border_bottom_dot">
                                        <div class="border_bottom_dot_white"> สถานะการทำงาน :</div>
                                        @if (empty($schedule_other->status))
                                            @php
                                                $status = 'งานยังไม่เสร็จ';
                                            @endphp
                                        @elseif ($schedule_other->status == 'finished')
                                            @php
                                                $status = 'งานเรียบร้อย';
                                            @endphp
                                        @else
                                            @php
                                                $status = 'งานยังไม่เสร็จ';
                                            @endphp
                                        @endif
                                        {{ $status }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">รูปภาพ</h3>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <div class="row justify-content-center">
                            <div class="col-md-8">
                                <div class="row">
                                    @if (!empty($images))
                                        @foreach ($images as $image)
                                            <a href="" onclick="return false;" data-gallery="gallery"
                                                class="col-md-4 pop">
                                                <img width="50%"
                                                    src="@if (empty($image->getUrl('thumbnail'))) {{ asset('images/noimage.jpg') }} @else {{ $image->getUrl('thumbnail') }} @endif"
                                                    class="img-fluid rounded">
                                            </a>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <form action="{{ route('schedule_others.update', ['schedule_other' => $schedule->id]) }}" method="post"
                id="formUpdate" enctype="multipart/form-data">
                @csrf
                @method('patch')
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">สถานะการตรวจสอบงาน</h3>
                    </div>
                    <div class="card-body">
                        {{-- <label for="note">สถานะการตรวจสอบงาน <span class="text-danger">*</span> </label> --}}
                        <div class="row mt-2">
                            <div class="col-md-2">
                                <div class="form-group clearfix">
                                    <div class="icheck-primary d-inline">
                                        <input type="radio" id="no_approve" name="status_report" value="no_approve"
                                            @if ($schedule->status == 'no_approve') checked @endif />
                                        <label for="no_approve">รอตรวจงาน</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group clearfix">
                                    <div class="icheck-primary d-inline">
                                        <input type="radio" id="warranty" name="status_report" value="warranty"
                                            @if ($schedule->status == 'warranty') checked @endif />
                                        <label for="warranty">Warranty</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group clearfix">
                                    <div class="icheck-primary d-inline">
                                        <input type="radio" id="wait_price" name="status_report" value="wait_price"
                                            @if ($schedule->status == 'wait_price') checked @endif />
                                        <label for="wait_price">รอเสนอราคา</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group clearfix">
                                    <div class="icheck-primary d-inline">
                                        <input type="radio" id="rework" name="status_report" value="rework"
                                            @if ($schedule->status == 'rework') checked @endif />
                                        <label for="rework">Rework</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group clearfix">
                                    <div class="icheck-primary d-inline">
                                        <input type="radio" id="job_close" name="status_report" value="job_close"
                                            @if ($schedule->status == 'job_close') checked @endif />
                                        <label for="job_close">Job Close</label>
                                        {{--                                <input type="checkbox" id="cust" name="cust" value="1"> --}}
                                        {{--                                <label for="cust"> --}}
                                        {{--                                    Cust --}}
                                        {{--                                </label> --}}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group clearfix">
                                    <div class="icheck-primary d-inline">
                                        <input type="radio" id="status_report" name="status_report" value="other"
                                            @if ($schedule->status == 'other') checked @endif />
                                        <label for="status_report">อื่นๆ</label>
                                        {{-- <label for="other_check">
                        @if (isset($technician_report_items->other_detail) == null)
                            @php
                                $other_detail = old('other_detail');
                            @endphp
                        @else
                            @php
                                $other_detail = $technician_report_items->other_detail;
                            @endphp
                        @endif
                        <input autocomplete="nope" type="text"
                            class="form-control form-control-sm @error('other_detail') is-invalid @enderror"
                            id="other_detail" name="other_detail" placeholder=""
                            value="{{ $other_detail }}">
                    </label> --}}
                                    </div>
                                    {{--                            <div class="icheck-primary d-inline"> --}}
                                    {{--                                <input type="checkbox" name="other_check" id="other_check" value="1"> --}}

                                    {{--                            </div> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="modal fade bs-example-modal-center" id="preview-img" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">รูปภาพ</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <img id="preview-img-src" style="width: 100%">
                </div>
            </div>
        </div>
    </div>
@stop
@section('footer')
    <div class="text-right">
        <button type="button" onclick="confirmSubmit()" class="btn btn-primary"><i class="fas fa-fw fa-save mr-2"></i>
            บันทึกข้อมูล
        </button>
    </div>
@endsection
@section('plugins.i-check', true)
@section('js')
    <script>
        function confirmSubmit() {
            Swal.fire({
                icon: 'info',
                title: '',
                text: 'ยืนยันการตรวจงาน',
                showCancelButton: true,
                confirmButtonText: 'ยืนยัน',
                cancelButtonText: 'ยกเลิก',
                showLoaderOnConfirm: true,
                animation: false,
                preConfirm: (e) => {
                    return new Promise(function(resolve) {
                        $('#formUpdate').submit();
                    })
                }
            })
        }
    </script>
@endsection
