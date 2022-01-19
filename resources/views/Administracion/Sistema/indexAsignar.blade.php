@extends('Layout.HomeAdministracion')
@section('content')


<div class="content-header">
  <div class="row mb-2">
    <div class="col-sm-6">
      <h1 class="m-0 text-dark"><i class="fas fa-cubes"></i> Asignacion de Permisos</h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="">Home</a></li>      
        <li class="breadcrumb-item"><a href="">Roles</a></li>   
        <li class="breadcrumb-item active">Asignacion</li>
      </ol>
    </div><!-- /.col -->
  </div><!-- /.row -->
</div>

<a class="btn btn-warning" data-toggle="tooltip" href="{{route('role.index')}}" title="Volver al listado de usuarios">
  <i class="fas fa-arrow-alt-circle-left" ></i>
  Volver
</a>
<p><b>Rol:</b> {{$roles->name}}</p>

<div class="container-fluid">
  <div class="row">
    <!-- ASIGNAR ---->
    <div class="col-6">
      <div class="card">
        <div class="card-header text-center bg-warning">
          <i class="far fa-check-square"></i>&nbsp;
          <b>Permisos por Asignar</b></div>
          <div class="card-body" id="div1">          
            {!! Form::model($roles, ['route' => ['role.update', $roles->id], 'method' => 'PUT']) !!}
            <table class="table table-bordered table-hover table-sm">
              <tbody>
                @foreach($modulos as $modulo)
                  <tr>
                    @foreach($permissions as $permis)
                      @if(($permis->fk_id == $modulo->id) && ($permis->tipo == 1))
                        <td ><b>*{{$modulo->nombre}} - (Modulo)</b></td>
                        <td class="text-center">{{Form::checkbox('permissions[]', $permis->id, null)}}</td>
                      @endif
                    @endforeach
                                  
                    <!-- estructura de las opciones -->
                    @foreach($opciones as $opcion)
                      <tr>
                        @if($opcion->modulo_id == $modulo->id)

                          @foreach($permissions as $permis)
                            @if(($permis->fk_id == $opcion->id) && ($permis->tipo == 2))
                              <td>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                {{$opcion->descripcion}} - (Opcion)
                              </td>
                              <td class="text-center">{{Form::checkbox('permissions[]', $permis->id, null)}}</td>
                            @endif
                          @endforeach
                          <!-- estructura de las sub opciones -->
                          @foreach($subs as $sub)
                            <tr>
                              @if($sub->opciones_id == $opcion->id)

                                @foreach($permissions as $permis)
                                  @if(($permis->fk_id == $sub->id) && ($permis->tipo == 3))
                                    <td>
                                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                      {{$sub->descripcion}}
                                    </td>
                                    <td class="text-center">{{Form::checkbox('permissions[]', $permis->id, null)}}</td>

                                  @endif
                                @endforeach

                                <!-- estructura de las permissionss -->
                                @foreach($permissions as $permis)
                                  <tr>
                                    
                                      @if(($permis->fk_id == $sub->id) && ($permis->tipo == 4) )
                                        <td>
                                          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                          {{$permis->name}}
                                        </td>
                                        <td class="text-center">{{Form::checkbox('permissions[]', $permis->id, null)}}</td>
                                      @endif
                                    
                                  </tr>
                                @endforeach

                              @endif
                            </tr>
                          @endforeach
                        @endif
                      </tr>
                    @endforeach
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
      </div>
    </div>
    <!-- BOTONES ---->
    <div class="col-1 text-center">
      <br><br><br><br><br><br><br>
      <div>
      
        <button class="btn btn-sm btn-success" type="submit">
          <i class="far fa-check-circle"></i> 
          Actualizar
        </button>@can('adm-roles.asignarpermissionstore')
      @endcan
      </div>
    </div>
    {!! Form::close() !!}
    <!-- PERMISOS ASIGNADOS ---->
    
    

  </div>
</div>

@endsection