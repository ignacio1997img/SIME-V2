<?php

namespace App\Http\Controllers;

use App\AuContacto;
use Illuminate\Http\Request;

class AuContactoController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:au-contactos.index')->only('index');
        $this->middleware('permission:au-contactos.store')->only('store');
    }

    protected function index()
    {       
        $contactos = AuContacto::orderBy('nombrecompleto', 'asc')->get();
        // return $contactos;
        return view('AseoUrbano.InformacionBasica.indexContacto', compact('contactos'));
    }


    protected function store(Request $request)
    {   
        // return $request;
        $nombre= AuContacto::where('nombrecompleto', $request->nombrecompleto)->get();
        // return $nombre;
        if(!isset($nombre[0]->nombrecompleto))
        {
            // return 1;
            // return $request;
            AuContacto::create(['nombrecompleto'=>$request->nombrecompleto, 'telefono'=>$request->telefono, 'direccion'=>$request->direccion, 'referencia'=>$request->referencia ]);
            toastr()->success('Ha sido registrado con exito' , 'Información' , ["closeButton" => "true","progressBar" => "true" ]);
        }
        else
        {
            // return 3;
            toastr()->error('El contacto ya existe' , 'Información' , ["closeButton" => "true","progressBar" => "true" ]);
        }
        
        // return redirect()->route('contacto.index');
        return redirect()->back()->withInput();
    }

    protected function update_contacto(Request $request)
    {
        $ok =AuContacto::find($request->id);
        $ok->update($request->all());
        toastr()->success('Ha sido actualizado con exito' , 'Información' , ["closeButton" => "true","progressBar" => "true" ]);
        return redirect()->route('contacto.index');
    }
}
