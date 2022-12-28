<?php

namespace App\Http\Controllers\user;

use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    // redirect home page
    function home(){
        $products=Product::get();
        $categories=Category::get();
        $carts=Cart::where('user_id',Auth::user()->id)->get();
        $history = Order::where('user_id',Auth::user()->id)->get();
        return view('user.main.home',compact('products','categories','carts','history'));
    }
    // redirect password changing page
    function passwordPage(){
        return view('user.account.changePassword');
    }
    // changing password
    function changePassword(Request $req){
        $this->checkPasswordValidation($req);
        $userData=User::select('password')->where('id',Auth::user()->id)->first();
        $dbPassword=$userData->password;
        if(Hash::check($req->oldPassword, $dbPassword)){
            $data=[
                'password'=>Hash::make($req->newPassword)
            ];
            User::where('id',Auth::user()->id)->update($data);
            return redirect()->route("user#passwordchangePage")->with(['changeSuccess'=>'Password has successfully changed!']);
        }
        else{
            return redirect()->route('user#passwordchangePage')->with(['notMatch'=>'Wrong password. Try again!']);
        }

    }
    // redirect edit profile page
    function editProfilePage(){
        return view('user.account.editProfile');
    }
    // edit profie
    function editProfile(Request $req){
        $this->accountValidation($req);
        $data=$this->changeData($req);
        if($req->hasFile('image')){
            $oldImageName=Auth::user()->image;
            Storage::delete('public/'.$oldImageName);
            $fileName=uniqid().$req->file('image')->getClientOriginalName();
            $req->file('image')->storeAs('public',$fileName);
            $data['image']=$fileName;
        }
        User::where('id',Auth::user()->id)->update($data);
        return redirect()->route('user#home');
    }
    // filter
    function pizzaFilter($id){
        $products=Product::where('category_id',$id)
                            ->orderBy('products.created_at','desc')
                            ->get();
        $categories=Category::get();
        $carts=Cart::where('user_id',Auth::user()->id)->get();
        $history = Order::where('user_id',Auth::user()->id)->get();
        return view('user.main.home',compact('products','categories','carts','history'));
    }
    // detail
    function pizzaDetail($id){
        $product=Product::where('id',$id)->first();
        $pizzaList=Product::get();
        return view('user.main.detail',compact('product','pizzaList'));
    }
    // redirect history page
    function historyPage(){
        $history = Order::where('user_id',Auth::user()->id)->orderBy('created_at','desc')->paginate(6);
        return view('user.main.history',compact('history'));
    }
     // account validation
     private function accountValidation($req){
        $validationRules=[
            'name'=>'required|max:20',
            'email'=>'required|max:30',
            'address'=>'required|max:50',
            'gender'=>'required',
            'phone'=>'required|max:30',
            'image'=>'mimes:jpg,bmp,png,webp'
        ];
        Validator::make($req->all(),$validationRules)->validate();
    }
    // account data  change
    private function changeData($req){
        return [
            'name'=>$req->name,
            'email'=>$req->email,
            'address'=>$req->address,
            'phone'=>$req->phone,
            'gender'=>$req->gender
        ];
    }
     // password validation
     private function checkPasswordValidation($req){
        $validationRules=[
            'oldPassword'=>'required',
            'newPassword'=>'required|min:6|max:15',
            'confirmedPassword'=>'required|same:newPassword',
        ];
        Validator::make($req->all(),$validationRules)->validate();
    }
}
