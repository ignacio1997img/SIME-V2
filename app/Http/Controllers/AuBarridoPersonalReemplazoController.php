<?php

namespace App\Http\Controllers;

use App\AuBarridoPersonal;
use App\AuBarridoPersonalReemplazo;
use App\AdmFuncionario;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class AuBarridoPersonalReemplazoController extends Controller
{
    
    public function store(Request $request)
    {
    //  return $request;
        AuBarridoPersonal::where('id',$request->id)->delete();
        
        // $request->merge(['cargo' => 'BARRIDO']);   
        $funcionario=  AdmFuncionario::find($request->nombre2);

        $cargo = DB::table('adm_funcionario_cargos as aff')//...
                ->join('adm_cargos as ac','ac.id', 'aff.cargo_id')
                ->select('ac.nombre')
                ->where('aff.funcionario_id', $funcionario->id)
                ->where('aff.activo',1)->get();
        AuBarridoPersonal::create(['cargo' => $cargo[0]->nombre, 'nombre' => $funcionario->persona->nombrecompleto(), 'despachodetalle_id' => $request->despachodetalle_id ]);
        // return 2;
        AuBarridoPersonalReemplazo::create(['reemplazando'=>$cargo[0]->nombre.' - '.$funcionario->persona->nombrecompleto(),'reemplazado'=>$request->cargo1.' - '.$request->nombre1, 'despachodetalle_id'=>$request->despachodetalle_id]);

        return redirect()->route('au-rtbarrido.despacho.despachodetalle.viewpersonal',$request->despachodetalle_id);    
    }

 
    public function destroy(Request $request)
    {
        AuBarridoPersonalReemplazo::find($request->id)->delete();

        return redirect()->route('au-rtbarrido.despacho.despachodetalle.viewpersonal',$request->despachodetalle_id);
    }
}
