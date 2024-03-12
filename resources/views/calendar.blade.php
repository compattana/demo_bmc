@extends('adminlte::page')

@section('title', 'ตารางงาน')

@section('content_header')
    <style>
        .fc-daygrid-event {
            position: relative;
            white-space: break-spaces;
        }

        .fc .fc-daygrid-event {
            z-index: 6;
            margin-top: 2px;
        }

        .btn-outline-secondary:not(:disabled):not(.disabled):active, .btn-outline-secondary:not(:disabled):not(.disabled).active, .show > .btn-outline-secondary.dropdown-toggle {
            color: #fff;
            background-color: #00499a;
            border-color: #6c757d;
        }

        .btn:not(:disabled):not(.disabled) {
            cursor: pointer;
            line-height: 2;
        }
    </style>
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1><i class="fa-duotone nav-icon fa-fw fa-calendar-lines-pen mr-2"></i>ตารางงาน</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">หน้าแรก</a></li>
                <li class="breadcrumb-item active">ตารางงาน</li>
            </ol>
        </div>
    </div>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/icheck-bootstrap/3.0.1/icheck-bootstrap.min.css"
          integrity="sha512-8vq2g5nHE062j3xor4XxPeZiPjmRDh6wlufQlfC6pdQ/9urJkU07NM0tEREeymP++NczacJ/Q59ul+/K2eYvcg=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
@stop
@section('content')
    <blockquote class="quote-warning ml-0 mr-0">
        <p><strong>หมายเหตุ</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <b><i class="fa-duotone fa-spinner"></i> : กำลังดำเนินงาน</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <b><i class="fa-solid fa-eye"></i> : รอตรวจ</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <b><i class="fa-solid fa-circle-check"></i> : Job Close</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <b><i class="fa-sharp fa-solid fa-flag" style="color: #464749;"></i> : รอเสนอราคา</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <b><i class="fa-sharp fa-solid fa-flag" style="color: #ff0000;"></i> : Rework</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <b><i class="fa-sharp fa-solid fa-flag" style="color: #fbae09;"></i> : Warranty</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <b><i class="fa-solid fa-message-dots"></i> : อื่นๆ</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        </p>
    </blockquote>
    <div class="row">
        <div class="col-12 col-xl-3">
            <div class="sticky-top mb-3">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">
                            <img src="{{asset('svg/status.svg')}}" width="25" class="mr-2">
                            <span class="align-middle">ประเภทงาน</span>
                        </h4>
                    </div>
                    <div class="card-body">
                        <a class="btn btn-app p-2 @if(request()->get('type')=='') bg-dark @endif "
                           href="{{route('calendars.index',['type'=>'','status'=>request()->get('status')])}}">
                            <i class="fa-duotone fa-ballot"></i> <span class="mt-2">ทั้งหมด</span>
                        </a>

                        <a class="btn btn-app p-2 @if(request()->get('type')=='maintenance_pm') bg-primary @endif "
                           href="{{route('calendars.index', ['type' => 'maintenance_pm','status'=>request()->get('status')])}}">
                            <i class="fa-duotone fa-file-signature"></i> ตามสัญญา
                        </a>


                        <a class="btn btn-app p-2 @if(request()->get('type')=='emergency') bg-danger @endif "
                           href="{{route('calendars.index', ['type' => 'emergency'])}}">
                            <i class="fa-duotone fa-light-emergency-on"></i> ฉุกเฉิน
                        </a>

                        <a class="btn btn-app p-2 @if(request()->get('type')=='install') bg-success @endif "
                           href="{{route('calendars.index', ['type' => 'install'])}}">
                            <i class="fa-duotone fa-screwdriver-wrench"></i> ติดตั้ง
                        </a>


                        <a class="btn btn-app p-2 @if(request()->get('type')=='no_contract') bg-info @endif "
                           href="{{route('calendars.index', ['type' => 'no_contract'])}}">
                            <i class="fa-duotone fa-file-xmark"></i> นอกสัญญา
                        </a>

                        <a class="btn btn-app p-2 @if(request()->get('type')=='rework') bg-secondary @endif "
                           href="{{route('calendars.index', ['type' => 'rework'])}}">
                            <i class="fa-duotone fa-arrows-rotate"></i> Rework
                        </a>

                        <a class="btn btn-app p-2 @if(request()->get('type')=='other') bg-secondary @endif "
                           href="{{route('calendars.index', ['type' => 'other'])}}">
                            <i class="fa-solid fa-bars"></i> งานอื่นๆ
                        </a>

                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">
                            <img src="{{asset('svg/technician.svg')}}" width="25" class="mr-2">
                            <span class="align-middle">รายชื่อช่าง</span>
                        </h4>
                    </div>
                    <div class="card-body">
                        <a href="{{route('calendars.index')}}"
                           class="btn btn-app {{ (url()->full() == route('calendars.index',[ 'type' => $type ]) ? 'active' : '' ) }}">
                            <i class="fa-regular fa-user-helmet-safety"></i>  ทั้งหมด
                        </a>
                        @foreach($technicians as $technician)
                            <a href="{{route('calendars.index',['user_id'=>$technician->id])}}"
                               class="btn btn-app p-2 @if(url()->full() == route('calendars.index',['user_id'=>$technician->id])) bg-secondary @endif">
                                <i class="fa-regular fa-user-helmet-safety"></i> {{$technician->name}}
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-xl-9">
            <div class="card card-primary">
                <div class="card-body p-0">
                    <div id="calendar"></div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('plugins.full-calendars',true)
@section('plugins.Jqueryui',true)

@section('js')
    <script>

        var events = @json($events)

        document.addEventListener('DOMContentLoaded', function () {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,dayGridWeek,timeGridDay'
                },

                events: events,

                eventContent: function (eventInfo) {
                    return {html: eventInfo.event.extendedProps.customHtml + eventInfo.event.title};
                },
            });
            calendar.render();
        });

    </script>
@stop
