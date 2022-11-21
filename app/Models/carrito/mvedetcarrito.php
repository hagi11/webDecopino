<?php

namespace App\Models\carrito;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class mvedetcarrito extends Model
{
    use HasFactory;
    protected $table = "mvedetcarritos";

    const CREATED_AT = "fregistro";
    const UPDATED_AT = "factualizado";

    protected $guarded = [];
}
