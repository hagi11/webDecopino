<?php

namespace App\Http\Controllers;


use App\Models\administracion\MadRoles;
use App\Models\administracion\MadUsuarioRoles;
use App\Models\mercancia\MprBanner;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

        // $this->middleware(['auth'=> 'auth:web,usuarios']);

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $banners  = Mprbanner::select('mprbanners.id', 'mprbanners.nombre', 'mprbanners.descripcion', 'mprbanners.producto', 'mprbanners.combo', 'mprimagen.ruta')
            ->join('mprimagen', 'mprimagen.banner', 'mprbanners.id')
            ->where('mprbanners.estado', 1)
            ->get();
        return view('home', compact('banners'));
    }

    public function indexAdmin()
    {
        if (Auth::guard('usuarios')->user()) {
            $rolUsuario = MadUsuarioRoles::select('rol')->where('usuario', Auth::guard('usuarios')->user()->id)->first();
            $rol = MadRoles::all()->where('estado', 1)->where('id', $rolUsuario->rol)->first();
            return view('homeAdmin');
        } else {
            return redirect()->route('home');
        }
    }

    


}
