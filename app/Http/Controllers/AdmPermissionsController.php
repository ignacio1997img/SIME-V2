<?php

namespace App\Http\Controllers;

use Spatie\Permission\Models\Permission;
use App\AdmModulo;
use App\AdmSubOpciones;
use App\AdmPermiso;

use App\AdmOpciones;


use Illuminate\Http\Request;

class AdmPermissionsController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:adm-permission.index')->only('index');
        $this->middleware('permission:adm-permission.store')->only('store');
    }

    protected function index()
    {
        $permisos = AdmPermiso::all();
        $modulos  =  AdmModulo::all();

        $modulos =AdmModulo::all();
        $opciones = AdmOpciones::all();
        $subs = AdmSubOpciones::all();
        $permissions = Permission::all();

        return view('Administracion.Sistema.indexPermissions', compact('permisos','modulos',    'opciones','subs','permissions'));
    }

    protected function store(Request $request)
    {
        Permission::create($request->all());

        toastr()->success('Ha sido registrado con exito' , 'Información' , ["closeButton" => "true","progressBar" => "true" ]);
        return redirect()->route('permiso.index');
    }

    protected function select_ajax_subopciones($id)
    {
        return AdmSubOpciones::where('opciones_id',$id)->get();        
    }
}
