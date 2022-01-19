<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdmPersona extends Model
{
    protected $fillable = ['ci', 'expedido','nombre','apellidopaterno',
        'apellidomaterno','apellidoesposo','sexo','direccion','telefono',
        'fechanacimiento', 'correo', 'activa', 'asignada'
    ];

    public function funcionarios()
    {
        return $this->hasOne('App\AdmFuncionario');
    }
    public function nombrecompleto()
    { 
        return $this->nombre.' '.$this->apellidopaterno. ' '. $this->apellidomaterno;
    }
    public function cicompleto()
    {
        return $this->ci.' '. $this->expedido;
    }

    
}
