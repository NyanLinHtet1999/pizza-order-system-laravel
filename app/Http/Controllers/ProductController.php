<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    // redirect product list Page
    function list(){
        $products=Product::select('products.*','categories.name as category_name')
            ->when(request('key'),function($d){
            $searchKey=request('key');
            $d->where('products.name','like','%'.$searchKey.'%');
            })
            ->leftJoin('categories','products.category_id','categories.id')
            ->orderBy('products.id','desc')->paginate(4);
        return view('admin.product.list',compact('products'));
    }
    // // redirect create page
    function createPage(){
        $categories=Category::select('id','name')->get();
        return view('admin.product.create',compact('categories'));
    }
     // creation
    function create(Request $req){
        $this->createValidationCheck($req,'create');
        $data=$this->changeData($req);
        if($req->hasFile('image')){
            $fileName=uniqid().$req->file('image')->getClientOriginalName();
            $req->file('image')->storeAs('public',$fileName);
            $data['image']=$fileName;
        }
        date_default_timezone_set("Asia/Yangon");
        Product::create($data);
        return redirect()->route('product#list');
    }
    // // redirecting edit page
    function editPage($id){
        $categories=Category::select('id','name')->get();
        $product=Product::where('id','=',$id)->first();
        return view('admin.product.edit',compact('product','categories'));
    }
    // editing
    function edit(Request $req){
        $this->createValidationCheck($req,'edit');
        $data=$this->changeData($req);
        if($req->hasFile('image')){
            $id=$req->id;
            $oldImageName=Product::select('image')->where('id',$id)->first()->toArray();
            $oldImageName=$oldImageName['image'];
            Storage::delete('public/'.$oldImageName);
            $fileName=uniqid().$req->file('image')->getClientOriginalName();
            $req->file('image')->storeAs('public',$fileName);
            $data['image']=$fileName;
        }
        Product::where('id',$req->id)->update($data);
        return redirect()->route('product#list');
    }
    // // deleting
    function delete($id){
        $oldImageName=Product::select('image')->where('id',$id)->get()->toArray();
        $oldImageName=$oldImageName[0]['image'];
        Storage::delete('public/'.$oldImageName);
        Product::where ('id','=',$id)->delete();
        return back();
    }
    // redirecting detail page
    function detail($id){
        $product=Product::select('products.*','categories.name as category_name')
                ->leftJoin('categories','products.category_id','categories.id')
                ->where('products.id',$id)
                ->first();
        return view('admin.product.detail',compact('product'));
    }
    // // validation
    private function createValidationCheck($req,$action){
        $validationRules=[
            'name'=>'required|max:50|unique:products,name,'.$req->id,
            'category_id'=>'required',
            'description'=>'required',

            'price'=>'required|numeric',
            'waiting_time'=>'required|integer',
        ];
        $validationRules['image']= $action == "create" ? 'required|mimes:jpg,jpeg,png,webp' : 'mimes:jpg,jpeg,png,webp';
        Validator::make($req->all(),$validationRules)->validate();
    }
    // change data
    private function changeData($req){
        return [
            'name'=>$req->name,
            'category_id'=>$req->category_id,
            'description'=>$req->description,
            'price'=>$req->price,
            'waiting_time'=>$req->waiting_time,
        ];
    }
}
