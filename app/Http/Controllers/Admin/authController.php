<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\Admin;
use Illuminate\Http\Request;

class authController extends Controller
{
    public function ShowLogin(){
        return response()->view('admin.auth.login');
    }

    //  LoginRequest    الفاليديشن الخاصة بهذه الميثود
    public function login(LoginRequest $request){
        if(auth()->guard('admin')->attempt(['username'=>$request->input('username'),'password'=>$request->input('password')])){
            return redirect()->route('admin.dashboard');
        }
    }

    public function logout(){
        auth()->logout();
        return redirect()->route('show.login');
    }

    // انشاء ادمن بدل ما نقوم بوضعه في الداتابيز بشكل يدوي
    // php artisan tinker       لكي اعمل فيها هذا الكود ناخدهم سطر سطر
    function make_new_admin(){
        $admin = new Admin();
        $admin->name = 'admin';
        $admin->email = 'test@gmail.com';
        $admin->username = 'admin';
        $admin->password = bcrypt("admin");
        $admin->come_code = 1 ;
        $admin->save();

    }

}
