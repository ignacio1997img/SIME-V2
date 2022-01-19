<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdmGrupoEmpresa extends Model
{
    protected $fillable = ['nombre'];

    public function subgrupos()
    {
        return $this->hasMany('App\AdmSubGrupo','grupo_id','id');
    }
}
