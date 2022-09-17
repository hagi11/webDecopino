<?php

namespace App\Models\mercancia;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MprArticulo extends Model
{
    use HasFactory;

    protected $table = "mprarticulos";

    const CREATED_AT = "fregistro";
    const UPDATED_AT = "factualizado";

    protected $guarded = [];
}
