<?php

namespace App\Http\Controllers;

use App\AuBarrio;
use App\AuContacto;
use App\AuDistrito;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AuBarrioController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:au-barrios.index')->only('index');
        $this->middleware('permission:au-barrios.store')->only('store');
    }

    protected function index()
    {       
        $barrios = DB::table('au_barrios as d')
            ->join('au_distritos as b', 'b.id', 'd.distrito_id')
            ->leftjoin('au_barrio_contactos as dc', 'dc.barrio_id', 'd.id')
            ->leftjoin('au_contactos as c', 'c.id', 'dc.contacto_id')
            ->select('d.id','b.descripcion as distrito', 'd.descripcion as barrio', 'c.nombrecompleto', 'c.telefono', 'dc.activo')
            ->whereNotNull('d.id')
            ->orwhere('dc.activo', 1)->get();
            // return $barrios;
        $contactos = AuContacto::where('barrio', 0)->get();
        $distritos = AuDistrito::all();
        return view('AseoUrbano.InformacionBasica.indexBarrio', compact('barrios', 'contactos', 'distritos'));
    }

    protected function store(Request $request)
    {   
        AuBarrio::create($request->all());
        toastr()->success('Ha sido registrado con exito' , 'Información' , ["closeButton" => "true","progressBar" => "true" ]);
        return redirect()->route('barrio.index');
    }
    protected function update_barrio(Request $request)
    {
        $ok =AuBarrio::find($request->id);
        $ok->update($request->all());
        toastr()->success('Ha sido actualizado con exito' , 'Información' , ["closeButton" => "true","progressBar" => "true" ]);
        return redirect()->route('barrio.index');
    }
    public function view_historial($id)
    {
        $barrio =AuBarrio::find($id);
        $barrios = DB::table('au_barrios as d')
            ->join('au_barrio_contactos as dc', 'dc.barrio_id', 'd.id')
            ->join('au_contactos as c', 'c.id', 'dc.contacto_id')
            ->select('d.descripcion', 'c.nombrecompleto', 'c.telefono','c.direccion','c.referencia', 'dc.activo','dc.created_at as de', 'dc.updated_at as hasta')        
            ->where('d.id', $id)->get();
        
            // return $barrios;

        $bar = DB::table('au_barrios as d')
            ->join('au_barrio_contactos as dc', 'dc.barrio_id', 'd.id')
            ->join('au_contactos as c', 'c.id', 'dc.contacto_id')
            ->where('d.id', $id)->count();
        // return $distritos;
        $fechaprint = Carbon::now()->format('d/m/Y');
        $hraprint = Carbon::now()->format('H:i A'); 
        return view('AseoUrbano.InformacionBasica.Historial.historialBarrio', compact('barrio','barrios', 'bar', 'fechaprint', 'hraprint'));
    }
}
