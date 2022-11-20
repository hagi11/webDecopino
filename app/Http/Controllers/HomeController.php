<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\mercancia\MprBanner;

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
        $banners  = Mprbanner::select('mprbanners.id','mprbanners.nombre','mprbanners.descripcion', 'mprbanners.producto', 'mprbanners.combo','mprimagen.ruta')
        ->join('mprimagen','mprimagen.banner','mprbanners.id')
        ->where('mprbanners.estado',1)
        ->get();
        return view('home', compact('banners'));
    }

    public function indexAdmin()
    {
        return view('homeAdmin');
    }
}
