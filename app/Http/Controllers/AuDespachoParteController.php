<?php

namespace App\Http\Controllers;
use App\AuDespachoPesoTotal;
use App\AuDespachoParte;
use App\AuDespachoPersonal;
use App\AdmPersona;
use App\AdmFuncionario;
use App\AuDespachoDetalle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AuDespachoParteController extends Controller
{
    public function store(Request $request)
    {
        // return $request;

        $sig = AuDespachoParte::create($request->all());
        
        $chofer=  AdmFuncionario::find($request->chofer)->persona->nombrecompleto();

        // return $chofer;

        $cargo = DB::table('adm_funcionario_cargos as aff')//...
            ->join('adm_cargos as ac','ac.id', 'aff.cargo_id')
            ->select('ac.nombre')
            ->where('aff.funcionario_id', $request->chofer)
            ->where('aff.activo',1)->get();
        
        AuDespachoDetalle::where('id',$sig->despachodetalle_id)->update(['activo' => 2]);


        AuDespachoPesoTotal::create(['despachoparte_id' => $sig->id]);


        AuDespachoPersonal::create(['cargo' => $cargo[0]->nombre, 'nombre' => $chofer, 'despachoparte_id' => $sig->id, 'estado' => 1]);
        toastr()->success('Ha sido actualizado con exito' , 'Información' , ["closeButton" => "true","progressBar" => "true" ]);
        return redirect()->route('au-partemovimiento.view', $sig->id);
    }

}
