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
                        @if($t == 0)
                            <h4><b class="titulo" style="text-transform:uppercase"> {{$ruta}}</b></h4>
                        @else
                            <h4><b class="titulo" style="text-transform:uppercase">TODAS LAS RUTAS</b></h4>
                        @endif

                        @if($todo == 0)
                            <h4>
                                <b class="titulo" style="text-transform:uppercase"> 
                                    @if ($lunes == 1)
                                    LUNES
                                    @endif
                                    @if ($martes == 1)
                                    MARTES
                                    @endif
                                    @if ($miercoles == 1)
                                    MIERCOLES
                                    @endif
                                    @if ($jueves == 1)
                                    JUEVES
                                    @endif
                                    @if ($viernes == 1)
                                    VIERNES
                                    @endif
                                    @if ($sabado == 1)
                                    SABADO
                                    @endif
                                    @if ($domingo == 1)
                                    DOMINGO
                                    @endif

                                </b>
                            </h4>
                        @else
                            <h4><b class="titulo" style="text-transform:uppercase">TODOS LOS DIAS</b></h4>
                        @endif
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
                    <table class="table table-bordered table-hover table-sm">
                        <thead>
                            <tr>
                                <th class="text-center">DESDE</th>
                                <th class="text-center">{{\Jenssegers\Date\Date::parse($inicio)->format('l j F Y')}}</th> 
                                <th class="text-center"></th>  
                                <th class="text-center">HASTA</th>    
                                <th class="text-center">{{\Jenssegers\Date\Date::parse($fin)->format('l j F Y')}}</th>                           
                            </tr>
                            <tr>
                                <th class="text-center">RUTA</th>
                                <th class="text-center">FECHA</th> 
                                <th class="text-center">UNIDAD</th>  
                                <th class="text-center">VIAJE</th>    
                                <th class="text-center">PESO</th>                           
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($resultado as $res)                                
                                <tr>
                                    @if ($todo == 0)
                                        @if ((\Jenssegers\Date\Date::parse($res->fecha)->format('l') == "lunes" && $lunes == 1) ||
                                            (\Jenssegers\Date\Date::parse($res->fecha)->format('l') == "martes" && $martes == 1) ||
                                            (\Jenssegers\Date\Date::parse($res->fecha)->format('l') == "miércoles" && $miercoles == 1) ||
                                            (\Jenssegers\Date\Date::parse($res->fecha)->format('l') == "jueve" && $jueves == 1) ||
                                            (\Jenssegers\Date\Date::parse($res->fecha)->format('l') == "viernes" && $viernes == 1) ||
                                            (\Jenssegers\Date\Date::parse($res->fecha)->format('l') == "sabado" && $sabado == 1) ||
                                            (\Jenssegers\Date\Date::parse($res->fecha)->format('l') == "domingo" && $domingo == 1)
                                        )
                                        <td class="text-center">{{$res->ruta}}</td>
                                        <td class="text-center">{{\Jenssegers\Date\Date::parse($res->fecha)->format('l j F Y')}}</td>
                                        <td class="text-center">{{$res->interno}} - {{$res->tipo}} - {{$res->marca}} - {{$res->placa}}</td>           
                                        <td class="text-center">{{$res->viaje}}</td>    
                                        <td class="text-center">{{$res->peso}}</td>
                                            
                                        @endif

                                                                             
                                    @else
                                        <td class="text-center">{{$res->ruta}}</td>
                                        <td class="text-center">{{\Jenssegers\Date\Date::parse($res->fecha)->format('l j F Y')}}</td>
                                        <td class="text-center">{{$res->interno}} - {{$res->tipo}} - {{$res->marca}} - {{$res->placa}}</td>           
                                        <td class="text-center">{{$res->viaje}}</td>    
                                        <td class="text-center">{{$res->peso}}</td>   
                                    @endif                                                              
                                </tr> 
                            @endforeach  
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