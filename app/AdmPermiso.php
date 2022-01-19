<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdmPermiso extends Model
{
    protected $table = 'permissions';
    protected $fillable = ['name', 'guard_name','descripcion','fk_id'];

    public function sub_opciones()
    {
        return $this->belongsTo('App\AdmSubOpciones','subopciones_id');
    }
}
