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
                return redirect()->to('home');
            }
         else if (Auth::guard('web')->attempt($credentials)) {
                Auth::guard('web')->user();
                return redirect()->to('home');
            }
        
        
        return redirect()->to(route('login'));
    }
}
