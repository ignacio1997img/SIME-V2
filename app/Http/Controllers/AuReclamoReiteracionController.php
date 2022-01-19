<?php

namespace App\Http\Controllers;

use App\AuReclamoReiteracion;
use App\AuReclamo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuReclamoReiteracionController extends Controller
{
    
    public function __construct()
    {
        // $this->middleware('permission:au-reclamos.index')->only('index');
        $this->middleware('permission:au-reclamosreiteracion.store')->only('store');
    }
    
    public function store(Request $request)
    {
        // return $request;
        AuReclamo::where('id',$request->reclamo_id)->update(['estado' =>2]);
        $request->merge(['observado' => Auth::user()->funcionario->persona->nombrecompleto()]);

        AuReclamoReiteracion::create($request->all());

        return redirect()->route('reclamo.index');
    }

}
