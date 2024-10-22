<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\User\ProductController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\User\SaleInfoController;


        Route::group(['prefix'=> 'admin', 'middleware'=> 'admin'], function(){
            Route::get('home', [AdminController::class, 'adminHome'])->name('adminHome');

            //category
            Route::group(['prefix'=> 'category'], function(){
                Route::get('list', [CategoriesController::class, 'list'])->name('category#list');
                Route::post('create', [CategoriesController::class, 'create'])->name('category#create');
                Route::get('update/{id}', [CategoriesController::class, 'updatePage'])->name('category#updatePage');
                Route::post('update/{id}', [CategoriesController::class, 'update'])->name('category#update');
                Route::get('delete/{id}', [CategoriesController::class, 'delete'])->name('category#delete');
            });

            //profile
            Route::prefix('profile')->group(function () {
                Route::get('changePassword', [ProfileController::class, 'changePasswordPage'])->name('profile#changepassword#page');
                Route::post('changePassword', [ProfileController::class, 'changePassword'])->name('profile#changepassword');

                Route::get('accountProfile', [ProfileController::class, 'accountProfilePage'])->name('profile#accountProfile#page');
                Route::get('edit', [ProfileController::class, 'editProfile'])->name('profile#edit');
                Route::post('update', [ProfileController::class, 'updateProfile'])->name('profile#update');

                //giving permission to superadmin
                Route::group(['middleware'=> 'superadmin'], function(){
                    Route::get('add/newAdmin', [ProfileController::class, 'createNewAdminAccount' ])->name('profile#createNewAdminAccount');
                    Route::post('add/newAdmin', [ProfileController::class, 'createAdminAccount'])->name('profile#createAdminAccount');

                    //payment
                    Route::prefix('payment')->group(function(){
                        Route::get('list', [PaymentController::class, 'list'])->name('payment#list');
                        Route::post('list', [PaymentController::class, 'create'])->name('payment#create');
                    });

                    //admin list page & delete
                    Route::get('admin/list', [ProfileController::class, 'adminList'])->name('profile#admin#list');
                    Route::get('profile/delete/{id}', [ProfileController::class, 'delete'])->name('profile#delete');

                    //user list page & delete
                    Route::get('user/list', [ProfileController::class, 'userList'])->name('profile#user#list');
                    Route::get('profile/userList/delete/{id}', [ProfileController::class, 'userDelete'])->name('profile#user#delete');
                });

                //product route
                Route::group(['prefix'=> 'product'], function (){
                    Route::get('create', [ProductController::class, 'create'])->name('product#create');
                    Route::post('create', [ProductController::class, 'createProduct'])->name('product#createProduct');
                    Route::get('list/{amt?}', [ProductController::class, 'productList'])->name('product#list');
                    Route::get('list/saleInfo', [ProductController::class, 'saleInfoSearch'])->name('product#saleInfo');
                    Route::get('update/page/{id}', [ProductController::class, 'updatePage'])->name('product#updatePage');
                    Route::post('update/page', [ProductController::class, 'update'])->name('product#update');
                    Route::get('update/listPage/{id}', [ProductController::class, 'listPage'])->name('product#listPage');
                    Route::get('update/delete/{id}', [ProductController::class, 'delete'])->name('product#delete');
                });

                //order route
                Route::group(['prefix'=> 'order'], function(){
                    Route::get('list', [OrderController::class, 'list'])->name('order#list');
                    Route::get('details/{order_code}', [OrderController::class, 'details'])->name('order#details');

                    //ajax route
                    Route::get('changeStatus', [OrderController::class, 'changeStatus'])->name('order#changeStatus');
                    //confirm order
                    Route::get('confirmOrder', [OrderController::class, 'confirmOrder'])->name('order#confirmOrder');
                    //cancel order
                    Route::get('cancelOrder', [OrderController::class, 'cancelOrder'])->name('order#cancelOrder');
                });

                //sale infomation
                Route::get('info', [SaleInfoController::class, 'saleInfo'])->name('user#saleInfo');



            });


        });



