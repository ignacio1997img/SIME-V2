<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HyGlicemia extends Model
{
    protected $fillable = ['valor', 'funcionario_id', 'realizado'];

    public function funcionario()
    {
        return $this->belongsTo('App\AdmFuncionario','funcionario_id');
    }

}
