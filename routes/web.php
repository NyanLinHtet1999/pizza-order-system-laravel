<?php

use App\Models\Product;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\user\AjaxController;
use App\Http\Controllers\user\UserController;

Route::middleware(['LoginRegister_middleware'])->group(function(){
    Route::redirect('/','loginPage')->name('start#page');
    Route::get('registerPage',[AuthController::class,'registeration'])->name('register#page');
    Route::get('loginPage',[AuthController::class,'logingin'])->name('login#page');
});

Route::middleware([
    'auth'
])->group(function () {
    // dashboard
    Route::get('/dashboard',[AuthController::class,'dashboard'])->name('dashboard');
    // admin
    Route::middleware(['Admin_middleware'])->group(function(){
           // category
        Route::prefix('category')->group(function(){
            Route::get('list',[CategoryController::class,'list'])->name('category#list');
            Route::get('createPage',[CategoryController::class,'createPage'])->name('category#createPage');
            Route::post('/create',[CategoryController::class,'create'])->name('category#create');
            Route::get('/delete/{id}',[CategoryController::class,'delete'])->name('category#delete');
            Route::get('/edit/{id}',[CategoryController::class,'edit'])->name('category#edit');
            Route::post('/update',[CategoryController::class,'update'])->name('category#update');
        });
        // admins account
        Route::prefix('admins')->group(function(){
            Route::get('/password/changePage',[AdminController::class,'changePage'])->name('admins#changePage');
            Route::post('/password/change',[AdminController::class,'change'])->name('admin#change');
            Route::get('/account',[AdminController::class,'accountPage'])->name('admin#account');
            Route::get('/account/edit',[AdminController::class,'accountEdit'])->name('admin#edit');
            Route::post('/account/update',[AdminController::class,'accountUpdate'])->name('admin#update');
            Route::get('/account/list',[AdminController::class,'list'])->name('admin#list');
            Route::get('/account/delete/{id}',[AdminController::class,'delete'])->name('admin#delete');
            Route::post('account/change/{id}',[AdminController::class,'changeToUser'])->name('admin#changeToUser');
        });
        // product
        Route::prefix('product')->group(function(){
            Route::get('list',[ProductController::class,'list'])->name('product#list');
            Route::get('createPage',[ProductController::class,'createPage'])->name('product#createPage');
            Route::post('createPage',[ProductController::class,'create'])->name('product#create');
            Route::get('delete/{id}',[ProductController::class,'delete'])->name('product#delete');
            Route::get('detail/{id}',[ProductController::class,'detail'])->name('product#detail');
            Route::get('editPage/{id}',[ProductController::class,'editPage'])->name('product#editPage');
            Route::post('edit',[ProductController::class,'edit'])->name('product#edit');
        });
        // order list
        Route::prefix('order')->group(function(){
            Route::get('list',[OrderController::class,'orderList'])->name('order#list');
            Route::get('status/change/withAll',[OrderController::class,'statusChangeAll'])->name('order#changeStatus');
            Route::get('order/codePage/{orderCode}',[OrderController::class,'orderCodepage'])->name('order#codePage');
            // ajax
            Route::get('ajax/order/status/change',[OrderController::class,'orderStatusChange']);
        });
        // user List
        Route::prefix('user')->group(function(){
            Route::get('list',[AdminController::class,'userList'])->name('admin#userList');
            Route::post('change/user/toadmin/{id}',[AdminController::class,'userToAdmin'])->name('admin#userToAdmin');
            Route::get('delete/{id}',[AdminController::class,'userDelete'])->name('admin#userDelete');
        });
        // message
        Route::prefix('message')->group(function(){
            Route::get('listPage',[ContactController::class,'listPage'])->name('admin#userMessagePage');
            Route::get('ajax/seeMore',[ContactController::class,'seeMore'])->name('admin#ajaxSeeMore');
        });
    });
     // user
    Route::middleware(['User_middleware'])->group(function(){
        Route::prefix('user')->group(function(){
            // homepage
            Route::get('/home',[UserController::class,'home'])->name('user#home');
            // password
            Route::get('change/passwordPage',[UserController::class,'passwordPage'])->name('user#passwordchangePage');
            Route::post('change/password',[UserController::class,'changePassword'])->name('user#changePassword');
            // profile
            Route::get('edit/profilePage',[UserController::class,'editProfilePage'])->name('user#editProfilePage');
            Route::post('edit/profile',[UserController::class,'editProfile'])->name('user#editProfile');
            // ajax data
            Route::get('ajax/pizza/list',[AjaxController::class,'pizzaList']);
            Route::get('ajax/pizza/order/info',[AjaxController::class,'pizzaOrderInfo']);
            Route::get('ajax/pizza/order/orderList',[AjaxController::class,'orderList']);
            Route::get('ajax/pizza/cart/single/remove',[AjaxController::class,'singleRemove']);
            Route::get('ajax/pizza/cart/all/remove',[AjaxController::class,'allRemove']);
            Route::get('ajax/pizza/view/count',[AjaxController::class,'viewCount']);
            // filter
            Route::get('filter/{id}',[Usercontroller::class,'pizzaFilter'])->name('user#pizzaFilter');
            // detail
            Route::get('pizza/detail/{id}',[UserController::class,'pizzaDetail'])->name('user#pizzaDetail');
            // cart
            Route::get('cartPage',[CartController::class,'cartPage'])->name('user#cartPage');
            //history
            Route::get('historyPage',[UserController::class,'historyPage'])->name('user#historyPage');
            //contact
            Route::get('contactPage',[ContactController::class,'contactPage'])->name('user#contactPage');
            Route::post('contact/sendBtn',[ContactController::class,'sendBtn'])->name('user#contactSendBtn');
        });
    });


});


