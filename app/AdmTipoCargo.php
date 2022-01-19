<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdmTipoCargo extends Model
{
    protected $fillable = ['descripcion'];

    public function cargos_t()
    {
        return $this->hasMany('App\AdmCargo','tipocargo_id','id');
    }




}
