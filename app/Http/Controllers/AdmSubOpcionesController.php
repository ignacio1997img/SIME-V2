<?php

namespace App\Http\Controllers;

use App\AdmSubOpciones;
use App\AdmModulo;
use App\AdmOpciones;

use Illuminate\Http\Request;

class AdmSubOpcionesController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:adm-subopcion.index')->only('index');
        $this->middleware('permission:adm-subopcion.store')->only('store');
    }

    protected function index()
    {
        $subs =  AdmSubOpciones::all();
        $modulos = AdmModulo::all();

        return view('Administracion.Sistema.indexSubOpciones', compact('subs','modulos'));
    }


    protected function store(Request $request)
    {
        AdmSubOpciones::create($request->all());
        toastr()->success( 'Registro Exitoso' , 'Información' , ["closeButton" => "true","progressBar" => "true" ]);
        return redirect()->route('subopciones.index');
    }

    protected function update_subopcion(Request $request)
    {
        $op = AdmSubOpciones::find($request->id);
        $op->update($request->all());
        toastr()->success( 'Registro Actualizado' , 'Información' , ["closeButton" => "true","progressBar" => "true" ]);
        return redirect()->route('subopciones.index');
    }

    protected function select_ajax_opciones($id)
    {
        return AdmOpciones::where('modulo_id',$id)->get();        
    }

   
}
