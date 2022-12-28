<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    function cartPage(){
        $cartList= Cart::select('carts.*','products.name as pizza_name','products.price as pizza_price','products.image as pizza_image')
                        ->leftJoin('products','carts.product_id','products.id')
                        ->where('user_id',Auth::user()->id)
                        ->get();
        // dd($cartList->toArray());
        $subTotal = 0;
        foreach ($cartList as $cL) {
            $subTotal += $cL->pizza_price * $cL->qty;
        }
        // dd($cartList->toArray());
        return view('user.main.cart',compact('cartList','subTotal'));
    }
}
