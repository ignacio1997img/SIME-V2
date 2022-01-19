<?php

namespace App\Http\Controllers;

use App\AuBarridoDespacho;
use App\AuBarridoRuta;
use App\AuBarridoDespachoDetalle;
use App\AuBarridoPersonalReemplazo;
use App\AuBarridoPersonal;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;

class AuBarridoDespachoController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:au-barridodespacho.index')->only('index');
        // $this->middleware('permission:rrhh-tipos.store')->only('store');
    }/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $despachos = AuBarridoDespacho::all()->orderBy('fecha');
        $despachos = AuBarridoDespacho::orderBy('fecha','desc')->get();
        $cant =AuBarridoDespacho::where('estado',1)->count();
        
        // $cant = AuBarridoDespacho::where('estado',1)->count();

        // $cant = DB::table('au_barrido_despachos as ab')
        //     ->join('au_barrido_despacho_detalles as abp','abp.despacho_id','ab.id')
        //     ->where('ad.activo', 1)
        //     ->orwhere('abp.activo',1 )
        //     ->orwhere('abp.activo',2 );

        return view('AseoUrbano.RTBarrido.indexDespacho', compact('despachos', 'cant'));
    }


    public function store(Request $request)
    {
        AuBarridoDespacho::create($request->all());
        toastr()->success('Ha sido registrado con exito' , 'Información' , ["closeButton" => "true","progressBar" => "true" ]);
        return redirect()->route('barridodespacho.index');
    }

    protected function printf($id)
    {
        $despacho = AuBarridoDespacho::find($id);
        $fechaprint = Carbon::now()->format('d/m/Y');
        $hraprint = Carbon::now()->format('H:i A'); 

        $detalles = AuBarridoDespachoDetalle::where('despacho_id',$id)->orderBy('created_at')->get();
        $rutas = AuBarridoRuta::all();

        $personals = AuBarridoPersonal::all();
        $personareemplazada = AuBarridoPersonalReemplazo::all();
        // return $detalles;

        
        return view('AseoUrbano.RTBarrido.Kardex.printfDespachoDiario', compact('despacho','fechaprint','hraprint','detalles','rutas','personals','personareemplazada'));
    }
    


}
