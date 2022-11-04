<?php

namespace App\Http\Controllers;

use App\Http\Requests\TreasuriesRequest;
use App\Models\Admin;
use App\Models\Treasuri;
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
        try{
            $com_code = auth()->user()->com_code ;
            //check if not exsits
            $cheeckExists = Treasuri::where(['name'=>$request->name,'com_code'=>$com_code])->first();
            if($cheeckExists==null){
                if($request->is_master == 1 ){
                    $cheeckExists_isMaster = Treasuri::where(['is_master'=>1,'com_code'=>$com_code])->first();
                    if($cheeckExists_isMaster != null){
                        return redirect()->back()
                        ->with(['error'=>'عفوا هناك خزنة رئيسية بالفعل مسجلة من قبل لا يمكن ان يكون هناك اكثر من خزنة رئيسية'])
                        ->withInput();                    }
                }

                $data['name'] = $request->name ;
                $data['is_master'] = $request->is_master ;
                $data['last_isal_exhcange'] = $request->last_isal_exhcange ;
                $data['last_isal_collect'] = $request->last_isal_collect ;
                $data['active'] = $request->active ;
                $data['created_at'] = date("Y-m-d H:i:s") ;
                $data['added_by'] = auth()->user()->id;
                $data['com_code'] = $com_code ;
                $data['date'] = date('Y-m-d') ;
                Treasuri::create($data);

                return redirect()->route('treasuries.index')->with(['success'=>'لقد تم اضافة البيانات بنجاح']);




            }else{
                return redirect()->back->with(['error'=>'عفوا اسم الخزنة مخزن من قبل'])->withInput();
            }
        }catch(\Exception $ex){
            return redirect()->route('treasuries.create')->with(['error'=>'حدث خطأ ما']);
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
}
