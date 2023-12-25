<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthManager extends Controller
{
    function login()
    {
        return view('login');
    }
    function registration()
    {
        return view('registration');
    }
    function loginPost(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);
        $credentials=$request->only('email', 'password');
        if(Auth::attempt($credentials)){
            return redirect()->intended(route('home'))->with('success','Login successful');
        }
        return redirect(route('login'))->with('error', 'Login deatails not match');
    }
    function registrationPost(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
        ]);

        $data['name']=$request->name;
        $data['email']=$request->email;
        $data['[password]']=$request->password;
        
    }
}
