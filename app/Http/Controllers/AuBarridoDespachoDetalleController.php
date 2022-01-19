<?php

namespace App\Http\Controllers;

use App\AuBarridoDespachoDetalle;
use App\AuBarridoDespacho;
use App\AuBarridoRuta;
use App\AuBarridoPersonalReemplazo;
use App\AuBarridoPersonal;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use Illuminate\Http\Request;

class AuBarridoDespachoDetalleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {             
        $despacho = AuBarridoDespacho::find($id);

        $detalles = DB::table('au_barrido_despacho_detalles as abdd')    
            ->join('au_barrido_rutas as ar', 'ar.id' , 'abdd.ruta_id')
            ->select('abdd.id','ar.nombre', 'ar.id as ruta_id', 'ar.descripcion','abdd.turno', 'abdd.activo')
            ->where('abdd.despacho_id',$id)->orderBy('abdd.id')->get();
            
        $rutas = AuBarridoRuta::all();

        $i=0;
        $ok=true;
        $collection = collect();
        foreach($rutas as $r)
        {
            foreach($detalles as $d)
            {
                if($r->nombre == $d->nombre && ($d->activo == 1 || $d->activo == 2))
                {
                    unset($rutas[$i]);
                }
            }
            $i++;
        }

        $dcant = AuBarridoDespachoDetalle::where('despacho_id',$id)->count();
        $ok = AuBarridoDespachoDetalle::where('despacho_id',$id)->where('activo',3)->count();
        
        return view('AseoUrbano.RTBarrido.despachodetalle', compact('rutas', 'detalles','despacho', 'dcant', 'ok'));
    }

    public function store(Request $request)
    {
        // return $request;
        AuBarridoDespachoDetalle::create($request->all());
        toastr()->success('Ha sido registrado con exito' , 'Información' , ["closeButton" => "true","progressBar" => "true" ]);
        return redirect()->route('au-rtbarrido.despacho.viewdespachodetalle',$request->despacho_id);
    }
    protected function update_detalledespacho(Request $request)
    {
        // return $request;
        AuBarridoDespachoDetalle::where('id',$request->id)->update(['ruta_id' => $request->ruta_id, 'turno' => $request->turno]);
        // $ok->update(['ruta_id' => $request->ruta_id, 'turno' => $request->turno]);
        toastr()->success('Ha sido registrado con exito' , 'Información' , ["closeButton" => "true","progressBar" => "true" ]);
        return redirect()->route('au-rtbarrido.despacho.viewdespachodetalle',$request->despacho_id);

    }
    protected function destroy(Request $request)
    {
        // return  $request;
        AuBarridoDespachoDetalle::where('id',$request->id)->delete();

        return redirect()->route('au-rtbarrido.despacho.viewdespachodetalle',$request->despacho_id);
    }
    protected function close_despacho($id)
    {
        AuBarridoDespacho::where('id',$id)->update(['estado'=>0]);
        
        return redirect()->route('barridodespacho.index');
    }
    protected function printf($id)
    {
        // $despacho = AuDespacho::find($id);
        $fechaprint = Carbon::now()->format('d/m/Y');
        $hraprint = Carbon::now()->format('H:i A'); 
        $detalle = AuBarridoDespachoDetalle::find($id);
        // return $detalle;
        $ruta = AuBarridoRuta::find($detalle->ruta_id);

        $personal = AuBarridoPersonal::where('despachodetalle_id',$detalle->id)
            ->where('estado',1)->orderBy('nombre')->get();
        
        $personareemplazada = AuBarridoPersonalReemplazo::where('despachodetalle_id', $detalle->id)->orderBy('id')->get();

       
        return view('AseoUrbano.RTBarrido.Kardex.printfDetalle', compact('fechaprint','hraprint','detalle','ruta','personal','personareemplazada'));
    }

    protected function select_ajax_rutas($id,$ruta_id)
    {

        $detalles = DB::table('au_barrido_despacho_detalles as abdd')    
            ->join('au_barrido_rutas as ar', 'ar.id' , 'abdd.ruta_id')
            ->select('abdd.id','ar.nombre', 'ar.id as ruta_id', 'ar.descripcion','abdd.turno', 'abdd.activo')
            ->where('abdd.despacho_id',$id)->orderBy('abdd.id')->get();
            
        $rutas = AuBarridoRuta::all();
        $ruta = AuBarridoRuta::find($ruta_id);

        $ok=true;
        $collection = collect();
        foreach($rutas as $r)
        {
            foreach($detalles as $d)
            {
                if($r->nombre == $d->nombre && ($d->activo == 1 || $d->activo == 2))
                {
                    $ok=false;
                }
            }
            if($ok == true)
            {
                $collection->push(['id' => $r->id, 'nombre' => $r->nombre]);
            }
            $ok=true;
        }
        $collection->push(['id' => $ruta->id, 'nombre' => $ruta->nombre]);
        return $collection;

        // $data = [
        //     ['name' => 'Taylor',  'coffee_drinker' => true],
        //     ['name' => 'Matt', 'coffee_drinker' => true]
        // ];
        
        
        // $collection->push(['name' => 'Deskdd', 'pricedd' => 20032]);
                
        // return $collection;
    }

    
}
