<?php

namespace App\Http\Controllers;

use App\AdmTipoDocumento;
use Illuminate\Http\Request;

class AdmTipoDocumentoController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:adm-tipodocumento.index')->only('index');
        $this->middleware('permission:adm-tipodocumento.store')->only('store');
    }


    protected function index()
    {
        $tipos = AdmTipoDocumento::all();
        return view('Administracion.Documentacion.indexDocumentacion', compact('tipos'));
    }


    
    protected function store(Request $request)
    {
        AdmTipoDocumento::create($request->all());
        toastr()->success('Ha sido registrado con exito' , 'Información' , ["closeButton" => "true","progressBar" => "true" ]);
        return redirect()->route('tipo_doc.index');
    }

    protected function update_tiposdoc(Request $request) 
    {
        AdmTipoDocumento::where('id', $request->id)
            ->update(['descripcion'=> $request->descripcion]);
        toastr()->success('Ha sido actualizado con exito' , 'Información' , ["closeButton" => "true","progressBar" => "true" ]);
        return redirect()->route('tipo_doc.index');
    }
}
