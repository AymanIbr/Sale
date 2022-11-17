@extends('admin.layout.master')
@section('HomeName', 'الضبط العام')
@section('contentheder', ' المخازن')
@section('contentheaderlink')
    <a href="{{ route('stores.index') }}">المخازن</a>
@endsection
@section('contenthedareactirv', 'عرض')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title card_title_center">بيانات المخازن </h3>

                    {{-- search --}}
                    <input type="hidden" id="search_token" value="{{ csrf_token() }}">
                    <input type="hidden" id="ajax_search_url" value="{{ route('admin.treasuries.ajax_search') }}">
                    <a href="{{ route('stores.create') }}" class="btn btn-sm btn-success">اضافة جديد</a>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div id="ajax_responce_searchDiv">
                        @if (@isset($data) && !@empty($data))
                            @php
                                $i = 1;
                            @endphp
                            <table id="example2" class="table table-bordered table-hover">
                                {{-- الكلاس موجود في ملف الcss  --}}
                                <thead class="custom_thead">
                                    <th>مسلسل</th>
                                    <th>اسم المخزن</th>
                                    <th>الهاتف</th>
                                    <th>العنوان</th>
                                    <th>حالة التفعيل</th>
                                    <th> تاريخ الاضافة </th>
                                    <th>تاريخ التحديث</th>
                                    <th></th>
                                </thead>
                                <tbody>
                                    @foreach ($data as $info)
                                        <tr>
                                            <td>{{ $i }}</td>
                                            <td>
                                                {{ $info->name }}
                                            </td>
                                                <td>
                                                    {{ $info->phones }}
                                                </td>
                                                    <td>
                                                        {{ $info->address }}
                                                    </td>
                                                    <td>
                                                @if ($info->active == 1)
                                                    مفعل
                                                @else
                                                    معطل
                                                @endif
                                            </td>
                                            <td>

                                                @php
                                                    $dt = New DateTime($info->created_at);
                                                    $date = $dt->format("Y-m-d");
                                                    $time = $dt->format("h:i");
                                                    $newDateTime = date("A",strtotime($time));
                                                    $newDateTimeType = (($newDateTime=='AM')? 'صباحا': 'مساءا');
                                                @endphp

                                                {{ $date }} <br>
                                                {{ $time }}
                                                {{ $newDateTimeType }} <br>
                                                بواسطة
                                                {{$info->added_by_admin}}

                                            </td>
                                            <td> @if($info->updated_by > 0 and $info->updated_by !=null)

                                                @php
                                                    $dt = New DateTime($info->updated_at);
                                                    $date = $dt->format("Y-m-d");
                                                    $time = $dt->format("h:i");
                                                    $newDateTime = date("A",strtotime($time));
                                                    $newDateTimeType = (($newDateTime=='AM')? 'صباحا': 'مساءا');
                                                @endphp

                                                {{ $date }}  <br>
                                                {{ $time }}
                                                {{ $newDateTimeType }} <br>
                                                بواسطة
                                                {{$info->updated_by_admin}}

                                             @else
                                             لا يوجد تحديث

                                             @endif

                                            </td>
                                            <td>
                                                <a href="{{ route('stores.edit', $info->id) }}"
                                                    class="btn btn-sm btn-primary">تعديل</a>
                                                    <form class="d-inline" action="{{route('stores.destroy',$info->id)}}" method="POST">
                                                        @csrf
                                                        @method('delete')
                                                        <button onclick="return confirm ('are you sure ?') " class="btn btn-danger btn-sm">حذف</button>
                                                    </form>

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
    <script src="{{ asset('admin_assets/js/treasuries.js') }}"></script>
@endsection
