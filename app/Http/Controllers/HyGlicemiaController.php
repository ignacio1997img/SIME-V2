<?php

namespace App\Http\Controllers;

use App\HyGlicemia;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HyGlicemiaController extends Controller
{
    
    protected function index()
    {
        $glicemias = HyGlicemia::all();

        $funcionarios =  DB::table('adm_personas as ap')
            ->select('af.id', 'ap.nombre', 'ap.apellidopaterno', 'ap.apellidomaterno')
            ->join('adm_funcionarios as af' , 'af.persona_id' , 'ap.id')
            ->join('adm_funcionario_cargos as afc' , 'afc.funcionario_id' , 'af.id')
            ->join('adm_cargos as ac' , 'ac.id' , 'afc.cargo_id')
            ->join('adm_areas as aa' , 'aa.id' , 'ac.area_id')
            ->where('afc.activo', '!=', 0)
            ->where('aa.empresa_id', 1)->get();

        $registrado = DB::table('adm_personas as ap')
            ->select('af.id' ,'ap.nombre', 'ap.apellidopaterno', 'ap.apellidomaterno')
            ->join('adm_funcionarios as af', 'af.persona_id', 'ap.id')
            ->join('adm_funcionario_designacion_sis as afd', 'afd.funcionario_id', 'af.id')
            ->join('adm_designacion_sistemas as ads', 'ads.id','afd.designaciones_id')
            ->where('ads.id', 5)->get();

        return view('Hyso.Prueba.indexGlicemia', compact('glicemias','funcionarios', 'registrado'));
    }

    protected function printf($id)
    {
        $glicemias = HyGlicemia::find($id);
        // return $glicemias;
        $fechaprint = Carbon::now()->format('d/m/Y');
        $hraprint = Carbon::now()->format('H:i A');
        return view('Hyso.Prueba.printfPrueba', compact('fechaprint','hraprint', 'glicemias'));
    }






    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        HyGlicemia::create($request->all());
        toastr()->success('Ha sido registrado con exito' , 'Información' , ["closeButton" => "true","progressBar" => "true" ]);
        return redirect()->route('glicemia.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\HyGlicemia  $hyGlicemia
     * @return \Illuminate\Http\Response
     */
    public function show(HyGlicemia $hyGlicemia)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\HyGlicemia  $hyGlicemia
     * @return \Illuminate\Http\Response
     */
    public function edit(HyGlicemia $hyGlicemia)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\HyGlicemia  $hyGlicemia
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, HyGlicemia $hyGlicemia)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\HyGlicemia  $hyGlicemia
     * @return \Illuminate\Http\Response
     */
    public function destroy(HyGlicemia $hyGlicemia)
    {
        //
    }
}
