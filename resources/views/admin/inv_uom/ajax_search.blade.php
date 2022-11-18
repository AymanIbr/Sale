@if (@isset($data) && !@empty($data))
@php
    $i = 1 ;
@endphp
<table id="example2" class="table table-bordered table-hover">
    {{-- الكلاس موجود في ملف الcss  --}}
    <thead class="custom_thead">
        <th>مسلسل</th>
        <th>اسم الوحدة</th>
        <th>نوع الوحدة</th>
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
                    @if ($info->is_master == 1)
                        وحدة أب
                    @else
                        تجزئة
                    @endif
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
                    <a href="{{ route('uoms.edit', $info->id) }}"
                        class="btn btn-sm btn-primary">تعديل</a>
                        <form class="d-inline" action="{{route('uoms.destroy',$info->id)}}" method="POST">
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
            <div class="col-md-12" id="ajax_pagination_in_search">
                {{ $data->links() }}
            </div>
            @else
                            <div class="alert alert-danger"> عفوا لا توجد بيانات لعرضها !!</div>

@endif
