<?php

use Illuminate\Support\Facades\Route;
use App\HTTP\Controllers\HomeController;
use App\HTTP\Controllers\AdminController;
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

route::get('/', [HomeController::class,'index']);


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

route::get('/redirect', [HomeController::class,'redirect']);
route::get('/view_catagory', [AdminController::class,'view_catagory']);

route::post('/add_catagory', [AdminController::class,'add_catagory']);

route::get('/delete_catagory/{id}', [AdminController::class,'delete_catagory']);
route::get('/view_product', [AdminController::class,'view_product']);

route::post('/add_product', [AdminController::class,'add_product']);

route::get('/show_product', [AdminController::class,'show_product']);
route::get('/delete_product/{id}', [AdminController::class,'delete_product']);
route::get('/update_product/{id}', [AdminController::class,'update_product']);
route::post('/update_product_confirm/{id}', [AdminController::class,'update_product_confirm']);
route::get('/order', [AdminController::class,'order']);
route::get('/delivered/{id}', [AdminController::class,'delivered']);
route::get('/print_pdf/{id}', [AdminController::class,'print_pdf']);
route::get('/searchdata', [AdminController::class,'searchdata']);


route::get('/product_details/{id}', [HomeController::class,'product_details']);
route::post('/add_cart/{id}', [HomeController::class,'add_cart']);
route::get('/show_cart', [HomeController::class,'show_cart']);
route::get('/remove_cart/{id}', [HomeController::class,'remove_cart']);
route::get('/cash_order', [HomeController::class,'cash_order']);
route::get('/show_order', [HomeController::class,'show_order']);
route::get('/cancel_order/{id}', [HomeController::class,'cancel_order']);
route::post('/add_comment', [HomeController::class,'add_comment']);
route::post('/add_reply/{id}', [HomeController::class,'add_reply']);
route::get('/searchdata', [HomeController::class,'searchdata']);

route::get('/view_product', [HomeController::class,'view_product']);
route::get('/search_product', [HomeController::class,'search_product']);

