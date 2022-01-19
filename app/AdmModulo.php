<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdmModulo extends Model
{
    protected $fillable = ['nombre'];


    public function opciones()
    {
        return $this->hasMany('App\AdmOpciones','modulo_id', 'id');
    }
}
