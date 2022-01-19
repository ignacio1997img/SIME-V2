<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AuBarridoRuta extends Model
{
    protected $fillable = ['nombre','descripcion', 'inicio', 'fin','urlimg'];
}
