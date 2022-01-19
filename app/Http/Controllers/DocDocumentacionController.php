<?php

namespace App\Http\Controllers;

use App\DocDocumentacion;
use App\AdmTipoDocumento;
use App\AdmCargo;
use App\AdmFuncionario;
use App\AdmPersona;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DocDocumentacionController extends Controller
{
    protected function index()
    {
        $user = Auth::user();

        $selectcargo = DB::table('users as u')
                ->join('adm_funcionarios as af', 'af.id', 'u.funcionario_id')
                ->join('adm_funcionario_cargos as afc', 'afc.funcionario_id', 'af.id')
                ->join('adm_cargos as ac', 'ac.id', 'afc.cargo_id')
                ->where('afc.activo', 1)
                ->where('u.id', $user->id)
                ->select('ac.id','ac.nombre', 'ac.sigla')->get();
        $dat = $selectcargo[0]->sigla;


        $selectreemplazo = DB::table('users as u')                
                    ->join('adm_funcionarios as af' , 'af.id' , 'u.funcionario_id')
                    ->join('adm_funcionario_cargos as afc' , 'afc.funcionario_id' ,'af.id')
                    ->join('adm_reemplazos as ar' , 'ar.funcar_id' , 'afc.id')
                    ->leftjoin('adm_cargos as ac' , 'ac.id' , 'ar.cargo_id')
                    ->leftjoin('adm_baja_funs as abf' , 'abf.id', 'ar.baja_id')
                    ->leftjoin('adm_funcionario_cargos as afc1' , 'afc1.id' , 'abf.funcar_id')
                    ->leftjoin('adm_cargos as ac1' , 'ac1.id' , 'afc1.cargo_id')
                    ->select('ar.id', 'ar.a','ac.id as id1', 'ac.sigla as n1', 'ac1.id as id2', 'ac1.sigla as n2')
                    ->where('ar.activo',1)
                    ->where('afc.activo',1)
                    ->where('u.id', $user->id)->get();

        $entrantes =  DB::table('doc_documentacions as dd')
            ->join('doc_movimiento_documentos as dmd', 'dmd.documento_id', 'dd.id')
            ->select('dd.id as idd', 'dmd.id as idm', 'dmd.de', 'dmd.de_fuera', 'dmd.dirigido', 'dd.tipodocumento' ,'dd.interna','dd.sigla', 'dmd.fechahraenvio', 'dd.referencia')
            ->where('dmd.entrada', 1)
            ->where('dmd.cargo_id', $selectcargo[0]->id)->get();

        return view('Documentacion.Tramite.indexTramite', compact('dat','entrantes', 'selectcargo' ,'selectreemplazo'));
    }

    protected function index_reemplazo($id)
    {
        $user = Auth::user();
        $dats = AdmCargo::find($id);
        $dat =$dats->sigla.' ai';
        $selectcargo = DB::table('users as u')
                ->join('adm_funcionarios as af', 'af.id', 'u.funcionario_id')
                ->join('adm_funcionario_cargos as afc', 'afc.funcionario_id', 'af.id')
                ->join('adm_cargos as ac', 'ac.id', 'afc.cargo_id')
                ->where('afc.activo', 1)
                ->where('u.id', $user->id)
                ->select('ac.id','ac.nombre', 'ac.sigla')->get();
        $selectreemplazo = DB::table('users as u')                
                    ->join('adm_funcionarios as af' , 'af.id' , 'u.funcionario_id')
                    ->join('adm_funcionario_cargos as afc' , 'afc.funcionario_id' ,'af.id')
                    ->join('adm_reemplazos as ar' , 'ar.funcar_id' , 'afc.id')
                    ->leftjoin('adm_cargos as ac' , 'ac.id' , 'ar.cargo_id')
                    ->leftjoin('adm_baja_funs as abf' , 'abf.id', 'ar.baja_id')
                    ->leftjoin('adm_funcionario_cargos as afc1' , 'afc1.id' , 'abf.funcar_id')
                    ->leftjoin('adm_cargos as ac1' , 'ac1.id' , 'afc1.cargo_id')
                    ->select('ac.id as id1', 'ac.sigla as n1', 'ac1.id as id2', 'ac1.sigla as n2')
                    ->where('ar.activo',1)
                    ->where('afc.activo',1)
                    ->where('u.id', $user->id)->get();

        $entrantes =  DB::table('doc_documentacions as dd')
            ->join('doc_movimiento_documentos as dmd', 'dmd.documento_id', 'dd.id')
            ->select('dd.id as idd', 'dmd.id as idm', 'dmd.de', 'dmd.de_fuera', 'dmd.dirigido', 'dd.tipodocumento' ,'dd.interna','dd.sigla', 'dmd.fechahraenvio', 'dd.referencia')
            ->where('dmd.entrada', 1)
            ->where('dmd.cargo_id', $id)->get();

        return view('Documentacion.Tramite.indexTramite', compact('dat','entrantes', 'selectcargo' ,'selectreemplazo'));
    }
    

    /*PARA ABRIR LA VISTA DE CREAR UN NUEVO TRAMITE INTERNO O EXTERNO*/
    protected function create()
    {
        $tipodoc = AdmTipoDocumento::orderBy('descripcion','ASC')->get();

        $user = Auth::user();
        //......................................
        $cargos = DB::table('adm_personas as ap')
            ->join('adm_funcionarios as af' , 'af.persona_id' , 'ap.id')
            ->join('adm_funcionario_cargos as afc' , 'afc.funcionario_id' , 'af.id')
            ->join('adm_cargos as ac' , 'ac.id' , 'afc.cargo_id')
            ->select('ap.nombre', 'ap.apellidopaterno', 'ap.apellidomaterno', 'ac.nombre as c')
            ->where('afc.activo', 1)->where('af.id', '!=', $user->funcionario_id)
            ->get();

        $reemplazos = DB::table('adm_personas as ap')
            ->join('adm_funcionarios as af' , 'af.persona_id' , 'ap.id')
            ->join('adm_funcionario_cargos as afc' , 'afc.funcionario_id' , 'af.id')
            ->join('adm_reemplazos as ar' , 'ar.funcar_id' , 'afc.id')
            ->leftjoin('adm_cargos as ac1' , 'ac1.id' , 'ar.cargo_id')

            ->leftjoin('adm_baja_funs as abf' , 'abf.id' , 'ar.baja_id')
            ->leftjoin('adm_funcionario_cargos as afc1' , 'afc1.id' , 'abf.funcar_id')
            ->leftjoin('adm_cargos as ac2' , 'ac2.id' , 'afc1.cargo_id')
            ->select('ap.nombre', 'ap.apellidopaterno', 'ap.apellidomaterno', 'ac1.nombre as n1', 'ac2.nombre as n2')
            ->where('ar.activo', 1)->where('af.id', '!=', $user->funcionario_id)
            ->get();

            
        return view('Documentacion.Tramite.crearTramite', compact('tipodoc', 'cargos', 'reemplazos'));
    }


    protected function store(Request $request)
    {
        
        if($request->interna == 2)
        {
            $request->merge(['interna' => 0]);
        }
        $user = Auth::user();
        $cargo = AdmCargo::find($request->cargo_id);
        $fun = AdmFuncionario::find($user->funcionario_id);
        $per =AdmPersona::find($fun->persona_id);
        $request->merge(['de' => $per->nombrecompleto().' - '.$cargo->nombre]);

        if($request->tipo == 2)
        {
            $request->merge(['tipo' => 0]);
            $request->merge(['de' => $request->de.' a.i']);
        }
        $request->merge(['estado' => 1]);
        $request->merge(['user_id' => $user->id]);

        // return $request;
        $doc = DocDocumentacion::create($request->all());
        // return $doc;
        return redirect()->route('doc-tramite.derivar.tramite',$doc->id);
        
        // return redirect()->route('derivardocumentacion', $document->id);
        
    }

    protected function view_derivar_doc()
    {
        # code...
    }

 


    //---------------------------- AJAX -------------------
    // funcion para obteber cargo y reemplazo
    protected function select_ajax_cargo($id)
    {
        $user = Auth::user();
        if($id == 1)
        {        //cargos
            return DB::table('users as u')
                ->join('adm_funcionarios as af', 'af.id', 'u.funcionario_id')
                ->join('adm_funcionario_cargos as afc', 'afc.funcionario_id', 'af.id')
                ->join('adm_cargos as ac', 'ac.id', 'afc.cargo_id')
                ->where('afc.activo', 1)
                ->where('u.id', $user->id)
                ->select('ac.id','ac.nombre')->get();
        }
        else
        {
            if($id == 2)
            {
                return DB::table('users as u')                
                    ->join('adm_funcionarios as af' , 'af.id' , 'u.funcionario_id')
                    ->join('adm_funcionario_cargos as afc' , 'afc.funcionario_id' ,'af.id')
                    ->join('adm_reemplazos as ar' , 'ar.funcar_id' , 'afc.id')
                    ->leftjoin('adm_cargos as ac' , 'ac.id' , 'ar.cargo_id')
                    ->leftjoin('adm_baja_funs as abf' , 'abf.id', 'ar.baja_id')
                    ->leftjoin('adm_funcionario_cargos as afc1' , 'afc1.id' , 'abf.funcar_id')
                    ->leftjoin('adm_cargos as ac1' , 'ac1.id' , 'afc1.cargo_id')
                    ->select('ar.id', 'ar.a','ac.id as id1', 'ac.nombre as n1', 'ac1.id as id2', 'ac1.nombre as n2')
                    ->where('ar.activo',1)
                    ->where('afc.activo',1)
                    ->where('u.id', $user->id)->get();
            }
        }        
    }

    protected function select_ajax_sigla($id)
    {
        return AdmCargo::find($id);
    }
}
