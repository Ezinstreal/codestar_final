<?php

use App\Http\Controllers\frontend\HomeController;
use App\Http\Controllers\frontend\PostController;
use App\Http\Controllers\frontend\UserController;
use App\Http\Controllers\backend\AdminHomeController;
use App\Http\Controllers\backend\AdminPostController;
use App\Http\Controllers\backend\AdminUserController;
use App\Http\Controllers\SendMessageController;
use App\Http\Controllers\RegisterController;
use App\Models\Comment;
use App\Models\Post;
use App\Notifications\VerifyEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Auth;

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

Route::name('home.')->group(function(){
    Route::get('/',[HomeController::class,'index'])->name('index');

});

Route::prefix('posts')->name('posts.')->group(function(){
    Route::get('',[PostController::class,'index'])->name('index');
    Route::get('create',[PostController::class,'create'])->name('create')->middleware(['auth','verified']);
    Route::post('/',[PostController::class,'store'])->name('store');
    Route::get('draft',[PostController::class,'draft'])->name('draft')->middleware('auth');
    Route::get('storage',[PostController::class,'getStorage'])->name('getStorage')->middleware('auth');
    Route::post('postStorage',[PostController::class,'postStorage'])->name('postStorage');
    Route::post('loadcomment',[PostController::class,'loadcomment'])->name('loadcomment');
    Route::post('sendcomment',[PostController::class,'sendcomment'])->name('sendcomment');
    Route::post('likecomment',[PostController::class,'likecomment'])->name('likecomment');
    Route::get('/{slug}',[PostController::class,'show'])->name('show');
    Route::get('{slug}/tag',[PostController::class,'tag'])->name('tag');
    Route::get('{slug}/edit',[PostController::class,'edit'])->name('edit');
    Route::put('{slug}',[PostController::class,'update'])->name('update');
    Route::delete('{slug}',[PostController::class,'destroy'])->name('destroy');
});

Route::prefix('users')->name('users.')->group(function(){
    Route::get('{nickname}/mypage',[UserController::class,'mypage'])->name('mypage');
    Route::post('notification',[UserController::class,'notification'])->name('notification');
    Route::post('notifications',[UserController::class,'notifications'])->name('notifications');
    Route::post('{nickname}/follow',[UserController::class,'follow'])->name('follow')->middleware('auth');
    Route::get('sign_in',[UserController::class,'getLogin'])->name('getLogin')->middleware('guest');
    Route::post('sign_in',[UserController::class,'postLogin'])->name('postLogin');
    Route::get('sign_up',[UserController::class,'getRegister'])->name('getRegister')->middleware('guest');
    Route::post('sign_up',[UserController::class,'postRegister'])->name('postRegister');
    Route::get('forgot',[UserController::class,'getForgot'])->name('getForgot')->middleware('guest');
    Route::post('forgot',[UserController::class,'postForgot'])->name('postForgot');
    Route::get('recover/{id}',[UserController::class,'getRecover'])->name('getRecover');
    Route::post('recover',[UserController::class,'postRecover'])->name('postRecover');

    Route::prefix('settings')->name('settings.')->middleware('auth')->group(function(){
        Route::get('/',[UserController::class,'settings'])->name('index');
        Route::put('profile',[UserController::class,'profile'])->name('profile');
        Route::put('pw',[UserController::class,'pw'])->name('pw');
    });
    Route::get('logout',[UserController::class,'logout'])->name('logout');

    Route::get('verify/{id}',[UserController::class,'verify'])->name('verify');
    Route::post('verifyagain',[UserController::class,'verifyAgain'])->name('verifyAgain');
});

Route::prefix('admin')->name('admin.')->middleware('auth','can:manager-use')->group(function(){
    Route::get('/',[AdminHomeController::class,'index'])->name('index');
    Route::prefix('posts')->name('posts.')->group(function(){
        Route::get('/',[AdminPostController::class,'index'])->name('index');
        Route::get('create',[AdminPostController::class,'create'])->name('create');
        Route::post('/',[AdminPostController::class,'store'])->name('store');
        Route::get('{id}',[AdminPostController::class,'edit'])->name('edit');
        Route::put('{id}',[AdminPostController::class,'update'])->name('update');
        Route::delete('{id}',[AdminPostController::class,'destroy'])->name('destroy');
        Route::post('status/{id}',[AdminPostController::class,'status'])->name('status');
        Route::post('status2/{id}',[AdminPostController::class,'status2'])->name('status2');
    });
    Route::prefix('user')->name('user.')->group(function(){
        Route::get('/',[AdminUserController::class,'index'])->name('index');
        Route::delete('/destroy/{id}',[AdminUserController::class,'destroy'])->name('destroy');
        Route::get('create',[AdminUserController::class,'create'])->name('create');
        Route::post('/create',[AdminUserController::class,'store'])->name('store');
        Route::get('/{id}',[AdminUserController::class,'edit'])->name('edit');
        Route::put('/{id}',[AdminUserController::class,'update'])->name('update');
        Route::put('/password/{id}',[AdminUserController::class,'password'])->name('password');
        Route::post('logout',[AdminUserController::class,'logout'])->name('logout');
    });
});





Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
