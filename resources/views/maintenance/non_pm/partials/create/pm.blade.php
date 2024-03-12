<style>
    .table.text-center,
    .table.text-center td,
    .table.text-center th {
        vertical-align: middle !important;
    }
</style>
<h2 class="text-center">PREVENTIVE MAINTENANCE GA COMPRESSOR</h2>
<div class="card m-4">
    <div class="card-body">
        <div class="row">
            <div class="col-md-3">
                <label for="name">Report No : </label>
                <div class="form-group">
                    <input autocomplete="nope" type="text"
                        class="form-control form-control-sm @error('report_no') is-invalid @enderror" id="report_no"
                        name="report_no" placeholder="" value="{{ old('report_no') }}">
                    @error('report_no')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="date">วันที่<span class="text-danger"> *</span> </label>
                    <div class="form-group">
                        @php
                            $date = \Carbon\Carbon::now()->translatedFormat('d F Y');
                        @endphp
                        <input autocomplete="nope" type="text"
                            class="form-control form-control-sm @error('date') is-invalid @enderror" id="date"
                            readonly name="date" placeholder="" value="{{ $date }}">
                        @error('date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <label for="name">หน่วยงาน </label>
                <div class="form-group">
                    <input autocomplete="nope" type="text"
                        class="form-control form-control-sm @error('title') is-invalid @enderror" id="title"
                        readonly name="title" placeholder="" value="{{ $schedule->customer->organization_name }}">
                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-3">
                <label for="name">Agreement No. : </label>
                <div class="form-group">
                    <input autocomplete="nope" type="text"
                        class="form-control form-control-sm @error('title') is-invalid @enderror" id="agreement_no"
                        name="agreement_no" placeholder="" value="{{ old('agreement_no') }}">
                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <label for="compressor_type">Compressor Type : </label>
                <div class="form-group">
                    <input autocomplete="nope" type="text"
                        class="form-control form-control-sm @error('compressor_type') is-invalid @enderror"
                        id="compressor_type" name="compressor_type" placeholder="" value="{{ old('compressor_type') }}">
                    @error('compressor_type')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-3">
                <label for="name">Contract Person<span class="text-danger"> *</span>
                </label>
                <div class="form-group">
                    <input autocomplete="nope" type="text"
                        class="form-control form-control-sm @error('contract_person') is-invalid @enderror"
                        id="contract_person" name="contract_person" placeholder=""
                        value="{{ old('contract_person') }}">
                    @error('contract_person')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-sm-3">
                <label for="name">รุ่น <span class="text-danger">* </span></label>
                <div class="form-group text-center">
                    <input autocomplete="nope" type="text"
                        class="form-control form-control-sm text-center product_id_pm @error('title') is-invalid @enderror"
                        id="product_id_pm" name="product_id_pm" placeholder="" value="{{ old('product_id_pm') }}">
                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-sm-3">
                <label for="name">หมายเลขเครื่อง <span class="text-danger">*</span></label>
                <div class="form-group text-center">
                    <input autocomplete="nope" type="text"
                        class="form-control form-control-sm text-center @error('serial_name') is-invalid @enderror"
                        id="serial_name" name="serial_name" placeholder="" value="{{ old('serial_id') }}">
                    @error('serial_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror

                </div>
            </div>
        </div>
    </div>
</div>
<div id="stepper2" class="bs-stepper">
    <div class="bs-stepper-header" role="tablist">
        <div class="step" data-target="#test-nlf-2">
            <button type="button" class="step-trigger" role="tab" id="stepper3trigger2"
                aria-controls="test-nlf-2">
                <span class="bs-stepper-circle">1</span>
                <span class="bs-stepper-label">Product Model</span>
            </button>
        </div>
        <div class="bs-stepper-line"></div>
        {{--            Inspection --}}
        <div class="step" data-target="#test-nlf-3">
            <button type="button" class="step-trigger" role="tab" id="stepper3trigger3"
                aria-controls="test-nlf-3">
                <span class="bs-stepper-circle">2</span>
                <span class="bs-stepper-label">Inspection</span>
            </button>
        </div>
        <div class="bs-stepper-line"></div>
        {{--            Result --}}
        <div class="step" data-target="#test-nlf-4">
            <button type="button" class="step-trigger" role="tab" id="stepper3trigger4"
                aria-controls="test-nlf-4">
                <span class="bs-stepper-circle">3</span>
                <span class="bs-stepper-label">Result</span>
            </button>
        </div>
    </div>
    <div class="bs-stepper-content">
        <div id="test-nlf-2" class="content">
            <div class="card">
                <div class="card-body" style="padding: 0">
                    <table class="table table-striped table-bordered table-sm text-center table-responsive-sm"
                        id="model">
                        <thead>
                            <tr>
                                <th rowspan="2" colspan="2">
                                    Reading/Measuring
                                </th>
                                <th colspan="3">
                                    Record
                                </th>
                                <th width="30%" rowspan="2">
                                    Result
                                </th>
                            </tr>
                            <tr>
                                <th width="15%">
                                    ค่าสูงสุด
                                </th>
                                <th width="15%">
                                    Last
                                </th>
                                <th width="15%">
                                    Present
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $type_model = '';
                                $i = 0;
                                $j = 0;
                                $x = 0;
                            @endphp
                            @foreach ($product_models as $models)
                                <tr>
                                    @if ($type_model != $models->type)
                                        @php
                                            $type_model = $models->type;
                                        @endphp
                                        <td width="5%" style="transform-origin:50% 50%;transform: rotate(270deg);"
                                            rowspan="{{ $count_model[$i] }}">
                                            @foreach (\App\Models\ProductModel::getTypeArray() as $key => $value)
                                                @if ($models->type == $key)
                                                    {{ $value }}
                                                @endif
                                            @endforeach
                                        </td>
                                        @php
                                            $i++;
                                        @endphp
                                    @endif
                                    <td id="">
                                        {{ $models->title }}
                                    </td>
                                    <td id="{{ 'limit' . $x }}">
                                        {{-- {{ number_format($models->limit_value) }} --}}
                                        {{ $models->limit_value }}

                                        <input name="limit_value" type="hidden" value="{{ $models->limit_value }}">
                                    </td>
                                    <td>
                                        <input autocomplete="nope" type="number"
                                            class="form-control form-control-sm text-center @error('last_record') is-invalid @enderror"
                                            id="last_record" name="last_record[]" placeholder=""
                                            value="{{ old('last_record') }}">
                                    </td>
                                    <td>
                                        <input autocomplete="nope" type="number"
                                            class="form-control form-control-sm text-center present @error('present_record') is-invalid @enderror"
                                            id="present_record" name="present_record[]" placeholder=""
                                            value="{{ old('present_record') }}">
                                    </td>
                                    @php
                                        $x++;
                                    @endphp
                                    <td>
                                        <input autocomplete="nope" type="text"
                                            class="form-control form-control-sm text-center @error('result') is-invalid @enderror"
                                            id="result" name="result[]" placeholder=""
                                            value="{{ old('result') }}">
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        @push('js')
                            <script>
                                $('.present').keyup(function() {
                                    var obj = $(this);
                                    var value = parseInt($(this).val());
                                    var limit = parseInt($(this).parents().find('input[name="limit_value"]').val());
                                    if (value > limit) {
                                        obj.css({
                                            "border": "red solid 1.5px"
                                        });
                                    } else {
                                        obj.css("border-color", "#ced4da");
                                    }
                                })
                            </script>
                        @endpush
                    </table>
                </div>
            </div>
            <div class="card">
                <div class="card-body" style="padding: 0">
                    <table class="table table-striped table-bordered text-center table-sm table-responsive-sm ">
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

                            </td>
                        </tr>
                        </thead>
                        <tbody>
                        @for($i=1; $i<8; $i++)
                            <tr>
                                <td>
                                    {{$i}}
                                    <input type="hidden" name="point[]" value="{{$i}}">
                                </td>
                                <td>
                                    <input autocomplete="nope" type="text"
                                           class="form-control form-control-sm"
                                           id="dbi" name="dbi[]" placeholder="" value="{{old('dbi')}}">
                                </td>
                                <td>
                                    <input autocomplete="nope" type="text"
                                           class="form-control form-control-sm" id="dbm1"
                                           name="dbm1[]" placeholder="" value="{{old('dbm1')}}">
                                </td>
                                <td>
                                    <input autocomplete="nope" type="text"
                                           class="form-control form-control-sm @error('dbc1') is-invalid @enderror"
                                           id="dbc1"
                                           name="dbc1[]" placeholder="" value="{{old('dbc1')}}">
                                </td>
                                <td>
                                    <input autocomplete="nope" type="text"
                                           class="form-control form-control-sm @error('dbm2') is-invalid @enderror"
                                           id="dbm2"
                                           name="dbm2[]" placeholder="" value="{{old('dbm2')}}">
                                </td>
                                <td>
                                    <input autocomplete="nope" type="text"
                                           class="form-control form-control-sm @error('dbc2') is-invalid @enderror"
                                           id="dbc2"
                                           name="dbc2[]" placeholder="" value="{{old('dbc2')}}">
                                </td>
                                <td>
                                    <input autocomplete="nope" type="text"
                                           class="form-control form-control-sm @error('pm_other') is-invalid @enderror"
                                           id="pm_other"
                                           name="pm_other[]" placeholder="" value="{{old('pm_other')}}">
                                </td>
                            </tr>
                        @endfor
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card">
                <div class="card-body" style="padding: 0">
                    <table class="table table-striped table-bordered text-center table-sm table-responsive-sm ">
                        <thead>
                        <tr>
                            <th>

                            </th>
                            <th>
                                L1
                            </th>
                            <th>
                                L2
                            </th>
                            <th>
                                L3
                            </th>
                            <th style="display:none;"></th>
                            <th style="display:none;"></th>
                            <th>

                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>
                                Mot1
                                <input type="hidden" name="point[]" value="mot1">
                            </td>
                            <td>
                                <input autocomplete="nope" type="text"
                                       class="form-control form-control-sm @error('dbi') is-invalid @enderror"
                                       name="dbi[]" placeholder="" value="{{old('dbi')}}">
                            </td>
                            <td>
                                <input autocomplete="nope" type="text"
                                       class="form-control form-control-sm @error('dbm1') is-invalid @enderror"
                                       name="dbm1[]" placeholder="" value="{{old('dbm1')}}">
                            </td>
                            <td>
                                <input autocomplete="nope" type="text"
                                       class="form-control form-control-sm @error('dbc1') is-invalid @enderror"
                                       name="dbc1[]" placeholder="" value="{{old('dbc1')}}">
                            </td>
                            <td style="display:none;">
                                <input autocomplete="nope" type="text"
                                       class="form-control form-control-sm @error('dbm2') is-invalid @enderror"
                                       id="dbm2"
                                       name="dbm2[]" placeholder="" value="{{old('dbm2')}}">
                            </td>
                            <td style="display:none;">
                                <input autocomplete="nope" type="text"
                                       class="form-control form-control-sm @error('dbc2') is-invalid @enderror"
                                       id="dbc2"
                                       name="dbc2[]" placeholder="" value="{{old('dbc2')}}">
                            </td>
                            <td>
                                <input autocomplete="nope" type="text"
                                       class="form-control form-control-sm @error('pm_other') is-invalid @enderror"
                                       name="pm_other[]" placeholder="" value="{{old('pm_other')}}">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Mot2
                                <input type="hidden" name="point[]" value="mot2">
                            </td>
                            <td>
                                <input autocomplete="nope" type="text"
                                       class="form-control form-control-sm @error('dbi') is-invalid @enderror"
                                       name="dbi[]" placeholder="" value="{{old('dbi')}}">
                            </td>
                            <td>
                                <input autocomplete="nope" type="text"
                                       class="form-control form-control-sm @error('dbm1') is-invalid @enderror"
                                       name="dbm1[]" placeholder="" value="{{old('dbm1')}}">
                            </td>
                            <td>
                                <input autocomplete="nope" type="text"
                                       class="form-control form-control-sm @error('dbc1') is-invalid @enderror"
                                       name="dbc1[]" placeholder="" value="{{old('dbc1')}}">
                            </td>
                            <td style="display:none;">
                                <input autocomplete="nope" type="text"
                                       class="form-control form-control-sm @error('dbm2') is-invalid @enderror"
                                       id="dbm2"
                                       name="dbm2[]" placeholder="" value="{{old('dbm2')}}">
                            </td>
                            <td style="display:none;">
                                <input autocomplete="nope" type="text"
                                       class="form-control form-control-sm @error('dbc2') is-invalid @enderror"
                                       id="dbc2"
                                       name="dbc2[]" placeholder="" value="{{old('dbc2')}}">
                            </td>
                            <td>
                                <input autocomplete="nope" type="text"
                                       class="form-control form-control-sm @error('pm_other') is-invalid @enderror"
                                       name="pm_other[]" placeholder="" value="{{old('pm_other')}}">
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="text-right">
                <button class="btn btn-outline-secondary" type="button" onclick="stepper2.next()">ถัดไป</button>
            </div>
        </div>
        <div id="test-nlf-3" class="content">
            <div class="card">
                <div class="card-body" style="padding: 0">
                    <table class="table table-striped table-bordered text-center table-sm table-responsive-sm ">
                        <thead>
                            <tr>
                                <th colspan="2">
                                    Inspection
                                </th>
                                <th>
                                    รอบการใช้งาน
                                </th>
                                <th>
                                    Last
                                </th>
                                <th>
                                    Checked
                                </th>
                                <th>
                                    Cleaned
                                </th>
                                <th>
                                    Adjust
                                </th>
                                <th>
                                    Repair
                                </th>
                                <th>
                                    Replace
                                </th>
                                <th>
                                    Remarks
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $type_inspection = '';
                                $j = 0;
                                $k = 0;
                            @endphp
                            @foreach ($inspections as $inspection)
                                <tr>
                                    @if ($type_inspection != $inspection->type)
                                        @php
                                            $type_inspection = $inspection->type;
                                        @endphp
                                        <td width="5%" style="transform-origin:50% 50%;transform: rotate(270deg);"
                                            rowspan="{{ $count_inspection[$j] }}">
                                            @foreach (\App\Models\Inspection::getTypeArray() as $key => $value)
                                                @if ($inspection->type == $key)
                                                    {{ $value }}
                                                @endif
                                            @endforeach
                                        </td>
                                        @php
                                            $j++;
                                        @endphp
                                    @endif
                                    <td>
                                        {{ $inspection->title }}
                                    </td>
                                    <td id="{{ 'limit_inspection' . $x }}">
                                        {{-- {{ number_format($inspection->limit_value) }} --}}
                                        {{ $inspection->limit_value }}
                                        <input name="limit_inspection" type="hidden"
                                            value="{{ $inspection->limit_value }}">
                                    </td>
                                    <td>
                                        <input autocomplete="nope" type="text"
                                            class="form-control form-control-sm text-center last_inspection @error('last_record_inspection') is-invalid @enderror"
                                            id="last_record_inspection" name="last_record_inspection[]"
                                            placeholder="" value="{{ old('last_record_inspection') }}">
                                    </td>
                                    <td>
                                        <div class="clearfix">
                                            <div class="icheck-info d-inline">
                                                <input type="checkbox" class="check_inspection" value="1"
                                                    id="{{ 'checked' . $k }}" />
                                                <input type="hidden" name="checked[]" value="">
                                                <label for="{{ 'checked' . $k }}"></label>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="clearfix">

                                            <div class="icheck-info d-inline">
                                                <input type="checkbox" class="clean_inspection" value="1"
                                                    id="{{ 'cleaned' . $k }}">
                                                <input type="hidden" name="cleaned[]" value="">
                                                <label for="{{ 'cleaned' . $k }}"></label>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="clearfix">

                                            <div class="icheck-info d-inline">
                                                <input type="checkbox" class="adjust_inspection" value="1"
                                                    id="{{ 'adjust' . $k }}">
                                                <input type="hidden" name="adjust[]" value="">
                                                <label for="{{ 'adjust' . $k }}"></label>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="clearfix">

                                            <div class="icheck-info d-inline">
                                                <input type="checkbox" class="repair_inspection" value="1"
                                                    id="{{ 'repair' . $k }}">
                                                <input type="hidden" name="repair[]" value="">
                                                <label for="{{ 'repair' . $k }}"></label>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="clearfix">
                                            <div class="icheck-info d-inline">
                                                <input type="checkbox" class="replace_inspection" value="1"
                                                    id="{{ 'replace' . $k }}">
                                                <input type="hidden" name="replace[]" value="">
                                                <label for="{{ 'replace' . $k }}"></label>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="clearfix">

                                            <div class="icheck-info d-inline">
                                                <input type="checkbox" class="remark_inspection" value="1"
                                                    id="{{ 'remarks' . $k }}">
                                                <input type="hidden" name="remarks[]" value="">
                                                <label for="{{ 'remarks' . $k }}"></label>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @php
                                    $k++;
                                @endphp
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card">
                <div class="card-body" style="padding: 0">
                    <table class="table table-striped table-bordered text-center table-sm table-responsive-sm ">
                        <tbody>
                            <tr>
                                <td>
                                    Running
                                </td>
                                <td>
                                    <input autocomplete="nope" type="text"
                                        class="form-control form-control-sm @error('running') is-invalid @enderror"
                                        id="running" name="running" placeholder="" value="{{ old('running') }}">
                                </td>
                                <td rowspan="2">
                                    Cycle
                                </td>
                                <td>
                                    Load (sec.)
                                </td>
                                <td>
                                    <input autocomplete="nope" type="text"
                                        class="form-control form-control-sm @error('load1') is-invalid @enderror"
                                        id="load1" name="load1" placeholder="" value="{{ old('load1') }}">
                                </td>
                                <td>
                                    <input autocomplete="nope" type="text"
                                        class="form-control form-control-sm @error('load2') is-invalid @enderror"
                                        id="load2" name="load2" placeholder="" value="{{ old('load2') }}">
                                </td>
                                <td>
                                    <input autocomplete="nope" type="text"
                                        class="form-control form-control-sm @error('load3') is-invalid @enderror"
                                        id="load3" name="load3" placeholder="" value="{{ old('load3') }}">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Loading
                                </td>
                                <td>
                                    <input autocomplete="nope" type="text"
                                        class="form-control form-control-sm @error('loading') is-invalid @enderror"
                                        id="loading" name="loading" placeholder="" value="{{ old('loading') }}">
                                </td>
                                <td>
                                    UnLoad (sec.)
                                </td>
                                <td>
                                    <input autocomplete="nope" type="text"
                                        class="form-control form-control-sm @error('unload1') is-invalid @enderror"
                                        id="unload1" name="unload1" placeholder="" value="{{ old('unload1') }}">
                                </td>
                                <td>
                                    <input autocomplete="nope" type="text"
                                        class="form-control form-control-sm @error('unload2') is-invalid @enderror"
                                        id="unload2" name="unload2" placeholder="" value="{{ old('unload2') }}">
                                </td>
                                <td>
                                    <input autocomplete="nope" type="text"
                                        class="form-control form-control-sm @error('unload3') is-invalid @enderror"
                                        id="unload3" name="unload3" placeholder="" value="{{ old('unload3') }}">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            @push('js')
                <script>
                    $('.last_inspection').keyup(function() {
                        var obj = $(this);
                        var value = parseInt($(this).val());
                        var limit = parseInt($(this).parents().find('input[name="limit_inspection"]').val());
                        if (value > limit) {
                            obj.css({
                                "border": "red solid 1.5px"
                            });
                        } else {
                            obj.css("border-color", "#ced4da");
                        }
                    })

                    $('.check_inspection').click(function() {
                        if ($(this).prop("checked") === true) {
                            console.log("Checkbox is checked.");
                            $(this).parent().find('input[type=hidden]').val(1)
                        } else if ($(this).prop("checked") === false) {
                            console.log("Checkbox is unchecked.");
                            $(this).parent().find('input[type=hidden]').val('')
                        }
                    })

                    $('.clean_inspection').click(function() {
                        if ($(this).prop("checked") === true) {
                            console.log("Checkbox is checked.");
                            $(this).parent().find('input[type=hidden]').val(1)
                        } else if ($(this).prop("checked") === false) {
                            console.log("Checkbox is unchecked.");
                            $(this).parent().find('input[type=hidden]').val('')
                        }
                    })

                    $('.adjust_inspection').click(function() {
                        if ($(this).prop("checked") === true) {
                            console.log("Checkbox is checked.");
                            $(this).parent().find('input[type=hidden]').val(1)
                        } else if ($(this).prop("checked") === false) {
                            console.log("Checkbox is unchecked.");
                            $(this).parent().find('input[type=hidden]').val('')
                        }
                    })

                    $('.repair_inspection').click(function() {
                        if ($(this).prop("checked") === true) {
                            console.log("Checkbox is checked.");
                            $(this).parent().find('input[type=hidden]').val(1)
                        } else if ($(this).prop("checked") === false) {
                            console.log("Checkbox is unchecked.");
                            $(this).parent().find('input[type=hidden]').val('')
                        }
                    })

                    $('.replace_inspection').click(function() {
                        if ($(this).prop("checked") === true) {
                            console.log("Checkbox is checked.");
                            $(this).parent().find('input[type=hidden]').val(1)
                        } else if ($(this).prop("checked") === false) {
                            console.log("Checkbox is unchecked.");
                            $(this).parent().find('input[type=hidden]').val('')
                        }
                    })

                    $('.remark_inspection').click(function() {
                        if ($(this).prop("checked") === true) {
                            console.log("Checkbox is checked.");
                            $(this).parent().find('input[type=hidden]').val(1)
                        } else if ($(this).prop("checked") === false) {
                            console.log("Checkbox is unchecked.");
                            $(this).parent().find('input[type=hidden]').val('')
                        }
                    })
                </script>
            @endpush
            <div class="text-right">
                <button class="btn btn-outline-secondary" type="button" onclick="stepper2.previous()">ย้อนกลับ
                </button>
                <button class="btn btn-outline-secondary" type="button" onclick="stepper2.next()">ถัดไป</button>
            </div>
        </div>
        <div id="test-nlf-4" class="content">
            <div class="row">
                <div class="col-md-4">
                    <div class="card card-outline-primary">
                        <div class="card-header">
                            <h4 class="card-title w-100">
                                <a class="d-block w-100" data-toggle="collapse" href="#collapseThree">
                                    Filter Type
                                </a>
                            </h4>
                        </div>
                        <div id="collapseThree" class="collapse show" data-parent="#accordion">
                            <div class="card-body">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <textarea class="form-control" name="filter_type" value="{{ old('filter_type') }}" placeholder="" rows="5"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-outline-primary">
                        <div class="card-header">
                            <h4 class="card-title w-100">
                                <a class="d-block w-100" data-toggle="collapse" href="#collapseThree">
                                    Last Replacement
                                </a>
                            </h4>
                        </div>
                        <div id="collapseThree" class="collapse show" data-parent="#accordion">
                            <div class="card-body">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <textarea class="form-control" name="last_replacement" value="{{ old('last_replacement') }}" placeholder=""
                                                    rows="5"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-outline-primary">
                        <div class="card-header">
                            <h4 class="card-title w-100">
                                <a class="d-block w-100" data-toggle="collapse" href="#collapseThree">
                                    Parts replacement for the next times
                                </a>
                            </h4>
                        </div>
                        <div id="collapseThree" class="collapse show" data-parent="#accordion">
                            <div class="card-body">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <textarea class="form-control" name="next_replacement" value="{{ old('next_replacement') }}" placeholder=""
                                                    rows="5"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card card-outline-primary">
                <div class="card-header">
                    <h4 class="card-title w-100">
                        <a class="d-block w-100" data-toggle="collapse" href="#collapseThree">
                            Result
                        </a>
                    </h4>
                </div>
                <div id="collapseThree" class="collapse show" data-parent="#accordion">
                    <div class="card-body">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <textarea class="form-control" name="result_pm" value="{{ old('result_pm') }}" placeholder="" rows="3"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-right">
                <button class="btn btn-outline-secondary" type="button" onclick="stepper2.previous()">ย้อนกลับ
                </button>
            </div>
        </div>
    </div>
</div>
