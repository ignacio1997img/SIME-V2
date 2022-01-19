<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdmFuncionario extends Model
{
    protected $fillable = ['fechaingreso', 'activo','persona_id'];

    public function persona()
    {
        return $this->belongsTo('App\AdmPersona');
    }

    public function usuarios()
    {
        return $this->hasOne('App\User');
    }

    public function funcionariocargos()
    {
        return $this->hasMany('App\AdmFuncionarioCargo','funcionario_id','id');
    }











    public function glicemias()
    {
        return $this->hasMany('App\HyGlicemia','funcionario_id','id');
    }
}
