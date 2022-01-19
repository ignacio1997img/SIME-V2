<?php

namespace App\Http\Controllers;

use App\AuBarridoRuta;
// use Illuminate\Support\Carbon;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class AuBarridoRutaController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:au-rutabarrido.index')->only('index');
        $this->middleware('permission:au-rutabarrido.store')->only('store');
    }
    public function index()
    {
        $rutas = AuBarridoRuta::all();
        return view('AseoUrbano.RTBarrido.indexRuta', compact('rutas'));
    }

    
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        if($request->hasFile("urlimg"))
        {
            $file = $request->file("urlimg");
            // dd($file);
            // return $file;
            $nombre = 'Barrido ruta_'.strtolower($request->nombre).'_'.time().'.'.$file->guessExtension();
            // dd($nombre);
            $ruta = storage_path("files\aseourbano\Barrido Ruta/".$nombre);

            if($file->guessExtension() == 'png' || $file->guessExtension() == 'jpg')
            {
                copy($file, $ruta);
                // $request->merge(['tipo_id' => 1]);

                // $request->merge(['descripcion' => strtoupper($request->descripcion)]);
                // $request->merge(['turno' => strtoupper($request->turno)]);

                $rutas = request()->except('_token');
                
                // dd($rutas);                
                $rutas['urlimg'] = 'Barrido Ruta/'.$nombre;
                // return $rutas;
                AuBarridoRuta::insert($rutas);
                toastr()->success('Ha sido registrado con exito' , 'Información' , ["closeButton" => "true","progressBar" => "true" ]);
                return redirect()->route('barridoruta.index');
            }
            else
            {
                toastr()->error('No ha sido registrado, ERROR EN EL TIPO DE ARCHIVO' , 'Información' , ["closeButton" => "true","progressBar" => "true" ]);
                return redirect()->route('barridoruta.index');
            }
        }   
    }

    protected function kardex($id)
    {
        $rutas = AuBarridoRuta::find($id);

        // return $rutas;

        $fechaprint = Carbon::now()->format('d/m/Y');
        $hraprint = Carbon::now()->format('H:i A');
        return view('AseoUrbano.RTBarrido.Kardex.kardexRuta', compact('rutas','fechaprint', 'hraprint'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\AuBarridoRuta  $auBarridoRuta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AuBarridoRuta $auBarridoRuta)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\AuBarridoRuta  $auBarridoRuta
     * @return \Illuminate\Http\Response
     */
    public function destroy(AuBarridoRuta $auBarridoRuta)
    {
        //
    }
}
