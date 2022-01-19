<?php

namespace App\Http\Controllers;

use App\AuBarrio;
use App\AuContacto;
use App\AuDistrito;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
// use App\http\Controllers\AuBarrioController;
use Illuminate\Http\Request;

class AuContructorController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:au-reportebasico.index')->only('index');
    }
    protected function index()
    {
        $contactos = AuContacto::all();
        $distritos = AuDistrito::all();
        return view('AseoUrbano.InformacionBasica.indexReporte', compact('distritos' ,'contactos'));
    }




protected function view_reporte_constructor(Request $request)
{
    $fechaprint = Carbon::now()->format('d/m/Y');
    $hraprint = Carbon::now()->format('H:i A'); 
    if($request->opcion == 1)
    {//para todo los distrito
        if($request->distrito_id == 'TODOS')
        {
            $nombres = AuDistrito::all();
            // return $nombres;
            $distritos = DB::table('au_distritos as d')
                ->leftjoin('au_distrito_contactos as dc', 'dc.distrito_id', 'd.id')
                ->leftjoin('au_contactos as c', 'c.id', 'dc.contacto_id')
                ->select('d.id', 'c.nombrecompleto', 'c.telefono','c.direccion','c.referencia')    
                ->where('dc.activo',1)   
                ->whereNotNull('d.id')
                ->orwhere('dc.activo', 1)->get();

                

            
            return view('AseoUrbano.InformacionBasica.Historial.reporteDistritoTodo', compact('nombres','distritos', 'fechaprint', 'hraprint'));
            
        }
        else
        {
            // para un solo distrito
            $nombre =AuDistrito::find($request->distrito_id);
            $distritos = DB::table('au_distritos as d')
                ->join('au_distrito_contactos as dc', 'dc.distrito_id', 'd.id')
                ->join('au_contactos as c', 'c.id', 'dc.contacto_id')
                ->select('d.descripcion', 'c.nombrecompleto', 'c.telefono','c.direccion','c.referencia', 'dc.activo','dc.created_at as de', 'dc.updated_at as hasta')        
                ->where('d.id', $request->distrito_id)->get();

            $dis = DB::table('au_distritos as d')
                ->join('au_distrito_contactos as dc', 'dc.distrito_id', 'd.id')
                ->join('au_contactos as c', 'c.id', 'dc.contacto_id')        
                ->where('d.id',$request->distrito_id)->count();
            // return $distritos;
            return view('AseoUrbano.InformacionBasica.Historial.reporteDistrito', compact('nombre','distritos', 'dis', 'fechaprint', 'hraprint'));
        }
    }
    else
    {
        if($request->barrio_id != 'TODOS1')
        {   
            
            $barrio =AuBarrio::find($request->barrio_id);
            $barrios = DB::table('au_barrios as d')
                ->join('au_barrio_contactos as dc', 'dc.barrio_id', 'd.id')
                ->join('au_contactos as c', 'c.id', 'dc.contacto_id')
                ->select('d.descripcion', 'c.nombrecompleto', 'c.telefono','c.direccion','c.referencia', 'dc.activo','dc.created_at as de', 'dc.updated_at as hasta')        
                ->where('d.id', $request->barrio_id)->get();
            
                // return $barrios;

            $bar = DB::table('au_barrios as d')
                ->join('au_barrio_contactos as dc', 'dc.barrio_id', 'd.id')
                ->join('au_contactos as c', 'c.id', 'dc.contacto_id')
                ->where('d.id', $request->barrio_id)->count();
            return view('AseoUrbano.InformacionBasica.Historial.historialBarrio', compact('barrio','barrios', 'bar', 'fechaprint', 'hraprint'));
        }
        else
        {
            $ok = $request->contacto;
            if($request->distrito_id == 'TODOS' && $request->barrio_id == 'TODOS1')
            {
                $distritos = AuDistrito::all();
                $barrios = DB::table('au_barrios as ab')
                        ->select('ab.distrito_id as id', 'ab.descripcion as barrio', 'ac.nombrecompleto', 'ac.telefono', 'ac.referencia', 'ac.direccion', 'abc.activo')
                        ->leftjoin('au_barrio_contactos as abc', 'abc.barrio_id', 'ab.id')
                        ->leftjoin('au_contactos as ac', 'ac.id', 'abc.contacto_id')->get();
                // return $barrios;
                return view('AseoUrbano.InformacionBasica.Historial.reporteBarrio', compact('barrios','distritos', 'fechaprint', 'hraprint', 'ok'));
            }
            else
            {
                if($request->distrito_id != 'TODOS' && $request->barrio_id == 'TODOS1')
                {
                    $distritos = AuDistrito::find($request->distrito_id);

                    $barrios = DB::table('au_barrios as ab')
                        ->select('ab.distrito_id as id', 'ab.descripcion as barrio', 'ac.nombrecompleto', 'ac.telefono', 'ac.referencia', 'ac.direccion', 'abc.activo')
                        ->leftjoin('au_barrio_contactos as abc', 'abc.barrio_id', 'ab.id')
                        ->leftjoin('au_contactos as ac', 'ac.id', 'abc.contacto_id')
                        ->where('ab.distrito_id', $request->distrito_id)->get();
            
                    return view('AseoUrbano.InformacionBasica.Historial.reporteBarrioTodo', compact('barrios','distritos', 'fechaprint', 'hraprint', 'ok'));
                }
                
                
            }
        }

    }
}
































    protected function select_ajax_barrios($dato)
    {
        if($dato == 'TODOS')
        {
            return AuBarrio::all();
        }
        else
        {
            return AuBarrio::where('distrito_id', $dato)->get();
        }
    }
}
