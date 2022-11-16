@extends('admin.layout.master')
@section('HomeName','الضبط العام')
@section('contentheder','الخزن')
@section('contentheaderlink')
<a href="{{ route('treasuries.index') }}">الخزن</a>
@endsection
@section('contenthedareactirv','عرض')

@section('content')
<div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title card_title_center">بيانات الخزن </h3>

                  {{-- search --}}
                  <input type="hidden" id="search_token" value="{{csrf_token()}}">
                    <input type="hidden" id="ajax_search_url" value="{{route('admin.treasuries.ajax_search')}}">
              <a href="{{ route('treasuries.create') }}" class="btn btn-sm btn-success">اضافة جديد</a>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <div class="col-md-4">
                <input type="text" id= "search_by_text" class="form-control" placeholder="بحث بالاسم"> <br>
            </div>

            <div id="ajax_responce_searchDiv">
                @if (@isset($data) && !@empty($data))
                @php
                $i = 1 ;
            @endphp
                <table id="example2" class="table table-bordered table-hover">
                    {{-- الكلاس موجود في ملف الcss  --}}
                    <thead class="custom_thead">
                        <th>مسلسل</th>
                        <th>اسم الخزنة</th>
                        <th>هل رئيسية</th>
                        <th>اخر ايصال صرف</th>
                        <th>حالة التفعيل</th>
                        <th>اخر ايصال تحصيل</th>
                        <th></th>
                        {{-- <th>تاريخ الاضافة</th>
                        <th>تاريخ التحديث</th> --}}
                    </thead>
                    <tbody>
                        @foreach ($data as $info )
                        <tr>
                            <td>{{ $i }}</td>
                            <td>
                                {{ $info->name }}
                            </td>
                            <td>
                                @if ($info->is_master == 1)
                                رئيسية
                                @else
                                فرعية
                                @endif
                            </td>
                            <td>
                                {{ $info->last_isal_exhcange }}
                            </td>
                            <td>
                                @if ($info->active == 1) مفعل @else معطل @endif
                            </td>
                            <td>
                                {{ $info->last_isal_collect }}
                            </td>
                            <td>
                                <a href = "{{ route('treasuries.edit',$info->id) }}" class="btn btn-sm btn-primary">تعديل</a>
                                <a href="{{ route('admin.treasuries.details',$info->id) }}"  class="btn btn-sm btn-info">المزيد</a>
                            </td>
                        </tr>
                        @php
                            $i++;
                        @endphp
                        @endforeach
                    </tbody>
                          </table>

                         <br>
                        {{ $data->links() }}
                        @else
                        <div class="alert alert-danger"> عفوا لا توجد بيانات لعرضها !!</div>
                       @endif
                    </div>

        </div>
        <!-- /.card-body -->
      </div>
    </div>
    <!-- /.col -->
  </div>

@endsection
@section('script')
<script src="{{ asset('admin_assets/js/treasuries.js')}}"></script>
@endsection
