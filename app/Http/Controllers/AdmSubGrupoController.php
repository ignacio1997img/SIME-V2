<?php

namespace App\Http\Controllers;

use App\AdmSubGrupo;
use App\AdmGrupoEmpresa;

use Illuminate\Http\Request;

class AdmSubGrupoController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:adm-subgrupo.index')->only('index');
        $this->middleware('permission:adm-subgrupo.store')->only(['store']);
    }

    public function index()
    {
        $grupos = AdmGrupoEmpresa::all();
        $subgrupos = AdmSubGrupo::all();   
        return view('Administracion.Empresa.indexSubGrupo', compact('subgrupos','grupos'));
    }
    public function store(Request $request)
    {
        AdmSubGrupo::create($request->all());
        toastr()->success('Ha sido registrado con exito' , 'Información' , ["closeButton" => "true","progressBar" => "true" ]);
        return redirect()->route('subgrupo.index');
    }

    public function update_subgrupo(Request $request)
    {
        AdmSubGrupo::where('id', $request->id)
            ->update(['grupo_id' => $request->grupo_id ,'descripcion' => $request->descripcion]);
        toastr()->success('Ha sido actualizado con exito' , 'Información' , ["closeButton" => "true","progressBar" => "true" ]);
        return redirect()->route('subgrupo.index');
    }

    
}
