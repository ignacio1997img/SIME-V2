<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AuParteMovimiento extends Model
{
    protected $fillable = ['fsalida', 'hsalida', 'fllegada', 'hllegada', 'kmsalida', 'kmllegada', 'despachoparte_id'];

}
