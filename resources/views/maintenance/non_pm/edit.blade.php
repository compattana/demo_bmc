@extends('adminlte::page')

@section('title', 'การเข้าซ่อม : '.$type_name)

@section('content_header')

    <div class="row">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark">
                <i class="fad fa-fw fa-file-signature"></i> การเข้าซ่อม : {{$type_name}}
            </h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{route('home')}}">หน้าแรก</a></li>
                <li class="breadcrumb-item">
                    <a href="{{route('maintenance_reports.index', ['type' => $type])}}">
                        ตารางการเข้าซ่อม : {{$type_name}}
                    </a>
                </li>
                <li class="breadcrumb-item active">การเข้าซ่อม : {{$type_name}}
                </li>
            </ol>
        </div>
    </div>
@stop

@section('content')
    <div class="">
        <div class="arrow-steps clearfix mb-3">
            <div class="step"><span><i class="fad fa-toolbox"></i><a
                        href="{{route('maintenance_reports.index', ['type' => $type])}}">&nbsp; ตารางการเข้าซ่อม</a></span>
            </div>
            <div class="step current"><span><i class="fad fa-edit"></i>&nbsp; สร้างใบรายงาน</span></div>
        </div>
    </div>
    <blockquote class="quote-info ml-0 mr-0">
        <p>
            <b>ประเภทการเข้าซ่อม : </b>{{$type_name}}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <b>ชื่อบริษัท : </b> {{$maintenance_report->customer->organization_name}}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        </p>
    </blockquote>

    <form
        action="{{route('maintenance_reports.update',['maintenance_report' => $maintenance_report->id,'type' => $type])}}"
        method="post" id="formUpdate" enctype="multipart/form-data">
        @csrf
        @method('patch')
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
                        @include('maintenance.non_pm.partials.edit.technician_report')
                    </div>
                    <div class="tab-pane fade" id="tabs-goto-pm" role="tabpanel"
                         aria-labelledby="tabs-pm">
                        @include('maintenance.non_pm.partials.edit.pm')
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
                    @if($technician_report_items->note == null)
                        @php
                            $note = old('note') ;
                        @endphp
                    @else
                        @php
                            $note = $technician_report_items->note;
                        @endphp
                    @endif
                    <input autocomplete="nope" type="text"
                           class="form-control form-control-sm @error('note') is-invalid @enderror"
                           id="note"
                           name="note" placeholder="" value="{{$note}}">
                </div>

                <label for="note">สถานะงาน <span class="text-danger">*</span> </label>
                <div class="row mt-2">
                    <div class="col-md-2">
                        <div class="form-group clearfix">
                            <div class="icheck-primary d-inline">
                                <input type="radio" id="no_approve" name="status_report" value="no_approve" @if($maintenance_report->status_report == 'no_approve') checked @endif />
                                <label for="no_approve">รอตรวจงาน</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group clearfix">
                            <div class="icheck-primary d-inline">
                                <input type="radio" id="warranty" name="status_report" value="warranty" @if($maintenance_report->status_report == 'warranty') checked @endif />
                                <label for="warranty">Warranty</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group clearfix">
                            <div class="icheck-primary d-inline">
                                <input type="radio" id="wait_price" name="status_report" value="wait_price" @if($maintenance_report->status_report == 'wait_price') checked @endif />
                                <label for="wait_price">รอเสนอราคา</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group clearfix">
                            <div class="icheck-primary d-inline">
                                <input type="radio" id="rework" name="status_report" value="rework" @if($maintenance_report->status_report == 'rework') checked @endif />
                                <label for="rework">Rework</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group clearfix">
                            <div class="icheck-primary d-inline">
                                <input type="radio" id="job_close" name="status_report" value="job_close" @if($maintenance_report->status_report == 'job_close') checked @endif />
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
                                <input type="radio" id="status_report" name="status_report" value="other" @if($maintenance_report->status_report == 'other') checked @endif />
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
                            {{--                            <div class="icheck-primary d-inline">--}}
                            {{--                                <input type="checkbox" name="other_check" id="other_check" value="1">--}}

                            {{--                            </div>--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </form>
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
            width: 100%;
            height: 200px;
        }

        #sig1 canvas {
            width: 100% !important;
            height: auto;
        }

        #sig2 canvas {
            width: 100% !important;
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
    </style>
@stop
@section('plugins.i-check',true)
@section('plugins.bs-stepper', true)
@section('plugins.pickadatejs',true)
@section('plugins.Select2',true)
@section('plugins.Jqueryui',true)
@section('js')
    <script src="{{asset('js/signature_pad.js')}}"></script>
    <script>
        $('.technical').select2({
            closeOnSelect: false,
            allowHtml: true,
            allowClear: true,
            tags: true,
        });

        $('.select2customer').select2();
        // fetch data with ajax
        $('.product_serial_id').select2()
        // filter product serial
        $(document).on('change', '.product_id', function () {
            var product_id = $(this).val();
            var product_serial_object = $(".product_serial_id");
            console.log(product_id.text)
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

        function myFunction(e) {
            var select_product_id = document.getElementById('product_id');
            var option_product_id = select_product_id.options[select_product_id.selectedIndex];
            document.getElementById("product_id_pm").value = option_product_id.text;

            var select_product_serial = document.getElementById('product_serial_id');
            var option_product_serial = select_product_serial.options[select_product_serial.selectedIndex];
            document.getElementById("serial_name").value = option_product_serial.text;
        }

        // $(document).on("change", "#product_id", function () {
        //     var product_serial_object = $(".product_serial_id").val();
        //     if (product_serial_object.empty()) {
        //         alert(document.getElementById("serial_name").value = '');
        //     }
        //     alert(product_serial_object);
        // });

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

    </script>
    <script>

        $('.technical').select2({
            closeOnSelect: false,
            allowHtml: true,
            allowClear: true,
            tags: true,
        });

        // image preview
        $('.custom-file-input').on('change', function () {
            let fileName = $(this).val().split('\\').pop();
            $(this).next('.custom-file-label').addClass("selected").html(fileName);
        });

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
        var sig1 = $('#sig1').signature({syncField: '#signature1', syncFormat: 'PNG'});
        $('#clear1').click(function (e) {
            e.preventDefault();
            sig1.signature('clear');
            $("#signature1").val('');
        });

        var sig2 = $('#sig2').signature({syncField: '#signature2', syncFormat: 'PNG'});
        $('#clear2').click(function (e) {
            e.preventDefault();
            sig2.signature('clear');
            $("#signature2").val('');
        });

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
@endsection
