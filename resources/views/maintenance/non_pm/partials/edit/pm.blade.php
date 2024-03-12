<style>
    .table.text-center, .table.text-center td, .table.text-center th {
        vertical-align: middle !important;
    }
</style>
<h2 class="text-center">PREVENTIVE MAINTENANCE GA COMPRESSOR</h2>
<div class="card ">
    <div class="card-body">
        <div class="row">
            <div class="col-md-3">
                <label for="name">Report No : </label>
                <div class="form-group">
                    <input autocomplete="nope" type="text"
                           class="form-control form-control-sm text-center @error('report_no') is-invalid @enderror"
                           id="report_no" readonly
                           name="report_no" placeholder=""
                           value="{{$preventive->report_no}}">
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
                               class="form-control form-control-sm text-center @error('date') is-invalid @enderror"
                               id="date" readonly
                               name="date" placeholder="" value="{{$date}}">
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
                           class="form-control form-control-sm text-center @error('title') is-invalid @enderror"
                           id="title" readonly
                           name="title" placeholder=""
                           value="{{$maintenance_report->customer->organization_name}}">
                    @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-3">
                <label for="name">Agreement No. : </label>
                <div class="form-group">
                    <input autocomplete="nope" type="text"
                           class="form-control form-control-sm text-center @error('title') is-invalid @enderror"
                           id="title" readonly
                           name="title" placeholder=""
                           value="{{$preventive->report_no}}">
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
                           class="form-control form-control-sm text-center @error('compressor_type') is-invalid @enderror"
                           id="compressor_type" readonly
                           name="compressor_type" placeholder=""
                           value="{{$preventive->compressor_type}}">
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
                           class="form-control form-control-sm text-center @error('contract_person') is-invalid @enderror"
                           id="contract_person" name="contract_person" placeholder="" readonly
                           value="{{$preventive->contract_person}}">
                    @error('contract_person')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-sm-3">
                <label for="name">รุ่น <span class="text-danger">* </span></label>
                <div class="form-group text-center">
                    @if($maintenance_report->product_id == null)
                        @php
                            $product = old('product_id');
                        @endphp
                    @else
                        @php
                            $product = $maintenance_report->product->title;
                        @endphp
                    @endif
                    <input autocomplete="nope" type="text"
                           class="form-control form-control-sm text-center @error('title') is-invalid @enderror"
                           id="title" readonly
                           name="title" placeholder=""
                           value="{{$product}}">
                    @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-sm-3">
                <label for="name">หมายเลขเครื่อง <span
                        class="text-danger">*</span></label>
                <div class="form-group text-center">
                    @if($maintenance_report->product_serial_id == null)
                        @php
                            $product_serial = old('product_id');
                        @endphp
                    @else
                        @php
                            $product_serial = $maintenance_report->productSerial->serial_name;
                        @endphp
                    @endif
                    <input autocomplete="nope" type="text"
                           class="form-control form-control-sm text-center @error('serial_name') is-invalid @enderror"
                           id="serial_name" readonly
                           name="serial_name" placeholder=""
                           value="{{$product_serial}}">
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
        {{--            ข้อมูลทั่วไป--}}
        {{--        <div class="step" data-target="#test-nlf-1">--}}
        {{--            <button type="button" class="step-trigger" role="tab" id="stepper3trigger1" aria-controls="test-nlf-1">--}}
        {{--                <span class="bs-stepper-circle">1</span>--}}
        {{--                <span class="bs-stepper-label">ข้อมูลทั่วไป</span>--}}
        {{--            </button>--}}
        {{--        </div>--}}
        {{--        <div class="bs-stepper-line"></div>--}}
        {{--            Product Model--}}
        <div class="step" data-target="#test-nlf-2">
            <button type="button" class="step-trigger" role="tab" id="stepper3trigger2" aria-controls="test-nlf-2">
                <span class="bs-stepper-circle">1</span>
                <span class="bs-stepper-label">Product Model</span>
            </button>
        </div>
        <div class="bs-stepper-line"></div>
        {{--            Inspection--}}
        <div class="step" data-target="#test-nlf-3">
            <button type="button" class="step-trigger" role="tab" id="stepper3trigger3" aria-controls="test-nlf-3">
                <span class="bs-stepper-circle">2</span>
                <span class="bs-stepper-label">Inspection</span>
            </button>
        </div>
        <div class="bs-stepper-line"></div>
        {{--            Result--}}
        <div class="step" data-target="#test-nlf-4">
            <button type="button" class="step-trigger" role="tab" id="stepper3trigger4" aria-controls="test-nlf-4">
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
                        @endphp
                        @foreach($model_items as $models)
                            <tr>
                                @if($type_model != $models->productModel->type)
                                    @php
                                        $type_model = $models->productModel->type;
                                    @endphp
                                    <td width="5%" style="transform-origin:50% 50%;transform: rotate(270deg);"
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
                                    <input autocomplete="nope" type="text"
                                           class="form-control form-control-sm text-center @error('last_record') is-invalid @enderror"
                                           id="last_record" readonly
                                           name="last_record[]" placeholder="" value="{{$models->last_record}}">
                                </td>
                                <td>
                                    <input autocomplete="nope" type="text"
                                           class="form-control form-control-sm text-center @error('present_record') is-invalid @enderror"
                                           id="present_record" readonly
                                           name="present_record[]" placeholder=""
                                           value="{{$models->present_record}}">
                                </td>
                                <td>
                                    <input autocomplete="nope" type="text"
                                           class="form-control form-control-sm text-center @error('result') is-invalid @enderror"
                                           id="result" readonly
                                           name="result[]" placeholder="" value="{{$models->result}}">
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
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

                        @foreach($preventive_items as $preventive_item)
                            <tr>
                                <td>
                                    {{$preventive_item->point}}
                                </td>
                                <td>
                                    <input autocomplete="nope" type="text"
                                           class="form-control form-control-sm" readonly
                                           id="dbi" name="dbi[]" placeholder="" value="{{$preventive_item->dbi}}">
                                </td>
                                <td>
                                    <input autocomplete="nope" type="text"
                                           class="form-control form-control-sm" id="dbm1" readonly
                                           name="dbm1[]" placeholder="" value="{{$preventive_item->dbm1}}">
                                </td>
                                <td>
                                    <input autocomplete="nope" type="text"
                                           class="form-control form-control-sm @error('dbc1') is-invalid @enderror"
                                           id="dbc1" readonly
                                           name="dbc1[]" placeholder="" value="{{$preventive_item->dbc1}}">
                                </td>
                                <td>
                                    <input autocomplete="nope" type="text"
                                           class="form-control form-control-sm @error('dbm2') is-invalid @enderror"
                                           id="dbm2" readonly
                                           name="dbm2[]" placeholder="" value="{{$preventive_item->dbm2}}">
                                </td>
                                <td>
                                    <input autocomplete="nope" type="text"
                                           class="form-control form-control-sm @error('dbc2') is-invalid @enderror"
                                           id="dbc2" readonly
                                           name="dbc2[]" placeholder="" value="{{$preventive_item->dbc2}}">
                                </td>
                                <td>
                                    <input autocomplete="nope" type="text"
                                           class="form-control form-control-sm @error('pm_other') is-invalid @enderror"
                                           id="pm_other" readonly
                                           name="pm_other[]" placeholder="" value="{{$preventive_item->pm_other}}">
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="text-right">
                <button class="btn btn-outline-secondary" type="button" onclick="stepper2.next()">ถัดไป</button>
            </div>
        </div>
        <div id="test-nlf-3" class="content" style="padding: 0">
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
                             $x = 0;
                        @endphp
                        @foreach($inspection_items as $inspection)
                            <tr>
                                @if($type_inspection != $inspection->inspection->type)
                                    @php
                                        $type_inspection = $inspection->inspection->type;
                                    @endphp
                                    <td width="5%" style="transform-origin:50% 50%;transform: rotate(270deg);"
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
                                    <input autocomplete="nope" type="text"
                                           class="form-control form-control-sm text-center @error('last_record_inspection') is-invalid @enderror"
                                           id="last_record_inspection" readonly
                                           name="last_record_inspection[]" placeholder=""
                                           value="{{number_format($inspection->last_record_inspection)}}">
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
                                       class="form-control form-control-sm text-center @error('running') is-invalid @enderror"
                                       id="running" readonly
                                       name="running" placeholder="" value="{{$preventive->running}}">
                            </td>
                            <td rowspan="2">
                                Cycle
                            </td>
                            <td>
                                Load (sec.)
                            </td>
                            <td>
                                <input autocomplete="nope" type="text"
                                       class="form-control form-control-sm text-center @error('load1') is-invalid @enderror"
                                       id="load1" readonly
                                       name="load1" placeholder="" value="{{$preventive->load1}}">
                            </td>
                            <td>
                                <input autocomplete="nope" type="text"
                                       class="form-control form-control-sm text-center @error('load2') is-invalid @enderror"
                                       id="load2" readonly
                                       name="load2" placeholder="" value="{{$preventive->load2}}">
                            </td>
                            <td>
                                <input autocomplete="nope" type="text"
                                       class="form-control form-control-sm text-center @error('load3') is-invalid @enderror"
                                       id="load3" readonly
                                       name="load3" placeholder="" value="{{$preventive->load3}}">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Loading
                            </td>
                            <td>
                                <input autocomplete="nope" type="text"
                                       class="form-control form-control-sm text-center @error('loading') is-invalid @enderror"
                                       id="loading" readonly
                                       name="loading" placeholder="" value="{{$preventive->loading}}">
                            </td>
                            <td>
                                UnLoad (sec.)
                            </td>
                            <td>
                                <input autocomplete="nope" type="text"
                                       class="form-control form-control-sm text-center @error('unload1') is-invalid @enderror"
                                       id="unload1" readonly
                                       name="unload1" placeholder="" value="{{$preventive->unload1}}">
                            </td>
                            <td>
                                <input autocomplete="nope" type="text"
                                       class="form-control form-control-sm text-center @error('unload2') is-invalid @enderror"
                                       id="unload2" readonly
                                       name="unload2" placeholder="" value="{{$preventive->unload2}}">
                            </td>
                            <td>
                                <input autocomplete="nope" type="text"
                                       class="form-control form-control-sm text-center @error('unload3') is-invalid @enderror"
                                       id="unload3" readonly
                                       name="unload3" placeholder="" value="{{$preventive->unload3}}">
                            </td>
                        </tr>
                        </tbody>
                    </table>

                </div>
            </div>
            <div class="text-right">
                <button class="btn btn-outline-secondary" type="button" onclick="stepper2.previous()">ย้อนกลับ
                </button>
                <button class="btn btn-outline-secondary" type="button" onclick="stepper2.next()">ถัดไป</button>
            </div>
        </div>
        <div id="test-nlf-4" role="tabpanel" class="bs-stepper-pane" aria-labelledby="stepper3trigger4">
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
                                            <textarea class="form-control" name="filter_type"
                                                      value="{{$preventive_replacement->filter_type}}"
                                                      placeholder="" readonly
                                                      rows="5">{{$preventive_replacement->filter_type}}</textarea>
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
                                            <textarea class="form-control" name="last_replacement"
                                                      value="{{$preventive_replacement->last_replacement}}"
                                                      placeholder="" readonly
                                                      rows="5">{{$preventive_replacement->last_replacement}}</textarea>
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
                                            <textarea class="form-control" name="next_replacement"
                                                      value="{{$preventive_replacement->next_replacement}}" readonly
                                                      placeholder=""
                                                      rows="5">{{$preventive_replacement->next_replacement}}</textarea>
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
                                            <textarea class="form-control" name="result_pm"
                                                      value="{{$preventive->result_pm}}" readonly
                                                      placeholder="" rows="3">{{$preventive->result_pm}}</textarea>
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

<div class="row">
    <div class="col-md-6">
        <div class="card card-warning card-outline">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fa-solid fa-signature"></i>
                    ลงชื่อลูกค้า
                </h3>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <div class="col-md-12">
                        <img
                            src="@if(!empty($preventive->getFirstMediaUrl('signed'))){{ $preventive->getFirstMediaUrl('signed') }}@else {{ asset('/images/no-image.jpeg') }} @endif"
                            style="width: 100%;  border: 1px solid #e5e5e5;}" alt="User Image">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card card-warning card-outline">
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
                            <div class="form-group">
                                <div class="preview">
                                    <img
                                        src="@if(!empty($preventive->getFirstMediaUrl('image'))){{ $preventive->getFirstMediaUrl('image') }}@else {{ asset('/images/no-image.jpeg') }} @endif"
                                        style="width: 100%" alt="User Image">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
