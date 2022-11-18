<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MprFechaUpdateContoller extends Controller
{

    public function fecha(){
        date_default_timezone_set('America/Bogota');
        $fechaHoy = date('Y-m-d h:i:s a', time());
        return $fechaHoy;
    }


}
