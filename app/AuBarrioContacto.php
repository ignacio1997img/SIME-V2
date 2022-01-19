<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AuBarrioContacto extends Model
{
    protected $fillable = ['barrio_id', 'contacto_id', 'observacion','activo'];
}
