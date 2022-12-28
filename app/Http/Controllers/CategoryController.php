<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\CategoryController;

class CategoryController extends Controller
{
    // List page
    function list(){
        $categories=Category::when(request('key'),function($d){
            $searchKey=request('key');
            $d->where('name','like','%'.$searchKey.'%');
        })->orderBy('id','desc')->paginate(4);
        return view('admin.category.list',compact('categories'));
    }
    // create Page
    function createPage(){
        return view('admin.category.create');
    }
    // creation
    function create(Request $req){
        $this->createValidationCheck($req);
        $data=$this->changeData($req);
        date_default_timezone_set("Asia/Yangon");
        Category::create($data);
        return redirect()->route('category#list');
    }
    // deleting
    function delete($id){
        Category::where('id','=',$id)->delete();
        return redirect()->route('category#list')->with(['deleteSuccess'=>'Successfully deleted']);
    }
    // editing
    function edit($id){
        $category=Category::where('id',$id)->first();
        return view('admin.category.edit',compact('category'));
    }
    //updating
    function update(Request $req){
        $this->createValidationCheck($req);
        $data=$this->changeData($req);
        date_default_timezone_set("Asia/Yangon");
        Category::where('id','=',$req->id)->update($data);
        return redirect()->route("category#list");

    }
    // validation check for create and update
    private function createValidationCheck($req){
        $validationRules=[
            'name'=>'required|unique:categories,name,'.$req->id,
        ];
        Validator::make($req->all(),$validationRules)->validate();
    }
    // data change for create
    private function changeData($req){
        return[
            'name'=>$req->name,
        ];
    }

}
