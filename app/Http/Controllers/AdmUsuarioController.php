<?php

namespace App\Http\Controllers;
use App\User;
use App\AdmFuncionario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AdmUsuarioController extends Controller
{
    
    // const PERMISSIONS = [
    //     'create' => 'admin-user-create',
    //     'show'   => 'admin-user-show',
    //     'edit'   => 'admin-user-edi',

    // ];

    public function __construct()
    {
        $this->middleware('permission:adm-usuario.index')->only('index');
        $this->middleware('permission:adm-usuario.asignarroles')->only('update');
    }

    protected function index()
    {
        $activo = Auth::user();
        $usuarios = User::all();
        $funcionarios = AdmFuncionario::select('adm_funcionarios.id','p.nombre','p.apellidopaterno', 'p.apellidomaterno', 'u.id as user')
            ->join('adm_personas as p','p.id','adm_funcionarios.persona_id')
            ->leftjoin('users as u', 'u.funcionario_id', 'adm_funcionarios.id')
            ->whereNull('u.funcionario_id')->get();

        return view('Administracion.GestionUsuario.indexUsuario', compact('usuarios','funcionarios', 'activo'));
    }

    protected function reset(Request $request)
    {
        $ok = User::find($request->id);
        $ok->update([
            'password' =>bcrypt(12345678),
            'reset' => true
            ]);
        return redirect()->route('user.index');
    }

    protected function update(Request $request, $id)
    {        
        $user = User::find($id);
        
        $datos = $request->roles;

        $resultado = Role::join('model_has_roles as m', 'm.role_id', 'roles.id')
                    ->where('m.model_id', $user->id)->get();

        // return $resultado;
        
            foreach($resultado as $result)
            {   
                $user->removeRole($result->name);              
            }
            if($datos != '')
            {
                foreach($datos as $dato)
                {
                    $name = Role::find($dato);
                    $user->assignRole($name->name);
                }
            }


        toastr()->success( 'Asignacion De Roles Actualizado' , 'Información' , ["closeButton" => "true","progressBar" => "true" ]);

        return redirect()->route('adm-usuario.viewasignarroles',$id);
    }
}
