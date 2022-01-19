<?php

namespace App\Http\Controllers;

use App\AuBarridoPersonal;
use App\AuBarridoPersonalReemplazo;
use App\AuBarridoDespacho;
use App\AuBarridoDespachoDetalle;
use App\AuBarridoRuta;
use App\AdmFuncionario;
use App\AuDespachoDetalle;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class AuBarridoPersonalController extends Controller
{
    
    public function index($id)
    {
        $detalle = AuBarridoDespachoDetalle::find($id);
        $despacho = AuBarridoDespacho::find($detalle->despacho_id);

        $personal = AuBarridoPersonal::where('despachodetalle_id',$detalle->id)
            ->where('estado',1)->orderBy('nombre')->get();

        $ruta = AuBarridoRuta::find($detalle->ruta_id);
        
        $personareemplazada = AuBarridoPersonalReemplazo::where('despachodetalle_id', $detalle->id)->orderBy('id')->get();

        return view('AseoUrbano.RTBarrido.barridopersonal', compact('detalle','despacho','personal','personareemplazada', 'ruta'));
    }

    

    public function store(Request $request)
    {
        
        // $request->merge(['cargo' => 'BARRIDO']);
        AuBarridoDespachoDetalle::where('id',$request->despachodetalle_id)->update(['activo'=>2]);
        
        foreach($request->personas as $persona)
        {
            $funcionario=  AdmFuncionario::find($persona);

            $cargo = DB::table('adm_funcionario_cargos as aff')//...
                ->join('adm_cargos as ac','ac.id', 'aff.cargo_id')
                ->select('ac.nombre')
                ->where('aff.funcionario_id', $funcionario->id)
                ->where('aff.activo',1)->get();

            AuBarridoPersonal::create(['cargo' => $cargo[0]->nombre, 'nombre' => $funcionario->persona->nombrecompleto(), 'despachodetalle_id' => $request->despachodetalle_id ]);
        }
        

        return redirect()->route('au-rtbarrido.despacho.despachodetalle.viewpersonal',$request->despachodetalle_id);
    
    }

    protected function destroy(Request $request)
    {
        AuBarridoPersonal::find($request->id)->delete();

        return redirect()->route('au-rtbarrido.despacho.despachodetalle.viewpersonal',$request->despachodetalle_id);    
    }

    protected function close_despachodetalle($id)
    {
        AuBarridoDespachoDetalle::where('id',$id)->update(['activo'=>3]);
        
        return redirect()->route('au-rtbarrido.despacho.viewdespachodetalle',AuBarridoDespachoDetalle::find($id)->despacho_id);
    }






    
    protected function select_ajax_personal($id)
    {
        $personal = DB::table('adm_personas as ap')
            ->join('adm_funcionarios as af' , 'af.persona_id' , 'ap.id')
            ->join('adm_funcionario_cargos as aff', 'aff.funcionario_id', 'af.id')//...
            ->join('adm_cargos as ac','ac.id', 'aff.cargo_id')//.....
            ->join('adm_funcionario_designacion_sis as afc' , 'afc.funcionario_id' , 'af.id')
            ->select('af.id', 'ap.nombre', 'ap.apellidopaterno', 'ap.apellidomaterno','ac.nombre as cargo')
            ->where('afc.designaciones_id',7)
            ->where('af.activo',1)->get();
       
            $inabilitado = DB::table('au_barrido_despacho_detalles as abd')             
            ->join('au_barrido_personals as abp' , 'abp.despachodetalle_id' , 'abd.id')
            ->select('abp.nombre')
            ->where('abd.activo',2)
            ->where('abp.estado',1)
            ->where('abd.despacho_id',$id)->get();
        
        $nom = "";
        $ok=true;
        $i=0;
        $personaTotal = collect();
        foreach($personal as $per)
        {
            $nom = $per->nombre.' '.$per->apellidopaterno.' '.$per->apellidomaterno;
            foreach($inabilitado as $ina)
            {                
                if($nom == $ina->nombre)
                {
                    $ok= false;
                }
            }
            if($ok)
            {
                $personaTotal->push(['id' => $per->id, 'cargo' => $per->cargo, 'nombre' => $nom]);
                // $personaTotal[$i]= $nom;
                // $i++;
            }
            $ok=true;
            
        }
        return $personaTotal;
    }
    
}

    

