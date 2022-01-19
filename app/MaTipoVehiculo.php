<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MaTipoVehiculo extends Model
{
    protected $fillable = ['descripcion'];


    public function vehiculos_tipo()
    {
        return $this->hasMany('App\MaVehiculo','tipo_id','id');
    }
}
