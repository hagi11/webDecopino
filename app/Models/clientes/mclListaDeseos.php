<?php

namespace App\Models\clientes;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class mclListaDeseos extends Model
{
    use HasFactory;
    protected $table = "mcllistadeseos";

    const CREATED_AT = "fregistro";
    const UPDATED_AT = "factualizado";

    protected $guarded = [];
}
