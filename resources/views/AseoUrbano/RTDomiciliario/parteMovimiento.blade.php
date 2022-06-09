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
                        <li class="breadcrumb-item"><a href="{{route('despacho.index')}}">Despacho</a></li> 
                        <li class="breadcrumb-item"><a href="{{route('detalledespachos', $detalle->despacho_id)}}">Detalle Despacho</a></li> 
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
                    <div class="col-6" style="text-transform:uppercase">
                        <h4><b>PARTE DIARIO DE LA {{$detalle->ruta->descripcion}}</b></h4>
                    </div>
                    <div class="col-3">
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><b>Nro Parte</b></span>
                            </div>
                            <input type="text" name="parte" class="form-control" value="{{$parte->parte}}" disabled>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="dropdown dropleft float-right">
                            @if($cantmov == 0 && $cantPersona ==1)
                                <a  class="btn btn-danger" data-toggle="tooltip" href="{{route('au-cerrarparte', $parte->id)}}">
                                    <i class="fas fa-arrow-circle-right"></i> Cerrar
                                </a>
                            @endif
                            @if($cantmov >= 1 && $cantPersona >=1)
                                <a class="btn btn-success" data-toggle="tooltip" href="{{route('au-cerrarparte', $parte->id)}}">
                                    <i class="far fa-save"></i> Guardar
                                </a>
                            @endif
                        </div>                       
                    </div>                       
                </div>
            </div>
            <div class="card-body" id="div2">
                <div class="row">
                    
                    <div class="input-group mb-2 col-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><b>Dia y Fecha</b></span>
                        </div>
                        <input type="text" class="form-control" value="{{\Jenssegers\Date\Date::parse($detalle->fecha)->format('l j F Y')}}" disabled>
                    </div> 
                    <div class="input-group mb-2 col-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><b>Zona</b></span>
                        </div>
                        <input type="text" class="form-control" value="{{$detalle->ruta->zona->nombre}}" disabled>
                    </div>
                    <div class="input-group mb-2 col-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><b>Turno</b></span>
                        </div>
                        <input type="text" class="form-control" value="{{$parte->turno}}" disabled>
                    </div>
                </div>
                <div class="row">
                    <div class="input-group mb-2 col-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><b>Trabajo</b></span>
                        </div>
                        @if($parte->turno == true)
                            <input type="text" class="form-control" value="COTIDIANO" disabled>
                        @else
                            <input type="text" class="form-control" value="CONTROL" disabled>
                        @endif
                    </div>
                    <div class="input-group mb-2 col-6">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><b>Vehiculo</b></span>
                        </div>
                        <input type="text" class="form-control" value="{{$vehiculo[0]->interno}} - {{$vehiculo[0]->tipo->descripcion}} - {{$vehiculo[0]->modelo->marca->descripcion}} - {{$vehiculo[0]->placa}}" disabled>
                    </div>
                    <div class="input-group mb-2 col-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><b>Combustible</b></span>
                        </div>
                        @if($parte->combustible == true)
                            <input type="text" class="form-control" value="SI" disabled>
                        @else
                            <input type="text" class="form-control" value="NO" disabled>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="input-group mb-2 col-6">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><b>Chofer</b></span>
                        </div>
                        <input type="text" class="form-control" value="{{$funcionario->persona->nombrecompleto()}}" disabled>
                    </div>
                    <div class="input-group mb-2 col-6">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><b>Registrado Por:</b></span>
                        </div>
                        <input type="text" class="form-control" value="{{$registrado->persona->nombrecompleto()}}" disabled>
                    </div>
                </div>
                @if($cantCombustible >= 1)
                <p class="bg-warning text-center"><b>Datos del Combustible <i class="fas fa-gas-pump"></i></b></p>
                <div class="row">
                    <div class="input-group mb-2 col-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><b>Nro. Boleta</b></span>
                        </div>
                        <input type="text" class="form-control" value="{{$combustible[0]->boleta}}" disabled>
                    </div>
                    <div class="input-group mb-2 col-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><b>Nro. Factura</b></span>
                        </div>
                        <input type="text" class="form-control" value="{{$combustible[0]->factura}}" disabled>
                    </div> 
                    <div class="input-group mb-2 col-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><b>Nro. Orden</b></span>
                        </div>
                        <input type="text" class="form-control" value="{{$combustible[0]->orden}}" disabled>
                    </div> 
                </div>
                <div class="row">
                    <div class="input-group mb-2 col-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><b>Nro. Contrato</b></span>
                        </div>
                        <input type="text" class="form-control" value="{{$combustible[0]->contrato}}" disabled>
                    </div>
                    <div class="input-group mb-2 col-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><b>Tipo</b></span>
                        </div>
                        <input type="text" class="form-control" value="{{$vehiculo[0]->combustible}}" disabled>
                    </div>
                    <div class="input-group mb-2 col-2">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><b>Litros</b></span>
                        </div>
                        <input type="text" class="form-control" value="{{$combustible[0]->litro}}" disabled>
                    </div>
                    <div class="input-group mb-2 col-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><b>Bs.</b></span>
                        </div>
                        <input type="text" class="form-control" value="{{$combustible[0]->bs}}" disabled>
                    </div>
                </div>
                @endif

                <div class="input-group mb-2">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><b>Observaciones</b></span>
                    </div>
                    <textarea class="form-control" rows="3" style="text-transform:uppercase" disabled>{{$parte->obsparte}}</textarea>
                </div>    
                <div class="row">
                    <div class="container-fluid container-responsive col-6">
                        <div class="card table-responsive card-outline card-success">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-6">
                                        <b>Detalle Movimiento</b>
                                    </div>
                                    
                                    <div class="col-6">
                                        <div class="dropdown dropleft float-right">
                                            <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#modalRegistrarMov">
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
                                            <th class="text-center" colspan="3">SALIDA</th>
                                            <th class="text-center" colspan="3">LLEGADA</th>
                                        </tr>
                                        <tr>
                                            <th>FECHA</th>
                                            <th>HORA</th>
                                            <th>KM</th>
                                            <th>FECHA</th>
                                            <th>HORA</th>
                                            <th>KM</th>
                                        </tr>
                                    </thead>
                                    <?php
                                        $reskm=0;
                                        $reshora=0;
                                    ?>
                                    <tbody>
                                        @foreach($movimientos as $mov)
                                            <tr>
                                                <td><font size=2>{{$mov->fsalida}}</font></td>
                                                <td><font size=2>{{$mov->hsalida}}</font></td>
                                                <td><font size=2>{{$mov->kmsalida}}</font></td>
                                                <td><font size=2>{{$mov->fllegada}}</font></td>
                                                <td><font size=2>{{$mov->hllegada}}</font></td>
                                                <td><font size=2>{{$mov->kmllegada}}</font></td>
                                                <td class="text-center" style="width: 5%">
                                                    <a class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modalDeleteMovimiento" data-id="{{$mov->id}}" title="Eliminar Movimiento">
                                                    <i class="far fa-trash-alt"></i>
                                                    </a>
                                                </td>
                                                <?php
                                                    // $reshora = $reshora + ($mov->hllegada - $mov->hsalida);
                                                    $reskm = $reskm + ($mov->kmllegada - $mov->kmsalida);                  
                                                ?>
                                            </tr>
                                        @endforeach
                                        <tr>
                                            <!-- <td class="text-center" colspan="3">T-Horas: {{$reshora}}</td> -->
                                            <!-- <td></td> -->
                                            <td class="text-center" colspan="6">T-Kilometros: {{$reskm}}</td>
                                        </tr>
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
                                        <b>Detalle Viajes</b>
                                    </div>
                                    <div class="col-6">
                                        <div class="dropdown dropleft float-right">
                                            <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#modalDetalleViaje">
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
                                            <th>VIAJE</th>
                                            <th>PESO</th>
                                        </tr>
                                    </thead>
                                    <?php
                                        $i=1;
                                        $sum=0;
                                    ?>
                                    <tbody>
                                        @foreach($viajes as $viaje)
                                            <tr>
                                                <td><font size=2>{{$i}}</font></td>
                                                <td><font size=2>{{$viaje->pesobascula}}</font></td>
                                                <td class="text-center" style="width: 5%">
                                                    <a class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modalDeleteViaje" data-id="{{$viaje->id}}" data-peso="{{$viaje->pesobascula}}" title="Eliminar Viaje">
                                                    <i class="far fa-trash-alt"></i>
                                                    </a>
                                                </td>
                                                <?php
                                                    $sum+=$viaje->pesobascula;
                                                ?>
                                            </tr>
                                            <?php
                                                $i++;
                                            ?>
                                        @endforeach
                                        <td><font size=2>Peso Total</font></td>
                                        <td><font size=2><?php  echo($sum) ?></font></td>
                                    </tbody>
                                </table>
                            </div>
                        </div>
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
                                            <th> </th>
                                        </tr>
                                    </thead>
                                    <tbody >
                                        @foreach($personaactiva as $activo)
                                            <tr style="text-transform:uppercase">
                                                <td><font size=2>{{$activo->cargo}}</font></td>
                                                <td><font size=2>{{$activo->nombre}}</font></td>  
                                                <td class="text-center" style="width: 5%">
                                                    <a class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modalPersonalReemplazo" data-id="{{$activo->id}}" data-cargo="{{$activo->cargo}}" data-tipo="{{$activo->estado}}" data-nombre="{{$activo->nombre}}" title="Reemplazar Personal">
                                                        <i class="fas fa-recycle"></i>
                                                    </a>
                                                </td>  
                                                @if($activo->estado != 1)
                                                <td class="text-center" style="width: 5%">
                                                    <a class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modalDeletePersonal" data-id="{{$activo->id}}" data-cargo="{{$activo->cargo}}" data-nombre="{{$activo->nombre}}" title="Eliminar Personal">
                                                    <i class="far fa-trash-alt"></i>
                                                    </a>
                                                </td>
                                                @endif                                          
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

<!-- The Modal Registrar hora de llegada y salida y kilometros y fechas-->
<div class="modal hide fade in" data-keyboard="false" data-backdrop="static" id="modalRegistrarMov">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header bg-success">
          <h4 class="modal-title"><i class="fas fa-truck-moving"></i> Registrar Movimiento</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>       
        
        <!-- Modal body -->
        <div class="modal-body">
        {!! Form::open(['route' => 'au-partemovimiento.movimiento', 'class' => 'was-validated'])!!}
            <input type="hidden" name="despachoparte_id" value="{{$parte->id}}">
            <input type="hidden" name="fsalida" value="{{$detalle->fecha}}">
            <p><b>Datos de la Salida</b></p>
            <div class="row">
                <div class="input-group mb-2 col-4">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><b>Fecha</b></span>
                    </div>
                    <input type="text" value="{{\Jenssegers\Date\Date::parse($detalle->fecha)->format('d/m/Y')}}" class="form-control" style="text-transform:uppercase" disabled>
                </div>
                <div class="input-group mb-2 col-4">
                    <div class="input-group-prepend">
                    <span class="input-group-text"><b>Hora</b></span>
                    </div>
                    <input type="time" name="hsalida" class="form-control" style="text-transform:uppercase" required>

                </div>
                <div class="input-group mb-2 col-4">
                    <div class="input-group-prepend">
                    <span class="input-group-text"><b>Kms</b></span>
                    </div>
                    <input type="numeric" name="kmsalida" class="form-control" onkeypress='return validaNumericos(event)' style="text-transform:uppercase" required>

                </div>
            </div>
            <br>
            <p><b>Datos de la Llegada</b></p>
            <div class="row">
                <div class="input-group mb-2 col-4">
                    <div class="input-group-prepend">
                    <span class="input-group-text"><b>Fecha</b></span>
                    </div>
                    <input type="date" id="fechas" name="fllegada" class="form-control" style="text-transform:uppercase" required>
                </div>
                <div class="input-group mb-2 col-4">
                    <div class="input-group-prepend">
                    <span class="input-group-text"><b>Hora</b></span>
                    </div>
                    <input type="time" name="hllegada" class="form-control" style="text-transform:uppercase" required>
                </div>
                <div class="input-group mb-2 col-4">
                    <div class="input-group-prepend">
                    <span class="input-group-text"><b>Km</b></span>
                    </div>
                    <input type="numeric" name="kmllegada" class="form-control" onkeypress='return validaNumericos(event)' style="text-transform:uppercase" required>
                </div>
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
<div id="modalDeleteMovimiento" class="modal hide fade in" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog">
      <div class="modal-content">      
        <!-- Modal Header -->
        <div class="modal-header bg-danger">
          <h4 class="modal-title"><i class="fas fa-truck-moving"></i> Eliminar Movimiento</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>        
        <!-- Modal body -->
        <div class="modal-body">
        {!! Form::open(['route' => 'au-despachodetalle.parte.movimiento.delete', 'method' => 'DELETE']) !!}
            <input type="hidden" name="despachoparte_id" value="{{$parte->id}}">
            <input type="hidden" name="id" id="id"> 

            <div class="text-center" style="text-transform:uppercase">
                <i class="far fa-trash-alt" style="color: red; font-size: 5em;"></i>
                <br>
                
                <p><b>Eliminar Movimiento</b></p>
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




<!-- The Modal Registrar detalle de viaje-->
<div class="modal hide fade in" data-keyboard="false" data-backdrop="static" id="modalDetalleViaje">
    <div class="modal-dialog modal-dialog-scrollable">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header bg-success">
          <h4 class="modal-title"><i class="fas fa-balance-scale-left"></i> Detalle de Viaje</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
        
        <p><b>{{$vehiculo[0]->interno}} - {{$vehiculo[0]->tipo->descripcion}} - {{$vehiculo[0]->modelo->marca->descripcion}} - {{$vehiculo[0]->placa}} </b></p>
        
        {!! Form::open(['route' => 'au-partemovimiento.detalleviajes', 'class' => 'was-validated'])!!}
        <input type="hidden" name="despachoparte_id" value="{{$parte->id}}">
            <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><b>Peso Promedio</b></span>
                        </div>
                        <input type="text" class="form-control" value="{{$vehiculo[0]->bascula}}"  name='cargo1' id="cargo" disabled>
                        <input type="hidden" class="form-control" value="{{$vehiculo[0]->bascula}}"  name='pesobascula'>
                        <div class="input-group-append">
                            <button class="btn btn-success" type="submit" data-toggle="tooltip">Go</button>
                        </div>
            </div>
        {!! Form::close()!!} 
        {!! Form::open(['route' => 'au-partemovimiento.detalleviajes', 'class' => 'was-validated'])!!}
        <input type="hidden" name="despachoparte_id" value="{{$parte->id}}">
            <div class="input-group mb-2">
                <div class="input-group-prepend">
                    <span class="input-group-text"><b>Peso de Bascula</b></span>
                </div>
                <input type="number" class="form-control" name='pesobascula' id="is" minlength="1" maxlength="8" required>
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
<div id="modalDeleteViaje" class="modal hide fade in" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog">
      <div class="modal-content">      
        <!-- Modal Header -->
        <div class="modal-header bg-danger">
          <h4 class="modal-title"><i class="fas fa-balance-scale-left"></i> Eliminar Detalle De Viaje</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>        
        <!-- Modal body -->
        <div class="modal-body">
        {!! Form::open(['route' => 'au-despachodetalle.parte.viaje.delete', 'method' => 'DELETE']) !!}
            <input type="hidden" name="despachoparte_id" value="{{$parte->id}}">
            <input type="hidden" name="id" id="id"> 

            <div class="text-center" style="text-transform:uppercase">
                <i class="far fa-trash-alt" style="color: red; font-size: 5em;"></i>
                <br>
                
                <p><b>Eliminar Detalle: <p id="peso"></p></b></p>
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
        {!! Form::open(['route' => 'au-partemovimiento.personalactivo', 'class' => 'was-validated'])!!}
        <input type="hidden" name="despachoparte_id" value="{{$parte->id}}">
            <div class="input-group mb-2">
                <div class="input-group-prepend">
                <span class="input-group-text"><b>Cargo</b> </span>
                </div>
                <select class="form-control custom-select rounded-0" name="cargo" id="empresa" style="text-transform:uppercase" required>
                <option value="">Seleccione una opcion..</option>
                @foreach($empresas as $empresa)
                    @if($empresa->descripcion ==="RECOLECTORES")
                    <option value="{{$empresa->id}}">{{$empresa->descripcion}}</option>
                    @endif
                @endforeach 
                </select>
                <div class="invalid-feedback">Debes Ingresar datos</div>
                <div class="valid-feedback">¡Se esta Ingresando Datos!</div>
            </div>

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
        {!! Form::open(['route' => 'au-despachodetalle.parte.personal.delete', 'method' => 'DELETE']) !!}
        <input type="hidden" name="despachoparte_id" value="{{$parte->id}}">
            <input type="hidden" name="id" id="id"> 
            <div class="text-center" style="text-transform:uppercase">
                <i class="far fa-trash-alt" style="color: red; font-size: 5em;"></i>
                <br>
                
                <p><b>Esta Seguro De Eliminar El Recolector?</b></p>
            </div>
            <div class="input-group mb-2">
                <div class="input-group-prepend">
                    <span class="input-group-text"><b>Recolector</b></span>
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




<!-- The Modal Registrar Reemplazo-->
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
        {!! Form::open(['route' => 'au-partemovimiento.personalreemplazo', 'class' => 'was-validated'])!!}
            <input type="hidden" name="despachoparte_id" value="{{$parte->id}}">
            <input type="hidden" class="form-control" name='id' id="id">
            <input type="hidden" class="form-control" name='tipo' id="tipo">
            <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><b>Cargo</b></span>
                        </div>
                        <input type="text" class="form-control" id="cargo" disabled>
                        <input type="hidden" class="form-control" name='cargo1' id="cargo">
            </div>
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
                    <span class="input-group-text"><b>Personal</b> </span>
                </div>
                <select class="form-control custom-select rounded-0" name="nombre2" id="personas" style="text-transform:uppercase" required>
                
                
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
        {!! Form::open(['route' => 'au-despachodetalle.parte.reemplazo.delete', 'method' => 'DELETE']) !!}
            <input type="hidden" name="id" id="id"> 
            <input type="hidden" name="despachoparte_id" value="{{$parte->id}}">
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
    {    
        $('#empresa').on('change', onselect_persona);
        
        despacho = "<?php echo $detalle->despacho_id; ?>";

        $('#empresas').on('change', onselect_personas);;

    });
    
    // var despacho=2;
    $('#modalPersonalReemplazo').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) //captura valor del data-empresa=""

        var cargo = button.data('cargo')
        var tipo = button.data('tipo')
        var id = button.data('id')
        var nombre = button.data('nombre')
        // alert(nombre);

        var modal = $(this)

        modal.find('.modal-body #cargo').val(cargo)
        modal.find('.modal-body #tipo').val(tipo)
        modal.find('.modal-body #id').val(id)
        modal.find('.modal-body #nombre').val(nombre)
        // alert(cargo)
        var selects;
        if(tipo == 1)
        {
            selects = 1;
        }
        else
        {
            selects = 6;
        }
        $.get('{{route('selectpersonas')}}/'+selects+'/'+despacho, function(data){ 
            var html_personas=    '<option value="">Seleccione una persona..</option>'
                for(var i=0; i<data.length; ++i)
                html_personas += '<option value="'+data[i].id+'">'+data[i].nombre +'</option>'

                $('#personas').html(html_personas);       
        });



    });

    function onselect_persona()
    {
        var persona =  $(this).val();        
        
        if(persona >=1)
        {
          $.get('{{route('selectpersonas')}}/'+persona+'/'+despacho, function(data){ 
        
            var html_persona
                for(var i=0; i<data.length; ++i)
                html_persona += '<option value="'+data[i].id+'">'+data[i].nombre +'</option>'

            $('#persona').html(html_persona);          
          });
        }
        else
        {
          var html_persona=    ''       
          $('#persona').html(html_persona);
        }
    };


    $('#modalDeleteMovimiento').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) //captura valor del data-empresa=""

        var id = button.data('id')

        var modal = $(this)

        
        modal.find('.modal-body #id').val(id)
        
    });
    $('#modalDeleteViaje').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) //captura valor del data-empresa=""

        var id = button.data('id')
        var peso = button.data('peso')

        var modal = $(this)

        modal.find('.modal-body #peso').text(peso)
        modal.find('.modal-body #id').val(id)
        
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