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
                <li class="breadcrumb-item"><a href="{{route('despacho.index')}}"> Barrido Despacho</a></li>          
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
                    @foreach($rutas as $r)
                        @if($r->id == $detalle->ruta_id)
                            <div class="bg-warning" style="text-transform:uppercase">
                                <h5>DETALLE DE LA {{$r->nombre}}</h5>
                            </div>
                        @endif
                    @endforeach

                    <div class="row">                    
                        <div class="input-group mb-2 col-6">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><b>Dia y Fecha</b></span>
                            </div>
                            <input style="text-transform:uppercase" type="text" class="form-control" value="{{\Jenssegers\Date\Date::parse($despacho->fecha)->format('l j F Y')}}" disabled>
                        </div> 
                        <div class="input-group mb-2 col-6">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><b>Turno</b></span>
                            </div>
                            <input type="text" class="form-control" value="{{$detalle->turno}}" disabled>
                        </div>
                    </div>
                    @foreach($rutas as $r)
                        @if($r->id == $detalle->ruta_id)
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><b style="text-transform:uppercase">Descripcion</b></span>
                            </div>
                            <textarea class="form-control" rows="3" style="text-transform:uppercase" disabled>{{$r->descripcion}}</textarea>
                        </div> 
                        
                        <div class="row">
                            <div class="input-group mb-2 col-6">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><b>Inicio</b></span>
                                </div>
                                <input style="text-transform:uppercase" type="text" class="form-control" value="{{$r->inicio}}" disabled>
                            </div>
                            <div class="input-group mb-2 col-6">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><b>Fin</b></span>
                                </div>
                                <input style="text-transform:uppercase" type="text" class="form-control" value="{{$r->fin}}" disabled>
                            </div>
                        </div>
                        @endif
                    @endforeach
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
                                            @foreach($personals as $activo)
                                                @if($activo->despachodetalle_id == $detalle->id)
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
                                                @if($reem->despachodetalle_id == $detalle->id)
                                                    <tr style="text-transform:uppercase">
                                                        <td><font size=2>{{$reem->reemplazando}}</font></td>
                                                        <td><font size=2>{{$reem->reemplazado}}</font></td>                                                                                           
                                                    </tr>
                                                @endif
                                            @endforeach                                        
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div> 
                    
                </div> 
            </div> 
        @endforeach
        <div class="row">
                        <div class="text-center col-6">
                            <br>
                            <br>
                            <br>
                            <br>
                            ________________________________________
                            <br>
                            Supervisor
                            <br>
                            
                            
                            <br>
                        </div>
                        <div class="text-center col-6">
                            <br>
                            <br>
                            <br>
                            <br>
                            ________________________________________
                            <br>
                            
                            <br>
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