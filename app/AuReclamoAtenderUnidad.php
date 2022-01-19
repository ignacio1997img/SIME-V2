<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AuReclamoAtenderUnidad extends Model
{
    protected $fillable =  ['vehiculo', 'funcionario', 'reclamo_id'];
}
