@extends('adminlte::page')

@section('title', 'สัญญา')

@section('content_header')

    <div class="row">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark">
                <i class="fad fa-fw fa-file-signature"></i> PM
            </h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{route('home')}}">หน้าแรก</a></li>
                <li class="breadcrumb-item"><a
                        href="{{route('maintenances.product.index', ['maintenance' => $maintenance->id])}}">ข้อมูลการเข้า
                        PM</a>
                </li>
                <li class="breadcrumb-item active">PM</li>
            </ol>
        </div>
    </div>
@stop

@section('content')
    <div class="">
        <div class="arrow-steps clearfix mb-3">
            <div class="step"><span> <i class="fad fa-list-ul"></i><a
                        href="{{route('maintenances.index')}}">&nbsp;ข้อมูลการเข้า PM</a></span></div>
            <div class="step"><span><i class="fad fa-toolbox"></i><a
                        href="{{route('maintenances.product.index', ['maintenance' => $maintenance->id])}}">&nbsp; Maintenance</a></span>
            </div>
            <div class="step current"><span><i class="fad fa-edit"></i>&nbsp; สร้างใบรายงาน</span></div>
        </div>
    </div>
    <blockquote class="quote-info ml-0 mr-0">
        <p><b>เลขที่สัญญา : </b>{{ $maintenance->agreement->code }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <b>ชื่อบริษัท : </b>{{ $maintenance->agreement->customer->organization_name }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>PM
                ครั้งที่ : </b>{{ $maintenance->round_pm }}</p>
    </blockquote>
    <form
        action="{{route('maintenances.product.pm.store', ['maintenance' => $maintenance->id,'product'=>$agreement_items] )}}"
        method="post" id="formStore" enctype="multipart/form-data">
        @csrf
        <div class="card card-primary card-outline card-outline-tabs">
            <div class="card-header p-0 border-bottom-0">
                <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active " id="tabs-report" data-toggle="pill" href="#tabs-goto-report"
                           role="tab" aria-controls="tabs-goto-report"
                           aria-selected="true">ใบรายงานช่าง</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="tabs-pm" data-toggle="pill" href="#tabs-goto-pm"
                           role="tab"
                           aria-controls="tabs-goto-description"
                           aria-selected="false">ใบ Preventive Maintenance</a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content" id="custom-tabs-four-tabContent">
                    <div class="tab-pane fade show active" id="tabs-goto-report" role="tabpanel"
                         aria-labelledby="tabs-report">
                        @include('maintenance.pm.create.technician_report')
                    </div>
                    <div class="tab-pane fade" id="tabs-goto-pm" role="tabpanel"
                         aria-labelledby="tabs-pm">
                        @include('maintenance.pm.create.pm')
                    </div>
                </div>
            </div>
        </div>

        <div class="card card-outline card-blue">
            <div class="card-header">
                <h3 class="card-title">อื่น ๆ</h3>
                {{--                <div class="card-tools">--}}
                {{--                    <button type="button" class="btn btn-tool" data-card-widget="collapse">--}}
                {{--                        <i class="fas fa-minus"></i>--}}
                {{--                    </button>--}}
                {{--                </div>--}}
            </div>
            <div class="card-body">
                <label for="note">หมายเหตุ <span class="text-danger">*</span> </label>
                <div class="form-group">
                    <input autocomplete="nope" type="text"
                           class="form-control form-control-sm @error('note') is-invalid @enderror"
                           id="note"
                           name="note" placeholder="" value="{{old('note')}}">
                </div>

                <label for="note">สถานะงาน <span class="text-danger">*</span> </label>
                <div class="row mt-2">
                    <div class="col-md-2">
                        <div class="form-group clearfix">
                            <div class="icheck-primary d-inline">
                                <input type="radio" id="no_approve" name="status_report" value="no_approve" checked />
                                <label for="no_approve">รอตรวจงาน</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group clearfix">
                            <div class="icheck-primary d-inline">
                                <input type="radio" id="warranty" name="status_report" value="warranty" />
                                <label for="warranty">Warranty</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group clearfix">
                            <div class="icheck-primary d-inline">
                                <input type="radio" id="wait_price" name="status_report" value="wait_price" />
                                <label for="wait_price">รอเสนอราคา</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group clearfix">
                            <div class="icheck-primary d-inline">
                                <input type="radio" id="rework" name="status_report" value="rework" />
                                <label for="rework">Rework</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group clearfix">
                            <div class="icheck-primary d-inline">
                                <input type="radio" id="job_close" name="status_report" value="job_close" />
                                <label for="job_close">Job Close</label>
{{--                                <input type="checkbox" id="cust" name="cust" value="1">--}}
{{--                                <label for="cust">--}}
{{--                                    Cust--}}
{{--                                </label>--}}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group clearfix">
                            <div class="icheck-primary d-inline">
                                <input type="radio" id="status_report" name="status_report" value="other" />
                                <label for="status_report">อื่นๆ</label>
                                <label for="other_check">
                                    <input autocomplete="nope" type="text"
                                           class="form-control form-control-sm @error('other_detail') is-invalid @enderror"
                                           id="other_detail"
                                           name="other_detail" placeholder="" value="{{old('other_detail')}}">
                                </label>
                            </div>
{{--                            <div class="icheck-primary d-inline">--}}
{{--                                <input type="checkbox" name="other_check" id="other_check" value="1">--}}

{{--                            </div>--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row" id="signature_report">
            <div class="col-md-6">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fa-solid fa-signature"></i>
                            ลงชื่อลูกค้า
                        </h3>
                    </div>
                    <div class="card-body" style="height: 280px">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12">
                                    <br/>
                                    <div class="wrapper-pad">
                                        <canvas id="sig1" class="signature-pad"></canvas>
                                    </div>
                                    <input type="hidden" id="sig1_value" name="sig1_value">
                                    <br>
                                    <br>
                                    <div class="text-right pt-4">
                                        <button id="clear" type="button" class="btn btn-danger">ยกเลิก</button>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fa-solid fa-image"></i>
                            รูปภาพลูกค้า
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <div class="needsclick dropzone" id="imageDropzone">
                                <div class="dz-message" data-dz-message>
                                    <div class="mb-3">
                                        <i class="fa-solid fa-upload" style="font-size: 20px"></i>
                                    </div>
                                    <h4>อัพโหลดรูปภาพ</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row" id="signature_pm">
            <div class="col-md-6">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fa-solid fa-signature"></i>
                            ลงชื่อลูกค้า
                        </h3>
                    </div>
                    <div class="card-body" style="height: 280px">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12">
                                    <br/>
                                    <div class="wrapper-pad">
                                        <canvas id="sig2" class="signature-pad"></canvas>
                                    </div>
                                    <input type="hidden" id="sig2_value" name="sig2_value">
                                    <br><br>
                                    <div class="text-right pt-2">
                                        <button id="clear2" type="button" class="btn btn-danger">ยกเลิก</button>
                                    </div>
                                    <textarea id="signature2" name="signed2" style="display: none"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fa-solid fa-image"></i>
                            รูปภาพลูกค้า
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <div class="needsclick dropzone" id="imageDropzone2">
                                <div class="dz-message" data-dz-message>
                                    <div class="mb-3">
                                        <i class="fa-solid fa-upload" style="font-size: 20px"></i>
                                    </div>
                                    <h4>อัพโหลดรูปภาพ</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

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
@endsection
@section('footer')
    <div class="text-right">
        <button type="button" onclick="confirmSubmit()" class="btn btn-primary"><i
                class="fas fa-fw fa-save mr-2"></i>
            บันทึกข้อมูล
        </button>
    </div>
@endsection
@section('css')
    <style>
        /* Styles for signature plugin v1.2.0. */
        .kbw-signature {
            display: inline-block;
            border: 1px solid #a0a0a0;
            -ms-touch-action: none;
        }

        .kbw-signature-disabled {
            opacity: 0.35;
        }

        .kbw-signature {
            /*width: 100%;*/
            height: 200px;
        }

        #sig1 canvas {
            /*width: 100% !important;*/
            height: auto;
        }

        #sig2 canvas {
            /*width: 100% !important;*/
            height: auto;
        }

        .arrow-steps .step {
            font-size: 14px;
            text-align: center;
            color: #666;
            cursor: default;
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

        }

        .arrow-steps .step.current:after {
            border-left: 17px solid #23468c;
        }

        select.form-control-sm ~ .select2-container--default {
            font-size: 100%;
        }

        .card-title {
            float: left;
            font-size: 1.1rem;
            font-weight: 400;
            margin: 9px;
        }

        .bs-stepper-circle {
            background-color: #6c757d !important;
        }

        .active > button > .bs-stepper-circle {
            background-color: #007bff !important;
        }

        .card-header {
            background-color: transparent;
            border-bottom: 1px solid rgba(0, 0, 0, 0.125);
            padding: 0.2rem 1.25rem;
            position: relative;
            border-top-left-radius: 0.25rem;
            border-top-right-radius: 0.25rem;
        }

        @media (max-width: 520px) {
            .bs-stepper-header {
                display: unset;
                margin: 0 -10px;
                text-align: center;
            }
        }

        .picker__select--month, .picker__select--year {
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

        /*signature pad*/
        .wrapper-pad {
            position: relative;
            width: 100%;
            height: 100%;
            max-width: 700px;
            max-height: 460px;
            -moz-user-select: none;
            -webkit-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        .signature-pad {


            border: 1px solid black;
            position: absolute;
            left: 0;
            top: 0;
            /*width:100%;*/
            /*height:200px;*/
        }

    </style>
@stop
@section('plugins.i-check',true)
@section('plugins.bs-stepper', true)
@section('plugins.pickadatejs',true)
@section('plugins.Select2',true)
@section('plugins.Jqueryui',true)
@section('plugins.Dropzone',true)
@section('js')
    <script src="https://cdn.jsdelivr.net/npm/signature_pad@4.0.8/dist/signature_pad.umd.min.js"></script>
    {{--    <script src="{{asset('js/signature_pad.js')}}"></script>--}}
    <script>
        function showPreview(event) {
            if (event.target.files.length > 0) {
                var src = URL.createObjectURL(event.target.files[0]);
                var preview = document.getElementById("preview");
                preview.src = src;
                preview.style.display = "block";
            }
        }

        function showPreview2(event) {
            if (event.target.files.length > 0) {
                var src = URL.createObjectURL(event.target.files[0]);
                var preview = document.getElementById("preview2");
                preview.src = src;
                preview.style.display = "block";
            }
        }

        {{--    Signature Pad--}}
        var sig1;
        const signature1 = new SignaturePad(document.getElementById('sig1'), {});
        document.getElementById('clear').addEventListener('click', function (event) {
            signature1.clear();
        });
        signature1.toDataURL(); // save image as PNG
        signature1.addEventListener("endStroke", () => {
            sig1 = signature1.toDataURL()
            $('#sig1_value').val(sig1)
            console.log($('#sig1_value').val());
        }, {once: false});


        var sig2;
        const signature2 = new SignaturePad(document.getElementById('sig2'), {});
        document.getElementById('clear2').addEventListener('click', function (event) {
            signature2.clear();
        });
        signature2.toDataURL(); // save image as PNG
        signature2.addEventListener("endStroke", () => {
            sig2 = signature2.toDataURL()
            $('#sig2_value').val(sig2)
            console.log($('#sig2_value').val());
        }, {once: false});


        $('#signature_pm').hide();

        $('#tabs-report').click(function () {
            $('#signature_pm').hide();
            $('#signature_report').show();
        })

        $('#tabs-pm').click(function () {
            $('#signature_pm').show();
            $('#signature_report').hide();
        })

        //stepper
        var stepper1
        var stepper2
        document.addEventListener('DOMContentLoaded', function () {
            stepper1 = new Stepper(document.querySelector('#stepper1'), {
                linear: false
            })
            stepper2 = new Stepper(document.querySelector('#stepper2'), {
                linear: false
            })

        });

        // select2
        $('.select2').select2({
            closeOnSelect: false,
            placeholder: "-- กรุณาเลือกพนักงาน --",
            allowHtml: true,
            allowClear: true,
            tags: true,

        });

        // dynamic add row
        $(document).on("click", ".delete-row-1", function () {
            $(this).parents("tr").remove();
        });
        // add rows to table'
        $(document).ready(function () {
            var i = 0;
            $(".add-row-1").click(function () {
                var rowCount = $('.add-part-1 tr').length;
                var markup = '<tr>' + `<td>${rowCount}</td>` +
                    '<td>' + ' <select class="form-control select2productPart text-center" name="product_part_present[]"><option selected value="{{old('product_part_present[]')}}" disabled>-- กรุณาเลือก part --</option> </select>' + '</td>' +
                    '<td>' + '<input autocomplete="nope" type="number" class="form-control form-control-sm text-center" id="quantity_present"name="quantity_present[]" placeholder=""value="{{old('quantity_present')}}">' + '</td>' +
                    '<td>' + '<button class="btn btn-danger btn-xs delete-row-1"><i class="fas fa-trash"></i></button>' + '</td>' +
                    '</tr>';
                $('table.add-part-1').append(markup);

                // fetch Product Part with ajax
                $('.select2productPart').select2({
                    tags: true,
                    tokenSeparators: [',', ' '],
                    ajax: {
                        url: "{{route('ajax.select2.product_parts')}}",
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
            })
        });

        $(document).on("click", ".delete-row-2", function () {
            $(this).parents("tr").remove();
        });
        // add rows to table'
        $(document).ready(function () {
            var i = 0;
            $(".add-row-2").click(function () {
                var rowCount = $('.add-part-2 tr').length;
                var markup = '<tr>' + `<td>${rowCount}</td>` +
                    '<td>' + '<select class="form-control select2productPart text-center" name="product_part_future[]"> <option selected value="{{old('product_part_future[]')}}" disabled>-- กรุณาเลือก part --</option> </select></td>' +
                    '<td>' + '<input autocomplete="nope" type="number" class="form-control form-control-sm text-center" id="quantity_future"name="quantity_future[]" placeholder="" value="{{old('quantity_future')}}">' + '</td>' +
                    '<td>' + '<button class="btn btn-danger btn-xs delete-row-1"><i class="fas fa-trash"></i></button>' + '</td>' +
                    '</tr>';
                $('table.add-part-2').append(markup);

                // fetch Product Part with ajax
                $('.select2productPart').select2({
                    tags: true,
                    tokenSeparators: [',', ' '],
                    ajax: {
                        url: "{{route('ajax.select2.product_parts')}}",
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
            })
        });

        //collapse
        $('.mycard').CardWidget('collapse')

        //date calendar
        $(document).ready(function () {
            $('.datepicker').pickadate({
                formatSubmit: 'yyyy-mm-dd',
                selectMonths: true,
                selectYears: 20,
                // min: new Date,
            });
        });

        // fetch Product Part with ajax
        $('.select2productPart').select2({
            tags: true,
            tokenSeparators: [',', ' '],
            ajax: {
                url: "{{route('ajax.select2.product_parts')}}",
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

        // show image
        $(document).on('click', '.preview-img', function () {
            $('#preview-img-src').attr('src', $(this).data('src'))
            $('#preview-img').modal('show')
        })

        //upload image ใบรายงานช่าง
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
                    $(file.previewElement).append('&emsp;<a class="preview-img" target="_blank" style="cursor: pointer" data-src="' + file.dataURL + '"> ดูรูปภาพ</a>')
                    $(file.previewElement).append('<input type="hidden" name="images1[]" value="' + response.name + '">')
                    $(file.previewElement).append('<input type="hidden" name="images1_original_name[]" value="' + response.original_name + '">')
                },
                error: function (file, response) {
                    if ($.type(response) === "string")
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

        //upload image pm
        $('#imageDropzone2').dropzone(
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
                    $(file.previewElement).append('&emsp;<a class="preview-img" target="_blank" style="cursor: pointer" data-src="' + file.dataURL + '"> ดูรูปภาพ</a>')
                    $(file.previewElement).append('<input type="hidden" name="images2[]" value="' + response.name + '">')
                    $(file.previewElement).append('<input type="hidden" name="images2_original_name[]" value="' + response.original_name + '">')
                },
                error: function (file, response) {
                    if ($.type(response) === "string")
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
            $("#imageDropzone2").sortable({
                items: '.dz-preview',
                cursor: 'move',
                opacity: 0.5,
                containment: '#imageDropzone2',
                distance: 20,
                tolerance: 'pointer'
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
@endsection
