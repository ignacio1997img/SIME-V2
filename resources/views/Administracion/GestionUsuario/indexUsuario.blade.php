@extends('Layout.HomeAdministracion')
@section('content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div></div>
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"><i class="fas fa-cubes"></i> Usuario</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('administracion')}}">Home</a></li>         
              <li class="breadcrumb-item active">Usuario</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    
<div class="container" style="width: 800px;">
   <div style="padding-bottom: 5px;">
      <a class="btn btn-warning" data-toggle="tooltip" href="" title="Volver al menu principal">
         <i class="fas fa-arrow-alt-circle-left" style="width:20; height:20;">
         </i>
         Volver
      </a>
      @can('adm-usuario.store')
        <a class="btn btn-success" data-toggle="modal" data-target="#modalRegistrar" title="Nuevo Registro">
          <i class="fas fa-plus">
          </i>
          Registrar
        </a>
      @endcan
   </div>
   <div class="card table-responsive card-outline card-info">
      <div class="card-header">
         <div>
            <th>
               <h4 class="card-title text-center ">
               LISTA DE MODULOS
               </h4>
            </th>
         </div>
      </div>
      <div class="card-body">
         <table class="table table-bordered table-hover table-sm" id="example2">
            <thead>
               <tr>
                  <th class="text-center" width="50">N°</th>
                  <th class="text-center">NOMBRE</th> 
                  <th class="text-center">USUARIO</th> 
                  <th class="text-center">ESTADO</th>      
                  <th class="text-center"></th>                            
               </tr>
            </thead>
            <?php $a = 1; ?>
            <tbody>
              @foreach($usuarios as $usu)
                <tr style="text-transform:uppercase">
                  <td>{{$a}}</td>
                  <td>{{$usu->funcionario->persona->nombrecompleto()}}</td>
                  <td>{{$usu->email}}</td>
                  <td>
                    @if($usu->activo == 1)
                      <span class="badge badge-success">Activo</span>
                    @else
                    <span class="badge badge-danger">Deshabilitado</span>
                    @endif
                  </td>
                  @if($usu->activo == 1)
                    <td class="text-center" style="width: 5%">
                        <div class="container">
                            <div class="dropdown">
                                <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                                    <i class="fas fa-cogs"></i>
                                    Acciones
                                </button>
                                <div class="dropdown-menu">
                                  @if($activo->id != $usu->id)
                                      <a class="dropdown-item" data-toggle="modal" data-target="#modalReset" data-id="{{$usu->id}}"
                                      data-funcionario="{{$usu->funcionario->persona->nombrecompleto()}}" data-usuario="{{$usu->email}}" title="Resetear">Resetear Contraseña</a>
                                  @endif    
                                    @can('null')
                                @endcan
                                @can('adm-usuario.viewasignarroles') 
                                    <a class="dropdown-item" href="{{route('adm-usuario.viewasignarroles', $usu->id)}}">Asignar Role</a>
                                @endcan           
                                </div>
                            </div>
                        </div>
                    </td>
                  @endif

                </tr>
                <?php $a++; ?>
              @endforeach
            </tbody>
         </table>
      </div>
   </div>
</div>


  <!-- The Modal Registrar-->
  <div class="modal fade" id="modalRegistrar">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header bg-success">
          <h4 class="modal-title">Registrar Usuarios</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
          {!! Form::open(['route' => 'register', 'class' => 'was-validated'])!!}

            <div class="input-group mb-2">
                <div class="input-group-prepend">
                <span class="input-group-text">Funcionario</span>
                </div>
                <select class="form-control select2bs4" name="funcionario_id" id="funcionario_id" required>
                <option value="">Seleccione un funcionario..</option>
                @foreach($funcionarios as $funcionario)
                  <option value="{{$funcionario->id}}">{{strtoupper($funcionario->nombre)}} {{strtoupper($funcionario->apellidopaterno)}} {{strtoupper($funcionario->apellidomaterno)}}</option>
                @endforeach
                 
                </select>
                <div class="invalid-feedback">Debes Ingresar datos</div>
                <div class="valid-feedback">¡Se esta Ingresando Datos!</div>
            </div>



            <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Usuario') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                <!-- @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror -->
                            </div>
                        </div>

                        <div class="form-group row">
                            <!-- <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label> -->

                            <div class="col-md-6">
                                <input id="password" type="hidden" class="form-control @error('password') is-invalid @enderror" name="password" value="12345678" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <!-- <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label> -->

                            <div class="col-md-6">
                                <input id="password-confirm" type="hidden" class="form-control" name="password_confirmation" value="12345678" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>




        {!! Form::close()!!} 
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="modalReset">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header bg-warning">
          <h4 class="modal-title">Resetear Contraseña</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
          {!! Form::open(['route' => 'adm-usuario.reset', 'class' => 'was-validated'])!!}
            <input type="hidden" id="id" name="id">
            <div class="input-group mb-2"  style="padding: 10px;">           
                <div class="input-group-prepend">
                    <span class="input-group-text"><b>Usuario</b></span>
                </div>
                <input type="text" class="form-control" id="usuario" style="text-transform:uppercase" disabled>   
            </div> 
            <div class="input-group mb-2"  style="padding: 10px;">           
                <div class="input-group-prepend">
                    <span class="input-group-text"><b>Funcionario</b></span>
                </div>
                <input type="text" class="form-control" id="funcionario" style="text-transform:uppercase" disabled>   
            </div> 
        </div>

        <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-secondary" data-dismiss="modal" data-toggle="tooltip" title="Volver al Listado">Cancelar</button>
            <button type="submit" class="btn btn-success" title="Continuar">Guardar</button>            
        </div> 

        {!! Form::close()!!}
      </div>
    </div>
  </div>


<script type="text/javascript">
  $('#modalReset').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget)
    var id = button.data('id')
    var funcionario = button.data('funcionario')
    var usuario = button.data('usuario')

    var modal = $(this)

    modal.find('.modal-body #id').val(id)
    modal.find('.modal-body #funcionario').val(funcionario)
    modal.find('.modal-body #usuario').val(usuario)

  });
</script>


@endsection