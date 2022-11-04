@extends('admin.layout.master')
@section('HomeName','  اضافة خزنة جديدة')
@section('contentheder','الخزن')
@section('contentheaderlink')
<a href="{{ route('treasuries.index') }}">الخزن</a>
@endsection
@section('contenthedareactirv','اضافة')

@section('content')
<div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title card_title_center"> اضافة خزنة جديدة</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
             <form action="{{ route('treasuries.store') }}" method="post"  >
                @csrf
                <div class="form-group">
                    <label> اسم الخزنة</label>
                    <input name="name" id="name" class="form-control" value="{{old('name')}}" placeholder="ادخل اسم الخونة" >
                    @error('name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label> هل رئيسية</label>
                    <select name="is_master" id="is_master" class="form-control">
                        <option value="">اختر النوع</option>
                        <option @if (old('is_master')==1) selected="selected" @endif value="1">رئيسية</option>
                        <option @if (old('is_master')==2) selected="selected" @endif value="2">فرعية</option>
                    </select>
                    @error('is_master')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label>اخر رقم ايصال صرف نقدية لهذه الخزنة</label>
                    {{-- لاجباره ان يدخل رقم فقط --}}
                    <input oninput="this.value = this.value.replace(/[^0-9]/g,'');" value="{{ old('last_isal_exhcange') }}" name="last_isal_exhcange" id="last_isal_exhcange" class="form-control" placeholder="ادخل اسم الخونة" >
                    @error('last_isal_exhcange')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label>اخر رقم ايصال تحصيل نقدية لهذه الخزنة</label>
                    <input  oninput="this.value = this.value.replace(/[^0-9]/g,'');" value="{{ old('last_isal_collect') }}" name="last_isal_collect" id="last_isal_collect" class="form-control" placeholder="ادخل اسم الخونة" >
                    @error('last_isal_collect')
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
                    <a href="{{ route('treasuries.index') }}" class="btn btn-sm btn-danger">الغاء</a>
                </div>
            </form>
        </div>
        <!-- /.card-body -->
      </div>
    </div>
    <!-- /.col -->
  </div>

@endsection

