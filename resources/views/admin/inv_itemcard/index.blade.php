@extends('admin.layout.master')
@section('HomeName', 'ضبط المخازن')
@section('contentheder', ' الأصناف')
@section('contentheaderlink')
    <a href="{{ route('item_card.index') }}">الأصناف</a>
@endsection
@section('contenthedareactirv', 'عرض')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title card_title_center">بيانات الأصناف </h3>

                    {{-- search --}}
                    <input type="hidden" id="search_token" value="{{ csrf_token() }}">
                    <input type="hidden" id="ajax_search_url" value="{{ route('admin.itemcard.ajax_search') }}">
                    <a href="{{ route('item_card.create') }}" class="btn btn-sm btn-success">اضافة جديد</a>
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
                                    <th>الاسم </th>
                                    <th>النوع</th>
                                    <th>الفئة</th>
                                    <th>الصنف الاب</th>
                                    <th>الوحدة الاب</th>
                                    <th>الوحدة التجزئة</th>
                                    <th>حالة التفعيل</th>
                                    <th></th>
                                </thead>
                                <tbody>
                                    @foreach ($data as $info)
                                        <tr>
                                            <td>{{ $i }}</td>
                                            <td>{{ $info->name }}</td>
                                            <td>@if ($info->item_type == 1)مخزني @elseif ($info->item_type == 2) استهلاكي بصلاحية @elseif ($info->item_type == 3) عهدة @else غير محدد@endif</td>
                                            <td>{{ $info->inv_itemcard_categories_name  }}</td>
                                            <td>{{ $info->parent_inv_itemcard_name}}</td>
                                            <td>{{ $info->uom_name }}</td>
                                            <td>{{ $info->retail_uom_name  }}</td>
                                            <td>@if ($info->active == 1)مفعل @else معطل@endif</td>
                                            <td>
                                                <a href="{{ route('item_card.edit', $info->id) }}"
                                                    class="btn btn-sm btn-primary">تعديل</a>
                                                    <form class="d-inline" action="{{route('item_card.destroy',$info->id)}}" method="POST">
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
<script src="{{ asset('admin_assets/js/inv_itemcard.js')}}"></script>
@endsection
