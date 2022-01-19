<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AuDistritoContacto extends Model
{
    protected $fillable = ['distrito_id', 'contacto_id', 'observacion', 'activo'];
}
