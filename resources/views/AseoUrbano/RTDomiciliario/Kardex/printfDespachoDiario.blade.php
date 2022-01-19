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
                        <img height="65" src="{{ asset('dist/img/Emaut.ico')}}" width="100 px;"></img>
                    </td>
                    <td style="border-color: black; width: 55%; text-align: center;" >
                        <h4><b class="titulo" style="text-transform:uppercase"> DESPACHO DIARIO</b></h4>
                        <h4><b class="titulo" style="text-transform:uppercase"> {{\Jenssegers\Date\Date::parse($despacho->fecha)->format('l j F Y')}}</b></h4>
                    </td>
                    <td class="text-left" valign="top" style="border-color: black; width: 20%">
                        <font size="2">FECHA IMPRESO: {{$fechaprint}}</font><br>
                        <font size="2">HORA IMPRESO: {{$hraprint}}</font><br>
                        <font size="1">USUARIO: {{ Auth::user()->funcionario->persona->nombrecompleto() }}</font>
                    </td>
                </tr>
            </table>
        </div>
        @foreach($detalles as $detalle)
            <div class="text-center" style="padding: 5px;">    
                <div class="container text-center" style="padding: 5px;">
                    <div class="bg-warning">
                        <h5>{{$detalle->ruta}}&nbsp;&nbsp;&nbsp; - &nbsp;&nbsp;&nbsp;{{$detalle->interno}} - {{$detalle->tipo}} - {{$detalle->marca}} - {{$detalle->placa}}</h5>
                    </div>
                    <div class="row">
                    @if($detalle->parte != NULL)
                        <div class="input-group mb-2 col-4">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><b>Trabajo</b></span>
                            </div>
                            @if($detalle->cotidiano == 1)
                                <input type="text" class="form-control" value="COTIDIANO" disabled>
                            @else
                                <input type="text" class="form-control" value="CONTROL" disabled>
                            @endif
                        </div>
                        <div class="input-group mb-2 col-5">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><b>Turno</b></span>
                            </div>
                            <input type="text" class="form-control" value="{{$detalle->turno}}" disabled>
                        </div>
                        <div class="input-group mb-2 col-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><b>Nro. Parte</b></span>
                            </div>                        
                            @if($detalle->parte != NULL)
                                <input type="text" class="form-control" value="{{$detalle->nparte}}" disabled>
                            @else
                                <input type="text" class="form-control" value="nada" disabled>
                            @endif
                        
                        </div>
                    @endif                    
                    </div>
                    @if($detalle->parte != NULL)
                    <div class="row">
                        <div class="container-fluid container-responsive col-6">
                            <div class="card table-responsive card-outline card-success">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-6">
                                            <b>Perosnal</b>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body container-fluid">
                                    <table class="table table-sm table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>CARGO</th>
                                                <th>PERSONAL</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($personals as $activo)
                                            @if($detalle->parte == $activo->parte)
                                                <tr style="text-transform:uppercase">
                                                    <td><font size=2>{{$activo->cargo}}</font></td>
                                                    <td><font size=2>{{$activo->nombre}}</font></td>                                                                                          
                                                </tr>
                                            @endif
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
                                                @if($detalle->parte == $viaje->parte)
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
                                                @endif                                            
                                            @endforeach
                                            <td><font size=2>Peso Total</font></td>
                                            <td><font size=2><?php  echo($sum) ?></font></td>                                       
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><b>Obserbaciones</b></span>
                        </div>
                        <input type="text" class="form-control" value="{{$detalle->obsparte}}"  style="text-transform:uppercase" disabled>
                    </div>  
                    @endif 
                    @if($detalle->parte == NULL)
                        <span class="badge badge-danger"><h6> Sin Registro </h6></span>
                    @endif
                </div> 
            </div> 
        @endforeach
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