<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    
    public function login(){

        return view("auth.login");
    }

    public function dologin(LoginRequest $request){

        $credentials = $request->validated();
         if(Auth::attempt($credentials)){
            $request->session()->regenerate();
            return redirect()->intended(route('blog.index'));
         }
         return to_route( 'auth.login')->withErrors([
            'email' => "l'email ou le mot de passe est invalid",
            'password'=>"l'email ou le mot de passe est invalid"
         ])->onlyInput('email');
    }

    public function logout(){
        Auth::logout();
        return to_route('auth.login');
    }
}
