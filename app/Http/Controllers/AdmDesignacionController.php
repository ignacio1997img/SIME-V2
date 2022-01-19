<?php

namespace App\Http\Controllers;

use App\AdmDesignacion;
use Illuminate\Http\Request;

class AdmDesignacionController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:rrhh-funcionario.designacion.store')->only('store');
    }

    protected function store(Request $request)
    {
        AdmDesignacion::create($request->all());

        toastr()->success( 'Registro Exitoso' , 'Información' , ["closeButton" => "true","progressBar" => "true" ]);
        return redirect()->route('rrhh-funcionario.designacion', $request->funcionario_id);
    }

    protected function update_designacion_corte(Request $request)
    {
        $request->merge(['activo' => 0]);
   
        $ok = AdmDesignacion::find($request->id);
        $ok->update($request->all());

        
        toastr()->success( 'Corte Exitoso' , 'Información' , ["closeButton" => "true","progressBar" => "true" ]);


        return redirect()->route('rrhh-funcionario.designacion', $request->funcionario_id);
    }



    
}
