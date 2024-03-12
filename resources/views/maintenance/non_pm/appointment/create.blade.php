@extends('adminlte::page')

@section('title', 'ลงเวลา : ' . $type_name . ' - เพิ่มข้อมูล')

@section('content_header')
    <div class="row">
        <div class="col-md-6">
            <h1 class="m-0 text-dark">
                <i class="fad fa-fw fa-calendar-plus"></i> ลงเวลา : {{ $type_name }}
            </h1>
        </div>
        <div class="col-md-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">หน้าแรก</a></li>
                <li class="breadcrumb-item">
                    <a href="{{ route('maintenance_reports.index', ['type' => $type]) }}">
                        ตารางการเข้าซ่อม : {{ $type_name }}
                    </a>
                </li>
                <li class="breadcrumb-item active">เพิ่มข้อมูล</li>
            </ol>
        </div>
    </div>
@stop

@section('content')
    <div class="row">

        <div class="col-md-6">
            <form action="{{ route('schedules.store', ['type' => $type]) }}" method="post" id="formStore"
                enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            @csrf
                            <div class="card-header">
                                <h3 class="card-title">รายละเอียด</h3>
                            </div>
                            <div class="card-body">
                                <label for="technician_id">พนักงานฝ่ายซ่อมบำรุง <span class="text-danger">*</span></label>
                                <div class="form-group text-center">
                                    <select class="form-control select2 js-example-basic-multiple" multiple="multiple" name="technician_id[]" id="technician_id"
                                        style="width: 100%">
                                        @foreach ($technicians as $technician)
                                            <option value="{{ $technician->id }}">{{ $technician->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('technician_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <label for="name">ชื่อบริษัท <span class="text-danger">*</span> </label>
                                <div class="form-group text-center">
                                    <select class="form-control select2customer" id="customer_id" name="customer_id"
                                        style="width: 100%">
                                        <option selected value="" disabled>-- กรุณาเลือกบริษัทลูกค้า --</option>
                                        @foreach ($customers as $customer)
                                            <option @if (old('customer_id') == $customer->id) selected @endif
                                                value="{{ $customer->id }}">{{ $customer->organization_name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <label for="appointment_date">วันที่ต้องการเข้าซ่อมบำรุง <span class="text-danger">*</span>
                                </label>
                                <div class="form-group">
                                    <input type="text"
                                        class="form-control form-control-sm datepicker  @error('appointment_date') is-invalid @enderror"
                                        name="appointment_date" value="" id="appointment_date">
                                    @error('appointment_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <label for="note">หมายเหตุ</label><br>
                                <div class="form-group">
                                    <input autocomplete="nope" type="text"
                                        class="form-control form-control-sm @error('note') is-invalid @enderror"
                                        id="note" name="note" placeholder="" value="{{ old('note') }}">
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
        <button type="button" onclick="$('#formStore').submit()" class="btn btn-primary"><i
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

        /*.select2-container {*/
        /*    min-width: 100%;*/
        /*}*/

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
@section('plugins.jQueryValidation', true)
@section('js')
    <script
        src="{{ URL::asset('https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/additional-methods.min.js') }}">
    </script>
    <script>
        $('.select2').select2({
            closeOnSelect: false,
            placeholder: "-- กรุณาเลือกพนักงาน --",
            allowHtml: true,
            allowClear: true,
            // tags: true,

        });

        $('.select2customer').select2({
            placeholder: "-- กรุณาเลือกบริษัทที่ต้องการเข้าซ่อมบำรุง --",
        });

        $('.select2type').select2({
            placeholder: "-- กรุณาเลือกประเภทการเข้าซ่อมบำรุง --",
        });

        // calendar
        $('.datepicker').pickadate({
            formatSubmit: 'yyyy-mm-dd',
            selectMonths: true,
            selectYears: 60,
            min: new Date,
        })

        //validate value
        var select2label, datePickerLabel;
        $(document).ready(function() {
            $('#formStore').validate({
                errorClass: 'is-invalid',
                validClass: 'is-valid',
                rules: {
                    "technician_id[]": {
                        required: true
                    },
                    customer_id: {
                        required: true
                    },
                    appointment_date: {
                        required: true
                    },
                },
                messages: {
                    "technician_id[]": "กรุณาเลือกช่างอย่างน้อย 1 คน",
                    customer_id: "กรุณากรอกเลือกบริษัท",
                    appointment_date: "กรุณากรอกวันที่ต้องการเข้าซ่อมบำรุง",
                },
                errorPlacement: function(label, element) {
                    if (element.hasClass('select2')) {
                        label.insertAfter(element.next('.select2-container')).addClass(
                            'mt-2 text-danger is-invalid');
                        select2label = label

                    } else if (element.hasClass('datepicker')) {
                        label.insertAfter(element.next('.form-control')).addClass('mt-2 text-danger');
                        datePickerLabel = label
                    } else {
                        label.addClass('mt-2 text-danger');
                        label.insertAfter(element);
                    }
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass(errorClass).removeClass('success');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass(errorClass).addClass('success');
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

        //watch the change on select
        $('#technician_id, #customer_id, #appointment_date').on("change", function (e) {
            $(this).valid(); //remove label
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
                        $('#formStore').submit();
                    })
                }
            })
        }
    </script>
@stop
