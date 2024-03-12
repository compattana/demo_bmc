@extends('adminlte::page')

@section('title', 'Reading/Measuring - แก้ไขข้อมูล')

@section('content_header')
    <div class="row">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark">
                <i class="fad fa-fw fa-clipboard-list"></i> Reading/Measuring - {{$product_model->title}}
            </h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{route('home')}}">หน้าแรก</a></li>
                <li class="breadcrumb-item"><a href="{{route('product_models.index')}}">จัดการ Reading/Measuring</a></li>
                <li class="breadcrumb-item active">แก้ไขข้อมูล - {{$product_model->title}}</li>
            </ol>
        </div>
    </div>
@stop

@section('content')

    <form action="{{route('product_models.update',['product_model'=>$product_model->id])}}" method="post" id="formUpdate"
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

{{--                        <label for="product_id">ชื่อ Product Serials <span class="text-danger">*</span> </label>--}}
{{--                        <div class="form-group">--}}
{{--                            <select class="form-control select2 " name="product_id">--}}
{{--                                @foreach($products as $product)--}}
{{--                                    <option @if($product_model->product_id==$product->id) selected--}}
{{--                                            @endif value="{{$product->id}}"> {{$product->title}}</option>--}}
{{--                                @endforeach--}}
{{--                            </select>--}}
{{--                            @error('product_id')--}}
{{--                            <div class="invalid-feedback">{{ $message }}</div>--}}
{{--                            @enderror--}}
{{--                        </div>--}}

                        <label for="title">ชื่อ <span class="text-danger">*</span> </label>
                        <div class="form-group">
                            <input autocomplete="nope" type="text"
                                   class="form-control form-control-sm @error('title') is-invalid @enderror"
                                   id="title"
                                   name="title" placeholder="" value="{{$product_model->title}}">
                            @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <label for="type">ประเภท <span class="text-danger">*</span> </label>
                        <div class="form-group">
                            <select class="form-control select2" name="type">
                                @foreach(\App\Models\ProductModel::getTypeArray() as $key => $value)
                                    <option @if($product_model->type==$key) selected
                                        @endif value="{{$key}}">{{$value}}</option>
                                @endforeach
                            </select>
                            @error('type')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>


                        <label for="limit_value">ค่าสูงสุด <span class="text-danger">*</span> </label>
                        <div class="form-group">
                            <input autocomplete="nope" type="text"
                                   class="form-control form-control-sm @error('limit_value') is-invalid @enderror"
                                   id="limit_value"
                                   name="limit_value" placeholder="" value="{{$product_model->limit_value}}">
                            @error('limit_value')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <label>สถานะ</label>
                        <div class="form-group ">
                            <label>
                                <input type="radio" name="status"
                                       @if($product_model->status==\App\Models\ProductModel::STATUS_ACTIVE)  checked
                                       @endif value="{{\App\Models\ProductModel::STATUS_ACTIVE}}">
                                ใช้งาน
                            </label>
                            &emsp;
                            <label>
                                <input type="radio" name="status"
                                       @if($product_model->status==\App\Models\ProductModel::STATUS_INACTIVE)  checked
                                       @endif
                                       value="{{\App\Models\ProductModel::STATUS_INACTIVE}}">
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
        $('.select2').select2({
            minimumResultsForSearch: Infinity
        });

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
