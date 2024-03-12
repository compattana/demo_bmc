@extends('adminlte::page')

@section('title', 'สัญญา - เพิ่มข้อมูล')

@section('content_header')
    <div class="row">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark">
                <i class="fad fa-fw fa-file-signature"></i> เพิ่มข้อมูล
            </h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{route('home')}}">หน้าแรก</a></li>
                <li class="breadcrumb-item"><a href="{{route('agreements.index')}}">ข้อมูลสัญญา</a></li>
                <li class="breadcrumb-item active">เพิ่มข้อมูล</li>
            </ol>
        </div>
    </div>
@stop

@section('content')
    <form action="{{route('agreements.store')}}" method="post" id="formStore" class="validator"
          enctype="multipart/form-data">
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
                        <label for="name">ชื่อบริษัท <span class="text-danger">*</span> </label>
                        <div class="form-group text-center">
                            <select class="form-control select2customer customer_id" id="customer_id"
                                    name="customer_id">
                                <option selected value="" disabled>-- กรุณาเลือกบริษัทลูกค้า --</option>
                                @foreach($customers as $customer)
                                    <option @if(old('customer_id')==$customer->id) selected
                                            @endif value="{{$customer->id}}">{{$customer->organization_name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <label for="tax_invoice">ใบกำกับภาษี <span class="text-danger">*</span> </label>
                        <div class="form-group">
                            <input autocomplete="nope" type="text"
                                   class="form-control form-control-sm @error('tax_invoice') is-invalid @enderror"
                                   id="tax_invoice"
                                   name="tax_invoice" placeholder="" value="{{old('tax_invoice')}}">
                        </div>

                        <label for="code">เลขที่สัญญา <span class="text-danger">*</span> </label>
                        <div class="form-group">
                            <input autocomplete="nope" type="text"
                                   class="form-control form-control-sm @error('code') is-invalid @enderror"
                                   id="code"
                                   name="code" placeholder="" value="{{old('code')}}">
                        </div>

                        <label>ประเภทสัญญา </label>
                        <div class="form-group ">
                            <label>
                                <input type="radio" name="contract_type"
                                       value="{{\App\Models\Agreement::CONTRACT_MONTH}}">
                                รายเดือน
                            </label>
                            &emsp;
                            <label>
                                <input type="radio" name="contract_type" checked
                                       value="{{\App\Models\Agreement::CONTRACT_YEAR}}">
                                รายปี
                            </label>
                            &emsp;
                            <label>
                                <input type="radio" name="contract_type"
                                       value="{{\App\Models\Agreement::CONTRACT_YEAR_FREE}}">
                                รายปีแบบแถม
                            </label>
                        </div>

                        <label for="price">ราคา <span class="text-danger">*</span> </label>
                        <div class="form-group">
                            <input autocomplete="nope" type="number"
                                   class="form-control form-control-sm @error('price') is-invalid @enderror"
                                   id="price"
                                   name="price" placeholder="" value="{{old('price')}}">
                            @error('price')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <label for="contract">PM. ครั้ง <span class="text-danger">*</span> </label>
                        <div class="form-group">
                            <input autocomplete="nope" type="number"
                                   class="form-control form-control-sm @error('contract') is-invalid @enderror"
                                   id="contract"
                                   name="contract" placeholder="" value="{{old('contract')}}">
                            @error('contract')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <label for="start_contract">วันที่เริ่มสัญญา <span class="text-danger">*</span> </label>
                        <div class="form-group">
                            <input type="text"
                                   class="form-control form-control-sm datepicker  @error('start_contract') is-invalid @enderror"
                                   id="start_contract" name="start_contract" value="{{old('start_contract')}}">
                        </div>

                        <label for="end_contract">วันที่จบสัญญา <span class="text-danger">*</span> </label>
                        <div class="form-group">
                            <input type="text"
                                   class="form-control form-control-sm datepicker @error('end_contract') is-invalid @enderror"
                                   id="end_contract" name="end_contract" value="{{old('end_contract')}}">
                        </div>

                        <label>สถานะ</label>
                        <div class="form-group ">
                            <label>
                                <input type="radio" name="status" checked
                                       value="{{\App\Models\Agreement::STATUS_ACTIVE}}">
                                ใช้งาน
                            </label>
                            &emsp;
                            <label>
                                <input type="radio" name="status" value="{{\App\Models\Agreement::STATUS_INACTIVE}}">
                                ไม่ใช้งาน
                            </label>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card card-outline card-blue">
                    <div class="card-header">
                        <h3 class="card-title">สินค้า</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped text-center add-product">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th width="40%">สินค้า</th>
                                <th width="40%">หมายเลขเครื่อง</th>
                                <th width="20%">#</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>1</td>
                                <td>
                                    <select name="product_id[]" id="product_id"
                                            class="form-control select2product text-center product_id @error('agreement_items.product_id') is-invalid @enderror">
                                        <option selected value="" disabled>-- กรุณาเลือกสินค้า --</option>
                                        @foreach($product_show as $product)
                                            <option @if(old('product_id')==$product->id) selected
                                                    @endif value="{{$product->id}}">{{$product->title}}</option>
                                        @endforeach
                                    </select>
                                    @error('agreement_items.product_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </td>
                                <td>
                                    <select
                                        class="form-control text-center product_serial_id @error('agreement_items.product_serial_id') is-invalid @enderror"
                                        name="product_serial_id[]" id="product_serial_id">
                                        <option selected value="{{old('agreement_items.product_serial_id[]')}}"
                                                disabled>-- กรุณาเลือกหมายเลขเครื่อง --
                                        </option>
                                    </select>
                                    @error('agreement_items.product_serial_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </td>
                                <td>
                                    <button class="btn btn-danger btn-xs delete-row"><i
                                            class="fas fa-trash"></i> ลบ
                                    </button>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer ">
                        <div class="float-right">
                            <button type="button" class="btn btn-secondary add-row"><i class="fas fa-plus"></i>
                                เพิ่มสินค้า
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card card-outline card-blue">
                    <div class="card-header">
                        <h3 class="card-title">รายละเอียดเพิ่มเติม</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="note">หมายเหตุ</label><br>
                            <div class="form-group">
                                <input autocomplete="nope" type="text"
                                       class="form-control form-control-sm @error('note') is-invalid @enderror"
                                       id="note"
                                       name="note" placeholder="" value="{{old('note')}}">
                                @error('note')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="link">เอกสารอ้างอิง</label><br>
                            <div class="needsclick dropzone" id="imageDropzone">
                                <div class="dz-message" data-dz-message>
                                    <i class="fas fa-fw fa-upload"></i>
                                    <span> เอกสารอ้างอิง</span>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </form>

    <div class="modal fade bd-example-modal-lg" id="preview-img" tabindex="-1" role="dialog"
         aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">

            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">รูปภาพ</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <img id="preview-img-src" style="width: 100%">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
                </div>
            </div>

        </div>
    </div>
@stop

@section('footer')
    <div class="text-right">
        <button type="submit" onclick="$('#formStore').submit()" class="btn btn-primary"><i
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
            font-size: 12px;
            font-weight: lighter !important;
        }

        input.error, textarea.error, select.error {
            border: 1px dashed red;
            color: red;
        }
    </style>
@stop
@section('plugins.Select2',true)
@section('plugins.pickadatejs',true)
@section('plugins.jquery',true)
@section('plugins.Dropzone',true)
@section('plugins.jQueryValidation',true)
@section('plugins.Jqueryui',true)
@section('js')
    <script>
        // delete row
        $(document).on("click", ".delete-row", function () {
            $(this).parents("tr").remove();
        });

        // add rows to table
        var i = 0;
        $(".add-row").click(function () {
            var rowCount = $('.add-product tr').length;
            var markup = '<tr>' + `<td>${rowCount}</td>` +
                '<td>' + '<select  class="form-control select2product product_id" name="product_id[]" id="product_id"><option selected value="">-- กรุณาเลือกสินค้า --</option></select>' + '</td>' +
                '<td><select  class="form-control product_serial_id" name="product_serial_id[]"><option selected value="">-- กรุณาเลือกหมายเลขเครื่อง --</option></select></td>' +
                '<td> <button class="btn btn-danger btn-xs delete-row"><i class="fas fa-trash"></i> ลบ </button>' +
                '</tr>';
            $('table.add-product').append(markup);

            $('.select2product').select2({
                ajax: {
                    url: "{{route('ajax.select2.products')}}",
                    dataType: 'json',
                    delay: 250,
                    data: function (params) {
                        return {
                            search: params.term // search term
                        };
                    },
                    processResults: function (response) {
                        return {
                            results: response
                        };
                    },
                    cache: true

                }

            });

            $('.product_serial_id').select2()

            i++;
        });

        $('.product_serial_id').select2()

        // filter product serial
        $(document).on('change', '.product_id', function () {
            var product_id = $(this).val();
            var product_serial_object = $(this).parent().parent().find(".product_serial_id");
            console.log(product_id)
            $.ajax({
                url: "{{ route('ajax.select2.product_serials') }}",
                type: "GET",
                data: {
                    product_id: product_id
                },
                success: function (data) {
                    product_serial_object.empty();
                    $.each(data, function (index, subcategory) {
                        product_serial_object.append('<option value="' + subcategory.id + '">' + subcategory.text + '</option>');
                    })
                }
            })

        });

        // fetch data with ajax
        $('.select2product').select2({
            ajax: {
                url: "{{route('ajax.select2.products')}}",
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        search: params.term // search term
                    };
                },
                processResults: function (response) {
                    return {
                        results: response
                    };
                },
                cache: true

            }

        });

        $('.select2customer').select2();

        // calendar
        $('.datepicker').pickadate({
            formatSubmit: 'yyyy-mm-dd',
            selectMonths: true,
            selectYears: 60,
            // min: new Date,
        })

        // show image
        $(document).on('click', '.preview-img', function () {
            $('#preview-img-src').attr('src', $(this).data('src'))
            $('#preview-img').modal('show')
        })

        //upload image
        $('#imageDropzone').dropzone(
            {
                url: '{{route('dropzone.store')}}',
                maxFilesize: 10, // MB
                addRemoveLinks: true,
                acceptedFiles: 'image/jpeg,image/png,image/jpg',
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                success: function (file, response) {
                    console.log(response)
                    $(file.previewElement).append('&emsp;<a class="preview-img" target="_blank" style="cursor: pointer" data-src="' + response.path_url + '"> ดูภาพ</a>')
                    $(file.previewElement).append('<input type="hidden" name="images[]" value="' + response.name + '">')
                    $(file.previewElement).append('<input type="hidden" name="images_original_name[]" value="' + response.original_name + '">')
                },
                error: function(file, response)
                {
                    if($.type(response) === "string")
                        var message = response; //dropzone sends it's own error messages in string
                    else
                        var message = response.message;
                    file.previewElement.classList.add("dz-error");
                    _ref = file.previewElement.querySelectorAll("[data-dz-errormessage]");
                    _results = [];
                    for (_i = 0, _len = _ref.length; _i < _len; _i++) {
                        node = _ref[_i];
                        _results.push(node.textContent = message);
                    }
                    return _results;
                },


                dictFallbackMessage: "Your browser does not support drag'n'drop file uploads.",
                dictFallbackText: "Please use the fallback form below to upload your files like in the olden days.",
                dictFileTooBig: 'ไฟล์มีขนาดใหญ่ (@{{filesize}}MiB). ไฟล์รองรับได้สูงสุด: @{{maxFilesize}}MiB.',
                dictInvalidFileType: "You can't upload files of this type.",
                dictResponseError: "Server responded with @{{statusCode}} code.",
                dictCancelUpload: "Cancel upload",
                dictCancelUploadConfirmation: "Are you sure you want to cancel this upload?",
                dictRemoveFile: "ลบรูปภาพ",
                dictMaxFilesExceeded: "You can not upload any more files.",
            }
        )
        Dropzone.autoDiscover = false;
        $(function () {
            $("#imageDropzone").sortable({
                items: '.dz-preview',
                cursor: 'move',
                opacity: 0.5,
                containment: '#imageDropzone',
                distance: 20,
                tolerance: 'pointer'
            });
        });


        $('.ignore').blur(function () {
            if ($(this).val() == "") {
                $(this).parent().removeClass("inputSuccess");
            }
        });

        //validate value
        var select2label, datePickerLabel;
        $(document).ready(function () {
            $('#formStore').validate({
                errorClass: 'is-invalid',
                validClass: 'is-valid',
                ignore: ".ignore",
                rules: {
                    customer_id: {required: true},
                    code: {required: true},
                    price: {required: true, number: true},
                    contract: {required: true, number: true},
                    start_contract: {required: true},
                    end_contract: {required: true},
                },
                messages: {
                    customer_id: "กรุณาเลือกบริษัทลูกค้า",
                    code: "กรุณากรอกเลขที่สัญญา",
                    price: {required: "กรุณากรอกราคา", number: "กรุณากรอกราคาเป็นตัวเลข"},
                    contract: {
                        required: "กรุณากรอกจำนวนครั้งที่เข้า PM",
                        number: "กรุณากรอกจำนวนครั้งที่เข้า PM เป็นตัวเลข"
                    },
                    start_contract: "กรุณาเลือกวันที่เริ่มสัญญา",
                    end_contract: "กรุณาเลือกวันที่หมดสัญญา",
                },
                errorPlacement: function (label, element) {
                    if (element.hasClass('select2')) {
                        label.insertAfter(element.next('.select2-container')).addClass('mt-2 text-danger is-invalid');
                        select2label = label

                    } else if (element.hasClass('datepicker')) {
                        label.insertAfter(element.next('.form-control')).addClass('mt-2 text-danger');
                        datePickerLabel = label
                    }
                    else {
                        label.addClass('mt-2 text-danger');
                        label.insertAfter(element);
                    }

                },
                highlight: function (element, errorClass, validClass) {
                    $(element).addClass(errorClass).removeClass('success');
                },
                unhighlight: function (element, errorClass, validClass) {
                    $(element).removeClass(errorClass).addClass('success');
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

        //watch the change on select
        $('#customer_id, #start_contract, #end_contract').on("change", function (e) {
            $(this).valid(); //remove label
        });


        // confirm submit
        function confirmSubmit() {
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
                        $('#formStore').submit();
                    })
                },
            })
        }
    </script>
@stop
