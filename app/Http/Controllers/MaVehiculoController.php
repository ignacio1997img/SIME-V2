<?php

namespace App\Http\Controllers;

use App\MaVehiculo;
use App\MaTipoVehiculo;
use App\MaMarca;
use App\MaModeloVehiculo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MaVehiculoController extends Controller
{
    public function __construct()
    {
        // $this->middleware('permission:ma-tipovehiculo.index')->only('index');
        // $this->middleware('permission:ma-tipovehiculo.store')->only('store');
    }

    protected function index()
    {       
        $vehiculos = MaVehiculo::all();
        $tipos = MaTipoVehiculo::all();
        $marcas = MaMarca::all();



        return view('Maestranza.MaquinariaEquipo.indexVehiculo', compact('vehiculos', 'tipos', 'marcas'));        
    }


    protected function store(Request $request)
    {
        if($request->propiedad == 1)
        {
            $request->merge(['propiedad' => 'PROPIA']);
        }
        else
        {
            if($request->propiedad == 2)
            {
                $request->merge(['propiedad' => 'ALQUILADA']);
            }
            else
            {
                $request->merge(['propiedad' => 'PRESTADA']);
            }
        }

        // return $request;
        MaVehiculo::create($request->all());
        toastr()->success( 'Registro Exitoso' , 'Información' , ["closeButton" => "true","progressBar" => "true" ]);
        return redirect()->route('vehiculo.index');
    }















    //__________________________________________AJAX__________________________________
    protected function select_ajax_modelo($id)
    {
        return MaModeloVehiculo::where('marca_id',$id)->get();
    }
    protected function select_hibrido_empresa($id)
    {
        if($id == 1)
        {
            return DB::table('adm_grupo_empresas as age')            
                ->join('adm_sub_grupos as asg', 'asg.grupo_id', 'age.id')
                ->join('adm_rubros as ar', 'ar.subgrupo_id', 'asg.id')
                ->join('adm_empresas as ae', 'ae.rubroempresa_id', 'ar.id')
                ->select('ae.id', 'ae.razonsocial')
                ->where('ae.vehiculo', 1)
                ->where('age.id', 1)->get();
        }
        else
        {
            if($id == 2 || $id == 3)
            {
                return DB::table('adm_grupo_empresas as age')            
                ->join('adm_sub_grupos as asg', 'asg.grupo_id', 'age.id')
                ->join('adm_rubros as ar', 'ar.subgrupo_id', 'asg.id')
                ->join('adm_empresas as ae', 'ae.rubroempresa_id', 'ar.id')
                ->select('ae.id', 'ae.razonsocial')
                ->where('ae.vehiculo', 1)
                ->where('age.id', 2)->get();
            }
        }
    }

    protected function ajax_calculo($cadena)
    {
        $num= DB::table('ma_vehiculos')->where('propiedad', $cadena)->count();

        return $num+1;
    }
}
