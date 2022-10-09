<?php

namespace App\Models\mercancia\proveedores;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MprProveedor extends Model
{
    use HasFactory;

    protected $table = "mprproveedores";

    const CREATED_AT = "fregistro";
    const UPDATED_AT = "factualizado";

    protected $guarded = [];
}
