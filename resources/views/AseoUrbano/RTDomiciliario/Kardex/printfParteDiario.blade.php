@extends('Layout.HomeAseoUrbano')
@section('content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div>
        <div class="row mb-2">
          <div class="col-sm-6">
            
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{route('aseourbano')}}">Home</a></li> 
                <li class="breadcrumb-item"><a href="{{route('despacho.index')}}">Despacho</a></li> 
                        <li class="breadcrumb-item"><a href="{{route('detalledespachos', $detalle->despacho_id)}}">Detalle Despacho</a></li>          
                <li class="breadcrumb-item active">Imprimir</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- dd(auth()->user()->roles) -->

    <div style="padding-bottom: 5px;">
        <a class="btn btn-warning" data-toggle="tooltip" href="{{ URL::previous() }}" 
            title="Volver al Listado" data-placement="right"><i class="fas fa-arrow-alt-circle-left" ></i>
            Volver
        </a>       
        @can('au-barrios.historialprintf')
            <button onclick="printcontent('print')" class="btn btn-success"><i class="fas fa-print"></i> Imprimir</button>
        @endcan
    </div>

    <div id="print">
        <div style="padding-bottom: 2px;">
            <table style="width: 100%;">
                <tr style="height: 60px;">
                    <td style="width: 12%;" valign="bottom">
                        <img height="65" src="{{ asset('dist/img/Emautt.ico')}}" width="100 px;"></img>
                    </td>
                    <td style="border-color: black; width: 55%; text-align: center;" >
                        <h4><b class="titulo" style="text-transform:uppercase"> PARTE DIARIO</b></h4>
                        <h4><b class="titulo" style="text-transform:uppercase">{{\Jenssegers\Date\Date::parse($detalle->fecha)->format('l j F Y')}} - {{$detalle->ruta->descripcion}}</b></h4>
                    </td>
                    <td class="text-left" valign="top" style="border-color: black; width: 20%">
                        <font size="2">FECHA IMPRESO: {{$fechaprint}}</font><br>
                        <font size="2">HORA IMPRESO: {{$hraprint}}</font><br>
                        <font size="1">USUARIO: {{ Auth::user()->funcionario->persona->nombrecompleto() }}</font>
                    </td>
                </tr>
            </table>
        </div>

        <div class="container-fluid container-responsive" id="app">  
            <div class="card table-responsive card-outline card-success">
               
                <div class="card-body">
                    <div class="row">
                        
                        <div class="input-group mb-2 col-4">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><b>Nro. Parte</b></span>
                            </div>
                            <input type="text" class="form-control" value="{{$parte->parte}}" disabled>
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
                            <input type="text" class="form-control" value="{{$chofer->persona->nombrecompleto()}}" disabled>
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
                                        <div >
                                            <b>Detalle Movimiento</b>
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
                                            @foreach($personaactiva as $activo)
                                                <tr style="text-transform:uppercase">
                                                    <td><font size=2>{{$activo->cargo}}</font></td>
                                                    <td><font size=2>{{$activo->nombre}}</font></td>      
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
                                            </tr>
                                        </thead>
                                        <tbody >
                                            @foreach($personareemplazada as $reem)
                                                <tr style="text-transform:uppercase">
                                                    <td><font size=2>{{$reem->reemplazando}}</font></td>
                                                    <td><font size=2>{{$reem->reemplazado}}</font></td>                                                                                                  
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div> 
                    <div class="row">
                        <div class="text-center col-4">
                            <br>
                            <br>
                            <br>
                            <br>
                            ________________________________________
                            <br>
                            Chofer
                            <br>
                            @foreach($personaactiva as $activo)
                                @if($activo->cargo == "CHOFER")
                                    <p>{{$parte->chofer}}</p>
                                @endif
                            @endforeach  
                            
                            <br>
                        </div>
                        <div class="text-center col-4">
                            <br>
                            <br>
                            <br>
                            <br>
                            ________________________________________
                            <br>
                            Supervisor
                            <br>
                        </div>
                        <div class="text-center col-4">
                            <br>
                            <br>
                            <br>
                            <br>
                            ________________________________________
                            <br>
                            Fiscal
                            <br>
                        </div>
                    </div>
                </div>  
            </div>
        </div>





    </div>

    <script type="text/javascript">
        function printcontent(el) {
            var restorepage = document.body.innerHTML;
            var printcontent = document.getElementById(el).innerHTML;
            document.body.innerHTML = printcontent;
            window.print();
            document.body.innerHTML = restorepage;
        }
    </script>

    @endsection