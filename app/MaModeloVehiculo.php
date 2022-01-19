<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MaModeloVehiculo extends Model
{
    protected $fillable = ['marca_id','descripcion'];

    public function marca()
    {
        return $this->belongsTo('App\MaMarca','marca_id');
    }

    public function vehiculos()
    {
        return $this->hasMany('App\MaVehiculo','modelo_id','id');
    }
}
