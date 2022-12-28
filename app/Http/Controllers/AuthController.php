<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    // registeration
    function registeration(){
        return view('register');
    }
    // loging in
    function logingin(){
        return view('login');
    }
    // redirect admin or user
    function dashboard(){
        if(Auth::user()->role=='admin'){
            return redirect()->route('category#list');
        }else{
            return redirect()->route('user#home');
        }
    }
}
