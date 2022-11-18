@extends('admin.layout.master')
@section('HomeName', 'الوحدات')
@section('contentheder', ' الوحدات')
@section('contentheaderlink')
    <a href="{{ route('uoms.edit',$data->id) }}">الوحدات</a>
@endsection
@section('contenthedareactirv', 'تعديل')

@section('content')
<div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title card_title_center">تعديل بيانات وحدات قياس للأصناف </h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            @if (@isset($data) && !@empty($data))
             <form action="{{ route('uoms.update',$data->id) }}" method="POST" >
                @csrf
                @method('put')
                <div class="form-group">
                    <label> اسم الوحدة </label>
                    <input name="name" id="name" class="form-control" value="{{ old('name',$data['name']) }}" placeholder="ادخل اسم الخونة" >
                    @error('name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label>نوع الوحدة </label>
                    <select name="is_master" value = '{{ old('is_master') }}' id="is_master" class="form-control">
                        <option value="">اختر النوع</option>
                        <option @if (old('is_master')==1) selected="selected" @endif value="1">وحدة أب</option>
                        <option @if (old('is_master')==0) selected="selected" @endif value="0">وحدة تجزئة</option>
                    </select>
                    @error('is_master')
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
                    <a href="{{ route('uoms.index') }}" class="btn btn-sm btn-danger">الغاء</a>
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

