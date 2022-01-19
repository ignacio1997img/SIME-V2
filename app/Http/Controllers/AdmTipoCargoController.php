<?php

namespace App\Http\Controllers;

use App\AdmTipoCargo;
use Illuminate\Http\Request;
use App\Http\Requests\TipoCargo;

class AdmTipoCargoController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:rrhh-tipos.index')->only('index');
        $this->middleware('permission:rrhh-tipos.store')->only('store');
    }
    public function index()
    {
        $tipos = AdmTipoCargo::all();

        return view('RecursosHumanos.Estructuraempresa.indexTipoCargo', compact('tipos'));
    }


    protected function store(Request $request)
    {
        AdmTipoCargo::create($request->all());
        toastr()->success('Ha sido registrado con exito' , 'Información' , ["closeButton" => "true","progressBar" => "true" ]);
        return redirect()->route('tipocargo.index');
    }

    protected function update_tipo(TipoCargo $request)
    {
        AdmTipoCargo::where('id', $request->id)
            ->update(['descripcion'=> $request->descripcion]);
        toastr()->success('Ha sido actualizado con exito' , 'Información' , ["closeButton" => "true","progressBar" => "true" ]);
        return redirect()->route('tipocargo.index');
    }




}
