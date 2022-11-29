<?php

namespace App\Models\clientes;

use Illuminate\Foundation\Auth\User as Authenticatable;  
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class MclCliente extends Authenticatable
{
    use HasFactory;

    protected $table = "mclclientes";

    const CREATED_AT = "fregistro";
    const UPDATED_AT = "factualizado";

    public $guard = 'web';
    // protected $guarded = [];

    protected $fillable = [
        'login',
        'contrasenia',
        'persona',
        'estado',
        'fregistro',
        'factualizado',
    ];

    

    public function getAuthPassword(){
        return $this->contrasenia;
    }

    public function cliente(){
        return $this->belongsTo('App\Models\administracion\MadPersona', 'persona'); #if column not found indicate the column name
    }
}
