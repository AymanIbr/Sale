<?php

namespace App\Http\Controllers;

use App\Http\Requests\Addtreasuries_deleveryRequset;
use App\Http\Requests\TreasuriesRequest;
use App\Models\Admin;
use App\Models\Treasuri;
use App\Models\treasuries_delivery;
use Exception;
use Illuminate\Http\Request;

class TreasuriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Treasuri::select()->orderby('id','DESC')->paginate(PAGINATING_COUNT);
        if(!empty($data)){
            foreach($data as $info) {
                $info->added_by_admin =Admin::where('id',$info->added_by)->value('name');
                if($info->updated_by > 0 and $info->updated_by !=null){
                    $info->updated_by_admin =Admin::where('id',$info->updated_by)->value('name');
                }
            }
        }
        return view('admin.treasuries.index',['data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.treasuries.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TreasuriesRequest $request)
    {

        try {

            $com_code = auth()->user()->com_code;
            // check if not exists
            $checkExists = Treasuri::where(['name' => $request->name, 'com_code' => $com_code])->first();
            if ($checkExists == null) {
                if ($request->is_master == 1) {
                    $checkExists_isMaster = Treasuri::where(['is_master' => 1, 'com_code' => $com_code])->first();

                    if ($checkExists_isMaster != null) {
                        return redirect()->back()->with(['error' => '!!عفواهناك خزنة رئيسية مسجلة من قبل لا يمكن ان يكون هناك اكثر من خزنة رئيسية'])->withInput();
                    }
                }


                $data['name'] = $request->name;
                $data['is_master'] = $request->is_master;
                $data['last_isal_exhcange'] = $request->last_isal_exhcange;
                $data['last_isal_collect'] = $request->last_isal_collect;
                $data['active'] = $request->active;
                $data['created_at'] = date('Y-m-d H:i:s');
                $data['added_by'] = auth()->user()->id;
                $data['com_code']  = $com_code;
                $data['date']= date('Y-m-d');
                Treasuri::create($data);
                return redirect()->route('treasuries.index')->with(['success' => 'لقد تم اضافة البيانات بنجاح']);
            } else {
                return redirect()->back()->with(['error' => 'عفوا اسم الخزنة مسجل من قبل '])->withInput();
            }
        } catch (\Exception $ex) {
            return redirect()->back()->with(['error' => 'عفوا حدث خطا ما!' . $ex->getMessage()])->withInput();
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Treasuri  $treasuri
     * @return \Illuminate\Http\Response
     */
    public function show(Treasuri $treasuri)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Treasuri  $treasuri
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Treasuri::select()->find($id);
        return response()->view('admin.treasuries.edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Treasuri  $treasuri
     * @return \Illuminate\Http\Response
     */
    public function update($id , TreasuriesRequest $request)
    {
        try{

            $com_code = auth()->user()->com_code ;
            $data = Treasuri::select()->find($id);
            if(empty($data)){
                return redirect()->route('treasuries.index')->with(['error'=>'عفوا غير قادر على الوصول للبيانات المطلوبة !!']);
            }

            // اسم الخزنة غير متكرر

            $cheeckExists = Treasuri::where(['name'=>$request->name,'com_code'=>$com_code])->where('id','!=',$id)->first();
            if($cheeckExists != null){
                return redirect()->back()
                ->with(['error'=>"عفوا اسم الخزنة مسجل من قبل !"])
                ->withInput();
            }

            // عدم تكرار الخزنة اذا كان هناك بالفعل رئيسية

            if($request->is_master == 1){
                $cheeckExists_isMaster = Treasuri::where(['is_master'=>1,'com_code'=>$com_code])->where('id','!=',$id)->first();
                if($cheeckExists_isMaster != null){
                    return redirect()->back()
                    ->with(['error'=>'عفوا هناك خزنة رئيسية بالفعل مسجلة من قبل لا يمكن ان يكون هناك اكثر من خزنة رئيسية'])
                    ->withInput();
                }
            }
             $data_to_update['name'] = $request->name;
             $data_to_update['active'] = $request->active;
             $data_to_update['is_master'] = $request->is_master;
             $data_to_update['last_isal_exhcange'] = $request->last_isal_exhcange;
             $data_to_update['last_isal_collect'] = $request->last_isal_collect;
             $data_to_update['updated_by'] = auth()->user()->id ;
             $data_to_update['updated_at'] = date("Y-m-d  H:i:s") ;
             Treasuri::where(['id'=>$id , 'com_code'=>$com_code])->update($data_to_update);

             return redirect()->route('treasuries.index')->with(['success'=>'لقد تم تحديث البيانات بنجاح']);

        }catch(\Exception $ex){
            return redirect()->back()
            ->with(['error'=>'عفوا حدث خطأ ما'])
            ->withInput();
        }

    }




    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Treasuri  $treasuri
     * @return \Illuminate\Http\Response
     */
    public function destroy(Treasuri $treasuri)
    {
        //
    }

       // Search

       public function ajax_search(Request $request){


        if($request->ajax()){
            $search_by_text = $request->search_by_text;
            $data = Treasuri::where('name','LIKE',"%{$search_by_text}%")->Orderby('id','DESC')->paginate(PAGINATING_COUNT);
            return view('admin.treasuries.ajax_search',['data'=>$data]);

        }

    }

    public function details($id){
        try{
            $com_code = auth()->user()->com_code;
            $data = Treasuri::select()->find($id);
            if(empty($data)){
                return redirect()->route('treasuries.index')->with(['error' => 'عفوا غير قادر على الوصول الى البياات المطلوبة !!']);
        }

      $data['added_by_admin'] = Admin::where('id', $data['added_by'])->value('name');

      if ($data['updated_by'] > 0 and $data['updated_by']!= null) {
          $data['updated_by_admin'] = Admin::where('id',  $data['updated_by'] )->value('name');
      }
        $treasuries_deliveries = treasuries_delivery::select()->where(['treasuries_id'=>$id])->Orderby('id','DESC')->get(); // treasuries_id هي الخزنة الاب
        if(!empty($treasury_delivery)){
            foreach($treasuries_deliveries as $info){
                $info->name = Treasuri::where(['id',$info->treasuries_can_delivery_id])->value('name');
                $info->added_by_admin = Admin::where(['id',$info->added_by])->value('name');
            }

        }


    return view('admin.treasuries.details',['data'=>$data , 'treasuries_deliveries'=> $treasuries_deliveries]);

        }catch(\Exception $ex){
        return redirect()->back()->with(['error' => 'عفوا حدث خطا ما!' . $ex->getMessage()]);

    }
}

    public function Add_treasuries_delivary($id){

        try{
            $com_code = auth()->user()->com_code;
            $data = Treasuri::select('id','name')->find($id);
            if(!empty($data)){
                return \redirect()->route('treasuries.index')->with(['error'=>'عذرا غير قادر على الوصول الى البيانات المطلوبة !']);
            }
            // كل الخزن الي بالجدول
            $Treasuri = Treasuri::select('id','name')->where(['com_code'=>$com_code,'active'=>1])->get();
            return \view('admin.treasuries.add_treasuries_delivery',['data'=>$data,'Treasuri'=>$Treasuri]);
        }catch(Exception $ex){
            return redirect()->back()
            ->with(['error'=>'عفوا حدث خطأ ما'.$ex->getMessage()]);
        }
    }


public function store_treasuries_delivery($id,Addtreasuries_deleveryRequset $request ){


    try{
        $com_code = auth()->user()->com_code ;
        $data = Treasuri::select('id','name')->find($id);
        if(empty($data)){
            return redirect()->route('treasuries.index')->with(['error' => 'عفوا غير قادر على الوصول الى البيانات المطلوبة !!']);
    }
    $checkExists = treasuries_delivery::where(['treasuries_id'=>$id,'treasuries_can_delivery_id '=>$request->treasuries_can_delivery_id,'com_code'=>$com_code])->first();
    if( $checkExists!=null){
        return redirect()->back()->with(['error'=>'عفوا هذه الخزنة مسجلة من قبل!'])->withInput();
    }

    $data_insert_details['treasuries_id'] = $id;
    $data_insert_details['treasuries_can_delivery_id'] = $request->treasuries_can_delivery_id;
    $data_insert_details['created_at'] = date('Y-m-d H:i:s');
    $data_insert_details['added_by'] = auth()->user()->id;
    $data_insert_details['com_code'] = $com_code;
    treasuries_delivery::create($data_insert_details);

   return redirect()->route('admin.treasuries.details',$id)->with(['success'=>'تم اضافة البيانات بنجاح']);



    }catch(\Exception $ex){
        return redirect()->back()->with(['error' => 'عفوا حدث خطا ما!' . $ex->getMessage()]);

    }
}
 public function delete_treasuries_delivery($id){
    try{
        $treasuries_delivery = treasuries_delivery::find($id);
        if(!empty($treasuries_delivery)){
            $flag =  $treasuries_delivery->delete();
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
