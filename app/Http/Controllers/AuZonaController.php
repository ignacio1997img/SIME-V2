<?php

namespace App\Http\Controllers;

use App\AuZona;
use App\AuDia;
use App\AuFrecuencia;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class AuZonaController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:au-zonas.index')->only('index');
        $this->middleware('permission:au-zonas.store')->only('store');
    }
    protected function index()
    {
        $zonas = AuZona::all();
        $zonadia = DB::table('au_zonas as z')
                ->join('au_frecuencias as f', 'f.zona_id', 'z.id')
                ->join('au_dias as d', 'd.id', 'f.dia_id')
                ->select('z.id', 'd.nombre')->get();
                // return $zonas;
        $dias = AuDia::all();
        return view('AseoUrbano.RTDomiciliario.indexZona', compact('zonas', 'dias', 'zonadia'));
    }

    protected function store(Request $request)
    {
        $zona = AuZona::create($request->all());
        $dias = $request->dias;

        foreach($dias as $dia)
        {
            AuFrecuencia::create(
                [
                    'zona_id' => $zona['id'],
                    'dia_id'  => $dia
                ]
                );
        }


        toastr()->success('Ha sido registrado con exito' , 'Información' , ["closeButton" => "true","progressBar" => "true" ]);
        return redirect()->route('zona.index');
    }
    
}
