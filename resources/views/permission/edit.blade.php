@extends('adminlte::page')

@section('title', 'Permission Edit')

@section('content_header')
    <div class="row">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark"> Permission Edit</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{route('home')}}">หน้าแรก</a></li>
                <li class="breadcrumb-item"><a href="{{route('permissions.index')}}">Permission</a></li>
                <li class="breadcrumb-item active">Edit</li>
            </ol>
        </div>
    </div>
@stop

@section('content')

    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <button type="button" onclick="confirmSubmit()" class="btn btn-primary btn-lg mb-2"><i
                    class="fas fa-save"></i> บันทึก
            </button>
            <form action="{{route('permissions.update',['permission'=>$permission->id])}}" id="formUpdate">

                @method('PUT')

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Detail</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <div class="card-body">

                        <div class="form-group">
                            <label for="name">permission</label>
                            <input autocomplete="nope" type="text"
                                   class="form-control form-control-sm @error('name') is-invalid @enderror"
                                   name="name" placeholder="" value="{{$permission->name}}">
                            @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="name">description</label>
                            <input type="text" name="description" value="{{$permission->description}}"
                                   class="form-control form-control-sm">
                        </div>
                        <div class="form-group">
                            <label for="guard name">guard name</label>
                            <select class="form-control form-control-sm" name="guard_name">
                                <option value="web" @if($permission->guard_name=='web') selected @endif >web</option>
                                <option value="api" @if($permission->guard_name=='api') selected @endif>api</option>
                            </select>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>

@stop
@section('plugins.Select2', true)
@section('js')
    <script>
        $('.select2bs4').select2()

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
    </script>
@stop
