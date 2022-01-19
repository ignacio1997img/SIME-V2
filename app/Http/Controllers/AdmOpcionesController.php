<?php

namespace App\Http\Controllers;

use App\AdmOpciones;
use App\AdmModulo;
use Illuminate\Http\Request;

class AdmOpcionesController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:adm-opcion.index')->only('index');
        $this->middleware('permission:adm-opcion.store')->only('store');
    }

    protected function index()
    {

        $opciones = AdmOpciones::all();
        $modulos = AdmModulo::all();

        return view('Administracion.Sistema.indexOpciones', compact('opciones','modulos'));
    }
   
    protected function store(Request $request)
    {
        AdmOpciones::create($request->all());
        toastr()->success( 'Registro Exitoso' , 'Información' , ["closeButton" => "true","progressBar" => "true" ]);
        return redirect()->route('opciones.index');
    }

    protected function update_opcion(Request $request)
    {
        $op = AdmOpciones::find($request->id);
        $op->update($request->all());
        toastr()->success( 'Registro Actualizado' , 'Información' , ["closeButton" => "true","progressBar" => "true" ]);
        return redirect()->route('opciones.index');
    }

    
}
