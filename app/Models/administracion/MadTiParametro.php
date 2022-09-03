<?php

namespace App\Models\administracion;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MadTiParametro extends Model
{
    use HasFactory;

    protected $table = "madtiparametros";

    const CREATED_AT = "fregistro";
    const UPDATED_AT = "factualizada";

    protected $guarded = [];
}
