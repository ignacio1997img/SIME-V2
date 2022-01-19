<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdmEmpresa extends Model
{
    protected $fillable = [
        'rubroempresa_id','nit', 'razonsocial','direccion','telempresa',
        'emailempresa','contacto','telefonocontacto','emailcontacto','personal','vehiculo','activa','sigla'
    ];

    public function rubro()
    {
        return $this->belongsTo('App\AdmRubro','rubroempresa_id');
    }

    public function areas()
    {
        return $this->hasMany('App\AdmArea');
    }


}
