<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AuReclamoReiteracion extends Model
{
    protected $fillable = ['observacion','observado', 'reclamo_id'];
}
