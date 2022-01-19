<?php

namespace App\Http\Controllers;
use App\AuDespachoCombustible;
use App\AdmEmpresa;
use App\AuDespachoDetalle;
use App\AuDespachoParte;
use App\AuPartePersonal;
use App\AuDespachoParteEstimado;
use App\AuDespachoPersonalReemplazo;
use App\AuParteMovimiento;
use App\AdmFuncionario;
use App\AuDespacho;
use App\MaVehiculo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
class AuDespachoDetalleController extends Controller
{

    protected function store(Request $request)
    {
        // return $request;
        AuDespachoDetalle::create($request->all());
        toastr()->success('Ha sido registrado con exito' , 'Información' , ["closeButton" => "true","progressBar" => "true" ]);
        return redirect()->route('detalledespachos',$request->despacho_id);
    }
    protected function update_detalledespacho(Request $request)
    {
        // return $request;
        $ok = AuDespachoDetalle::find($request->id);
        $ok->update(['ruta_id' => $request->ruta_id, 'vehiculo_id' => $request->vehiculo_id, 'fecha' => $request->fecha]);
        toastr()->success('Ha sido registrado con exito' , 'Información' , ["closeButton" => "true","progressBar" => "true" ]);
        return redirect()->route('detalledespachos',$request->despacho_id);

    }
    protected function destroy(Request $request)
    {
        // return  $request;
        AuDespachoDetalle::where('id',$request->id)->delete();

        return redirect()->route('detalledespachos',$request->despacho_id);
    }

    protected function view_partediario($id)
    {

        $detalle = AuDespachoDetalle::find($id);
        $vehiculo = MaVehiculo::where('interno', $detalle->vehiculo_id)->get();
        // return $vehiculo;

        // $choferes = DB::table('adm_personas as ap')
        //     ->select('af.id' ,'ap.nombre', 'ap.apellidopaterno', 'ap.apellidomaterno')
        //     ->join('adm_funcionarios as af', 'af.persona_id', 'ap.id')
        //     ->join('adm_funcionario_designacion_sis as afd', 'afd.funcionario_id', 'af.id')
        //     ->join('adm_designacion_sistemas as ads', 'ads.id','afd.designaciones_id')
        //     ->where('ads.id', 1)->get();

        $registrado = DB::table('adm_personas as ap')
            ->select('af.id' ,'ap.nombre', 'ap.apellidopaterno', 'ap.apellidomaterno')
            ->join('adm_funcionarios as af', 'af.persona_id', 'ap.id')
            ->join('adm_funcionario_designacion_sis as afd', 'afd.funcionario_id', 'af.id')
            ->join('adm_designacion_sistemas as ads', 'ads.id','afd.designaciones_id')
            ->where('ads.id', 4)->get();

        $empresas = AdmEmpresa::where('personal',1)->get();

        $ok = AuDespachoParte::where('despachodetalle_id',$id)->count();
        //para habilitar el select and modal y div de los campos de los combustibles
        $combustible = AuDespachoCombustible::where('despachodetalle_id', $detalle->id)->get();
        $cantCombustible = AuDespachoCombustible::where('despachodetalle_id', $detalle->id)->count();
     
        // return $combustible;
        if($ok == 0)
        {
            return view('AseoUrbano.RTDomiciliario.parteRuta', compact('combustible','cantCombustible','detalle','vehiculo', 'empresas', 'choferes', 'registrado'));
        }
        if($ok >= 1)
        {
            //nets
            $sig = AuDespachoParte::where('despachodetalle_id',$id)->get();
            // return $sig[0]->id;
            return redirect()->route('au-partemovimiento.view', $sig[0]->id);
        }
        
    }
    protected function close_despacho($id)
    {
        AuDespacho::where('id',$id)->update(['estado'=>0]);
        
        return redirect()->route('despacho.index');
    }
    


    protected function printf($id)
    {
        // $despacho = AuDespacho::find($id);
        $fechaprint = Carbon::now()->format('d/m/Y');
        $hraprint = Carbon::now()->format('H:i A'); 

        $detalle = AuDespachoDetalle::find($id);
        $vehiculo = MaVehiculo::where('interno', $detalle->vehiculo_id)->get();

        $idparte = AuDespachoParte::where('despachodetalle_id',$id)->get();
        $parte = AuDespachoParte::find($idparte[0]->id);

        $chofer = AdmFuncionario::find($parte->	chofer);
        $registrado = AdmFuncionario::find($parte->	registradorparte_id);

        $personaactiva = DB::table('au_despacho_partes as apm')
        ->join('au_despacho_personals as adp', 'adp.despachoparte_id', 'apm.id')
        ->select('adp.id','adp.cargo', 'adp.nombre')
        ->where('apm.id', $parte->id)->orderBy('adp.cargo')->get();

        $personareemplazada = AuDespachoPersonalReemplazo::where('despachoparte_id', $parte->id)->get();
// return $personareemplazada;
        $movimientos = AuParteMovimiento::where('despachoparte_id', $id)->get();
        $viajes = AuDespachoParteEstimado::where('despachoparte_id', $id)->orderBy('id')->get();

        $combustible = AuDespachoCombustible::where('despachodetalle_id', $parte->despachodetalle_id)->get();
        $cantCombustible = AuDespachoCombustible::where('despachodetalle_id', $parte->despachodetalle_id)->count();

        return view('AseoUrbano.RTDomiciliario.Kardex.printfParteDiario', compact('chofer','combustible','cantCombustible','personareemplazada','movimientos','viajes','personaactiva','detalle','fechaprint','hraprint','vehiculo', 'parte', 'registrado'));
    }


















    // protected function printf($id)
    // {
    //     $detalle = AuDespachoDetalle::find($id);
    //     $vehiculo = MaVehiculo::where('interno',$detalle->vehiculo_id)->get();
    //     $funcionarios = AuPartePersonal::where('detalledespacho_id', $id)->orderBy('funcionario', 'asc')->get();
    //     // $dif = $detalle->llegada->diffInHours($detalle->salida);
    //     $start  = new Carbon($detalle->llegada);
    //     $end    = new Carbon($detalle->salida);
    //     $ok = $start->diff($end)->format('%H:%I:%S');
    //     return view('AseoUrbano.Despacho.printfparte', compact('detalle', 'vehiculo','funcionarios', 'ok'));
    // }

    // protected function select_ajax_personal($id)
    // {
    //     return DB::table('adm_personas as ap')
    //         ->join('adm_funcionarios as af' , 'af.persona_id' , 'ap.id')
    //         ->join('adm_funcionario_cargos as afc' , 'afc.funcionario_id' , 'af.id')
    //         ->select('af.id', 'ap.nombre', 'ap.apellidopaterno', 'ap.apellidomaterno')
    //         ->where('afc.cargo_id',$id)->get();

    // }
}
