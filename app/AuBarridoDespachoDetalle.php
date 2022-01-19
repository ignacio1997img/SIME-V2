<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AuBarridoDespachoDetalle extends Model
{
    protected $fillable =['fecha', 'despacho_id','turno', 'ruta_id','activo'];
}
