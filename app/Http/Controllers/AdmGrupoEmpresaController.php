<?php

namespace App\Http\Controllers;

use App\AdmGrupoEmpresa;
use App\AdmDesignacion;
use Carbon\Carbon;

use Illuminate\Http\Request;

class AdmGrupoEmpresaController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:adm-grupoempresa.index')->only('index');
        $this->middleware('permission:adm-grupoempresa.store')->only('store');
    }

    protected function index()
    {
        $grupos = AdmGrupoEmpresa::all();
        return view('Administracion.Empresa.indexGrupo', compact('grupos'));
    }


    protected function store(Request $request)
    {
        AdmGrupoEmpresa::create($request->all());
        toastr()->success('Ha sido registrado con exito' , 'Información' , ["closeButton" => "true","progressBar" => "true" ]);
        return redirect()->route('grupoempresa.index');
    }

    protected function update_grupo(Request $request)
    {
        AdmGrupoEmpresa::where('id', $request->id)
            ->update(['nombre'=> $request->nombre]);
        toastr()->success('Ha sido actualizado con exito' , 'Información' , ["closeButton" => "true","progressBar" => "true" ]);
        return redirect()->route('grupoempresa.index');
    }
}
