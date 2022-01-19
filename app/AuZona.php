<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AuZona extends Model
{
    protected $fillable = ['nombre'];

    public function rutas()
    {
        return $this->hasMany('App\AuRuta','zona_id','id');
    }
}
