<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AuBarridoPersonalReemplazo extends Model
{
    protected $fillable = ['reemplazando', 'reemplazado','despachodetalle_id'];
}
