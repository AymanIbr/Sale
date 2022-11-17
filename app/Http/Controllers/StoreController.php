<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRequest;
use App\Models\Admin;
use App\Models\Store;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Store::select()->orderby('id','DESC')->paginate(PAGINATING_COUNT);
        if(!empty($data)){
            foreach($data as $info) {
                $info->added_by_admin =Admin::where('id',$info->added_by)->value('name');
                if($info->updated_by > 0 and $info->updated_by !=null){
                    $info->updated_by_admin =Admin::where('id',$info->updated_by)->value('name');
                }
            }
        }
        return view('admin.stores.index',['data'=>$data]);
    }
    public function create()
    {
        return \view('admin.stores.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        try {
            $com_code = auth()->user()->com_code;
            // check if not exists
            $checkExists = Store::where(['name' => $request->name, 'com_code' => $com_code])->first();
            if ($checkExists == null) {
                $data['name'] = $request->name;
                $data['phones'] = $request->name;
                $data['address'] = $request->name;
                $data['active'] = $request->active;
                $data['created_at'] = date('Y-m-d H:i:s');
                $data['added_by'] = auth()->user()->id;
                $data['com_code']  = $com_code;
                $data['date']= date('Y-m-d');
                Store::create($data);
                return redirect()->route('stores.index')->with(['success' => 'لقد تم اضافة البيانات بنجاح']);
            } else {
                // القيم الدخلة سابقا   withinput
                return redirect()->back()->with(['error' => 'عفوا اسم المخزن مسجل من قبل '])->withInput();
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
        $data = Store::select()->find($id);
        return response()->view('admin.stores.edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sales_material_type  $sales_material_type
     * @return \Illuminate\Http\Response
     */
    public function update($id , StoreRequest $request )
    {
        try{

            $com_code = auth()->user()->com_code ;
            $data = Store::select()->find($id);
            //نفحص اذا موجودة
            if(empty($data)){
                return redirect()->route('stores.index')->with(['error'=>'عفوا غير قادر على الوصول للبيانات المطلوبة !!']);
            }

            // اسم الخزنة غير متكرر

            $cheeckExists = Store::where(['name'=>$request->name,'com_code'=>$com_code])->where('id','!=',$id)->first();
            if($cheeckExists != null){
                return redirect()->back()
                ->with(['error'=>"عفوا اسم المخزن مسجل من قبل !"])
                ->withInput();
            }
             $data_to_update['name'] = $request->name;
             $data_to_update['phones'] = $request->name;
             $data_to_update['address'] = $request->name;
             $data_to_update['active'] = $request->active;
             $data_to_update['updated_by'] = auth()->user()->id ;
             $data_to_update['updated_at'] = date("Y-m-d  H:i:s") ;
             Store::where(['id'=>$id , 'com_code'=>$com_code])->update($data_to_update);

             return redirect()->route('stores.index')->with(['success'=>'لقد تم تحديث البيانات بنجاح']);

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
            $sales_material_type = Store::find($id);
            if(!empty($sales_material_type)){
                $flag =  $sales_material_type->delete();
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
}
