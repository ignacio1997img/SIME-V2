<?php

namespace App\Http\Controllers;


use App\AdmGrupoEmpresa;
use App\AdmDesignacion;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\User;


use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    

    protected function reset_act(Request $request)
    {
        
        $user = Auth::user();
        $ok = User::find($user->id);
        $ok->update([
            'password' =>bcrypt($request->password),
            'reset' => false
            ]);
        
        if($request->modulo == 'ADMINISTRACION')
        {
            return redirect()->route('administracion');
        }
        else
        {
            if($request->modulo == 'TRAMITE Y CORRESPONDENCIA')
            {
                return redirect()->route('documentaciones');
            }
            else
            {
                if($request->modulo == 'RECURSOS HUMANOS')
                {
                    return redirect()->route('recursoshumanos');
                }
                else
                {
                    if($request->modulo == 'ASEO URBANO')
                    {
                        return redirect()->route('aseourbano');
                    }
                    else
                    {
                        if($request->modulo == 'MAESTRANZA')
                        {
                            return redirect()->route('maestranza');
                        }
                        else
                        {
                            if($request->modulo == 'MAESTRANZA')
                            {
                                return redirect()->route('hyso');
                            }

                        }
                    }
                }
            }
        }      
    }

    private function confirmacion()
    {
        $ok=false;
        $user = Auth::user();
        if($user->reset == 1)
        {
            $ok=true;
        }
        return $ok;
    }
    public function index()
    {
        if($this->confirmacion())
        {
            $modulo='ADMINISTRACION';
            return view('auth.reset', compact('modulo'));
        }
        else
        {
            return view('Administracion.index');
        }
    }
    public function documentaciones()
    {
        if($this->confirmacion())
        {
            $modulo='TRAMITE Y CORRESPONDENCIA';
            return view('auth.reset', compact('modulo'));
        }
        else
        {
            return view('Documentacion.index');
        }
        
    }

    public function recursoshumanos()
    {
        if($this->confirmacion())
        {
            $modulo='RECURSOS HUMANOS';
            return view('auth.reset', compact('modulo'));
        }
        else
        {
            return view('RecursosHumanos.index');
        }                
    }
    public function aseourbano()
    {
        if($this->confirmacion())
        {
            $modulo='ASEO URBANO';
            return view('auth.reset', compact('modulo'));
        }
        else
        {
            return view('AseoUrbano.index');
        }                
    }
    public function maestranza()
    {
        if($this->confirmacion())
        {
            $modulo='MAESTRANZA';
            return view('auth.reset', compact('modulo'));
        }
        else
        {
            return view('Maestranza.index');
        }                
    }

    public function hyso()
    {
        if($this->confirmacion())
        {
            $modulo='HYSO';
            return view('auth.reset', compact('modulo'));
        }
        else
        {
            return view('Hyso.index');
        }                
    }
    protected function AcercaDe()
    {
        return view('Layout.AcercaDe');
    }



    //______________________________________________________________________________________________________
    protected function desactivar_ajax_designacion()
    {
        $desig = AdmDesignacion::where('activo', 1)->get();
        $mytime = Carbon::now();

        foreach ($desig as $desi)
        {
            if( $mytime > $desi->fin )
            {
                AdmDesignacion::where('id',$desi->id)->update(['activo' => 0]);
            }
        }
        
    }
}
