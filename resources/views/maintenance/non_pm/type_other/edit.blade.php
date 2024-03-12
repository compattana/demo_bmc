@extends('adminlte::page')

@section('title', 'ลงเวลา : งานอื่นๆ - เพิ่มข้อมูล')

@section('content_header')
    <div class="row">
        <div class="col-md-6">
            <h1 class="m-0 text-dark">
                <i class="fad fa-fw fa-calendar-plus"></i> ลงเวลา : งานอื่นๆ
            </h1>
        </div>
        <div class="col-md-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">หน้าแรก</a></li>
                <li class="breadcrumb-item">
                    <a href="{{ route('maintenance_reports.index', ['type' => 'other']) }}">
                        ตารางการเข้าซ่อม : งานอื่นๆ
                    </a>
                </li>
                <li class="breadcrumb-item active">เพิ่มข้อมูล</li>
            </ol>
        </div>
    </div>
@stop

@section('content')

    <form action="{{ route('schedule_others.update', ['schedule_other' => $schedule->id]) }}" method="post" id="formUpdate"
        enctype="multipart/form-data">
        @csrf
        @method('patch')
        <div class="row">
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">

                            <div class="card-header">
                                <h3 class="card-title">รายละเอียด</h3>
                            </div>
                            <div class="card-body">
                                <label for="appointment_date">วันที่ต้องการเข้าซ่อมบำรุง <span class="text-danger">*</span>
                                </label>
                                <div class="form-group">
                                    @if ($schedule->appointment_date == null)
                                        @php
                                            $appointment_date = \Carbon\Carbon::now()->translatedFormat('d F Y');
                                        @endphp
                                    @else
                                        @php
                                            $appointment_date = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $schedule->appointment_date)->translatedFormat('d F Y');
                                        @endphp
                                    @endif
                                    <input type="text"
                                        class="form-control form-control-sm datepicker appointment_date  @error('appointment_date') is-invalid @enderror"
                                        name="appointment_date" value="{{ $appointment_date }}">
                                    @error('appointment_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <label for="technician_id">พนักงานฝ่ายซ่อมบำรุง <span class="text-danger">*</span></label>
                                <div class="form-group text-center">
                                    <select class="form-control select2" multiple="multiple" name="technician_id[]"
                                        id="technician_id" style="width: 100%">
                                        @foreach ($technicians as $technician)
                                            <option
                                                @foreach ($schedule->technicianPm as $pm)@if ($pm->technician_id == $technician->id) selected
                                                @endif @endforeach
                                                value="{{ $technician->id }}">{{ $technician->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('technician_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <label for="name">ชื่อลูกค้า <span class="text-danger">*</span> </label>
                                <div class="form-group text-center">
                                    <input autocomplete="nope" type="text"
                                        class="form-control form-control-sm @error('customer_name') is-invalid @enderror"
                                        id="customer_name" name="customer_name" placeholder=""
                                        value="{{ $schedule_other->customer_name ?? '' }}">
                                </div>

                                <label for="name">ชื่อบริษัท </label>
                                <div class="form-group text-center">
                                    <input autocomplete="nope" type="text"
                                        class="form-control form-control-sm @error('organization_name') is-invalid @enderror"
                                        id="organization_name" name="organization_name" placeholder=""
                                        value="{{ $schedule_other->organization_name ?? '' }}">
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <label for="name">รถบริการ </label>
                                        <div class="form-group text-center">
                                            <input autocomplete="nope" type="text"
                                                class="form-control form-control-sm @error('car_no') is-invalid @enderror"
                                                id="car_no" name="car_no" placeholder=""
                                                value="{{ $schedule_other->car_no ?? '' }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="name">รุ่น </label>
                                        <div class="form-group text-center">
                                            <input autocomplete="nope" type="text"
                                                class="form-control form-control-sm @error('product_model') is-invalid @enderror"
                                                id="product_model" name="product_model" placeholder=""
                                                value="{{ $schedule_other->product_model ?? '' }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="name">หมายเลขเครื่อง </label>
                                        <div class="form-group text-center">
                                            <input autocomplete="nope" type="text"
                                                class="form-control form-control-sm @error('product_number') is-invalid @enderror"
                                                id="product_number" name="product_number" placeholder=""
                                                value="{{ $schedule_other->product_number ?? '' }}">
                                        </div>
                                    </div>
                                </div>


                                <label for="note">รายละเอียด</label><br>
                                <div class="form-group">
                                    <textarea class="form-control" name="description" value="{{ old('description') }}" placeholder="" rows="3">{{ $schedule->note }}</textarea>
                                </div>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">สถานะงาน</h3>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <div class="row mt-2">
                                        <div class="col-md-3">
                                            <div class="form-group clearfix">
                                                <div class="icheck-primary d-inline">
                                                    <input type="radio" id="in_progress" name="status_report"
                                                        value="in_progress"
                                                        @if ($schedule->status == \App\Models\MaintenanceSchedule::STATUS_IN_PROGRESS) checked @endif />
                                                    <label for="in_progress">รอดำเนินการ</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group clearfix">
                                                <div class="icheck-primary d-inline">
                                                    <input type="radio" id="no_approve" name="status_report"
                                                        value="no_approve"
                                                        @if ($schedule->status == \App\Models\MaintenanceSchedule::STATUS_REPORT_NO_APPROVE) checked @endif />
                                                    <label for="no_approve">รอตรวจงาน</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group clearfix">
                                                <div class="icheck-primary d-inline">
                                                    <input type="radio" id="warranty" name="status_report"
                                                        value="warranty"
                                                        @if ($schedule->status == \App\Models\MaintenanceSchedule::STATUS_WARRANTY) checked @endif />
                                                    <label for="warranty">Warranty</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group clearfix">
                                                <div class="icheck-primary d-inline">
                                                    <input type="radio" id="wait_price" name="status_report"
                                                        value="wait_price"
                                                        @if ($schedule->status == \App\Models\MaintenanceSchedule::STATUS_WAIT_PRICE) checked @endif />
                                                    <label for="wait_price">รอเสนอราคา</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group clearfix">
                                                <div class="icheck-primary d-inline">
                                                    <input type="radio" id="rework" name="status_report"
                                                        value="rework" @if ($schedule->status == \App\Models\MaintenanceSchedule::STATUS_REWORK) checked @endif />
                                                    <label for="rework">Rework</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group clearfix">
                                                <div class="icheck-primary d-inline">
                                                    <input type="radio" id="job_close" name="status_report"
                                                        value="job_close"
                                                        @if ($schedule->status == \App\Models\MaintenanceSchedule::STATUS_JOB_CLOSE) checked @endif />
                                                    <label for="job_close">Job Close</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group clearfix">
                                                <div class="icheck-primary d-inline">
                                                    <input type="radio" id="status_report" name="status_report"
                                                        value="other" @if ($schedule->status == \App\Models\MaintenanceSchedule::STATUS_OTHER) checked @endif />
                                                    <label for="status_report">อื่นๆ</label>
                                                    <label for="other_check">
                                                        <input autocomplete="nope" type="text"
                                                            class="form-control form-control-sm @error('other_detail') is-invalid @enderror"
                                                            id="other_detail" name="other_detail" placeholder=""
                                                            value="{{ old('other_detail') }}">
                                                    </label>
                                                </div>
                                                {{--                            <div class="icheck-primary d-inline"> --}}
                                                {{--                                <input type="checkbox" name="other_check" id="other_check" value="1"> --}}

                                                {{--                            </div> --}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card ">
                    <div class="card-header">
                        <h3 class="card-title">เวลาทำงาน</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <div class="row">
                                {{--                                    เวลาทำงานปกติ --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-4 align-self-center text-center mt-4">
                                                <label for="normal_start_time">เวลาปกติ :</label>
                                            </div>

                                            <div class="col-4">
                                                <label for="start_hour">เวลา</label><br>
                                                <select class="form-control form-control-sm select2time"
                                                    name="normal_start_time_hour">
                                                    @if (empty($schedule_other->normal_start_time))
                                                        @php
                                                            $normal_start_time_hour = old('normal_start_time_hour');
                                                        @endphp
                                                    @else
                                                        @php
                                                            $normal_start_time_hour = \Carbon\Carbon::createFromFormat('H:i:s', $schedule_other->normal_start_time)->translatedFormat('H');
                                                        @endphp
                                                    @endif
                                                    @for ($i = 0; $i < 24; $i++)
                                                        @php
                                                            $hour = str_pad(intval($i), 2, 0, STR_PAD_LEFT);
                                                        @endphp
                                                        <option @if ($normal_start_time_hour == $hour) selected @endif
                                                            value="{{ $hour }}">{{ $hour }}</option>
                                                    @endfor
                                                </select>
                                            </div>
                                            <div class="col-4">
                                                <label for="start_minute">นาที</label><br>
                                                <select class="form-control form-control-sm select2time"
                                                    name="normal_start_time_minute">
                                                    @if (empty($schedule_other->normal_start_time))
                                                        @php
                                                            $normal_start_time_minute = old('normal_start_time_minute');
                                                        @endphp
                                                    @else
                                                        @php
                                                            $normal_start_time_minute = \Carbon\Carbon::createFromFormat('H:i:s', $schedule_other->normal_start_time)->translatedFormat('i');
                                                        @endphp
                                                    @endif
                                                    @for ($i = 0; $i < 60; $i++)
                                                        @php
                                                            $minute = str_pad(intval($i), 2, 0, STR_PAD_LEFT);
                                                        @endphp
                                                        <option @if ($normal_start_time_minute == $minute) selected @endif
                                                            value="{{ $minute }}">{{ $minute }}</option>
                                                    @endfor
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{--                                    นาที --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-4 align-self-center text-center">
                                                <label for="normal_end_time">ถึง :</label>
                                            </div>
                                            <div class="col-4">
                                                <label for="start_hour">เวลา</label><br>
                                                <select class="form-control form-control-sm select2time"
                                                    name="normal_end_time_hour">
                                                    @if (empty($schedule_other->normal_end_time))
                                                        @php
                                                            $normal_end_time_hour = old('normal_end_time_hour');
                                                        @endphp
                                                    @else
                                                        @php
                                                            $normal_end_time_hour = \Carbon\Carbon::createFromFormat('H:i:s', $schedule_other->normal_end_time)->translatedFormat('H');
                                                        @endphp
                                                    @endif

                                                    @for ($i = 0; $i < 24; $i++)
                                                        @php
                                                            $hour = str_pad(intval($i), 2, 0, STR_PAD_LEFT);
                                                        @endphp
                                                        <option @if ($normal_end_time_hour == $hour) selected @endif
                                                            value="{{ $hour }}">{{ $hour }}</option>
                                                    @endfor
                                                </select>
                                            </div>
                                            <div class="col-4">
                                                <label for="start_minute">นาที</label><br>
                                                <select class="form-control form-control-sm select2time"
                                                    name="normal_end_time_minute">
                                                    @if (empty($schedule_other->normal_end_time))
                                                        @php
                                                            $normal_end_time_minute = old('normal_end_time_minute');
                                                        @endphp
                                                    @else
                                                        @php
                                                            $normal_end_time_minute = \Carbon\Carbon::createFromFormat('H:i:s', $schedule_other->normal_end_time)->translatedFormat('i');
                                                        @endphp
                                                    @endif
                                                    @for ($i = 0; $i < 60; $i++)
                                                        @php
                                                            $minute = str_pad(intval($i), 2, 0, STR_PAD_LEFT);
                                                        @endphp
                                                        <option @if ($normal_end_time_minute == $minute) selected @endif
                                                            value="{{ $minute }}">{{ $minute }}</option>
                                                    @endfor
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{--                                    รวมชั่วโมง --}}
                                <div class="col-md-6">
                                    <label for="total_normal_work_time">รวมชั่วโมงการทำงานปกติ<span class="text-danger">
                                            *</span>
                                    </label>
                                    <div class="form-group">
                                        <input autocomplete="nope" type="text"
                                            class="form-control form-control-sm @error('total_normal_work_time') is-invalid @enderror"
                                            id="total_normal_work_time" name="total_normal_work_time" placeholder=""
                                            value="{{ $schedule_other->total_normal_work_time ?? '' }}">
                                        @error('total_normal_work_time')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                {{--                                    เวลาทำงาน ot --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-4 align-self-center text-center mt-4">
                                                <label for="ot_start_time">งานล่วงเวลา : </label>
                                            </div>
                                            <div class="col-4">
                                                <label for="start_hour">เวลา</label><br>
                                                <select class="form-control form-control-sm select2time"
                                                    name="ot_start_time_hour">
                                                    @if (empty($schedule_other->ot_start_time))
                                                        @php
                                                            $ot_start_time_hour = old('ot_start_time_hour');
                                                        @endphp
                                                    @else
                                                        @php
                                                            $ot_start_time_hour = \Carbon\Carbon::createFromFormat('H:i:s', $schedule_other->ot_start_time)->translatedFormat('H');
                                                        @endphp
                                                    @endif

                                                    @for ($i = 0; $i < 24; $i++)
                                                        @php
                                                            $hour = str_pad(intval($i), 2, 0, STR_PAD_LEFT);
                                                        @endphp
                                                        <option @if ($ot_start_time_hour == $hour) selected @endif
                                                            value="{{ $hour }}">{{ $hour }}</option>
                                                    @endfor
                                                </select>
                                            </div>
                                            <div class="col-4">
                                                <label for="start_minute">นาที</label><br>
                                                <select class="form-control form-control-sm select2time"
                                                    name="ot_start_time_minute">
                                                    @if (empty($schedule_other->ot_start_time))
                                                        @php
                                                            $ot_start_time_minute = old('ot_start_time_minute');
                                                        @endphp
                                                    @else
                                                        @php
                                                            $ot_start_time_minute = \Carbon\Carbon::createFromFormat('H:i:s', $schedule_other->ot_start_time)->translatedFormat('i');
                                                        @endphp
                                                    @endif
                                                    @for ($i = 0; $i < 60; $i++)
                                                        @php
                                                            $minute = str_pad(intval($i), 2, 0, STR_PAD_LEFT);
                                                        @endphp
                                                        <option @if ($ot_start_time_minute == $minute) selected @endif
                                                            value="{{ $minute }}">{{ $minute }}</option>
                                                    @endfor
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{--                                    ถึงเวลา --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="row ">
                                            <div class="col-4 align-self-center text-center">
                                                <label for="normal_end_time ">ถึง :</label>
                                            </div>
                                            <div class="col-4">
                                                <label for="start_hour">เวลา</label><br>
                                                <select class="form-control form-control-sm select2time"
                                                    name="ot_end_time_hour">
                                                    @if (empty($schedule_other->ot_end_time))
                                                        @php
                                                            $ot_end_time_hour = old('ot_end_time_hour');
                                                        @endphp
                                                    @else
                                                        @php
                                                            $ot_end_time_hour = \Carbon\Carbon::createFromFormat('H:i:s', $schedule_other->ot_end_time)->translatedFormat('H');
                                                        @endphp
                                                    @endif
                                                    @for ($i = 0; $i < 24; $i++)
                                                        @php
                                                            $hour = str_pad(intval($i), 2, 0, STR_PAD_LEFT);
                                                        @endphp
                                                        <option @if ($ot_end_time_hour == $hour) selected @endif
                                                            value="{{ $hour }}">{{ $hour }}</option>
                                                    @endfor
                                                </select>
                                            </div>
                                            <div class="col-4">
                                                <label for="start_minute">นาที</label><br>
                                                <select class="form-control form-control-sm select2time"
                                                    name="ot_end_time_minute">
                                                    @if (empty($schedule_other->ot_end_time))
                                                        @php
                                                            $ot_end_time_minute = old('ot_end_time_minute');
                                                        @endphp
                                                    @else
                                                        @php
                                                            $ot_end_time_minute = \Carbon\Carbon::createFromFormat('H:i:s', $schedule_other->ot_end_time)->translatedFormat('i');
                                                        @endphp
                                                    @endif

                                                    @for ($i = 0; $i < 60; $i++)
                                                        @php
                                                            $minute = str_pad(intval($i), 2, 0, STR_PAD_LEFT);
                                                        @endphp
                                                        <option @if ($ot_end_time_minute == $minute) selected @endif
                                                            value="{{ $minute }}">{{ $minute }}</option>
                                                    @endfor
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{--                                    รวมชั่วโมง --}}
                                <div class="col-md-6">
                                    <label for="total_ot_work_time">รวมชั่วโมงการทำงานล่วงเวลา</label>
                                    <div class="form-group">
                                        <input autocomplete="nope" type="text"
                                            class="form-control form-control-sm @error('total_ot_work_time') is-invalid @enderror"
                                            id="total_ot_work_time" name="total_ot_work_time" placeholder=""
                                            value="{{ $schedule_other->total_ot_work_time ?? '' }}">
                                        @error('total_ot_work_time')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row mt-4">
                                {{--                                    เวลาเดินทางไป --}}
                                <div class="col-md-6">
                                    <label for="travel_time">จำนวนชั่วโมงเดินทางไป (ชั่วโมง)<span class="text-danger">
                                            *</span>
                                    </label>
                                    <div class="form-group">
                                        <input autocomplete="nope" type="text"
                                            class="form-control form-control-sm @error('travel_time') is-invalid @enderror"
                                            id="travel_time" name="travel_time" placeholder=""
                                            value="{{ $schedule_other->travel_time ?? '' }}">
                                        @error('travel_time')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="return_time">จำนวนชั่วโมงเดินทางกลับ (ชั่วโมง)<span class="text-danger">
                                            *</span>
                                    </label>
                                    <div class="form-group">
                                        <input autocomplete="nope" type="text"
                                            class="form-control form-control-sm @error('return_time') is-invalid @enderror"
                                            id="return_time" name="return_time" placeholder=""
                                            value="{{ $schedule_other->return_time ?? '' }}">
                                        @error('return_time')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label>สถานะการทำงาน : </label>
                                    <div class="form-group ">
                                        <label>
                                            <input type="radio" name="status"
                                                @if (isset($schedule_other->status) == \App\Models\TechnicianReport::STATUS_FINISHED) checked @endif
                                                value="{{ \App\Models\TechnicianReport::STATUS_FINISHED }}">
                                            งานเรียบร้อย
                                        </label>
                                        &emsp;
                                        <label>
                                            <input type="radio" name="status"
                                                @if (isset($schedule_other->status) == \App\Models\TechnicianReport::STATUS_UNFINISHED || empty($schedule_other->status)) checked @endif
                                                value="{{ \App\Models\TechnicianReport::STATUS_UNFINISHED }}">
                                            งานยังไม่เสร็จ
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fa-solid fa-image"></i>
                            รูปภาพ
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <div class="needsclick dropzone" id="imageDropzone">
                                <div class="dz-message" data-dz-message>
                                    <div class="mb-3">
                                        <i class="fa-solid fa-upload" style="font-size: 20px"></i>
                                    </div>
                                    <h4>อัพโหลดรูปภาพ</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <div class="modal fade bs-example-modal-center" id="preview-img" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">รูปภาพ</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <img id="preview-img-src" style="width: 100%">
                </div>
            </div>
        </div>
    </div>
@stop
@section('footer')
    <div class="text-right">
        <button type="button" onclick="$('#formUpdate').submit()" class="btn btn-primary"><i
                class="fas fa-fw fa-save mr-2"></i>
            บันทึกข้อมูล
        </button>
    </div>
@endsection
@section('css')
    <style>
        .picker__select--month,
        .picker__select--year {
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
@section('plugins.Select2', true)
@section('plugins.pickadatejs', true)
@section('plugins.Dropzone', true)
@section('plugins.jQueryValidation', true)
@section('plugins.Jqueryui', true)
@section('plugins.i-check', true)

@section('js')
    <script>
        $('.select2').select2({
            closeOnSelect: false,
            placeholder: "-- กรุณาเลือกพนักงาน --",
            allowHtml: true,
            allowClear: true,
            tags: true,

        });

        $('.select2customer').select2({
            placeholder: "-- กรุณาเลือกบริษัทที่ต้องการเข้าซ่อมบำรุง --",
        });


        $('.select2type').select2({
            placeholder: "-- กรุณาเลือกประเภทการเข้าซ่อมบำรุง --",
        });

        // calendar
        $('.datepicker').pickadate({
            formatSubmit: 'yyyy-mm-dd',
            selectMonths: true,
            selectYears: 60,
            min: new Date,
        })


        $('.ignore').blur(function() {
            if ($(this).val() == "") {
                $(this).parent().removeClass("inputSuccess");
            }
        });

        //validate value
        var select2label, datePickerLabel;
        $(document).ready(function() {
            $('#formUpdate').validate({
                errorClass: 'is-invalid',
                validClass: 'is-valid',
                ignore: ".ignore",
                rules: {
                    customer_name: {
                        required: true
                    },
                    appointment_date: {
                        required: true
                    },
                    'technician_id[]': {
                        required: true
                    },
                    contract: {
                        required: true,
                        number: true
                    },
                    start_contract: {
                        required: true
                    },
                    end_contract: {
                        required: true
                    },
                },
                messages: {},
                errorPlacement: function(label, element) {
                    if (element.hasClass('select2')) {
                        label.insertAfter(element.next('.select2-container')).addClass(
                            'mt-2 text-danger is-invalid');
                        select2label = label

                    } else if (element.hasClass('datepicker')) {
                        label.insertAfter(element.next('.form-control')).addClass('mt-2 text-danger');
                        datePickerLabel = label
                    } else {
                        label.addClass('mt-2 text-danger');
                        label.insertAfter(element);
                    }

                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass(errorClass).removeClass('success');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass(errorClass).addClass('success');
                },
                submitHandler: function(form) {
                    Swal.fire({
                        icon: 'info',
                        title: 'เพิ่มข้อมูล',
                        text: 'ยืนยันการเพิ่มข้อมูล',
                        showCancelButton: true,
                        confirmButtonText: 'ยืนยัน',
                        cancelButtonText: 'ยกเลิก',
                        showLoaderOnConfirm: true,
                        allowOutsideClick: true,
                        allowEscapeKey: true,
                        animation: false,
                        focusCancel: true,
                        preConfirm: (e) => {
                            return new Promise(function(resolve) {
                                form.submit();
                            })
                        },
                    })
                }
            });
        });

        //watch the change on select
        $('.appointment_date, #technician_id, #end_contract').on("change", function(e) {
            $(this).valid(); //remove label
        });


        // show image
        $(document).on('click', '.preview-img', function() {
            $('#preview-img-src').attr('src', $(this).data('src'))
            $('#preview-img').modal('show')
        })

        //upload image
        $('#imageDropzone').dropzone({
            url: '{{ route('dropzone.store') }}',
            maxFilesize: 10, // MB
            addRemoveLinks: true,
            acceptedFiles: 'image/jpeg,image/png,image/jpg',
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            success: function(file, response) {
                console.log(response)
                $(file.previewElement).append(
                    '&emsp;<a class="preview-img" target="_blank" style="cursor: pointer" data-src="' + file
                    .dataURL + '"> ดูรูปภาพ</a>')
                $(file.previewElement).append('<input type="hidden" name="images[]" value="' + response.name +
                    '">')
                $(file.previewElement).append('<input type="hidden" name="images_original_name[]" value="' +
                    response.original_name + '">')
            },
            init: function() {
                @if (isset($schedule_other) && $images)
                    @foreach ($images as $key => $image)
                        var file = {!! json_encode($image) !!};
                        file.url_thumnail = '{!! $image->getUrl('thumbnail') !!}';
                        file.url = '{!! $image->getUrl() !!}';
                        file.name = '{!! $image->name !!}';
                        this.emit("addedfile", file);
                        this.emit("thumbnail", file, file.url_thumnail);
                        this.emit("complete", file);
                        $(file.previewElement).append('<input type="hidden" name="images[]" value="' + file
                            .file_name + '">')
                        $(file.previewElement).append(
                            '<input type="hidden" name="images_original_name[]" value="' + file
                            .original_name + '">')
                        $(file.previewElement).append(
                            '&emsp;<a class="preview-img" target="_blank" style="cursor: pointer" data-src="' +
                            file.url + '"> ดูภาพ</a>')
                    @endforeach
                @endif
            },

            dictFallbackMessage: "Your browser does not support drag'n'drop file uploads.",
            dictFallbackText: "Please use the fallback form below to upload your files like in the olden days.",
            dictFileTooBig: 'ไฟล์มีขนาดใหญ่ (@{{ filesize }}MiB). ไฟล์รองรับได้สูงสุด: @{{ maxFilesize }}MiB.',
            dictInvalidFileType: "You can't upload files of this type.",
            dictResponseError: "Server responded with @{{ statusCode }} code.",
            dictCancelUpload: "Cancel upload",
            dictCancelUploadConfirmation: "Are you sure you want to cancel this upload?",
            dictRemoveFile: "ลบรูปภาพ",
            dictMaxFilesExceeded: "You can not upload any more files.",
        })
        Dropzone.autoDiscover = false;
        $(function() {
            $("#imageDropzone").sortable({
                items: '.dz-preview',
                cursor: 'move',
                opacity: 0.5,
                containment: '#imageDropzone',
                distance: 20,
                tolerance: 'pointer'
            });
        });


        function confirmSubmit() {
            Swal.fire({
                icon: 'info',
                title: 'ลงเวลา',
                text: 'ยืนยันการลงเวลา',
                showCancelButton: true,
                confirmButtonText: 'ยืนยัน',
                cancelButtonText: 'ยกเลิก',
                showLoaderOnConfirm: true,
                animation: false,
                preConfirm: (e) => {
                    return new Promise(function(resolve) {
                        $('#formStore').submit();
                    })
                }
            })
        }
    </script>
@stop
