<style>
    .icheck-info>input:first-child:not(:checked):not(:disabled):hover+label::before,
    .icheck-info>input:first-child:not(:checked):not(:disabled):hover+input[type=hidden]+label::before {
        border: 1px solid #D3CFC8;
    }

    .form-checkbox {
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
        box-shadow: none;
        position: relative;
        display: inline-block;
        height: 1em;
        width: 1em;
        vertical-align: middle;
        color: #4299e1;
        border-color: #e2e8f0;
        border-width: 1px;
        border-radius: 0.25rem;
        background-color: transparent;
        background-origin: border-box;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
        overflow: hidden;
    }

    .form-checkbox:focus {
        outline: none;
        box-shadow: 0 0 0 3px rgba(66, 153, 225, 0.5);
    }

    .form-checkbox:focus:not(:checked) {
        border-color: #63b3ed;
    }

    .form-checkbox::after {
        content: url("data:image/svg+xml,%3csvg viewBox='0 0 16 16' fill='SteelBlue' xmlns='http://www.w3.org/2000/svg'%3e%3cpath d='M5.707 7.293a1 1 0 0 0-1.414 1.414l2 2a1 1 0 0 0 1.414 0l4-4a1 1 0 0 0-1.414-1.414L7 8.586 5.707 7.293z'/%3e%3c/svg%3e");
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        opacity: 0;

    }


    .form-checkbox:checked::after {
        opacity: 1;
    }

    .form-checkbox::-ms-check {
        content: 'X';
        / / color: transparent;
        background: inherit;
        border-color: inherit;
        border-radius: inherit;
        border-width: 1px;
        padding: 10%;
        outline: solid 20px;
        outline-offset: -20px;
    }

    .bigger {
        width: 2em;
        height: 2em;
    }

    .VerticalText {
        writing-mode: vertical-rl;
        transform: rotate(180deg);
        vertical-align: middle !important;
        margin: 0 !important;
        margin-left: 5px !important;
    }
</style>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                {{-- <div class="invoice p-3 mb-3"> --}}
                <div class="row">
                    <div class="col-12">
                        <h4>
                            <img class="img-fluid " src="{{ asset('/logo/BMC-logo.png') }}" style="border: white"
                                width="10%">
                            <small class="float-right"><b>Technoair Service+</b></small>
                        </h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <h3 class="text-center">
                            PREVENTIVE MAINTENANCE GA COMPRESSOR
                        </h3>
                    </div>
                </div>
                <br />
                <div class="row invoice-info">
                    <div class="col-sm-3 invoice-col">
                        <div class="border_bottom_dot">
                            <div class="border_bottom_dot_white"> Company Name :</div>
                            {{ $maintenance_report->customer->organization_name }}
                        </div>
                    </div>
                    <div class="col-sm-3 invoice-col">
                        <div class="border_bottom_dot">
                            <div class="border_bottom_dot_white"> Contact Person :</div>
                            @if ($preventive == null)
                            @else
                                {{ $preventive->contract_person }}
                            @endif

                        </div>
                    </div>
                    <div class="col-sm-3 invoice-col">
                        <div class="border_bottom_dot">
                            <div class="border_bottom_dot_white"> Agreement No. :</div>
                            @if ($preventive == null)
                            @else
                                {{ $preventive->report_no }}
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-3 invoice-col">
                        <div class="border_bottom_dot">
                            <div class="border_bottom_dot_white"> Compressor Type :</div>
                            @if ($preventive == null)
                            @else
                                {{ $preventive->compressor_type }}
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-3 invoice-col">
                        <div class="border_bottom_dot">
                            <div class="border_bottom_dot_white"> รุ่น :</div>
                            @if ($maintenance_report->product_id == null)
                                @php
                                    $product_id = old('product_id');
                                @endphp
                            @else
                                @php
                                    $product_id = $maintenance_report->product->title;
                                @endphp
                            @endif
                            {{ $product_id }}
                        </div>
                    </div>
                    <div class="col-sm-3 invoice-col">
                        <div class="border_bottom_dot">
                            <div class="border_bottom_dot_white"> หมายเลขเครื่อง :</div>
                            @if ($maintenance_report->product_serial_id == null)
                                @php
                                    $product_serial_id = old('	product_serial_id');
                                @endphp
                            @else
                                @php
                                    $product_serial_id = $maintenance_report->productSerial->serial_name;
                                @endphp
                            @endif
                            {{ $product_serial_id }}
                        </div>
                    </div>
                    <div class="col-sm-3 invoice-col">
                        <div class="border_bottom_dot">
                            <div class="border_bottom_dot_white"> Report No :</div>
                            @if ($preventive == null)
                            @else
                                {{ $preventive->report_no }}
                            @endif
                        </div>
                    </div>

                </div>
                <br />
                <div class="row invoice-info">
                    <div class="col-md-6 table-responsive">
                        <table class="table table-striped table-bordered text-center">
                            <thead>
                                <tr>
                                    <th colspan="2" rowspan="2">
                                        <b>Reading/Measuring</b>
                                    </th>
                                    <th colspan="3">
                                        Record
                                    </th>
                                    <th rowspan="2">
                                        Result
                                    </th>
                                </tr>
                                <tr>
                                    <th>
                                        ค่าสูงสุด
                                    </th>
                                    <th style="min-width: 50px">
                                        Last
                                    </th>
                                    <th>
                                        Present
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $type_model = '';
                                    $i = 0;
                                @endphp
                                @if ($model_items)
                                    @foreach ($model_items as $models)
                                        <tr>
                                            @if ($type_model != $models->productModel->type)
                                                @php
                                                    $type_model = $models->productModel->type;
                                                @endphp
                                                <td style="vertical-align: middle;" rowspan="{{ $count_model[$i] }}">
                                                    @foreach (\App\Models\ProductModel::getTypeArray() as $key => $value)
                                                        @if ($models->productModel->type == $key)
                                                            <p
                                                                style="writing-mode: vertical-rl;transform: rotate(180deg); height:max-content!important; width:fit-content !important; ">
                                                                {{ $value }}</p>
                                                        @endif
                                                    @endforeach
                                                </td>
                                                @php
                                                    $i++;
                                                @endphp
                                            @endif
                                            <td>
                                                {{ $models->productModel->title }}
                                            </td>
                                            <td>
                                                {{-- {{ number_format($models->productModel->limit_value) }} --}}
                                                {{ $models->productModel->limit_value }}
                                            </td>
                                            <td>
                                                <div class="border_bottom_dot">
                                                    &nbsp;{{ $models->last_record }}
                                                </div>
                                            </td>
                                            <td>
                                                <div class="border_bottom_dot">
                                                    &nbsp;{{ $models->present_record }}
                                                </div>
                                            </td>
                                            <td>
                                                <div class="border_bottom_dot">
                                                    &nbsp;{{ $models->result }}
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif

                            </tbody>
                        </table>
                        <table class="table table-striped table-bordered text-center ">
                            <thead>
                                <tr>
                                    <td>
                                        Point
                                    </td>
                                    <td>
                                        dBI
                                    </td>
                                    <td>
                                        dBm
                                    </td>
                                    <td>
                                        dBc
                                    </td>
                                    <td>
                                        dBm
                                    </td>
                                    <td>
                                        dBc
                                    </td>
                                    <td>
                                        #
                                    </td>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($preventive)
                                    @foreach ($preventive_items->where('point', '!=', 'mot1')->where('point', '!=', 'mot2') as $preventive_item)
                                        <tr>
                                            <td>
                                                {{ $preventive_item->point }}
                                            </td>
                                            <td>
                                                <div class="border_bottom_dot">
                                                    &nbsp;{{ $preventive_item->dbi }}
                                                </div>
                                            </td>
                                            <td>
                                                <div class="border_bottom_dot">
                                                    &nbsp;{{ $preventive_item->dbm1 }}
                                                </div>
                                            </td>
                                            <td>
                                                <div class="border_bottom_dot">
                                                    &nbsp;{{ $preventive_item->dbc1 }}
                                                </div>
                                            </td>
                                            <td>
                                                <div class="border_bottom_dot">
                                                    &nbsp;{{ $preventive_item->dbm2 }}
                                                </div>
                                            </td>
                                            <td>
                                                <div class="border_bottom_dot">
                                                    &nbsp;{{ $preventive_item->dbc2 }}
                                                </div>
                                            </td>
                                            <td>
                                                <div class="border_bottom_dot">
                                                    &nbsp;{{ $preventive_item->other }}
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>

                        <table class="table table-striped table-bordered text-center ">
                            <thead>
                                <tr>
                                    <td>

                                    </td>
                                    <td>
                                        L1
                                    </td>
                                    <td>
                                        L2
                                    </td>
                                    <td>
                                        L3
                                    </td>

                                    <td>
                                        #
                                    </td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($preventive_items2 as $preventive_item2)
                                    <tr>
                                        <td>
                                            {{ $preventive_item2->point }}
                                        </td>
                                        <td>
                                            <div class="border_bottom_dot">
                                                &nbsp;{{ $preventive_item2->dbi }}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="border_bottom_dot">
                                                &nbsp;{{ $preventive_item2->dbm1 }}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="border_bottom_dot">
                                                &nbsp;{{ $preventive_item2->dbc1 }}
                                            </div>
                                        </td>

                                        <td>
                                            <div class="border_bottom_dot">
                                                &nbsp;{{ $preventive_item2->other }}
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="col-md-6 table-responsive">
                        <table class="table table-striped table-bordered text-center">
                            <thead>
                                <tr>
                                    <th colspan="2">
                                        Inspection
                                    </th>
                                    <th>
                                        รอบใช้งาน
                                    </th>
                                    <th style="min-width: 70px">
                                        Last
                                    </th>
                                    <th>
                                        <p class="VerticalText">Checked</p>
                                     </th>
                                     <th>
                                         <p class="VerticalText">Cleaned</p>
                                     </th>
                                     <th>
                                         <p class="VerticalText">Adjust</p>
                                     </th>
                                     <th>
                                         <p class="VerticalText">Repair</p>
                                     </th>
                                     <th>
                                         <p class="VerticalText">Replace</p>
                                     </th>
                                     <th>
                                         <p class="VerticalText">Remarks</p>
                                     </th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $type_inspection = '';
                                    $j = 0;
                                    $x = 0;
                                @endphp
                                @foreach ($inspection_items as $inspection)
                                    <tr>
                                        @if ($type_inspection != $inspection->inspection->type)
                                            @php
                                                $type_inspection = $inspection->inspection->type;
                                            @endphp
                                            <td style="vertical-align: middle" rowspan="{{ $count_inspection[$j] }}">
                                                @foreach (\App\Models\Inspection::getTypeArray() as $key => $value)
                                                    @if ($inspection->inspection->type == $key)
                                                        <p style="writing-mode: vertical-rl;transform: rotate(180deg); height:max-content!important; width:fit-content(20em) !important">
                                                            {{ $value }}</p>
                                                    @endif
                                                @endforeach
                                            </td>
                                            @php
                                                $j++;
                                            @endphp
                                        @endif
                                        <td>
                                            {{ $inspection->inspection->title }}
                                        </td>
                                        <td id="{{ 'limit_inspection' . $x }}">
                                            {{-- {{ number_format($inspection->inspection->limit_value) }} --}}
                                            {{ $inspection->inspection->limit_value }}
                                            <input name="limit_inspection" type="hidden"
                                                value="{{ $inspection->inspection->limit_value }}">
                                        </td>
                                        <td>
                                            @if ($inspection->last_record_inspection == null)
                                                <div class="border_bottom_dot">
                                                    &nbsp;
                                                </div>
                                            @else
                                                <div class="border_bottom_dot">
                                                    &nbsp;{{ $inspection->last_record_inspection }}
                                                </div>
                                            @endif
                                        </td>

                                        <td>
                                            <div class="clearfix">
                                                <div class="d-inline">
                                                    <input type="checkbox" name="checked[]" class="form-checkbox bigger"
                                                        onclick="javascript: return false;"
                                                        @if ($inspection->checked == '1') checked @endif value="1"
                                                        id="{{ 'checked' . $i }}">
                                                    <label for="{{ 'checked' . $i }}"></label>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="clearfix">
                                                <div class="d-inline">
                                                    <input type="checkbox" name="cleaned[]" class="form-checkbox bigger"
                                                        onclick="javascript: return false;"
                                                        @if ($inspection->cleaned == '1') checked @endif value="1"
                                                        id="{{ 'cleaned' . $i }}">
                                                    <label for="{{ 'cleaned' . $i }}"></label>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="clearfix">
                                                <div class=" d-inline">
                                                    <input type="checkbox" name="adjust[]"
                                                        class="form-checkbox bigger"
                                                        onclick="javascript: return false;"
                                                        @if ($inspection->adjust == '1') checked @endif
                                                        value="1" id="{{ 'adjust' . $i }}">
                                                    <label for="{{ 'adjust' . $i }}"></label>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="clearfix">
                                                <div class=" d-inline">
                                                    <input type="checkbox" name="repair[]"
                                                        class="form-checkbox bigger"
                                                        onclick="javascript: return false;"
                                                        @if ($inspection->repair == '1') checked @endif
                                                        value="1" id="{{ 'repair' . $i }}">
                                                    <label for="{{ 'repair' . $i }}"></label>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="clearfix">
                                                <div class=" d-inline">
                                                    <input type="checkbox" name="replace[]"
                                                        class="form-checkbox bigger"
                                                        onclick="javascript: return false;"
                                                        @if ($inspection->replace == '1') checked @endif
                                                        value="1" id="{{ 'replace' . $i }}">
                                                    <label for="{{ 'replace' . $i }}"></label>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="clearfix">
                                                <div class=" d-inline">
                                                    <input type="checkbox" name="remarks[]"
                                                        class="form-checkbox bigger"
                                                        onclick="javascript: return false;"
                                                        @if ($inspection->remarks == '1') checked @endif
                                                        value="1" id="{{ 'remarks' . $i }}">
                                                    <label for="{{ 'remarks' . $i }}"></label>
                                                </div>
                                            </div>
                                        </td>

                                    </tr>
                                    @php
                                        $i++;
                                        $x++;
                                    @endphp
                                @endforeach

                            </tbody>
                        </table>
                        <table class="table table-striped table-bordered text-center">
                            <tbody>
                                <tr>
                                    <td>
                                        Running
                                    </td>
                                    <td>
                                        <div class="border_bottom_dot">
                                            @if ($preventive == null)
                                            @else
                                                &nbsp; {{ $preventive->running }}
                                            @endif

                                        </div>
                                    </td>
                                    <td style="vertical-align: middle" rowspan="2">
                                        <p>Cycle</p>
                                    </td>
                                    <td>
                                        Load (sec.)
                                    </td>
                                    <td>
                                        <div class="border_bottom_dot">
                                            @if ($preventive == null)
                                            @else
                                                &nbsp; {{ $preventive->load1 }}
                                            @endif
                                        </div>
                                    </td>
                                    <td>
                                        <div class="border_bottom_dot">
                                            @if ($preventive == null)
                                            @else
                                                &nbsp; {{ $preventive->load2 }}
                                            @endif
                                        </div>
                                    </td>
                                    <td>
                                        <div class="border_bottom_dot">
                                            @if ($preventive == null)
                                            @else
                                                &nbsp; {{ $preventive->load3 }}
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Loading
                                    </td>
                                    <td>
                                        <div class="border_bottom_dot">
                                            @if ($preventive == null)
                                            @else
                                                &nbsp; {{ $preventive->loading }}
                                            @endif
                                        </div>
                                    </td>
                                    <td>
                                        UnLoad (sec.)
                                    </td>
                                    <td>
                                        <div class="border_bottom_dot">
                                            @if ($preventive == null)
                                            @else
                                                &nbsp; {{ $preventive->unload1 }}
                                            @endif
                                        </div>
                                    </td>
                                    <td>
                                        <div class="border_bottom_dot">
                                            @if ($preventive == null)
                                            @else
                                                &nbsp; {{ $preventive->unload2 }}
                                            @endif
                                        </div>
                                    </td>
                                    <td>
                                        <div class="border_bottom_dot">
                                            @if ($preventive == null)
                                            @else
                                                &nbsp; {{ $preventive->unload3 }}
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <br />
                <div class="row invoice-info">
                    <div class="col-sm-4 invoice-col">
                        <div class="border_bottom_dot">
                            <div class="border_bottom_dot_white"> Filter Type :</div>
                            @if ($preventive == null)
                            @else
                                {{ $preventive_replacement->filter_type }}
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-4 invoice-col">
                        <div class="border_bottom_dot">
                            <div class="border_bottom_dot_white"> Last Replacement :</div>
                            @if ($preventive == null)
                            @else
                                {{ $preventive_replacement->last_replacement }}
                            @endif

                        </div>
                    </div>
                    <div class="col-sm-4 invoice-col">
                        <div class="border_bottom_dot">
                            <div class="border_bottom_dot_white"> Parts replacement for the next times :</div>
                            @if ($preventive == null)
                            @else
                                {{ $preventive_replacement->next_replacement }}
                            @endif

                        </div>
                    </div>
                    <div class="col-sm-12 invoice-col">
                        <div class="border_bottom_dot">
                            <div class="border_bottom_dot_white"> Result :</div>
                            @if ($preventive == null)
                            @else
                                {{ $preventive->result_pm }}
                            @endif

                        </div>
                    </div>
                </div>
                <br />
                <div class="row invoice-info">
                    @if ($preventive != null)
                        @if (!empty($preventive->getFirstMediaUrl('signed')))
                            <div class="col-sm-6 invoice-col text-center">
                                <div class="border_bottom_dot_white"><b>ลงชื่อลูกค้า :</b></div>
                                <br>
                                <img src="@if (!empty($preventive->getFirstMediaUrl('signed'))) {{ $preventive->getFirstMediaUrl('signed') }}@else {{ asset('/images/no-image.jpeg') }} @endif"
                                    style="width: 200px;  border: 1px solid #e5e5e5;}" alt="User Image">

                            </div>
                            <div class="col-sm-6 invoice-col text-center">
                                <div class="border_bottom_dot_white"><b>รูปภาพลูกค้า :</b></div>
                                <br>
                                <div class="row justify-content-center">
                                    <div class="col-md-8">
                                        <div class="row">
                                            @foreach ($images2 as $image2)
                                                <a href="" onclick="return false;" data-gallery="gallery"
                                                    class="col-md-4 pop">
                                                    <img src="@if (empty($image2->getUrl('thumbnail'))) {{ asset('images/noimage.jpg') }} @else {{ $image2->getUrl('thumbnail') }} @endif"
                                                        class="img-fluid rounded">
                                                </a>
                                            @endforeach


                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endif

                </div>
                {{--                    </div> --}}
            </div>
        </div>
    </div>
</section>
