<?php

namespace App\Http\Controllers;

use App\AuTipoServicio;

use Illuminate\Http\Request;

class AuTipoServicioController extends Controller
{
    protected function index()
    {
        $tipos = AuTipoServicio::all();
        return view('AseoUrbano.InformacionBasica.indexTipoServicio', compact('tipos'));
    }
    protected function store(Request $request)
    {
        AuTipoServicio::create($request->all());
        toastr()->success('Ha sido registrado con exito' , 'Información' , ["closeButton" => "true","progressBar" => "true" ]);
        return redirect()->route('tiposervicioaseo.index');
    }
    protected function update_tiposervicio(Request $request)
    {
        AuTipoServicio::where('id', $request->id)
            ->update(['descripcion'=> $request->descripcion]);
        toastr()->success('Ha sido actualizado con exito' , 'Información' , ["closeButton" => "true","progressBar" => "true" ]);
        return redirect()->route('tiposervicioaseo.index');
    }



}
