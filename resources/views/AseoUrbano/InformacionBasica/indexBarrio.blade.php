@extends('Layout.HomeAseoUrbano')
@section('content')

    <div class="content-header">
      <div>
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"><i class="fas fa-map-signs"></i> Barrios</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('aseourbano')}}">Home</a></li>       
              <li class="breadcrumb-item active">Barrios</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>



    <div class="container" style="width: 80%">
        <div style="padding-bottom: 5px;">
            <a class="btn btn-warning" data-toggle="tooltip" href="{{route('aseourbano')}}" title="Volver al menu principal">
                <i class="fas fa-arrow-alt-circle-left"></i>
                Volver
            </a>  
            @can('au-barrios.store')      
                <a class="btn btn-success" data-toggle="modal" data-target="#modalRegistrar" title="Registrar Nuevo Dsitrito">
                    <i class="fas fa-plus"></i>
                    Registrar
                </a>
            @endcan
        </div>
        <div class="card table-responsive card-outline card-info">
            <div class="card-header">
                <div>
                    <th>
                    <h4 class="card-title text-center ">
                    LISTA DE DISTRITO
                    </h4>
                    </th>
                </div>
            </div>
            <div class="card-body" >
                <table class="table table-bordered table-hover table-sm" id="example2">
                    <thead>
                    <tr>
                        <th class="text-center">ID</th>
                        <th class="text-center">DISTRITO</th>
                        <th class="text-center">BARRIOS</th>
                        <th class="text-center">RESPONSABLE</th>
                        <th class="text-center">TELEFONO</th>
                        @canany(['au-barrios.agregarcontacto','au-barrios.update','au-barrios.historial'])
                            <th class="text-center">OPCIONES</th>
                        @endcanany
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($barrios as $barrio)
                            @if(($barrio->activo === 1) || ($barrio->activo === NULL))
                                <tr >
                                
                                    <td style="text-transform:uppercase;">{{$barrio->id}}</td>
                                    <td style="text-transform:uppercase;">{{$barrio->distrito}}</td>
                                    <td style="text-transform:uppercase;">{{$barrio->barrio}}</td>
                                    <td style="text-transform:uppercase;">{{$barrio->nombrecompleto}}</td>
                                    <td style="text-transform:uppercase;">{{$barrio->telefono}}</td>
                                    @canany(['au-barrios.agregarcontacto','au-barrios.update','au-barrios.historial'])
                                    <td class="text-center" style="width: 5%">
                                        <div class="container">
                                            <div class="dropdown">
                                                <button type="button" class="btn btn-sm btn-primary dropdown-toggle" data-toggle="dropdown">
                                                    <i class="fas fa-cogs"></i>
                                                </button>
                                                <div class="dropdown-menu">
                                                    @can('au-barrios.agregarcontacto')
                                                        <a class="dropdown-item" data-toggle="modal" data-target="#modalAgregar" data-id="{{$barrio->id}}"
                                                            data-desc="{{$barrio->barrio}}" data-res="{{$barrio->nombrecompleto}}" title="Agregar Contacto">
                                                            Contacto
                                                        </a>
                                                    @endcan
                                                    @can('au-barrios.update')
                                                        <a class="dropdown-item" data-toggle="modal" data-target="#modalEditar" data-id="{{$barrio->id}}"
                                                            data-desc="{{$barrio->barrio}}" data-dist="{{$barrio->distrito}}" title="Editar Barrio">
                                                            Editar
                                                        </a>
                                                    @endcan
                                                    @can('au-barrios.historial')
                                                        <a class="dropdown-item" href="{{route('au-barrios.historial', $barrio->id)}}" title="Historial de Barrio">Historial</a> 
                                                    @endcan                                   
                                                </div>
                                            </div>
                                        </div>
                                    </td> 
                                    @endcanany           
                                </tr>
                            @endif
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
                <h4 class="modal-title">Registrar Barrio</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            
            <!-- Modal body -->
            <div class="modal-body">
            {!! Form::open(['route' => 'barrio.store', 'class' => 'was-validated'])!!}
                <div class="input-group mb-2">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><b>Distrito</b></span>
                    </div>
                    <select class="form-control custom-select rounded-0" name="distrito_id" id="distrito_id" style="text-transform:uppercase" required>
                        <option value="">Seleccione un distrito..</option>
                        @foreach($distritos as $dist)
                            <option value="{{$dist->id}}">{{$dist->descripcion}}</option>
                        @endforeach    
                    </select>
                    <div class="invalid-feedback">Debes Ingresar datos</div>
                    <div class="valid-feedback">¡Se esta Ingresando Datos!</div>
                </div>
                <div class="input-group mb-2">
                    <div class="input-group-prepend">
                    <span class="input-group-text"><b>Barrio</b></span>
                    </div>
                    <input type="text" id="descripcion" name="descripcion" class="form-control" style="text-transform:uppercase" minlength="3" maxlength="100" required>
                    <div class="invalid-feedback">Debes Ingresar datos</div>
                    <div class="valid-feedback">¡Se esta Ingresando Datos!</div>
                </div>
            </div>
            
            <!-- Modal footer -->
            <div class="modal-footer justify-content-between">
            <button type="button text-left" class="btn btn-secondary btn-sm" data-dismiss="modal" data-toggle="tooltip" title="Volver al Listado">Cancelar
            </button>
            <button type="submit" class="btn btn-success btn-sm" title="Continuar">
            Guardar
            </button>
            </div>
            {!! Form::close()!!} 
            
        </div>
    </div>
</div>

      <!-- The Modal Editar-->
<div class="modal fade" id="modalEditar">
    <div class="modal-dialog">
        <div class="modal-content">        
            <!-- Modal Header -->
            <div class="modal-header bg-primary">
                <h4 class="modal-title">Editar Barrio</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            
            <!-- Modal body -->
            <div class="modal-body">
            {!! Form::open(['route' => 'au-barrios.update', 'class' => 'was-validated'])!!}
                <input type="hidden" id="id" name="id">
                <h5 id="dist"></h5>
                <div class="input-group mb-2">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><b>Distrito</b></span>
                    </div>
                    <select class="form-control custom-select rounded-0" name="distrito_id" id="distrito_id" style="text-transform:uppercase" required>
                        <option value="">Seleccione un distrito..</option>
                        @foreach($distritos as $dist)
                            <option value="{{$dist->id}}">{{$dist->descripcion}}</option>
                        @endforeach    
                    </select>
                    <div class="invalid-feedback">Debes Ingresar datos</div>
                    <div class="valid-feedback">¡Se esta Ingresando Datos!</div>
                </div>
                <div class="input-group mb-2">
                    <div class="input-group-prepend">
                    <span class="input-group-text"><b>Barrio</b></span>
                    </div>
                    <input type="text" id="descripcion" name="descripcion" class="form-control" style="text-transform:uppercase" minlength="3" maxlength="100" required>
                    <div class="invalid-feedback">Debes Ingresar datos</div>
                    <div class="valid-feedback">¡Se esta Ingresando Datos!</div>
                </div>                
            </div>
            
            <!-- Modal footer -->
            <div class="modal-footer justify-content-between">
            <button type="button text-left" class="btn btn-secondary btn-sm" data-dismiss="modal" data-toggle="tooltip" title="Volver al Listado">Cancelar
            </button>
            <button type="submit" class="btn btn-primary btn-sm" title="Continuar">
            Guardar
            </button>
            </div>
            {!! Form::close()!!} 
            
        </div>
    </div>
</div>

<div class="modal fade" id="modalAgregar">
    <div class="modal-dialog">
        <div class="modal-content">        
            <!-- Modal Header -->
            <div class="modal-header bg-warning">
                <h4 class="modal-title" id="res"></h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            
            <!-- Modal body -->
            <div class="modal-body">
            {!! Form::open(['route' => 'barriocontacto.store', 'class' => 'was-validated'])!!}
                <div class="input-group mb-2 ">               
                    <div class="input-group-prepend">
                        <span class="input-group-text"><b>Barrio</b></span>
                    </div>
                    <input type="text" class="form-control" id="descripcion" style="text-transform:uppercase" disabled>            
                </div>    
                <input type="hidden" id="id" name="barrio_id">
                <input type="hidden" id="tip" name="tip">
                
                <div class="input-group">
                    <div class="input-group-prepend">
                    <span class="input-group-text">Persona</span>
                    </div>
                    <select class="form-control select2bs4" style="width: 60%; height: 50%; " name="contacto_id" id="contacto_id" style="text-transform:uppercase" required>
                        <option value="">Seleccione una Persona..</option>
                        @foreach($contactos as $cont)
                            <option value="{{$cont->id}}">{{$cont->nombrecompleto}}</option>
                        @endforeach
                    </select>
                    <div class="invalid-feedback">Debes Ingresar datos</div>
                    <div class="valid-feedback">¡Se esta Ingresando Datos!</div>
                </div>    
                <div class="input-group mb-2">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><b>Observaion</b></span>
                    </div>
                    <textarea class="form-control" rows="2" name="observacion" id="observacion" style="text-transform:uppercase" maxlength="500"></textarea>
                    <div class="valid-feedback">¡Campo opcional!</div>
                </div>         
            </div>
            
            <!-- Modal footer -->
            <div class="modal-footer justify-content-between">
            <button type="button text-left" class="btn btn-secondary btn-sm" data-dismiss="modal" data-toggle="tooltip" title="Volver al Listado">Cancelar
            </button>
            <button type="submit" class="btn btn-warning btn-sm" title="Continuar">
            Guardar
            </button>
            </div>
            {!! Form::close()!!} 
            
        </div>
    </div>
</div>







<script type="text/javascript">
$('#modalEditar').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) //captura valor del data-empresa=""

  var id = button.data('id')
  var desc = button.data('desc')
  var dist = button.data('dist')

  var modal = $(this)

  modal.find('.modal-body #id').val(id)
  modal.find('.modal-body #descripcion').val(desc)
  modal.find('.modal-body #dist').text(dist)

});

$('#modalAgregar').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) //captura valor del data-empresa=""

  var id = button.data('id')
  var desc = button.data('desc')
  var res = button.data('res')

  var modal = $(this)

  modal.find('.modal-body #id').val(id)
  modal.find('.modal-body #descripcion').val(desc)
  
  if(res != '')
  {
    modal.find('.modal-body #tip').val(0)
    modal.find('.modal-header #res').text('Editar Responsable')
  }
  else
  {
    modal.find('.modal-body #tip').val(1)
    modal.find('.modal-header #res').text('Agregar Responsable')
  }

});
</script>

@endsection