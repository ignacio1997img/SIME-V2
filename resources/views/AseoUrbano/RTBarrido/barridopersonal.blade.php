@extends('Layout.HomeAseoUrbano')
@section('content')

<script src="{{asset('01.js')}}"></script>

<style>
    #div2 {
        overflow-y:scroll;
        height:400px;
    }
</style>
    <div class="content-header">
        <div>
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"><i class="fas fa-receipt"></i> Parte Diario</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('aseourbano')}}">Home</a></li>       
                        <li class="breadcrumb-item"><a href="{{route('barridodespacho.index')}}">Despacho Barrido</a></li> 
                        <li class="breadcrumb-item"><a href="{{route('au-rtbarrido.despacho.viewdespachodetalle', $despacho->id)}}">Detalle Despacho Barrido</a></li> 
                        <li class="breadcrumb-item active">Parte Diario</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <div class="container-fluid container-responsive" id="app">
  
        <div class="card table-responsive card-outline card-success">
            <div class="card-header">
                <div class="row">
                    <div class="col-9" style="text-transform:uppercase">
                        <h4><b>PARTE DIARIO DE LA {{$ruta->nombre}}</b></h4>
                    </div>
                    
                    <div class="col-3">
                        <div class="dropdown dropleft float-right col-6">
                            <a class="btn btn-success" data-toggle="tooltip" href="{{route('au-rtbarrido.despacho.despachodetalle.close', $detalle->id)}}">
                                <i class="far fa-save"></i> Cerrar
                            </a>
                        </div>
                    </div>                       
                </div>
            </div>
            <div class="card-body" id="div2">
                <div class="row">                    
                    <div class="input-group mb-2 col-6">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><b>Dia y Fecha</b></span>
                        </div>
                        <input type="text" class="form-control" value="{{\Jenssegers\Date\Date::parse($detalle->fecha)->format('l j F Y')}}" disabled>
                    </div> 
                    <div class="input-group mb-2 col-6">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><b>Turno</b></span>
                        </div>
                        <input type="text" class="form-control" value="{{$detalle->turno}}" disabled>
                    </div>
                </div>
                <div class="input-group mb-2">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><b>Descripcion</b></span>
                    </div>
                    <textarea class="form-control" rows="3" style="text-transform:uppercase" disabled>{{$ruta->descripcion}}</textarea>
                </div> 
                <div class="row">
                    <div class="input-group mb-2 col-6">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><b>Inicio</b></span>
                        </div>
                        <input type="text" class="form-control" value="{{$ruta->inicio}}" disabled>
                    </div>
                    <div class="input-group mb-2 col-6">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><b>Fin</b></span>
                        </div>
                        <input type="text" class="form-control" value="{{$ruta->fin}}" disabled>
                    </div>
                </div>      
                <div class="row">
                    <div class="container-fluid container-responsive col-6">
                        <div class="card table-responsive card-outline card-success">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-6">
                                        <b>Personal Activo</b>
                                    </div>
                                    <div class="col-6">
                                        <div class="dropdown dropleft float-right">
                                            <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#modalPersonalActivo">
                                                <i class="fas fa-plus"></i>Nuevo
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body container-fluid">
                                <table class="table table-sm table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>CARGO</th>
                                            <th>NOMBRE</th>
                                        </tr>
                                    </thead>
                                    <tbody >
                                        @foreach($personal as $activo)
                                            <tr style="text-transform:uppercase">
                                                <td><font size=2>{{$activo->cargo}}</font></td>
                                                <td><font size=2>{{$activo->nombre}}</font></td>  
                                                <td class="text-center" style="width: 5%">
                                                    <a class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modalPersonalReemplazo" data-id="{{$activo->id}}" data-nombre="{{$activo->nombre}}" data-cargo="{{$activo->cargo}}" title="Reemplazar Personal">
                                                    <i class="fas fa-recycle"></i>
                                                    </a>
                                                </td>  
                                                <td class="text-center" style="width: 5%">
                                                    <a class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modalDeletePersonal" data-id="{{$activo->id}}" data-nombre="{{$activo->nombre}}" title="Eliminar Personal">
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
                    <div class="container-fluid container-responsive col-6">
                        <div class="card table-responsive card-outline card-success">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-6">
                                        <b>Personal Reemplazado</b>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body container-fluid">
                                <table class="table table-sm table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>ACTIVO</th>
                                            <th>REEMPLAZADO</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody >
                                        @foreach($personareemplazada as $reem)
                                            <tr style="text-transform:uppercase">
                                                <td><font size=2>{{$reem->reemplazando}}</font></td>
                                                <td><font size=2>{{$reem->reemplazado}}</font></td>  
                                                <td class="text-center" style="width: 5%">
                                                    <a class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modalDeleteReemplazo" data-id="{{$reem->id}}" data-reemplazando="{{$reem->reemplazando}}" data-reemplazado="{{$reem->reemplazado}}" title="Eliminar Reemplazo">
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
            </div>  
        </div>
    </div>

<!-- The Modal Registrar Personal Activo-->
<div class="modal hide fade in" data-keyboard="false" data-backdrop="static" id="modalPersonalActivo">
    <div class="modal-dialog modal-dialog-scrollable">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header bg-success">
          <h4 class="modal-title">Registrar Funcionario</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        
        <!-- Modal body -->
        <div class="modal-body">
        {!! Form::open(['route' => 'barridopersonal.store', 'class' => 'was-validated'])!!}
            <input type="hidden" name="despachodetalle_id" id="" value="{{$detalle->id}}">
         

            <div class="input-group mb-2">
                <div class="input-group-prepend">
                    <span class="input-group-text"><b>Personal</b></span>
                </div>
                <select class="form-control select2bs4" multiple="multiple" name="personas[]" id="persona" style="text-transform:uppercase" required>
                        
                </select>
                <div class="invalid-feedback">Debes Ingresar datos</div>
                <div class="valid-feedback">¡Se esta Ingresando Datos!</div>
            </div>

    
        </div>
        <!-- Modal footer -->
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal" data-toggle="tooltip"
            title="Volver al Listado">Cancelar
          </button>
          <button type="submit" class="btn btn-success btn-sm" data-toggle="tooltip" title="Continuar">
            Guardar
          </button>
        </div>
        {!! Form::close()!!} 
        
      </div>
    </div>
</div>
<div id="modalDeletePersonal" class="modal hide fade in" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog">
      <div class="modal-content">      
        <!-- Modal Header -->
        <div class="modal-header bg-danger">
          <h4 class="modal-title"><i class="fas fa-balance-scale-left"></i> Eliminar </h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>        
        <!-- Modal body -->
        <div class="modal-body">
        {!! Form::open(['route' => 'au-rtbarrido.despacho.despachodetalle.personal.delete', 'method' => 'DELETE']) !!}
            <input type="hidden" name="despachodetalle_id" id="" value="{{$detalle->id}}">
            <input type="hidden" name="id" id="id"> 
            <div class="text-center" style="text-transform:uppercase">
                <i class="far fa-trash-alt" style="color: red; font-size: 5em;"></i>
                <br>
                
                <p><b>Esta Seguro De Eliminar El Personal?</b></p>
            </div>
            <div class="input-group mb-2">
                <div class="input-group-prepend">
                    <span class="input-group-text"><b>Personal</b></span>
                </div>
                <input type="text" class="form-control" id="recolector" disabled>
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


<!-- //reemplazo -->
<div class="modal hide fade in" data-keyboard="false" data-backdrop="static" id="modalPersonalReemplazo">
    <div class="modal-dialog modal-dialog-scrollable">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header bg-success">
          <h4 class="modal-title"><i class="fas fa-people-arrows"></i> Reemplazar Personal</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
        {!! Form::open(['route' => 'barridopersonalreemplazo.store', 'class' => 'was-validated'])!!}
            <input type="hidden" name="despachodetalle_id" id="" value="{{$detalle->id}}">
            <input type="hidden" class="form-control" name='id' id="id">
            <input type="hidden" name="cargo1" id="cargo">
            <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><b>Personal</b></span>
                        </div>
                        <input type="text" class="form-control" id='nombre' disabled>
                        <input type="hidden" class="form-control" name='nombre1' id='nombre'>
            </div>
            <p class="bg-warning text-center"><b> Reemplazar Por </b></p>


            <div class="input-group mb-2">
                <div class="input-group-prepend">
                    <span class="input-group-text"><b>Personal</b></span>
                </div>
                <select class="form-control custom-select rounded-0" name="nombre2" id="personas" required>  
                </select>
                <div class="invalid-feedback">Debes Ingresar datos</div>
                <div class="valid-feedback">¡Se esta Ingresando Datos!</div>
            </div>
            
        </div>
        <!-- Modal footer -->
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal" data-toggle="tooltip"
            title="Volver al Listado">Cancelar
          </button>
          <button type="submit" class="btn btn-success btn-sm" data-toggle="tooltip" title="Continuar">
            Guardar
          </button>
        </div>
        {!! Form::close()!!} 
        
      </div>
    </div>
</div>

<div id="modalDeleteReemplazo" class="modal hide fade in" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog">
      <div class="modal-content">      
        <!-- Modal Header -->
        <div class="modal-header bg-danger">
          <h4 class="modal-title"><i class="fas fa-people-arrows"></i> Eliminar Reemplazo </h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>        
        <!-- Modal body -->
        <div class="modal-body">
        {!! Form::open(['route' => 'au-rtbarrido.despacho.despachodetalle.reemplazopersonal.delete', 'method' => 'DELETE']) !!}
            <input type="hidden" name="id" id="id"> 
            <input type="hidden" name="despachodetalle_id" id="" value="{{$detalle->id}}">
            <div class="text-center" style="text-transform:uppercase">
                <i class="far fa-trash-alt" style="color: red; font-size: 5em;"></i>
                <br>
                
                <p><b>Esta Seguro De Eliminar El Reemplazo?</b></p>
            </div>
            <div class="input-group mb-2">
                <div class="input-group-prepend">
                    <span class="input-group-text"><b>Reemplazando</b></span>
                </div>
                <input type="text" class="form-control" id="reemplazando" disabled>
            </div>
            <div class="input-group mb-2">
                <div class="input-group-prepend">
                    <span class="input-group-text"><b>A:</b></span>
                </div>
                <input type="text" class="form-control" id="reemplazado" disabled>
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

<script type="text/javascript">

    var despacho = 0;
    $(function()
    {    despacho = "<?php echo $detalle->despacho_id; ?>";
        onselect_persona();
    });
    
    
    function onselect_persona()
    {
        // alert(5)
          $.get('{{route('selectpersonasbarrido')}}/'+despacho, function(data){ 
            // alert(data)
            var html_personas=    '<option value="">Seleccione una opcion..</option>'
            var html_persona
                for(var i=0; i<data.length; ++i)
                {
                    html_persona += '<option value="'+data[i].id+'">'+data[i].nombre +'</option>'
                    html_personas += '<option value="'+data[i].id+'">'+data[i].nombre +'</option>'
                }
                

            $('#persona').html(html_persona);  
            $('#personas').html(html_personas);         
          });
    };

    $('#modalPersonalReemplazo').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) //captura valor del data-empresa=""

        var id = button.data('id')
        var cargo = button.data('cargo')
        var nombre = button.data('nombre')
        // alert(nombre);

        var modal = $(this)

        modal.find('.modal-body #id').val(id)
        modal.find('.modal-body #cargo').val(cargo)
        modal.find('.modal-body #nombre').val(nombre)
    });





    $('#modalDeletePersonal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) //captura valor del data-empresa=""

        var id = button.data('id')
        var recolector = button.data('nombre')

        var modal = $(this)

        modal.find('.modal-body #recolector').val(recolector)
        modal.find('.modal-body #id').val(id)
        
    });

    $('#modalDeleteReemplazo').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) //captura valor del data-empresa=""

        var id = button.data('id')
        var reemplazado = button.data('reemplazado')
        var reemplazando = button.data('reemplazando')

        var modal = $(this)

        modal.find('.modal-body #reemplazado').val(reemplazado)
        modal.find('.modal-body #reemplazando').val(reemplazando)
        modal.find('.modal-body #id').val(id)
        
    });

 

</script>
@endsection