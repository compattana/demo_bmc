@extends('adminlte::page')

@section('title', 'อาการ Dryer - แก้ไขข้อมูล')

@section('content_header')
    <div class="row">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark">
                <i class="fas fa-fw fa-cog"></i> อาการ Dryer {{$dryer->title}}
            </h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{route('home')}}">หน้าแรก</a></li>
                <li class="breadcrumb-item"><a href="{{route('dryers.index')}}">อาการ Dryer</a></li>
                <li class="breadcrumb-item active">แก้ไขข้อมูล - {{$dryer->title}}</li>
            </ol>
        </div>
    </div>
@stop

@section('content')

    <form action="{{route('dryers.update',['dryer'=>$dryer->id])}}" method="post" id="formUpdate"
          enctype="multipart/form-data">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    @csrf
                    @method('patch')
                    <div class="card-header">
                        <h3 class="card-title">รายละเอียด</h3>
                    </div>
                    <div class="card-body">

                        <label for="name">ชื่ออาการ Dryer <span class="text-danger">*</span> </label>
                        <div class="form-group">
                            <input autocomplete="nope" type="text"
                                   class="form-control form-control-sm @error('title') is-invalid @enderror"
                                   id="title"
                                   name="title" placeholder="" value="{{$dryer->title}}">
                            @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <label>สถานะ</label>
                        <div class="form-group ">
                            <label>
                                <input type="radio" name="status"
                                       @if($dryer->status==\App\Models\Dryer::STATUS_ACTIVE)  checked
                                       @endif value="{{\App\Models\Dryer::STATUS_ACTIVE}}">
                                ใช้งาน
                            </label>
                            &emsp;
                            <label>
                                <input type="radio" name="status"
                                       @if($dryer->status==\App\Models\Dryer::STATUS_INACTIVE)  checked
                                       @endif
                                       value="{{\App\Models\Dryer::STATUS_INACTIVE}}">
                                ไม่ใช้งาน
                            </label>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </form>
@stop

@section('footer')
    <div class="text-right">
        <button type="button" onclick="confirmSubmit()" class="btn btn-primary"><i
                class="fas fa-fw fa-save mr-2"></i>
            บันทึกข้อมูล
        </button>
    </div>
@endsection
@section('css')

@stop
@section('plugins.Select2',true)
@section('js')
    <script>
        $('.select2').select2();

        function confirmSubmit() {
            Swal.fire({
                icon: 'info',
                title: 'แก้ไขข้อมูล',
                text: 'ยืนยันการแก้ไขข้อมูล',
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

        $('.custom-file-input').on('change', function () {
            let fileName = $(this).val().split('\\').pop();
            $(this).next('.custom-file-label').addClass("selected").html(fileName);
        });

        function showPreview(event) {
            if (event.target.files.length > 0) {
                var src = URL.createObjectURL(event.target.files[0]);
                var preview = document.getElementById("preview");
                preview.src = src;
                preview.style.display = "block";
            }
        }

    </script>
@stop
