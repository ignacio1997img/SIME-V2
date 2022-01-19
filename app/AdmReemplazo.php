<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdmReemplazo extends Model
{
    // protected $fillable = ['nombre', 'descripcion', 'activo', 'cargo_id'];
    protected $fillable = ['inicio', 'fin', 'fins','documento', 'observacion', 'a', 'activo','observacion','funcar_id','baja_id','cargo_id'];

//     public function cargo()
//     {
//         return $this->belongsTo('App\AdmCargo','cargo_id');
//     }
}
