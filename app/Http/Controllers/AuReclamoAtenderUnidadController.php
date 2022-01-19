<?php

namespace App\Http\Controllers;

use App\AuReclamoAtenderUnidad;
use Illuminate\Http\Request;

class AuReclamoAtenderUnidadController extends Controller
{
    
    public function store(Request $request)
    {
        AuReclamoAtenderUnidad::create($request->all());
        // return redirect()->route('au-gestionreclamo.reclamo.atenderreclamo.view',$request->reclamo_id);
        return redirect()->back()->withInput();
    }

    protected function destroy(Request $request)
    {
        // return $request;
        AuReclamoAtenderUnidad::find($request->id)->delete();
        // return redirect()->route('au-gestionreclamo.reclamo.atenderreclamo.view',$request->reclamo_id);
        return redirect()->back()->withInput();
    }
}
