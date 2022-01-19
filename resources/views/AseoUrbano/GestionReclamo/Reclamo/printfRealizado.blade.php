@extends('Layout.HomeAseoUrbano')

@section('content')
<font size=2>
    
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


    <div style="padding-bottom: 5px;">
        <a class="btn btn-warning" data-toggle="tooltip" href="{{route('reclamo.index') }}" title="Volver al Formulario"><i class="fas fa-arrow-alt-circle-left" style="width:20px; height:20px;"></i> Volver</a>

        <button onclick="printcontent('print')" class="btn btn-success"><i class="fas fa-print"></i> Imprimir</button>
    </div>
    <div id="print" class="card-outline card-info">
        <div style="border: solid 1px; border-radius: 5px; padding: 5px;">
            <div style="padding-bottom: 2px;">
                <table style="width: 100%;">
                    <tr style="height: 60px;">
                        <td  style="width: 12%;" valign="bottom" >
                            <img height="65" src="{{asset('dist/img/emaut.ico')}}" width="100"></img>
                        </td>
                        <td style="border-color: black; width: 60%; text-align: center;">
                            <h4><b class="titulo">DETALLE DEL RECLAMO </b></h4>

                        </td>
                        <td class="text-left" valign="top" style="border-color: black; width: 15%">
                            <font size="2">FECHA IMPRESO: {{$fechaprint}}</font><br>
                            <font size="2">HRA IMPRESO: {{$hraprint}}</font><br>
                            <font size="1">USUARIO: {{ Auth::user()->funcionario->persona->nombrecompleto() }}</font>
                        </td>
                    </tr>
                </table>
            </div>

            <div style=" border: solid 1px; border-radius: 10px;  padding: 10px;">
                <table class="table-bordered" style="width: 100%;">
                    <thead>
                    <tr>
                        <th>Numero:</th>
                        <td width="180px"><b style="color: #c82829">{{$reclamo->numero}}/{{\Carbon\Carbon::parse($reclamo->created_at)->format('Y')}}</b></td>
                        <th>Fecha Registro:</th>
                        <td>{{ \Carbon\Carbon::parse($reclamo->created_at)->format('d/m/Y H:i A')   }}</td>
                        <th>Fecha Reclamo:</th>
                        <td>{{ \Carbon\Carbon::parse($reclamo->fechareclamo)->format('d/m/Y H:i A')   }}</td>


                    </tr>
                    <tr>
                        {{-- <th>Tipo:</th>
                        <td>hola</td> --}}
                        <th>Reiterado:</th>
                        <td>{{ App\AuReclamoReiteracion::where('reclamo_id', $reclamo->id)->count() }}</td>
                        <th>Registrado:</th>
                        <td>{{ $reclamo->registrado }}</td>
                    </tr>


                    <tr >
                        <th>Contacto:</th>
                        <td style="text-transform:uppercase;">{{ App\AuContacto::find($reclamo->contacto_id)->nombrecompleto }}</td>
                        <th>Telefono:</th>
                        <td>{{ App\AuContacto::find($reclamo->contacto_id)->telefono }}</td>
                        <th >Barrio:</th>
                        <td style="text-transform:uppercase;">{{$barrio->descripcion}}</td>
                    </tr>
                    <tr>
                        <th>Descripcion:</th>
                        <td COLSPAN="5" style="text-transform:uppercase;">{{$reclamo->descripcion}}</td>
                    </tr>
                    </thead>
                </table>
            </div>

            @if($reiteraciones->count() > 0)
                <div style="padding: 3px;">
                    <b>Reitereción de Reclamo:</b>
                </div>
                <div style=" border: solid 1px; border-radius: 10px;  padding: 10px;">

                        <table class="table-bordered" style="width: 100%;">

                            <thead>
                                <tr>
                                    <th width="50%">OBSERVACION</th>
                                    <th width="50%">OBSERVADO POR</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($reiteraciones as $reiteracion)
                                    <tr style="text-transform:uppercase;">
                                        <td>{{$reiteracion->observacion}}</td>
                                        <td>{{$reiteracion->observado}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                         
                </div>
            @endif

            <div style="padding: 3px;">
                 <b>Solución del Reclamo:</b>
            </div>

            <div style=" border: solid 1px; border-radius: 10px;  padding: 10px;">
                <table class="table-bordered"  style="width: 100%;">
                    <thead>
                    <tr>
                        <th>Fecha de Atención:</th>
                        <td>{{\Carbon\Carbon::parse($reclamo->fechaatedido)->format('d/m/Y H:i A')}}</td>
                        <th width="150px">Fecha de Registro:</th>
                        <td>{{\Carbon\Carbon::parse($reclamo->fecharegistroatendido)->format('d/m/Y H:i A')}}</td>
                        <th width="150px">Atendido:</th>
                        <td style="text-transform:uppercase;">{{$reclamo->atendido}}</td>
                    </tr>
                    <tr>
                        <th>Solución:</th>
                        <td colspan="5" style="text-transform:uppercase;">{{$reclamo->solucion}}</td>
                    </tr>
                    </thead>
                </table>

                @if($detalles->count() > 0)
                <br>
                <div class="card">
                    <div class="card-header text-center">
                        <h6 class="card-title">
                            <b>
                                Realizado con:
                            </b>
                        </h6>
                    </div>

                    <table  class="table table-bordered table-sm"   style="width: 100%;">

                        <thead>
                            <tr>
                                <th width="50%">VEHICULO</th>
                                <th width="50%">FUNCIONARIO</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($detalles as $detalle)
                                <tr style="text-transform:uppercase;">
                                    <td>{{$detalle->vehiculo}}</td>
                                    <td>{{$detalle->funcionario}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                @endif

                
            </div>




            <div style="padding: 3px;"></div>

            <div class=" container-fluid row">
                <div  class="text-center" style=" border: solid 1px; border-radius: 10px;  padding: 7px; width: 40%; height: 150px; margin-left: auto;">
                    <br><br><br><br><br>----------------------------------------------------------<br>
                        Registrado

                    <br>
                </div>
                <div style="padding: 30px;"></div>
                <div class="text-center" style=" border: solid 1px; border-radius: 10px;  padding: 7px; width: 40%; height: 150px;   margin-right: auto;">
                    <br><br><br><br><br>----------------------------------------------------------<br>
                    Atendido 

                    <br>
                </div>
            </div>
            <br>
        </div>
    </div>


    <script type="text/javascript">
        function printcontent(el){
            var restorepage = document.body.innerHTML;
            var printcontent = document.getElementById(el).innerHTML;
            document.body.innerHTML = printcontent;
            window.print();
            document.body.innerHTML = restorepage;
        }
    </script>





@endsection