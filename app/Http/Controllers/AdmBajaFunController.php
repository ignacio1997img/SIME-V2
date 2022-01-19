<?php

namespace App\Http\Controllers;

use App\AdmBajaFun;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\AdmFuncionario;
use App\AdmPersona;
use App\User;
use App\AdmFuncionarioCargo;
use App\AdmReemplazo;
use Illuminate\Http\Request;

class AdmBajaFunController extends Controller
{
    protected function activar_ajax_cargo()
    {
        $mytime = Carbon::now();
        // return $mytime->toDateString();
        $filtros = AdmBajaFun::where('activo',1)->get();
        foreach ($filtros as $filtro)
        {
            if( $mytime > $filtro->fin )
            {
                $dat = DB::table('adm_funcionario_cargos as afc')
                    ->join('adm_funcionarios as af',  'af.id', 'afc.funcionario_id')
                    ->where('afc.id',$filtro->funcar_id)
                    ->select('afc.id as afc_id', 'af.id as funcionario_id', 'af.persona_id')->get();
                
                AdmFuncionario::where('id', $dat[0]->funcionario_id)
                    ->update(['activo' => 1]);
        
                User::where('funcionario_id',$dat[0]->funcionario_id )
                    ->update(['activo' => 1]);
                
                AdmFuncionarioCargo::where('id',$dat[0]->afc_id)
                        ->update(['activo' => 1]);

                $cods = AdmBajaFun::select('adm_baja_funs.id')
                    ->where('adm_baja_funs.activo',1)
                    ->where('adm_baja_funs.funcar_id',$dat[0]->afc_id)->get();


                AdmBajaFun::where('funcar_id',$dat[0]->afc_id)
                    ->update(['activo' => 0]);

                
                
                AdmReemplazo::where('baja_id',$cods[0]->id)
                    ->update(['activo' => 0]);
            }
        }        
    }
}
