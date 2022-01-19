<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdmArea extends Model
{
    protected $fillable = [
        'descripcion', 'empresa_id'
    ];

    public function empresa()
    {
        return $this->belongsTo('App\AdmEmpresa');
    }

    public function cargos_a()
    {
        return $this->hasMany('App\AdmCargo','area_id','id');
    }
    
}
