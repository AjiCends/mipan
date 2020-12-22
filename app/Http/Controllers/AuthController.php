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
      //Cek validasi Registrasi
      $this->validate($request,[
        'email' => 'required',
        'password' => 'required'
      ],[
        //pesan validasi
        'email.required' => 'Harap mengisi email',
        'password.required' => 'Harap mengisi password'
      ]);

        if(Auth::attempt($request->only('email','password'))){
            return redirect('/home');
        }
        else {
          return redirect('/')->with('gagal','Email atau password yang anda masukkan tidak sesuai');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
