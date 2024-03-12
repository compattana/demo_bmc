@extends('adminlte::page')

@section('title', 'เปิดสัญญา - แก้ไขข้อมูล')

@section('content_header')
    <style type="text/css">
        @import url('https://fonts.googleapis.com/css2?family=Sarabun:wght@500;700&display=swap');

        body {
            font-family: 'Sarabun', sans-serif !important;
            background-color: #f3f3f3;
            font-size: 14px;
        }

        footer {
            position: fixed;

            bottom: 0px;
            left: 0px;
            right: 0px;
            background-color: white;
            margin-bottom: 0px;
            padding: 10px;
        }

        table {
            line-height: 2;
        }

        .table th, .table td {
            padding: 2px !important;
        }

        small, .small {
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
    <div class="row">
        <div class="col-sm-6">

        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{route('home')}}">หน้าแรก</a></li>
                <li class="breadcrumb-item"><a href="{{route('agreements.index')}}">จัดการเปิดสัญญา</a></li>
                <li class="breadcrumb-item active"> รายละเอียดสัญญา {{$agreement->title}}</li>
            </ol>
        </div>
    </div>
@stop

@section('content')

    <section class="content">
        <div class="container-fluid">
            <div class="invoice p-3 mb-3">
                <div class="row">
                    <div class="col-12">
                        {{--                    <div class="invoice p-3 mb-3">--}}
                        <div class="row">
                            <div class="col-12">
                                <h4>
                                    <img class="profile-user-img img-fluid " src="{{asset('/logo/logo.png')}}"
                                         style="border: white">
                                    <small class="float-right">บริษัท บุญไทยแมชชีนเนอรี่ คอมเพล็กซ์ จำกัด</small>
                                </h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <h3 class="text-center">
                                    รายละเอียดสัญญา
                                </h3>
                            </div>
                        </div>
                        <br/>
                        <div class="row invoice-info">
                            <div class="col-sm-4 invoice-col">
                                <div class="border_bottom_dot">
                                    <div class="border_bottom_dot_white"> ชื่อลูกค้า :</div>
                                    {{ $agreement->customer->organization_name }}
                                </div>
                            </div>
                            <div class="col-sm-4 invoice-col">
                                <div class="border_bottom_dot">
                                    <div class="border_bottom_dot_white"> เลขที่สัญญา :</div>
                                    {{ $agreement->code }}
                                </div>
                            </div>
                            <div class="col-sm-4 invoice-col">
                                <div class="border_bottom_dot">
                                    <div class="border_bottom_dot_white"> ใบกำกับภาษี :</div>
                                    {{ $agreement->tax_invoice }}
                                </div>
                            </div>
                            <div class="col-sm-4 invoice-col">
                                <div class="border_bottom_dot">
                                    <div class="border_bottom_dot_white"> ประเภทสัญญา :</div>
                                    @if( $agreement->contract_type == 'month')
                                        @php
                                            $contract_type = 'รายเดือน';
                                        @endphp
                                    @else
                                        @php
                                            $contract_type = 'รายปี';
                                        @endphp
                                    @endif
                                    {{ $contract_type }}
                                </div>
                            </div>
                            <div class="col-sm-4 invoice-col">
                                <div class="border_bottom_dot">
                                    <div class="border_bottom_dot_white"> ราคา :</div>
                                    {{ $agreement->price }}
                                </div>
                            </div>
                            <div class="col-sm-4 invoice-col">
                                <div class="border_bottom_dot">
                                    <div class="border_bottom_dot_white"> PM. ครั้ง :</div>
                                    {{ $agreement->contract }}
                                </div>
                            </div>
                            <div class="col-sm-4 invoice-col">
                                <div class="border_bottom_dot">
                                    <div class="border_bottom_dot_white"> PM. ครั้ง :</div>
                                    {{ $agreement->contract }}
                                </div>
                            </div>
                            <div class="col-sm-4 invoice-col">
                                <div class="border_bottom_dot">
                                    <div class="border_bottom_dot_white"> วันที่เริ่มสัญญา :</div>
                                    {{ \Carbon\Carbon::createFromFormat('Y-m-d',$agreement->start_contract)->translatedFormat('d F Y') }}
                                </div>
                            </div>
                            <div class="col-sm-4 invoice-col">
                                <div class="border_bottom_dot">
                                    <div class="border_bottom_dot_white"> วันที่จบสัญญา :</div>
                                    {{ \Carbon\Carbon::createFromFormat('Y-m-d',$agreement->end_contract)->translatedFormat('d F Y') }}
                                </div>
                            </div>

                        </div>
                        <br/>
                        <div class="row invoice-info">
                            <div class="col-md-12 table-responsive">
                                <table class="table table-striped table-bordered text-center">
                                    <thead>
                                    <tr>
                                        <th colspan="3">
                                            รายการสินค้าตามสัญญา
                                        </th>
                                    </tr>
                                    <tr>
                                        <th>
                                            #
                                        </th>
                                        <th>
                                            ชื่อสินค้า
                                        </th>
                                        <th>
                                            Product Serial
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php
                                        $i=1;
                                    @endphp
                                    @foreach($agreement->items()->has('productSerial')->get() as $item)
                                        <tr>
                                            <td>{{ $i }}</td>
                                            <td>
                                                <div class="border_bottom_dot">
                                                    {{$item->product->title}}
                                                </div>

                                            </td>
                                            <td>
                                                <div class="border_bottom_dot">
                                                    {{$item->productSerial->serial_name}}
                                                </div>
                                            </td>
                                        </tr>
                                        @php $i++ @endphp
                                    @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <br/>
                        <div class="row invoice-info">
                            <div class="col-sm-4 invoice-col">
                                <div class="border_bottom_dot">
                                    <div class="border_bottom_dot_white"> หมายเหตุ :</div>
                                    {{ $agreement->note }}
                                </div>
                            </div>


                        </div>
                        <br/>
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
    </section>


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

{{--@section('footer')--}}
{{--    <div class="text-right">--}}
{{--        <button type="button" onclick="confirmSubmit()" class="btn btn-primary"><i--}}
{{--                class="fas fa-fw fa-save mr-2"></i>--}}
{{--            บันทึกข้อมูล--}}
{{--        </button>--}}
{{--    </div>--}}
{{--@endsection--}}

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
@section('js')

    <script>

        $(document).on('click', '.preview-img', function () {
            $('#preview-img-src').attr('src', $(this).data('src'))
            $('#preview-img').modal('show')
        })
        // upload image
        $('#imageDropzone').dropzone(
            {
                url: '{{route('dropzone.store')}}',
                maxFilesize: 10, // MB
                addRemoveLinks: false,
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


    </script>
@stop
