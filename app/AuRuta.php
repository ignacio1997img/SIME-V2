<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AuRuta extends Model
{
    protected $fillable = ['descripcion', 'turno','urlimg', 'tipo_id', 'zona_id'];

    public function zona()
    {
        return $this->belongsTo('App\AuZona','zona_id');
    }

    public function detalledespachos()
    {
        return $this->hasMany('App\AuDespachoDetalle','ruta_id','id');
    }
}
