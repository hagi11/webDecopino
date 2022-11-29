<?php

namespace App\Models\facturas;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MveDetFacturas extends Model
{
    use HasFactory;

    protected $table = "mvedetfacturas";

    const CREATED_AT = "fregistro";
    const UPDATED_AT = "factualizado";

    protected $guarded = [];
}
