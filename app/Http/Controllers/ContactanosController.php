<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\ContactenosMailable;
use Illuminate\Support\Facades\Mail;

class ContactanosController extends Controller
{
    public function index(){
        return view('inf_general.contactenos');

    }
    public function store(Request $request){
        $request -> validate([
            'name' => 'required',
            'email' => 'required|email',
            'asunto' => 'required',
            'message' => 'required',

        ]);

        $correo = new ContactenosMailable($request->all());
        
        Mail::to('cdss2911@gmail.com')->send($correo);
        return back()->with('info','Mensaje enviado');
    }
}
