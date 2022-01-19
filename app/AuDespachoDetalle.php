<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AuDespachoDetalle extends Model
{
    protected $fillable =['fecha', 'despacho_id', 'ruta_id', 'vehiculo_id','activo'];

    public function despacho()
    {
        return $this->belongsTo('App\AuDespacho','despacho_id');
    }
    public function ruta()
    {
        return $this->belongsTo('App\AuRuta','ruta_id');
    }


    public function vehiculo()
    {
        return $this->belongsTo('App\MaVehiculo','vehiculo_id');
    }

}
