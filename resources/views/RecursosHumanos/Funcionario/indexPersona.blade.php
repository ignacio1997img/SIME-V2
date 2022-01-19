@extends('Layout.HomeRecursosHumanos')
@section('content')



    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div>
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"><i class="fas fa-users"></i> Personas</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('recursoshumanos')}}">Home</a></li>       
              <li class="breadcrumb-item active">Personas</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    
<div class="container" >
   <div style="padding-bottom: 5px;">
      <a class="btn btn-warning" data-toggle="tooltip" href="" title="Volver al menu principal">
         <i class="fas fa-arrow-alt-circle-left" style="width:20; height:20;"></i>
         Volver
      </a>
      @can('rrhh-personas.store')
        <a class="btn btn-success" data-toggle="modal" data-target="#modalRegistrar" title="Registrar Nueva Persona">
            <i class="fas fa-plus"></i>Registrar
        </a>
      @endcan
   </div>
   <div class="card table-responsive card-outline card-info">
      <div class="card-header">
         <div>
            <th>
               <h4 class="card-title text-center ">
               LISTA DE PERSONAS
               </h4>
            </th>
         </div>
      </div>
      <div class="card-body">
         <table class="table table-bordered table-hover table-sm" id="example2">
            <thead>
               <tr>
                  <th class="text-center">CI</th> 
                  <th class="text-center">NOMBRE COMPLETO</th>
                  <th class="text-center">TELEFONO</th> 
                  <th class="text-center">CORREO</th> 
                  <th class="text-center">ASIGNADA</th> 
                  <th class="text-center"></th>                             
               </tr>
            </thead>
            <tbody>
                @foreach($personas as $persona)
                    <tr style="text-transform:uppercase">
                        <td class="text-center">{{ $persona->cicompleto()}}</td>
                        <td>{{ $persona->nombrecompleto()}}</td>
                        <td>{{ $persona->telefono}}</td>
                        <td>{{ $persona->correo}}</td>
                        <td>
                            @if($persona->asignada == 1)
                                <span class="badge badge-success">Asignada</span>
                            @else
                                <span class="badge badge-danger">Sin Asignar</span>
                            @endif
                        </td>
                        <td>
                            <div class="container">
                                <div class="dropdown">
                                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                                        <i class="fas fa-cogs"></i>
                                        Acciones
                                    </button>
                                    <div class="dropdown-menu">
                                        @can('rrhh-personas.update')
                                            <a class="dropdown-item" data-toggle="modal" data-target="#modalEditar" data-id="{{$persona->id}}" title="Editar Persona">Editar</a>
                                        @endcan
                                        @can('rrhh-personas.kardex')
                                        <a class="dropdown-item" data-toggle="tooltip" href="{{route('rrhh-personas.kardex', $persona->id)}}" title="Ver Informacion">Kardex</a>     
                                        @endcan             
                                    </div>
                                </div>
                            </div>
                        </td>

                    </tr>
                @endforeach
            </tbody>
         </table>
      </div>
   </div>
</div>


  <!-- The Modal Registrar-->
<div class="modal" id="modalRegistrar">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header bg-success">
          <h4 class="modal-title">Registrar Persona</h4>
          <button type="button" class="close" data-dismiss="modal">×</button>
        </div>
          
          <!-- Modal body -->
          <div class="modal-body"> 
          {!! Form::open(['route' => 'persona.store', 'class' => 'was-validated']) !!}      
            <div class="row">
                <!-- ci      -->
                <div class="input-group mb-2 col-md-6">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><b>CI</b></span>
                    </div>
                    <input type="text" class="form-control" id="ci"  name="ci" style="text-transform:uppercase" required>
                    <div class="invalid-feedback">Debes Ingresar datos</div>
                    <div class="valid-feedback">¡Se esta Ingresando Datos!</div>
                </div>
                <div class="col-6">
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><b>Expedido</b></span>
                        </div>
                        <select class="form-control custom-select rounded-0" name="expedido" id="expedido" required>
                            <option value="">Seleccione expedido..</option>
                            <option value="LP">La Paz</option>
                            <option value="OR">Oruro</option>
                            <option value="PT">Potosi</option>
                            <option value="CB">Cochabamba</option>
                            <option value="CH">Chuquisaca</option>
                            <option value="TJ">Tarija</option>
                            <option value="PN">Pando</option>
                            <option value="BN">Beni</option>
                            <option value="SC">Santa Cruz</option>    
                        </select>
                        <div class="invalid-feedback">Debes Ingresar datos</div>
                        <div class="valid-feedback">¡Se esta Ingresando Datos!</div>
                    </div>
                </div>
            </div>
            <!-- nombre y apellido paterno -->
            <div class="row">                    
                <div class="col-6">
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><b>Nombre</b></span>
                        </div>
                        <input type="text" class="form-control" id="nombre"  name="nombre" style="text-transform:uppercase" required>
                        <div class="invalid-feedback">Debes Ingresar datos</div>
                        <div class="valid-feedback">¡Se esta Ingresando Datos!</div>
                    </div>
                </div>

                <div class="col-6">
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><b>Apellido Paterno</b></span>
                        </div>
                        <input type="text" class="form-control" id="apellidopaterno"  name="apellidopaterno" style="text-transform:uppercase" required>
                        <div class="invalid-feedback">Debes Ingresar datos</div>
                        <div class="valid-feedback">¡Se esta Ingresando Datos!</div>
                    </div>
                </div>   
            </div>
            <!-- apellido Materno y de esposo -->
            <div class="row">                    
                <div class="col-6">
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><b>Apellido Materno</b></span>
                        </div>
                        <input type="text" class="form-control" id="apellidomaterno" name="apellidomaterno" style="text-transform:uppercase">
                        <div class="valid-feedback">¡Campo opcional!</div>
                    </div>
                </div>

                <div class="col-6">
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><b>Apellido Esposo</b></span>
                        </div>
                        <input type="text" class="form-control" id="apellidoesposo" name="apellidoesposo" style="text-transform:uppercase">
                        <div class="valid-feedback">¡Campo opcional!</div>
                    </div>
                </div>   
            </div>
            <!-- sexo fecha de nacimiento -->
            <div class="row">
                <!-- ci      -->
                <div class="input-group mb-2 col-md-6">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><b>Fecha Nacimiento</b></span>
                    </div>
                    <input type="date" class="form-control" id="fechanacimiento"  name="fechanacimiento" required>
                    <div class="invalid-feedback">Debes Ingresar datos</div>
                    <div class="valid-feedback">¡Se esta Ingresando Datos!</div>
                </div>
                <div class="col-6">
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><b>Sexo</b></span>
                        </div>
                        <select class="form-control custom-select rounded-0" name="sexo" id="sexo" required>
                            <option value="">Seleccione sexo..</option>
                            <option value="MASCULINO">Masculino</option>
                            <option value="FEMENINO">Femenino</option>   
                        </select>
                        <div class="invalid-feedback">Debes Ingresar datos</div>
                        <div class="valid-feedback">¡Se esta Ingresando Datos!</div>
                    </div>
                </div>
            </div>

            <!-- telefono y de Direccion -->
            <div class="row">                    
                <div class="col-6">
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><b>Telefono</b></span>
                        </div>
                        <input type="text" class="form-control" id="telefono"  name="telefono" style="text-transform:uppercase">
                        <div class="valid-feedback">¡Campo opcional!</div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><b>Correo</b></span>
                        </div>
                        <input type="email" class="form-control" id="correo"  name="correo">
                        <div class="valid-feedback">¡Campo opcional!</div>
                    </div>
                </div>                    
            </div>   

            <div class="input-group mb-2">
                <div class="input-group-prepend">
                        <span class="input-group-text"><b>Dirección</b></span>
                </div>
                <textarea class="form-control" rows="3" name="direccion" id="direccion" style="text-transform:uppercase"></textarea>
                <div class="valid-feedback">¡Campo opcional!</div>
            </div>


          </div>          
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-secondary" data-dismiss="modal" data-toggle="tooltip" title="Volver al Listado">Cancelar</button>
            <button type="submit" class="btn btn-success" title="Continuar">Guardar</button>            
          </div>  
        {!! Form::close() !!}   
      </div>
    </div>
</div> 

  <!-- The Modal Editar-->
<div class="modal" id="modalEditar">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header bg-primary">
          <h4 class="modal-title">Editar Persona</h4>
          <button type="button" class="close" data-dismiss="modal">×</button>
        </div>
          
          <!-- Modal body -->
          <div class="modal-body"> 
          {!! Form::open(['route' => 'rrhh-personas.update', 'class' => 'was-validated']) !!}      

            <input type="hidden" name="id" id="id">
            <div class="row">
                <!-- ci      -->
                <div class="input-group mb-2 col-md-6">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><b>CI</b></span>
                    </div>
                    <input type="text" class="form-control" id="ci"  name="ci" style="text-transform:uppercase" required>
                    <div class="invalid-feedback">Debes Ingresar datos</div>
                    <div class="valid-feedback">¡Se esta Ingresando Datos!</div>
                </div>
                <div class="col-6">
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><b>Expedido</b></span>
                        </div>
                        <select class="form-control custom-select rounded-0" name="expedido" id="expedido" required>
                            <option value="">Seleccione expedido..</option>
                            <option value="LP">La Paz</option>
                            <option value="OR">Oruro</option>
                            <option value="PT">Potosi</option>
                            <option value="CB">Cochabamba</option>
                            <option value="CH">Chuquisaca</option>
                            <option value="TJ">Tarija</option>
                            <option value="PN">Pando</option>
                            <option value="BN">Beni</option>
                            <option value="SC">Santa Cruz</option>    
                        </select>
                        <div class="invalid-feedback">Debes Ingresar datos</div>
                        <div class="valid-feedback">¡Se esta Ingresando Datos!</div>
                    </div>
                </div>
            </div>
            <!-- nombre y apellido paterno -->
            <div class="row">                    
                <div class="col-6">
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><b>Nombre</b></span>
                        </div>
                        <input type="text" class="form-control" id="nombre"  name="nombre" style="text-transform:uppercase" required>
                        <div class="invalid-feedback">Debes Ingresar datos</div>
                        <div class="valid-feedback">¡Se esta Ingresando Datos!</div>
                    </div>
                </div>

                <div class="col-6">
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><b>Apellido Paterno</b></span>
                        </div>
                        <input type="text" class="form-control" id="paterno"  name="apellidopaterno" style="text-transform:uppercase" required>
                        <div class="invalid-feedback">Debes Ingresar datos</div>
                        <div class="valid-feedback">¡Se esta Ingresando Datos!</div>
                    </div>
                </div>   
            </div>
            <!-- apellido Materno y de esposo -->
            <div class="row">                    
                <div class="col-6">
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><b>Apellido Materno</b></span>
                        </div>
                        <input type="text" class="form-control" id="materno" name="apellidomaterno" style="text-transform:uppercase">
                        <div class="valid-feedback">¡Campo opcional!</div>
                    </div>
                </div>

                <div class="col-6">
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><b>Apellido Esposo</b></span>
                        </div>
                        <input type="text" class="form-control" id="esposo"  name="apellidoesposo" style="text-transform:uppercase">
                        <div class="valid-feedback">¡Campo opcional!</div>
                    </div>
                </div>   
            </div>
            <!-- sexo fecha de nacimiento -->
            <div class="row">
                <!-- ci      -->
                <div class="input-group mb-2 col-md-6">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><b>Fecha Nacimiento</b></span>
                    </div>
                    <input type="date" class="form-control" id="fecha"  name="fechanacimiento" required>
                    <div class="invalid-feedback">Debes Ingresar datos</div>
                    <div class="valid-feedback">¡Se esta Ingresando Datos!</div>
                </div>
                <div class="col-6">
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><b>Sexo</b></span>
                        </div>
                        <select class="form-control custom-select rounded-0" name="sexo" id="sexo" required>
                            <option value="">Seleccione un sexo..</option>
                            <option value="MASCULINO">Masculino</option>
                            <option value="FEMENINO">Femenino</option>   
                        </select>
                        <div class="invalid-feedback">Debes Ingresar datos</div>
                        <div class="valid-feedback">¡Se esta Ingresando Datos!</div>
                    </div>
                </div>
            </div>

            <!-- telefono y de Direccion -->
            <div class="row">                    
                <div class="col-6">
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><b>Telefono</b></span>
                        </div>
                        <input type="text" class="form-control" id="telefono"  name="telefono" style="text-transform:uppercase">
                        <div class="valid-feedback">¡Campo opcional!</div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><b>Correo</b></span>
                        </div>
                        <input type="email" class="form-control" id="correo"  name="correo">
                        <div class="valid-feedback">¡Campo opcional!</div>
                    </div>
                </div>                  
            </div>   

            <div class="input-group mb-2">
                <div class="input-group-prepend">
                        <span class="input-group-text"><b>Dirección</b></span>
                </div>
                <textarea class="form-control" rows="3" name="direccion" id="direccion" style="text-transform:uppercase"></textarea>
                <div class="valid-feedback">¡Campo opcional!</div>
            </div>


          </div>          
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-secondary" data-dismiss="modal" data-toggle="tooltip" title="Volver al Listado">Cancelar</button>
            <button type="submit" class="btn btn-primary" title="Continuar">Registrar</button>            
          </div>  
        {!! Form::close() !!}   
      </div>
    </div>
</div>




<script type="text/javascript">
    $('#modalEditar').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) //captura valor del data-empresa=""

    var id = button.data('  ')
    var modal = $(this)
        $.get('{{route('selectpersona')}}/'+id, function(data)
        {
            modal.find('.modal-body #id').val(id)
            modal.find('.modal-body #ci').val(data.ci)
            modal.find('.modal-body #expedido').val(data.expedido)
            modal.find('.modal-body #nombre').val(data.nombre)
            modal.find('.modal-body #paterno').val(data.apellidopaterno)
            modal.find('.modal-body #materno').val(data.apellidomaterno)
            modal.find('.modal-body #esposo').val(data.apellidoesposo)
            modal.find('.modal-body #sexo').val(data.sexo)
            modal.find('.modal-body #direccion').val(data.direccion)
            modal.find('.modal-body #telefono').val(data.telefono)
            modal.find('.modal-body #fecha').val(data.fechanacimiento)
            modal.find('.modal-body #correo').val(data.correo)
        });

    });
</script>
@endsection