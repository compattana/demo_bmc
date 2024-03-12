<style>
    .card.card-outline-tabs .card-header a:hover {
        border-top: 3px solid transparent !important;
    }
</style>

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
                                            @php
                                                $date = \Carbon\Carbon::now()->translatedFormat('d F Y');
                                            @endphp
                                            <input autocomplete="nope" type="text"
                                                   class="form-control form-control-sm datepicker @error('date') is-invalid @enderror"
                                                   id="date_pm"
                                                   name="date_pm" placeholder="" value="{{$date}}">
                                            @error('date')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="name">PM เลขที่ </label>
                                    <div class="form-group">
                                        <input autocomplete="nope" type="text"
                                               class="form-control form-control-sm @error('title') is-invalid @enderror"
                                               id="title" readonly
                                               name="title" placeholder=""
                                               value="">
                                        @error('title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="name">ชื่อลูกค้า </label>
                                    <div class="form-group">
                                        <input autocomplete="nope" type="text"
                                               class="form-control form-control-sm @error('title') is-invalid @enderror"
                                               id="title" readonly
                                               name="title" placeholder=""
                                               value="{{$maintenance->agreement->customer->name}}">
                                        @error('title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="name">หน่วยงาน </label>
                                    <div class="form-group">
                                        <input autocomplete="nope" type="text"
                                               class="form-control form-control-sm @error('title') is-invalid @enderror"
                                               id="title" readonly
                                               name="title" placeholder=""
                                               value="{{$maintenance->agreement->customer->organization_name}}">
                                        @error('title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="name">เลขที่ข้อตกลงบำรุงรักษา </label>
                                    <div class="form-group">
                                        <input autocomplete="nope" type="text"
                                               class="form-control form-control-sm @error('title') is-invalid @enderror"
                                               id="title" readonly
                                               name="title" placeholder=""
                                               value="{{$maintenance->agreement->code}}">
                                        @error('title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="name">จำนวนครั้งต่อปี </label>
                                    <div class="form-group">
                                        <input autocomplete="nope" type="text"
                                               class="form-control form-control-sm @error('title') is-invalid @enderror"
                                               id="title" readonly
                                               name="title" placeholder=""
                                               value="{{$maintenance->agreement->contract}}">
                                        @error('title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="name">วันที่ข้อตกลงหมดอายุ </label>
                                    <div class="form-group">
                                        @php
                                            $end_contract = Carbon\Carbon::createFromFormat('Y-m-d', $maintenance->agreement->end_contract)->translatedFormat('d F Y')
                                        @endphp
                                        <input autocomplete="nope" type="text"
                                               class="form-control form-control-sm @error('title') is-invalid @enderror"
                                               id="title" readonly
                                               name="title" placeholder="" value="{{$end_contract}}">
                                        @error('title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="name">เข้ารับบริการครั้งที่ </label>
                                    <div class="form-group">
                                        <input autocomplete="nope" type="text"
                                               class="form-control form-control-sm @error('title') is-invalid @enderror"
                                               id="title" readonly
                                               name="title" placeholder=""
                                               value="{{$maintenance->round_pm}}">
                                        @error('title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="name">ช่างผู้ดูแล<span class="text-danger"> *</span>
                                    </label>
                                    <div class="form-group">
                                        <select class="form-control technician select2" multiple="multiple" name="technician_id[]" style="width: 100%">
                                            @foreach($technicians as $technician)
                                                <option
                                                    @foreach( $maintenance->technicianPm as $pm)@if( $pm->technician_id == $technician->id ) selected
                                                    @endif @endforeach value="{{$technician->id}}">{{$technician->name}}</option>
                                            @endforeach
                                        </select>
                                        @error('title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <label for="name">รุ่น <span class="text-danger">* </span></label>
                                    <div class="form-group text-center">
                                        <input autocomplete="nope" type="text"
                                               class="form-control form-control-sm @error('title') is-invalid @enderror"
                                               id="title" readonly
                                               name="title" placeholder=""
                                               value="{{$agreement_items->product->title}}">
                                        <input type="hidden" name="product_id" value="{{$agreement_items->product->id}}">
                                        @error('title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <label for="name">หมายเลขเครื่อง <span
                                            class="text-danger">*</span></label>
                                    <div class="form-group text-center">
                                        <input autocomplete="nope" type="text"
                                               class="form-control form-control-sm @error('title') is-invalid @enderror"
                                               id="title" readonly
                                               name="title" placeholder=""
                                               value="{{$agreement_items->productSerial->serial_name}}">
                                        <input type="hidden" name="product_serial_id" value="{{$agreement_items->productSerial->id}}">
                                        @error('title')
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
                                               class="form-control form-control-sm @error('car_no') is-invalid @enderror"
                                               id="car_no"
                                               name="car_no" placeholder="" value="{{old('car_no')}}">
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
                                               class="form-control form-control-sm @error('pressure_load') is-invalid @enderror"
                                               id="pressure_load"
                                               name="pressure_load" placeholder=""
                                               value="{{old('pressure_load')}}">
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <label for="hour_used"> ชั่วโมงใช้งาน <span class="text-danger">*</span>
                                        :
                                    </label>
                                    <div class="form-group">
                                        <input autocomplete="nope" type="text"
                                               class="form-control form-control-sm @error('hour_used') is-invalid @enderror"
                                               id="hour_used"
                                               name="hour_used" placeholder="" value="{{old('hour_used')}}">
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="hour_load"> ชั่วโมง Load <span
                                                class="text-danger">*</span> :
                                        </label>
                                        <input autocomplete="nope" type="text"
                                               class="form-control form-control-sm @error('hour_load') is-invalid @enderror"
                                               id="hour_load"
                                               name="hour_load" placeholder="" value="{{old('hour_load')}}">
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
                                               class="form-control form-control-sm @error('prefilter') is-invalid @enderror"
                                               id="prefilter"
                                               name="prefilter" placeholder="" value="{{old('prefilter')}}">
                                        @error('prefilter')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="last_change_prefilter_date"> วันที่เปลี่ยนครั้งสุดท้าย
                                            <span
                                                class="text-danger">*</span>
                                            :</label>
                                        <input type="text"
                                               class="form-control form-control-sm datepicker  @error('last_change_prefilter_date') is-invalid @enderror"
                                               name="last_change_prefilter_date"
                                               value="{{old('last_change_prefilter_date')}}">
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
                                               class="form-control form-control-sm @error('after_filter') is-invalid @enderror"
                                               id="after_filter"
                                               name="after_filter" placeholder="" value="{{old('after_filter')}}">
                                        @error('after_filter')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="last_change_after_filter_date"> วันที่เปลี่ยนครั้งสุดท้าย
                                            <span
                                                class="text-danger">*</span>
                                            :</label>
                                        <input type="text"
                                               class="form-control form-control-sm datepicker  @error('last_change_after_filter_date') is-invalid @enderror"
                                               name="last_change_after_filter_date"
                                               value="{{old('last_change_after_filter_date')}}">
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
                                                        <input type="checkbox" name="compressor_check" value="1"
                                                               id="checkboxPrimary1">
                                                        <label for="checkboxPrimary1">
                                                            ตรวจเช็คเครื่องตามวาระ
                                                        </label>
                                                    </div>
                                                </label>
                                                <input autocomplete="nope" type="text"
                                                       class="form-control form-control-sm @error('compressor_check_detail') is-invalid @enderror"
                                                       id="compressor_check_detail"
                                                       name="compressor_check_detail" placeholder=""
                                                       value="{{old('compressor_check_detail')}}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="max_pressure">Max Pressure:</label>
                                                <input autocomplete="nope" type="text"
                                                       class="form-control form-control-sm @error('max_pressure') is-invalid @enderror"
                                                       id="max_pressure"
                                                       name="max_pressure" placeholder=""
                                                       value="{{old('max_pressure')}}">
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
                                                        <input type="checkbox" name="compressor_id[]"
                                                               value="{{$item->id}}"
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
                                                    <input type="checkbox" name="compressor_other_check" value="1"
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
                                                       id="compressor_other"
                                                       name="compressor_other" placeholder=""
                                                       value="{{old('compressor_other')}}">
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
                                    ชื่ออาการ dryer
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
                                                               id="dryer_serial_no"
                                                               name="dryer_serial_no" placeholder=""
                                                               value="{{old('dryer_serial_no')}}">
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
                                                        <input type="checkbox" name="dryer_id[]"
                                                               value="{{$item->id}}"
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
                                                    <input type="checkbox" name="dryer_other_check" value="1"
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
                                                       id="dryer_other"
                                                       name="dryer_other" placeholder=""
                                                       value="{{old('dryer_other')}}">
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
                                            <textarea class="form-control" name="detail" value="{{old('detail')}}"
                                                      placeholder="" rows="3"></textarea>
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
                                                <th>#</th>
                                                <th width="50%">Product Part</th>
                                                <th width="20%">จำนวน</th>
                                                <th>#</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td width="50%">

                                                    <select
                                                        class="form-control select2productPart text-center @error('product_part_present') is-invalid @enderror"
                                                        name="product_part_present[]" style="width: 100%">
                                                        <option selected value="{{old('product_part_present[]')}}"
                                                                disabled>-- กรุณาเลือก part --
                                                        </option>
                                                    </select>
                                                    @error('product_part_present')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </td>
                                                <td>
                                                    <input autocomplete="nope" type="number"
                                                           class="form-control form-control-sm text-center @error('quantity_present') is-invalid @enderror"
                                                           id="quantity_present"
                                                           name="quantity_present[]" placeholder=""
                                                           value="{{old('quantity_present')}}">
                                                    @error('quantity_present')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </td>
                                                <td>
                                                    <button class="btn btn-danger btn-xs delete-row-1"><i
                                                            class="fas fa-trash"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="card-footer ">
                                        <div class="float-right">
                                            <button type="button" class="btn btn-secondary add-row-1"><i
                                                    class="fas fa-plus"></i>
                                                เพิ่ม
                                            </button>

                                        </div>
                                    </div>
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
                                                <th>#</th>
                                                <th width="50%">Product Part</th>
                                                <th width="20%">จำนวน</th>
                                                <th>#</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td width="50%">
                                                    <select
                                                        class="form-control select2productPart text-center @error('product_part_future') is-invalid @enderror"
                                                        name="product_part_future[]" style="width: 100%">
                                                        <option selected value="{{old('product_part_future[]')}}"
                                                                disabled>-- กรุณาเลือก part --
                                                        </option>
                                                    </select>
                                                    @error('product_part_present')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </td>

                                                <td>
                                                    <input autocomplete="nope" type="number"
                                                           class="form-control form-control-sm text-center @error('quantity_future') is-invalid @enderror"
                                                           id="quantity_future"
                                                           name="quantity_future[]" placeholder=""
                                                           value="{{old('quantity_future')}}">
                                                    @error('quantity_future')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </td>
                                                <td>
                                                    <button class="btn btn-danger btn-xs delete-row-2"><i
                                                            class="fas fa-trash"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="card-footer ">
                                        <div class="float-right">
                                            <button type="button" class="btn btn-secondary add-row-2"><i
                                                    class="fas fa-plus"></i>
                                                เพิ่ม
                                            </button>

                                        </div>
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
                                {{--                                    เวลาทำงานปกติ--}}
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-4 align-self-center text-center">
                                                <label for="normal_start_time">เวลาปกติ :</label>
                                            </div>

                                            <div class="col-4">
                                                <label for="start_hour">เวลา</label><br>
                                                <select class="form-control form-control-sm select2"
                                                        name="normal_start_time_hour" style="width: 100%">
                                                    @if (old('normal_start_time_hour'))
                                                        @php
                                                            $normal_start_time_hour = old('normal_start_time_hour');
                                                        @endphp

                                                    @else
                                                        @php
                                                            $normal_start_time_hour = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $maintenance->appointment_date)->translatedFormat('H');
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
                                                <select class="form-control form-control-sm select2"
                                                        name="normal_start_time_minute" style="width: 100%">
                                                    @if (old('normal_start_time_minute'))
                                                        @php
                                                            $normal_start_time_minute = old('normal_start_time_minute');
                                                        @endphp
                                                    @else
                                                        @php
                                                            $normal_start_time_minute = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $maintenance->appointment_date)->translatedFormat('i');;
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
                                {{--                                    นาที--}}
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-4 align-self-center text-center">
                                                <label for="normal_end_time">ถึง :</label>
                                            </div>
                                            <div class="col-4">
                                                <label for="start_hour">เวลา</label><br>
                                                <select class="form-control form-control-sm select2"
                                                        name="normal_end_time_hour" style="width: 100%">
                                                    @if (old('normal_end_time_hour'))
                                                        @php
                                                            $normal_end_time_hour = old('normal_end_time_hour');
                                                        @endphp

                                                    @else
                                                        @php
                                                            $normal_end_time_hour = \Carbon\Carbon::now()->translatedFormat('H');
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
                                                <select class="form-control form-control-sm select2"
                                                        name="normal_end_time_minute" style="width: 100%">
                                                    @if (old('normal_end_time_minute'))
                                                        @php
                                                            $normal_end_time_minute = old('normal_end_time_minute');
                                                        @endphp
                                                    @else
                                                        @php
                                                            $normal_end_time_minute = \Carbon\Carbon::now()->translatedFormat('i');;
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
                                {{--                                    รวมชั่วโมง--}}
                                <div class="col-md-4">
                                    <label for="total_normal_work_time">รวมชั่วโมงการทำงานปกติ<span
                                            class="text-danger"> *</span>
                                    </label>
                                    <div class="form-group">
                                        <input autocomplete="nope" type="text"
                                               class="form-control form-control-sm @error('total_normal_work_time') is-invalid @enderror"
                                               id="total_normal_work_time"
                                               name="total_normal_work_time" placeholder=""
                                               value="{{old('total_normal_work_time')}}">
                                        @error('total_normal_work_time')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                {{--                                    เวลาทำงาน ot--}}
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-4 align-self-center text-center">
                                                <label for="ot_start_time">ทำงานล่วงเวลา : </label>
                                            </div>
                                            <div class="col-4">
                                                <label for="start_hour">เวลา</label><br>
                                                <select class="form-control form-control-sm select2"
                                                        name="ot_start_time_hour" style="width: 100%">
                                                    @if (old('ot_start_time_hour'))
                                                        @php
                                                            $ot_start_time_hour = old('ot_start_time_hour');
                                                        @endphp

                                                    @else
                                                        @php
                                                            $ot_start_time_hour = \Carbon\Carbon::now()->translatedFormat('H');
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
                                                <select class="form-control form-control-sm select2"
                                                        name="ot_start_time_minute" style="width: 100%">
                                                    @if (old('ot_start_time_minute'))
                                                        @php
                                                            $ot_start_time_minute = old('ot_start_time_minute');
                                                        @endphp
                                                    @else
                                                        @php
                                                            $ot_start_time_minute = \Carbon\Carbon::now()->translatedFormat('i');;
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
                                {{--                                    ถึงเวลา--}}
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="row ">
                                            <div class="col-4 align-self-center text-center">
                                                <label for="normal_end_time ">ถึง :</label>
                                            </div>
                                            <div class="col-4">
                                                <label for="start_hour">เวลา</label><br>
                                                <select class="form-control form-control-sm select2"
                                                        name="ot_end_time_hour" style="width: 100%">
                                                    @if (old('ot_end_time_hour'))
                                                        @php
                                                            $ot_end_time_hour = old('normal_end_time_hour');
                                                        @endphp

                                                    @else
                                                        @php
                                                            $ot_end_time_hour = \Carbon\Carbon::now()->translatedFormat('H');
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
                                                <select class="form-control form-control-sm select2"
                                                        name="ot_end_time_minute" style="width: 100%">
                                                    @if (old('ot_end_time_minute'))
                                                        @php
                                                            $ot_end_time_minute = old('ot_end_time_minute');
                                                        @endphp
                                                    @else
                                                        @php
                                                            $ot_end_time_minute = \Carbon\Carbon::now()->translatedFormat('i');;
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
                                {{--                                    รวมชั่วโมง--}}
                                <div class="col-md-4">
                                    <label for="total_ot_work_time">รวมชั่วโมงการทำงานล่วงเวลา</label>
                                    <div class="form-group">
                                        <input autocomplete="nope" type="text"
                                               class="form-control form-control-sm @error('total_ot_work_time') is-invalid @enderror"
                                               id="total_ot_work_time"
                                               name="total_ot_work_time" placeholder=""
                                               value="{{old('total_ot_work_time')}}">
                                        @error('total_ot_work_time')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                {{--                                    เวลาเดินทางไป--}}
                                <div class="col-md-4">
                                    <label for="travel_time">จำนวนชั่วโมงเดินทางไป (ชั่วโมง)<span
                                            class="text-danger"> *</span>
                                    </label>
                                    <div class="form-group">
                                        <input autocomplete="nope" type="text"
                                               class="form-control form-control-sm @error('travel_time') is-invalid @enderror"
                                               id="travel_time"
                                               name="travel_time" placeholder="" value="{{old('travel_time')}}">
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
                                               class="form-control form-control-sm @error('return_time') is-invalid @enderror"
                                               id="return_time"
                                               name="return_time" placeholder="" value="{{old('return_time')}}">
                                        @error('return_time')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label>สถานะการทำงาน : </label>
                                    <div class="form-group ">
                                        <label>
                                            <input type="radio" name="status" checked
                                                   value="{{\App\Models\TechnicianReport::STATUS_FINISHED}}">
                                            งานเรียบร้อย
                                        </label>
                                        &emsp;
                                        <label>
                                            <input type="radio" name="status"
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


