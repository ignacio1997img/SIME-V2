<?php

namespace App\Http\Controllers;

use App\AuReclamo;
use App\AuBarrio;
use Illuminate\Support\Carbon;
use  user\User;
use App\AuReclamoAtenderUnidad;
use App\MaVehiculo;
use App\AuContacto;
use App\AuCalle;
use App\AuReclamoReiteracion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Psy\ExecutionLoop\RunkitReloader;

class AuReclamoController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:au-reclamos.index')->only('index');
        $this->middleware('permission:au-reclamos.store')->only('store');
    }
    protected function index()
    {
        
        $barrios = AuBarrio::orderBy('descripcion')->get();
        $contactos = AuContacto::orderBy('nombrecompleto')->get();

        $pendiente =  AuReclamo::join('au_contactos as ac', 'ac.id','au_reclamos.contacto_id')
            ->select('au_reclamos.id','au_reclamos.numero','au_reclamos.fechareclamo','ac.nombrecompleto', 'au_reclamos.descripcion')
            ->where('estado',1)->get();
        $retrazados = AuReclamo::where('estado', 2)->get();

        $pendientesi = AuReclamo::where('estado', 3)->orwhere('estado',2)->get();

        $realizados = AuReclamo::where('estado', 4)->get();
        return view('AseoUrbano.GestionReclamo.Reclamo.index', compact('barrios', 'contactos', 'pendiente', 'realizados','retrazados', 'pendientesi'));
    }

    public function create()
    {
        $barrios = AuBarrio::orderBy('descripcion')->get();
        $contactos = AuContacto::orderBy('nombrecompleto')->get();
        return view('AseoUrbano.GestionReclamo.Reclamo.create', compact('barrios', 'contactos'));
    }

    protected function store(Request $request)
    {
        $cant = AuReclamo::count();
        // return $cant;
        $request->merge(['numero'=>$cant+1]);

        $request->merge(['registrado' => Auth::user()->funcionario->persona->nombrecompleto()]);
        // return $request;
        AuReclamo::create($request->all());

        return redirect()->route('reclamo.index');
    }

    protected function printf_detalle($id){

        $reclamo = AuReclamo::find($id);
        $calle = AuCalle::find($reclamo->calle_id);
        $barrio = auBarrio::find($calle->barrio_id);
        $contacto = AuContacto::find($reclamo->contacto_id);
        $detalles=  AuReclamoAtenderUnidad::where('reclamo_id',$id)->get();
        $reiteraciones = AuReclamoReiteracion::where('reclamo_id',$id)->get();


        $fechaprint = Carbon::now()->format('d/m/Y');
        $hraprint = Carbon::now()->format('H:i A');

        return view('AseoUrbano.GestionReclamo.Reclamo.printfDetalle', compact('contacto', 'reclamo', 'barrio','fechaprint', 'hraprint', 'detalles', 'reiteraciones'));
    }

    protected function printf_realizado($id){

        $reclamo = AuReclamo::find($id);
        $calle = AuCalle::find($reclamo->calle_id);
        $barrio = auBarrio::find($calle->barrio_id);
        $contacto = AuContacto::find($reclamo->contacto_id);
        $detalles=  AuReclamoAtenderUnidad::where('reclamo_id',$id)->get();
        $reiteraciones = AuReclamoReiteracion::where('reclamo_id',$id)->get();


        $fechaprint = Carbon::now()->format('d/m/Y');
        $hraprint = Carbon::now()->format('H:i A');

        return view('AseoUrbano.GestionReclamo.Reclamo.printfRealizado', compact('contacto', 'reclamo', 'barrio','fechaprint', 'hraprint', 'detalles', 'reiteraciones'));
    }

    protected function atender_reclamo($id)
    {
        
        
        $reclamo = AuReclamo::find($id);

        if($reclamo->estado != 2)
        {
            AuReclamo::where('id',$id)->update(['estado' => 3]);
        }
        
        $calle = AuCalle::find($reclamo->calle_id);
        $barrio = auBarrio::find($calle->barrio_id);
        $contacto = AuContacto::find($reclamo->contacto_id);


        $vehiculos = MaVehiculo::where('estado','=','FUNCIONAMIENTO')->get();
        $funcionarios = DB::table('adm_personas as ap')
            ->join('adm_funcionarios as af' , 'af.persona_id' , 'ap.id')
            ->join('adm_funcionario_cargos as aff', 'aff.funcionario_id', 'af.id')//...
            ->join('adm_cargos as ac','ac.id', 'aff.cargo_id')//.....
            ->join('adm_funcionario_designacion_sis as afc' , 'afc.funcionario_id' , 'af.id')
            ->select('af.id', 'ap.nombre', 'ap.apellidopaterno', 'ap.apellidomaterno','ac.nombre as cargo')
            ->where('aff.activo',1)//....
            ->where('afc.designaciones_id',1)
            ->where('af.activo',1)->get();

        $detalles = AuReclamoAtenderUnidad::where('reclamo_id',$id)->get();

        return view('AseoUrbano.GestionReclamo.Reclamo.indexAtenderReclamo',  compact('reclamo', 'calle', 'barrio', 'contacto', 'funcionarios','vehiculos','detalles'));
    }

    protected function store_atender_reclamo(Request $request)
    {
        AuReclamo::where('id', $request->reclamo_id)->update(['estado' => 4,'solucion' => $request->solucion, 'fecharegistroatendido' =>  Carbon::now()->format('Y-m-d H:i:s') , 'fechaatendido' => $request->fechaatendido,'atendido' => Auth::user()->funcionario->persona->nombrecompleto() ]);

        return redirect()->route('reclamo.index');
    }





    protected function select_ajax_calle($id)
    {
        $calles = AuCalle::where('barrio_id',$id)->get();
        return $calles;
    }

    protected function ajax_retrazo_reclamo()
    {
        $reclamos =  AuReclamo::where('estado',1)->get();
        foreach ($reclamos as $r)
        {
            $fecha = Carbon::parse($r->created_at);
            $dias = $fecha->diffInDays();

            if($dias >= 1)
            {
                AuReclamo::where('id', $r->id)
                        ->update(['estado' => 2]);
            }
        }
    }
}
