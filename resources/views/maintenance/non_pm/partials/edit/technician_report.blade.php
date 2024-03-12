<h2 class="text-center">ใบรายงานช่าง</h2>
<div id="stepper1" class="bs-stepper">
    <div class="bs-stepper-header" role="tablist">
        {{--            ข้อมูลทั่วไป--}}
        <div class="step" data-target="#test-nl-1">
            <button type="button" class="btn step-trigger">
                <span class="bs-stepper-circle">1</span>
                <span class="bs-stepper-label">ข้อมูลทั่วไป</span>
            </button>
        </div>
        <div class="line"></div>
        {{--            อาการเครื่อง--}}
        <div class="step" data-target="#test-nl-2">
            <button type="button" class="btn step-trigger">
                <span class="bs-stepper-circle">2</span>
                <span class="bs-stepper-label">อาการเครื่อง</span>
            </button>
        </div>
        <div class="line"></div>
        {{--            รายการอะไหล่ที่เปลี่ยน--}}
        <div class="step" data-target="#test-nl-3">
            <button type="button" class="btn step-trigger">
                <span class="bs-stepper-circle">3</span>
                <span class="bs-stepper-label">รายการอะไหล่ที่เปลี่ยน</span>
            </button>
        </div>
        <div class="line"></div>
        {{--            เวลาทำงาน--}}
        <div class="step" data-target="#test-nl-4">
            <button type="button" class="btn step-trigger">
                <span class="bs-stepper-circle">4</span>
                <span class="bs-stepper-label">เวลาทำงาน</span>
            </button>
        </div>
    </div>
    <div class="bs-stepper-content">
        {{--            ข้อมูลทั่วไป--}}
        <div id="test-nl-1" class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="card ">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="date">วันที่<span class="text-danger"> *</span> </label>
                                        <div class="form-group">
                                            @if($technician_report->date == null)
                                                @php
                                                    $date = old('date') ;
                                                @endphp
                                            @else
                                                @php
                                                    $date = \Carbon\Carbon::createFromFormat('Y-m-d', $technician_report->date)->translatedFormat('d F Y');
                                                @endphp
                                            @endif
                                            <input autocomplete="nope" type="text"
                                                   class="form-control form-control-sm datepicker text-center @error('date') is-invalid @enderror"
                                                   id="date" disabled
                                                   name="date" placeholder="" value="{{$date}}">
                                            @error('date')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="pm_no">PM เลขที่ </label>
                                    <div class="form-group">
                                        <input autocomplete="nope" type="text"
                                               class="form-control form-control-sm text-center @error('pm_no') is-invalid @enderror"
                                               id="pm_no" readonly
                                               name="pm_no" placeholder=""
                                               value="{{$technician_report->pm_no}}">
                                        @error('pm_no')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="customer_id">ชื่อหน่วยงาน </label>
                                    <div class="form-group text-center">
                                        @if($technician_report->customer_id == null)
                                            @php
                                                $organization_name = old('customer_id') ;
                                            @endphp
                                        @else
                                            @php
                                                $organization_name = $technician_report->customer->organization_name;
                                            @endphp
                                        @endif
                                        <input autocomplete="nope" type="text"
                                               class="form-control form-control-sm text-center @error('customer_id') is-invalid @enderror"
                                               id="customer_id" readonly
                                               name="customer_id" placeholder=""
                                               value="{{$organization_name}}">

                                        @error('customer_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="maintenance_no">เลขที่ข้อตกลงบำรุงรักษา </label>
                                    <div class="form-group">
                                        <input autocomplete="nope" type="text"
                                               class="form-control form-control-sm text-center @error('maintenance_no') is-invalid @enderror"
                                               id="maintenance_no" readonly
                                               name="maintenance_no" placeholder=""
                                               value="{{$technician_report->maintenance_no}}">
                                        @error('maintenance_no')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="contract">จำนวนครั้งต่อปี </label>
                                    <div class="form-group">
                                        <input autocomplete="nope" type="text"
                                               class="form-control form-control-sm text-center @error('contract') is-invalid @enderror"
                                               id="contract" readonly
                                               name="contract" placeholder=""
                                               value="{{$technician_report->contract}}">
                                        @error('contract')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="end_contract">วันที่ข้อตกลงหมดอายุ </label>
                                    <div class="form-group">
                                        @if($technician_report->end_contract == null)
                                            @php
                                                $end_contract = old('end_contract');
                                            @endphp
                                        @else
                                            @php
                                                $end_contract = Carbon\Carbon::createFromFormat('Y-m-d', $technician_report->end_contract)->translatedFormat('d F Y')
                                            @endphp
                                        @endif
                                        <input autocomplete="nope" type="text"
                                               class="form-control form-control-sm text-center @error('title') is-invalid @enderror"
                                               id="title" disabled
                                               name="title" placeholder="" value="{{$end_contract}}">
                                        @error('end_contract')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="service_round">เข้ารับบริการครั้งที่ </label>
                                    <div class="form-group">
                                        <input autocomplete="nope" type="text"
                                               class="form-control form-control-sm text-center @error('service_round') is-invalid @enderror"
                                               id="service_round" readonly
                                               name="service_round" placeholder=""
                                               value="{{$technician_report->service_round}}">
                                        @error('service_round')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="technician_id">ช่างผู้ดูแล<span class="text-danger"> *</span>
                                    </label>
                                    <div class="form-group">
                                        <div class="form-group">
                                            <select class="form-control technical" multiple="multiple" disabled
                                                    name="technician_id[]" style="width: 100%">
                                                @foreach($technicians as $technician)
                                                    <option
                                                        @foreach( $technician_pm as $item)@if( $item->technician_id == $technician->id ) selected
                                                        @endif @endforeach value="{{$technician->id}}">{{$technician->name}}</option>
                                                @endforeach
                                            </select>
                                            @error('technician_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        @error('technician_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <label for="product_id">รุ่น <span class="text-danger">* </span></label>
                                    <div class="form-group text-center">
                                        @if($technician_report->product_id == null)
                                            @php
                                                $product_id = old('product_id')
                                            @endphp
                                        @else @php  $product_id = $technician_report->product->title @endphp
                                        @endif
                                        <input autocomplete="nope" type="text"
                                               class="form-control form-control-sm text-center @error('product_id') is-invalid @enderror"
                                               id="product_id" readonly
                                               name="product_id" placeholder=""
                                               value="{{$product_id}}">
                                        @error('product_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <label for="product_serial_id">หมายเลขเครื่อง <span
                                            class="text-danger">*</span></label>
                                    <div class="form-group text-center">
                                        @if($technician_report->product_serial_id == null)
                                            @php
                                                $product_serial_id = old('product_serial_id')
                                            @endphp
                                        @else @php  $product_serial_id = $technician_report->productSerial->serial_name @endphp
                                        @endif
                                        <input autocomplete="nope" type="text"
                                               class="form-control form-control-sm text-center @error('product_serial_id') is-invalid @enderror"
                                               id="product_serial_id" readonly
                                               name="product_serial_id" placeholder=""
                                               value="{{$product_serial_id}}">
                                        @error('product_serial_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="car_no">รถบริการ <span class="text-danger"> *</span>
                                    </label>
                                    <div class="form-group">
                                        <input autocomplete="nope" type="text"
                                               class="form-control form-control-sm text-center @error('car_no') is-invalid @enderror"
                                               id="car_no" readonly
                                               name="car_no" placeholder=""
                                               value="{{$technician_report->car_no}}">
                                        @error('car_no')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <label for="pressure_load">ความดัน Load/Unload <span
                                            class="text-danger">*</span> : </label>
                                    <div class="form-group">
                                        <input autocomplete="nope" type="text"
                                               class="form-control form-control-sm text-center @error('pressure_load') is-invalid @enderror"
                                               id="pressure_load" readonly
                                               name="pressure_load" placeholder=""
                                               value="{{$technician_report->pressure_load}}">
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <label for="hour_used"> ชั่วโมงใช้งาน <span class="text-danger">*</span>
                                        :
                                    </label>
                                    <div class="form-group">
                                        <input autocomplete="nope" type="text"
                                               class="form-control form-control-sm text-center @error('hour_used') is-invalid @enderror"
                                               id="hour_used" readonly
                                               name="hour_used" placeholder=""
                                               value="{{$technician_report->hour_used}}">
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="hour_load"> ชั่วโมง Load <span
                                                class="text-danger">*</span> :
                                        </label>
                                        <input autocomplete="nope" type="text"
                                               class="form-control form-control-sm text-center @error('hour_load') is-invalid @enderror"
                                               id="hour_load" readonly
                                               name="hour_load" placeholder=""
                                               value="{{$technician_report->hour_load}}">
                                        @error('hour_load')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="prefilter"> รุ่นของ Pre-filter <span
                                                class="text-danger">*</span>:</label>
                                        <input autocomplete="nope" type="text"
                                               class="form-control form-control-sm text-center @error('prefilter') is-invalid @enderror"
                                               id="prefilter" readonly
                                               name="prefilter" placeholder=""
                                               value="{{$technician_report->prefilter}}">
                                        @error('prefilter')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="last_change_prefilter_date"> วันที่เปลี่ยนครั้งสุดท้าย<span
                                                class="text-danger">*</span>:</label>
                                        @if($technician_report->last_change_prefilter_date == null)
                                            @php
                                                $last_change_prefilter_date = old('last_change_prefilter_date')
                                            @endphp
                                        @else
                                            @php
                                                $last_change_prefilter_date = Carbon\Carbon::createFromFormat('Y-m-d', $technician_report->last_change_prefilter_date)->translatedFormat('d F Y')
                                            @endphp @endif
                                        <input type="text"
                                               class="form-control form-control-sm text-center  @error('last_change_prefilter_date') is-invalid @enderror"
                                               name="last_change_prefilter_date" disabled
                                               value="{{$last_change_prefilter_date}}">
                                        @error('last_change_prefilter_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="after_filter"> รุ่นของ After-filter <span
                                                class="text-danger">*</span>:</label>
                                        <input autocomplete="nope" type="text"
                                               class="form-control form-control-sm text-center @error('after_filter') is-invalid @enderror"
                                               id="after_filter" readonly
                                               name="after_filter" placeholder=""
                                               value="{{$technician_report->after_filter}}">
                                        @error('after_filter')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="last_change_after_filter_date">
                                            วันที่เปลี่ยนครั้งสุดท้าย<span class="text-danger">*</span>:</label>
                                        @if($technician_report->last_change_after_filter_date == null)
                                            @php
                                                $last_change_after_filter_date = old('last_change_after_filter_date')
                                            @endphp
                                        @else
                                            @php
                                                $last_change_after_filter_date = Carbon\Carbon::createFromFormat('Y-m-d', $technician_report->last_change_after_filter_date)->translatedFormat('d F Y')
                                            @endphp @endif
                                        <input type="text"
                                               class="form-control form-control-sm  text-center  @error('last_change_after_filter_date') is-invalid @enderror"
                                               name="last_change_after_filter_date" disabled
                                               value="{{$last_change_after_filter_date}}">
                                        @error('last_change_after_filter_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-right">
                <button class="btn btn-outline-secondary" type="button" onclick="stepper1.next()">ถัดไป</button>
            </div>
        </div>
        {{--            อาการเครื่อง--}}
        <div id="test-nl-2" class="content">
            <div class="col-md-12">
                <div id="accordion">
                    {{--                    อาการ compressor--}}
                    <div class="card card-outline-primary">
                        <div class="card-header">
                            <h4 class="card-title w-100">
                                <a class="d-block w-100" data-toggle="collapse" href="#collapseOne"
                                   aria-expanded="true">
                                    ชื่ออาการ Compressor
                                </a>
                            </h4>
                        </div>
                        <div id="collapseOne" class="collapse" data-parent="#accordion" style="">
                            <div class="card-body">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group ">
                                                <label>
                                                    <div class="icheck-success d-inline">
                                                        <input type="checkbox" name="compressor_check" disabled
                                                               @if($maintenance_report->compressor_check=='1') checked @endif value="1"
                                                               id="compressor_check">
                                                        <label for="compressor_check">
                                                            ตรวจเช็คเครื่องตามวาระ
                                                        </label>
                                                    </div>
                                                </label>
                                                <input autocomplete="nope" type="text"
                                                       class="form-control form-control-sm @error('compressor_check_detail') is-invalid @enderror"
                                                       id="compressor_check_detail" readonly
                                                       name="compressor_check_detail" placeholder=""
                                                       value="{{$maintenance_report->compressor_check_detail}}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="max_pressure">Max Pressure:</label>
                                                <input autocomplete="nope" type="text"
                                                       class="form-control form-control-sm @error('max_pressure') is-invalid @enderror"
                                                       id="max_pressure" readonly
                                                       name="max_pressure" placeholder=""
                                                       value="{{$maintenance_report->max_pressure}}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        @php
                                            $items = \App\Models\Compressor::query()->where('status',\App\Models\Compressor::STATUS_ACTIVE)->get();
                                        @endphp
                                        @foreach($items as $item)
                                            <div class="col-md-4">
                                                <div class="form-group clearfix">
                                                    <div class="icheck-primary d-inline">
                                                        <input type="checkbox" name="compressor_id[]" disabled
                                                               @foreach($compressor_items as $compressor_item) @if($compressor_item==$item->id) checked
                                                               @endif @endforeach value="{{$item->id}}"
                                                               id="{{$item->id}}">
                                                        <label for="{{$item->id}}">
                                                            {{ $item->title }}
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-2">
                                            <div class="form-group clearfix">
                                                <div class="icheck-primary d-inline">
                                                    <input type="checkbox" name="compressor_other_check" disabled
                                                           @if($maintenance_report->compressor_other_check=='1') checked
                                                           @endif value="1" readonly
                                                           id="compressor_other_check">
                                                    <label for="compressor_other_check">
                                                        อื่นๆ
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-10">
                                            <div class="form-group">
                                                <input autocomplete="nope" type="text"
                                                       class="form-control form-control-sm @error('compressor_other') is-invalid @enderror"
                                                       id="compressor_other" readonly
                                                       name="compressor_other" placeholder=""
                                                       value="{{$maintenance_report->compressor_other}}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{--                    อาการ dryer--}}
                    <div class="card card-outline-primary">
                        <div class="card-header">
                            <h4 class="card-title w-100">
                                <a class="d-block w-100" data-toggle="collapse" href="#collapseTwo">
                                    อาการ dryer
                                </a>
                            </h4>
                        </div>
                        <div id="collapseTwo" class="collapse" data-parent="#accordion">
                            <div class="card-body">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-2 col-sm-12">
                                                        <label for="name">Serial No :</label>
                                                    </div>
                                                    <div class="col-md-10 col-sm-12">
                                                        <input autocomplete="nope" type="text"
                                                               class="form-control form-control-sm @error('dryer_serial_no') is-invalid @enderror"
                                                               id="dryer_serial_no" readonly
                                                               name="dryer_serial_no" placeholder=""
                                                               value="{{$maintenance_report->dryer_serial_no}}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        @php
                                            $items = \App\Models\Dryer::query()->where('status',\App\Models\Dryer::STATUS_ACTIVE)->get();
                                        @endphp
                                        @foreach($items as $item)
                                            <div class="col-md-4">
                                                <div class="form-group clearfix">
                                                    <div class="icheck-primary d-inline">
                                                        <input type="checkbox" name="dryer_id[]" disabled
                                                               @foreach($dryer_items as $dryer_item) @if($dryer_item==$item->id) checked
                                                               @endif @endforeach  value="{{$item->id}}"
                                                               id="{{$item->title}}">
                                                        <label for="{{$item->title}}">
                                                            {{ $item->title }}
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2 col-sm-12">
                                            <div class="form-group clearfix">
                                                <div class="icheck-primary d-inline">
                                                    <input type="checkbox" name="dryer_other_check" disabled
                                                           @if($maintenance_report->dryer_other_check=='1') checked
                                                           @endif  value="1"
                                                           id="dryer_other_check">
                                                    <label for="dryer_other_check">
                                                        อื่นๆ
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-10 col-sm-12">
                                            <div class="form-group">
                                                <input autocomplete="nope" type="text"
                                                       class="form-control form-control-sm @error('dryer_other') is-invalid @enderror"
                                                       id="dryer_other" readonly
                                                       name="dryer_other" placeholder=""
                                                       value="{{$maintenance_report->dryer_other}}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{--                    รายละเอียดเพิ่มเติม--}}
                    <div class="card card-outline-primary">
                        <div class="card-header">
                            <h4 class="card-title w-100">
                                <a class="d-block w-100" data-toggle="collapse" href="#collapseThree">
                                    รายละเอียดเพิ่มเติมและการแก้ไข
                                </a>
                            </h4>
                        </div>
                        <div id="collapseThree" class="collapse show" data-parent="#accordion">
                            <div class="card-body">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                            <textarea class="form-control" name="detail" readonly
                                                      value="{{$maintenance_report->detail}}"
                                                      placeholder="" rows="3">{{$maintenance_report->detail}}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-right">
                <button class="btn btn-outline-secondary" type="button" onclick="stepper1.previous()">ย้อนกลับ
                </button>
                <button class="btn btn-outline-secondary" type="button" onclick="stepper1.next()">ถัดไป</button>
            </div>
        </div>
        {{--            รายการอะไหล่ที่เปลี่ยน--}}
        <div id="test-nl-3" class="content">
            <div class="col-md-12">
                <div id="accordion">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-outline-primary">
                                <div class="card-header">
                                    <h4 class="card-title w-100">
                                        <a class="d-block w-100" data-toggle="collapse" href="#collapseFour"
                                           aria-expanded="true">
                                            รายการอะไหล่ที่เปลี่ยน
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseFour" class="collapse show" data-parent="#accordion" style="">
                                    <div class="card-body">
                                        <table class="table table-striped text-center add-part-1">
                                            <thead>
                                            <tr>
                                                <th width="10%">#</th>
                                                <th width="70%">Product Part</th>
                                                <th width="20%">จำนวน</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @php
                                                $i=1;
                                            @endphp
                                            @foreach($part_change_present as $present)
                                                <tr>
                                                    <td width="10%">{{$i}}</td>
                                                    <td width="70%">
                                                        <input autocomplete="nope" type="text"
                                                               class="form-control form-control-sm text-center @error('product_part_present') is-invalid @enderror"
                                                               id="product_part_present" readonly
                                                               name="product_part_present[]" placeholder=""
                                                               value="{{$present->productPart->title . '/ เลขที่อะไหล่: ' .$present->productPart->part_no }}">
                                                        @error('product_part_present')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </td>
                                                    <td>
                                                        <input autocomplete="nope" type="text"
                                                               class="form-control form-control-sm text-center @error('quantity_present') is-invalid @enderror"
                                                               id="quantity_present" readonly
                                                               name="quantity_present[]" placeholder=""
                                                               value="{{$present->quantity}}">
                                                        @error('quantity_present')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </td>
                                                </tr>
                                                @php
                                                    $i++;
                                                @endphp
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    {{--                                            <div class="card-footer ">--}}
                                    {{--                                                <div class="float-right">--}}
                                    {{--                                                    <button type="button" class="btn btn-secondary add-row-1"><i--}}
                                    {{--                                                            class="fas fa-plus"></i>--}}
                                    {{--                                                        เพิ่ม--}}
                                    {{--                                                    </button>--}}

                                    {{--                                                </div>--}}
                                    {{--                                            </div>--}}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="card card-outline-primary">
                                <div class="card-header">
                                    <h4 class="card-title w-100">
                                        <a class="d-block w-100" data-toggle="collapse" href="#collapseFive">
                                            รายการอะไหล่ที่เปลี่ยนในครั้งถัดไป
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseFive" class="collapse show" data-parent="#accordion">
                                    <div class="card-body">
                                        <table class="table table-striped text-center add-part-2">
                                            <thead>
                                            <tr>
                                                <th width="10%">#</th>
                                                <th width="70%">Product Part</th>
                                                <th width="20%">จำนวน</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @php
                                                $i=1;
                                            @endphp
                                            @foreach($part_change_future as $future)
                                                <tr>
                                                    <td width="10%">{{$i}}</td>
                                                    <td width="70%">
                                                        <input autocomplete="nope" type="text"
                                                               class="form-control form-control-sm text-center @error('product_part_future') is-invalid @enderror"
                                                               id="product_part_future" readonly
                                                               name="product_part_future[]" placeholder=""
                                                               value="{{$future->productPart->title. '/ เลขที่อะไหล่: ' .$future->productPart->part_no }}">
                                                        @error('product_part_future')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </td>
                                                    <td>
                                                        <input autocomplete="nope" type="text"
                                                               class="form-control form-control-sm text-center @error('quantity_future') is-invalid @enderror"
                                                               id="quantity_future" readonly
                                                               name="quantity_future[]" placeholder=""
                                                               value="{{$future->quantity}}">
                                                        @error('quantity_future')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </td>
                                                </tr>
                                                @php
                                                    $i++;
                                                @endphp
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    {{--                                            <div class="card-footer ">--}}
                                    {{--                                                <div class="float-right">--}}
                                    {{--                                                    <button type="button" class="btn btn-secondary add-row-2"><i--}}
                                    {{--                                                            class="fas fa-plus"></i>--}}
                                    {{--                                                        เพิ่ม--}}
                                    {{--                                                    </button>--}}

                                    {{--                                                </div>--}}
                                    {{--                                            </div>--}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-right">
                <button class="btn btn-outline-secondary" type="button" onclick="stepper1.previous()">
                    ย้อนกลับ
                </button>
                <button class="btn btn-outline-secondary" type="button" onclick="stepper1.next()">ถัดไป
                </button>
            </div>
        </div>

        {{--            เวลาทำงาน--}}
        <div id="test-nl-4" class="content">
            <div class="col-md-12">
                <div class="card ">
                    <div class="card-body">
                        <div class="form-group">
                            <div class="row">
                                {{--                                        เวลาทำงานปกติ--}}
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-4 align-self-center text-center">
                                                <label for="normal_start_time">เวลาปกติ :</label>
                                            </div>
                                            <div class="col-4">
                                                <label for="start_hour">เวลา</label><br>
                                                <select class="form-control form-control-sm select2 text-center" disabled
                                                        name="normal_start_time_hour">
                                                    @if ($technician_report->normal_start_time == null )
                                                        @php
                                                            $normal_start_time_hour = old('normal_start_time_hour');
                                                        @endphp
                                                    @else
                                                        @php
                                                            $normal_start_time_hour = \Carbon\Carbon::createFromFormat('H:i:s', $technician_report->normal_start_time)->translatedFormat('H');
                                                        @endphp
                                                    @endif
                                                    @for($i=0;$i<24;$i++)
                                                        @php
                                                            $hour = str_pad(intval($i), 2, 0, STR_PAD_LEFT)
                                                        @endphp
                                                        <option @if($normal_start_time_hour==$hour) selected
                                                                @endif value="{{$hour}}">{{$hour}}</option>
                                                    @endfor
                                                </select>
                                            </div>
                                            <div class="col-4">
                                                <label for="start_minute">นาที</label><br>
                                                <select class="form-control form-control-sm select2 text-center" disabled
                                                        name="normal_start_time_minute">
                                                    @if ($technician_report->normal_start_time == null )
                                                        @php
                                                            $normal_start_time_minute = old('normal_start_time_minute');
                                                        @endphp
                                                    @else
                                                        @php
                                                            $normal_start_time_minute = \Carbon\Carbon::createFromFormat('H:i:s', $technician_report->normal_start_time)->translatedFormat('i');
                                                        @endphp
                                                    @endif
                                                    @for($i=0;$i<60;$i++)
                                                        @php
                                                            $minute = str_pad(intval($i), 2, 0, STR_PAD_LEFT)
                                                        @endphp
                                                        <option @if($normal_start_time_minute==$minute) selected
                                                                @endif value="{{$minute}}">{{$minute}}</option>
                                                    @endfor
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{--                                        นาที--}}
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-4 align-self-center text-center">
                                                <label for="normal_end_time">ถึง :</label>
                                            </div>
                                            <div class="col-4">
                                                <label for="start_hour">เวลา</label><br>
                                                <select class="form-control form-control-sm select2 text-center" disabled
                                                        name="normal_end_time_hour">
                                                    @if ($technician_report->normal_end_time == null )
                                                        @php
                                                            $normal_end_time_hour = old('normal_end_time_hour');
                                                        @endphp
                                                    @else
                                                        @php
                                                            $normal_end_time_hour = \Carbon\Carbon::createFromFormat('H:i:s', $technician_report->normal_end_time)->translatedFormat('H');
                                                        @endphp
                                                    @endif

                                                    @for($i=0;$i<24;$i++)
                                                        @php
                                                            $hour = str_pad(intval($i), 2, 0, STR_PAD_LEFT)
                                                        @endphp
                                                        <option @if($normal_end_time_hour==$hour) selected
                                                                @endif value="{{$hour}}">{{$hour}}</option>
                                                    @endfor
                                                </select>
                                            </div>
                                            <div class="col-4">
                                                <label for="start_minute">นาที</label><br>
                                                <select class="form-control form-control-sm select2 text-center" disabled
                                                        name="normal_end_time_minute">
                                                    @if ($technician_report->normal_end_time == null )
                                                        @php
                                                            $normal_end_time_minute = old('normal_end_time_minute');
                                                        @endphp
                                                    @else
                                                        @php
                                                            $normal_end_time_minute = \Carbon\Carbon::createFromFormat('H:i:s', $technician_report->normal_end_time)->translatedFormat('i');;
                                                        @endphp
                                                    @endif
                                                    @for($i=0;$i<60;$i++)
                                                        @php
                                                            $minute = str_pad(intval($i), 2, 0, STR_PAD_LEFT)
                                                        @endphp
                                                        <option @if($normal_end_time_minute==$minute) selected
                                                                @endif value="{{$minute}}">{{$minute}}</option>
                                                    @endfor
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{--                                        รวมชั่วโมง--}}
                                <div class="col-md-4">
                                    <label for="total_normal_work_time">รวมชั่วโมงการทำงานปกติ<span
                                            class="text-danger"> *</span>
                                    </label>
                                    <div class="form-group">
                                        <input autocomplete="nope" type="text"
                                               class="form-control form-control-sm text-center @error('total_normal_work_time') is-invalid @enderror"
                                               id="total_normal_work_time" readonly
                                               name="total_normal_work_time" placeholder=""
                                               value="{{$technician_report->total_normal_work_time}}">
                                        @error('total_normal_work_time')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                {{--                                        เวลาทำงาน ot--}}
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-4 align-self-center text-center">
                                                <label for="ot_start_time">ทำงานล่วงเวลา : </label>
                                            </div>
                                            <div class="col-4">
                                                <label for="start_hour">เวลา</label><br>
                                                <select class="form-control form-control-sm select2 text-center" disabled
                                                        name="ot_start_time_hour">
                                                    @if ($technician_report->ot_start_time == null)
                                                        @php
                                                            $ot_start_time_hour = old('ot_start_time_hour');
                                                        @endphp
                                                    @else
                                                        @php
                                                            $ot_start_time_hour = \Carbon\Carbon::createFromFormat('H:i:s', $technician_report->ot_start_time)->translatedFormat('H');
                                                        @endphp
                                                    @endif
                                                    @for($i=0;$i<24;$i++)
                                                        @php
                                                            $hour = str_pad(intval($i), 2, 0, STR_PAD_LEFT)
                                                        @endphp
                                                        <option value="{{$hour}}">{{$hour}}</option>
                                                    @endfor
                                                </select>
                                            </div>
                                            <div class="col-4">
                                                <label for="start_minute">นาที</label><br>
                                                <select class="form-control form-control-sm select2 text-center" disabled
                                                        name="ot_start_time_minute">
                                                    @if ($technician_report->ot_start_time == null)
                                                        @php
                                                            $ot_start_time_minute = old('ot_start_time_minute');
                                                        @endphp
                                                    @else
                                                        @php
                                                            $ot_start_time_minute = \Carbon\Carbon::createFromFormat('H:i:s', $technician_report->ot_start_time)->translatedFormat('i');;
                                                        @endphp
                                                    @endif
                                                    @for($i=0;$i<60;$i++)
                                                        @php
                                                            $minute = str_pad(intval($i), 2, 0, STR_PAD_LEFT)
                                                        @endphp
                                                        <option value="{{$minute}}">{{$minute}}</option>
                                                    @endfor
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{--                                        ถึงเวลา--}}
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="row ">
                                            <div class="col-4 align-self-center text-center">
                                                <label for="normal_end_time ">ถึง :</label>
                                            </div>
                                            <div class="col-4">
                                                <label for="start_hour">เวลา</label><br>
                                                <select class="form-control form-control-sm select2 text-center" disabled
                                                        name="ot_end_time_hour">
                                                    @if ($technician_report->ot_end_time == null)
                                                        @php
                                                            $ot_end_time_hour = old('ot_end_time_hour');
                                                        @endphp
                                                    @else
                                                        @php
                                                            $ot_end_time_hour = \Carbon\Carbon::createFromFormat('H:i:s', $technician_report->ot_end_time)->translatedFormat('H');
                                                        @endphp
                                                    @endif
                                                    @for($i=0;$i<24;$i++)
                                                        @php
                                                            $hour = str_pad(intval($i), 2, 0, STR_PAD_LEFT)
                                                        @endphp
                                                        <option value="{{$hour}}">{{$hour}}</option>
                                                    @endfor
                                                </select>
                                            </div>
                                            <div class="col-4">
                                                <label for="start_minute">นาที</label><br>
                                                <select class="form-control form-control-sm select2 text-center" disabled
                                                        name="ot_end_time_minute">
                                                    @if ($technician_report->ot_end_time == null)
                                                        @php
                                                            $ot_end_time_minute = old('ot_end_time_minute');
                                                        @endphp
                                                    @else
                                                        @php
                                                            $ot_end_time_minute = \Carbon\Carbon::createFromFormat('H:i:s', $technician_report->ot_end_time)->translatedFormat('i');;
                                                        @endphp
                                                    @endif

                                                    @for($i=0;$i<60;$i++)
                                                        @php
                                                            $minute = str_pad(intval($i), 2, 0, STR_PAD_LEFT)
                                                        @endphp
                                                        <option value="{{$minute}}">{{$minute}}</option>
                                                    @endfor
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{--                                        รวมชั่วโมง--}}
                                <div class="col-md-4">
                                    <label for="total_ot_work_time">รวมชั่วโมงการทำงานล่วงเวลา</label>
                                    <div class="form-group">
                                        <input autocomplete="nope" type="text"
                                               class="form-control form-control-sm text-center @error('total_ot_work_time') is-invalid @enderror"
                                               id="total_ot_work_time" readonly
                                               name="total_ot_work_time" placeholder=""
                                               value="{{$technician_report->total_ot_work_time}}">
                                        @error('total_ot_work_time')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                {{--                                        เวลาเดินทางไป--}}
                                <div class="col-md-4">
                                    <label for="travel_time">จำนวนชั่วโมงเดินทางไป (ชั่วโมง)<span
                                            class="text-danger"> *</span>
                                    </label>
                                    <div class="form-group">
                                        <input autocomplete="nope" type="text"
                                               class="form-control form-control-sm text-center @error('travel_time') is-invalid @enderror"
                                               id="travel_time" readonly
                                               name="travel_time" placeholder=""
                                               value="{{$technician_report->travel_time}}">
                                        @error('travel_time')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="return_time">จำนวนชั่วโมงเดินทางกลับ (ชั่วโมง)<span
                                            class="text-danger"> *</span>
                                    </label>
                                    <div class="form-group">
                                        <input autocomplete="nope" type="text"
                                               class="form-control form-control-sm text-center @error('return_time') is-invalid @enderror"
                                               id="return_time" readonly
                                               name="return_time" placeholder=""
                                               value="{{$technician_report->return_time}}">
                                        @error('return_time')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label>สถานะการทำงาน : </label>
                                    <div class="form-group ">
                                        <label>
                                            <input type="radio" name="status" disabled
                                                   @if($technician_report->status==\App\Models\TechnicianReport::STATUS_FINISHED)  checked
                                                   @endif
                                                   value="{{\App\Models\TechnicianReport::STATUS_FINISHED}}">
                                            งานเรียบร้อย
                                        </label>
                                        &emsp;
                                        <label>
                                            <input type="radio" name="status" disabled
                                                   @if($technician_report->status==\App\Models\TechnicianReport::STATUS_UNFINISHED)  checked
                                                   @endif
                                                   value="{{\App\Models\TechnicianReport::STATUS_UNFINISHED}}">
                                            งานยังไม่เสร็จ
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-right">
                <button class="btn btn-outline-secondary" type="button" onclick="stepper1.previous()">
                    ย้อนกลับ
                </button>
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
            <div class="card-body">
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-12">
                            <img
                                src="@if(!empty($technician_report->getFirstMediaUrl('signed'))){{ $technician_report->getFirstMediaUrl('signed') }}@else {{ asset('/images/no-image.jpeg') }} @endif"
                                style="width: 100%;  border: 1px solid #e5e5e5;}" alt="User Image">
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
                    <div class="row">
                        <div class="col-md-12">
                            <div class="preview">
                                <img
                                    src="@if(!empty($technician_report->getFirstMediaUrl('image'))){{ $technician_report->getFirstMediaUrl('image') }}@else {{ asset('/images/no-image.jpeg') }} @endif"
                                    style="width: 100%" alt="User Image">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


