<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MaMarca extends Model
{
    protected $fillable = ['descripcion'];

    public function modelo_vehiculos()
    {
        return $this->hasMany('App\MaModeloVehiculo','marca_id','id');
    }


}
