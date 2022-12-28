<?php

namespace App\Http\Controllers\api;

use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Contact;
use App\Models\Product;
use App\Models\Category;
use App\Models\OrderList;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class RouteController extends Controller
{
    function productList(){
        $products = Product::get();
        return response()->json($products, 200);
    }
    function cartList(){
        $carts = Cart::get();
        return response()->json($carts, 200);
    }
    function categoryList(){
        $categories = Category::get();
        return response()->json($categories, 200);
    }
    function contactList(){
        $contacts = Contact::get();
        return response()->json($contacts, 200);
    }
    function orderList(){
        $orders = Order::get();
        return response()->json($orders, 200);
    }
    function order_listList(){
        $order_lists = OrderList::get();
        return response()->json($order_lists, 200);
    }
    function userList(){
        $users = User::get();
        return response()->json($users, 200);
    }
    function categoryCreate(Request $request){
        Category::create([
            'name' => $request->name
        ]);
    }
    function contactCreate(Request $request){
        logger($request->all());
        Contact::create([
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message
        ]);
    }
    function categoryDelete($id){
        $data = Category::where('id',$id)->first();
        if(isset($data)){
            Category::where('id',$id)->delete();
            return response()->json(['status'=>'true','deleted data'=>$data], 200);
        }
        return response()->json(['status'=>'false'], 200);
    }
    function contactDelete(Request $request){
        $data = Contact::where('id',$request->id)->first();
        if(isset($data)){
            Contact::where('id',$request->id)->delete();
            return response()->json(['status'=>'true','deleted data'=>$data], 200);
        }
        return response()->json(['status'=>'false'], 200);
    }
    function categoryDetail($id){
        $data = Category::where('id',$id)->first();
        return response()->json($data, 200);
    }
    function categoryUpdate(Request $request){
        $data = Category::where('id',$request->category_id)->first();
        if(isset($data)){
            $info=Category::where('id',$request->category_id)->update(['name'=>$request->category_name ]);
            return response()->json(['status'=>'successfully updated'], 200);
        }
        return response()->json(['status'=>'not ok'], 500);
    }

}
