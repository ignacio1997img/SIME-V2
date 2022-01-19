<?php

namespace App\Http\Controllers;

use App\AuDespachoCombustible;
use Illuminate\Http\Request;

class AuDespachoCombustibleController extends Controller
{

    public function index()
    {
        return 22;
    }
    public function store(Request $request)
    {
        // return 3;
        AuDespachoCombustible::create($request->all());
        // return redirect()->route('au-partediario.view', $request->despachodetalle_id);
        return redirect()->back()->withInput();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\AuDespachoCombustible  $auDespachoCombustible
     * @return \Illuminate\Http\Response
     */
    public function show(AuDespachoCombustible $auDespachoCombustible)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\AuDespachoCombustible  $auDespachoCombustible
     * @return \Illuminate\Http\Response
     */
    public function edit(AuDespachoCombustible $auDespachoCombustible)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\AuDespachoCombustible  $auDespachoCombustible
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AuDespachoCombustible $auDespachoCombustible)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\AuDespachoCombustible  $auDespachoCombustible
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        // return $request;

        AuDespachoCombustible::where('despachodetalle_id',$request->despachodetalle_id)->delete();
        return redirect()->route('au-partediario.view', $request->despachodetalle_id);
    }
}
