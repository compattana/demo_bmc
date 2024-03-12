<section class="content">
    <div class="container-fluid">
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
                            PREVENTIVE MAINTENANCE GA COMPRESSOR
                        </h3>
                    </div>
                </div>
                <br/>
                <div class="row invoice-info">
                    <div class="col-sm-3 invoice-col">
                        <div class="border_bottom_dot">
                            <div class="border_bottom_dot_white"> Company Name :</div>
                            {{$maintenance_report->customer->organization_name}}
                        </div>
                    </div>
                    <div class="col-sm-3 invoice-col">
                        <div class="border_bottom_dot">
                            <div class="border_bottom_dot_white"> Contact Person :</div>
                            {{$preventive->contract_person}}
                        </div>
                    </div>
                    <div class="col-sm-3 invoice-col">
                        <div class="border_bottom_dot">
                            <div class="border_bottom_dot_white"> Agreement No. :</div>
                            {{$preventive->report_no}}
                        </div>
                    </div>
                    <div class="col-sm-3 invoice-col">
                        <div class="border_bottom_dot">
                            <div class="border_bottom_dot_white"> Compressor Type :</div>
                            {{$preventive->compressor_type}}
                        </div>
                    </div>
                    <div class="col-sm-3 invoice-col">
                        <div class="border_bottom_dot">
                            <div class="border_bottom_dot_white"> รุ่น :</div>
                            @if( $maintenance_report->product_id == null)
                                @php
                                    $product_id = old('product_id') ;
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
                            @if( $maintenance_report->product_serial_id == null)
                                @php
                                    $product_serial_id = old('	product_serial_id') ;
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
                            {{$preventive->report_no}}
                        </div>
                    </div>

                </div>
                <br/>
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
                                <th>
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
                            @foreach($model_items as $models)
                                <tr>
                                    @if($type_model != $models->productModel->type)
                                        @php
                                            $type_model = $models->productModel->type;
                                        @endphp
                                        <td style="vertical-align: middle;writing-mode: vertical-rl;transform: rotate(180deg); "
                                            rowspan="{{$count_model[$i]}}">
                                            @foreach (\App\Models\ProductModel::getTypeArray() as $key => $value)
                                                @if($models->productModel->type == $key)
                                                    {{$value}}
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
                                        {{ number_format($models->productModel->limit_value) }}
                                    </td>
                                    <td>
                                        <div class="border_bottom_dot">
                                            &nbsp;{{$models->last_record}}
                                        </div>
                                    </td>
                                    <td>
                                        <div class="border_bottom_dot">
                                            &nbsp;{{$models->present_record}}
                                        </div>
                                    </td>
                                    <td>
                                        <div class="border_bottom_dot">
                                            &nbsp;{{$models->result}}
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
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
                            @foreach($preventive_items as $preventive_item)
                                <tr>
                                    <td>
                                        {{$preventive_item->point}}
                                    </td>
                                    <td>
                                        <div class="border_bottom_dot">
                                            &nbsp;{{$preventive_item->dbi}}
                                        </div>
                                    </td>
                                    <td>
                                        <div class="border_bottom_dot">
                                            &nbsp;{{$preventive_item->dbm1}}
                                        </div>
                                    </td>
                                    <td>
                                        <div class="border_bottom_dot">
                                            &nbsp;{{$preventive_item->dbc1}}
                                        </div>
                                    </td>
                                    <td>
                                        <div class="border_bottom_dot">
                                            &nbsp;{{$preventive_item->dbm2}}
                                        </div>
                                    </td>
                                    <td>
                                        <div class="border_bottom_dot">
                                            &nbsp;{{$preventive_item->dbc2}}
                                        </div>
                                    </td>
                                    <td>
                                        <div class="border_bottom_dot">
                                            &nbsp;{{$preventive_item->pm_other}}
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
                                <th>
                                    Last
                                </th>
                                <th style="vertical-align: middle;writing-mode: vertical-rl;transform: rotate(180deg);">
                                    Checked
                                </th>
                                <th style="vertical-align: middle;writing-mode: vertical-rl;transform: rotate(180deg);">
                                    Cleaned
                                </th>
                                <th style="vertical-align: middle;writing-mode: vertical-rl;transform: rotate(180deg);">
                                    Adjust
                                </th>
                                <th style="vertical-align: middle;writing-mode: vertical-rl;transform: rotate(180deg);">
                                    Repair
                                </th>
                                <th style="vertical-align: middle;writing-mode: vertical-rl;transform: rotate(180deg);">
                                    Replace
                                </th>
                                <th style="vertical-align: middle;writing-mode: vertical-rl;transform: rotate(180deg);">
                                    Remarks
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @php
                                $type_inspection = '';
                                $j = 0;
                                 $x = 0;
                            @endphp
                            @foreach($inspection_items as $inspection)
                                <tr>
                                    @if($type_inspection != $inspection->inspection->type)
                                        @php
                                            $type_inspection = $inspection->inspection->type;
                                        @endphp
                                        <td style="vertical-align: middle;writing-mode: vertical-rl;transform: rotate(180deg);"
                                            rowspan="{{$count_inspection[$j]}}">
                                            @foreach (\App\Models\Inspection::getTypeArray() as $key => $value)
                                                @if($inspection->inspection->type == $key)
                                                    {{$value}}
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
                                    <td id="{{'limit_inspection'.$x}}">
                                        {{ number_format($inspection->inspection->limit_value) }}
                                        <input name="limit_inspection" type="hidden"
                                               value="{{$inspection->inspection->limit_value}}">
                                    </td>
                                    <td>
                                        @if($inspection->last_record_inspection == null)
                                            <div class="border_bottom_dot">
                                                &nbsp;
                                            </div>
                                        @else
                                            <div class="border_bottom_dot">
                                                &nbsp;{{number_format($inspection->last_record_inspection)}}
                                            </div>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="clearfix">
                                            <div class="icheck-info d-inline">
                                                <input type="checkbox" name="checked[]" disabled
                                                       @if($inspection->checked == '1') checked @endif value="1"
                                                       id="{{'checked'.$i}}">
                                                <label for="{{'checked'.$i}}"></label>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="clearfix">
                                            <div class="icheck-info d-inline">
                                                <input type="checkbox" name="cleaned[]" disabled
                                                       @if($inspection->cleaned == '1') checked @endif  value="1"
                                                       id="{{'cleaned'.$i}}">
                                                <label for="{{'cleaned'.$i}}"></label>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="clearfix">
                                            <div class="icheck-info d-inline">
                                                <input type="checkbox" name="adjust[]" disabled
                                                       @if($inspection->adjust == '1') checked @endif   value="1"
                                                       id="{{'adjust'.$i}}">
                                                <label for="{{'adjust'.$i}}"></label>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="clearfix">
                                            <div class="icheck-info d-inline">
                                                <input type="checkbox" name="repair[]" disabled
                                                       @if($inspection->repair == '1') checked @endif   value="1"
                                                       id="{{'repair'.$i}}">
                                                <label for="{{'repair'.$i}}"></label>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="clearfix">
                                            <div class="icheck-info d-inline">
                                                <input type="checkbox" name="replace[]" disabled
                                                       @if($inspection->replace == '1') checked @endif   value="1"
                                                       id="{{'replace'.$i}}">
                                                <label for="{{'replace'.$i}}"></label>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="clearfix">
                                            <div class="icheck-info d-inline">
                                                <input type="checkbox" name="remarks[]" disabled
                                                       @if($inspection->remarks == '1') checked @endif   value="1"
                                                       id="{{'remarks'.$i}}">
                                                <label for="{{'remarks'.$i}}"></label>
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
                                        &nbsp; {{$preventive->running}}
                                    </div>
                                </td>
                                <td rowspan="2" style="vertical-align: middle;writing-mode: vertical-rl;transform: rotate(180deg); ">
                                    Cycle
                                </td>
                                <td>
                                    Load (sec.)
                                </td>
                                <td>
                                    <div class="border_bottom_dot">
                                        &nbsp; {{$preventive->load1}}
                                    </div>
                                </td>
                                <td>
                                    <div class="border_bottom_dot">
                                        &nbsp;  {{$preventive->load2}}
                                    </div>
                                </td>
                                <td>
                                    <div class="border_bottom_dot">
                                        &nbsp; {{$preventive->load3}}
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Loading
                                </td>
                                <td>
                                    <div class="border_bottom_dot">
                                        &nbsp;{{$preventive->loading}}
                                    </div>
                                </td>
                                <td>
                                    UnLoad (sec.)
                                </td>
                                <td>
                                    <div class="border_bottom_dot">
                                        &nbsp; {{$preventive->unload1}}
                                    </div>
                                </td>
                                <td>
                                    <div class="border_bottom_dot">
                                        &nbsp; {{$preventive->unload2}}
                                    </div>
                                </td>
                                <td>
                                    <div class="border_bottom_dot">
                                        &nbsp;{{$preventive->unload3}}
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <br/>
                <div class="row invoice-info">
                    <div class="col-sm-4 invoice-col">
                        <div class="border_bottom_dot">
                            <div class="border_bottom_dot_white"> Filter Type :</div>
                            {{$preventive_replacement->filter_type}}
                        </div>
                    </div>
                    <div class="col-sm-4 invoice-col">
                        <div class="border_bottom_dot">
                            <div class="border_bottom_dot_white"> Last Replacement :</div>
                            {{$preventive_replacement->last_replacement}}
                        </div>
                    </div>
                    <div class="col-sm-4 invoice-col">
                        <div class="border_bottom_dot">
                            <div class="border_bottom_dot_white"> Parts replacement for the next times :</div>
                            {{$preventive_replacement->next_replacement}}
                        </div>
                    </div>
                    <div class="col-sm-12 invoice-col">
                        <div class="border_bottom_dot">
                            <div class="border_bottom_dot_white"> Result :</div>
                            {{$preventive->result_pm}}
                        </div>
                    </div>
                </div>
                <br/>
                <div class="row invoice-info">
                    <div class="col-sm-6 invoice-col">
                        <div class="border_bottom_dot_white"><b>ลงชื่อลูกค้า :</b></div>
                        <img
                            src="@if(!empty($preventive->getFirstMediaUrl('signed'))){{ $preventive->getFirstMediaUrl('signed') }}@else {{ asset('/images/no-image.jpeg') }} @endif"
                            style="width: 100%;  border: 1px solid #e5e5e5;}" alt="User Image">

                    </div>
                    <div class="col-sm-6 invoice-col">
                        <div class="border_bottom_dot_white"><b>รูปภาพลูกค้า :</b></div>
                        <img
                            src="@if(!empty($preventive->getFirstMediaUrl('image'))){{ $preventive->getFirstMediaUrl('image') }}@else {{ asset('/images/no-image.jpeg') }} @endif"
                            style="width: 100%" alt="User Image">
                    </div>
                </div>
                {{--                    </div>--}}
            </div>
        </div>
    </div>
</section>
