<?php

namespace App\Models\carrito;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class mvecarrito extends Model
{
    use HasFactory;
    protected $table = "mvecarritos";

    const CREATED_AT = "fregistro";
    const UPDATED_AT = "factualizado";

    protected $guarded = [];
}
