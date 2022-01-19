<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AuCalle extends Model
{
    protected $fillable = ['calle', 'descripcion', 'barrio_id'];
}
