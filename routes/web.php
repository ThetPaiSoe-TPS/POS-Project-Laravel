<?php

use App\Http\Controllers\Api\RouteController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SocialLoginController;

require_once __DIR__.'/admin.php';
require_once __DIR__.'/user.php';
require __DIR__.'/auth.php';

Route::get('/', function () {
    // return view('welcome');
    return view('authentication.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//google and github login
Route::get('/auth/{provider}/redirect', [SocialLoginController::class, 'redirect'] )->name('socialLogin');
Route::get('/auth/{provider}/callback', [SocialLoginController::class, 'callback'] )->name('socialCallback');

//testing APIs
Route::get('/webTeting', function(){
    $data= [
        'message'=> 'Testing APIs message',
    ];
    return response()->json($data, 200);
});

Route::get('api/comment', [RouteController::class, 'comment']);
Route::get('api/category', [RouteController::class, 'category']);

//insert data through APIs
Route::post('api/create/category', [RouteController::class, 'createCategory']);
Route::post('api/create/contact', [RouteController::class, 'createContact']);

//delete category with post method
Route::post('delete/category', [RouteController::class, 'deleteCategory']);

//delete category with get method
Route::get('delete/category/{id}', [RouteController::class, 'deleteCategoryWithGet']);




