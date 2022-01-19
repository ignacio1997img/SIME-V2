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
                        <li class="breadcrumb-item"><a href="">Detalle Despacho</a></li>          
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
                            <h4><b class="titulo" style="text-transform:uppercase">TODAS LAS RUTAS</b></h4>
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
                <?php
                    $viaje=0;
                    $peso=0;
                ?>
                @foreach ($mes as $m)
                    <p><b>{{\Jenssegers\Date\Date::parse($m->fechas)->format('F Y')}}</b></p>
                    <div class="card-body">                   
                        <table class="table table-bordered table-hover table-sm">
                            <thead>
                                <tr>
                                    <th class="text-center">RUTA</th> 
                                    <th class="text-center">VIAJE</th>    
                                    <th class="text-center">PESO</th>                           
                                </tr>
                            </thead>
                            <?php
                                $subviaje=0;
                                $subpeso=0;
                            ?>
                            <tbody>
                                @foreach ($agrupados as $ag)
                                    @if ($ag->fechas == $m->fechas)
                                        <tr>
                                            <td class="text-center">{{$ag->descripcion}}</td>
                                            <td class="text-center">{{$ag->viajes}}</td>
                                            <td class="text-center">{{$ag->pesos}}</td>
                                            <?php
                                                $subviaje+=$ag->viajes;
                                                $subpeso+=$ag->pesos;
                                                $viaje+=$ag->viajes;
                                                $peso+=$ag->pesos;
                                            ?>
                                        </tr>                                                                       
                                    @endif                                                                       
                                @endforeach 
                                <tr>
                                    <td class="text-center">SUB TOTAL</td>       
                                    <td class="text-center">{{$subviaje}}</td> 
                                    <td class="text-center">{{$subpeso}}</td>  
                                </tr>                           
                            </tbody>
                        </table>                                     
                    </div>  
                @endforeach  
                <div class="card-body">
                    <table class="table table-bordered table-hover table-sm">
                        <thead>
                            <tr>
                                <th class="text-center"></th> 
                                <th class="text-center">VIAJE</th>    
                                <th class="text-center">PESO</th>                           
                            </tr>
                        </thead>
                        
                        <tbody>
                            
                            <tr>
                                <td class="text-center">TOTAL</td>       
                                <td class="text-center">{{$viaje}}</td> 
                                <td class="text-center">{{$peso}}</td>  
                            </tr>                           
                        </tbody>
                    </table>   
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