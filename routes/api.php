<?php

use App\Http\Controllers\StaffController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/staff', [StaffController::class, 'index']);

Route::post('/staff', [StaffController::class, 'store']);

Route::put('/staff/{id}', [StaffController::class, 'update']);

Route::delete('/staff/{id}', [StaffController::class, 'destroy']);

Route::get('/staff/{id}', [StaffController::class, 'show']);

// //route to admin.index in KuinController
// Route::get('/admin', [KuinController::class, 'index'])->middleware('auth')->name('admin.index');
// Route::post('/createOrder', [KuinController::class, 'store']);
// Route::get('/orders', [KuinController::class, 'getOrder']);
// Route::get('/order/{id}', [KuinController::class, 'show'])->name('show.order');
