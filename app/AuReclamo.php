<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AuReclamo extends Model
{
    protected $fillable = ['numero','registrado','descripcion','fechareclamo','calle_id', 'contacto_id','atendido','fecharegistroatendido','fechaatendido','solucion','estado'];
}
