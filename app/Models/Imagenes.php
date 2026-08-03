<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Imagenes extends Model
{
    protected $table = 'imagenes';

    function producto(){
        return  $this->belongsTo(Saprod::class, 'fk_producto','id');
    }
}

