<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AuDespacho extends Model
{
    protected $fillable = ['fecha', 'estado', 'observacion'];


    public function despachodetalles()
    {
        return $this->hasMany('App\AuDespachoDetalle','despacho_id','id');
    }
}
