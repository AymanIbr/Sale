<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin_panel_settings_Request;
use App\Models\Admin;
use App\Models\admin_panel_setting;
use Exception;

class Admin_pnel_settingsController extends Controller
{
    public function index(){
        $data = Admin_panel_setting::where('com_code',auth()->user()->com_code)->first();
        if(!empty($data)){
            if($data['updated_by'] > 0 and $data['updated_by']!=null){
                $data['updated_by_admin'] =Admin::where('id',$data['updated_by'])->value('name');
            }
        }

        return view('admin.admin_panel_settings.index',['data'=>$data]);
    }

    public function edit(){
        $data = Admin_panel_setting::where('com_code',auth()->user()->com_code)->first();
        return view('admin.admin_panel_settings.edit',['data'=>$data]);
    }

    public function update(Admin_panel_settings_Request $request){
        try{
            $admin_panel_setting = Admin_panel_setting::where('com_code',auth()->user()->com_code)->first();
            $admin_panel_setting->system_name = $request->input('system_name');
            $admin_panel_setting->address = $request->input('address');
            $admin_panel_setting->phone = $request->input('phone');
            $admin_panel_setting->general_alert = $request->input('general_alert');
            $admin_panel_setting->updated_by = auth()->user()->id;
            $old_image=$admin_panel_setting->photo;
            if($request->has('photo')){
                $request->validate([
                    'photo'=>['required','mimes:png,jpg,jpeg','max:2000']
                ]);
                $file_path = uploadImage('admin_assets/uploads',$request->photo);
                $admin_panel_setting->photo = $file_path ;
                if(file_exists('admin_assets/uploads/'.$old_image)and !empty($old_image)){
                    unlink('admin_assets/uploads/'.$old_image);
                }
            }
            $admin_panel_setting->save();
            return redirect()->route('admin.adminPanelSetting.index')->with(['success'=>'تم تحديث البيانات بنجاح']);
        }catch(Exception $ex){
            return redirect()->route('admin.adminPanelSetting.index')->with(['error'=>'عفوا حدث خطأ ما'.$ex->getMessage()]);
        }
    }
}
