<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\RouteController;

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
// get
Route::get('cart/list',[RouteController::class,'cartList']);
Route::get('category/list',[RouteController::class,'categoryList']);
Route::get('contact/list',[RouteController::class,'contactList']);
Route::get('order/list',[RouteController::class,'orderList']);
Route::get('order_list/list',[RouteController::class,'order_listList']);
Route::get('product/list',[RouteController::class,'productList']);
Route::get('user/list',[RouteController::class,'userList']);
Route::post('category/create',[RouteController::class,'categoryCreate']);
Route::post('contact/create',[RouteController::class,'contactCreate']);
// delete
Route::get('category/delete/{id}',[RouteController::class,'categoryDelete']);
Route::post('contact/delete',[RouteController::class,'contactDelete']);
// detail
Route::get('category/list/{id}',[RouteController::class,'categoryDetail']);
//  update
Route::post('category/update',[RouteController::class,'categoryUpdate']);
