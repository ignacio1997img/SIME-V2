@extends('Layout.HomeRecursosHumanos')
@section('content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div>
        <div class="row mb-2">
          <div class="col-sm-6">
            
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{route('recursoshumanos')}}">Home</a></li> 
                <li class="breadcrumb-item"><a href="{{route('funcionario.index')}}">Funcionario</a></li>        
                <li class="breadcrumb-item active">Historial</li>
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
        @can('rrhh-funcionario.historialsprintf')
            <button onclick="printcontent('print')" class="btn btn-success"><i class="fas fa-print"></i> Imprimir</button>
        @endcan
    </div>

    <div id="print">
        <div style="padding-bottom: 2px;">
            <table style="width: 100%;">
                <tr style="height: 60px;">
                    <td style="width: 12%;" valign="bottom">
                        <img height="65" src="{{ asset('dist/img/Emaut.ico')}}" width="150 px;"></img>
                    </td>
                    <td style="border-color: black; width: 55%; text-align: center;">

                        <h4><b class="titulo">HISTORIAL DEL FUNCIONARIO</b></h4>
                    </td>
                    <td class="text-left" valign="top" style="border-color: black; width: 20%">
                        <font size="2">FECHA IMPRESO: {{$fechaprint}}</font><br>
                        <font size="2">HORA IMPRESO: {{$hraprint}}</font><br>
                        <font size="1">USUARIO: {{ Auth::user()->funcionario->persona->nombrecompleto() }}</font>
                    </td>
                </tr>
            </table>
        </div>
        
        <div class="text-center" style="padding: 5px;">
            <div class="bg-warning">
                <h5>DATOS DEL FUNCIONARIO</h5>
            </div>
            <div class="row" style="padding: 5px;"> 
                <div class="col-4 input-group mb-2">               
                    <div class="input-group-prepend">
                        <span class="input-group-text"><b>Id</b></span>
                    </div>
                    <input type="text" class="form-control" value="{{$funcionarios->id}}" id="id" name="id" disabled>            
                </div>         
                <div class="col-4 input-group mb-2">
                    @if($funcionarios->activo == 1)
                        <div class="input-group-prepend">
                            <span class="input-group-text"><b>ESTADO</b></span>
                        </div>
                        <input type="text" class="form-control" value="Activo" id="ci" name="ci" style="text-transform:uppercase" disabled>            
                    @else
                        <div class="input-group-prepend">
                            <span class="input-group-text"><b>ESTADO</b></span>
                        </div>
                        <input type="text" class="form-control" value="Inactivo" id="ci" name="ci" style="text-transform:uppercase" disabled> 
                        
                    @endif
                </div>
                <div class="col-4 input-group mb-2">               
                    <div class="input-group-prepend">
                        <span class="input-group-text"><b>CI</b></span>
                    </div>
                    <input type="text" class="form-control" value="{{$funcionarios->persona->cicompleto()}}" id="ci" name="ci" style="text-transform:uppercase" disabled>            
                </div>            
            </div>

            <div class="input-group mb-2" style="padding: 5px;">
                <div class="input-group-prepend">
                    <span class="input-group-text"><b>Nombre</b></span>
                </div>
                <input type="text" class="form-control" value="{{$funcionarios->persona->nombrecompleto()}}" id="nombre"  name="nombre" disabled>
            </div>
            <!-- historial de cargo -->
            <div class="container text-center" style="padding: 5px;">
                <div class="bg-warning">
                    <h5>HISTORIAL DE CARGOS</h5>
                </div>
                <table class="table table-bordered table-striped" >
                    <thead>
                    <tr>
                        <th class="text-center">INICIO</th> 
                        <th class="text-center">CARGO</th>                  
                        <th class="text-center">DETALLE</th> 
                        <th class="text-center">MOTIVO</th>
                        <th class="text-center">FIN</th>  
                        <th class="text-center">OBSERVACION</th> 
                        <th class="text-center">ESTADO</th>                                                 
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($detalles as $detalle)
                            <tr style="text-transform:uppercase">
                                <td><font size=2>{{\Carbon\Carbon::parse($detalle->inicio)->format('d/m/Y')}}</font></td>
                                <td><font size=2>{{$detalle->nombre}}</font></td>
                                <td><font size=2>{{$detalle->detalle}}</font></td>
                                <td><font size=2>{{$detalle->motivo}}</font></td>
                                @if($detalle->fin == null)
                                    <td><font size=2></font></td>
                                @else
                                    <td><font size=2>{{\Carbon\Carbon::parse($detalle->fin)->format('d/m/Y')}}</font></td>
                                @endif
                                <td><font size=2>{{$detalle->observacion}}</font></td>
                                <td><font size=2>
                                    @if($detalle->activo)
                                        ACTIVO
                                    @else
                                        INACTIVO
                                    @endif
                                </font></td>
                            </tr>
                        @endforeach                
                    </tbody>
                </table> 
            </div>  
            <!-- historial de bajas -->

            <div class="container text-center" style="padding: 5px;">
                <div class="bg-warning">
                    <h5>HISTORIAL DE VACACIONES Y BAJAS</h5>
                </div>
                @if($bajac >= 1)
                <table class="table table-bordered table-striped" >
                    <thead>
                    <tr>
                        <th class="text-center">INICIO</th> 
                        <th class="text-center">CARGO</th> 
                        <th class="text-center">MOTIVO</th>
                        <th class="text-center">DOCUMENTO</th> 
                        <th class="text-center">OBSERVACION</th> 
                        <th class="text-center">FIN</th>  
                        <th class="text-center">ESTADO</th>                         
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($bajas as $baja)
                            <tr style="text-transform:uppercase">
                                <td><font size=2>{{\Carbon\Carbon::parse($baja->inicio)->format('d/m/Y')}}</font></td>
                                <td><font size=2>{{$baja->nombre}}</font></td>
                                <td><font size=2>{{$baja->tipo}}</font></td>
                                <td><font size=2>{{$baja->documento}}</font></td>
                                <td><font size=2>{{$baja->observacion}}</font></td>
                                <td><font size=2>{{\Carbon\Carbon::parse($baja->fin)->format('d/m/Y')}}</font></td>
                                <td><font size=2>
                                    @if($baja->activo)
                                        ACTIVO
                                    @else
                                        INACTIVO
                                    @endif
                                </font></td>
                            </tr>
                        @endforeach                
                    </tbody>
                </table> 
                @else
                    <span class="badge badge-danger"><h6> Sin Registro </h6></span>
                @endif
            </div>             
            
            <!-- historial de Reemplazo -->
            <div class="container text-center" style="padding: 5px;">
                <div class="bg-warning">
                    <h5>HISTORIAL DE REEMPLAZO</h5>
                </div>
                @if($reempazoc >= 1)
                <table class="table table-bordered table-striped" >
                    <thead>
                    <tr> 
                        <th class="text-center" width="20%">CARGO</th> 
                        <th class="text-center" width="25%">REEEMPLAZO A</th>
                        <th class="text-center" width="10%">DOCUMENTO</th> 
                        <th class="text-center" width="10%">TIPO</th>                        
                        <th class="text-center" width="10%">INICIO</th>      
                        <th class="text-center" width="10%">CORTE</th>
                        <th class="text-center" width="10%">FIN</th> 
                        <th class="text-center" width="20%">OBSERVACION</th>   
                        <th class="text-center">ESTADO</th>                  
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($reempazos as $reempazo)
                            <tr style="text-transform:uppercase">                                
                                <td><font size=2>{{$reempazo->nombre}}</font></td>
                                <td><font size=2>{{$reempazo->a}}</font></td>
                                <td><font size=2>{{$reempazo->documento}}</font></td>
                                <td><font size=2>{{$reempazo->tipo}}</font></td>                                
                                <td><font size=2>{{\Carbon\Carbon::parse($reempazo->inicio)->format('d/m/Y')}}</font></td>
                                @if($reempazo->fins == null)
                                    <td><font size=2></font></td>
                                @else
                                    <td><font size=2>{{\Carbon\Carbon::parse($reempazo->fins)->format('d/m/Y')}}</font></td>
                                @endif

                                @if($reempazo->fin == null)
                                <td><font size=2></font></td>
                                @else
                                    <td><font size=2>{{\Carbon\Carbon::parse($reempazo->fin)->format('d/m/Y')}}</font></td>
                                @endif
                                <td><font size=2>{{$reempazo->observacion}}</font></td>
                                <td><font size=2>
                                    @if($reempazo->activo)
                                        ACTIVO
                                    @else
                                        INACTIVO
                                    @endif
                                </font></td>
                                
                            </tr>
                        @endforeach                
                    </tbody>
                </table> 
                @else
                    <span class="badge badge-danger"><h6> Sin Registro </h6></span>
                @endif
            </div>   

            <!-- historial de asignaciones -->
            <div class="container text-center" style="padding: 5px;">
                <div class="bg-warning">
                    <h5>HISTORIAL DE DESIGNACION</h5>
                </div>
                @if($listc >= 1)
                <table class="table table-bordered table-striped" >
                    <thead>
                    <tr> 
                        <th class="text-center" width="20%">NOMBRE</th> 
                        <th class="text-center" width="10%">DOCUMENTO</th>                    
                        <th class="text-center" width="10%">INICIO</th>      
                        <th class="text-center" width="10%">CORTE</th>
                        <th class="text-center" width="10%">FIN</th> 
                        <th class="text-center" width="20%">OBSERVACION</th>  
                        <th class="text-center">ESTADO</th>                   
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($listas as $lista)
                            <tr style="text-transform:uppercase">
                                <td><font size=2>{{$lista->nombre}}</font></td>
                                <td><font size=2>{{$lista->documento}}</font></td>
                                <td><font size=2>{{\Carbon\Carbon::parse($lista->inicio)->format('d/m/Y')}}</font></td>

                                @if($lista->fins == null)
                                    <td><font size=2></font></td>
                                @else
                                    <td><font size=2>{{\Carbon\Carbon::parse($lista->fins)->format('d/m/Y')}}</font></td>
                                @endif

                                <td><font size=2>{{\Carbon\Carbon::parse($lista->fin)->format('d/m/Y')}}</font></td>
                                <td><font size=2>{{$lista->observacion}}</font></td>
                                <td><font size=2>
                                    @if($lista->activo)
                                        ACTIVO
                                    @else
                                        INACTIVO
                                    @endif
                                </font></td>
                            </tr>
                        @endforeach 
                    </tbody>
                </table> 
                @else
                    <span class="badge badge-danger"><h6> Sin Registro </h6></span>
                @endif
            </div>  

            
        </div>
        <P>Fin del Reporte...</P>
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