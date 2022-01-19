@extends('Layout.HomeAseoUrbano')
@section('content')

    <!-- ENCABEZADO DE LA PAGINA -->
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div>
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"><i class="fas fa-phone-volume"></i> Reclamos</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('aseourbano')}}">Aseo Urbano</a></li>
                        <li class="breadcrumb-item"><a href="{{route('reclamo.index')}}">Reclamos</a></li>
                        <li class="breadcrumb-item active">Atender Reclamo</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <div style="padding-bottom: 5px;">
        <a class="btn btn-warning" data-toggle="tooltip" href="{{ route('reclamo.index') }}" title="Volver al Listado"><i class="fas fa-arrow-alt-circle-left" style="width:20px; height:20px;"></i> Volver</a>

    </div>

    <div class="card card-outline card-info">
        <div class="card-header text-center">
            <h4 class="card-title">MOTIVO DE RECLAMO: </h4>
        </div>
        <div class="card-body" >
            <div class="row">

                <div class="col-md-4 row">
                    <dt class="col-sm-3">Nro: </dt>
                    <div class="col-md-4">
                        {{$reclamo->numero}}
                    </div>
                </div>

                <div class="col-md-4 row">
                    <dt class="col-sm-3">Fecha: </dt>
                    <div class="col-md-8">
                        {{$reclamo->fechareclamo}}
                    </div>
                </div>
                <div class="col-md-4 row">
                    <dt class="col-sm-3">Contacto:</dt>
                    <div class="col-md-9" style="text-transform:uppercase">
                        {{$contacto->nombrecompleto}}
                    </div>
                </div>
            </div>

            <div class="row">

                <div class="col-md-4 row">
                    <dt class="col-sm-3">Barrio:</dt>
                    <div class="col-md-4" style="text-transform:uppercase">
                        {{$barrio->descripcion}}
                    </div>
                </div>

                <div class="col-md-8 row">
                    <dt class="col-sm-3">Descripcion:</dt>
                    <div class="col-md-9" style="text-transform:uppercase">
                        {{$reclamo->descripcion}}
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="row">
        <div class="container col-md-6" >
            <div class="card card-outline card-info">
                <div class="card-header text-center">
                    <h4 class="card-title">ATENDER RECLAMO</h4>
                </div>
                <div class="card-body">
                {!! Form::open(['route' => 'au-gestionreclamo.reclamo.atenderreclamo.store', 'class' => 'was-validated'])!!}
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><b>Fecha Solución</b></span>
                        </div>
                        <input type="datetime-local" class="form-control"  name="fechaatendido" id="fechaatendido" value="{{old('fechaatendido')}}" required>
                        <div class="invalid-feedback">Debes Ingresar datos</div>
                        <div class="valid-feedback">¡Se esta Ingresando Datos!</div>
                    </div>

                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><b>Solucion</b></span>
                        </div>
                        <textarea class="form-control" rows="3" name="solucion" id="solucion" style="text-transform:uppercase" maxlength="500" required>{{old('solucion')}}</textarea>
                        <div class="invalid-feedback">Debes Ingresar datos</div>
                        <div class="valid-feedback">¡Se esta Ingresando Datos!</div>
                    </div>
                    <input type="hidden" name="reclamo_id" id="" value="{{$reclamo->id}}">
                    <div>
                        <a href="{{route ('reclamo.index') }}" class="btn btn-warning" data-toggle ="tooltip" data-placement="bottom" title="Volver al Listado"><i class="fas fa-arrow-alt-circle-left" style="width:20px; height:20px;">
                            </i> Cancelar</a>

                        <button type="submit" class="btn btn-primary"><i class="far fa-check-circle" style="width:20px; height:20px;"></i> Guardar</button>
                    </div>
                {!! Form::close()!!}
                </div>
            </div>
        </div>

        <div class="container col-md-6" >
            <div class="card card-outline card-info">
                <div class="card-header text-right">
                    <h4 class="card-title">REALIZADO POR :</h4>
                    <a class="btn btn-outline-success btn-sm" data-toggle="modal" data-target="#detallesolucion" data-reclamo = "{{$reclamo->id}}"  href=""><i class="fas fa-snowplow"></i> <i class="fas fa-shipping-fast"></i> <i class="fas fa-user-plus fa-fw"></i></a>
                        
                </div>

                <div class="card-body">

                    <table class="tabla table-bordered" style="width: 100%; border: solid 2px;">

                        <thead>
                        <tr>
                            <th class="text-center" style="background: yellow;">
                                UNIDAD
                            </th>
                            <th class="text-center" style="background: yellow;">
                                CHOFER/OPERADOR
                            </th>
                            <th style="background: yellow;"></th>
                        </tr>
                        </thead>

                        <tbody>
                            @foreach($detalles as $equipo)
                                <tr style="text-transform:uppercase">
                                    <td class="text-center"> <font size=2>{{ $equipo->vehiculo }} </td>
                                    <td class="text-center"> <font size=2>{{ $equipo->funcionario}} </td>
                                    <td class="text-center" width="5px">
                                        <a class="btn btn-outline-danger btn-sm" data-toggle="modal" data-target="#modalDelete" data-id="{{$equipo->id}}" data-funcionario="{{$equipo->funcionario}}" data-vehiculo="{{$equipo->vehiculo}}" title="Eliminar Unidad">
                                            <i class="far fa-trash-alt"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>

 


    <div class="modal fade" id="detallesolucion">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-success">
                    <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-snowplow"></i> <i class="fas fa-user-plus fa-fw"></i> Registrar  </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                {!! Form::open(['route' => 'reclamounidadatender.store', 'method' => 'POST', 'id' => 'formdetalle', 'class' => 'was-validated']) !!}
                <div class="modal-body">
                    <input type="hidden" id="fechaatendido" name="fechaatendido">
                    <input type="hidden" id="solucion" name="solucion">

                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                        <span class="input-group-text"><b>Vehiculo</b></span>
                        </div>
                        <select class="form-control select2bs4" name="vehiculo" id="vehiculo" style="text-transform:uppercase" required>
                        <option value="">Seleccione un Vehiculo..</option>
                            @foreach($vehiculos as $vehiculo)
                                <option value="{{$vehiculo->interno}} - {{$vehiculo->tipo->descripcion}} - {{$vehiculo->modelo->marca->descripcion}} - {{$vehiculo->placa}}">
                                    {{$vehiculo->interno}} - {{$vehiculo->tipo->descripcion}} - 
                                                                  {{$vehiculo->modelo->marca->descripcion}} - {{$vehiculo->placa}}</option>
                            @endforeach    
                        </select>
                        <div class="invalid-feedback">Debes Ingresar datos</div>
                        <div class="valid-feedback">¡Se esta Ingresando Datos!</div>
                    </div>

                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><b>Funcionario</b></span>
                        </div>
                        <select class="form-control select2bs4" name="funcionario" id="funcionario" style="text-transform:uppercase" required>
                            <option value="">Seleccione un funcionario..</option>
                                @foreach ($funcionarios as $fun)
                                    <option value="{{$fun->nombre}} {{$fun->apellidopaterno}} {{$fun->apellidomaterno}}">{{$fun->nombre}} {{$fun->apellidopaterno}} {{$fun->apellidomaterno}}</option>
                                @endforeach                         
                        </select>
                        <div class="invalid-feedback">Debes Ingresar datos</div>
                        <div class="valid-feedback">¡Se esta Ingresando Datos!</div>
                    </div> 

                    <div>
                        <input type="hidden" class="form-control" id="reclamo_id" name="reclamo_id" value="{{$reclamo->id}}">
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
                {!! Form::close()!!}
            </div>
        </div>
    </div>

    <div id="modalDelete" class="modal hide fade in" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog">
          <div class="modal-content">      
            <!-- Modal Header -->
            <div class="modal-header bg-danger">
              <h4 class="modal-title"><i class="fas fa-snowplow"></i> <i class="fas fa-shipping-fast"></i> <i class="fas fa-user-plus fa-fw"></i> Eliminar </h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>        
            <!-- Modal body -->
            <div class="modal-body">
            {!! Form::open(['route' => 'au-gestionreclamo.reclamo.atenderreclamo.detalleunidad.delete', 'id' => 'formeliminar','method' => 'DELETE']) !!}
       
                <input type="hidden" name="id" id="id"> 
                <input type="hidden" id="fechaatendido" name="fechaatendido">
                <input type="hidden" id="solucion" name="solucion">
           
                <input type="hidden" class="form-control" id="reclamo_id" name="reclamo_id" value="{{$reclamo->id}}">
  
                <div class="text-center" style="text-transform:uppercase">
                    <i class="far fa-trash-alt" style="color: red; font-size: 5em;"></i>
                    <br>
                    
                    <p><b>Esta Seguro De Eliminar..?</b></p>
                </div>
                <div class="input-group mb-2">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><b>Vehiculo</b></span>
                    </div>
                    <input type="text" class="form-control" id="vehiculo" disabled>
                </div>
                <div class="input-group mb-2">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><b>funcionario</b></span>
                    </div>
                    <input type="text" class="form-control" id="funcionario" disabled>
                </div>
            
            </div>
            
            <!-- Modal footer -->
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal" data-toggle="tooltip" title="Volver al Listado">Cancelar
              </button>
              <button type="submit" class="btn btn-danger btn-sm" title="Continuar">Borrar
              </button>
            </div>
            {!! Form::close()!!} 
            
          </div>
        </div>
    </div>
    

    <script>

        $('#detallesolucion').on('show.bs.modal', function (event) {
                $('#formdetalle').trigger('reset');
                var button     = $(event.relatedTarget)
                var fechaatendido     = $('#fechaatendido').val();
                
                var solucion     = $('#solucion').val();
                // alert(solucion)
               
                var modal = $(this)
                modal.find('.modal-body #fechaatendido').val(fechaatendido)
                modal.find('.modal-body #solucion').val(solucion)

                // onselect_barrio();
            });
        $('#modalDelete').on('show.bs.modal', function (event) {
            $('#formeliminar').trigger('reset');
        var button = $(event.relatedTarget) //captura valor del data-empresa=""
        var fechaatendido     = $('#fechaatendido').val();
        var solucion     = $('#solucion').val();

        var id = button.data('id')
        var funcionario = button.data('funcionario')
        var vehiculo = button.data('vehiculo')

        reclamo = "<?php echo $reclamo->id; ?>";
        var modal = $(this)

        modal.find('.modal-body #funcionario').val(funcionario)
        modal.find('.modal-body #vehiculo').val(vehiculo)
        modal.find('.modal-body #id').val(id)

        modal.find('.modal-body #fechaatendido').val(fechaatendido)
        modal.find('.modal-body #solucion').val(solucion)
        
    });
    </script>



@endsection
