<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TryController;

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

Route::get('/hello-ajax', function () {
    return response()->json('Hello from backend!');
})->name('hello.ajax');
// Route::match(['get', 'post'], '/hello-ajax', function () {
//     return response()->json('Hello from backend!');
// })->name('hello.ajax');


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

Route::get('/inventory/brand', function () {
    return view('inventory.brand');
})->name('inventory.brand');

Route::get('/inventory/product-names', function () {
    return view('inventory.product-names');
})->name('inventory.product-names');

Route::get('/inventory/account',[UserController::class,'index' ])->name('inventory.account');




Route::get('/inventory/supplier', function () {
    return view('inventory.supplier');
})->name('inventory.supplier');


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


// ADMIN
Route::group(['middleware' => ['auth', 'role:admin']], function(){
    Route::get('/admin',[AdminController::class,'index'])->name('admin');
});

// USER
Route::group(['middleware' => ['auth', 'role:admin|user']], function(){
    Route::get('/user',[UserController::class,'index'])->name('user');

    // PRODUCT LIST
    Route::resource('product-names', ProductController::class);
    Route::get('/product-names', [ProductController::class, 'index'])->name('product-names.index');
    Route::post('/product-names', [ProductController::class, 'store'])->name('product-names.store');
    Route::put('/product-names/{product}', [ProductController::class, 'update'])->name('product-names.update');
    Route::delete('/product-names/{product}', [ProductController::class, 'destroy'])->name('product-names.destroy');

});
// PRODUCT LIST
    Route::resource('product-names', ProductController::class);
    Route::get('/product-names', [ProductController::class, 'index'])->name('product-names.index');
    Route::post('/product-names', [ProductController::class, 'store'])->name('product-names.store');
    Route::put('/product-names/{product}', [ProductController::class, 'update'])->name('product-names.update');
    Route::delete('/product-names/{product}', [ProductController::class, 'destroy'])->name('product-names.destroy');

    Route::post('/get-users-data', [UserController::class, 'getUsersData'])->name('users.data');
    // Route::get('/admin/index', [AdminController::class, 'index'])->name('admin.index');
    // Route::post('/admin/store', [AdminController::class, 'store'])->name('admin.store');
    // // Route::get('/admin/edit/{id}', [AdminController::class, 'edit'])->name('admin.edit');
    // Route::get('/admin/show/{id}', [AdminController::class, 'show'])->name('admin.show');
    // Route::put('/admin/update', [AdminController::class, 'update'])->name('admin.update');

    // Route::delete('/admin/destroy/{id}', [AdminController::class, 'destroy'])->name('admin.destroy');
    // Route::get('/admin/create', [AdminController::class, 'create'])->name('admin.create');
    // Route::post('/admin', [AdminController::class, 'store'])->name('admin.store');

    // Route::get('/roles/{id}', [RoleController::class, 'show'])->name('roles.show');