<?php

namespace App\Models\usuarios;

use App\Http\Controllers\administracion\musUsuarioController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class MusUsuario extends Authenticatable
{
    use HasFactory;

    protected $table = "mususuarios";

    const CREATED_AT = "fregistro";
    const UPDATED_AT = "factualizado";

    // protected $guarded = [];
    public $guard = 'usuarios';

    protected $fillable = [
        'login',
        'contrasenia',
        'persona',
    ];



    public function getAuthPassword()
    {
        return $this->contrasenia;
    }

    public function cliente()
    {
        return $this->belongsTo('App\Models\administracion\MadPersona', 'persona'); #if column not found indicate the column name
    }

    public function variables($num)
    {
        $ctru = new musUsuarioController();
        if ($num == 1) {
            return  $rol = $ctru->getRol();
        } elseif ($num == 2) {
            return $perInventario = $ctru->getPermisoInv();
        } else {
            return $perFactura = $ctru->getPermisoFac();
        }
    }
}
