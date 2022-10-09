<?php

namespace App\Models\mercancia;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MprLinea extends Model
{
    use HasFactory;

    protected $table = "mprlineas";

    const CREATED_AT = "fregistro";
    const UPDATED_AT = "factualizado";

    protected $guarded = [];
}
