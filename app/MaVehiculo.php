<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MaVehiculo extends Model
{
    protected $fillable = ['interno', 'colorunidad', 'placa', 'motor', 'serieunidad', 'chasis', 'capacidadkg', 'capacidadm3',
                            'pesovehiculo', 'bascula', 'combustible', 'year', 'fechacompra', 'montocompra', 'estado', 'propiedad','tipo_id','modelo_id', 'empresa_id'];

    protected $primary_key = 'interno';

    public function modelo()
    {
        return $this->belongsTo('App\MaModeloVehiculo','modelo_id');
    }
    public function empresa()
    {
        return $this->belongsTo('App\AdmEmpresa','empresa_id');
    }

    public function tipo()
    {
        return $this->belongsTo('App\MaTipoVehiculo','tipo_id');
    }

    public function despachodetalles()
    {
        return $this->hasMany('App\AuDespachoDetalle','vehiculo_id','interno');
    }

}
