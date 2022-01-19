<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AuDistrito extends Model
{
    protected $fillable = ['descripcion'];
    public function barrios()
    {
        return $this->hasMany('App\AuBarrio','distrito_id','id');
    }
}
