@extends('adminlte::page')

@section('title', 'สินค้า - เพิ่มข้อมูล')

@section('content_header')
    <div class="row">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark">
                <i class="fad fa-fw fa-box"></i> เพิ่มข้อมูล
            </h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{route('home')}}">หน้าแรก</a></li>
                <li class="breadcrumb-item"><a href="{{route('products.index')}}">ข้อมูลสินค้า</a></li>
                <li class="breadcrumb-item active">เพิ่มข้อมูล</li>
            </ol>
        </div>
    </div>
@stop

@section('content')
    <form action="{{route('products.store')}}" method="post" id="formStore" enctype="multipart/form-data">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    @csrf
                    <div class="card-header">
                        <h3 class="card-title">รายละเอียด</h3>
                    </div>
                    <div class="card-body">
                        <label for="title">ชื่อสินค้า <span class="text-danger">*</span> </label>
                        <div class="form-group">
                            <input autocomplete="nope" type="text"
                                   class="form-control form-control-sm @error('title') is-invalid @enderror"
                                   id="title"
                                   name="title" placeholder="" value="{{old('title')}}">
                            @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <label for="name">รหัสสินค้า <span class="text-danger">*</span></label>
                        <div class="form-group">
                            <input autocomplete="nope" type="text"
                                   class="form-control form-control-sm @error('code') is-invalid @enderror"
                                   id="code" name="code" placeholder="" value="{{old('code')}}">
                            @error('code')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <label>สถานะ</label>
                        <div class="form-group ">
                            <label>
                                <input type="radio" name="status" checked
                                       value="{{\App\Models\Customer::STATUS_ACTIVE}}">
                                ใช้งาน
                            </label>
                            &emsp;
                            <label>
                                <input type="radio" name="status" value="{{\App\Models\Customer::STATUS_INACTIVE}}">
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
                        <table class="table table-striped text-center add-serial">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th width="40%">Product Serial</th>
                                <th width="20%">สถานะ</th>
                                <th>#</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>1</td>
                                <td>
                                    <input autocomplete="nope" type="text"
                                           class="form-control form-control-sm text-center @error('product_serials.serial_name') is-invalid @enderror"
                                           name="serial_name[]" id="serial_name" placeholder="หมายเลขเครื่อง" value="{{old('serial_name[]')}}">

                                    @error('product_serials.serial_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </td>
                                <td>
                                    <input name="" type="checkbox" data-toggle="switchbutton"
                                           checked data-onstyle="success" data-size="xs" data-onlabel="ใช้งาน"
                                           data-offlabel="ไม่ใช้งาน" class="serial_status">
                                    <input type="hidden" name="serial_status[]" value="active">
                                </td>
                                <td>
                                    <button class="btn btn-danger btn-xs delete-row"><i
                                            class="fas fa-trash"></i> ลบ
                                    </button>
                                </td>
                            </tr>
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
        <button type="button"  id="btnSave" class="btn btn-primary"><i
                class="fas fa-fw fa-save mr-2"></i>
            บันทึกข้อมูล
        </button>
    </div>
@endsection
@section('css')

@stop
@section('plugins.bootstrapSwitch',true)
@section('plugins.Select2',true)
@section('plugins.jquery',true)
@section('js')
    <script>

        // Find and remove selected table rows
        $(document).on("click", ".delete-row", function () {
            $(this).parents("tr").remove();
        });

        // add rows to table
        var i = 0;
        $(".add-row").click(function () {
            i++;
            var rowCount = $('.add-serial tr').length;
            var markup = '<tr>' + `<td>${rowCount}</td>` +
                '<td>' + '<input class="form-control form-control-sm text-center id="serial_name" name="serial_name[]" placeholder="หมายเลขเครื่อง" value="{{old('serial_name[]')}}">' + '</td>' +
                '<td>' + `<input id="mySwitch-${i}" name="" type="checkbox" data-toggle="switchbutton" checked data-onstyle="success" checked data-size="xs" data-onlabel="ใช้งาน" data-offlabel="ไม่ใช้งาน"  class="serial_status">` +
                ' <input type="hidden" name="serial_status[]" value="active">' + '</td>' +
                '<td> <button class="btn btn-danger btn-xs delete-row"><i class="fas fa-trash"></i> ลบ </button>' +
                '</tr>';
            $('table.add-serial').append(markup);

            document.getElementById(`mySwitch-${i}`).switchButton();

            $(document).on('change', '.serial_status', function () {
                if ($(this).prop("checked") === true) {
                    console.log($(this).parent().parent().find('[name="serial_status[]"]').val('active'))
                } else if ($(this).prop("checked") === false) {
                    console.log($(this).parent().parent().find('[name="serial_status[]"]').val('inactive'))
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


        $("#btnSave").click(function () {
            var valIsNull = true;
            $('input[name="serial_name[]"]').each(function () {
                console.log(this.value)
                if (!this.value) {
                    $(this).css({"border": "red solid 1px"});
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
                        $('#formStore').submit();
                    })
                }
            })

        });

    </script>
@stop
