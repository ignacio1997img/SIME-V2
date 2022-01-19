<?php

namespace App\Http\Controllers;

use App\AuDespacho;
use App\AuRuta;
use Illuminate\Support\Carbon;
use Facade\Ignition\QueryRecorder\Query;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class AuReporteDomiciliarioController extends Controller
{
    protected function index()
    {
        $rutas = AuRuta::all();
        return view('AseoUrbano.RTDomiciliario.indexReporte', compact('rutas'));
    }

    protected function printf(Request $request)
    {
        $lunes= $request->lunes;
        $martes =$request->martes;
        $miercoles =$request->miercoles;
        $jueves =$request->jueves;
        $viernes =$request->viernes;
        $sabado =$request->sabado;
        $domingo =$request->domingo;
        $todo =$request->tododia;
        // return $request;
        if($request->ruta == "TODO")
        {
            $t =1;
            // if($request->tododia == 1)
            // {
                $resultado = DB::table('au_despachos as ad')
                    ->join('au_despacho_detalles as addd', 'addd.despacho_id', 'ad.id')
                    ->join('au_despacho_partes as adp', 'adp.despachodetalle_id', 'addd.id')
                    ->join('au_rutas as ar', 'ar.id', 'addd.ruta_id')
                    ->join('au_despacho_peso_totals as adpt', 'adpt.despachoparte_id', 'adp.id')
                    ->join('ma_vehiculos as mv' , 'mv.interno' ,  'addd.vehiculo_id')
                    ->join('ma_modelo_vehiculos as mmv' , 'mmv.id' , 'mv.modelo_id')
                    ->join('ma_marcas as mm' , 'mm.id' , 'mmv.marca_id')
                    ->join('ma_tipo_vehiculos as atv' , 'atv.id' , 'mv.tipo_id')
                    ->select('ad.fecha', 'ar.descripcion as ruta', 'addd.vehiculo_id', 'adpt.id', 'adpt.peso', 'adpt.viaje','mv.interno', 'atv.descripcion as tipo', 'mm.descripcion as marca', 'mv.placa')
                    ->where('ad.estado',0)
                    ->where('ad.fecha','>=', $request->inicio)
                    ->where('ad.fecha','<=', $request->fin)->orderBy('ad.fecha')->orderBy('ar.descripcion')->get();
        }
        else
        {
            $t =0;
            $ruta = AuRuta::find($request->ruta)->descripcion;
            $resultado = DB::table('au_despachos as ad')
                    ->join('au_despacho_detalles as addd', 'addd.despacho_id', 'ad.id')
                    ->join('au_despacho_partes as adp', 'adp.despachodetalle_id', 'addd.id')
                    ->join('au_despacho_peso_totals as adpt', 'adpt.despachoparte_id', 'adp.id')
                    ->join('au_rutas as ar', 'ar.id', 'addd.ruta_id')
                    ->join('ma_vehiculos as mv' , 'mv.interno' ,  'addd.vehiculo_id')
                    ->join('ma_modelo_vehiculos as mmv' , 'mmv.id' , 'mv.modelo_id')
                    ->join('ma_marcas as mm' , 'mm.id' , 'mmv.marca_id')
                    ->join('ma_tipo_vehiculos as atv' , 'atv.id' , 'mv.tipo_id')
                    ->select('ad.fecha', 'ar.descripcion as ruta', 'addd.vehiculo_id', 'adpt.id', 'adpt.peso', 'adpt.viaje', 'mv.interno', 'atv.descripcion as tipo', 'mm.descripcion as marca', 'mv.placa')
                    ->where('ad.estado',0)
                    ->where('addd.ruta_id',$request->ruta)
                    ->where('ad.fecha','>=', $request->inicio)
                    ->where('ad.fecha','<=', $request->fin)->orderBy('ad.fecha')->orderBy('ar.descripcion')->orderBy('ar.descripcion')->get();
        }
        $fechaprint = Carbon::now()->format('d/m/Y');
        $hraprint = Carbon::now()->format('H:i A'); 
        $inicio = $request->inicio;
        $fin = $request->fin;

        // return $resultado;
        
        return view('AseoUrbano.RTDomiciliario.Kardex.printfReporte', 
        compact('t','lunes', 'martes', 'miercoles', 'jueves', 'viernes', 'sabado', 'domingo', 'ruta','todo','resultado','inicio','fin','fechaprint','hraprint'));
    }

    protected function printfmes(Request $request)
    {     

        // return $mes;

        // select DATE_FORMAT(fecha,'%m-%Y') AS date from au_despachos GROUP by(DATE_FORMAT(fecha,'%m-%Y'))

        $itime=strtotime($request->iniciom);
        $imonth=date("m",$itime);
        $iyear=date("Y",$itime);

        $ftime=strtotime($request->finm);
        $fmonth=date("m",$ftime);
        $fyear=date("Y",$ftime);

        // return AuDespacho::all();
        
        $mes = DB::table('au_despachos')
            ->select(DB::raw('DATE_FORMAT(fecha, "%Y-%m") as fechas'))
            ->whereMonth('fecha', '>=', $imonth)
            ->whereYear('fecha', '>=', $iyear)
            ->whereMonth('fecha', '<=', $fmonth)
            ->whereYear('fecha', '<=', $fyear)
            ->orderBy('fechas')
            ->groupBy('fechas')->get();

        $agrupados = DB::table('au_despachos as ad')
            ->join('au_despacho_detalles as addd', 'addd.despacho_id', 'ad.id')
            ->join('au_rutas as ar', 'ar.id', 'addd.ruta_id')
            ->join('au_despacho_partes as adp', 'adp.despachodetalle_id', 'addd.id')
            ->join('au_despacho_peso_totals as adpt', 'adpt.despachoparte_id', 'adp.id')
            ->select(DB::raw('DATE_FORMAT(ad.fecha, "%Y-%m") as fechas'),'ar.descripcion', DB::raw("SUM(adpt.viaje) as viajes"),DB::raw("SUM(adpt.peso) as pesos"))
            ->whereMonth('ad.fecha', '>=', $imonth)
            ->whereYear('ad.fecha', '>=', $iyear)
            ->whereMonth('ad.fecha', '<=', $fmonth)
            ->whereYear('ad.fecha', '<=', $fyear)
            ->groupBy('fechas')->groupBy('ar.descripcion')->orderBy('fechas')->orderBy('ar.descripcion')->get();

        // return $agrupados;
        // select DATE_FORMAT(ad.fecha,'%Y-%m') as fech, ar.descripcion, sum(adpt.viaje), sum(adpt.peso) from au_despachos as ad 
        // inner join au_despacho_detalles as addd on addd.despacho_id = ad.id	
        // inner join au_rutas as ar on ar.id = addd.ruta_id
        // inner join au_despacho_partes as adp on adp.despachodetalle_id = addd.id
        // inner join au_despacho_peso_totals as  adpt on adpt.despachoparte_id = adp.id
        // GROUP by fech,  ar.descripcion
       
        $fechaprint = Carbon::now()->format('d/m/Y');
        $hraprint = Carbon::now()->format('H:i A'); 
  

        // return $mes;
        
        return view('AseoUrbano.RTDomiciliario.Kardex.printfReportemes', compact('mes','agrupados','fechaprint','hraprint'));
    }
}
