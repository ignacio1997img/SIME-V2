<?php

namespace App\Http\Controllers;

use App\AdmFuncionario;
use App\AdmDesignacion;
use App\AdmPersona;
use App\AdmEmpresa;
use App\AdmCargo;
use App\AdmFuncionarioCargo;
use App\AdmReemplazo;
use App\AdmBajaFun;
use Carbon\Carbon;
use App\User;
use App\AdmDesignacionSistema;
use App\AdmFuncionarioDesignacionSi;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class AdmFuncionarioController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:rrhh-funcionario.index')->only('index');
        $this->middleware('permission:rrhh-funcionario.store')->only('store');
    }
 
    protected function index()
    {
        $personas = AdmPersona::where('asignada', 0)->orderBy('nombre', 'asc')->get();
        $empresas = AdmEmpresa::where('personal', 1)->get();
        $reemplazos = AdmReemplazo::all();

        $activos = AdmPersona::select('af.id','adm_personas.nombre', 'adm_personas.apellidopaterno as ap1', 'adm_personas.apellidomaterno as ap2','ac.nombre as cargo', 'ae.razonsocial')
            ->join('adm_funcionarios as af', 'af.persona_id', 'adm_personas.id')
            ->join('adm_funcionario_cargos as afc', 'afc.funcionario_id', 'af.id')
            ->join('adm_cargos as ac', 'ac.id', 'afc.cargo_id')
            ->join('adm_areas as aa', 'aa.id', 'ac.area_id')
            ->join('adm_empresas as ae', 'ae.id', 'aa.empresa_id')
            ->where('afc.activo',1)->get();
            
        return view('RecursosHumanos.Funcionario.indexFuncionario', compact( 'personas', 'empresas','activos', 'reemplazos'));
    }


    protected function view_funcionario_inactivo()
    {
        // $funcionarios = AdmFuncionario::where('activo',0)->get();
        
        $funcionarios = AdmPersona::select('af.id','adm_personas.nombre', 'adm_personas.apellidopaterno as ap1',
            'adm_personas.apellidomaterno as ap2','ac.nombre as cargo', 'ae.razonsocial', 'ae.sigla', 'abf.tipo','afc.activo', 'abf.activo as abf')
            ->join('adm_funcionarios as af', 'af.persona_id', 'adm_personas.id')
            ->join('adm_funcionario_cargos as afc', 'afc.funcionario_id', 'af.id')
            ->join('adm_baja_funs as abf','abf.funcar_id','afc.id')
            ->join('adm_cargos as ac', 'ac.id', 'afc.cargo_id')
            ->join('adm_areas as aa', 'aa.id', 'ac.area_id')
            ->join('adm_empresas as ae', 'ae.id', 'aa.empresa_id')
            ->where('abf.ult',1)
            ->where('afc.activo', '!=','1')->get();
        // return $funcionarios;
        return view('RecursosHumanos.Funcionario.Funcionario.inactivo', compact('funcionarios'));
    }

    protected function view_historial($id)
    {
        
        $funcionarios =  AdmFuncionario::find($id);

        $detalles = Admcargo::join('adm_funcionario_cargos as afc','afc.cargo_id','adm_cargos.id')
            ->where('afc.funcionario_id', $id)->get();
        
        $bajas = Admcargo::join('adm_funcionario_cargos as afc','afc.cargo_id','adm_cargos.id')
            ->join('adm_baja_funs as abf','abf.funcar_id','afc.id')
            ->select('abf.inicio','abf.fin','abf.tipo','abf.documento','abf.activo','abf.observacion','adm_cargos.nombre')
            ->where('afc.funcionario_id', $id)
            ->where('abf.tipo','!=', 'Baja Definitiva')->get();
        $bajac = Admcargo::join('adm_funcionario_cargos as afc','afc.cargo_id','adm_cargos.id')
            ->join('adm_baja_funs as abf','abf.funcar_id','afc.id')
            ->select('abf.inicio','abf.fin','abf.tipo','abf.documento','abf.activo','abf.observacion','adm_cargos.nombre')
            ->where('afc.funcionario_id', $id)
            ->where('abf.tipo','!=', 'Baja Definitiva')->count();

        $reempazos = Admcargo::join('adm_funcionario_cargos as afc','afc.cargo_id','adm_cargos.id')
            ->join('adm_reemplazos as ar','ar.funcar_id','afc.id')
            ->leftjoin('adm_baja_funs as abf', 'abf.id','ar.baja_id')
            ->select('ar.activo','ar.inicio','ar.fin','ar.fins','ar.a','ar.documento','abf.tipo','ar.observacion','adm_cargos.nombre')
            ->where('afc.funcionario_id', $id)->get();
        $reempazoc = Admcargo::join('adm_funcionario_cargos as afc','afc.cargo_id','adm_cargos.id')
            ->join('adm_reemplazos as ar','ar.funcar_id','afc.id')
            ->leftjoin('adm_baja_funs as abf', 'abf.id','ar.baja_id')
            ->select('ar.activo','ar.inicio','ar.fin','ar.fins','ar.a','ar.documento','abf.tipo','ar.observacion','adm_cargos.nombre')
            ->where('afc.funcionario_id', $id)->count();

        $listas = AdmDesignacion::where('funcionario_id',$id)->get();
        $listc = AdmDesignacion::where('funcionario_id',$id)->count();

        // return $listc;
        $fechaprint = Carbon::now()->format('d/m/Y');
        $hraprint = Carbon::now()->format('H:i A'); 

        // return $detalles;
        return view('RecursosHumanos.Funcionario.Funcionario.historial',
            compact('reempazos','funcionarios','detalles','fechaprint','hraprint','bajas', 'listas','bajac','reempazoc','listc'));
    }

    // vista para designaciones
    protected function view_designacion($id)
    {        
        $funcionarios =  DB::table('adm_personas as ap')   
            ->join('adm_funcionarios as af' , 'af.persona_id', 'ap.id')
            ->join('adm_funcionario_cargos as afc' , 'afc.funcionario_id', 'af.id')
            ->join('adm_cargos as ac', 'ac.id' , 'afc.cargo_id')       
            ->select('ap.nombre', 'ap.apellidopaterno', 'ap.apellidomaterno', 'af.id', 'ac.nombre as cargo')        
            ->where('afc.activo',1)
            ->where('af.id',$id)->get();
            

        $listas = AdmDesignacion::where('funcionario_id',$id)->get();
        
        return view('RecursosHumanos.Funcionario.indexDesignacion', compact('funcionarios', 'listas'));
    }

    //vista para designacion del sistema
    protected function view_designacionsistema($id)
    {
        // return 1;
        $designacion = AdmDesignacionSistema::all();
        $pivote = AdmFuncionarioDesignacionSi::where('funcionario_id',$id)->get();

            // return $pivote;

        $funcionario = AdmFuncionario::find($id);


        $asignados = DB::table('adm_funcionario_designacion_sis as a')
            ->join('adm_designacion_sistemas as b', 'b.id', 'a.designaciones_id')
            ->select('a.id','b.descripcion')
            ->where('a.funcionario_id', $id)->get();
        
       
        return view('RecursosHumanos.Funcionario.indexDesignacionSistema', compact('funcionario', 'designacion', 'asignados', 'pivote'));
    }


    protected function store(Request $request)
    {        

        $ok = AdmFuncionario::where('persona_id',$request->persona_id)->count('*');
        
        if($ok == 0)
        {
            $request->merge(['fechaingreso' => Carbon::now()]);          

            $fun = AdmFuncionario::create($request->all());
            $cod = $fun->id;
        }
        else
        {
            // cuando existe el funcionario para ponerlo activo sin registrar
            AdmFuncionario::where('persona_id',$request->persona_id)
                ->update(['activo'=> 1]);
                
            $fun =  AdmFuncionario::where('persona_id',$request->persona_id)->get();
            
            $cod= $fun[0]->id;
            
            $ult = DB::table('adm_funcionario_cargos as afc')
            ->join('adm_baja_funs as abf', 'abf.funcar_id', 'afc.id')        
            ->where('afc.funcionario_id', $cod)
            ->where('abf.ult', 1)
            ->select('abf.id')->get();
            

            AdmBajaFun::where('id',$ult[0]->id)    
                ->update(['ult' => 0]);
            
        }

        AdmPersona::where('id',$request->persona_id)
        ->update(['asignada'=> 1]);

        User::where('funcionario_id',$cod )
            ->update(['activo' => 1]);

        AdmFuncionarioCargo::create(['funcionario_id' => $cod,
                                     'cargo_id' => $request->cargo_id,
                                     'inicio' => $request->inicio,
                                     'detalle' => $request->detalle]);        

        

        toastr()->success( 'Registro Exitoso' , 'Información' , ["closeButton" => "true","progressBar" => "true" ]);
        return redirect()->route('funcionario.index');
    }

    
    //----------------------------------------- AJAX ------------------------------------------

    // para buscar el cargo
    protected function select_ajax_cargo($id)
    {
        return AdmCargo::where('area_id',$id)->get();
    }

     


    


}
