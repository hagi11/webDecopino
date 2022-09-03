<?php

namespace App\Models\administracion;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MadSesion extends Model
{
    use HasFactory;

    protected $table = "madsesion";

    const CREATED_AT = "fregistro";
    const UPDATED_AT = "factualizado";

    protected $guarded = [];
}
