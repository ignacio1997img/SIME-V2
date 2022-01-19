<?php

namespace App\Http\Controllers;

use App\AdmPersona;
use Carbon\Carbon;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdmPersonaController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:rrhh-personas.index')->only('index');
        $this->middleware('permission:rrhh-personas.store')->only('store');
    }

    public function index()
    {        
        $personas = AdmPersona::all();
        return view('RecursosHumanos.Funcionario.indexPersona', compact('personas'));
    }

    protected function store(Request $request)
    {
        $ok = AdmPersona::where('ci', $request->ci)->count();

        if($ok >= 1)
        {
            toastr()->error('Error al registrar' , 'Información' , ["closeButton" => "true","progressBar" => "true" ]);
        }
        else
        {
            AdmPersona::create($request->all());
            toastr()->success('Ha sido registrado con exito' , 'Información' , ["closeButton" => "true","progressBar" => "true" ]);
        }
        
        return redirect()->route('persona.index');
    }

    protected function update_persona(Request $request)
    {
            $persona = AdmPersona::find($request->id);
            $persona->update($request->all());
            toastr()->success('Ha sido actualizado con exito' , 'Información' , ["closeButton" => "true","progressBar" => "true" ]);
      
        return redirect()->route('persona.index');
    }

    protected function kardex($id)
    {
        $personas = AdmPersona::find($id);
        $fechaprint = Carbon::now()->format('d/m/Y');
        $hraprint = Carbon::now()->format('H:i A');
        return view('RecursosHumanos.Funcionario.Kardex.kardexPersona', compact('personas','fechaprint', 'hraprint'));
    }



//------------------------------------ AJAX -------------------------------------------------------
    protected function select_persona($id)
    {
        return AdmPersona::find($id);
    }
}
