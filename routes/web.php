<?php

use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\SubCategoryController;
use App\Http\Controllers\Backend\TaxController;
use App\Http\Controllers\Backend\UnitController;
use App\Http\Controllers\Frontend\Auth\CustomerAuthenticationController;
use App\Http\Controllers\Frontend\Auth\CustomerRegistrationController;
use App\Http\Controllers\Frontend\CategoryController as FrontendCategoryController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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


Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    Route::group(['as'=> 'product.', 'prefix'=> 'product'], function(){
        Route::get('/', [ProductController::class, 'index'])->name('index');
        Route::get('/get-all-items', [ProductController::class, 'getAllItems'])->name('allProducts');
        Route::get('/create', [ProductController::class, 'create'])->name('create');
        Route::post('/store', [ProductController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [ProductController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [ProductController::class, 'update'])->name('update');
        Route::delete('/delete/{id}', [ProductController::class, 'destroy'])->name('destroy');

        
        Route::group(['as'=> 'category.', 'prefix'=> 'category'], function(){
            Route::get('/', [CategoryController::class, 'index'])->name('index');
            Route::get('/get-all-items', [CategoryController::class, 'getAllItems'])->name('allCategory');
            Route::get('/create', [CategoryController::class, 'create'])->name('create');
            Route::post('/store', [CategoryController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [CategoryController::class, 'edit'])->name('edit');
            Route::post('/update/{id}', [CategoryController::class, 'update'])->name('update');
            Route::delete('/delete/{id}', [CategoryController::class, 'destroy'])->name('destroy');
        });

        
        Route::group(['as'=> 'subCategory.', 'prefix'=> 'sub-category'], function(){
            Route::get('/', [SubCategoryController::class, 'index'])->name('index');
            Route::get('/get-all-items', [SubCategoryController::class, 'getAllItems'])->name('allSubCategory');
            Route::get('/get-categories', [SubCategoryController::class, 'Categories'])->name('getCategories');
            Route::get('/create', [SubCategoryController::class, 'create'])->name('create');
            Route::post('/store', [SubCategoryController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [SubCategoryController::class, 'edit'])->name('edit');
            Route::post('/update/{id}', [SubCategoryController::class, 'update'])->name('update');
            Route::delete('/delete/{id}', [SubCategoryController::class, 'destroy'])->name('destroy');
        });
    

        Route::group(['as'=> 'brand.', 'prefix'=> 'brand'], function(){
            Route::get('/', [BrandController::class, 'index'])->name('index');
            Route::get('/get-all-items', [BrandController::class, 'getAllItems'])->name('allBrand');
            Route::get('/create', [BrandController::class, 'create'])->name('create');
            Route::post('/store', [BrandController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [BrandController::class, 'edit'])->name('edit');
            Route::post('/update/{id}', [BrandController::class, 'update'])->name('update');
            Route::delete('/delete/{id}', [BrandController::class, 'destroy'])->name('destroy');
        });
    
        Route::group(['as'=> 'unit.', 'prefix'=> 'unit'], function(){
            Route::get('/', [UnitController::class, 'index'])->name('index');
            Route::get('/get-all-items', [UnitController::class, 'getAllItems'])->name('allUnits');
            Route::get('/create', [UnitController::class, 'create'])->name('create');
            Route::post('/store', [UnitController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [UnitController::class, 'edit'])->name('edit');
            Route::put('/update/{id}', [UnitController::class, 'update'])->name('update');
            Route::delete('/delete/{id}', [UnitController::class, 'destroy'])->name('destroy');
        });
    });
    
});



// forntend routes
Route::group(['as'=> 'customer.', 'prefix'=> 'auth'], function(){
    Route::get('login', [CustomerAuthenticationController::class, 'index'])->name('login');
    Route::post('login/submit', [CustomerAuthenticationController::class, 'login'])->name('login.submit');
    Route::get('logout', [CustomerAuthenticationController::class, 'logout'])->name('login.logout');
    
    Route::get('register', [CustomerRegistrationController::class, 'register'])->name('register');
    Route::get('register/submit', [CustomerRegistrationController::class, 'store'])->name('store');
});


Route::group(['as'=> 'customer.', 'prefix'=> 'customer', 'middleware' => ['customer.auth']], function(){
    Route::get('dashboard', [CustomerAuthenticationController::class, 'dashboard'])->name('dashboard');
});


Route::get('/', function () {
    return Inertia::render('Frontend/Home');
})->name('home');

Route::get('/products', function () {
    return Inertia::render('Frontend/Products');
});

require __DIR__.'/auth.php';
