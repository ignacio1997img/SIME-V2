<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AuDespachoCombustible extends Model
{
    protected $fillable =  ['factura','orden','boleta', 'contrato','litro','bs','despachodetalle_id'];
}
