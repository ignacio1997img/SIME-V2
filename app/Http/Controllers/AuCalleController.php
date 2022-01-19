<?php

namespace App\Http\Controllers;

use App\AuCalle;
use App\AuBarrio;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class AuCalleController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:au-calles.index')->only('index');
        $this->middleware('permission:au-calles.store')->only('store');
    }
    public function index()
    {
        $barrios = AuBarrio::all();
        $calles = DB::table('au_calles as ac')
            ->join('au_barrios as ab', 'ab.id', 'ac.barrio_id')
            ->select('ac.id', 'ac.calle', 'ab.descripcion as barrio')->get();

        return view('Aseourbano.InformacionBasica.indexCalle', compact('barrios','calles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
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
        $aux = $request->descripcion;
        $request->merge(['descripcion'=>$request->desc]);
        // return $request;

        AuCalle::create(['descripcion'=>$request->descripcion, 'barrio_id'=>$request->barrio_id, 'calle'=>$request->calle]);
        $request->merge(['descripcion'=>$aux]);
        // return redirect()->route('calle.index');
        return redirect()->back()->withInput();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\AuCalle  $auCalle
     * @return \Illuminate\Http\Response
     */
    public function show(AuCalle $auCalle)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\AuCalle  $auCalle
     * @return \Illuminate\Http\Response
     */
    public function edit(AuCalle $auCalle)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\AuCalle  $auCalle
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AuCalle $auCalle)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\AuCalle  $auCalle
     * @return \Illuminate\Http\Response
     */
    public function destroy(AuCalle $auCalle)
    {
        //
    }
}
