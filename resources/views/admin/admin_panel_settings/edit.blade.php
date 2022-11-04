@extends('admin.layout.master')
@section('HomeName','تعديل الضبط العام')
@section('contentheder','الضبط')
@section('contentheaderlink')
<a href="{{ route('admin.adminPanelSetting.index') }}">الضبط</a>
@endsection
@section('contenthedareactirv','تعديل')

@section('content')
<div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title card_title_center">تعديل بيانات الضبط العام</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            @if (@isset($data) && !@empty($data))
             <form action="{{ route('admin.adminPanelSetting.update',$data->id) }}" method="post" enctype="multipart/form-data" >
                @csrf
                <div class="form-group">
                    <label> اسم الشركة</label>
                    <input name="system_name" id="system_name" class="form-control" value="{{ $data->system_name }}" placeholder="ادخل اسم الشركة" >
                    @error('system_name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label> عنوان الشركة</label>
                    <input name="address" id="address" class="form-control" value="{{ $data->address }}" placeholder="ادخل اسم الشركة" >
                    @error('address')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                </div>
                <div class="form-group">
                    <label> هاتف الشركة</label>
                    <input name="phone" id="phone" class="form-control" value="{{ $data->phone }}" placeholder="ادخل اسم الشركة" >
                    @error('phone')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                </div>
                <div class="form-group">
                    <label>رسالة تنبيه اعلى االشاشة</label>
                    <input name="general_alert" id="general_alert" class="form-control" value="{{ $data->general_alert }}" placeholder="ادخل اسم الشركة" >
                    @error('general_alert')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                </div>
                <div class="form-group">
                    <label>  شعار الشركة </label>
                    <div class="image">
                        <img class="custom_img" src="{{ asset('admin_assets/uploads').'/'. $data['photo'] }}" alt=" لوجو الشركة">
                        <button type="button" class="btn btn-sm btn-danger" id="update_image">تغيير الصورة</button>
                        <button type="button"class="btn btn-sm btn-danger" style="display: none" id="cancle_update_image">الغاء </button>
                    </div>
                    <div id="oldimage">

                    </div>
                </div>
                <div class="form-group text-center">
                    <button type="buttom" class="btn btn-primary btn-sm">حفظ التعديلات</button>
                </div>
            </form>
            @else
            <div class="alert alert-danger">
                عفوا لا توجد بيانات لعرضها
            </div>
            @endif
        </div>
        <!-- /.card-body -->
      </div>
    </div>
    <!-- /.col -->
  </div>

@endsection

