<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdmPerfil extends Model
{
    protected $table = 'roles';

    protected $fillable = ['name', 'guard_name'];

    
}
