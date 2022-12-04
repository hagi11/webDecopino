<?php

namespace App\Models\facturas;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MveComprobantes extends Model
{
    use HasFactory;

    protected $table = "mvecomprobantes";

    const CREATED_AT = "fregistro";
    const UPDATED_AT = "factualizado";

    protected $guarded = [];
}
