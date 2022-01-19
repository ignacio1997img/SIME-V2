<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdmRubro extends Model
{
    protected $fillable = ['subgrupo_id','descripcion'];

    public function subgrupo()
    {
        return $this->belongsTo('App\AdmSubGrupo','subgrupo_id');
    }

    public function empresas()
    {
        return $this->hasMany('App\AdmEmpresa','rubroempresa_id','id');
    }
}
