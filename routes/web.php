<?php

use App\Http\Controllers\CartCheckoutController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashbordController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KuinController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductControllerG;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AbsentController;

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

//route to HomeController index class
Route::get('/', [HomeController::class, 'index'])->name('home.index');

Route::get('contact', function () {
    return view('contact');
});
Route::get('about', function () {
    return view('about');
});

//cart
Route::get('cart', [CartController::class, 'cartList'])->name('cart');
Route::post('add-to-cart', [CartController::class, 'addToCart'])->name('add_to_cart');
Route::patch('update-cart', [CartController::class, 'update'])->name('update_cart');
Route::delete('remove-from-cart/{id}', [CartController::class, 'remove'])->name('remove_from_cart');
//Route::post('clear', [CartController::class, 'clearAllCart'])->name('cart.clear');
Route::post('/cart/update/{id}', [CartController::class, 'updateCart'])->name('update_cart');
Route::post('cart/checkout', [CartCheckoutController::class, 'store'])->name('cart.checkout');
//Route::get('/order/success/{order}', [CartCheckoutController::class, 'success'])->name('order.success');
Route::get('order/success/{order}', [CartCheckoutController::class, 'success'])->name('order.success');

Route::get('/products', [ProductController::class, 'index'])->name('product.index');

Route::get('/product/{id}', [ProductController::class, 'show'])->name('show.product');

Route::middleware('user')->group(function () {
    //Route::get('/profile', [ProfileController::class, 'index'])->name('profile.edit');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/{id}', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    //dashboard
    Route::get('/dashboard', [DashbordController::class, 'index'])->name('dashboard');
    Route::get('/absent', [AbsentController::class, 'getAbsentUsers'])->name('absent.users');
});

Route::middleware('admin')->group(function () {


    Route::get('/calender', [AbsentController::class, 'show'])->name('calender');
    Route::get('/calender/create', [AbsentController::class, 'create'])->name('create');
    Route::post('/calender/store', [AbsentController::class, 'store'])->name('store');
    Route::get('/calender/{id}', [AbsentController::class, 'edit'])->name('edit');
    Route::put('/calender/{id}', [AbsentController::class, 'update'])->name('update');
    Route::delete('/calender/{id}', [AbsentController::class, 'destroy'])->name('destroy');




    //sync product
    Route::get('/sync/{order_id}', [ProductController::class, 'sync'])->name('sync.products');

    //chart
    Route::get('/chart', [DashbordController::class, 'index']);
    // //route to admin.index in KuinController
    Route::get('/admin', [KuinController::class, 'index'])->middleware('user')->name('admin.index');
    Route::post('/createOrder', [KuinController::class, 'store'])->name('store.order');
    Route::get('/orders', [KuinController::class, 'getOrder'])->name('get.orders');
    Route::get('/order/{id}', [KuinController::class, 'show'])->name('show.order');
    Route::get('/kuin/product/{id}', [KuinController::class, 'showProduct'])->name('showkuin.product');

    //category
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index')->middleware('user');
    Route::get('/category/{id}', [CategoryController::class, 'show'])->name('category.show');
    Route::get('/category', [CategoryController::class, 'create'])->name('category.create');
    Route::delete('/category/product/{id}', [CategoryController::class, 'detach'])->name('product.detach');
    Route::post('/category/store/{id?}', [CategoryController::class, 'store'])->name('category.store');
    Route::put('/category/{id}', [CategoryController::class, 'update'])->name('category.update');
    Route::delete('/category/{id}', [CategoryController::class, 'destroy'])->name('category.destroy');

    //products
    Route::post('/product', [ProductController::class, 'store']);
    Route::put('product/{id}', [ProductController::class, 'update']);
    Route::delete('product/{id}', [ProductController::class, 'destroy']);



    Route::get('/admin/products', [ProductControllerG::class, 'index'])->name('products.index');

    //user

    Route::get('/users', [UserController::class, 'index'])->name('user.index');
    Route::get('/user/create', [UserController::class, 'create'])->name('user.create');
    Route::post('/user/store', [UserController::class, 'store'])->name('user.store');
    Route::put('/user/update/{id}', [UserController::class, 'update'])->name('user.update');
    Route::get('/user/{id}', [UserController::class, 'edit'])->name('user.edit');
    Route::delete('/user/{id}', [UserController::class, 'destroy'])->name('user.destroy');
});















require __DIR__.'/auth.php';
