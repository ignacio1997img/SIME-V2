@extends('Layout.HomeAseoUrbano')
@section('content')

    <div class="content-header">
      <div>
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"><i class="fas fa-address-book"></i> Contactos</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('aseourbano')}}">Home</a></li>       
              <li class="breadcrumb-item active">Contactos</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>


    <div class="container">
        <div style="padding-bottom: 5px;">
            <a class="btn btn-warning" data-toggle="tooltip" href="{{route('aseourbano')}}" title="Volver al menu principal">
                <i class="fas fa-arrow-alt-circle-left"></i>
                Volver
            </a>     
            @can('au-contactos.store')   
                <a class="btn btn-success" data-toggle="modal" data-target="#modalRegistrar" title="Registrar Nuevo Contacto">
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
                    LISTA DE CONTACTOS
                    </h4>
                    </th>
                </div>
            </div>
            <div class="card-body" >
                <table class="table table-bordered table-hover table-sm" id="example2">
                    <thead>
                    <tr>
                        <th class="text-center">ID</th>
                        <th class="text-center">NOMBRE</th>
                        <th class="text-center">TELEFONO</th>
                        <th class="text-center">DIRECCION</th>
                        <th class="text-center">REFERENCIA</th>
                        @can('au-contactos.update')
                            <th></th>
                        @endcan
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($contactos as $cont)
                            <tr style="text-transform:uppercase;">
                                <td><font size=2>{{$cont->id}}</font></td>
                                <td><font size=2>{{$cont->nombrecompleto}}</font></td>    
                                <td><font size=2>{{$cont->telefono}}</font></td> 
                                <td><font size=2>{{$cont->direccion}}</font></td> 
                                <td><font size=2>{{$cont->referencia}}</font></td> 
                                @can('au-contactos.update')
                                    <td class="text-center" style="width: 5%">
                                        <a class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalEditar" data-id="{{$cont->id}}"
                                            data-nombre="{{$cont->nombrecompleto}}" data-telefono="{{$cont->telefono}}" data-direc="{{$cont->direccion}}"
                                            data-ref="{{$cont->referencia}}" title="Editar Contacto">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    </td>
                                @endcan                    
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
                <h4 class="modal-title">Registrar Contacto</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            
            <!-- Modal body -->
            <div class="modal-body">
            {!! Form::open(['route' => 'contacto.store', 'class' => 'was-validated'])!!}

                <div class="input-group mb-2">
                    <div class="input-group-prepend">
                    <span class="input-group-text"><b>Nombre</b></span>
                    </div>
                    <input type="text" id="nombrecompleto" name="nombrecompleto" class="form-control" style="text-transform:uppercase" minlength="3" maxlength="150" required>
                    <div class="invalid-feedback">Debes Ingresar datos</div>
                    <div class="valid-feedback">¡Se esta Ingresando Datos!</div>
                </div>
                <div class="input-group mb-2">
                    <div class="input-group-prepend">
                    <span class="input-group-text"><b>Telefono</b></span>
                    </div>
                    <input type="text" id="telefono" name="telefono" class="form-control" style="text-transform:uppercase" maxlength="50">
                    <div class="invalid-feedback">Debes Ingresar datos</div>
                    <div class="valid-feedback">¡Se esta Ingresando Datos!</div>
                </div>
                <div class="input-group mb-2">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><b>Dirección</b></span>
                    </div>
                    <textarea class="form-control" rows="3" name="direccion" id="direccion" style="text-transform:uppercase" maxlength="500"></textarea>
                    <div class="valid-feedback">¡Campo opcional!</div>
                </div>
                <div class="input-group mb-2">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><b>Referencia</b></span>
                    </div>
                    <textarea class="form-control" rows="3" name="referencia" id="referencia" style="text-transform:uppercase" maxlength="500"></textarea>
                    <div class="valid-feedback">¡Campo opcional!</div>
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
                <h4 class="modal-title">Editar Contacto</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            
            <!-- Modal body -->
            <div class="modal-body">
            {!! Form::open(['route' => 'au-contactos.update', 'class' => 'was-validated'])!!}
                <input type="hidden" id="id" name="id">
                <div class="input-group mb-2">
                    <div class="input-group-prepend">
                    <span class="input-group-text"><b>Nombre</b></span>
                    </div>
                    <input type="text" id="nombrecompleto" name="nombrecompleto" class="form-control" style="text-transform:uppercase" minlength="3" maxlength="150" required>
                    <div class="invalid-feedback">Debes Ingresar datos</div>
                    <div class="valid-feedback">¡Se esta Ingresando Datos!</div>
                </div>
                <div class="input-group mb-2">
                    <div class="input-group-prepend">
                    <span class="input-group-text"><b>Telefono</b></span>
                    </div>
                    <input type="text" id="telefono" name="telefono" class="form-control" style="text-transform:uppercase" maxlength="50">
                    <div class="invalid-feedback">Debes Ingresar datos</div>
                    <div class="valid-feedback">¡Se esta Ingresando Datos!</div>
                </div>
                <div class="input-group mb-2">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><b>Dirección</b></span>
                    </div>
                    <textarea class="form-control" rows="3" name="direccion" id="direccion" style="text-transform:uppercase" maxlength="500"></textarea>
                    <div class="valid-feedback">¡Campo opcional!</div>
                </div>
                <div class="input-group mb-2">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><b>Referencia</b></span>
                    </div>
                    <textarea class="form-control" rows="3" name="referencia" id="referencia" style="text-transform:uppercase" maxlength="500"></textarea>
                    <div class="valid-feedback">¡Campo opcional!</div>
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

<script type="text/javascript">
$('#modalEditar').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) //captura valor del data-empresa=""

  var id = button.data('id')
  var nombre = button.data('nombre')
  var telefono = button.data('telefono')
  var direc = button.data('direc')
  var ref = button.data('ref')

  var modal = $(this)

  modal.find('.modal-body #id').val(id)
  modal.find('.modal-body #nombrecompleto').val(nombre)
  modal.find('.modal-body #telefono').val(telefono)
  modal.find('.modal-body #direccion').val(direc)
  modal.find('.modal-body #referencia').val(ref)

});
</script>


@endsection