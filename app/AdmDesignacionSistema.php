<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdmDesignacionSistema extends Model
{
    protected $fillable = ['descripcion'];

    public function scopeDesignacion($query)
    {
        return $query->get();
    }
}
