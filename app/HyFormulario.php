<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HyFormulario extends Model
{
    protected $fillable =  ['fecha', 'descripcion', 'numero', 'nombre', 'url'];


    public function scopePdf($query,$id)
    {
        return $query->where('id',$id)->first();
    }
}
