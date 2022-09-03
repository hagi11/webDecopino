<?php

namespace App\Models\locaciones;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departamento extends Model
{
    use HasFactory;

    protected $table = "departamentos";

    const CREATED_AT = "fregistro";
    const UPDATED_AT = "factualizada";

    protected $guarded = [];
}
