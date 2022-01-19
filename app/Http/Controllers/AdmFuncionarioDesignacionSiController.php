<?php

namespace App\Http\Controllers;

use App\AdmFuncionarioDesignacionSi;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class AdmFuncionarioDesignacionSiController extends Controller
{

    public function destroy(Request $request)
    {
        DB::table('adm_funcionario_designacion_sis')->where('id', $request->id)->delete();

        return back();
    }



    protected function update(Request $request, $id)
    {        
        // return $id;
        $resultado = $request->dess;
        
        // $datos = $request->roles;

        // $resultado = Role::join('model_has_roles as m', 'm.role_id', 'roles.id')
        //             ->where('m.model_id', $user->id)->get();

        // // return $resultado;
        
            foreach($resultado as $result)
            {   
                AdmFuncionarioDesignacionSi::create([
                    'funcionario_id' => $id,
                    'designaciones_id' => $result
                ]);
            }


        toastr()->success( 'Asignacion De Roles Actualizado' , 'Información' , ["closeButton" => "true","progressBar" => "true" ]);
        return back();
        // return redirect()->route('adm-usuario.viewasignarroles',$id);
    }
}
