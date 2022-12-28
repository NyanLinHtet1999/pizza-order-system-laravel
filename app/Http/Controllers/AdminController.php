<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    // redirect account profile
    function accountPage(){
        return view('admin.account.details');
    }
    // redirect account  editing page
    function accountEdit(){
        return view('admin.account.editProfile');
    }
    // updating profile update btn
    function accountUpdate(Request $req){
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
        return redirect()->route('admin#account');

    }
    // redirect change password page
    function changePage(){
        return view('admin.account.changePassword');
    }
    // changing password "change btn"
    function change(Request $req){
        $this->checkPasswordValidation($req);
        $userData=User::select('password')->where('id',Auth::user()->id)->first();
        $dbPassword=$userData->password;
        if(Hash::check($req->oldPassword, $dbPassword)){
            $data=[
                'password'=>Hash::make($req->newPassword)
            ];
            User::where('id',Auth::user()->id)->update($data);
            return redirect()->route("admins#changePage")->with(['changeSuccess'=>'Password has successfully changed!']);
        }
        else{
            return redirect()->route('admins#changePage')->with(['notMatch'=>'Wrong password. Try again!']);
        }

    }
        // account list
    function list(){
        $admins=User::when(request('key'),function($d){
                        $searchKey=request('key');
                        $d->orWhere('name','like','%'.$searchKey.'%')
                        ->where('role','admin')
                    ->orWhere('email','like','%'.$searchKey.'%')->where('role','admin')->orWhere('phone','like','%'.$searchKey.'%')->where('role','admin')->orWhere('gender','like','%'.$searchKey.'%')->where('role','admin')->orWhere('address','like','%'.$searchKey.'%')->where('role','admin');
                    })->
                    where('role','admin')->
                    paginate(3);
        return view('admin.account.list',compact('admins'));
    }

    //change admin to user
    function changeToUser($id,Request $req){
        // dd($req->all());
        $data=[
            'role'=>$req->role
        ];
        User::where('id',$id)->update($data);
        return back();
    }
    // admin account delete
    function delete($id){
        $oldImageName=User::select('image')
                            ->where('id',$id)
                            ->first();
        $oldImageName=$oldImageName->image;
        Storage::delete('public/'.$oldImageName);
        User::where('id',$id)->delete();
        return redirect()->route('admin#list')->with(['deleteSuccess'=>'Deleted account successfully!']);
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
    // redirecting users list
    function userList(){
        $users= User::when(request('key'),function($d){
            $searchKey=request('key');
            $d->orWhere('name','like','%'.$searchKey.'%')->orWhere('email','like','%'.$searchKey.'%')->orWhere('phone','like','%'.$searchKey.'%')->orWhere('gender','like','%'.$searchKey.'%')->orWhere('address','like','%'.$searchKey.'%');
        })->where('role','user')->get();
        return view('admin.user.list',compact('users'));
    }
    // changing user to admin
    function userToAdmin($id){
        User::where('id',$id)->update(['role'=>'admin']);
        return redirect()->route('admin#userList');
    }
    // user account delete
    function userDelete($id){
        User::where('id',$id)->delete();
        return redirect()->route('admin#userList')->with(['deleteSuccess'=>'Deleted account successfully!']);
    }
    // account validation
    private function accountValidation($req){
        $validationRules=[
            'name'=>'required|max:20',
            'email' => 'required|unique:users,email,'.$req->id,
            'address'=>'required|max:50',
            'gender'=>'required',
            'phone'=>'required|max:30',
            'image'=>'mimes:jpg,bmp,png'
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
}
