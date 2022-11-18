<?php

namespace App\Models\mercancia\categorias;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MprSubCategoria extends Model
{
    use HasFactory;

    protected $table = "mprsucategorias";

    const CREATED_AT = "fregistro";
    const UPDATED_AT = "factualizado";

    protected $guarded = [];
}
