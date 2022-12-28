<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    // redirecting contact page
    function contactPage(){
        return view('user.contact.form');
    }
    // contact send btn
    function sendBtn(Request $req){
        $userName = Auth::user()->name;
        $userEmail = Auth::user()->email;
        $userMessage= $req->message;
        $this->validateContact($req);
        Contact::create([
            'name' => $userName,
            'email' => $userEmail,
            'message' => $userMessage
        ]);
        return redirect()->route('user#contactPage')->with(['sendSuccess'=>'Sended message successfully!']);
    }
    // redirecting contact page
    function listPage(){
        $message = Contact::orderBy('created_at','desc')
                            ->get();
        return view('admin.contact.list',compact('message'));
    }
    function seeMore(Request $request){
        $message = Contact::select('message')->where('id',$request['id'])->first();
        return response()->json($message, 200);
    }
    // validation for contact
    private function validateContact($req){
        $validationRules=[
            'message'=>'required'
        ];
        Validator::make($req->all(),$validationRules)->validate();
    }
}
