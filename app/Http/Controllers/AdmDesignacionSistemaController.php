<?php

namespace App\Http\Controllers;

use App\AdmDesignacionSistema;
use Illuminate\Http\Request;

class AdmDesignacionSistemaController extends Controller
{
    public function __construct()
    {
        // $this->middleware('permission:adm-grupoempresa.index')->only('index');
        // $this->middleware('permission:adm-grupoempresa.store')->only('store');
    }

    protected function index()
    {

        $designacion = AdmDesignacionSistema::Designacion();


        return view('Administracion.Sistema.indexDesignacion', compact('designacion'));
    }

    protected function store(Request $request)
    {
        AdmDesignacionSistema::create($request->all());
        toastr()->success('Ha sido registrado con exito' , 'Información' , ["closeButton" => "true","progressBar" => "true" ]);
        return redirect()->route('designacionsistema.index');
    }
}
