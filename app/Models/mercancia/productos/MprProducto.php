<?php

namespace App\Models\mercancia\productos;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MprProducto extends Model
{
    use HasFactory;

    protected $table = "mprproductos";

    const CREATED_AT = "fregistro";
    const UPDATED_AT = "factualizado";

    protected $guarded = [];
}
