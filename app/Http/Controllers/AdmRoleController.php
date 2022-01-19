<?php

namespace App\Http\Controllers;
use App\AdmModulo;
use App\AdmOpciones;
use App\AdmSubOpciones;
use App\User;

use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

use Illuminate\Http\Request;

class AdmRoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:adm-roles.index')->only('index');
        $this->middleware('permission:adm-roles.store')->only('store');
        $this->middleware('permission:adm-roles.viewasignarpermission')->only('edit');
        // $this->middleware('permission:adm-roles.asignarpermissionstore')->only('update');
    }

    protected function index()
    {
        $roles = Role::all();

        // return User::select('users.id as user_id', 'p.id as p_id', 'm.id as m_id', 'm.nombre')
        //             ->join('model_has_roles as mhr', 'mhr.model_id', 'users.id')
        //             ->join('roles as r', 'r.id', 'mhr.role_id')
        //             ->join('role_has_permissions as rhp', 'rhp.role_id', 'r.id')
        //             ->join('permissions as p', 'p.id', 'rhp.permission_id')
        //             ->join('adm_modulos as m', 'm.id', 'p.fk_id')
        //             ->where('users.email', 'ignaciomolinaguzman20@gmail.com')
        //             ->where('users.activo',1)
        //             ->where('p.tipo', 1)->
        //             groupBy('users.id', 'p.id', 'm.id', 'm.nombre')->get();

        return view('Administracion.Sistema.indexRole', compact('roles'));
    }

    protected function store(Request $request)
    {
        Role::create($request->all());
        toastr()->success('Ha sido registrado con exito' , 'Información' , ["closeButton" => "true","progressBar" => "true" ]);
        return redirect()->route('role.index');
    }

    // ROLES
    protected function view_asignaroles($id)
    {   
        $users = User::find($id);

        $roles = Role::all();

        $rols = Role::select('roles.name')
            ->join('model_has_roles as mhr', 'mhr.role_id', 'roles.id')
            ->join('users as u', 'u.id', 'mhr.model_id')
            ->where('u.id',$id)->get();


        
        return view('Administracion.GestionUsuario.indexAsignar',
                    compact('users', 'roles', 'rols'));
    }


//_____________________________________________________________ASIGNACION DE PERMISOS A LOS ROLES______________________________________________________

                    //::::::::::::::::: PARA LLAMAR LA VISTA DE ASIGNACION DE PERMISO A LOS ROLES CARGANDOS LOS DATOS DE LAS TABLA
    protected function edit($id)
    {
        // para la primer tabla
        $roles = Role::find($id);
        $modulos =AdmModulo::all();
        $opciones = AdmOpciones::all();
        $subs = AdmSubOpciones::all();
        $permissions = Permission::all();

        // // para la segunda tabla________________________________________________
        $mods = AdmModulo::select('adm_modulos.id as m_id', 'adm_modulos.nombre','p.tipo')
            ->join('permissions as p', 'p.fk_id', 'adm_modulos.id')
            ->join('role_has_permissions as rhp', 'rhp.permission_id', 'p.id')
            ->join('roles as r', 'r.id', 'rhp.role_id')        
            ->where('r.id', $id)
            ->where('p.tipo',1)
            ->groupBy('adm_modulos.id', 'adm_modulos.nombre','p.tipo')->get();


        $ops = AdmModulo::select('adm_modulos.id as m_id', 'adm_modulos.nombre as modulo', 'ao.id as ao_id', 'ao.descripcion as opcion_nombre', 'p.id as p_id', 'p.descripcion as permiso', 'p.tipo')
            ->join('adm_opciones as ao', 'ao.modulo_id', 'adm_modulos.id')
            ->join('permissions as p', 'p.fk_id', 'ao.id')
            ->join('role_has_permissions as rhp', 'rhp.permission_id', 'p.id')
            ->join('roles as r', 'r.id', 'rhp.role_id')
            ->where('r.id',$id)
            ->where('p.tipo', 2)->get();

        $sub_ops = AdmModulo::select('adm_modulos.id as m_id', 'adm_modulos.nombre as modulo', 'ao.id as ao_id', 'aso.id as aso_id', 'aso.descripcion as opcion_nombre', 'p.id as p_id', 'p.descripcion as permiso', 'p.tipo')
            ->join('adm_opciones as ao', 'ao.modulo_id', 'adm_modulos.id')
            ->join('adm_sub_opciones as aso', 'aso.opciones_id', 'ao.id')
            ->join('permissions as p', 'p.fk_id', 'aso.id')
            ->join('role_has_permissions as rhp', 'rhp.permission_id', 'p.id')
            ->join('roles as r', 'r.id', 'rhp.role_id')
            ->where('r.id',$id)
            ->where('p.tipo', 3)->get();


        $pers = AdmModulo::select('adm_modulos.id as m_id', 'adm_modulos.nombre as modulo', 'ao.id as ao_id', 'aso.id as aso_id', 'p.id as p_id', 'p.name as permiso', 'p.fk_id', 'p.tipo')
            ->join('adm_opciones as ao', 'ao.modulo_id', 'adm_modulos.id')
            ->join('adm_sub_opciones as aso', 'aso.opciones_id', 'ao.id')
            ->join('permissions as p', 'p.fk_id', 'aso.id')
            ->join('role_has_permissions as rhp', 'rhp.permission_id', 'p.id')
            ->join('roles as r', 'r.id', 'rhp.role_id')
            ->where('r.id',$id)
            ->where('p.tipo', 4)->get();
        return view('Administracion.Sistema.indexAsignar',
            compact('roles','modulos','opciones','subs','permissions', 'mods', 'ops','sub_ops','pers'));
    }

    protected function update(Request $request, $id)
    {
        $role = Role::find($id);        
        $datos = $request->permissions;

        $resultado = Permission::join('role_has_permissions as m', 'm.permission_id', 'permissions.id')
                    ->where('m.role_id', $role->id)->get();

            foreach($resultado as $result)
            {   
                $role->revokePermissionTo($result->name);              
            }
            if($datos != '')
            {
                foreach($datos as $dato)
                {
                    $name = Permission::find($dato);
                    $role->givePermissionTo($name->name);
                }
            }

        toastr()->success( 'Rol actualizado con éxito' , 'Información' , ["closeButton" => "true","progressBar" => "true" ]);

        return redirect()->route('role.edit',$id);
    }
}
