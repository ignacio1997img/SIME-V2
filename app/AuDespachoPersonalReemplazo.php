<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AuDespachoPersonalReemplazo extends Model
{
    protected $fillable = ['reemplazando', 'reemplazado','despachoparte_id'];
}
