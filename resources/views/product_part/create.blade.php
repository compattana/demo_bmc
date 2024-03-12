@extends('adminlte::page')

@section('title', 'อะไหล่ - เพิ่มข้อมูล')

@section('content_header')
    <div class="row">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark">
                <i class="fad fa-fw fa-puzzle-piece"></i> เพิ่มข้อมูล
            </h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{route('home')}}">หน้าแรก</a></li>
                <li class="breadcrumb-item"><a href="{{route('product_parts.index')}}">ข้อมูลอะไหล่</a></li>
                <li class="breadcrumb-item active">เพิ่มข้อมูล</li>
            </ol>
        </div>
    </div>
@stop

@section('content')
    <form action="{{route('product_parts.store')}}" method="post" id="formStore" enctype="multipart/form-data">
        <div class="row">
            <div class="col-md-7">
                <div class="card">
                    @csrf
                    <div class="card-header">
                        <h3 class="card-title">รายละเอียด</h3>
                    </div>
                    <div class="card-body">
                        <label for="title">ชื่ออะไหล่ <span class="text-danger">*</span> </label>
                        <div class="form-group">
                            <input autocomplete="nope" type="text"
                                   class="form-control form-control-sm @error('title') is-invalid @enderror"
                                   id="title"
                                   name="title" placeholder="" value="{{old('title')}}">
                            @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <label for="part_no">เลขที่อะไหล่ <span class="text-danger">*</span> </label>
                        <div class="form-group">
                            <input autocomplete="nope" type="text"
                                   class="form-control form-control-sm @error('part_no') is-invalid @enderror"
                                   id="part_no"
                                   name="part_no" placeholder="" value="{{old('part_no')}}">
                            @error('part_no')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
{{--                        <label for="type">ประเภท <span class="text-danger">*</span> </label>--}}
{{--                        <div class="form-group">--}}
{{--                            <select class="form-control select2 " name="type">--}}
{{--                                @foreach(\App\Models\ProductPart::getTypeArray() as $key => $value)--}}
{{--                                    <option value="{{$key}}">{{$value}}</option>--}}
{{--                                @endforeach--}}
{{--                            </select>--}}
{{--                            @error('type')--}}
{{--                            <div class="invalid-feedback">{{ $message }}</div>--}}
{{--                            @enderror--}}
{{--                        </div>--}}

                        <label for="limit_value">ค่าสูงสุด <span class="text-danger">*</span> </label>
                        <div class="form-group">
                            <input autocomplete="nope" type="text"
                                   class="form-control form-control-sm @error('limit_value') is-invalid @enderror"
                                   id="limit_value"
                                   name="limit_value" placeholder="" value="{{old('limit_value')}}">
                            @error('limit_value')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <label>สถานะ</label>
                        <div class="form-group ">
                            <label>
                                <input type="radio" name="status" checked
                                       value="{{\App\Models\ProductPart::STATUS_ACTIVE}}">
                                ใช้งาน
                            </label>
                            &emsp;
                            <label>
                                <input type="radio" name="status" value="{{\App\Models\ProductPart::STATUS_INACTIVE}}">
                                ไม่ใช้งาน
                            </label>
                        </div>

                    </div>
                </div>
                <div class="card ">
                    <div class="card-header">
                        <h3 class="card-title">รายละเอียดเพิ่มเติม</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="note">หมายเหตุ</label><br>
                            <div class="form-group">
                                <input autocomplete="nope" type="text"
                                       class="form-control form-control-sm @error('note') is-invalid @enderror"
                                       id="note"
                                       name="note" placeholder="" value="{{old('note')}}">
                                @error('note')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
{{--            <div class="col-md-5">--}}
{{--                <div class="card card-outline card-warning">--}}
{{--                    <div class="card-header">--}}
{{--                        <h3 class="card-title">สินค้า</h3>--}}
{{--                        <div class="card-tools">--}}
{{--                            <button type="button" class="btn btn-tool" data-card-widget="collapse">--}}
{{--                                <i class="fas fa-minus"></i>--}}
{{--                            </button>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="card-body">--}}
{{--                        <table class="table table-striped text-center add-product">--}}
{{--                            <thead>--}}
{{--                            <tr>--}}
{{--                                <th>#</th>--}}
{{--                                <th>สินค้า</th>--}}
{{--                                <th>#</th>--}}
{{--                            </tr>--}}
{{--                            </thead>--}}
{{--                            <tbody>--}}
{{--                            <tr>--}}
{{--                                <td>1</td>--}}
{{--                                <td>--}}
{{--                                    <select name="product_id[]"--}}
{{--                                            class="form-control select2product  @error('product_has_parts.product_id') is-invalid @enderror"">--}}
{{--                                        <option selected value="">-- กรุณาเลือกสินค้า --</option>--}}
{{--                                    </select>--}}
{{--                                    @error('product_has_parts.product_id')--}}
{{--                                    <div class="invalid-feedback">{{ $message }}</div>--}}
{{--                                    @enderror--}}
{{--                                </td>--}}
{{--                                <td>--}}
{{--                                    <button class="btn btn-danger btn-xs delete-row"><i--}}
{{--                                            class="fas fa-trash"></i>--}}
{{--                                    </button>--}}
{{--                                </td>--}}
{{--                            </tr>--}}
{{--                            </tbody>--}}
{{--                        </table>--}}
{{--                    </div>--}}
{{--                    <div class="card-footer ">--}}
{{--                        <div class="float-right">--}}
{{--                            <button type="button" class="btn btn-secondary add-row"><i class="fas fa-plus"></i>--}}
{{--                                เพิ่มสินค้า--}}
{{--                            </button>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
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
@section('plugins.i-check',true)
@section('js')

    <script>

        // Find and remove selected table rows
        $(document).on("click", ".delete-row", function () {
            $(this).parents("tr").remove();
        });

        // add rows to table
        var i = 0;
        $(".add-row").click(function () {
            var rowCount = $('.add-product tr').length;
            i++;
            var markup = '<tr>' + `<td>${rowCount}</td>` +
                '<td><select class="form-control select2product " name="product_id[]"><option selected value="">-- กรุณาเลือกสินค้า --</option></select></td>' +
                '<td> <button class="btn btn-danger btn-xs delete-row"><i class="fas fa-trash"></i></button>' +
                '</tr>';
            $('table.add-product').append(markup);

            $('.select2product').select2({
                ajax: {
                    url: "{{route('ajax.select2.products')}}",
                    dataType: 'json',
                    delay: 250,
                    data: function (params) {
                        return {
                            search: params.term // search term
                        };
                    },
                    processResults: function (response) {
                        return {
                            results: response
                        };
                    },
                    cache: true
                }
            });
        });

        // fetch data with ajax
        $('.select2product').select2({
            ajax: {
                url: "{{route('ajax.select2.products')}}",
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        search: params.term // search term
                    };
                },
                processResults: function (response) {
                    return {
                        results: response
                    };
                },
                cache: true

            }

        });
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
