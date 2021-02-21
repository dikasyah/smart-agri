<?php

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

Auth::routes([
    'register' => false, // Registration Routes...
    'reset' => false, // Password Reset Routes...
    'verify' => false, // Email Verification Routes...
]);

Route::get('/', function(){
    return redirect()->route('login');
});

Route::group(['prefix'=>'console','as'=>'console.','middleware' => 'auth'], function () {
    Route::get('dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
    
    //User Management
    Route::get('user', [App\Http\Controllers\UserController::class, 'index'])->name('user.index');
    Route::get('user/add', [App\Http\Controllers\UserController::class, 'add'])->name('user.add');
    Route::post('user/add', [App\Http\Controllers\UserController::class, 'add_save']);
    Route::get('user/profile/{id}', [App\Http\Controllers\UserController::class, 'profile'])->name('user.profile');
    Route::post('user/profile/{id}', [App\Http\Controllers\UserController::class, 'profile_save']);
    Route::get('user/changepassword/{id}', [App\Http\Controllers\UserController::class, 'changepassword'])->name('user.changepassword');
    Route::post('user/changepassword/{id}', [App\Http\Controllers\UserController::class, 'changepassword_save']);
    Route::get('user/delete/{id}', [App\Http\Controllers\UserController::class, 'delete']);

    //Role Management
    Route::get('role', [App\Http\Controllers\RoleController::class, 'index'])->name('role.index');
    Route::get('role/add', [App\Http\Controllers\RoleController::class, 'add'])->name('role.add');
    Route::post('role/add', [App\Http\Controllers\RoleController::class, 'add_save']);
    Route::get('role/delete/{id}', [App\Http\Controllers\RoleController::class, 'delete']);
    Route::get('role/{id}/permission', [App\Http\Controllers\RoleController::class, 'permission'])->name('role.permission');
    Route::get('role/permission/delete/{id}', [App\Http\Controllers\RoleController::class, 'permission_delete']);

    //Permission Management
    Route::get('permission', [App\Http\Controllers\PermissionController::class, 'index'])->name('permission.index');
    Route::get('permission/add', [App\Http\Controllers\PermissionController::class, 'add']);
    Route::post('permission/add', [App\Http\Controllers\PermissionController::class, 'add_save']);
    Route::get('permission/view/{id}', [App\Http\Controllers\PermissionController::class, 'view']);
    Route::get('permission/delete/{id}', [App\Http\Controllers\PermissionController::class, 'delete']);
    Route::post('permission/db_select', [App\Http\Controllers\PermissionController::class, 'db_select']);
    Route::post('permission/preview', [App\Http\Controllers\PermissionController::class, 'preview']);

    //Setting
    Route::get('setting', [App\Http\Controllers\SettingController::class, 'index'])->name('setting.index');
    Route::post('setting', [App\Http\Controllers\SettingController::class, 'index_save']);

    //Tanaman
    Route::get('tanaman', [App\Http\Controllers\TanamanController::class, 'index'])->name('tanaman.index');
    Route::get('tanaman/add', [App\Http\Controllers\TanamanController::class, 'add'])->name('tanaman.add');
    Route::post('tanaman/add', [App\Http\Controllers\TanamanController::class, 'add_save']);
    Route::get('tanaman/detail/{id}', [App\Http\Controllers\TanamanController::class, 'detail'])->name('tanaman.detail');
    Route::post('tanaman/detail/{id}', [App\Http\Controllers\TanamanController::class, 'detail_save']);
    Route::get('tanaman/delete/{id}', [App\Http\Controllers\TanamanController::class, 'delete']);

    //Plantation
    Route::get('plantation', [App\Http\Controllers\PlantationController::class, 'index'])->name('plantation.index');
    Route::post('plantation', [App\Http\Controllers\PlantationController::class, 'plantation_save']);

    //Sensor
    Route::get('sensor', [App\Http\Controllers\SensorController::class, 'index'])->name('sensor.index');
    Route::post('sensor/lebung', [App\Http\Controllers\SensorController::class, 'lebung']);
    Route::post('sensor/plantation', [App\Http\Controllers\SensorController::class, 'sensor_plantation']);
    Route::post('sensor/pengamatan', [App\Http\Controllers\SensorController::class, 'sensor_pengamatan']);

    //Report
    Route::get('report', [App\Http\Controllers\ReportController::class, 'index'])->name('report.index');
    Route::get('report/db/{db}', [App\Http\Controllers\ReportController::class, 'selectdb']);
    Route::get('report/table/{table}', [App\Http\Controllers\ReportController::class, 'selecttable']);
});
