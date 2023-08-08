<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\Backend\ClubTypeController;
use App\Http\Controllers\Backend\RoleController;
use App\Http\Controllers\Backend\ApplicationController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('admin.admin_login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

//admin group middleware
Route::middleware(['auth','roles:admin'])->group(function(){

    Route::get('/admin/dashboard', [AdminController::class, 'AdminDashboard'])->name('admin.dashboard');

    Route::get('/admin/logout', [AdminController::class, 'AdminLogout'])->name('admin.logout');

    Route::get('/admin/profile', [AdminController::class, 'AdminProfile'])->name('admin.profile');

    Route::post('/admin/profile/store', [AdminController::class, 'AdminProfileStore'])->name('admin.profile.store');
    
    Route::get('/admin/change/password', [AdminController::class, 'AdminChangePassword'])->name('admin.change.password');

    Route::post('/admin/update/password', [AdminController::class, 'AdminUpdatePassword'])->name('admin.update.password');


}); //END Group Admin Middleware 

//staff group middleware
Route::middleware(['auth','roles:staff'])->group(function(){

    Route::get('/staff/dashboard', [StaffController::class, 'staffDashboard'])->name('staff.dashboard');

    Route::get('/staff/profile', [StaffController::class, 'StaffProfile'])->name('staff.profile');

    Route::get('/staff/logout', [StaffController::class, 'StaffLogout'])->name('staff.logout');



}); //END Group Staff Middleware 

Route::get('/admin/login', [AdminController::class, 'AdminLogin'])->name('admin.login');


//admin group middleware (group routing)
Route::middleware(['auth','roles:admin'])->group(function(){

    //all type of club routes 
    Route::controller(ClubTypeController::class)->group(function(){
        
        Route::get('/all/type','AllType')->name('all.type')->middleware('permission:club.retrieve');
        Route::get('/add/type','AddType')->name('add.type')->middleware('permission:club.create');
        Route::post('/store/type','StoreType')->name('store.type');
        Route::get('/edit/type/{id}','EditType')->name('edit.type');
        Route::post('/update/type','UpdateType')->name('update.type');
        Route::get('/delete/type/{id}','DeleteType')->name('delete.type');

    });

 //Permission All Route
 Route::controller(RoleController::class)->group(function(){
        
    Route::get('/all/permission','AllPermission')->name('all.permission');
    Route::get('/add/permission','AddPermission')->name('add.permission');
    Route::post('/store/permission','StorePermission')->name('store.permission');
    Route::get('/edit/permission/{id}','EditPermission')->name('edit.permission');
    Route::post('/update/permission','UpdatePermission')->name('update.permission');
    Route::get('/delete/permission/{id}','DeletePermission')->name('delete.permission');

});

//Roles All Route
Route::controller(RoleController::class)->group(function(){
        
    Route::get('/all/roles','AllRoles')->name('all.roles');
    Route::get('/add/roles','AddRoles')->name('add.roles');
    Route::post('/store/roles','StoreRoles')->name('store.roles');
    Route::get('/edit/roles/{id}','EditRoles')->name('edit.roles');
    Route::post('/update/roles','UpdateRoles')->name('update.roles');
    Route::get('/delete/roles/{id}','DeleteRoles')->name('delete.roles');

    Route::get('/add/roles/permission','AddRolesPermission')->name('add.roles.permission');
    Route::post('/role/permission/store','RolePermissionStore')->name('role.permission.store');
    Route::get('/all/roles/permission','AllRolesPermission')->name('all.roles.permission');

    Route::get('/admin/edit/roles/{id}','AdminEditRoles')->name('admin.edit.roles');
    Route::post('/admin/roles/update/{id}','AdminRolesUpdate')->name('admin.roles.update');
    Route::get('/admin/delete/roles/{id}','AdminDeleteRoles')->name('admin.delete.roles');


});

//Admin User All Route

Route::controller(AdminController::class)->group(function(){

    Route::get('/all/admin','AllAdmin')->name('all.admin');
    Route::get('/add/admin','AddAdmin')->name('add.admin');
    Route::post('/store/admin','StoreAdmin')->name('store.admin');
    Route::get('/edit/admin/{id}','EditAdmin')->name('edit.admin');
    Route::post('/update/admin/{id}','UpdateAdmin')->name('update.admin');
    Route::get('/delete/admin/{id}','DeleteAdmin')->name('delete.admin');

});

    //Applications All Route
    Route::controller(ApplicationController::class)->group(function(){
            
        Route::get('/all/application','AllApplication')->name('all.application');
        // Route::get('/add/roles','AddRoles')->name('add.roles');

    });


}); //END Group Admin Middleware    