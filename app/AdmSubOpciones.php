<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdmSubOpciones extends Model
{
    protected $fillable = ['descripcion', 'opciones_id'];


    public function opcion()
    {
        return $this->belongsTo('App\AdmOpciones','opciones_id');
    }

    public function permisos()
    {
        return $this->hasMany('App\AdmPermiso','subopciones_id', 'id');
    }
    
}
