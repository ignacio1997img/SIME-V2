<?php

namespace App\Http\Controllers;

use App\MaMarca;
use Illuminate\Http\Request;

class MaMarcaController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:ma-marca.index')->only('index');
        $this->middleware('permission:ma-marca.store')->only('store');
    }

    protected function index()
    {       
        $marcas = MaMarca::all();
        return view('Maestranza.MaquinariaEquipo.indexMarca', compact('marcas'));
    }
    protected function store(Request $request)
    {
        MaMarca::create($request->all());
        toastr()->success('Ha sido registrado con exito' , 'Información' , ["closeButton" => "true","progressBar" => "true" ]);
        return redirect()->route('marca.index');
    }


    protected function update_marca(Request $request)
    {
        MaMarca::where('id', $request->id)
            ->update(['descripcion'=> $request->descripcion]);
        toastr()->success('Ha sido actualizado con exito' , 'Información' , ["closeButton" => "true","progressBar" => "true" ]);
        return redirect()->route('marca.index');
    }





}
