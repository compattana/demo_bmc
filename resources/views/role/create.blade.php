@extends('adminlte::page')

@section('title', 'บทบาทการใช้งาน - เพิ่มข้อมูล')

@section('content_header')

    <div class="row">

        <div class="col-sm-6">
            <h1 class="m-0 text-dark"><i class="fas fa-user-shield"></i> บทบาทการใช้งาน - เพิ่มข้อมูล</h1>
        </div>

        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{route('home')}}">หน้าแรก</a></li>
                <li class="breadcrumb-item"><a href="{{route('roles.index')}}">บทบาทการใช้งาน</a></li>
                <li class="breadcrumb-item active">เพิ่มข้อมูล</li>
            </ol>
        </div>

    </div>
@stop

@section('content')
    <form action="{{route('roles.store')}}" id="formStore" method="post">
        @csrf
        <div class="row">
            <div class="col-md-5">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">รายละเอียด</h3>
                    </div>
                    <div class="card-body">

                        <div class="form-group">
                            <label for="name">Code</label>
                            <input autocomplete="nope" type="text"
                                   class="form-control form-control-sm  @error('name') is-invalid @enderror"
                                   name="name" placeholder="" value="{{old('name')}}">
                            @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="guard name">ชื่อ</label>
                            <input type="text" class="form-control form-control-sm" name="title">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-7">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">สิทธิ์การใช้งาน</h3>
                    </div>
                    <div class="card-body" style="padding: 0">
                        <table class="table table-hover ">
                            @foreach(config('permission-config') as $permission)
                                <tr>
                                    <th>{{$permission['text']}}</th>
                                    @foreach($permission['permissions'] as $item)
                                        <td>
                                            <label class="font-weight-normal">
                                                <input type="checkbox" name="permissions[]" value="{{$item['name']}}"> {{$item['text']}}
                                            </label>
                                        </td>
                                    @endforeach
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </form>
@stop
@section('footer')
    <div class="text-right">
        <button type="button" onclick="confirmSubmit()" class="btn btn-primary "><i
                class="fas fa-fw fa-save mr-2"></i>
            บันทึกข้อมูล
        </button>
    </div>
@endsection
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
