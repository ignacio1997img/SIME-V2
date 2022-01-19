<?php

namespace App\Http\Controllers;

use App\AdmRubro;
use App\AdmSubGrupo;
use App\AdmGrupoEmpresa;


use Illuminate\Http\Request;

class AdmRubroController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:adm-rubro.index')->only('index');
        $this->middleware('permission:adm-rubro.store')->only(['store']);
    }

    public function index()
    {
        $grupos = AdmGrupoEmpresa::all();
        $subgrupos = AdmSubGrupo::all();
        $rubros = AdmRubro::all();
        return view('Administracion.Empresa.indexRubro', compact('subgrupos', 'grupos', 'rubros'));
    }

    public function store(Request $request)
    {
        AdmRubro::create($request->all());
        toastr()->success('Ha sido registrado con exito' , 'Información' , ["closeButton" => "true","progressBar" => "true" ]);
        return redirect()->route('rubro.index');
    }

    public function update_rubro(Request $request)
    {
        AdmRubro::where('id', $request->id)
            ->update(['subgrupo_id' => $request->subgrupo_id ,'descripcion' => $request->descripcion]);
        toastr()->success('Ha sido actualizado con exito' , 'Información' , ["closeButton" => "true","progressBar" => "true" ]);
        return redirect()->route('rubro.index');
    }

    


// ________________________________________ PETICIONES AJAX ______________________________
    public function selectsubgrupo($id)
    {
        $sub = AdmSubGrupo::where('grupo_id',$id)->get();
        return $sub;
    }
// ________________________________________ FIN PETICIONES AJAX ______________________________
}
