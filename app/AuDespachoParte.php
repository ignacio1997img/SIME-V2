<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AuDespachoParte extends Model
{
    protected $fillable = ['fecha','parte', 'turno', 'cotidiano', 'combustible', 'estado', 'obsparte', 'chofer', 'registradorparte_id', 'despachodetalle_id'];

}
