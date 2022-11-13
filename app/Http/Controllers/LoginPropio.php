<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class LoginPropio extends Controller
{
    public function authenticate(Request $request)
    {
        $credentials = $request->only('login', 'password');
       
            if (Auth::guard('usuarios')->attempt($credentials)) {
                Auth::guard('usuarios')->user();
            //  dd(Auth::guard('usuarios')->user()->cliente->apellido);
            //     session_start();
            //     $_SESSION["usuario"]= Auth::user();
                return redirect()->to('homeAdmin');
            }
            else if (Auth::guard('web')->attempt($credentials)) {
                Auth::guard('web')->user();
                // session_start();
                // $_SESSION["usuario"]= Auth::user();
                return redirect()->to('home');
            }
        
        
        return redirect()->to(route('login'));
    }
}
