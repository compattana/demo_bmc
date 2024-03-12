<!doctype html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <meta name="author" content="Meeting Creative"/>

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>
        {{--        @yield('title',$customer->organization_name)--}}
    </title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/iCheck/1.0.3/skins/all.min.css">
    <!-- Stylesheets & Fonts -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.css">
    <link rel="stylesheet" href="{{ asset('fontawesome/css/all.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@200;400&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/ad8cf8f9e0.js" crossorigin="anonymous"></script>

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
</head>
<body>

<div class="body-inner">
    <div class="p-5">
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
                                        @foreach($items as $item)
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
    </div>
</div>
<footer>
    <div class="text-right">
        <button type="button" class="btn btn-primary print-window no-print">
            <i class="fas fa-fw fa-duotone fa-print mr-2"></i>
            พิมพ์เอกสาร
        </button>
        <button type="button" class="btn btn-success print-window no-print">
            <i class="fas fa-fw fa-duotone fa-phone mr-2"></i>
            ติดต่อ BMC Techno Air
        </button>
    </div>
</footer>

<script src="{{asset('js/client/jquery.js')}}"></script>
<script src="{{asset('js/client/plugins.js')}}"></script>
<!--Template functions-->
<script src="{{asset('js/client/functions.js')}}"></script>
<!-- jQuery Validate plugin files-->
<script src="{{asset('plugins/validate/validate.min.js')}}"></script>
<!-- jQuery Steps plugin files-->
<link href="{{asset('plugins/jquery-steps/jquery.steps.css')}}" rel="stylesheet">
<script src="{{asset('plugins/jquery-steps/jquery.steps.min.js')}}"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script src="{{asset('fontawesome/js/all.min.js')}}" crossorigin="anonymous"></script>
<script
    src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/iCheck/1.0.3/icheck.min.js"></script>
<script>
    $('.print-window').click(function () {
        window.print();
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
</body>
</html>
