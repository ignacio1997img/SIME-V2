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
                            <img height="65" src="{{asset('logos/LogoEmaut.gif')}}" width="150"></img>
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
                            <td width="180px">{{$reclamo->numero}}/{{\Carbon\Carbon::parse($reclamo->created_at)->format('Y')}}</td>
                            <th>Fecha Registro:</th>
                            <td>{{ \Carbon\Carbon::parse($reclamo->created_at)->format('d/m/Y H:i A')   }}</td>
                            <th>Fecha Reclamo:</th>
                            <td>{{ \Carbon\Carbon::parse($reclamo->fechareclamo)->format('d/m/Y H:i A')   }}</td>
                        </tr>
                        <tr>
                            <th>Reiterado:</th>
                            <td>{{ App\AuReclamoReiteracion::where('reclamo_id', $reclamo->id)->count() }}</td>
                            <th>Registrado:</th>
                            <td style="text-transform:uppercase;">{{ $reclamo->registrado }}</td>
                        </tr>

                        <tr>
                            <th>Contacto:</th>
                            <td style="text-transform:uppercase;">{{ App\AuContacto::find($reclamo->contacto_id)->nombrecompleto }}</td>
                            <th>Telefono:</th>
                            <td>{{ App\AuContacto::find($reclamo->contacto_id)->telefono }}</td>
                            <th>Barrio:</th>
                            <td style="text-transform:uppercase;">{{$barrio->descripcion}}</td>
                        </tr>
                        <tr>
                            <th>Descripcion:</th>
                            <td COLSPAN="5" style="text-transform:uppercase;">{{$reclamo->descripcion}}</td>
                        </tr>
                    </thead>
                </table>
            </div>
            <div style="padding: 3px;">
                <b>Reiteración del Reclamo:</b>
            </div>

            <div style=" border: solid 1px; border-radius: 10px;  padding: 10px;">
               
                     <table  class="table table-bordered table-sm"   style="width: 100%;">

                        <thead>
                        <tr>
                            <th width="20%">FECHA REGISTRO</th>
                            <th width="55%">OBSERVACION</th>
                            <th width="25%">REGISTRADO POR</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($reiteraciones as $detalle)
                            <tr style="text-transform:uppercase;">
                                <td>{{ \Carbon\Carbon::parse($detalle->created_at)->format('d/m/Y H:i A')}}</td>
                                <td>{{$detalle->observacion}}</td>
                                <td>{{$detalle->observado}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                
            </div>

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