<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdmBajaFun extends Model
{
    protected $fillable = ['inicio', 'fin', 'documento', 'observacion', 'tipo','activo','funcar_id'];
}
