@extends('adminlte::page')

@section('title', 'Permission Add')

@section('content_header')
    <div class="row">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark"> Permission Add</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{route('home')}}">หน้าแรก</a></li>
                <li class="breadcrumb-item"><a href="{{route('permissions.index')}}">Permission</a></li>
                <li class="breadcrumb-item active">Add</li>
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
            <form action="{{route('permissions.store')}}" id="formStore" method="post">
            @csrf
            <!-- general form elements -->
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
                                   name="name" placeholder="" value="{{old('name')}}">
                            @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="name">description</label>
                            <input type="text" name="description" class="form-control form-control-sm">
                        </div>
                        <div class="form-group">
                            <label for="guard name">guard name</label>
                            <select class="form-control form-control-sm" name="guard_name">
                                <option value="web">web</option>
                                <option value="api">api</option>
                            </select>
                        </div>


                    </div>

                </div>
                <!-- /.card-body -->
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
                title: 'เพิ่มข้อมูล',
                text: 'ยืนยันการเพิ่มข้อมูล',
                showCancelButton: true,
                confirmButtonText: 'ยืนยัน',
                cancelButtonText: 'ยกเลิก',
                showLoaderOnConfirm: true,
                animation: false,
                preConfirm: (e) => {
                    return new Promise(function (resolve) {
                        $('#formStore').submit();
                    })
                }
            })
        }
    </script>
@stop
