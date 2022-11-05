<?php

use App\Http\Controllers\AdminsController;
use App\Http\Controllers\TestEmailController;
use Illuminate\Support\Facades\Artisan;
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

//Route::get('/', function () {
//    return view('welcome');
//});
//todo admin protected route
Route::controller(AdminsController::class)->group(function (){
    Route::get('/admin/dashboard/overview', 'overview')->name('overview');
    Route::get('/admin/dashboard/products', 'products')->name('products');
    Route::get('/admin/dashboard/add-product', 'addProduct')->name('addProduct');
    Route::get('/admin/dashboard/orders', 'orders')->name('orders');
    Route::get('/admin/dashboard/gallery', 'gallery')->name('brands');
    Route::get('/admin/dashboard/categories', 'categories')->name('categories');
    Route::get('/admin/dashboard/sub-category', 'subCategory')->name('subCategory');
});


//todo run command
Route::get('/artisan/{command}', function($command){
    //todo check if its migrate  command
    if($command == 'migrate')
        $output = ['--force'=>true];
    else
        $output = [];

    Artisan::call($command, $output);
    dd(Artisan::output());
});
