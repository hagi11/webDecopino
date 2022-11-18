<?php

namespace App\Models\mercancia;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MprImagen extends Model
{
    use HasFactory;

    protected $table = "mprimagen";

    const CREATED_AT = "fregistro";
    const UPDATED_AT = "factualizado";

    protected $guarded = [];
}
