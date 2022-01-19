@extends('Layout.HomeAdministracion')
@section('content')


<div class="content-header">
  <div class="row mb-2">
    <div class="col-sm-6">
      <h1 class="m-0 text-dark"><i class="fas fa-cubes"></i> Asignacion de Roles</h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{route('administracion')}}">Home</a></li>     
        <li class="breadcrumb-item"><a href="{{route('user.index')}}">Usuarios</a></li>   
        <li class="breadcrumb-item active">Asignacion</li>
      </ol>
    </div><!-- /.col -->
  </div><!-- /.row -->
</div>

<a class="btn btn-warning" data-toggle="tooltip" href="{{route('user.index')}}" title="Volver al listado de usuarios">
  <i class="fas fa-arrow-alt-circle-left" ></i>
  Volver
</a>
<p>Usuario: {{$users->funcionario->persona->nombrecompleto()}}</p>

<div class="container-fluid">
  <div class="row">
    <div class="col-5">
      <div class="card">
        <div class="card-header text-center bg-warning">
          <i class="far fa-check-square"></i>&nbsp;
          <b>Roles Por Asignar</b></div>
        <div class="card-body" id="div1">          
          {!! Form::model($users, ['route' => ['user.update', $users->id], 'method' => 'PUT']) !!}
            <table class="table table-bordered table-hover table-striped table-sm" >
              @foreach($roles as $role)
              <tr>
                <td>
                  &nbsp;{{Form::checkbox('roles[]', $role->id, null)}}
                  &nbsp;{{$role->name}}
                </td>
              </tr>
              @endforeach
            </table>
        </div>
      </div>
    </div>
    <!-- BOTONES ---->
    <div class="col-2 text-center">
      <br><br><br><br><br><br><br>
      <div>
        @can('adm-usuario.asignarroles')
          <button class="btn btn-success" type="submit">
            <i class="far fa-check-circle"></i> 
            Actualizar
          </button>
        @endcan
      </div>
    </div>
    {!! Form::close() !!}
    <div class="col-5">
      <div class="card">
        <div class="card-header text-center bg-primary">
          <i class="far fa-list-alt"></i>&nbsp;
          <b>Roles Asignados</b>
        </div>
        <div class="card-body"id="div1">
            <table class="table table-bordered table-hover table-striped table-sm" >
              @foreach($rols as $rol)
              <tr>
                <td>
                  &nbsp;{{$rol->name}}
                </td>
              </tr>
              @endforeach
            </table> 
        </div>
      </div>
    </div>
  </div>
</div>

@endsection