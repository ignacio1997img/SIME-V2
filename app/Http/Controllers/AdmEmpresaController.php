<?php

namespace App\Http\Controllers;

use App\AdmEmpresa;
use App\AdmRubro;
use App\AdmSubGrupo;
use App\AdmGrupoEmpresa;
use Carbon\Carbon;
use App\User;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdmEmpresaController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:adm-empresa.index')->only('index');
        $this->middleware('permission:adm-empresa.store')->only('store');
    }
    
    public function index()    
    {

        $grupos = AdmGrupoEmpresa::all();
        $subgrupos = AdmSubGrupo::all();
        $rubros = AdmRubro::all();
        $empresas = AdmEmpresa::all();
        return view('Administracion.Empresa.indexEmpresa', compact('empresas','grupos','subgrupos','rubros'));
    }

    public function store(Request $request)
    {
        $a=AdmEmpresa::create($request->all());

        toastr()->success('Ha sido registrado con exito' , 'Información' , ["closeButton" => "true","progressBar" => "true" ]);
        return redirect()->route('empresa.index');
    }

    public function update_empresa(Request $request)
    {
        // return $request;
        $op = AdmEmpresa::find($request->id);
        $op->update($request->all());
        toastr()->success('Ha sido actualizado con exito' , 'Información' , ["closeButton" => "true","progressBar" => "true" ]);
        return redirect()->route('empresa.index');
    }

    //para la vista del kardex
    protected function kardex($id)
    {
        $empresas = AdmEmpresa::find($id);

        $fechaprint = Carbon::now()->format('d/m/Y');
        $hraprint = Carbon::now()->format('H:i A');
        // $inicio = Carbon::parse($request->fechainicio)->format('d/m/Y');
        // $fin = Carbon::parse($request->fechafinal)->format('d/m/Y');

        return view('Administracion.Empresa.kardex', compact('empresas','fechaprint', 'hraprint'));
    }

    protected function view_empresa_funcionarios($id)
    {
        $empresa = AdmEmpresa::find($id);

        $listas = DB::table('adm_personas as p')
            ->join('adm_funcionarios as af', 'af.persona_id', 'p.id')
            ->join('adm_funcionario_cargos as afc', 'afc.funcionario_id', 'af.id')
            ->join('adm_cargos as ac', 'ac.id', 'afc.cargo_id')
            ->join('adm_areas as aa', 'aa.id', 'ac.area_id')
            ->join('adm_empresas as ae', 'ae.id', 'aa.empresa_id')
            ->select('af.id', 'aa.descripcion as area', 'ac.nombre as cargo', 'p.nombre', 'p.apellidopaterno as p1', 'p.apellidomaterno as p2', 'p.ci', 'p.expedido', 'p.telefono')
            ->where('afc.activo', '!=', 0)
            ->where('ae.id',$id)->get();
        $listac = DB::table('adm_personas as p')
            ->join('adm_funcionarios as af', 'af.persona_id', 'p.id')
            ->join('adm_funcionario_cargos as afc', 'afc.funcionario_id', 'af.id')
            ->join('adm_cargos as ac', 'ac.id', 'afc.cargo_id')
            ->join('adm_areas as aa', 'aa.id', 'ac.area_id')
            ->join('adm_empresas as ae', 'ae.id', 'aa.empresa_id')
            ->where('afc.activo', '!=', 0)
            ->where('ae.id',$id)->count();
      

        $fechaprint = Carbon::now()->format('d/m/Y');
        $hraprint = Carbon::now()->format('H:i A');
        return view('Administracion.Empresa.empresaFuncionario', compact('empresa','listas','listac','fechaprint', 'hraprint'));
    }



    //--------------------- ajax -------------------------------------

    protected function select_ajax_rubro($id)
    {
        $rubro = AdmRubro::where('subgrupo_id',$id)->get();
        return $rubro;
    }

    protected function select_ajax_empresa($id)
    {
        return DB::table('adm_empresas as ae')
            ->join('adm_rubros as ar', 'ar.id', 'ae.rubroempresa_id')
            ->join('adm_sub_grupos as asg', 'asg.id', 'ar.subgrupo_id')
            ->join('adm_grupo_empresas as age', 'age.id', 'asg.grupo_id')
            ->where('ae.id', $id)
            ->select('age.nombre as grupo', 'asg.descripcion as sub', 'ae.sigla', 'ar.descripcion as rubro','ae.id', 'ae.nit', 'ae.razonsocial', 'ae.direccion', 'ae.telempresa', 'ae.emailempresa', 'ae.contacto', 'ae.telefonocontacto',
            'ae.emailcontacto', 'ae.personal', 'ae.activa')->get();
    }



}
