@extends('admin.layout.master')
@section('HomeName', 'اضاقة صنف')
@section('contentheder', ' الأصناف')
@section('contentheaderlink')
    <a href="{{ route('item_card.index') }}">الأصناف</a>
@endsection
@section('contenthedareactirv', 'اضافة')

@section('content')

    <div class="card">
        <div class="card-header">
            <h3 class="card-title card_title_center"> اضافة صنف جديد</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <form action="{{ route('item_card.store') }}" method="post" enctype="multipart/form-data">
                <div class="row">
                    @csrf
                    <div class="col-md-6">
                        <div class="form-group">
                            <label> بار كود الصنف في - حالة عدم الادخال سيولد بشكل الي </label>
                            <input name="barcode" id="name" class="form-control" value="{{ old('barcode') }}"
                                placeholder="ادخل كود الصنف">
                            @error('barcode')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>اسم الصنف </label>
                            <input name="name" id="name" class="form-control" value="{{ old('name') }}"
                                placeholder="ادخل اسم الصنف">
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>نوع الصنف</label>
                            <select name="item_type" value='{{ old('item_type') }}' id="item_type" class="form-control">
                                <option value="">اختر النوع</option>
                                <option @if (old('item_type') == 1) selected="selected" @endif value="1">مخزني
                                </option>
                                <option @if (old('item_type') == 2) selected="selected" @endif value="2">استهلاكي
                                    بتاريخ صلاحية</option>
                                <option @if (old('item_type') == 3) selected="selected" @endif value="3">عهدة
                                </option>
                            </select>
                            @error('item_type')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>فئة الصنف</label>
                            <select name="inv_itemcard_categories_id " id="inv_itemcard_categories_id "
                                class="form-control">
                                <option value="">اختر الفئة</option>
                                @if (@isset($inv_itemcard_categories) && !@empty($inv_itemcard_categories))
                                    @foreach ($inv_itemcard_categories as $info)
                                        <option @if (old('inv_itemcard_categories_id') == $info->id) selelected = "selected" @endif
                                            value="{{ $info->id }}">{{ $info->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                            @error('inv_itemcard_categories_id ')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>


                    <div class="col-md-6">
                        <div class="form-group">
                            <label>وحدة القياس الأب </label>
                            <select name="uom_id" id="uom_id" class="form-control">
                                <option value="">اختر الوحدة الأب</option>
                                @if (@isset($inv_uoms_parent) && !@empty($inv_uoms_parent))
                                    @foreach ($inv_uoms_parent as $info)
                                        <option @if (old('uom_id') == $info->id) selelected = "selected" @endif
                                            value="{{ $info->id }}">{{ $info->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                            @error('uom_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>


                    <div class="col-md-6">
                        <div class="form-group">
                            <label> هل للصنف وحدة تجزئة ابن</label>
                            <select name="does_has_retailunit" id="does_has_retailunit" class="form-control">
                                <option value="">اختر الحالة</option>
                                <option @if (old('does_has_retailunit') == 1) selected = "selected" @endif value="1"> نعم
                                </option>
                                <option @if (old('does_has_retailunit') == 0 and old('does_has_retailunit') != '') selected = "selected" @endif value="0"> لا
                                </option>
                            </select>
                            @error('does_has_retailunit')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6 related_retail_conter " style="display: none;">
                        <div class="form-group">
                            <label> وحدة قياس التجزئة الابن بالنسبة للأب (<span class="parentuomname" ></span>)</label>
                            <select name="retail_uom_id" id="retail_uom_id" class="form-control">
                                <option value="">اختر وحدة القياس التجزئة الأبن</option>
                                @if (@isset($inv_uoms_child) && !@empty($inv_uoms_child))
                                    @foreach ($inv_uoms_child as $info)
                                        <option @if (old('retail_uom_id') == $info->id) selected = "selected" @endif
                                            value="{{ $info->id }}">{{ $info->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                            @error('retail_uom_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6 related_retail_conter " style="display: none;">
                        <div class="form-group">
                            <label>عدد وحدات التجزئة بالنسبة للأب (<span class="parentuomname" ></span>) </label>
                            {{-- لاجباره ان يدخل رقم فقط --}}
                            <input oninput="this.value = this.value.replace(/[^0-9.]/g,'');"
                                value="{{ old('retail_uom_quntToParent') }}" name="retail_uom_quntToParent" id="retail_uom_quntToParent"
                                class="form-control" placeholder="ادخل عدد وحدات التجزئة ">
                            @error('retail_uom_quntToParent')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>


                    <div class="col-md-6">
                        <div class="form-group">
                            <label>حالة التفعيل</label>
                            <select name="active" value='{{ old('active') }}' id="active" class="form-control">
                                <option value="">اختر النوع</option>
                                <option @if (old('active') == 1) selected="selected" @endif value="1">نعم
                                </option>
                                <option @if (old('active') == 0) selected="selected" @endif value="0">لا
                                </option>
                            </select>
                            @error('active')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6" style="border:solid 5px #000 ; margin:10px;">
                        <div class="form-group">
                            <label>صورة الصنف ان وجدت</label>
                            <img id="uploadedimg" src="#" alt="uploaded img" style="width: 200px ,width:200px">
                            <input onchange="readURL(this)" type="file" id="Item_img" name="Item_img" class="form-control">
                            @error('active')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group text-center">
                            <button type="buttom" class="btn btn-primary btn-sm"> اضافة</button>
                            <a href="{{ route('item_card.index') }}" class="btn btn-sm btn-danger">الغاء</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <!-- /.card-body -->
    </div>

@endsection

<script type="text/javascript">
    function readURL(input){
        if(input.files && input.files[0]){
            var reader = new FileReader();
            reader.onload = function(e){
                $('#uploadedimg').attr('src',e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>

@section('script')
    <script src="{{ asset('admin_assets/js/inv_itemcard.js') }}"></script>
@endsection
