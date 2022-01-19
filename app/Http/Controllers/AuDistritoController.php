<?php

namespace App\Http\Controllers;

use App\AuDistrito;
use App\AuContacto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AuDistritoController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:au-distritos.index')->only('index');
        $this->middleware('permission:au-distritos.store')->only('store');
    }

    protected function index()
    {       
        $distritos = DB::table('au_distritos as d')
            ->leftjoin('au_distrito_contactos as dc', 'dc.distrito_id', 'd.id')
            ->leftjoin('au_contactos as c', 'c.id', 'dc.contacto_id')
            ->select('d.id', 'd.descripcion', 'c.nombrecompleto', 'c.telefono', 'dc.activo')
            ->whereNotNull('d.id')
            ->orwhere('dc.activo', 1)->get();
        $contactos = AuContacto::where('distrito', 0)->get();
        return view('AseoUrbano.InformacionBasica.indexDistrito', compact('distritos', 'contactos'));
    }


    protected function store(Request $request)
    {   
        AuDistrito::create($request->all());
        toastr()->success('Ha sido registrado con exito' , 'Información' , ["closeButton" => "true","progressBar" => "true" ]);
        return redirect()->route('distrito.index');
    }

    protected function update_distrito(Request $request)
    {
        $ok =AuDistrito::find($request->id);
        $ok->update($request->all());
        toastr()->success('Ha sido actualizado con exito' , 'Información' , ["closeButton" => "true","progressBar" => "true" ]);
        return redirect()->route('distrito.index');
    }

    protected function view_historial($id)
    {
        $nombre =AuDistrito::find($id);
        $distritos = DB::table('au_distritos as d')
            ->join('au_distrito_contactos as dc', 'dc.distrito_id', 'd.id')
            ->join('au_contactos as c', 'c.id', 'dc.contacto_id')
            ->select('d.descripcion', 'c.nombrecompleto', 'c.telefono','c.direccion','c.referencia', 'dc.activo','dc.created_at as de', 'dc.updated_at as hasta')        
            ->where('d.id', $id)->get();

        $dis = DB::table('au_distritos as d')
            ->join('au_distrito_contactos as dc', 'dc.distrito_id', 'd.id')
            ->join('au_contactos as c', 'c.id', 'dc.contacto_id')        
            ->where('d.id', $id)->count();
        // return $distritos;
        $fechaprint = Carbon::now()->format('d/m/Y');
        $hraprint = Carbon::now()->format('H:i A'); 
        return view('AseoUrbano.InformacionBasica.Historial.historialDistrito', compact('nombre','distritos', 'dis', 'fechaprint', 'hraprint'));
    }
}
