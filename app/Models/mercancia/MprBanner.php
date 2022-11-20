<?php

namespace App\Models\mercancia;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MprBanner extends Model
{
    use HasFactory;

    protected $table = "mprbanners";

    const CREATED_AT = "fregistro";
    const UPDATED_AT = "factualizado";

    protected $guarded = [];

    public function producto(){
        return $this->belongsTo('App\Models\Mprproducto');
    }
}
