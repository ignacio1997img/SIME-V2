@extends('Layout.HomeAseoUrbano')
@section('content')


    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div>
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"><i class="fas fa-print"></i> Historial Despacho</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{route('aseourbano')}}">Home</a></li> 
                <li class="breadcrumb-item"><a href="{{route('despacho.index')}}">Despacho</a></li>        
                <li class="breadcrumb-item active">Historial Despacho</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- dd(auth()->user()->roles) -->


    <div style="padding-bottom: 5px;">
        <a class="btn btn-warning" data-toggle="tooltip" href="{{ URL::previous() }}" 
            title="Volver al Listado" data-placement="right"><i class="fas fa-arrow-alt-circle-left"></i>
            Volver
        </a>       
        
        <button onclick="printcontent('print')" class="btn btn-success"><i class="fas fa-print"></i> Imprimir</button>
     
    </div>


    <div id="print">

 

        <div style="padding-bottom: 2px;">
            

            <table style="width: 100%;">
                <tr style="height: 60px;">
                    <td style="width: 12%; border: solid 1px;  padding: 10px;" valign="bottom">
                    <img height="70" src="{{ asset('dist/img/Emaut.ico')}}" width="150 px;"></img>
                    </td>
                    <td style="width: 55%; text-align: center; border: solid 1px;  padding: 10px;">

                        <h4><b class="titulo">DESPACHO DEL DIA: FECHA</b></h4>
                        <h4><b class="titulo">SERVICIO DE RECOLECION Y TRANSPORTE</b></h4>
                    </td>
                    <td  valign="top" style="width: 20%; border: solid 1px;  padding: 10px; text-align: center; ">
                        <font size="2">FECHA HORA: {{\Carbon\Carbon::parse()->format('d/m/Y H:i:s')}}</font><br>
                        <font size="1">USUARIO: {{ Auth::user()->funcionario->persona->nombrecompleto() }}</font>
                    </td>
                </tr>
            </table>
        </div>

        @foreach($detalles as $de)
        <div style=" border: solid 1px;  padding: 10px;">
            <div class="row">
                <div class="input-group mb-2 col-4">               
                    <div class="input-group-prepend">
                        <span class="input-group-text"><b>RUTA</b></span>
                    </div>
                    <input type="text" class="form-control" value="{{$de->ruta->descripcion}}" id="sigla" name="sigla" disabled>            
                </div>  
                <div class="input-group mb-2 col-4">               
                    <div class="input-group-prepend">
                        <span class="input-group-text"><b>SALIDA</b></span>
                    </div>
                    <input type="text" class="form-control" value="{{\Carbon\Carbon::parse($de->salida)->format('d/m/Y H:i:s')}}" id="sigla" name="sigla" disabled>            
                </div>  
                <div class="input-group mb-2 col-4">               
                    <div class="input-group-prepend">
                        <span class="input-group-text"><b>LLEGADA</b></span>
                    </div>
                    <input type="text" class="form-control" value="{{\Carbon\Carbon::parse($de->llegada)->format('d/m/Y H:i:s')}}" id="sigla" name="sigla" disabled>            
                </div>  
            </div>
            <p class="bg-warning text-center"><b> DATOS DE MAQUINARIA Y EQUIPO</b></p>
            <div class="row">
                @foreach($vehiculos as $ve)
                    @if($ve->id == $de->id)
                        <div class="input-group mb-2 col-3">               
                            <div class="input-group-prepend">
                                <span class="input-group-text"><b>INTERNO</b></span>
                            </div>
                            <input type="text" class="form-control" value="{{$ve->interno}}" id="sigla" name="sigla" disabled>            
                        </div>  
                        <div class="input-group mb-2 col-3">               
                            <div class="input-group-prepend">
                                <span class="input-group-text"><b>EQUIPO</b></span>
                            </div>
                            <input type="text" class="form-control" value="{{$ve->unidad}}" id="sigla" name="sigla" disabled>            
                        </div>  
                        <div class="input-group mb-2 col-3">               
                            <div class="input-group-prepend">
                                <span class="input-group-text"><b>MARCA</b></span>
                            </div>
                            <input type="text" class="form-control" value="{{$ve->marca}}" id="sigla" name="sigla" disabled>            
                        </div>  
                        <div class="input-group mb-2 col-3">               
                            <div class="input-group-prepend">
                                <span class="input-group-text"><b>PLACA</b></span>
                            </div>
                            <input type="text" class="form-control" value="{{$ve->placa}}" id="sigla" name="sigla" disabled>            
                        </div>  
                    @endif
                @endforeach
            </div>
            <p class="bg-warning text-center"><b> DATOS DEL PERSONAL</b></p>
            <div class="row">
                <div class="col-6">
                    <table class="table table-bordered table-striped table-sm">
                        <thead>
                            <span><b>Personal Servicio</b></span>
                        </thead>
                        <tbody>
                            @foreach($funcionarios as $fun)
                                @if($fun->id == $de->id)
                                    <tr>
                                        <td>{{$fun->funcionario}}</td>    
                                    </tr> 
                                @endif
                            @endforeach       
                        </tbody>
                    </table>
                </div>
                <div class="col-6">
                    <table class="table table-bordered table-striped table-sm">
                        <thead>
                            <span><b>Reemplazo Personal</b></span>
                        </thead>
                        <tbody>       
                        </tbody>
                    </table>
                </div>
            </div>            
        </div>

        @endforeach
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