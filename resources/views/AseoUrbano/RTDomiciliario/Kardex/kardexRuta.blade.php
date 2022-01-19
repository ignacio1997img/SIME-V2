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
                <li class="breadcrumb-item"><a href="{{route('distrito.index')}}">Ruta</a></li>            
                <li class="breadcrumb-item active">Kardex</li>
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
                        <img height="65" src="{{ asset('dist/img/Emaut.ico')}}" width="150 px;"></img>
                    </td>
                    <td style="border-color: black; width: 55%; text-align: center;" >

                        <h4><b class="titulo" style="text-transform:uppercase">{{$ruta->descripcion}} </b></h4>
                        <h4><b class="titulo" style="text-transform:uppercase"></b></h4>
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
            <div class="container text-center" style="padding: 5px;">
                
                <div class="row">
                    <div class="col-6">
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><b>Zona</b></span>
                            </div>
                            <input type="text" class="form-control" value="{{$ruta->zona->nombre}}"  style="text-transform:uppercase" disabled>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><b>Turno</b></span>
                            </div>
                            <input type="text" class="form-control" value="{{$ruta->turno}}"  style="text-transform:uppercase" disabled>
                        </div>
                    </div>
                </div>
                
                <div class="input-group mb-2">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><b>Frecuencia</b></span>
                    </div>
                    <input type="text" class="form-control" value="{{$frecuencias}}"  style="text-transform:uppercase" disabled>
                </div>
                <div class="bg-warning">
                    <h5>IMAGEN DE LA RUTA</h5>
                </div>
                <div>
                    <!-- <img src="" alt=""> -->
                    <img src="{{ asset('../storage/files/aseourbano/'.$ruta->urlimg)}}" width="100%">
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