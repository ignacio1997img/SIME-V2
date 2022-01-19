<?php

namespace App\Http\Controllers;

use App\AdmArea;
use App\AdmEmpresa;
use Illuminate\Http\Request;

class AdmAreaController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:rrhh-area.index')->only('index');
        $this->middleware('permission:rrhh-area.store')->only('store');
    }

    public function index()
    {
        $empresas = AdmEmpresa::where('personal',1)->get();
        $areas = AdmArea::all();
        return view('RecursosHumanos.Estructuraempresa.indexArea', compact('empresas','areas'));
    }


    public function store(Request $request)
    {
        AdmArea::create($request->all());
        toastr()->success('Ha sido registrado con exito' , 'Información' , ["closeButton" => "true","progressBar" => "true" ]);
        return redirect()->route('area.index');
    }

    public function update_area(Request $request)
    {
        AdmArea::where('id', $request->id)
            ->update(['empresa_id' => $request->empresa_id ,'descripcion' => $request->descripcion]);

        toastr()->success( 'Ha sido actualizado con exito' , 'Información' , ["closeButton" => "true","progressBar" => "true" ]);
        return redirect()->route('area.index');
    }



    //-------------------------------- ajax ------------------------

    // para obtener las areas de acuerdo a la empresa
    protected function select_ajax_area($id)
    {
        return AdmArea::where('empresa_id',$id)->get();
    }

 

}
