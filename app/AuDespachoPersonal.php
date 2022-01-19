<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AuDespachoPersonal extends Model
{
    protected $fillable = ['cargo','nombre','estado', 'despachoparte_id'];
}
