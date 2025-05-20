<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\DepartmentController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SampleController;
use App\Http\Controllers\SupplierController;
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
Route::get('/', function () {
    return view('auth.login');
})->name('login');



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

Route::get('/inventory/department', function () {
    return view('inventory.department');
})->name('inventory.department');

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
    // Route::resource('product-names', ProductController::class);
    //  Route::get('/bbb', [TryController::class, 'index']);
    //  Route::post('/store', [TryController::class, 'store'])->name('store');
    //  Route::get('/fetchall', [TryController::class, 'fetchAll'])->name('fetchAll');
    //  Route::post('/delete', [TryController::class, 'delete'])->name('delete');
    //  Route::get('/edit', [TryController::class, 'edit'])->name('edit');
    //  Route::post('/update', [TryController::class, 'update'])->name('update');
});

    // USER ACCOUNT
    Route::get('/account', [UserController::class, 'account'])->name('account');
    Route::get('/accounts/data', [UserController::class, 'getUsersData'])->name('accounts.data');
    Route::post('/accounts/update/{id}', [UserController::class, 'updateUser'])->name('accounts.update');
    Route::delete('/accounts/delete/{id}', [UserController::class, 'deleteUser'])->name('accounts.delete');
    Route::get('/roles', [UserController::class, 'getRoles']);
    Route::post('/assign-role', [UserController::class, 'createRoles'])->name('assign.role');
    Route::post('/accounts/register', [UserController::class, 'store'])->name('accounts.register');

    // ROLES MANAGEMENT
    Route::get('/role-management', [UserController::class, 'roles'])->name('roles.display');
    Route::prefix('roles')->name('roles.')->group(function () {
    Route::get('/role-manage', [RoleController::class, 'index'])->name('index');
    Route::get('/data', [RoleController::class, 'fetchRoles'])->name('data');
    Route::post('/role-data', [RoleController::class, 'store'])->name('store');
    Route::put('/update/{id}', [RoleController::class, 'update'])->name('update');
    Route::delete('/{id}', [RoleController::class, 'destroy'])->name('delete');
    });

    // PRODUCT LIST
    // Route::resource('products', ProductController::class);
    Route::get('/products/data', [ProductController::class, 'getData'])->name('products.data');
    Route::post('/products/store', [ProductController::class, 'store'])->name('products.store');
    Route::delete('/products/delete/{id}', [ProductController::class, 'deleteProduct'])->name('products.delete');
    Route::post('/products/update/{id}', [ProductController::class, 'updateProduct'])->name('products.update');

    // Supplies LIST
    Route::get('/supplier/data', [SupplierController::class, 'getData'])->name('supplier.data');
    Route::post('/supplier/store', [SupplierController::class, 'store'])->name('supplier.store');
    Route::delete('/supplier/delete/{id}', [SupplierController::class, 'deleteSupplier'])->name('supplier.delete');
    Route::post('/supplier/update/{id}', [SupplierController::class, 'updateSupplier'])->name('supplier.update');

    // Department LIST
    Route::get('/departments', [DepartmentController::class, 'index'])->name('departments.index');
    Route::post('/departments', [DepartmentController::class, 'store'])->name('departments.store');
    Route::put('/departments/{department}', [DepartmentController::class, 'update'])->name('departments.update');
    Route::delete('/departments/{department}', [DepartmentController::class, 'destroy'])->name('departments.destroy');

    // PRODUCT NAMES LIST
    Route::get('product-names', [ProductController::class, 'getProductNames'])->name('product-names.index');
    Route::post('product-names', [ProductController::class, 'storeProductName'])->name('product-names.store');
    Route::put('product-names/{id}', [ProductController::class, 'updateProductName'])->name('product-names.update');
    Route::delete('product-names/{id}', [ProductController::class, 'deleteProductName'])->name('product-names.destroy');


    // Route::get('/admin/index', [AdminController::class, 'index'])->name('admin.index');
    // Route::post('/admin/store', [AdminController::class, 'store'])->name('admin.store');
    // Route::get('/admin/edit/{id}', [AdminController::class, 'edit'])->name('admin.edit');
    // Route::get('/admin/show/{id}', [AdminController::class, 'show'])->name('admin.show');
    // Route::put('/admin/update', [AdminController::class, 'update'])->name('admin.update');
    // Route::delete('/admin/destroy/{id}', [AdminController::class, 'destroy'])->name('admin.destroy');
    // Route::get('/admin/create', [AdminController::class, 'create'])->name('admin.create');
    // Route::post('/admin', [AdminController::class, 'store'])->name('admin.store');
    // Route::get('/roles/{id}', [RoleController::class, 'show'])->name('roles.show');
