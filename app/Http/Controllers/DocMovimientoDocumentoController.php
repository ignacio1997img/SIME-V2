<?php

namespace App\Http\Controllers;

use App\DocMovimientoDocumento;
use App\DocDocumentacion;
use App\AdmCargo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DocMovimientoDocumentoController extends Controller
{
    
    protected function index()
    {
        
    }

    //para abrir la vista de la primer derivacion cuando de crea un documento
    protected function view_derivacion_tramite($id)
    {
        $user = Auth::user();
        $doc = DocDocumentacion::find($id);
        $cargos = DB::table('adm_personas as ap')
            ->join('adm_funcionarios as af' , 'af.persona_id' , 'ap.id')
            ->join('adm_funcionario_cargos as afc' , 'afc.funcionario_id' , 'af.id')
            ->join('adm_cargos as ac' , 'ac.id' , 'afc.cargo_id')
            ->select('ap.nombre', 'ap.apellidopaterno', 'ap.apellidomaterno', 'ac.id', 'ac.nombre as c')
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
            ->select('ap.nombre', 'ap.apellidopaterno', 'ap.apellidomaterno', 'ac1.id as id1', 'ac1.nombre as n1', 'ac2.id as id2', 'ac2.nombre as n2')
            ->where('ar.activo', 1)->where('af.id', '!=', $user->funcionario_id)
            ->get();
            // return $cargos;
        return view('Documentacion.Tramite.derivarTramite', compact('doc', 'cargos', 'reemplazos'));
    }


    //para abrir la vista de la primer derivacion cuando de crea un documento
    protected function view_derivacion_proceso($id)
    {
        $doc =  DocMovimientoDocumento::find($id);
        $car = AdmCargo::find($doc->cargo_id);

        DocMovimientoDocumento::where('id', $id)->where('entrada',0)
            ->update(['recibido'=>1, 'fechahrarecibido' => Carbon::now(), 'estado' => "DERIVADO", 'entrada'=>0, 'despachada'=>1]);




        // return $car;
        return view('Documentacion.Tramite.derivarProceso', compact('car', 'doc'));
    }






    private $cargo='';
    private $texto='';
    
    private function hibrido($datos)
    {
        $ok =true;
        $aux=false;
        $this->cargo='';
        $this->texto='';
        for($i=0; $i< strlen($datos); $i++)
        {
            if ( is_numeric($datos[$i]) && $ok==true)
            {
                $this->cargo = $this->cargo.$datos[$i];          
            }
            else
            {                
                $ok=false;
                if($aux)
                {
                    $this->texto = $this->texto.$datos[$i];
                }
                $aux =true;
            }
        }
    }
    
    // para la primer derivacion
    public function store(Request $request)
    {
        $user = Auth::user();

        $request->merge(['fechahraenvio' => Carbon::now()->format('Y-m-d H:i:s')]);
        $request->merge(['fechahraposenvio' => Carbon::now()->format('Y-m-d H:i:s')]);

        $request->merge(['estado' => "PENDIENTE"]);

        // return $request;
        $dirigidos = $request->dirigidos;
        foreach ($dirigidos as $dirigido)
        {
            $this->hibrido($dirigido);

            DocMovimientoDocumento::create(
                [
                    'documento_id' => $request['documento_id'],
                    'cargo_id' => $this->cargo,
                    'dirigido' => $this->texto,
                    'de'       => $request['de'],
                    'de_fuera' => $request['de_fuera'],
                    'nota' => $request['nota'],
                    'fechahraenvio' => $request['fechahraenvio'],
                    'fechahraposenvio' => $request['fechahraposenvio'],
                    'cabecera' => 1,
                    'estado' => $request['estado'],
                    'user_id' => $user->id

                ]
            );
            
        }
    }











    protected function create($id)
    {
        return $id;
    }



}
