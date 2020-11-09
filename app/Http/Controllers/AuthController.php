<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class AuthController extends Controller
{
    public function login()
    {
        return view('Auth.Login');
    }

    public function postLogin(Request $request)
    {
        if(Auth::attempt($request->only('email','password'))){
            return redirect('/home');
        }

        return redirect('/');
    }
  
    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
