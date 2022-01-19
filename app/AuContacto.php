<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AuContacto extends Model
{
    protected $fillable = ['nombrecompleto', 'direccion', 'telefono', 'referencia', 'distrito', 'barrio'];

}
