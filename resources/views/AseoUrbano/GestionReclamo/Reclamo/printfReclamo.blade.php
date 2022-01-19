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
                            <img height="65" src="{{asset('dist/img/emaut.ico')}}" width="150"></img>
                        </td>
                        <td style="border-color: black; width: 60%; text-align: center;">
                            <h4><b class="titulo">RECLAMO </b></h4>
                            <h5><b class="titulo" style="text-transform:uppercase">DESDE {{\Jenssegers\Date\Date::parse($ini)->format('l j F Y')}} HASTA {{\Jenssegers\Date\Date::parse($fi)->format('l j F Y')}} </b></h5>

                        </td>
                        <td class="text-left" valign="top" style="border-color: black; width: 15%">
                            <font size="2">FECHA IMPRESO: {{$fechaprint}}</font><br>
                            <font size="2">HRA IMPRESO: {{$hraprint}}</font><br>
                            <font size="1">USUARIO: {{ Auth::user()->funcionario->persona->nombrecompleto() }}</font>
                        </td>
                    </tr>
                </table>
            </div>

            {{-- <div style=" border: solid 1px; border-radius: 10px;  padding: 10px;"> --}}
                
                <div style=" border: solid 1px; border-radius: 10px;  padding: 10px;">

                        <table class="table-bordered" style="width: 100%;">

                            <thead>
                                <tr>
                                    <th>DISTRITO</th>
                                    <th>BARRIO</th>
                                    <th>CALLE</th>
                                    <th>FECHA RECLAMO</th>
                                    <th>RECLAMO</th>
                                    <th>FECHA SOLUCION</th>
                                    <th>SOLUCION</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($resultado as $res)
                                    <tr style="text-transform:uppercase;">
                                        <td>{{$res->distrito}}</td>
                                        <td>{{$res->barrio}}</td>
                                        <td>{{$res->calle}}</td>
                                        <td>{{$res->fechareclamo}}</td>
                                        <td>{{$res->descripcion}}</td>
                                        <td>{{$res->fechaatendido}}</td>
                                        <td>{{$res->solucion}}</td>
                                        
                                    </tr>
                                @endforeach                                
                            </tbody>
                        </table>
                         
                </div>
            {{-- </div> --}}

            
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