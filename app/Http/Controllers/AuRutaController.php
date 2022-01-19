<?php

namespace App\Http\Controllers;

use App\AuRuta;
use App\AuTipoServicio;
use App\AuZona;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class AuRutaController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:au-rutas.index')->only('index');
        $this->middleware('permission:au-rutas.store')->only('store');
    }
    protected function index()
    {
        $rutas = AuRuta::all();
        $frecuencias = DB::table('au_rutas as r')
            ->join('au_zonas as z', 'z.id', 'r.zona_id')
            ->join('au_frecuencias as f', 'f.zona_id', 'z.id')
            ->join('au_dias as d', 'd.id', 'f.dia_id')
            ->select('r.id', 'd.nombre')->get();
        // return $frecuencias;

        $zonas = AuZona::all();
        $tipos = AuTipoServicio::all();
        return view('AseoUrbano.RTDomiciliario.indexRuta', compact('rutas', 'tipos', 'zonas', 'frecuencias'));
    }

    protected function store(Request $request)
    {
        // dd($request);
        // return response()->json($request);
        if($request->hasFile("urlimg"))
        {
            $file = $request->file("urlimg");

            $nombre = 'ruta_'.strtolower($request->descripcion).'_'.time().'.'.$file->guessExtension();
            // dd($nombre);
            $ruta = storage_path("files/aseourbano/ruta/".$nombre);

            if($file->guessExtension() == 'png' || $file->guessExtension() == 'jpg')
            {
                copy($file, $ruta);
                $request->merge(['tipo_id' => 1]);

                $request->merge(['descripcion' => strtoupper($request->descripcion)]);
                $request->merge(['turno' => strtoupper($request->turno)]);

                $rutas = request()->except('_token');
                // dd($rutas);                
                $rutas['urlimg'] = 'ruta/'.$nombre;

                AuRuta::insert($rutas);
                toastr()->success('Ha sido registrado con exito' , 'Información' , ["closeButton" => "true","progressBar" => "true" ]);
                return redirect()->route('ruta.index');
            }
            else
            {
                toastr()->error('No ha sido registrado, ERROR EN EL TIPO DE ARCHIVO' , 'Información' , ["closeButton" => "true","progressBar" => "true" ]);
                return redirect()->route('ruta.index');
            }
        }        
    }
    public $aux ='';
    private function cadena()
    {
        $resul='';
        for($i=0; $i<strlen($this->aux)-2; $i++)
        {
            $resul= $resul.$this->aux[$i];
        }        
        return $resul;
    }
    protected function kardex($id)
    {
        $ruta = AuRuta::find($id);
        $this->aux='';
        $frecuencias = DB::table('au_rutas as r')
            ->join('au_zonas as z', 'z.id', 'r.zona_id')
            ->join('au_frecuencias as f', 'f.zona_id', 'z.id')
            ->join('au_dias as d', 'd.id', 'f.dia_id')
            ->select('d.nombre')
            ->where('r.id', $id)->get();

        foreach($frecuencias as $f)
        {
            $this->aux = $this->aux.$f->nombre.' - ';
        }
        $frecuencias = $this->cadena();

        $fechaprint = Carbon::now()->format('d/m/Y');
        $hraprint = Carbon::now()->format('H:i A');
        return view('AseoUrbano.RTDomiciliario.Kardex.kardexRuta', compact('ruta','fechaprint', 'hraprint', 'frecuencias'));
    }

}
