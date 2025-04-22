<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
    return view('inventory.inventory');
});

// route to product page
Route::get('/inventory/product', function () {
    return view('inventory.product');
})->name('inventory.product');

Route::get('/inventory/dashboard', function () {
    return view('inventory.dashboard');
})->name('inventory.dashboard');

Route::get('/inventory/account', function () {
    return view('inventory.account');
})->name('inventory.account');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth', 'role:admin']], function(){
    Route::get('/admin',[AdminController::class,'index'])->name('admin');
});
Route::group(['middleware' => ['auth', 'role:admin|user']], function(){
    Route::get('/user',[UserController::class,'index'])->name('user');
});
