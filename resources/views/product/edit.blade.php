@extends('adminlte::page')

@section('title', 'สินค้า - แก้ไขข้อมูล')

@section('content_header')
    <div class="row">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark">
                <i class="fad fa-fw fa-box"></i> สินค้า {{$product->title}}
            </h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{route('home')}}">หน้าแรก</a></li>
                <li class="breadcrumb-item"><a href="{{route('products.index')}}">จัดการสินค้า</a></li>
                <li class="breadcrumb-item active">แก้ไขข้อมูล - {{$product->title}}</li>
            </ol>
        </div>
    </div>
@stop

@section('content')

    <form action="{{route('products.update',['product'=>$product->id])}}" method="post" id="formUpdate"
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

                        <label for="title">ชื่อ <span class="text-danger">*</span> </label>
                        <div class="form-group">
                            <input autocomplete="nope" type="text"
                                   class="form-control form-control-sm @error('title') is-invalid @enderror"
                                   id="title"
                                   name="title" placeholder="" value="{{$product->title}}">
                            @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <label for="title">รหัสสินค้า <span class="text-danger">*</span> </label>
                        <div class="form-group">
                            <input autocomplete="nope" type="text"
                                   class="form-control form-control-sm @error('code') is-invalid @enderror"
                                   id="code"
                                   name="code" placeholder="" value="{{$product->code}}">
                            @error('code')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <label>สถานะ</label>
                        <div class="form-group ">
                            <label>
                                <input type="radio" name="status"
                                       @if($product->status==\App\Models\Product::STATUS_ACTIVE)  checked
                                       @endif value="{{\App\Models\Product::STATUS_ACTIVE}}">
                                ใช้งาน
                            </label>
                            &emsp;
                            <label>
                                <input type="radio" name="status"
                                       @if($product->status==\App\Models\Product::STATUS_INACTIVE)  checked
                                       @endif
                                       value="{{\App\Models\Product::STATUS_INACTIVE}}">
                                ไม่ใช้งาน
                            </label>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card card-outline card-warning">
                    <div class="card-header">
                        <h3 class="card-title">Product Serials</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped text-center add-product " id="count">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>ลบ</th>
                                <th width="40%">Product Serial</th>
                                <th width="20%">สถานะ</th>

                            </tr>
                            </thead>
                            <tbody>
                            @php
                                $i=1
                            @endphp
                            @foreach($product_serials as $product_serial)
                                <tr>
                                    <input type="hidden" name="serial_items[]" value="{{$product_serial->id}}">
                                    <td>{{$i}}</td>
                                    <td>
                                        <input type="checkbox" name="remove_serial_id[]" value="{{$product_serial->id}}">
                                    </td>
                                    <td>
                                        <input autocomplete="nope" type="text"
                                               class="form-control form-control-sm text-center"
                                               id="old_serial_name"
                                               name="old_serial_name[]" placeholder=""
                                               value="{{$product_serial->serial_name}}">
                                        <input type="hidden" name="old2_serial_name[]" value="{{$product_serial->serial_name}}">
                                    </td>
                                    <td>

                                        <input name="" type="checkbox"
                                               data-toggle="switchbutton"
                                               @if($product_serial->serial_status == 'active') checked
                                               @endif data-onstyle="success"
                                               data-size="xs" data-onlabel="ใช้งาน" data-offlabel="ไม่ใช้งาน"
                                               class="serial_status">
                                        <input type="hidden" name="serial_status[]"
                                               @if($product_serial->serial_status == 'active') value="active"
                                               @endif value="inactive">

                                    </td>
                                </tr>
                                @php
                                    $i++;
                                @endphp
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer ">
                        <div class="float-right">
                            <button type="button" class="btn btn-secondary add-row"><i class="fas fa-plus"></i>
                                เพิ่ม
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@stop

@section('footer')
    <div class="text-right">
        <button type="button" id="btnSave" class="btn btn-primary"><i
                class="fas fa-fw fa-save mr-2"></i>
            บันทึกข้อมูล
        </button>
    </div>
@endsection
@section('css')

@stop
@section('plugins.bootstrapSwitch',true)
@section('plugins.Select2',true)
@section('js')
    <script>

        // Find and remove selected table rows
        $(document).on("click", ".delete-row", function () {
            $(this).parents("tr").remove();
        });

        // add rows to table


        $(".add-row").click(function () {
            var count = $('#count tr').length;
            var i = count - 1;
            var markup = '<tr>' + `<td>${count}</td>` +
                '<td> <button class="btn btn-danger btn-xs delete-row"><i class="fas fa-trash"></i> ลบ </button>' +'</td>' +
                '<td>' + `<input class="form-control form-control-sm text-center" id="serial_name" name="serial_name[]" placeholder="" value="{{old('serial_name[]')}}">` + '</td>' +
                '<td>' +
                `<input id="mySwitch-${i}" name="" type="checkbox" data-toggle="switchbutton" checked data-onstyle="success" checked data-size="xs" data-on="active" data-off="inactive" data-onlabel="ใช้งาน" data-offlabel="ไม่ใช้งาน" class="serial_status">` +
                ' <input type="hidden" name="serial_status[]" value="active" >' +
                '</td>' + '</tr>';
            $('table.add-product').append(markup);
            document.getElementById(`mySwitch-${i}`).switchButton({});
            $(document).on('change', '.serial_status', function () {
                if ($(this).prop("checked") === true) {
                    console.log($(this).parent().parent().find('[name="serial_status[]"]').val('active'))
                } else if ($(this).prop("checked") === false) {
                    console.log($(this).parent().parent().find('[name="serial_status[]"]').val('inactive'))
                }
            })
            i++;
        });


        $("#btnSave").click(function () {
            var valIsNull = true;
            $('input[name="serial_name[]"]').each(function () {
                console.log(this.value)
                if (!this.value) {
                    $(this).css({"border": "red solid 2px"});
                    valIsNull = false;
                }

            });
            $('input[name="serial_name[]"]').keyup(function () {
                $(this).css("border", "#ced4da solid 1px");
            });

            if (!valIsNull) {
                return;
            }

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

        });

        $(document).on('change', '.serial_status', function () {
            if ($(this).prop("checked") === true) {
                console.log($(this).parent().parent().find('[name="serial_status[]"]').val('active'))
            } else if ($(this).prop("checked") === false) {
                console.log($(this).parent().parent().find('[name="serial_status[]"]').val('inactive'))
            }
        })


    </script>
@stop
