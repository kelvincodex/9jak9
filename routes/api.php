<?php

use App\Http\Controllers\AdminsController;
use App\Http\Controllers\AuthenticationsController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\CustomersController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\WishlistsController;
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

Route::prefix('v1')->group(function (){
    //todo public routes
        //todo public customer route
        Route::controller(CustomersController::class)->group(function (){
            Route::get('/read-customer', 'read');
            Route::post('/read-customer-by-id', 'readById');
        });
        //todo public authentication route
        Route::controller(AuthenticationsController::class)
            ->group(function (){
                Route::post('/initiate-enrollment', 'initiateEnrollment');
                Route::post('/complete-enrollment', 'completeEnrollment');
                Route::post('/initiate-forgotten-password', 'initiateForgottenPassword');
                Route::post('/complete-forgotten-password', 'completeForgottenPassword');
                Route::post('/change-password', 'changePassword');
                Route::post('/login', 'login');
                Route::post('/resend-otp', 'resendOtp');
            });
        //todo public product route
        Route::controller(ProductsController::class)
            ->group(function (){
                Route::post('/create-product', 'create')->name("createProduct");
                Route::post('/update-product', 'update')->name("updateProduct");
                Route::get('/read-products', 'read')->name("readProduct");
                Route::post('/read-product-by-id', 'readById')->name("readByIdProduct");
                Route::post('/read-product-by-category-id', 'readProductByCategoryId')->name("readProductByCategoryIdProduct");
                Route::post('/read-product-by-sub_category-id', 'readProductBySubCategoryId')->name("readProductBySubCategoryIdProduct");
                Route::post('/delete-product', 'delete')->name("deleteProduct");
            });

        //todo public sub category route
        Route::controller(SubCategoryController::class)
            ->group(function (){
                Route::post('/create-sub-category', 'create')->name("createSubCategory");
                Route::post('/update-sub-category', 'update')->name("updateSubCategory");
                Route::get('/read-sub-categories', 'read')->name("readSubCategories");
                Route::post('/read-sub-category-by-id', 'readById')->name("readByIdSubCategory");
                Route::post('/read-sub-category-by-category-id', 'readByCategoryId')->name("readSubCategoryByCategoryId");
                Route::post('/delete-sub-category', 'delete')->name("deleteSubCategory");
            });
    //todo public category route
        Route::controller(CategoriesController::class)
            ->group(function (){
                Route::post('/create-category', 'create')->name('createCategory');
                Route::post('/update-category', 'update')->name('updateCategory');
                Route::get('/read-categories', 'read')->name('readCategory');
                Route::post('/read-category-by-id', 'readById')->name('readByIdCategory');
                Route::post('/delete-category', 'delete')->name('deleteCategory');
            });

    //todo public wishlist route
    Route::controller(WishlistsController::class)
        ->group(function (){
            Route::post('/create-wishlist', 'create');
            Route::post('/update-wishlist', 'update');
            Route::get('/read-wishlists', 'read');
            Route::post('/read-wishlist-by-id', 'readById');
            Route::post('/delete-wishlist', 'delete');
        });



    //todo gallery route
    Route::controller(GalleryController::class)->group(function (){
        Route::get('/read-galleries', 'read');
        Route::post('/create-gallery', 'create');
        Route::post('/read-gallery-by-id', 'readById');
        Route::post('/update-gallery', 'update');
    });

    //todo order route
    Route::controller(OrderController::class)->group(function (){
        Route::get('/read-orders', 'read');
        Route::post('/create-order', 'create');
        Route::post('/read-order-by-id', 'readById');
        Route::post('/update-order', 'update');
    });

    //todo cart route
    Route::controller(CartController::class)->group(function (){
        Route::post('/create-cart', 'create');
        Route::post('/read-cart-by-customer', 'readByCustomerId');
        Route::post('/update-cart', 'update');
        Route::post('/delete-cart', 'delete');
    });








//todo protected routes
    Route::middleware('auth:sanctum')->group(function () {
        //todo authentication protected route
        Route::controller(AuthenticationsController::class)
            ->group(function (){
                Route::post('/change-password', 'changePassword');
            });
        //todo customer protected route
        Route::controller(CustomersController::class)->group(function (){
            Route::post('/update-customer', 'update');
        });

    });
});


