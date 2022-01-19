<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AuBarrio extends Model
{
    protected $fillable = ['descripcion','distrito_id' ];
    
    public function distrito()
    {
        return $this->belongsTo('App\AuDistrito','distrito_id');
    }
}
