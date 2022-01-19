<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdmOpciones extends Model
{
    protected $fillable = ['descripcion', 'modulo_id'];

    public function modulo()
    {
        return $this->belongsTo('App\AdmModulo','modulo_id');
    }

    public function subopciones()
    {
        return $this->hasMany('App\AdmSubOpciones,','opciones_id', 'id');
    }
}
