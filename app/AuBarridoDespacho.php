<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AuBarridoDespacho extends Model
{
    protected $fillable = ['fecha', 'estado', 'observacion'];
}
