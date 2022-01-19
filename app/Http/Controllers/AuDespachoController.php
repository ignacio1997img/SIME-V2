<?php

namespace App\Http\Controllers;

use App\AuDespacho;
use App\AuRuta;
use App\MaModeloVehiculo;
use App\MaVehiculo;
use App\AuDespachoDetalle;
use Carbon\Carbon;
use App\AuDespachoParteEstimado;
use Jenssegers\Date\Date;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class AuDespachoController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:au-despachodomiciliario.index')->only('index');
        // $this->middleware('permission:ma-marca.store')->only('store');
    }

    protected function index()
    {       
        // 
        $despachos = AuDespacho::orderBy('fecha','DESC')->get();
        $cant = AuDespacho::where('estado',1)->count();
        // return $cant;
        return view('AseoUrbano.RTDomiciliario.indexDespacho', compact('despachos','cant'));
    }



    protected function store(Request $request)
    {
        AuDespacho::create($request->all());
        toastr()->success('Ha sido registrado con exito' , 'Información' , ["closeButton" => "true","progressBar" => "true" ]);
        return redirect()->route('despacho.index');
    }

 
    protected function view_detalle($id)
    {
        $dcant = AuDespachoDetalle::where('despacho_id',$id)->count();
        $ok = AuDespachoDetalle::where('despacho_id',$id)->where('activo',3)->count();


        $despacho = AuDespacho::find($id);

        $detalles = DB::table('au_despacho_detalles as adde')       
            ->join('au_despachos as ad', 'ad.id','adde.despacho_id')
            ->join('ma_vehiculos as mv' , 'mv.interno' ,  'adde.vehiculo_id')
            ->join('ma_modelo_vehiculos as mmv' , 'mmv.id' , 'mv.modelo_id')
            ->join('ma_marcas as mm' , 'mm.id' , 'mmv.marca_id')
            ->join('ma_tipo_vehiculos as atv' , 'atv.id' , 'mv.tipo_id')
            ->join('au_rutas as ar', 'ar.id' , 'adde.ruta_id')
            ->select('adde.id', 'ar.descripcion as ruta', 'mv.interno', 'atv.descripcion as tipo', 'mm.descripcion as marca', 'mv.placa', 'adde.activo')
            ->where('adde.despacho_id',$id)->orderBy('adde.id')->get();

        $rutas = AuRuta::all();
        $vehiculos = MaVehiculo::where('estado','=','FUNCIONAMIENTO')->get();

        $i=0;
        foreach($vehiculos as $v)
        {
            foreach($detalles as $d)
            {
                if($v->interno == $d->interno && ($d->activo == 1 || $d->activo == 2))
                {
                    unset($vehiculos[$i]);
                }
            }
            $i++;
        }
        // return 3;
        return view('AseoUrbano.RTDomiciliario.despachodetalle', compact('despacho', 'rutas', 'vehiculos', 'detalles','dcant', 'ok'));
    }


    protected function printf($id)
    {
        $despacho = AuDespacho::find($id);
        $fechaprint = Carbon::now()->format('d/m/Y');
        $hraprint = Carbon::now()->format('H:i A'); 

        $detalles = DB::table('au_despachos as ad')     
            ->join('au_despacho_detalles as adde','adde.despacho_id','ad.id')  
            ->join('ma_vehiculos as mv' , 'mv.interno' ,  'adde.vehiculo_id')
            ->join('ma_modelo_vehiculos as mmv' , 'mmv.id' , 'mv.modelo_id')
            ->join('ma_marcas as mm' , 'mm.id' , 'mmv.marca_id')
            ->join('ma_tipo_vehiculos as atv' , 'atv.id' , 'mv.tipo_id')
            ->join('au_rutas as ar', 'ar.id' , 'adde.ruta_id')
            ->leftjoin('au_despacho_partes as adp', 'adp.despachodetalle_id', 'adde.id')
            ->select('adp.turno','adp.turno','adp.cotidiano','ad.fecha','adde.id', 'ar.descripcion as ruta', 'mv.interno', 'atv.descripcion as tipo', 'mm.descripcion as marca', 'mv.placa', 'adde.activo',
                     'adp.parte as nparte','adp.id as parte','adde.id as detalle','adp.obsparte')
            ->where('ad.id',$id)
            ->orderBy('adde.id')->get();

        $personals = DB::table('au_despachos as ad')
            ->join('au_despacho_detalles as adda','adda.despacho_id', 'ad.id')
            ->join('au_despacho_partes as adp','adp.despachodetalle_id', 'adda.id')
            ->join('au_despacho_personals as adpp','adpp.despachoparte_id', 'adp.id')
            ->select('ad.fecha', 'adda.id as despacho', 'adp.id as parte', 'adpp.cargo', 'adpp.nombre')
            ->where('ad.id',$id)
            ->orderBy('adda.id')->orderby('adpp.cargo')->get();

            // return $detalles;

        $viajes = DB::table('au_despachos as ad')
            ->join('au_despacho_detalles as adda','adda.despacho_id', 'ad.id')
            ->join('au_despacho_partes as adp','adp.despachodetalle_id', 'adda.id')
            ->join('au_despacho_parte_estimados as adpe','adpe.despachoparte_id', 'adp.id')
            ->select('ad.fecha', 'adda.id as despacho', 'adp.id as parte', 'adpe.pesobascula')
            ->where('ad.id',$id)
            ->orderBy('adda.id')->get();
        return view('AseoUrbano.RTDomiciliario.Kardex.printfDespachoDiario', compact('personals','viajes','detalles','despacho','fechaprint','hraprint'));
    }


    // reportes 
    protected function reporte_()
    {

    }
}
