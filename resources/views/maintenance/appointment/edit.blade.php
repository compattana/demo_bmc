@extends('adminlte::page')

@section('title', 'ลงเวลา - เพิ่มข้อมูล')

@section('content_header')
    <div class="row">
        <div class="col-md-6">
            <h1 class="m-0 text-dark">
                <i class="fad fa-fw fa-calendar-plus"></i> ลงเวลาเข้า PM -
                บริษัท {{ $schedule->agreement->customer->organization_name }}
            </h1>
        </div>
        <div class="col-md-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">หน้าแรก</a></li>
                <li class="breadcrumb-item"><a href="{{ route('schedules.index') }}">ข้อมูลการ PM</a></li>
                <li class="breadcrumb-item active">เพิ่มข้อมูล</li>
            </ol>
        </div>
    </div>
@stop

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="callout callout-warning" style="line-height: 0.8em">
                <p><b>เลขที่สัญญา : </b>{{ $schedule->agreement->code }}</p>
                <p><b>ชื่อบริษัท : </b>{{ $schedule->agreement->customer->organization_name }}</p>
                <p><b>PM ครั้งที่ : </b>{{ $schedule->round_pm }}</p>
                <p><b>เดือนที่ต้องเข้า PM
                        : </b>{{ \Carbon\Carbon::createFromFormat('Y-m-d', $schedule->month_pm)->translatedFormat('F Y') }}
                </p>
                <p><b>สินค้าที่ต้องเข้า PM :</b></p>
                @php $i=1 @endphp
                @foreach ($agreement_items as $item)
                    <p style="text-indent: 1.5em">{{ $i }} : สินค้า {{ $item->product->title }} /
                        อะไหล่
                        @if ($item->productSerial)
                            {{ $item->productSerial->serial_name }}
                        @endif
                    </p>
                    @php $i++ @endphp
                @endforeach

            </div>
        </div>
        <div class="col-md-6">
            <form action="{{ route('schedules.update', ['schedule' => $schedule->id]) }}" method="post" id="formUpdate"
                enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            @csrf
                            @method('patch')
                            <div class="card-header">
                                <h3 class="card-title">รายละเอียด</h3>
                            </div>
                            <div class="card-body">
                                <label for="technician_id">พนักงานฝ่ายซ่อมบำรุง <span class="text-danger">*</span></label>
                                <div class="form-group text-center">
                                    <select class="form-control select2" multiple="multiple" name="technician_id[]"
                                        id="technician_id">
                                        @foreach ($technicians as $technician)
                                            <option
                                                @foreach ($schedule->technicianPm as $pm)@if ($pm->technician_id == $technician->id) selected
                                                    @endif @endforeach
                                                value="{{ $technician->id }}">{{ $technician->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('technician_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <label for="appointment_date">วันที่ต้องการเข้า PM <span class="text-danger">*</span>
                                </label>
                                <div class="form-group">
                                    @if ($schedule->appointment_date == null)
                                        @php
                                            $appointment_date = \Carbon\Carbon::now()->translatedFormat('d F Y');
                                        @endphp
                                    @else
                                        @php
                                            $appointment_date = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $schedule->appointment_date)->translatedFormat('d F Y');
                                        @endphp
                                    @endif
                                    <input type="text"
                                        class="form-control form-control-sm datepicker  @error('appointment_date') is-invalid @enderror"
                                        name="appointment_date" value="{{ $appointment_date }}">
                                    @error('appointment_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <input type="hidden" name="type" value="maintenance_pm">
                                {{--                                <div class="form-group"> --}}
                                {{--                                    <div class="row"> --}}
                                {{--                                        <div class="col-6"> --}}
                                {{--                                            <label for="start_hour">เวลา</label><br> --}}
                                {{--                                            <select class="form-control form-control-sm" name="start_hour"> --}}
                                {{--                                                @if ($schedule->appointment_date == null) --}}
                                {{--                                                    @php --}}
                                {{--                                                        $now_hour = \Carbon\Carbon::now()->translatedFormat('H'); --}}
                                {{--                                                    @endphp --}}
                                {{--                                                @else --}}
                                {{--                                                    @php --}}
                                {{--                                                        $now_hour = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$schedule->appointment_date)->format('H'); --}}
                                {{--                                                    @endphp --}}
                                {{--                                                @endif --}}
                                {{--                                                @for ($i = 0; $i < 24; $i++) --}}
                                {{--                                                    @php --}}
                                {{--                                                        $hour = str_pad(intval($i), 2, 0, STR_PAD_LEFT) --}}
                                {{--                                                    @endphp --}}
                                {{--                                                    <option @if ($now_hour == $hour) selected --}}
                                {{--                                                            @endif value="{{$hour}}">{{$hour}}</option> --}}
                                {{--                                                @endfor --}}
                                {{--                                            </select> --}}
                                {{--                                        </div> --}}
                                {{--                                        <div class="col-6"> --}}
                                {{--                                            <label for="start_minute">นาที</label><br> --}}
                                {{--                                            <select class="form-control form-control-sm" name="start_minute"> --}}
                                {{--                                                @if ($schedule->appointment_date == null) --}}
                                {{--                                                    @php --}}
                                {{--                                                        $now_minute = \Carbon\Carbon::now()->translatedFormat('i'); --}}
                                {{--                                                    @endphp --}}
                                {{--                                                @else --}}
                                {{--                                                    @php --}}
                                {{--                                                        $now_minute = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$schedule->appointment_date)->format('i'); --}}
                                {{--                                                    @endphp --}}
                                {{--                                                @endif --}}
                                {{--                                                @for ($i = 0; $i < 60; $i++) --}}
                                {{--                                                    @php --}}
                                {{--                                                        $minute = str_pad(intval($i), 2, 0, STR_PAD_LEFT) --}}
                                {{--                                                    @endphp --}}
                                {{--                                                    <option @if ($now_minute == $minute) selected --}}
                                {{--                                                            @endif value="{{$minute}}">{{$minute}}</option> --}}
                                {{--                                                @endfor --}}
                                {{--                                            </select> --}}
                                {{--                                        </div> --}}
                                {{--                                    </div> --}}
                                {{--                                </div> --}}


                                <label for="note">หมายเหตุ</label><br>
                                <div class="form-group">
                                    @if ($schedule->note == null)
                                        @php
                                            $note = old('note');
                                        @endphp
                                    @else
                                        @php
                                            $note = $schedule->note;
                                        @endphp
                                    @endif
                                    <input autocomplete="nope" type="text"
                                        class="form-control form-control-sm @error('note') is-invalid @enderror"
                                        id="note" name="note" placeholder="" value="{{ $note }}">
                                    @error('note')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@stop
@section('footer')
    <div class="text-right">
        <button type="button" onclick="$('#formUpdate').submit()" class="btn btn-primary"><i
                class="fas fa-fw fa-save mr-2"></i>
            บันทึกข้อมูล
        </button>
    </div>
@endsection
@section('css')
    <style>
        .picker__select--month,
        .picker__select--year {
            border: 1px solid #b7b7b7;
            height: 2em;
            padding: 0em;
            margin-left: 0.25em;
            margin-right: 0.25em;
            text-align: center;
        }

        .select2-container--default .select2-selection--multiple .select2-selection__rendered li:first-child.select2-search.select2-search--inline .select2-search__field {
            width: 100% !important;
            text-align: center;
        }

        .select2-container {
            min-width: 100%;
        }

        .select2-results__option {
            padding-right: 20px;
            vertical-align: middle;
        }

        .select2-results__option:before {
            content: "";
            display: inline-block;
            position: relative;
            height: 20px;
            width: 20px;
            border: 2px solid #e9e9e9;
            border-radius: 4px;
            background-color: #fff;
            margin-right: 20px;
            vertical-align: middle;
        }

        .select2-results__option[aria-selected=true]:before {
            font-family: fontAwesome;
            content: "\f00c";
            color: #fff;
            background-color: #00499a;
            border: 0;
            display: inline-block;
            padding-left: 3px;
        }

        .select2-container--default .select2-results__option[aria-selected=true] {
            background-color: #fff;
        }

        .select2-container--default .select2-results__option--highlighted[aria-selected] {
            background-color: #eaeaeb;
            color: #272727;
        }

        .select2-container--default .select2-selection--multiple {
            margin-bottom: 10px;
        }

        .select2-container--default.select2-container--open.select2-container--below .select2-selection--multiple {
            border-radius: 4px;
        }

        .select2-container--default.select2-container--focus .select2-selection--multiple {
            border-color: #00499a;
            border-width: 2px;
        }

        .select2-container--default .select2-selection--multiple {
            border-width: 2px;
        }

        .select2-container--open .select2-dropdown--below {
            border-radius: 6px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
        }

        .select2-selection .select2-selection--multiple:after {
            content: 'hhghgh';
        }

        .picker__select--month,
        .picker__select--year {
            border: 1px solid #b7b7b7;
            height: 2em;
            padding: 0em;
            margin-left: 0.25em;
            margin-right: 0.25em;
            text-align: center;
        }

        .is-invalid {
            color: red;
            display: block;
            margin-top: 5px;
            font-size: 12px;
            font-weight: lighter !important;
        }

        input.error,
        textarea.error,
        select.error {
            border: 1px dashed red;
            color: red;
        }
    </style>
@stop
@section('plugins.Select2', true)
@section('plugins.pickadatejs', true)
@section('plugins.jquery', true)
@section('plugins.jQueryValidation', true)
@section('plugins.Jqueryui', true)
@section('js')
    <script>
        $('.select2').select2({
            closeOnSelect: false,
            placeholder: "-- กรุณาเลือกพนักงาน --",
            allowHtml: true,
            allowClear: true,
            // tags: true,

        });


        // calendar
        $('.datepicker').pickadate({
            formatSubmit: 'yyyy-mm-dd',
            selectMonths: 1,
            selectYears: 4,
            min: new Date,
            max: +40

        })

        //validate value
        $(document).ready(function() {
            $('#formUpdate').validate({
                errorClass: 'is-invalid',
                validClass: 'is-valid',
                rules: {
                    "technician_id[]": {
                        required: true
                    },
                },
                messages: {
                    "technician_id[]": "กรุณาเลือกช่างอย่างน้อย 1 คน",
                },
                submitHandler: function(form) {
                    Swal.fire({
                        icon: 'info',
                        title: 'เพิ่มข้อมูล',
                        text: 'ยืนยันการเพิ่มข้อมูล',
                        showCancelButton: true,
                        confirmButtonText: 'ยืนยัน',
                        cancelButtonText: 'ยกเลิก',
                        showLoaderOnConfirm: true,
                        allowOutsideClick: true,
                        allowEscapeKey: true,
                        animation: false,
                        focusCancel: true,
                        preConfirm: (e) => {
                            return new Promise(function(resolve) {
                                form.submit();
                            })
                        },
                    })
                }
            });
        });

        function confirmSubmit() {
            Swal.fire({
                icon: 'info',
                title: 'ลงเวลา',
                text: 'ยืนยันการลงเวลา',
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
@stop
