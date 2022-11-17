@extends('admin.layout.master')
@section('HomeName','تعديل المخازن')
@section('contentheder','المخازن')
@section('contentheaderlink')
<a href="{{ route('stores.index') }}">المخازن</a>
@endsection
@section('contenthedareactirv','تعديل')

@section('content')
<div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title card_title_center">تعديل بيانات المخزن</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            @if (@isset($data) && !@empty($data))
             <form action="{{ route('stores.update',$data->id) }}" method="POST" >
                @csrf
                @method('put')
                <div class="form-group">
                    <label> اسم المخزن الفواتير</label>
                    <input name="name" id="name" class="form-control" value="{{ old('name',$data['name']) }}" placeholder="ادخل اسم الخونة" >
                    @error('name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label> هاتف المخزن </label>
                    <input name="phones" id="phones" class="form-control" value="{{ old('phones',$data['phones']) }}" placeholder="ادخل اسم الخونة" >
                    @error('phones')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label> عنوان المخزن </label>
                    <input name="address" id="address" class="form-control" value="{{ old('address',$data['address']) }}" placeholder="ادخل عنوان الخونة" >
                    @error('address')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
               <div class="form-group">
                    <label>حالة التفعيل</label>
                    <select name="active" value = '{{ old('active') }}' id="active" class="form-control">
                        <option value="">اختر النوع</option>
                        <option @if (old('active')==1) selected="selected" @endif value="1">نعم</option>
                        <option @if (old('active')==0) selected="selected" @endif value="0">لا</option>
                    </select>
                    @error('active')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group text-center">
                    <button type="buttom" class="btn btn-primary btn-sm">حفظ التعديلات</button>
                    <a href="{{ route('stores.index') }}" class="btn btn-sm btn-danger">الغاء</a>
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

