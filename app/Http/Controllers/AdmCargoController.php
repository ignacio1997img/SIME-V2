<?php

namespace App\Http\Controllers;

use App\AdmCargo;
use App\AdmArea;
use App\AdmTipoCargo;
use App\AdmEmpresa;
use App\AdmGrupoEmpresa;
use Illuminate\Http\Request;

class AdmCargoController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:rrhh-cargo.index')->only('index');
        $this->middleware('permission:rrhh-cargo.store')->only('store');
    }

    protected function index()
    {
        $cargos = AdmCargo::all();
        $tipos = AdmTipoCargo::all();
        $empresas = AdmEmpresa::where('personal',1)->get();

        return view('RecursosHumanos.Estructuraempresa.indexCargo', compact('cargos','tipos','empresas'));
    }

    protected function store(Request $request)
    {
        $cod = AdmGrupoEmpresa::select('adm_grupo_empresas.id as grupo', 'sb.id as sub', 'r.id as rubro', 'e.id as empresa', 'a.id as area')
            ->join('adm_sub_grupos as sb', 'sb.grupo_id', 'adm_grupo_empresas.id')
            ->join('adm_rubros as r', 'r.subgrupo_id', 'sb.id')
            ->join('adm_empresas as e', 'e.rubroempresa_id', 'r.id')
            ->join('adm_areas as a', 'a.empresa_id', 'e.id')
        ->where('a.id', $request->area_id)->get();
        
        $suma = AdmCargo::where('area_id',$request->area_id)
            ->count('*');
        $suma++;

        $codigo = $cod[0]->grupo.$cod[0]->sub.$cod[0]->rubro.$cod[0]->empresa.$cod[0]->area.$suma;

        $request->merge(['codigo' => $codigo]);

// 
        

        AdmCargo::create($request->all());
        toastr()->success('Ha sido registrado con exito' , 'Información' , ["closeButton" => "true","progressBar" => "true" ]);
        return redirect()->route('cargo.index');
    }


    protected function update_cargo(Request $request)
    {
        $act = AdmCargo::find($request->id);
        $act->update($request->all());


        toastr()->success('Ha sido actualizado con exito' , 'Información' , ["closeButton" => "true","progressBar" => "true" ]);
        return redirect()->route('cargo.index');

    }


//_________________________________ AJAX __________________________
    protected function select_ajax_area($id)
    {
        return AdmArea::where('empresa_id',$id)->get();
    }

}
