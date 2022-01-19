<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DocDocumentacion extends Model
{
    protected $fillable = ['interna', 'cargo_id', 'tipo', 'estado', 'de', 'de_fuera', 'fechacrear',
                            'fechaenvio','sigla', 'via', 'vb', 'referencia', 'user_id','tipodocumento'];

    public function movimientos()
    {
        return $this->hasMany('App\DocMovimientoDocumento','documento_id','id');
    }
}
