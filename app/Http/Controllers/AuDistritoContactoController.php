<?php

namespace App\Http\Controllers;

use App\AuDistritoContacto;
use App\AuContacto;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class AuDistritoContactoController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:au-distritos.agregarcontacto')->only('store');
    }
    public function store(Request $request)
    {
        if($request->tip == 0)
        {
            DB::table('au_distrito_contactos as d')
                ->join('au_contactos as c','c.id', 'd.contacto_id')
                ->where('d.activo', 1)
                ->update(['distrito' => 0]);

            AuDistritoContacto::where('distrito_id', $request->distrito_id)
                ->update(['activo' => 0]);

            
        }
        else
        {
            
        }
        AuContacto::where('id', $request->contacto_id)
            ->update(['distrito' => 1]);

        AuDistritoContacto::create($request->all());
        
        toastr()->success('Ha sido registrado con exito' , 'Información' , ["closeButton" => "true","progressBar" => "true" ]);
        return redirect()->route('distrito.index');
    }

    
}
