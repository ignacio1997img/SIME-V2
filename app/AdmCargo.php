<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdmCargo extends Model
{
    protected $fillable = ['codigo','nombre','sigla',
        'activo','observacion','area_id','tipocargo_id' ];

    public function tipocargo()
    {
        return $this->belongsTo('App\AdmTipoCargo','tipocargo_id');
    }
    public function area()
    {
        return $this->belongsTo('App\AdmArea','area_id');
    }

    public function cargos_funcionario()
    {
        return $this->hasMany('App\AdmFuncionarioCargo',' cargo','id');
    }





    public function reemplazos()
    {
        return $this->hasMany('App\AdmReemplazo','cargo_id','id');
    }


}
