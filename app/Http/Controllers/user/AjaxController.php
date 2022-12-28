<?php

namespace App\Http\Controllers\user;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderList;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AjaxController extends Controller
{
    function pizzaList(Request $request){
        if($request->status == 'desc'){
            $data=Product::orderBy('created_at','desc')->get();
        }else{
            $data=Product::orderBy('created_at','asc')->get();
        }
        return $data;
    }
    function pizzaOrderInfo(Request $request){
        $data = $this->getOrderData($request);
        Cart::create($data);
        $response =[
            'message' => 'Add to Cart complete',
            'status' => 'Success'
        ];
        return response()->json($response, 200);
    }
    function orderList(Request $request){
        foreach($request->all() as $item){
            $data=$this->getOrderList($item);
            OrderList::create($data);
        };

        Cart::where('user_id',Auth::user()->id)->delete();
        foreach($request->all() as $item2){
            $orderData= $this->getOrder($item2);
        };
        Order::create($orderData);
        $response =[
            'message' => 'Add to orderList complete',
            'status' => 'Success'
        ];
        return response()->json($response, 200);

    }
    // for single remove btn
    function singleRemove(Request $request){
        // logger($request['cartId']);
        Cart::where('id',$request['cartId'])->delete();
        $response =[
            'message' => 'Deleted from cart!'
        ];
        return response()->json($response, 200);
    }
    // for all remove btn
    function allRemove(Request $request){
        // logger($request['userId']);
        Cart::where('user_id',$request['userId'])
            ->delete();
    }
    // view counting
    function viewCount(Request $request){
        Product::where('id',$request['productId'])
            ->update([
                'view_count' => $request['viewCount']+1
            ]);
    }
    // data change to add order
    private function getOrder($item2){
        return[
            'user_id' =>$item2['userId'],
            'order_code' =>$item2['orderCode'],
            'total_price' =>$item2['final']
        ];
    }
    //data change to add orderList
    private function getOrderList($item){
   return[
            'user_id' => $item['userId'],
            'product_id' => $item['productId'],
            'qty' => $item['qty'],
            'total' => $item['total'],
            'order_code' => $item['orderCode'],
        ];
    }
    // data change to add cart
    private function getOrderData($request){
       return [
            'user_id' => $request->userId,
            'product_id' => $request->productId,
            'qty' => $request->qty
        ];
    }
}
