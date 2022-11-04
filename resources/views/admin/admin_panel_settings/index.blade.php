@extends('admin.layout.master')
@section('HomeName','الضبط العام')
@section('contentheder','الضبط')
@section('contentheaderlink')
<a href="{{ route('admin.adminPanelSetting.index') }}">الضبط</a>
@endsection
@section('contenthedareactirv','عرض')

@section('content')
<div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title card_title_center">بيانات الضبط العام</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            @if (@isset($data) && !@empty($data))
            <table id="example2" class="table table-bordered table-hover">
                <tr>
                  <th class="width30">اسم الشركة</th>
                  <td>{{ $data['system_name']}}</td>
                </tr>
                <tr>
                    <th class="width30">كود الشركة</th>
                    <td >{{ $data['com_code'] }}</td>
                  </tr>
                  <tr>
                    <th class="width30">حالة الشركة</th>
                    <td >@if ($data['active'] == 1) مفعل @else معطل @endif</td>
                  </tr>
                  <tr>
                    <th class="width30">عنوان الشركة</th>
                    <td >{{ $data['address'] }}</td>
                  </tr>
                  <tr>
                    <th class="width30">هاتف الشركة</th>
                    <td >{{ $data['phone'] }}</td>
                  </tr>
                  <tr>
                    <th class="width30">رسالة تنبيه أعلى الشاشة للشركة</th>
                    <td >{{ $data['general_alert'] }}</td>
                  </tr>
                  <tr>
                    <th class="width30">شعار الشركة</th>
                    <td >
                        <div class="image">
                            <img class="custom_img" src="{{ asset('admin_assets/uploads').'/'. $data['photo'] }}"alt="">
                        </div>
                    </td>
                  </tr>
                  <tr>
                    <th class="width30">تاريخ اخر تحديث</th>
                    <td >
                        @if ($data['updated_by']>0 and $data['updated_by'] != null)
                        @php
                            $dt = new DateTime($data['updated_at']);
                            $date = $dt->format("Y-m-d");
                            $time = $dt->format("h:i");
                            $newDateTime = date("A",strtotime($time));
                            $newDateTimeType = (($newDateTime == 'Am') ? 'صباحا' : 'مساء');
                        @endphp
                        {{ $date }}
                        {{ $time }}
                        {{ $newDateTimeType }}
                        بواسطة
                        {{ $data['updated_by_admin'] }}
                        @else
                        لا يوجد تحديث
                        @endif
                        <a href="{{ route('admin.adminPanelSetting.edit',$data->id) }}" class="btn btn-sm btn-success">تعديل</a>
                    </td>
                  </tr>
                      </table>
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

