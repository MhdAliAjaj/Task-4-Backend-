<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
    return view('welcome');
});

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
// Route::get('/employee', [EmployeeController::class, 'index'])->name('employee.index');





/**--------------------------------------------------------------------- */
/*---------------Admin------------------*/ 
Route::get('/admin',[AdminController::class,'index'])->name('admin.index');
Route::get('/admin/create',[AdminController::class,'create'])->name('admin.create');
Route::get('/admin/edit/{id}',[AdminController::class,'edit'])->name('admin.edit');
Route::post('/admin/store',[AdminController::class,'store'])->name('admin.store');
Route::put('/admin/update/{id}',[AdminController::class,'update'])->name('admin.update');
Route::delete('/admin/delete/{id}',[AdminController::class,'destroy'])->name('admin.delete');


/*--filter admin--*/
Route::get('/admin/filter',[AdminController::class,'filter'])->name('admin.filter');
Route::get('/admin/filter',[AdminController::class,'filter'])->name('admin.filter');

/*-------search user--------*/ 

Route::get('/admin/filter/simillar',[AdminController::class,'search'])->name('admin.filter.search');


/*---------------Employee------------------*/ 
Route::get('/employee', [EmployeeController::class, 'index'])->name('employee.index');

