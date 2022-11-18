<?php

namespace App\Http\Controllers;

use App\Http\Requests\InvUomRequest;
use App\Models\Admin;
use App\Models\Inv_uoms;
use Illuminate\Http\Request;

class InvUomsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Inv_uoms::select()->orderby('id','DESC')->paginate(PAGINATING_COUNT);
        if(!empty($data)){
            foreach($data as $info) {
                $info->added_by_admin =Admin::where('id',$info->added_by)->value('name');
                if($info->updated_by > 0 and $info->updated_by !=null){
                    $info->updated_by_admin =Admin::where('id',$info->updated_by)->value('name');
                }
            }
        }
        return view('admin.inv_uom.index',['data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return \view('admin.inv_uom.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(InvUomRequest $request)
    {
        try {
            $com_code = auth()->user()->com_code;
            // check if not exists
            $checkExists = Inv_uoms::where(['name' => $request->name, 'com_code' => $com_code])->first();
            if ($checkExists == null) {
                $data['name'] = $request->name;
                $data['is_master'] = $request->is_master;
                $data['active'] = $request->active;
                $data['created_at'] = date('Y-m-d H:i:s');
                $data['added_by'] = auth()->user()->id;
                $data['com_code']  = $com_code;
                $data['date']= date('Y-m-d');
                Inv_uoms::create($data);
                return redirect()->route('uoms.index')->with(['success' => 'لقد تم اضافة البيانات بنجاح']);
            } else {
                // القيم الدخلة سابقا   withinput
                return redirect()->back()->with(['error' => 'عفوا اسم الوحدة مسجل من قبل '])->withInput();
            }
        } catch (\Exception $ex) {
            return redirect()->back()->with(['error' => 'عفوا حدث خطا ما!' . $ex->getMessage()])->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sales_material_type  $sales_material_type
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sales_material_type  $sales_material_type
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Inv_uoms::select()->find($id);
        return view('admin.inv_uom.edit',['data'=>$data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sales_material_type  $sales_material_type
     * @return \Illuminate\Http\Response
     */
    public function update($id , InvUomRequest $request )
    {
        try{
            $com_code = auth()->user()->com_code ;
            $data = Inv_uoms::select()->find($id);
            //نفحص اذا موجودة
            if(empty($data)){
                return redirect()->route('uoms.index')->with(['error'=>'عفوا غير قادر على الوصول للبيانات المطلوبة !!']);
            }
            // اسم الخزنة غير متكرر
            $cheeckExists = Inv_uoms::where(['name'=>$request->name,'com_code'=>$com_code])->where('id','!=',$id)->first();
            if($cheeckExists != null){
                return redirect()->back()
                ->with(['error'=>"عفوا اسم الوحدة مسجل من قبل !"])
                ->withInput();
            }
             $data_to_update['name'] = $request->name;
             $data_to_update['is_master'] = $request->is_master;
             $data_to_update['active'] = $request->active;
             $data_to_update['updated_by'] = auth()->user()->id ;
             $data_to_update['updated_at'] = date("Y-m-d  H:i:s") ;
             Inv_uoms::where(['id'=>$id , 'com_code'=>$com_code])->update($data_to_update);

             return redirect()->route('uoms.index')->with(['success'=>'لقد تم تحديث البيانات بنجاح']);

        }catch(\Exception $ex){
            return redirect()->back()
            ->with(['error'=>'عفوا حدث خطأ ما'])
            ->withInput();
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sales_material_type  $sales_material_type
     * @return \Illuminate\Http\Response
     */
    public function destroy ($id){
        try{
            $Inv_uoms = Inv_uoms::find($id);
            if(!empty($Inv_uoms)){
                $flag =  $Inv_uoms->delete();
                if($flag){
                    return redirect()->back()->with(['success'=>'تم حذف البيانات بنجاح']);
                }else{
                    return redirect()->back()->with(['error'=>'عفوا حدث خطأ ما' ]);
                }
            }else{
                return redirect()->back()->with(['error'=>'غير قادر على الوصول الى البيانات النطلوبة']);
            }
        }catch(\Exception $ex){
            return redirect()->back()->with(['error' => 'عفوا حدث خطا ما!' . $ex->getMessage()]);

        }
     }


 public function ajax_search(Request $request){
    if($request->ajax()){
        $search_by_text = $request->search_by_text;
        $is_master_search = $request->is_master_search;
        if($search_by_text ==''){
            $field1 = "id" ;
            $operator1 = ">";
            $value1 = 0;
          }else{
            $field1 = "name";
            $operator1 = "LIKE";
            $value1 = "%{$search_by_text}%";
          }

      if($is_master_search =='all'){
        $field2= "id" ;
        $operator2 = ">";
        $value2 = 0;
      }else{
        $field2 = "is_master";
        $operator2= "=";
        $value2 = $is_master_search;
      }

        $data = Inv_uoms::where($field1,$operator1,$value1)->where($field2,$operator2,$value2)->Orderby('id','DESC')->paginate(\PAGINATING_COUNT);
        if (!empty($data)) {
            foreach($data as $info) {
                $info->added_by_admin =Admin::where('id',$info->added_by)->value('name');
                if($info->updated_by > 0 and $info->updated_by !=null){
                    $info->updated_by_admin =Admin::where('id',$info->updated_by)->value('name');
                }
            }
        }
        return view('admin.inv_uom.ajax_search',['data'=>$data]);

    }

}
}
