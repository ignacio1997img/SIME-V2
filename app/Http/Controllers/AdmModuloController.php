<?php

namespace App\Http\Controllers;

use App\AdmModulo;
use Illuminate\Http\Request;

class AdmModuloController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:adm-modulo.index')->only('index');
        $this->middleware('permission:adm-modulo.store')->only(['store']);
    }
    protected function index()
    {
        $modulos = AdmModulo::all();
        return view('Administracion.Sistema.indexModulo', compact('modulos'));
    }

    protected function store(Request $request)
    {
        AdmModulo::create($request->all());
        toastr()->success('Ha sido registrado con exito' , 'Información' , ["closeButton" => "true","progressBar" => "true" ]);
        return redirect()->route('modulo.index');
    }

    protected function update_modulo(Request $request)
    {
        $ok = AdmModulo::find($request->id);
        $ok->update($request->all());
        toastr()->success('Ha sido actualizado con exito' , 'Información' , ["closeButton" => "true","progressBar" => "true" ]);
        return redirect()->route('modulo.index');
    }


}
