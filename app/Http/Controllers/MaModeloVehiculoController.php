<?php

namespace App\Http\Controllers;

use App\MaModeloVehiculo;
use App\MaMarca;
use Illuminate\Http\Request;

class MaModeloVehiculoController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:ma-modelovehiculo.index')->only('index');
        $this->middleware('permission:ma-modelovehiculo.store')->only('store');
    }

    protected function index()
    {
        $marcas = MaMarca::all();
        $modelos = MaModeloVehiculo::all();   
        return view('Maestranza.MaquinariaEquipo.indexModelo', compact('modelos','marcas'));
    }
    protected function store(Request $request)
    {
        MaModeloVehiculo::create($request->all());
        toastr()->success('Ha sido registrado con exito' , 'Información' , ["closeButton" => "true","progressBar" => "true" ]);
        return redirect()->route('modelo.index');
    }

    public function update_modelo(Request $request)
    {
        MaModeloVehiculo::where('id', $request->id)
            ->update(['marca_id' => $request->marca_id ,'descripcion' => $request->descripcion]);
        toastr()->success('Ha sido actualizado con exito' , 'Información' , ["closeButton" => "true","progressBar" => "true" ]);
        return redirect()->route('modelo.index');
    }
}
