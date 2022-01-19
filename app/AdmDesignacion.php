<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdmDesignacion extends Model
{
    protected $fillable = ['inicio', 'fin','fins','nombre', 'documento', 'observacion','funcionario_id','activo'];

    public function funcionario()
    {
        return $this->belongsTo('App\AdmFuncionario','funcionario_id');
    }


}
