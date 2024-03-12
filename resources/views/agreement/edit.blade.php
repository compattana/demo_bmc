@extends('adminlte::page')

@section('title', 'เปิดสัญญา - แก้ไขข้อมูล')

@section('content_header')
    <div class="row">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark">
                <i class="fad fa-fw fa-sticky-note"></i> เปิดสัญญา {{$agreement->title}}
            </h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{route('home')}}">หน้าแรก</a></li>
                <li class="breadcrumb-item"><a href="{{route('agreements.index')}}">จัดการเปิดสัญญา</a></li>
                <li class="breadcrumb-item active">แก้ไขข้อมูล - {{$agreement->title}}</li>
            </ol>
        </div>
    </div>
@stop

@section('content')

    <form action="{{route('agreements.update',['agreement'=>$agreement->id])}}" method="post" id="formUpdate"
          enctype="multipart/form-data">
        @csrf
        @method('patch')
        <div class="row">
            <div class="col-md-6">
                <div class="card card-outline card-warning">
                    <div class="card-header">
                        <h3 class="card-title">รายละเอียด</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">

                        <label for="name">ชื่อลูกค้า <span class="text-danger">*</span> </label>
                        <div class="form-group">
                            <input autocomplete="nope" type="text"
                                   class="form-control form-control-sm @error('tax_invoice') is-invalid @enderror"
                                   id="customer_id" readonly
                                   name="customer_id" placeholder=""
                                   value="{{$agreement->customer->organization_name}}">
                        </div>

                        <label for="tax_invoice">ใบกำกับภาษี <span class="text-danger">*</span> </label>
                        <div class="form-group">
                            <input autocomplete="nope" type="text"
                                   class="form-control form-control-sm @error('tax_invoice') is-invalid @enderror"
                                   id="tax_invoice"
                                   name="tax_invoice" placeholder="" value="{{$agreement->tax_invoice}}">
                        </div>

                        <label for="title">เลขที่สัญญา <span class="text-danger">*</span> </label>
                        <div class="form-group">
                            <input autocomplete="nope" type="text"
                                   class="form-control form-control-sm @error('code') is-invalid @enderror"
                                   id="code"
                                   name="code" placeholder="" value="{{$agreement->code}}">
                        </div>

                        <label>ประเภทสัญญา </label>
                        <div class="form-group ">
                            <label>
                                <input type="radio" name="contract_type"
                                       @if($agreement->contract_type==\App\Models\Agreement::CONTRACT_MONTH)  checked
                                       @endif value="{{\App\Models\Agreement::CONTRACT_MONTH}}">
                                รายเดือน
                            </label>
                            &emsp;
                            <label>
                                <input type="radio" name="contract_type"
                                       @if($agreement->contract_type==\App\Models\Agreement::CONTRACT_YEAR)  checked
                                       @endif value="{{\App\Models\Agreement::CONTRACT_YEAR}}">
                                รายปี
                            </label>
                            &emsp;
                            <label>
                                <input type="radio" name="contract_type"
                                       @if($agreement->contract_type==\App\Models\Agreement::CONTRACT_YEAR_FREE)  checked
                                       @endif value="{{\App\Models\Agreement::CONTRACT_YEAR_FREE}}">
                                รายปีแบบแถม
                            </label>
                        </div>

                        <label for="price">ราคา <span class="text-danger">*</span> </label>
                        <div class="form-group">
                            <input autocomplete="nope" type="number"
                                   class="form-control form-control-sm @error('price') is-invalid @enderror"
                                   id="price"
                                   name="price" placeholder="" value="{{$agreement->price}}">
                        </div>

                        <label for="contract">PM. ครั้ง <span class="text-danger">*</span> </label>
                        <div class="form-group">
                            <input autocomplete="nope" type="number"
                                   class="form-control form-control-sm @error('contract') is-invalid @enderror"
                                   id="contract" readonly
                                   name="contract" placeholder="" value="{{$agreement->contract}}">
                            @error('contract')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <label for="start_contract">วันที่เริ่มสัญญา <span class="text-danger">*</span> </label>
                        <div class="form-group">
                            <input type="text" class="form-control form-control-sm " readonly
                                   @php
                                       $start_contract = \Carbon\Carbon::createFromFormat('Y-m-d',$agreement->start_contract)->translatedFormat('d F Y');
                                   @endphp
                                   name="start_contract" value="{{$start_contract}}">
                        </div>

                        <label for="end_contract">วันที่จบสัญญา <span class="text-danger">*</span> </label>
                        <div class="form-group">
                            @php
                                $end_contract = \Carbon\Carbon::createFromFormat('Y-m-d',$agreement->end_contract)->translatedFormat('d F Y');
                            @endphp
                            <input type="text" class="form-control form-control-sm " readonly
                                   name="end_contract" value="{{$end_contract}}">
                        </div>

                        <label>สถานะ</label>
                        <div class="form-group ">
                            <label>
                                <input type="radio" name="status"
                                       @if($agreement->status==\App\Models\Agreement::STATUS_ACTIVE)  checked
                                       @endif value="{{\App\Models\Agreement::STATUS_ACTIVE}}">
                                ใช้งาน
                            </label>
                            &emsp;
                            <label>
                                <input type="radio" name="status"
                                       @if($agreement->status==\App\Models\Agreement::STATUS_INACTIVE)  checked
                                       @endif
                                       value="{{\App\Models\Agreement::STATUS_INACTIVE}}">
                                ไม่ใช้งาน
                            </label>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card card-outline card-warning">
                    <div class="card-header">
                        <h3 class="card-title">สินค้า</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped text-center add-product" id="count">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th width="40%">Product</th>
                                <th width="40%">Product Serial</th>
                                <th>ลบ</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php
                                $i=1
                            @endphp
                            @foreach($items as $item)
                                <tr>
                                    <td>
                                        <input type="hidden" name="id[]" value="{{$item->id}}">
                                        {{$i}}
                                    </td>
                                    <td>
                                        <select name="product_id[]" id="product_id"
                                                class="form-control select2product text-center product_id @error('agreement_items.product_id') is-invalid @enderror">
                                            <option selected
                                                    value="{{$item->product->id}}">{{$item->product->title}}</option>
                                            @foreach($product_show as $product)
                                                <option @if(old('product_id')==$product->id) selected
                                                        @endif value="{{$product->id}}">{{$product->title}}</option>
                                            @endforeach
                                        </select>
{{--                                        <input type="hidden" name="product_id[]" value="{{$item->product->id}}">--}}
                                        @error('agreement_items.product_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </td>
                                    <td>
                                        <select
                                            class="form-control text-center product_serial_id @error('agreement_items.product_serial_id') is-invalid @enderror"
                                            name="product_serial_id[]" id="product_serial_id">
                                            @if($item->product_serial_id == null)
                                                <option selected value=""></option>
                                            @else
                                                <option selected value="{{$item->productSerial->id}}">{{$item->productSerial->serial_name}}</option>
                                            @endif
                                        </select>
{{--                                       <input type="hidden" name="product_serial_id[]" value="{{$item->productSerial->id}}">--}}
                                        @error('agreement_items.product_serial_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </td>
                                    <td>
                                        <button class="btn btn-danger btn-xs delete-row"><i class="fas fa-trash"></i> ลบ </button>
                                    </td>

                                </tr>
                                @php
                                    $i++;
                                @endphp
                            @endforeach
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

                <div class="card card-outline card-warning">
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
                                       name="note" placeholder="" value="{{$agreement->note}}">
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
        <button type="button" onclick="$('#formUpdate').submit()" class="btn btn-primary"><i
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
    </style>
@stop
@section('plugins.Select2',true)
@section('plugins.pickadatejs',true)
@section('plugins.jquery',true)
@section('plugins.Dropzone',true)
@section('plugins.Jqueryui',true)
@section('plugins.jQueryValidation',true)
@section('js')

    <script>
        // Find and remove selected table rows
        $(document).on("click", ".delete-row", function () {
            $(this).parents("tr").remove();
        });

        var count = $('#count tr').length;
        var i = count - 1;

        $(".add-row").click(function () {
            var rowCount = $('.add-product tr').length;
            var markup = '<tr>' + `<td>${rowCount}</td>` +
                '<td>' + '<input name="new[]" type="hidden" value="0"><select  class="form-control select2product product_id" name="product_id[]" id="product_id"><option selected value="">-- กรุณาเลือกสินค้า --</option></select>' + '</td>' +
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

        $('.datepicker').pickadate({
            formatSubmit: 'yyyy-mm-dd',
            selectMonths: true,
            selectYears: 60,
            min: new Date,
        })

        $(document).on('click', '.preview-img', function () {
            $('#preview-img-src').attr('src', $(this).data('src'))
            $('#preview-img').modal('show')
        })

        // upload image
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
                    $(file.previewElement).append('<input type="hidden" name="images[]" value="' + response.name + '">')
                    $(file.previewElement).append('<input type="hidden" name="images_original_name[]" value="' + response.original_name + '">')
                    $(file.previewElement).append('&emsp;<a class="preview-img" target="_blank" style="cursor: pointer" data-src="' + response.path_url + '"> ดูภาพ</a>')
                },
                init: function () {
                    @if(isset($agreement) && $images)
                    @foreach($images as $key => $image)
                    var file = {!! json_encode($image) !!};
                    file.url_thumnail = '{!! $image->getUrl('thumbnail') !!}';
                    file.url = '{!! $image->getUrl() !!}';
                    file.name = '{!! $image->name !!}';
                    this.emit("addedfile", file);
                    this.emit("thumbnail", file, file.url_thumnail);
                    this.emit("complete", file);
                    $(file.previewElement).append('<input type="hidden" name="images[]" value="' + file.file_name + '">')
                    $(file.previewElement).append('<input type="hidden" name="images_original_name[]" value="' + file.original_name + '">')
                    $(file.previewElement).append('&emsp;<a class="preview-img" target="_blank" style="cursor: pointer" data-src="' + file.url + '"> ดูภาพ</a>')
                    @endforeach
                    @endif
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

        //validate value
        $(document).ready(function () {
            $('#formUpdate').validate({
                errorClass: 'is-invalid',
                validClass: 'is-valid',
                rules: {
                    code: {required: true},
                    price: {required: true, number: true},
                    contract: {required: true, number: true},
                },
                messages: {
                    code: "กรุณากรอกเลขที่สัญญา",
                    price: {required: "กรุณากรอกราคา", number: "กรุณากรอกราคาเป็นตัวเลข"},
                    contract: {
                        required: "กรุณากรอกจำนวนครั้งที่เข้า PM",
                        number: "กรุณากรอกจำนวนครั้งที่เข้า PM เป็นตัวเลข"
                    },
                },
                submitHandler: function (form) {
                    Swal.fire({
                        icon: 'info',
                        title: 'แก้ไขข้อมูล',
                        text: 'ยืนยันการแก้ไขข้อมูล',
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
                        $('#formUpdate').submit();
                    })
                }
            })
        }
    </script>
@stop
