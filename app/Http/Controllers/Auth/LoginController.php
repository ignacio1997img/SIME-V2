<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\DB;

use App\User;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

   
    // protected $redirectTo = RouteServiceProvider::HOME;    // por defecto del laravel IU
    // protected $redirectTo = '/documentacion';                     // prueba con las uri

    public function authenticated($request, $user)
    {
        // return $request;
        if($request->modulo === 'ADMINISTRACION')
        {
            return redirect()->route('administracion');
        }
        else
        {   
            if ($request->modulo === 'TRAMITE Y CORRESPONDENCIA')
            {
               return redirect()->route('documentaciones'); 
            }        
            else
            {
                if ($request->modulo === 'RECURSOS HUMANOS')
                {
                    return redirect()->route('recursoshumanos'); 
                }  
                else
                {
                    if($request->modulo === 'ASEO URBANO')
                    {
                        return redirect()->route('aseourbano'); 
                    }
                    else
                    {
                        if($request->modulo === 'MAESTRANZA')
                        {
                            return redirect()->route('maestranza'); 
                        }
                        else
                        {
                            if($request->modulo === 'HYSO')
                            {
                                return redirect()->route('hyso'); 
                            }
                        }
                    }
                }

            }    
        }
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function getFailedLoginMessage()
	{
		return 'Estas credenciales no coinciden en nuestro registro';
	}


    // public function username()
    // {
    //     return 'name';
    // }

    protected function select_modulo($users)
    {
        return DB::table('adm_modulos as m')       
            ->join('permissions as p', 'p.fk_id', 'm.id')
            ->join('role_has_permissions as rp', 'rp.permission_id' ,'p.id')
            ->join('roles as r', 'r.id', 'rp.role_id')
            ->join('model_has_roles as mr' , 'mr.role_id', 'r.id')
            ->join('users as u', 'u.id', 'mr.model_id')        
            ->where('p.tipo', 1)
            ->where('u.email', $users)
            ->select('u.email','p.descripcion', 'm.nombre')->get();
    }
}
