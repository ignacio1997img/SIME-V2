<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AuDespachoPesoTotal extends Model
{
    protected $fillable = ['peso','viaje','despachoparte_id'];
}
