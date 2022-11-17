<?php

use App\Http\Controllers\Admin\Admin_pnel_settingsController;
use App\Http\Controllers\Admin\authController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\SalesMaterialTypeController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\TreasuriController;
use App\Models\Sales_material_type;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('admin.auth.login');
// });




define('PAGINATING_COUNT',6);

Route::prefix('sales/admin/')->middleware('guest:admin')->namespace('Admin')->group(function(){

    Route::get('login',[authController::class , 'ShowLogin'])->name('show.login');
    Route::post('login',[authController::class , 'login'])->name('admin.login');
});

Route::prefix('sales/admin')->middleware('auth:admin')->group(function(){

    Route::get('/',[DashboardController::class , 'index'])->name('admin.dashboard');

    Route::get('/adminpanelsetting/index',[Admin_pnel_settingsController::class , 'index'])->name('admin.adminPanelSetting.index');
    Route::get('/adminpanelsetting/edit',[Admin_pnel_settingsController::class , 'edit'])->name('admin.adminPanelSetting.edit');
    Route::post('/adminpanelsetting/update',[Admin_pnel_settingsController::class , 'update'])->name('admin.adminPanelSetting.update');

    Route::resource('treasuries',TreasuriController::class);
    // search
    Route::post('/treasuries/ajax_search',[TreasuriController::class,'ajax_search'])->name('admin.treasuries.ajax_search');
    Route::get('/treasuries/details/{id}',[TreasuriController::class,'details'])->name('admin.treasuries.details');
    Route::get('/treasuries/Add_treasuries_delivary/{id}',[TreasuriController::class,'Add_treasuries_delivary'])->name('admin.treasuries.Add_treasuries_delivary');
    Route::post('/treasuries/store_treasuries_delivery/{id}',[TreasuriController::class,'store_treasuries_delivery'])->name('admin.treasuries.store_treasuries_delivery');
    Route::get('/treasuries/delete_treasuries_delivery/{id}',[TreasuriController::class,'delete_treasuries_delivery'])->name('admin.treasuries.delete_treasuries_delivery');


    Route::resource('sales_material_types',SalesMaterialTypeController::class);
    Route::resource('stores',StoreController::class);




    Route::get('logout',[authController::class , 'logout'])->name('admin.logout');
});
