<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdmSubGrupo extends Model
{
    protected $fillable = ['grupo_id','descripcion'];

    public function grupo()
    {
        return $this->belongsTo('App\AdmGrupoEmpresa','grupo_id');
    }

    public function rubros()
    {
        return $this->hasMany('App\AdmRubro','subgrupo_id','id');
    }
}
