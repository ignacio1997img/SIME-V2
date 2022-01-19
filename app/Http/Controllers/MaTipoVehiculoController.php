<?php

namespace App\Http\Controllers;

use App\MaTipoVehiculo;
use Illuminate\Http\Request;

class MaTipoVehiculoController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:ma-tipovehiculo.index')->only('index');
        $this->middleware('permission:ma-tipovehiculo.store')->only('store');
    }

    protected function index()
    {       
        $tipos = MaTipoVehiculo::all();
        return view('Maestranza.MaquinariaEquipo.indexTipo', compact('tipos'));
    }

    protected function store(Request $request)
    {
        MaTipoVehiculo::create($request->all());
        toastr()->success('Ha sido registrado con exito' , 'Información' , ["closeButton" => "true","progressBar" => "true" ]);
        return redirect()->route('tipovehiculo.index');
    }
    protected function update_tipo(Request $request) 
    {
        MaTipoVehiculo::where('id', $request->id)
            ->update(['descripcion'=> $request->descripcion]);
        toastr()->success('Ha sido actualizado con exito' , 'Información' , ["closeButton" => "true","progressBar" => "true" ]);
        return redirect()->route('tipovehiculo.index');
    }
}
