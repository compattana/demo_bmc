<style>
    .icheck-info > input:first-child:not(:checked):not(:disabled):hover + label::before, .icheck-info > input:first-child:not(:checked):not(:disabled):hover + input[type=hidden] + label::before {
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
        content:  url("data:image/svg+xml,%3csvg viewBox='0 0 16 16' fill='SteelBlue' xmlns='http://www.w3.org/2000/svg'%3e%3cpath d='M5.707 7.293a1 1 0 0 0-1.414 1.414l2 2a1 1 0 0 0 1.414 0l4-4a1 1 0 0 0-1.414-1.414L7 8.586 5.707 7.293z'/%3e%3c/svg%3e");
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
    // color: transparent;
        background: inherit;
        border-color: inherit;
        border-radius: inherit;
        border-width: 1px;
        padding: 10%;
        outline: solid 20px;
        outline-offset: -20px;
    }

    .bigger{
        width: 2em;
        height: 2em;
    }

</style>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                {{--                    <div class="invoice p-3 mb-3">--}}
                <div class="row">
                    <div class="col-12">
                        <h4>
                            <img class="img-fluid " src="{{asset('/logo/BMC-logo.png')}}"
                                 style="border: white" width="10%">
                            <small class="float-right"><b>Technoair Service+</b></small>
                        </h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <h3 class="text-center">
                            ใบรายงานช่าง
                        </h3>
                    </div>
                </div>
                <br/>
                <div class="row invoice-info">
                    <div class="col-sm-4 invoice-col">
                        <div class="border_bottom_dot">
                            <div class="border_bottom_dot_white"> วันที่ :</div>
                            @if($maintenance_report->date == null)
                                @php
                                    $date = old('date') ;
                                @endphp
                            @else
                                @php
                                    $date = \Carbon\Carbon::createFromFormat('Y-m-d', $maintenance_report->date)->translatedFormat('d F Y');
                                @endphp
                            @endif
                            {{ $date }}
                        </div>
                    </div>
                    <div class="col-sm-4 invoice-col">
                        <div class="border_bottom_dot">
                            <div class="border_bottom_dot_white"> ชื่อลูกค้า :</div>
                            @if( $maintenance_report->customer_id == null)
                                @php
                                    $customer = old('customer_id') ;
                                @endphp
                            @else
                                @php
                                    $customer = $maintenance_report->customer->organization_name;
                                @endphp
                            @endif
                            {{ $customer }}
                        </div>
                    </div>
                    <div class="col-sm-4 invoice-col">
                        <div class="border_bottom_dot">
                            <div class="border_bottom_dot_white"> ช่างผู้ดูแล :</div>
                            @foreach( $technicians as $technician)
                                {{ $technician->user->name }},
                            @endforeach
                        </div>
                    </div>
                    <div class="col-sm-4 invoice-col">
                        <div class="border_bottom_dot">
                            <div class="border_bottom_dot_white"> รถบริการ No :</div>
                            @if( $maintenance_report->car_no == null)
                                @php
                                    $car_no = old('car_no') ;
                                @endphp
                            @else
                                @php
                                    $car_no = $maintenance_report->car_no;
                                @endphp
                            @endif
                            {{ $maintenance_report->car_no }}
                        </div>
                    </div>
                    <div class="col-sm-4 invoice-col">
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
                    <div class="col-sm-4 invoice-col">
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
                    <div class="col-sm-4 invoice-col">
                        <div class="border_bottom_dot">
                            <div class="border_bottom_dot_white"> ความดัน Load/Unload :</div>
                            {{ $maintenance_report->pressure_load }}
                        </div>
                    </div>
                    <div class="col-sm-4 invoice-col">
                        <div class="border_bottom_dot">
                            <div class="border_bottom_dot_white"> ชม. ใช้งาน :</div>
                            {{ $maintenance_report->hour_used }}
                        </div>
                    </div>
                    <div class="col-sm-4 invoice-col">
                        <div class="border_bottom_dot">
                            <div class="border_bottom_dot_white">ชม. Load :</div>
                            {{ $maintenance_report->hour_load }}
                        </div>
                    </div>
                    <div class="col-sm-3 invoice-col">
                        <div class="border_bottom_dot">
                            <div class="border_bottom_dot_white">รุ่นของ Prefilter :</div>
                            {{ $maintenance_report->prefilter }}
                        </div>
                    </div>
                    <div class="col-sm-3 invoice-col">
                        <div class="border_bottom_dot">
                            <div class="border_bottom_dot_white"> วันที่เปลี่ยนครั้งสุดท้าย :</div>
                            @if($maintenance_report->last_change_prefilter_date == null)
                                @php
                                    $last_change_prefilter_date = old('last_change_prefilter_date') ;
                                @endphp
                            @else
                                @php
                                    $last_change_prefilter_date = \Carbon\Carbon::createFromFormat('Y-m-d', $maintenance_report->last_change_prefilter_date)->translatedFormat('d F Y');
                                @endphp
                            @endif
                            {{ $last_change_prefilter_date }}
                        </div>
                    </div>
                    <div class="col-sm-3 invoice-col">
                        <div class="border_bottom_dot">
                            <div class="border_bottom_dot_white"> รุ่นของ Afterfilter :</div>
                            {{ $maintenance_report->after_filter }}
                        </div>
                    </div>
                    <div class="col-sm-3 invoice-col">
                        <div class="border_bottom_dot">
                            <div class="border_bottom_dot_white">วันที่เปลี่ยนครั้งสุดท้าย :</div>
                            @if($maintenance_report->last_change_after_filter_date == null)
                                @php
                                    $last_change_after_filter_date = old('last_change_after_filter_date') ;
                                @endphp
                            @else
                                @php
                                    $last_change_after_filter_date = \Carbon\Carbon::createFromFormat('Y-m-d', $maintenance_report->last_change_after_filter_date)->translatedFormat('d F Y');
                                @endphp
                            @endif
                            {{ $last_change_after_filter_date }}
                        </div>
                    </div>
                    <div class="col-sm-3 invoice-col">
                        <div class="border_bottom_dot">
                            <div class="border_bottom_dot_white">เลขที่ข้อตกลงบำรุงรักษา :</div>
                            {{ $maintenance_report->maintenance_no }}
                        </div>
                    </div>
                    <div class="col-sm-3 invoice-col">
                        <div class="border_bottom_dot">
                            <div class="border_bottom_dot_white">จำนวนครั้งต่อปี :</div>
                            {{ $maintenance_report->contract }}
                        </div>
                    </div>
                    <div class="col-sm-3 invoice-col">
                        <div class="border_bottom_dot">
                            <div class="border_bottom_dot_white">วันที่ข้อตกลงหมดอายุ :</div>
                            @if($maintenance_report->end_contract == null)
                                @php
                                    $end_contract = old('end_contract') ;
                                @endphp
                            @else
                                @php
                                    $end_contract = \Carbon\Carbon::createFromFormat('Y-m-d', $maintenance_report->end_contract)->translatedFormat('d F Y');
                                @endphp
                            @endif
                            {{ $end_contract }}
                        </div>
                    </div>
                    <div class="col-sm-3 invoice-col">
                        <div class="border_bottom_dot">
                            <div class="border_bottom_dot_white">เข้ารับบริการครั้งที่ :</div>
                            {{ $maintenance_report->service_round }}
                        </div>
                    </div>
                </div>
                <br/>
                <div class="row invoice-info">
                    <div class="col-sm-3 invoice-col">
                        <u><b>อาการ Compressor</b></u>
                    </div>
                    <div class="col-sm-4 invoice-col">
                        <input type="checkbox" name="compressor_check" class="form-checkbox bigger"
                               onclick="javascript: return false;"
                               @if($maintenance_report->compressor_check=='1') checked @endif value="1"
                               id="compressor_check">
                        <label for="compressor_check">
                            <div class="border_bottom_dot">
                                <div class="border_bottom_dot_white"> ตรวจเช็คเครื่องตามวาระ</div>
                                {{ $maintenance_report->compressor_check_detail }}
                            </div>
                        </label>

                    </div>
                    <div class="col-sm-3 invoice-col">
                        <div class="border_bottom_dot">
                            <div class="border_bottom_dot_white">Max Pressure :</div>
                            {{ $maintenance_report->max_pressure }}
                        </div>
                    </div>
                    <div class="col-sm-2 invoice-col">

                    </div>
                    @php
                        $items = \App\Models\Compressor::query()->where('status',\App\Models\Compressor::STATUS_ACTIVE)->get();
                    @endphp
                    @foreach($items as $item)
                        <div class="col-sm-3 invoice-col">
                            <input type="checkbox" name="compressor_id[]" class="form-checkbox bigger"
                                   onclick="javascript: return false;"
                                   @foreach($compressor_items as $compressor_item) @if($compressor_item==$item->id) checked
                                   @endif @endforeach value="{{$item->id}}"
                                   id="{{$item->id}}">
                            <label for="{{$item->id}}">
                                {{ $item->title }}
                            </label>
                        </div>
                    @endforeach
                    <div class="col-sm-6 invoice-col">
                        <input type="checkbox" name="compressor_other_check" class="form-checkbox bigger"
                               onclick="javascript: return false;"
                               @if($maintenance_report->compressor_other_check=='1') checked
                               @endif value="1" readonly
                               id="compressor_other_check">
                        <label for="compressor_other_check">
                            <div class="border_bottom_dot">
                                <div class="border_bottom_dot_white"> อื่นๆ</div>
                                {{$maintenance_report->compressor_other}}
                            </div>
                        </label>
                    </div>
                </div>
                <div class="row invoice-info" style="margin-top: 10px">
                    <div class="col-sm-3 invoice-col">
                        <u><b>อาการ dryer</b></u>
                    </div>
                    <div class="col-sm-7 invoice-col" >
                        <div class="border_bottom_dot">
                            <div class="border_bottom_dot_white">Serial No. :</div>
                            {{ $maintenance_report->dryer_serial_no }}
                        </div>
                    </div>
                    @php
                        $items = \App\Models\Dryer::query()->where('status',\App\Models\Dryer::STATUS_ACTIVE)->get();
                    @endphp
                    @foreach($items as $item)
                        <div class="col-sm-3 invoice-col">

                                <input type="checkbox" name="dryer_id[]" class="form-checkbox bigger"
                                       onclick="javascript: return false;"
                                       @foreach($dryer_items as $dryer_item) @if($dryer_item==$item->id) checked
                                       @endif @endforeach  value="{{$item->id}}"
                                       id="{{$item->title}}">
                                <label for="{{$item->title}}">
                                    {{ $item->title }}
                                </label>


                        </div>
                    @endforeach
                    <div class="col-sm-3 invoice-col">
                            <input type="checkbox" name="dryer_other_check" class="form-checkbox bigger"
                                   onclick="javascript: return false;"
                                   @if($maintenance_report->dryer_other_check=='1') checked
                                   @endif  value="1"
                                   id="dryer_other_check">
                            <label for="dryer_other_check">
                                <div class="border_bottom_dot">
                                    <div class="border_bottom_dot_white">อื่นๆ</div>
                                    {{ $maintenance_report->dryer_other }}
                                </div>
                            </label>


                    </div>
                    <div class="col-sm-12 invoice-col" style="margin-top: 10px">
                        <div class="border_bottom_dot">
                            <div class="border_bottom_dot_white"><u><b>รายละเอียดเพิ่มเติมและการแก้ไข </b></u>
                            </div>
                            {{ $maintenance_report->detail }}
                        </div>
                    </div>
                </div>
                <br/>
                <div class="row invoice-info">
                    <div class="col-md-6 table-responsive">
                        <table class="table table-striped table-bordered text-center">
                            <thead>
                            <tr>
                                <th colspan="3">
                                    รายการอะไหล่ที่เปลี่ยน
                                </th>
                            </tr>
                            <tr>
                                <th>
                                    #
                                </th>
                                <th>
                                    ชื่อ / เลขที่อะไหล่
                                </th>
                                <th>
                                    จำนวน
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @php
                                $i=1;
                            @endphp
                            @foreach($part_change_present as $present)
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td>
                                        <div class="border_bottom_dot">
                                            {{$present->product_part_no}}
                                        </div>

                                    </td>
                                    <td>
                                        <div class="border_bottom_dot">
                                            {{$present->quantity}}
                                        </div>
                                    </td>
                                </tr>
                                @php $i++ @endphp
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-6 table-responsive">
                        <table class="table table-striped table-bordered text-center">
                            <thead>
                            <tr>
                                <td colspan="3">
                                    <b>รายการอะไหล่ที่จะทำการเปลี่ยน ในครั้งต่อไป</b>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    #
                                </td>
                                <td>
                                    <b>ชื่อ / เลขที่อะไหล่</b>
                                </td>
                                <td>
                                    <b>จำนวน</b>
                                </td>
                            </tr>
                            </thead>
                            <tbody>
                            @php
                                $i=1;
                            @endphp
                            @foreach($part_change_future as $future)
                                <tr>
                                    <td>
                                        {{ $i }}
                                    </td>
                                    <td>
                                        <div class="border_bottom_dot">
                                            {{$future->product_part_no}}
                                        </div>
                                    </td>
                                    <td>
                                        <div class="border_bottom_dot">
                                            {{$future->quantity}}
                                        </div>
                                    </td>
                                </tr>
                                @php $i++ @endphp
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-12 invoice-col text-center">
                        ทางลูกค้าได้รับสิ่งของตามรายการข้างบนนี้ จากบริษัท Technoair Service+
                        จำกัด ไว้ถูกต้องเรียบร้อย (อะไหล่ของเก่าได้มอบคืนแก่ทางลูกค้าแล้ว)
                    </div>
                </div>
                <br/>
                <hr>
                <div class="row invoice-info">
                    <div class="col-sm-2 invoice-col">
                        <div class="border_bottom_dot">
                            <div class="border_bottom_dot_white"> เวลาปกติ :</div>
                            @if( $maintenance_report->normal_start_time == '00:00:00' ) -
                            @else {{ \Carbon\Carbon::createFromFormat('H:i:s', $maintenance_report->normal_start_time)->translatedFormat('H.i น.') }} @endif

                        </div>
                    </div>
                    <div class="col-sm-2 invoice-col">
                        <div class="border_bottom_dot">
                            <div class="border_bottom_dot_white"> ถึง :</div>
                            @if( $maintenance_report->normal_end_time == '00:00:00' ) -
                            @else {{ \Carbon\Carbon::createFromFormat('H:i:s', $maintenance_report->normal_end_time)->translatedFormat('H.i น.') }} @endif
                        </div>
                    </div>
                    <div class="col-sm-3 invoice-col">
                        <div class="border_bottom_dot">
                            <div class="border_bottom_dot_white"> รวมชั่วโมงการทำงานปกติ :</div>
                            {{ $maintenance_report->total_normal_work_time }}
                        </div>
                    </div>
                    <div class="col-sm-4 invoice-col">

                    </div>
                    <div class="col-sm-2 invoice-col">
                        <div class="border_bottom_dot">
                            <div class="border_bottom_dot_white"> ทำงานล่วงเวลา :</div>
                            @if( $maintenance_report->ot_start_time == '00:00:00' ) -
                            @else {{ \Carbon\Carbon::createFromFormat('H:i:s', $maintenance_report->ot_start_time)->translatedFormat('H.i น.') }} @endif
                        </div>
                    </div>
                    <div class="col-sm-2 invoice-col">
                        <div class="border_bottom_dot">
                            <div class="border_bottom_dot_white"> ถึง :</div>
                            @if( $maintenance_report->ot_end_time == '00:00:00' ) -
                            @else {{ \Carbon\Carbon::createFromFormat('H:i:s', $maintenance_report->ot_end_time)->translatedFormat('H.i น.') }} @endif
                        </div>
                    </div>
                    <div class="col-sm-3 invoice-col">
                        <div class="border_bottom_dot">
                            <div class="border_bottom_dot_white"> รวมชั่วโมงการทำงานล่วงเวลา :</div>
                            {{ $maintenance_report->total_ot_work_time }}
                        </div>
                    </div>
                    <div class="col-sm-4 invoice-col">

                    </div>
                    <div class="col-sm-4 invoice-col">
                        <div class="border_bottom_dot">
                            <div class="border_bottom_dot_white"> จำนวนชั่วโมงเดินทางไป :</div>
                            {{ $maintenance_report->travel_time }} @if( $maintenance_report->travel_time != null)
                                ชั่วโมง @endif
                        </div>
                    </div>
                    <div class="col-sm-4 invoice-col">
                        <div class="border_bottom_dot">
                            <div class="border_bottom_dot_white"> จำนวนชั่วโมงเดินทางกลับ :</div>
                            {{ $maintenance_report->return_time }}  @if( $maintenance_report->return_time != null)
                                ชั่วโมง @endif
                        </div>
                    </div>
                    <div class="col-sm-4 invoice-col">
                        <div class="border_bottom_dot">
                            <div class="border_bottom_dot_white"> สถานะการทำงาน :</div>
                            @if($maintenance_report->status==\App\Models\TechnicianReport::STATUS_FINISHED)
                                @php
                                    $status = 'งานเรียบร้อย';
                                @endphp
                            @else
                                @php
                                    $status = 'งานยังไม่เรียบร้อย';
                                @endphp
                            @endif
                            {{ $status }}
                        </div>
                    </div>
                </div>
                <br/>
                <div class="row invoice-info">
                    @if(!empty($maintenance_report->getFirstMediaUrl('signed')))
                        <div class="col-md-6 invoice-col text-center">
                            <div class="border_bottom_dot_white"><b>ลงชื่อลูกค้า :</b></div>
                            <br>
                            <img
                                src="@if(!empty($maintenance_report->getFirstMediaUrl('signed'))){{ $maintenance_report->getFirstMediaUrl('signed') }}@else {{ asset('/images/no-image.jpeg') }} @endif"
                                style="width:200px;  border: 1px solid #e5e5e5;}" alt="User Image">
                        </div>
                        <div class="col-sm-6 invoice-col text-center">
                            <div class="border_bottom_dot_white"><b>รูปภาพลูกค้า :</b></div>
                            <br>
                            <div class="row justify-content-center">
                                <div class="col-md-8">
                                    <div class="row">
                                        @foreach ($images as $image)
                                            <a href="" onclick="return false;" data-gallery="gallery"
                                               class="col-md-4 pop">
                                                <img
                                                    src="@if(empty($image->getUrl('thumbnail'))) {{asset('images/noimage.jpg')}} @else {{$image->getUrl('thumbnail')}} @endif"
                                                    class="img-fluid rounded">
                                            </a>
                                        @endforeach


                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
                {{--                    </div>--}}
            </div>
        </div>
    </div>
</section>
