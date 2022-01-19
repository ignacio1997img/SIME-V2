<?php

namespace App\Http\Controllers;

use App\AdmCargo;
use App\AdmDesignacionSistema;
use App\AdmEmpresa;
use App\AuDespachoPersonal;
use App\AuDespachoPesoTotal;
use App\AuParteMovimiento;
use App\MaVehiculo;
use App\AuDespachoDetalle;
use App\AdmFuncionario;
use App\AuDespachoParte;
use App\AuDespachoCombustible;
use App\AuDespachoPersonalReemplazo;
use App\AuDespachoParteEstimado;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class AuParteMovimientoController extends Controller
{

    // protected $personaTotal = array();
    protected function view_partemovimiento($id)
    {
        
        $parte = AuDespachoParte::find($id);
        $funcionario = AdmFuncionario::find($parte->chofer);
        
        $detalle = AuDespachoDetalle::find($parte->despachodetalle_id);
        $vehiculo = MaVehiculo::where('interno', $detalle->vehiculo_id)->get();
        // $chofer = AdmFuncionario::find($parte->chofer_id);
        $registrado = AdmFuncionario::find($parte->	registradorparte_id);

        $movimientos = AuParteMovimiento::where('despachoparte_id', $id)->get();




        $empresas = AdmDesignacionSistema::where('descripcion', 'RECOLECTORES')
            ->ORwhere('descripcion','ELABORAR PARTE DIARIO')->get();

        $personaactiva = DB::table('au_despacho_partes as apm')
        ->join('au_despacho_personals as adp', 'adp.despachoparte_id', 'apm.id')
        ->select('adp.estado','adp.id','adp.cargo', 'adp.nombre')
        ->where('apm.id', $id)->orderBy('adp.cargo')->get();

        $cantPersona  = DB::table('au_despacho_partes as apm')
            ->join('au_despacho_personals as adp', 'adp.despachoparte_id', 'apm.id')
            ->where('apm.id', $id)
            ->where('adp.estado',1)->count();

            // return $personaactiva;

        $cantmov = AuParteMovimiento::where('despachoparte_id', $id)->count();
        // return $id;
        $viajes = AuDespachoParteEstimado::where('despachoparte_id', $id)->orderBy('id')->get();
        
   
        $personareemplazada = AuDespachoPersonalReemplazo::where('despachoparte_id', $id)->get();
        

        //si hay combustible registrado en la 1 capa
        $combustible = AuDespachoCombustible::where('despachodetalle_id', $parte->despachodetalle_id)->get();
        $cantCombustible = AuDespachoCombustible::where('despachodetalle_id', $parte->despachodetalle_id)->count();

      
            

        return view('AseoUrbano.RTDomiciliario.parteMovimiento', compact('funcionario','viajes','combustible','cantCombustible','cantPersona','cantmov','personareemplazada','personaactiva','empresas','detalle','vehiculo', 'parte', 'chofer', 'registrado', 'movimientos'));
    }

    
    protected function store_movimiento(Request $request)
    {
        AuParteMovimiento::create($request->all());

        return redirect()->route('au-partemovimiento.view',$request->despachoparte_id);
    }
    protected function delete_movimiento(Request $request)
    {
        // return  $request;
        AuParteMovimiento::find($request->id)->delete();

        return redirect()->route('au-partemovimiento.view',$request->despachoparte_id);
    }


    protected function store_viajes(Request $request)
    {
        $id = AuDespachoPesoTotal::where('despachoparte_id',$request->despachoparte_id)->get();
        // return $request;
        AuDespachoPesoTotal::where('despachoparte_id',$request->despachoparte_id)->update(['peso' => $id[0]->peso+$request->pesobascula, 'viaje'=> $id[0]->viaje + 1]);
        AuDespachoParteEstimado::create($request->all());

        return redirect()->route('au-partemovimiento.view',$request->despachoparte_id);
    }
    protected function delete_viajes(Request $request)
    {
        $id = AuDespachoPesoTotal::where('despachoparte_id',$request->despachoparte_id)->get();
        
        AuDespachoPesoTotal::where('despachoparte_id',$request->despachoparte_id)->update(['peso' => $id[0]->peso - AuDespachoParteEstimado::find($request->id)->pesobascula, 'viaje'=> $id[0]->viaje - 1]);

        AuDespachoParteEstimado::find($request->id)->delete();

        return redirect()->route('au-partemovimiento.view',$request->despachoparte_id);
    }



    protected function store_personal_activo(Request $request)
    {       
        foreach($request->personas as $persona)
        {
            $funcionario=  AdmFuncionario::find($persona);

            $cargo = DB::table('adm_funcionario_cargos as aff')//...
                ->join('adm_cargos as ac','ac.id', 'aff.cargo_id')
                ->select('ac.nombre')
                ->where('aff.funcionario_id', $funcionario->id)
                ->where('aff.activo',1)->get();
            AuDespachoPersonal::create(['cargo' => $cargo[0]->nombre, 'nombre' => $funcionario->persona->nombrecompleto(), 'despachoparte_id' => $request->despachoparte_id, 'estado' =>0 ]);
        }
        return redirect()->route('au-partemovimiento.view',$request->despachoparte_id);
    }
    protected function delete_personal_activo(Request $request)
    {        
        AuDespachoPersonal::find($request->id)->delete();        

        return redirect()->route('au-partemovimiento.view',$request->despachoparte_id);
    }




    protected function store_personal_reemplazo(Request $request)
    {
        $funcionario=  AdmFuncionario::find($request->nombre2);

        $cargo = DB::table('adm_funcionario_cargos as aff')//...
                ->join('adm_cargos as ac','ac.id', 'aff.cargo_id')
                ->select('ac.nombre')
                ->where('aff.funcionario_id', $funcionario->id)
                ->where('aff.activo',1)->get();

        $reemplazando = $cargo[0]->nombre.'-'.$funcionario->persona->nombrecompleto();
        $reemplazado = $request->cargo1.'-'.$request->nombre1;

        AuDespachoPersonal::where('id',$request->id)->delete();

        AuDespachoPersonal::create(['cargo'=> $cargo[0]->nombre, 'nombre'=> $funcionario->persona->nombrecompleto(), 'estado' => $request->tipo, 'despachoparte_id'=>$request->despachoparte_id]);

        AuDespachoPersonalReemplazo::create(['reemplazando'=>$reemplazando,'reemplazado'=>$reemplazado, 'despachoparte_id'=>$request->despachoparte_id]);

        return redirect()->route('au-partemovimiento.view',$request->despachoparte_id);
    }
    protected function delete_personal_reemplazo(Request $request)
    {
        
        AuDespachoPersonalReemplazo::find($request->id)->delete();

        return redirect()->route('au-partemovimiento.view',$request->despachoparte_id);
    }

    protected function close_parte_diario($id)
    {

        $cerrar = DB::table('au_despacho_partes as adp')
            ->join('au_despacho_detalles as adds', 'adds.id', 'adp.despachodetalle_id')
            ->join('au_despachos as ad', 'ad.id', 'adds.despacho_id')
            ->select('ad.id as despacho', 'adds.id as detalle', 'adp.id as parte')
            ->where('adp.id', $id)->get();
        
        // return $cerrar;

        AuDespachoParte::where('id',$cerrar[0]->parte)->update(['estado' => 3]);
        AuDespachoDetalle::where('id',$cerrar[0]->detalle)->update(['activo' => 3]);
        toastr()->success('Ha sido registrado con exito' , 'Información' , ["closeButton" => "true","progressBar" => "true" ]);
        return redirect()->route('detalledespachos', $cerrar[0]->despacho);

    }









    protected function select_ajax_personal($id, $despacho)
    {

        //para elaborador de parte diario                           primera vista
        //para agrgar los recolectores
        $personal = DB::table('adm_personas as ap')
            ->join('adm_funcionarios as af' , 'af.persona_id' , 'ap.id')
            ->join('adm_funcionario_cargos as aff', 'aff.funcionario_id', 'af.id')//...
            ->join('adm_cargos as ac','ac.id', 'aff.cargo_id')//.....
            ->join('adm_funcionario_designacion_sis as afc' , 'afc.funcionario_id' , 'af.id')
            ->select('af.id', 'ap.nombre', 'ap.apellidopaterno', 'ap.apellidomaterno','ac.nombre as cargo')
            ->where('aff.activo',1)//....
            ->where('afc.designaciones_id',$id)
            ->where('af.activo',1)->get();
       
        $inabilitado = DB::table('au_despacho_detalles as addd')             
            ->join('au_despacho_partes as adp' , 'adp.despachodetalle_id' , 'addd.id')
            ->join('au_despacho_personals as ap' , 'ap.despachoparte_id' , 'adp.id')
            ->select('ap.nombre')
            ->where('adp.estado',1)
            ->where('addd.despacho_id',$despacho)->get();
        
        $nom = "";
        $ok=true;
        // $i=0;
        // $personaTotal = array();
        $collection = collect();
        foreach($personal as $per)
        {
            $nom = $per->nombre.' '.$per->apellidopaterno.' '.$per->apellidomaterno;
            foreach($inabilitado as $ina)
            {                
                if($nom == $ina->nombre)
                {
                    $ok= false;
                }
            }
            if($ok)
            {
                $collection->push(['id' => $per->id, 'cargo' => $per->cargo, 'nombre' => $nom]);
                // $personaTotal[$i]= $nom;
                // $i++;
            }
            $ok=true;
            
        }
        return $collection;
    }
}
