<?php

namespace App\Http\Controllers\administracion;

use App\Http\Controllers\Controller;
use App\Models\administracion\MadRoles;
use App\Models\administracion\MadRolRecursos;
use App\Models\administracion\MadUsuarioRoles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class musUsuarioController extends Controller
{

    public function getPermisos($per)
    {
        if (Auth::guard('usuarios')->user()) {
            $rolUsuario = MadUsuarioRoles::select('rol')->where('usuario', Auth::guard('usuarios')->user()->id)->where('estado',1)->first();
            $rol = MadRoles::all()->where('estado', 1)->where('id', $rolUsuario->rol)->first();
            $rolPermisos = MadRolRecursos::select('crear', 'leer', 'editar', 'mostrar', 'eliminar')->where('estado', 1)->where('recurso', $per)->where('rol', $rol->id)->get();
            return $rolPermisos;
        }
    }

    public function getRol()
    {
        if (Auth::guard('usuarios')->user()) {
            $rolUsuario = MadUsuarioRoles::select('rol')->where('usuario', Auth::guard('usuarios')->user()->id)->first();
            $rol = MadRoles::all()->where('estado', 1)->where('id', $rolUsuario->rol)->first();
            return $rol;
        }
    }
    public function getPermisoInv()
    {
        if (Auth::guard('usuarios')->user()) {
            $ctrh = new musUsuarioController();
            $rolPermisos = $ctrh->getPermisos(1);
            return $rolPermisos[0];
        }
    }

    public function getPermisoFac()
    {
        if (Auth::guard('usuarios')->user()) {
            $ctrh = new musUsuarioController();
            $rolPermisos = $ctrh->getPermisos(6);
            return $rolPermisos[0];
        }
    }
}
