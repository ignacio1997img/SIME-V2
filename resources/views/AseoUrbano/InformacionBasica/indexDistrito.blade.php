@extends('Layout.HomeAseoUrbano')
@section('content')

    <div class="content-header">
      <div>
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"><i class="fas fa-globe"></i> Distritos</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('aseourbano')}}">Home</a></li>       
              <li class="breadcrumb-item active">Distritos</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>



    <div class="container" style="width: 70%">
        <div style="padding-bottom: 5px;">
            <a class="btn btn-warning" data-toggle="tooltip" href="{{route('aseourbano')}}" title="Volver al menu principal">
                <i class="fas fa-arrow-alt-circle-left"></i>
                Volver
            </a>  
            @can('au-distritos.store')      
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
                        <th class="text-center">RESPONSABLE</th>
                        <th class="text-center">TELEFONO</th>
                        @canany(['au-distritos.agregarcontacto','au-distritos.update','au-distrito.historial'])
                        <th class="text-center">OPCIONES</th>
                        @endcanany
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($distritos as $dis)
                            @if(($dis->activo === 1) || ($dis->activo === NULL))
                                <tr >
                                
                                    <td style="text-transform:uppercase;">{{$dis->id}}</td>
                                    <td style="text-transform:uppercase;">{{$dis->descripcion}}</td>
                                    <td style="text-transform:uppercase;">{{$dis->nombrecompleto}}</td>
                                    <td style="text-transform:uppercase;">{{$dis->telefono}}</td>
                                    @canany(['au-distritos.agregarcontacto','au-distritos.update','au-distrito.historial'])
                                    <td class="text-center" style="width: 5%">
                                        <div class="container">
                                            <div class="dropdown">
                                                <button type="button" class="btn btn-sm btn-primary dropdown-toggle" data-toggle="dropdown">
                                                    <i class="fas fa-cogs"></i>
                                                </button>
                                                <div class="dropdown-menu">
                                                    @can('au-distritos.agregarcontacto')
                                                        <a class="dropdown-item" data-toggle="modal" data-target="#modalAgregar" data-id="{{$dis->id}}"
                                                            data-desc="{{$dis->descripcion}}" data-res="{{$dis->nombrecompleto}}" title="Agregar Contacto">
                                                            Contacto
                                                        </a>
                                                    @endcan
                                                    @can('au-distritos.update')
                                                        <a class="dropdown-item" data-toggle="modal" data-target="#modalEditar" data-id="{{$dis->id}}"
                                                            data-desc="{{$dis->descripcion}}" title="Editar Distrito">
                                                            Editar
                                                        </a>
                                                    @endcan
                                                    @can('au-distrito.historial')
                                                        <a class="dropdown-item" href="{{route('au-distrito.historial', $dis->id)}}" title="Historial de Distrito">Historial</a> 
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
                <h4 class="modal-title">Registrar Distrito</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            
            <!-- Modal body -->
            <div class="modal-body">
            {!! Form::open(['route' => 'distrito.store', 'class' => 'was-validated'])!!}
                <div class="input-group mb-2">
                    <div class="input-group-prepend">
                    <span class="input-group-text"><b>Distrito</b></span>
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
                <h4 class="modal-title">Editar Distrito</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            
            <!-- Modal body -->
            <div class="modal-body">
            {!! Form::open(['route' => 'au-distrito.update', 'class' => 'was-validated'])!!}
                <input type="hidden" id="id" name="id">
                <div class="input-group mb-2">
                    <div class="input-group-prepend">
                    <span class="input-group-text"><b>Distrito</b></span>
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

      <!-- The Modal para agregar responsable a distrito-->
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
            {!! Form::open(['route' => 'distritocontacto.store', 'class' => 'was-validated'])!!}
                <div class="input-group mb-2 ">               
                    <div class="input-group-prepend">
                        <span class="input-group-text"><b>Distrito</b></span>
                    </div>
                    <input type="text" class="form-control" id="descripcion" style="text-transform:uppercase" disabled>            
                </div>    
                <input type="hidden" id="id" name="distrito_id">
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

  var modal = $(this)

  modal.find('.modal-body #id').val(id)
  modal.find('.modal-body #descripcion').val(desc)

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