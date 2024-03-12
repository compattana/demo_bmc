@extends('adminlte::page')

@section('title', 'ใบรายงาน')

@section('content_header')
    <div class="row">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark">
                <i class="fad fa-fw fa-file-signature"></i> แก้ไข PM
            </h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">หน้าแรก</a></li>
                <li class="breadcrumb-item"><a
                        href="{{ route('maintenances.product.index', ['maintenance' => $maintenance]) }}">ข้อมูลการเข้า
                        PM</a></li>
                <li class="breadcrumb-item active">PM</li>
            </ol>
        </div>
    </div>
@stop

@section('content')
    <div class="no-print">
        <div class="arrow-steps clearfix mb-3">
            <div class="step"><span> <i class="fas fa-list-ul"></i><a
                        href="{{ route('maintenances.index') }}">&nbsp;ข้อมูลการเข้า PM</a></span></div>
            <div class="step"><span><i class="fas fa-toolbox"></i><a
                        href="{{ route('maintenances.product.index', ['maintenance' => $maintenance]) }}">&nbsp;
                        Maintenance</a></span>
            </div>
            <div class="step current"><span><i class="fas fa-edit"></i>&nbsp; แก้ไขใบรายงาน</span></div>
        </div>
    </div>
    <blockquote class="quote-info ml-0 mr-0 no-print">
        <p><b>เลขที่สัญญา : </b>{{ $maintenance->agreement->code }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <b>ชื่อบริษัท : </b>{{ $maintenance->agreement->customer->organization_name }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <b>PM ครั้งที่ : </b>{{ $maintenance->round_pm }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <b>สินค้า : </b>{{ $product->product->title }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <b>สินค้า : </b>{{ $product->productSerial->serial_name }}
        </p>
    </blockquote>
    <form
        action="{{ route('maintenances.product.pm.update', ['maintenance' => $maintenance->id, 'product' => $product->id, 'pm' => $pm->id]) }}"
        method="post" id="formUpdate" enctype="multipart/form-data">
        @csrf
        @method('patch')
        <div class="card card-warning card-outline card-outline-tabs">
            <div class="card-header p-0 border-bottom-0">
                <ul class="nav nav-tabs no-print" id="custom-tabs-four-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="tabs-report" data-toggle="pill" href="#tabs-goto-report"
                            role="tab" aria-controls="tabs-goto-report" aria-selected="true">ใบรายงานช่าง</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="tabs-pm" data-toggle="pill" href="#tabs-goto-pm" role="tab"
                            aria-controls="tabs-goto-description" aria-selected="false">ใบ Preventive Maintenance</a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content" id="custom-tabs-four-tabContent">
                    <div class="tab-pane fade show active" id="tabs-goto-report" role="tabpanel"
                        aria-labelledby="tabs-report">
                        @include('maintenance.pm.show.technician_report')
                    </div>
                    <div class="tab-pane fade" id="tabs-goto-pm" role="tabpanel" aria-labelledby="tabs-pm">
                        @include('maintenance.pm.show.pm')
                    </div>
                </div>
            </div>
        </div>


        <div class="row" id="signature_report">
            <div class="col-md-6  no-print">
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
                                    <br />
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
            <div class="col-sm-6 invoice-col text-center  no-print">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fa-solid fa-image"></i>
                            รูปภาพ
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
            <div class="col-md-6 no-print">
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
                                    <br />
                                    <div class="wrapper-pad">
                                        <canvas id="sig2" class="signature-pad"></canvas>
                                    </div>
                                    <input type="hidden" id="sig2_value" name="sig2_value">
                                    <br><br>
                                    <div class="text-right pt-2">
                                        <button id="clear2" type="button" class="btn btn-danger">
                                            ยกเลิก
                                        </button>
                                    </div>
                                    <textarea id="signature2" name="signed2" style="display: none"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 invoice-col text-center no-print">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fa-solid fa-image"></i>
                            รูปภาพ
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

        <div class="card card-outline card-blue no-print">
            <div class="card-header">
                <h3 class="card-title">อื่น ๆ</h3>
                {{--                <div class="card-tools"> --}}
                {{--                    <button type="button" class="btn btn-tool" data-card-widget="collapse"> --}}
                {{--                        <i class="fas fa-minus"></i> --}}
                {{--                    </button> --}}
                {{--                </div> --}}
            </div>
            <div class="card-body">

                <label for="note">หมายเหตุ <span class="text-danger">*</span> </label>
                <div class="form-group">
                    @if ($technician_report_items)
                        @if ($technician_report_items->note == null)
                            @php
                                $note = old('note');
                            @endphp
                        @else
                            @php
                                $note = $technician_report_items->note;
                            @endphp
                        @endif
                    @else
                        @php $note = '' @endphp
                    @endif

                    <input autocomplete="nope" type="text"
                        class="form-control form-control-sm @error('note') is-invalid @enderror" id="note"
                        name="note" placeholder="" value="{{ $note }}">
                </div>

                <label for="note">สถานะงาน <span class="text-danger">*</span> </label>
                <div class="row mt-2">
                    <div class="col-md-2">
                        <div class="form-group clearfix">
                            <div class="icheck-primary d-inline">
                                <input type="radio" id="no_approve" name="status_report" value="no_approve"
                                    @if ($maintenance_report->status_report == 'no_approve') checked @endif />
                                <label for="no_approve">รอตรวจงาน</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group clearfix">
                            <div class="icheck-primary d-inline">
                                <input type="radio" id="warranty" name="status_report" value="warranty"
                                    @if ($maintenance_report->status_report == 'warranty') checked @endif />
                                <label for="warranty">Warranty</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group clearfix">
                            <div class="icheck-primary d-inline">
                                <input type="radio" id="wait_price" name="status_report" value="wait_price"
                                    @if ($maintenance_report->status_report == 'wait_price') checked @endif />
                                <label for="wait_price">รอเสนอราคา</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group clearfix">
                            <div class="icheck-primary d-inline">
                                <input type="radio" id="rework" name="status_report" value="rework"
                                    @if ($maintenance_report->status_report == 'rework') checked @endif />
                                <label for="rework">Rework</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group clearfix">
                            <div class="icheck-primary d-inline">
                                <input type="radio" id="job_close" name="status_report" value="job_close"
                                    @if ($maintenance_report->status_report == 'job_close') checked @endif />
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
                                    @if ($maintenance_report->status_report == 'other') checked @endif />
                                <label for="status_report">อื่นๆ</label>
                                <label for="other_check">
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
                                </label>
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



    <div class="modal fade" id="imagemodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal"><span
                            aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <img src="" class="imagepreview" style="width: 100%;">
                </div>
            </div>
        </div>
    </div>

@endsection
@section('footer')
    <div class="row no-print">
        <div class="col-6">
            <blockquote class="quote-warning m-0">
                <i class="icon fas fa-pen mr-2"></i> <strong>Edit Mode:</strong>
            </blockquote>
        </div>
        <div class="col-6">
            <div class="text-right">
                <button type="button" onClick="document.title = '{{$maintenance->agreement->customer->organization_name. ' ' .
                $product->productSerial->serial_name. ' '.\Carbon\Carbon::createFromFormat('Y-m-d', $maintenance_report->date)->translatedFormat('d F Y'). ' '.
                'PM ครั้งที่'.$maintenance->round_pm}}';window.print();" class="btn btn-secondary"><i class="fat fa-fw fa-print  mr-2"></i>
                    พิมพ์
                </button>
                <button type="button" onclick="confirmUpdate()" class="btn btn-primary"><i
                        class="fas fa-fw fa-save mr-2"></i>
                    บันทึกข้อมูล
                </button>
            </div>
        </div>
    </div>


@endsection
@section('css')
    <style>
        @media print {
            .page-break {
                page-break-before: always;
            }
        }

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

        .active .bs-stepper-circle {
            background-color: #ffc107;
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
            background-color: #ffc107;

        }

        .arrow-steps .step.current:after {
            border-left: 17px solid #ffc107;
        }

        .select2-container--default .select2-selection--multiple .select2-selection__rendered li:first-child.select2-search.select2-search--inline .select2-search__field {
            width: 100% !important;
            text-align: center;
        }

        .bs-stepper-circle {
            background-color: #6c757d !important;
        }

        .active>button>.bs-stepper-circle {
            background-color: #ffc107 !important;
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
    </style>
@stop
@section('plugins.i-check', true)
@section('plugins.bs-stepper', true)
@section('plugins.Select2', true)
@section('plugins.Dropzone', true)
@section('js')
    <script src="https://cdn.jsdelivr.net/npm/signature_pad@4.0.8/dist/signature_pad.umd.min.js"></script>
    <script>
        $('#signature_pm').hide();

        $('#tabs-report').click(function() {
            $('#signature_pm').hide();
            $('#signature_report').show();
        })

        $('#tabs-pm').click(function() {
            $('#signature_pm').show();
            $('#signature_report').hide();
        })


        //modal show image
        $(function() {
            $('.pop').on('click', function() {
                $('.imagepreview').attr('src', $(this).find('img').attr('src'));
                $('#imagemodal').modal('show');
            });
        });

        {{--    Signature Pad --}}
        var sig1;
        const signature1 = new SignaturePad(document.getElementById('sig1'), {});
        document.getElementById('clear').addEventListener('click', function(event) {
            signature1.clear();
        });
        signature1.toDataURL(); // save image as PNG
        signature1.addEventListener("endStroke", () => {
            sig1 = signature1.toDataURL()
            $('#sig1_value').val(sig1)
            console.log($('#sig1_value').val());
        }, {
            once: false
        });

        var sig2;
        const signature2 = new SignaturePad(document.getElementById('sig2'), {});
        document.getElementById('clear2').addEventListener('click', function(event) {
            signature2.clear();
        });
        signature2.toDataURL(); // save image as PNG
        signature2.addEventListener("endStroke", () => {
            sig2 = signature2.toDataURL()
            $('#sig2_value').val(sig2)
            console.log($('#sig2_value').val());
        }, {
            once: false
        });




        // show image
        $(document).on('click', '.preview-img', function() {
            $('#preview-img-src').attr('src', $(this).data('src'))
            $('#preview-img').modal('show')
        })

        //upload image ใบรายงานช่าง
        $('#imageDropzone').dropzone({
            url: '{{ route('dropzone.store') }}',
            maxFilesize: 10, // MB
            addRemoveLinks: true,
            acceptedFiles: 'image/jpeg,image/png,image/jpg',
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            success: function(file, response) {
                console.log(response)
                $(file.previewElement).append(
                    '&emsp;<a class="preview-img" target="_blank" style="cursor: pointer" data-src="' +
                    file.dataURL + '"> ดูรูปภาพ</a>')
                $(file.previewElement).append('<input type="hidden" name="images1[]" value="' +
                    response.name + '">')
                $(file.previewElement).append(
                    '<input type="hidden" name="images1_original_name[]" value="' + response
                    .original_name + '">')
            },
            init: function() {
                @if (isset($maintenance_report) && $images)
                    @foreach ($images as $key => $image)
                        var file = {!! json_encode($image) !!};
                        file.url_thumnail = '{!! $image->getUrl('thumbnail') !!}';
                        file.url = '{!! $image->getUrl() !!}';
                        file.name = '{!! $image->name !!}';
                        this.emit("addedfile", file);
                        this.emit("thumbnail", file, file.url_thumnail);
                        this.emit("complete", file);
                        $(file.previewElement).append(
                            '<input type="hidden" name="images[]" value="' + file.file_name +
                            '">')
                        $(file.previewElement).append(
                            '<input type="hidden" name="images_original_name[]" value="' + file
                            .original_name + '">')
                        $(file.previewElement).append(
                            '&emsp;<a class="preview-img" target="_blank" style="cursor: pointer" data-src="' +
                            file.url + '"> ดูภาพ</a>')
                    @endforeach
                @endif
            },

            dictFallbackMessage: "Your browser does not support drag'n'drop file uploads.",
            dictFallbackText: "Please use the fallback form below to upload your files like in the olden days.",
            dictFileTooBig: 'ไฟล์มีขนาดใหญ่ (@{{ filesize }}MiB). ไฟล์รองรับได้สูงสุด: @{{ maxFilesize }}MiB.',
            dictInvalidFileType: "You can't upload files of this type.",
            dictResponseError: "Server responded with @{{ statusCode }} code.",
            dictCancelUpload: "Cancel upload",
            dictCancelUploadConfirmation: "Are you sure you want to cancel this upload?",
            dictRemoveFile: "ลบรูปภาพ",
            dictMaxFilesExceeded: "You can not upload any more files.",
        })

        Dropzone.autoDiscover = false;
        $(function() {
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
        $('#imageDropzone2').dropzone({
            url: '{{ route('dropzone.store') }}',
            maxFilesize: 10, // MB
            addRemoveLinks: true,
            acceptedFiles: 'image/jpeg,image/png,image/jpg',
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            success: function(file, response) {
                console.log(response)
                $(file.previewElement).append(
                    '&emsp;<a class="preview-img" target="_blank" style="cursor: pointer" data-src="' + file
                    .dataURL + '"> ดูรูปภาพ</a>')
                $(file.previewElement).append('<input type="hidden" name="images2[]" value="' + response.name +
                    '">')
                $(file.previewElement).append('<input type="hidden" name="images2_original_name[]" value="' +
                    response.original_name + '">')
            },
            init: function() {
                @if (isset($preventive) && $images2)
                    @foreach ($images2 as $key => $image)
                        var file = {!! json_encode($image) !!};
                        file.url_thumnail = '{!! $image->getUrl('thumbnail') !!}';
                        file.url = '{!! $image->getUrl() !!}';
                        file.name = '{!! $image->name !!}';
                        this.emit("addedfile", file);
                        this.emit("thumbnail", file, file.url_thumnail);
                        this.emit("complete", file);
                        $(file.previewElement).append('<input type="hidden" name="images[]" value="' + file
                            .file_name + '">')
                        $(file.previewElement).append(
                            '<input type="hidden" name="images_original_name[]" value="' + file
                            .original_name + '">')
                        $(file.previewElement).append(
                            '&emsp;<a class="preview-img" target="_blank" style="cursor: pointer" data-src="' +
                            file.url + '"> ดูภาพ</a>')
                    @endforeach
                @endif
            },

            dictFallbackMessage: "Your browser does not support drag'n'drop file uploads.",
            dictFallbackText: "Please use the fallback form below to upload your files like in the olden days.",
            dictFileTooBig: 'ไฟล์มีขนาดใหญ่ (@{{ filesize }}MiB). ไฟล์รองรับได้สูงสุด: @{{ maxFilesize }}MiB.',
            dictInvalidFileType: "You can't upload files of this type.",
            dictResponseError: "Server responded with @{{ statusCode }} code.",
            dictCancelUpload: "Cancel upload",
            dictCancelUploadConfirmation: "Are you sure you want to cancel this upload?",
            dictRemoveFile: "ลบรูปภาพ",
            dictMaxFilesExceeded: "You can not upload any more files.",
        })
        Dropzone.autoDiscover = false;
        $(function() {
            $("#imageDropzone2").sortable({
                items: '.dz-preview',
                cursor: 'move',
                opacity: 0.5,
                containment: '#imageDropzone2',
                distance: 20,
                tolerance: 'pointer'
            });
        });

        //stepper
        var stepper1
        var stepper2
        document.addEventListener('DOMContentLoaded', function() {
            stepper1 = new Stepper(document.querySelector('#stepper1'), {
                linear: false
            })
            stepper2 = new Stepper(document.querySelector('#stepper2'), {
                linear: false
            })
        });

        $('.select2').select2({
            minimumResultsForSearch: Infinity
        });

        $(document).on("click", ".delete-row-1", function() {
            $(this).parents("tr").remove();
        });
        // add rows to table'
        $(document).ready(function() {
            var i = 0;
            $(".add-row-1").click(function() {
                var rowCount = $('.add-part-1 tr').length;
                var markup = '<tr>' + `<td>${rowCount}</td>` +
                    '<td>' +
                    '<input autocomplete="nope" type="text" class="form-control form-control-sm" id="product_part_present" name="product_part_present[]" placeholder="" value="{{ old('product_part_present') }}">' +
                    '</td>' +
                    '<td>' +
                    '<input autocomplete="nope" type="text"class="form-control form-control-sm " id="product_part_no_present" name="product_part_no_present[]" placeholder="" value="{{ old('product_part_no_present') }}"></td>' +
                    '<td>' +
                    '<input autocomplete="nope" type="text" class="form-control form-control-sm"id="quantity_present"name="quantity_present[]" placeholder=""value="{{ old('quantity_present') }}">' +
                    '</td>' +
                    '<td>' +
                    '<button class="btn btn-danger btn-xs delete-row-1"><i class="fas fa-trash"></i></button>' +
                    '</td>' +
                    '</tr>';
                $('table.add-part-1').append(markup);
            })
        });

        $(document).on("click", ".delete-row-2", function() {
            $(this).parents("tr").remove();
        });

        $(document).ready(function() {
            var i = 0;
            $(".add-row-2").click(function() {
                var rowCount = $('.add-part-2 tr').length;
                var markup = '<tr>' + `<td>${rowCount}</td>` +
                    '<td>' +
                    '<input autocomplete="nope" type="text" class="form-control form-control-sm" id="product_part_future" name="product_part_future[]" placeholder="" value="{{ old('product_part_future') }}">' +
                    '</td>' +
                    '<td>' +
                    '<input autocomplete="nope" type="text"class="form-control form-control-sm " id="product_part_no_future" name="product_part_no_future[]" placeholder="" value="{{ old('product_part_no_future') }}"></td>' +
                    '<td>' +
                    '<input autocomplete="nope" type="text" class="form-control form-control-sm"id="quantity_future"name="quantity_future[]" placeholder="" value="{{ old('quantity_future') }}">' +
                    '</td>' +
                    '<td>' +
                    '<button class="btn btn-danger btn-xs delete-row-1"><i class="fas fa-trash"></i></button>' +
                    '</td>' +
                    '</tr>';
                $('table.add-part-2').append(markup);
            })
        });

        function confirmUpdate() {
            Swal.fire({
                icon: 'info',
                title: 'แก้ไขข้อมูล',
                text: 'ยืนยันการแก้ไขข้อมูล',
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
