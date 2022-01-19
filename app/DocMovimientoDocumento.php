<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DocMovimientoDocumento extends Model
{
    protected $fillable = ['documento_id', 'cargo_id', 'de', 'de_fuera', 'dirigido', 'nota', 'fechahraenvio', 'fechahrarecibido' ,'fechahraposenvio',
            'fechaatrazo', 'entrada', 'pendiente', 'despachada' ,'recibido', 'estado', 'cabecera', 'user_id'];

    public function documento()
    {
        return $this->belongsTo('App\DocDocumentacion','documento_id');
    }
}
