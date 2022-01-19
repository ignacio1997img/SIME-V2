<?php

namespace App\Http\Controllers;

use App\AdmReemplazo;
use App\AdmCargo;
use App\AdmFuncionario;
use App\AdmPersona;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class AdmReemplazoController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:rrhh-reemplazo.index')->only('index');
        $this->middleware('permission:rrhh-reemplazo.store')->only('store');
    }

    protected function index()
    {
        // PARA LLENAR LOS TAB
        $tabs = DB::table('adm_reemplazos as ar')            
            ->join('adm_funcionario_cargos as afc', 'afc.id','ar.funcar_id')
            ->join('adm_funcionarios as af', 'af.id','afc.funcionario_id')
            ->join('adm_cargos as ac', 'ac.id', 'afc.cargo_id')
            ->join('adm_personas as ap', 'ap.id', 'af.persona_id')
            ->leftjoin('adm_baja_funs as abf', 'abf.id','ar.baja_id')
            ->select('ar.id','abf.tipo', 'ap.nombre','ap.apellidopaterno', 'ap.apellidomaterno', 'ar.a', 'ar.inicio', 'ar.fin','ar.fins','ar.observacion','ar.documento','ar.activo','ar.baja_id', 'ar.cargo_id', 'ac.nombre as cargo')->get();

        $reemplazos = DB::table('adm_personas as ap')
            ->join('adm_funcionarios as af', 'af.persona_id','ap.id')
            ->join('adm_funcionario_cargos as afc', 'afc.funcionario_id', 'af.id')
            ->join('adm_cargos as ac', 'ac.id', 'afc.cargo_id')
            ->join('adm_baja_funs as abf', 'abf.funcar_id', 'afc.id')
            ->select('ap.nombre','ap.apellidopaterno', 'ap.apellidomaterno', 'ac.id as cargo_id',
                    'af.id as funcionario_id', 'afc.id as fun_car', 'abf.id as baja_id', 'ac.nombre as cargo')
            ->where('afc.activo', 2)
            ->where('abf.activo', 1)->get();


        $personas = AdmPersona::select('adm_personas.nombre','adm_personas.apellidopaterno','adm_personas.apellidomaterno','afc.id as funcar_id', 'ac.nombre as cargo')
            ->join('adm_funcionarios as af', 'af.persona_id', 'adm_personas.id')
            ->join('adm_funcionario_cargos as afc', 'afc.funcionario_id','af.id')
            ->join('adm_cargos as ac','ac.id','afc.cargo_id')
            ->join('adm_areas as aa', 'aa.id','ac.area_id')
            ->join('adm_empresas as ae', 'ae.id', 'aa.empresa_id')    
            ->where('af.activo',1)
            ->where('ae.id', 1)
            ->where('afc.activo', 1)->get();
            
        $cargos = AdmCargo::all();

        // return $personas;

        return view('RecursosHumanos.Funcionario.indexReemplazos', compact('reemplazos','personas', 'cargos', 'tabs'));
    }

    private function nombre_cargo($id)
    {
        $dato=  DB::table('adm_baja_funs as abf')        
            ->join('adm_funcionario_cargos as afc', 'afc.id', 'abf.funcar_id')
            ->join('adm_funcionarios as af', 'af.id', 'afc.funcionario_id')
            ->join('adm_personas as ap', 'ap.id', 'af.persona_id')
            ->join('adm_cargos as ac', 'ac.id', 'afc.cargo_id')
            ->where('abf.id', $id)
            ->select('ac.nombre as cargo', 'ap.nombre', 'ap.apellidopaterno', 'ap.apellidomaterno')->get();
        return $dato[0]->nombre.' '.$dato[0]->apellidopaterno.' '.$dato[0]->apellidomaterno.' - '.$dato[0]->cargo;
    }
    private function cargo($id)
    {
         return AdmCargo::find($id);
    }

    protected function store(Request $request)
    {
        if($request->tipo_reemplazo == 1)
        {
            $request->merge(['a' => $this->nombre_cargo($request->baja_id)]);
        }
        else
        {
            $request->merge(['a' => $this->cargo($request->cargo_id)->nombre]);
        }
        
       
        // return $request;


        AdmReemplazo::create($request->all());
        toastr()->success('Ha sido registrado con exito' , 'Información' , ["closeButton" => "true","progressBar" => "true" ]);
        return redirect()->route('reemplazo.index');
    }

    
    protected function update_reemplazo(Request $request)
    {
        $request->merge(['activo' => 0]);

        $act = AdmReemplazo::find($request->id);
        $act->update($request->all());
        toastr()->success('Ha sido actualizado con exito' , 'Información' , ["closeButton" => "true","progressBar" => "true" ]);
        return redirect()->route('reemplazo.index');
    }


    protected function select_ajax_cargo($id)
    {
        return AdmCargo::find($id);
    }
}
