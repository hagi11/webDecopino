<?php

namespace App\Models\usuarios;

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

    

    public function getAuthPassword(){
        return $this->contrasenia;
    }

    public function cliente(){
        return $this->belongsTo('App\Models\administracion\MadPersona', 'persona'); #if column not found indicate the column name
    }
}
