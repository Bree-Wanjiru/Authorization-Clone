<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthManager extends Controller
{
    //login
    function login(){
        if (Auth::check()){
            return redirect(route('home'));
        }
        return view('login');
    }

    //signup
    function signup(){
        if (Auth::check()){
            return redirect(route('home'));
        }
        return view('signup');
    }

    //for data passed in login form
    function loginPost(Request $request){
        $request->validate([
            //if not present,laravel will return error message automatically
            //email and password should be similar to the name in the login.blade.php
            'email' => 'required',
            'password' => 'required'
        ]);
        
        //actual login
        $credentials = $request->only('email','password');

        //the auth should be the one in the faccade folder
        if(Auth::attempt($credentials)){//does login automatically
          //when true
          return redirect()->intended(route('home'));
        }
        //false -show the error msg
        return redirect(route('login'))->with("error", "Login details are not valid");
    }    

    //for data passed in signup form
    function signupPost(Request $request){
        $request->validate([
            //if not present,laravel will return error message automatically
            //email and password should be similar to the name in the signup.blade.php
            'name' => 'required',
            'email' => 'required|email|unique:users',//checks if the email entered is valid and unique.Has an @
            'password' => 'required'
            
        ]);
        //access and assign
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['password'] = Hash::make($request->password);//to encrypt the password and ensure the hash is from illuminate\support\facades
        $user = User::create($data);

        //actual signup
        if(!$user){
            return redirect(route('signup'))->with("error", "Signup failed.Try again!!");
        }
        return redirect(route('login'))->with("success", "Signup successful.Login to access the website");
    }  

    //logging out
    function logout(){
        Session::flush();
        Auth::logout();
        return redirect(route('login'));
    }
}
