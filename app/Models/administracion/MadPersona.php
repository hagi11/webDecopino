<?php

namespace App\Models\administracion;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MadPersona extends Model
{
    use HasFactory;

    protected $table = "madpersonas";

    const CREATED_AT = "fregistro";
    const UPDATED_AT = "factualizado";

    protected $guarded = [];
}
