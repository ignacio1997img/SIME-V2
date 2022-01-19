<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdmFuncionarioCargo extends Model
{
    protected $fillable = ['funcionario_id','cargo_id','inicio','detalle','fin',
                            'observacion','activo'];

    public function funcionario()
    {
        return $this->belongsTo('App\AdmFuncionario','funcionario_id');
    }

    public function designaciones()
    {
        return $this->hasMany('App\AdmDesignacion','funcionario_id','id');
    }
    
}
