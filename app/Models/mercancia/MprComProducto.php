<?php

namespace App\Models\mercancia;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MprComProducto extends Model
{
    use HasFactory;

    protected $table = "mprcomproductos";

    const CREATED_AT = "fregistro";
    const UPDATED_AT = "factualizado";

    protected $guarded = [];
}
