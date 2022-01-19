<?php

namespace App\Http\Controllers;

use App\AuBarrioContacto;
use App\AuContacto;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class AuBarrioContactoController extends Controller
{
    public function __construct()
    {
        // $this->middleware('permission:au-distritos.agregarcontacto')->only('store');
    }
    public function store(Request $request)
    {
        if($request->tip == 0)
        {
            DB::table('au_barrio_contactos as d')
                ->join('au_contactos as c','c.id', 'd.contacto_id')
                ->where('d.activo', 1)
                ->update(['barrio' => 0]);

                AuBarrioContacto::where('barrio_id', $request->barrio_id)
                ->update(['activo' => 0]);

            
        }
        else
        {
            
        }
        AuContacto::where('id', $request->contacto_id)
            ->update(['barrio' => 1]);

        AuBarrioContacto::create($request->all());
        
        toastr()->success('Ha sido registrado con exito' , 'Información' , ["closeButton" => "true","progressBar" => "true" ]);
        return redirect()->route('barrio.index');
    }
}
