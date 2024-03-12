@extends('adminlte::page')

@section('title', 'การเข้าซ่อม : ' . $type_name)

@section('content_header')

    <div class="row">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark">
                <i class="fad fa-fw fa-file-signature"></i> การเข้าซ่อม : {{ $type_name }}
            </h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">หน้าแรก</a></li>
                <li class="breadcrumb-item">
                    <a href="{{ route('maintenance_reports.index', ['type' => $type]) }}">
                        ตารางการเข้าซ่อม : {{ $type_name }}
                    </a>
                </li>
                <li class="breadcrumb-item active">การเข้าซ่อม : {{ $type_name }}
                </li>
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
    <form
        action="{{ route('maintenance_reports.update', ['maintenance_report' => $maintenance_report->id, 'type' => $type]) }}"
        method="post" id="formUpdate" enctype="multipart/form-data">
        @csrf
        @method('patch')
        <div class="card card-primary card-outline card-outline-tabs">
            <div class="card-header p-0 border-bottom-0 no-print">
                <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active " id="tabs-report" data-toggle="pill" href="#tabs-goto-report"
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
                        @include('maintenance.non_pm.partials.show.technician_report')
                    </div>
                    <div class="tab-pane fade" id="tabs-goto-pm" role="tabpanel" aria-labelledby="tabs-pm">
                        @include('maintenance.non_pm.partials.show.pm')
                    </div>
                </div>
            </div>
        </div>


        <div class="row" id="signature_report">
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


        @if (!auth()->user()->isTechnician())
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
                        @if ($technician_report_items->note == null)
                            @php
                                $note = old('note');
                            @endphp
                        @else
                            @php
                                $note = $technician_report_items->note;
                            @endphp
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
        @endif
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
    <div class="text-right">
        <button type="button" class="btn btn-success print-window no-print">
            <i class="fas fa-fw fa-duotone fa-print mr-2"></i>
            พิมพ์เอกสาร
        </button>
        <button type="button" onclick="confirmSubmit()" class="btn btn-primary no-print"><i
                class="fas fa-fw fa-duotone fa-save mr-2"></i>
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
@endsection
@section('plugins.i-check', true)
@section('plugins.Dropzone', true)

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/signature_pad@4.0.8/dist/signature_pad.umd.min.js"></script>

    <script>
        $('.print-window').click(function() {
            window.print();
        });


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
                    '&emsp;<a class="preview-img" target="_blank" style="cursor: pointer" data-src="' +
                    file
                    .dataURL + '"> ดูรูปภาพ</a>')
                $(file.previewElement).append('<input type="hidden" name="images2[]" value="' +
                    response.name +
                    '">')
                $(file.previewElement).append(
                    '<input type="hidden" name="images2_original_name[]" value="' +
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
                        $(file.previewElement).append(
                            '<input type="hidden" name="images[]" value="' + file
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
                    return new Promise(function(resolve) {
                        $('#formUpdate').submit();
                    })
                }
            })
        }
    </script>
    </script>
@endsection
