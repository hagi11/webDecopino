<?php

namespace App\Models\mercancia\categorias;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MprCategoria extends Model
{
    use HasFactory;

    protected $table = "mprcategorias";

    const CREATED_AT = "fregistro";
    const UPDATED_AT = "factualizado";

    protected $guarded = [];
}
