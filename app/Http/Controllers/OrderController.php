<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderList;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // redirect order list
    function orderList(){
        $order = Order::select('orders.*','users.name as user_name')
                        ->leftJoin('users','orders.user_id','users.id')
                        ->when(request('key'),function($d){
                            $searchKey=request('key');
                            $d->orwhere('users.name','like','%'.$searchKey.'%')
                            ->orWhere('orders.order_code','like','%'.$searchKey.'%');
                        })
                        ->orderBy('created_at','desc')
                        ->get();
        return view('admin.order.list',compact('order'));
    }
    // status change with all
    function statusChangeAll(){
        // dd(request('orderStatus'));
        $order = $order = Order::select('orders.*','users.name as user_name')
        ->leftJoin('users','orders.user_id','users.id');
        if(request('orderStatus') != 3){
            $order = $order->where('orders.status',request('orderStatus'))
            ->orderBy('created_at','desc')
            ->get();
        }else{
            $order = $order->orderBy('created_at','desc')
                            ->get();
        };

    return view('admin.order.list',compact('order'));
    }

    // redirecting order code page
    function orderCodepage($orderCode){
        $orderList =OrderList::select('order_lists.*','users.name as user_name','products.image as product_image','products.name as product_name')
                            ->where("order_code","$orderCode")
                            ->leftJoin('users','order_lists.user_id','users.id')
                            ->leftJoin('products','order_lists.product_id','products.id')
                            ->get();
        // dd($orderList->toArray());
        $order = Order::select('orders.*','users.name as user_name')
                        ->where('orders.order_code',$orderCode)
                        ->leftJoin('users','orders.user_id','users.id')
                        ->first();
        // dd($order->toArray());
        return view('admin.order.code',compact('orderList','order'));
    }
    // orderstatus changing in each btn
    function orderStatusChange(Request $request){
        logger($request);
        Order::where('id',$request['orderId'])
            ->update([
                'status'=>$request['status']
            ]);
    }
}
