<?php

namespace App\Http\Controllers;

use App\AuBarrio;
use App\AuCalle;
use App\AuDistrito;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AuReporteReclamoController extends Controller
{
    protected function index()
    {
        $barrios = AuBarrio::orderBy('descripcion')->get();
        $distritos = AuDistrito::all();

        return view('AseoUrbano.GestionReclamo.Reclamo.indexReporte', compact('barrios', 'distritos'));
    }

    protected function printf(Request $request)
    {
        if($request->distrito_id == 'TODO')
        {
            if($request->barrio_id == 'TODO')
            {
                if($request->calle_id == 'TODO')
                {
                    $resultado = DB::table('au_distritos as ad')
                        ->join('au_barrios as ab', 'ab.distrito_id','ad.id')
                        ->join('au_calles as ac', 'ac.barrio_id','ab.id')
                        ->join('au_reclamos as ar', 'ar.calle_id','ac.id')
                        ->select('ad.descripcion as distrito','ab.descripcion as barrio','ac.calle', 'ar.fechareclamo', 'ar.descripcion','ar.fechaatendido','ar.solucion')
                        ->where('ar.estado',4)
                        ->where('ar.fechareclamo','>=', $request->inicio)
                        ->where('ar.fechareclamo','<=', $request->fin)->get();
                }
                else
                {
                    $resultado = DB::table('au_distritos as ad')
                        ->join('au_barrios as ab', 'ab.distrito_id','ad.id')
                        ->join('au_calles as ac', 'ac.barrio_id','ab.id')
                        ->join('au_reclamos as ar', 'ar.calle_id','ac.id')
                        ->select('ad.descripcion as distrito','ab.descripcion as barrio','ac.calle', 'ar.fechareclamo', 'ar.descripcion','ar.fechaatendido','ar.solucion')
                        ->where('ar.estado',4)
                        ->where('ac.id',$request->calle_id)
                        ->where('ar.fechareclamo','>=', $request->inicio)
                        ->where('ar.fechareclamo','<=', $request->fin)->get();
                }
            }
            else
            {
                if($request->calle_id == 'TODO')
                {
                    $resultado = DB::table('au_distritos as ad')
                    ->join('au_barrios as ab', 'ab.distrito_id','ad.id')
                    ->join('au_calles as ac', 'ac.barrio_id','ab.id')
                    ->join('au_reclamos as ar', 'ar.calle_id','ac.id')
                    ->select('ad.descripcion as distrito','ab.descripcion as barrio','ac.calle', 'ar.fechareclamo', 'ar.descripcion','ar.fechaatendido','ar.solucion')
                    ->where('ar.estado',4)
                    ->where('ab.id', $request->barrio_id)
                    ->where('ar.fechareclamo','>=', $request->inicio)
                    ->where('ar.fechareclamo','<=', $request->fin)->get();
                }
                else
                {
                    $resultado = DB::table('au_distritos as ad')
                    ->join('au_barrios as ab', 'ab.distrito_id','ad.id')
                    ->join('au_calles as ac', 'ac.barrio_id','ab.id')
                    ->join('au_reclamos as ar', 'ar.calle_id','ac.id')
                    ->select('ad.descripcion as distrito','ab.descripcion as barrio','ac.calle', 'ar.fechareclamo', 'ar.descripcion','ar.fechaatendido','ar.solucion')
                    ->where('ar.estado',4)
                    ->where('ab.id', $request->barrio_id)
                    ->where('ac.id', $request->calle_id)
                    ->where('ar.fechareclamo','>=', $request->inicio)
                    ->where('ar.fechareclamo','<=', $request->fin)->get();
                }
            }
        }
        else
        {
            if($request->barrio_id == 'TODO')
            {
                if($request->calle_id == 'TODO')
                {
                    $resultado = DB::table('au_distritos as ad')
                    ->join('au_barrios as ab', 'ab.distrito_id','ad.id')
                    ->join('au_calles as ac', 'ac.barrio_id','ab.id')
                    ->join('au_reclamos as ar', 'ar.calle_id','ac.id')
                    ->select('ad.descripcion as distrito','ab.descripcion as barrio','ac.calle', 'ar.fechareclamo', 'ar.descripcion','ar.fechaatendido','ar.solucion')
                    ->where('ar.estado',4)
                    ->where('ad.id', $request->distrito_id)
                    ->where('ar.fechareclamo','>=', $request->inicio)
                    ->where('ar.fechareclamo','<=', $request->fin)->get();
                }
                else
                {
                    $resultado = DB::table('au_distritos as ad')
                    ->join('au_barrios as ab', 'ab.distrito_id','ad.id')
                    ->join('au_calles as ac', 'ac.barrio_id','ab.id')
                    ->join('au_reclamos as ar', 'ar.calle_id','ac.id')
                    ->select('ad.descripcion as distrito','ab.descripcion as barrio','ac.calle', 'ar.fechareclamo', 'ar.descripcion','ar.fechaatendido','ar.solucion')
                    ->where('ar.estado',4)
                    ->where('ad.id', $request->distrito_id)
                    ->where('ac.id', $request->calle_id)
                    ->where('ar.fechareclamo','>=', $request->inicio)
                    ->where('ar.fechareclamo','<=', $request->fin)->get();
                }
            }
            else
            {
                if($request->calle_id == 'TODO')
                {
                    $resultado = DB::table('au_distritos as ad')
                    ->join('au_barrios as ab', 'ab.distrito_id','ad.id')
                    ->join('au_calles as ac', 'ac.barrio_id','ab.id')
                    ->join('au_reclamos as ar', 'ar.calle_id','ac.id')
                    ->select('ad.descripcion as distrito','ab.descripcion as barrio','ac.calle', 'ar.fechareclamo', 'ar.descripcion','ar.fechaatendido','ar.solucion')
                    ->where('ar.estado',4)
                    ->where('ad.id', $request->distrito_id)
                    ->where('ab.id', $request->barrio_id)
                    ->where('ar.fechareclamo','>=', $request->inicio)
                    ->where('ar.fechareclamo','<=', $request->fin)->get();
                }
                else
                {
                    $resultado = DB::table('au_distritos as ad')
                    ->join('au_barrios as ab', 'ab.distrito_id','ad.id')
                    ->join('au_calles as ac', 'ac.barrio_id','ab.id')
                    ->join('au_reclamos as ar', 'ar.calle_id','ac.id')
                    ->select('ad.descripcion as distrito','ab.descripcion as barrio','ac.calle', 'ar.fechareclamo', 'ar.descripcion','ar.fechaatendido','ar.solucion')
                    ->where('ar.estado',4)
                    ->where('ad.id', $request->distrito_id)
                    ->where('ab.id', $request->barrio_id)
                    ->where('ac.id', $request->calle_id)
                    ->where('ar.fechareclamo','>=', $request->inicio)
                    ->where('ar.fechareclamo','<=', $request->fin)->get();
                }
            }
        }
        $ini = $request->inicio;
        $fi = $request->fin;

        $fechaprint = Carbon::now()->format('d/m/Y');
        $hraprint = Carbon::now()->format('H:i A'); 
  
        // return $resultado;
        return view('AseoUrbano.GestionReclamo.Reclamo.printfReclamo', compact('resultado','hraprint','fechaprint','ini','fi'));
    }



    protected function select_ajax_barrio($id)
    {
        if($id == 'TODO')
        {
            $distrito = AuBarrio::all();
        }
        else
        {
            $distrito = AuBarrio::where('distrito_id',$id)->get();
        }
        return $distrito;
    }
    protected function select_ajax_calle($id)
    {
        if($id == 'TODO')
        {
            $calle = AuCalle::all();
        }
        else
        {
            $calle = AuCalle::where('barrio_id',$id)->get();
        }
        return $calle;
    }
}
