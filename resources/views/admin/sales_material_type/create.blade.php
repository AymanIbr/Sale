@extends('admin.layout.master')
@section('HomeName','  اضافة فئة جديدة')
@section('contentheder','فئات الفواتير')
@section('contentheaderlink')
<a href="{{ route('sales_material_types.index') }}">فئات الفواتير</a>
@endsection
@section('contenthedareactirv','اضافة')

@section('content')
<div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title card_title_center"> اضافة فئة فواتير جديدة</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
             <form action="{{ route('sales_material_types.store') }}" method="post"  >
                @csrf
                <div class="form-group">
                    <label> اسم فئة الفواتير</label>
                    <input name="name" id="name" class="form-control" value="{{old('name')}}" placeholder="ادخل اسم الخونة" >
                    @error('name')
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
                    <button type="buttom" class="btn btn-primary btn-sm"> اضافة</button>
                    <a href="{{ route('sales_material_types.index') }}" class="btn btn-sm btn-danger">الغاء</a>
                </div>
            </form>
        </div>
        <!-- /.card-body -->
      </div>
    </div>
    <!-- /.col -->
  </div>

@endsection

