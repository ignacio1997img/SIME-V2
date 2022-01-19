@extends('Layout.HomeAseoUrbano')
@section('content')

    <div class="content-header">
      <div>
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"><i class="fas fa-receipt"></i> Detalle Despacho Barrido</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('aseourbano')}}">Home</a></li>   
              <li class="breadcrumb-item"><a href="{{route('barridodespacho.index')}}">Barrido Despachos</a></li>      
              <li class="breadcrumb-item active">Detalle Despacho Barrido</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

<div class="container-fluid">
  <div class="card">
    <div class="card-header">
      <div class="row">
        <div class="col-6">
          <h3>            
            <b>{{\Jenssegers\Date\Date::parse($despacho->fecha)->format('l j F Y')}}</b>
          </h3>
        </div>
        <div class="col-6">
          <div class="dropdown dropleft float-right">
            @if($despacho->estado == 1 && ($ok == $dcant && $dcant != 0))
              <a  class="btn btn-danger" data-toggle="tooltip" href="{{route('au-rtbarrido.despacho.close', $despacho->id)}}">
                <i class="fas fa-arrow-circle-right"></i> Cerrar
              </a>
            @endif
            @if($despacho->estado == 1)
              <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalRegistrar">
                <i class="fas fa-plus"></i>
                Ruta
              </button>
            @endif
          </div>
        </div>
      </div> 
    </div>
    <div class="card-body" id="div1">
    <table id="example2" class="table table-md table-bordered table-hover table-striped">
        <thead>
          <tr>
            <th class="text-center">NOMBRE</th>
            <th class="text-center">DESCRIPCION</th>
            <th class="text-center">TURNO</th>
            <th class="text-center" width="10%">ESTADO</th>
            <th class="text-center" width="10%">OPCIONES</th>
          </tr>
        </thead>
        <tbody>
          @foreach($detalles as $det)
            <tr>
              <td>{{$det->nombre}}</td>
              <td>{{$det->descripcion}}</td>
              <td>{{$det->turno}}</td>
              <td>
                @if($det->activo == 1)
                  
                  <span class="badge badge-danger">PENDIENTE</span>
                @endif
                @if($det->activo == 2)
                  <span class="badge badge-warning">ABIERTO</span>
                @endif
                @if($det->activo == 3)
                  <span class="badge badge-success">CERRADO</span>
                @endif
              </td>
              <td class="text-center" style="width: 5%">
                <div class="container">
                  <div class="dropdown">
                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                      <i class="fas fa-cogs"></i>
                    </button>
                    <div class="dropdown-menu">
                      
                      @if($det->activo== 2)
                        <a class="dropdown-item" href="{{route('au-rtbarrido.despacho.despachodetalle.viewpersonal', $det->id)}}">Personal</a>
                  
                        <a class="dropdown-item" data-toggle="modal" data-target="#modalEditar" data-id="{{$despacho->id}}" data-idd="{{$det->id}}" data-rutaid="{{$det->ruta_id}}" data-ruta="{{$det->nombre}}">Editar</a>    
                      @endif
                      @if($det->activo== 1)
                        <a class="dropdown-item" href="{{route('au-rtbarrido.despacho.despachodetalle.viewpersonal', $det->id)}}">Personal</a>
                  
                        <a class="dropdown-item" data-toggle="modal" data-target="#modalEditar" data-id="{{$despacho->id}}" data-idd="{{$det->id}}" data-rutaid="{{$det->ruta_id}}" data-ruta="{{$det->nombre}}">Editar</a>
                        <a class="dropdown-item" data-toggle="modal" data-target="#modalEliminar" data-id="{{$det->id}}" data-ruta="{{$det->nombre}}">Eliminar</a>
                      @endif

                      @if($det->activo== 3)
                        <a class="dropdown-item" href="{{route('au-rtbarrido.despacho.despachodetalle.printf', $det->id)}}">Imprimir</a> 
                      @endif
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
  <div class="modal fade" id="modalRegistrar">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header bg-success">
          <h4 class="modal-title"><i class="fas fa-route"></i> Registrar Ruta</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
        {!! Form::open(['route' => 'barridodespachodetalle.store', 'class' => 'was-validated'])!!}
                <input type="hidden" value="{{$despacho->id}}" name="despacho_id">
                <input type="hidden" name="fecha" value="{{$despacho->fecha}}">
                <div class="input-group mb-2">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><b>Fecha</b></span>
                  </div>
                  <input type="text" class="form-control" id="salida"  name="salida" value="{{\Jenssegers\Date\Date::parse($despacho->fecha)->format('l j F Y')}}" disabled>
                </div>  
                <div class="input-group mb-2">
                    <div class="input-group-prepend">
                    <span class="input-group-text"><b>Ruta</b></span>
                    </div>
                    <select class="form-control custom-select rounded-0" name="ruta_id" id="ruta_id" style="text-transform:uppercase" required>
                    <option value="">Seleccione una ruta..</option>
                        @foreach($rutas as $ruta)
                            <option value="{{$ruta->id}}">{{$ruta->nombre}}</option>
                        @endforeach   
                    </select>
                    <div class="invalid-feedback">Debes Ingresar datos</div>
                    <div class="valid-feedback">¡Se esta Ingresando Datos!</div>
                </div>
                <div class="input-group mb-2">
                    <div class="input-group-prepend">
                    <span class="input-group-text"><b>Turno</b></span>
                    </div>
                    <select class="form-control custom-select rounded-0" name="turno" style="text-transform:uppercase" required>
                    <option value="">Seleccione turno..</option>
                      <option value="DIURNO">DIURNO</option> 
                      <option value="NOCTURNO">NOCTURNO</option> 
                    </select>
                    <div class="invalid-feedback">Debes Ingresar datos</div>
                    <div class="valid-feedback">¡Se esta Ingresando Datos!</div>
                </div>
        
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal" data-toggle="tooltip" title="Volver al Listado">Cancelar
          </button>
          <button type="submit" class="btn btn-success btn-sm" title="Continuar">Guardar
          </button>
        </div>
        {!! Form::close()!!} 
        
      </div>
    </div>
</div>

<div class="modal fade" id="modalEditar">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header bg-success">
          <h4 class="modal-title"><i class="fas fa-route"></i> Editar Ruta</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
        {!! Form::open(['route' => 'au-rtbarrido.despacho.despachodetalle.update', 'class' => 'was-validated'])!!}
                <input type="hidden" id="id" name="id">
                <input type="hidden" value="{{$despacho->id}}" name="despacho_id">
                <input type="hidden" name="fecha" value="{{$despacho->fecha}}">
                <div class="input-group mb-2">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><b>Fecha</b></span>
                  </div>
                  <input type="text" class="form-control" id="salida"  name="salida" value="{{\Jenssegers\Date\Date::parse($despacho->fecha)->format('l j F Y')}}" disabled>
                </div>  
                <div class="input-group mb-2">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><b>Ruta</b></span>
                  </div>
                  <input type="text" class="form-control" id="rutas" disabled>
                </div> 
                <div class="input-group mb-2">
                    <div class="input-group-prepend">
                    <span class="input-group-text"><b>Ruta</b></span>
                    </div>
                    <select class="form-control custom-select rounded-0" name="ruta_id" id="rutass" style="text-transform:uppercase" required>
                    
                    </select>
                    <div class="invalid-feedback">Debes Ingresar datos</div>
                    <div class="valid-feedback">¡Se esta Ingresando Datos!</div>
                </div>
                <div class="input-group mb-2">
                    <div class="input-group-prepend">
                    <span class="input-group-text"><b>Turno</b></span>
                    </div>
                    <select class="form-control custom-select rounded-0" name="turno" style="text-transform:uppercase" required>
                    <option value="">Seleccione turno..</option>
                      <option value="DIURNO">DIURNO</option> 
                      <option value="NOCTURNO">NOCTURNO</option> 
                    </select>
                    <div class="invalid-feedback">Debes Ingresar datos</div>
                    <div class="valid-feedback">¡Se esta Ingresando Datos!</div>
                </div>
    
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal" data-toggle="tooltip" title="Volver al Listado">Cancelar
          </button>
          <button type="submit" class="btn btn-success btn-sm" title="Continuar">Guardar
          </button>
        </div>
        {!! Form::close()!!} 
        
      </div>
    </div>
</div>

<div class="modal hide fade in" data-keyboard="false" data-backdrop="static" id="modalEliminar">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header bg-danger">
          <h4 class="modal-title"><i class="fas fa-route"></i> Eliminar Ruta</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
        {!! Form::open(['route' => 'au-rtbarrido.despacho.despachodetalle.delete', 'method' => 'DELETE']) !!}
                <input type="hidden" id="id" name="id">
                <input type="hidden" value="{{$despacho->id}}" name="despacho_id">
                <div class="text-center" style="text-transform:uppercase">
                    <i class="far fa-trash-alt" style="color: red; font-size: 5em;"></i>
                    <br>
                    
                    <p><b>Esta Seguro De Eliminar La Ruta?</b></p>
                </div>
                <div class="input-group mb-2">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><b>Fecha</b></span>
                  </div>
                  <input type="text" class="form-control" id="salida"  name="salida" value="{{\Jenssegers\Date\Date::parse($despacho->fecha)->format('l j F Y')}}" disabled>
                </div>  
                <div class="input-group mb-2">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><b>Ruta</b></span>
                  </div>
                  <input type="text" class="form-control" id="rutas" disabled>
                </div>             
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal" data-toggle="tooltip" title="Volver al Listado">Cancelar
          </button>
          <button type="submit" class="btn btn-danger btn-sm" title="Continuar">Guardar
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
  var idd = button.data('idd')
  // alert(id)
  var ruta = button.data('ruta')
  var ruta_id = button.data('rutaid')
// alert(ruta_id)
  var modal = $(this)

  modal.find('.modal-body #id').val(idd)
  // alert(id)
  modal.find('.modal-body #rutas').val(ruta)

  $.get('{{route('selectbarridodespachoruta')}}/'+id+'/'+ruta_id, function(data){ 
            // alert(data[0].nombre)
            var html_ruta=    '<option value="">Seleccione una opcion..</option>'
                for(var i=0; i<data.length; ++i)
                html_ruta += '<option value="'+data[i].id+'">'+data[i].nombre +'</option>'

            $('#rutass').html(html_ruta);         
  });

});
$('#modalEliminar').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) //captura valor del data-empresa=""

  var id = button.data('id')
  var ruta = button.data('ruta')
  // alert(ruta)
// alert(ruta)
  var modal = $(this)

  modal.find('.modal-body #id').val(id)
  modal.find('.modal-body #rutas').val(ruta)

});
</script>

@endsection