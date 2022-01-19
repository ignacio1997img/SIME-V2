<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AuBarridoPersonal extends Model
{
    protected $fillable = ['cargo','nombre','estado','despachodetalle_id'];
}
