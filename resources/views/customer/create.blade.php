@extends('adminlte::page')

@section('title', 'ลูกค้า - เพิ่มข้อมูล')

@section('content_header')
    <div class="row">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark">
                <i class="fad fa-fw fa-user"></i> เพิ่มข้อมูล
            </h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{route('home')}}">หน้าแรก</a></li>
                <li class="breadcrumb-item"><a href="{{route('customers.index')}}">ข้อมูลลูกค้า</a></li>
                <li class="breadcrumb-item active">เพิ่มข้อมูล</li>
            </ol>
        </div>
    </div>
@stop

@section('content')
    <form action="{{route('customers.store')}}" method="post" id="formStore" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <div class="card card-outline card-blue">
                    <div class="card-header">
                        <h3 class="card-title">รายละเอียด</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <label for="name">ชื่อบริษัท <span class="text-danger">*</span></label>
                        <div class="form-group">
                            <input autocomplete="nope" type="text"
                                   class="form-control form-control-sm @error('organization_name') is-invalid @enderror"
                                   id="organization_name"
                                   name="organization_name" placeholder="" value="{{old('organization_name')}}">
                            @error('organization_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <label for="name">ชื่อลูกค้า </label>
                        <div class="form-group">
                            <input autocomplete="nope" type="text"
                                   class="form-control form-control-sm @error('name') is-invalid @enderror"
                                   id="name"
                                   name="name" placeholder="" value="{{old('name')}}">
                            @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <label for="name">รหัสลูกค้า <span class="text-danger">*</span></label>
                        <div class="form-group">
                            <input autocomplete="nope" type="text"
                                   class="form-control form-control-sm @error('code') is-invalid @enderror"
                                   id="code"
                                   name="code" placeholder="" value="{{old('code')}}">
                            @error('code')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <label for="name">เลขที่เสียภาษี</label>
                        <div class="form-group">
                            <input autocomplete="nope" type="text"
                                   class="form-control form-control-sm @error('tax_number') is-invalid @enderror"
                                   id="tax_number"
                                   name="tax_number" placeholder="" value="{{old('tax_number')}}">
                            @error('tax_number')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <label>สถานะ</label>
                        <div class="form-group ">
                            <label>
                                <input type="radio" name="status" checked
                                       value="{{\App\Models\Customer::STATUS_ACTIVE}}">
                                ใช้งาน
                            </label>
                            &emsp;
                            <label>
                                <input type="radio" name="status" value="{{\App\Models\Customer::STATUS_INACTIVE}}">
                                ไม่ใช้งาน
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card card-outline card-blue">
                    <div class="card-header">
                        <h3 class="card-title">ข้อมูลการติดต่อ</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <label for="name">อีเมลล์ <span class="text-danger">*</span></label>
                        <div class="form-group">
                            <input autocomplete="nope" type="email"
                                   class="form-control form-control-sm @error('email') is-invalid @enderror"
                                   id="email"
                                   name="email" placeholder="" value="{{old('email')}}">
                            @error('tel')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <label for="name">เบอร์โทร</label>
                        <div class="form-group">
                            <input autocomplete="nope" type="text"
                                   class="form-control form-control-sm @error('tel') is-invalid @enderror"
                                   id="tel"
                                   name="tel" placeholder="" value="{{old('tel')}}">
                            @error('tel')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <label for="name">ที่อยู่ลูกค้า <span class="text-danger">*</span></label>
                        <div class="form-group">
                            <input autocomplete="nope" type="text"
                                   class="form-control form-control-sm @error('address') is-invalid @enderror"
                                   id="address"
                                   name="address" placeholder="" value="{{old('address')}}">
                            @error('address')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <label for="contact_name">ชื่อผู้ติดต่อ <span class="text-danger">*</span></label>
                        <div class="form-group">
                            <input autocomplete="nope" type="text"
                                   class="form-control form-control-sm @error('contact_name') is-invalid @enderror"
                                   id="contact_name"
                                   name="contact_name" placeholder="" value="{{old('contact_name')}}">
                            @error('contact_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <label for="contact_tel">เบอร์โทรผู้ติดต่อ <span class="text-danger">*</span></label>
                        <div class="form-group">
                            <input autocomplete="nope" type="text"
                                   class="form-control form-control-sm @error('contact_tel') is-invalid @enderror"
                                   id="contact_tel"
                                   name="contact_tel" placeholder="" value="{{old('contact_tel')}}">
                            @error('contact_tel')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
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
        .picker__select--month, .picker__select--year {
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

        input.error, textarea.error, select.error {
            border: 1px dashed red;
            color: red;
        }

    </style>
@stop
@section('plugins.jquery',true)
@section('plugins.jQueryValidation',true)
@section('plugins.Jqueryui',true)
@section('js')
    <script>
        //validate value
        $(document).ready(function () {
            $('#formStore').validate({
                errorClass: 'is-invalid',
                validClass: 'is-valid',
                rules: {
                    organization_name: {required: true},
                    code: {required: true},
                    email: {required: true, email: true},
                    address: {required: true},
                    contact_name: {required: true},
                    contact_tel: {required: true},
                },
                messages: {
                    organization_name: "กรุณากรอกชื่อบริษัท",
                    code: "กรุณากรอกรหัสลูกค้า",
                    email: "กรุณากรอกอีเมลล์ลูกค้า",
                    address: "กรุณากรอกที่อยู่ลูกค้า",
                    contact_name: "กรุณากรอกชื่อผู้ติดต่อ",
                    contact_tel: "กรุณากรอกเบอร์โทรผู้ติดต่อ",
                },
                submitHandler: function (form) {
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
                            return new Promise(function (resolve) {
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
                title: 'เพิ่มข้อมูล',
                text: 'ยืนยันการเพิ่มข้อมูล',
                showCancelButton: true,
                confirmButtonText: 'ยืนยัน',
                cancelButtonText: 'ยกเลิก',
                showLoaderOnConfirm: true,
                animation: false,
                preConfirm: (e) => {
                    return new Promise(function (resolve) {
                        $('#formStore').submit();
                    })
                }
            })
        }
    </script>
@stop
