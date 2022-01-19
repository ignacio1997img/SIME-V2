<?php

namespace App\Http\Controllers;

use App\AdmFuncionarioCargo;
use App\AdmFuncionario;
use App\AdmDesignacion;
use App\AdmPersona;
use App\User;
use App\AdmBajaFun;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdmFuncionarioCargoController extends Controller
{
    private function busqueda($id)
    {
        $id = AdmFuncionarioCargo::where('funcionario_id', $id)
                                ->where('activo',1)->get();
        return $id[0]->id;
    }

    protected function baja_funcionariocargo(Request $request)
    {
        // return $request;

        if($request->tipo_baja == 1)
        {
            $request->merge(['motivo' => 'Baja Definitiva']);
            AdmFuncionarioCargo::where('id',$request->pivote_id)
                ->update(['fin' => $request->fin, 'motivo' => $request->motivo, 'observacion' => $request->observacion, 'activo' => 0]);

            $persona = AdmFuncionario::find($request->funcionario_id);

            
            AdmPersona::where('id', $persona->persona_id)
                ->update(['asignada' => 0]);  
                
            $inicio = AdmFuncionarioCargo::find($request->pivote_id);

            AdmBajaFun::where('funcar_id', $request->pivote_id)//para darle prioridad al ultimo registro
                ->update(['ult' => 0]);

            // return $inicio;
            AdmBajaFun::create(['inicio' => $inicio->inicio, 'fin' => $request->fin, 'documento' => 'Baja Definitiva',
                'observacion' => $request->observacion,
                'tipo' => 'Baja Definitiva', 'funcar_id' => $request->pivote_id, 'activo' => 0]);
            
        }
        else
        {
            if($request->tipo_baja >= 2)
            {
                if($request->tipo_baja == 2)
                {
                    $request->merge(['tipo' => 'Baja Medica']);
                }
                else
                {
                    if($request->tipo_baja == 3)
                    {
                        $request->merge(['tipo' => 'Baja de Vacaciones']);
                    }
                    else
                    {
                        $request->merge(['tipo' => 'Baja Comision']);                        
                    }
                }

                AdmFuncionarioCargo::where('id',$request->pivote_id)
                ->update(['activo' => 2]);
                
                AdmBajaFun::where('funcar_id', $request->pivote_id)//para darle prioridad al ultimo registro
                ->update(['ult' => 0]);

                AdmBajaFun::create(['inicio' => $request->inicio, 'fin' => $request->fin, 'documento' => $request->documento,
                                    'observacion' => $request->observacion,
                                    'tipo' => $request->tipo, 'funcar_id' => $request->pivote_id]);
            }
        }
        AdmFuncionario::where('id', $request->funcionario_id)
            ->update(['activo' => 0]);

        User::where('funcionario_id',$request->funcionario_id )
            ->update(['activo' => 0]);
            
        toastr()->success( 'Registro Actualizado' , 'Información' , ["closeButton" => "true","progressBar" => "true" ]);
        return redirect()->route('funcionario.index');
    }

//------------------------------------ AJAX --------------------------------------------

    protected function select_ajax_activo($id)
    {
        return AdmFuncionarioCargo::find($this->busqueda($id));
    }

    

}
