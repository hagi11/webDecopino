<?php

namespace App\Models\mercancia;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MprArticulo extends Model
{
    use HasFactory;

    protected $table = "mprarticulos";

    const CREATED_AT = "fregistro";
    const UPDATED_AT = "factualizado";

    protected $guarded = [];

    //

    // public function tparticulos(){
    //     return $this->belongsTo('App\Models\mercancia\MprtpArticulo');
    // }
    // public function marcas(){
    //     return $this->hasMany('App\Models\mercancia\MprMarca');
    // }
}
