<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\User\Usercontroller;
use App\Http\Controllers\User\ProductController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\User\SaleInfoController;

        Route::group(['prefix'=> 'user', 'middleware'=> 'user'], function(){
            Route::get('home/{id?}', [Usercontroller::class, 'userHome'])->name('userHome');

            Route::get('product/details/{id}',[ProductController::class, 'details'])->name('product#details');
            Route::post('addToCart', [ProductController::class, 'addToCart'])->name('product#addToCart');
            Route::get('cart/{id?}', [ProductController::class, 'cart'])->name('product#cart');

            //output api
            // Route::get('product/list', [ProductController::class, 'productList'])->name('product#list');
            Route::get('product/delete', [ProductController::class, 'productDelete'])->name('product#delete');
            // Route::get('cart/delete', [ProductController::class, 'cartDelete'])->name('product#cartDelete');

            //payment
            Route::get('payment', [ProductController::class, 'payment'])->name('user#payment');

            //order
            Route::post('payment/order', [ProductController::class, 'PaymentOrder'])->name('payment#order');
            //order list
            Route::get('order/list', [ProductController::class, 'orderList'])->name('user#orderList');

            //temporary store
            Route::get('temp', [ProductController::class, 'temp'])->name('product#cartTemp');

            Route::group(['prefix'=> 'profile'], function(){
                Route::get('edit', [Usercontroller::class, 'editProfile'])->name('profile#edit');
                Route::post('update', [ProfileController::class, 'updateProfile'])->name('profile#update');

                //change password
                Route::get('changePassword', [Usercontroller::class, 'changePassword'])->name('profile#user#ChangePassword');
                Route::post('changePassword', [ProfileController::class, 'changePassword'])->name('profile#changepassword');
            });

            //contact form
            Route::get('contact', [ContactController::class, 'contact'] )->name('contactForm');
            Route::post('contact', [ContactController::class, 'contactForm'] )->name('user#contactForm');

            //comment
            Route::post('comment/{product_id}', [CommentController::class, 'comment'])->name('user#comment');
            //delete comment
            Route::get('comment/delete/{id}', [CommentController::class, 'deleteComment'])->name('user#comment#delete');

            //rating
            Route::post('rating', [RatingController::class, 'rating'])->name('user#rating');
            //rating notification
            // Route::get('cart/{product_id}', [CartController::class, 'cart'])->name('user#cart');

    });
