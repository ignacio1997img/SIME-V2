@extends('Layout.HomeAseoUrbano')
@section('content')


    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div>
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"><i class="fas fa-print"></i> Parte Diario</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{route('aseourbano')}}">Home</a></li> 
                <li class="breadcrumb-item"><a href="{{route('despacho.index')}}">Despacho</a></li>       
                <li class="breadcrumb-item"><a href="{{route('detalledespacho',$detalle->despacho_id)}}">Detalle Despacho</a></li>   
                <li class="breadcrumb-item active">Parte Diario</li>
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

                        <h4><b class="titulo">PARTE DIARIO DEL SERVICIO</b></h4>
                        <h4><b class="titulo">DE RECOLECCION Y TRANSPORTE</b></h4>
                    </td>
                    <td  valign="top" style="width: 20%; border: solid 1px;  padding: 10px; text-align: center; ">
                        <font size="5" style="color: red;">{{$detalle->parte}}</font><br>
                        <font size="2">FECHA HORA: {{\Carbon\Carbon::parse()->format('d/m/Y H:i:s')}}</font><br>
                        <font size="1">USUARIO: {{ Auth::user()->funcionario->persona->nombrecompleto() }}</font>
                    </td>
                </tr>
            </table>
        </div>


        <div style=" border: solid 1px;  padding: 10px;">
            <div class="row">
                <div class="input-group mb-2 col-4">               
                    <div class="input-group-prepend">
                        <span class="input-group-text"><b>RUTA</b></span>
                    </div>
                    <input type="text" class="form-control" value="{{$detalle->ruta->descripcion}}" id="sigla" name="sigla" disabled>            
                </div>  
                <div class="input-group mb-2 col-4">               
                    <div class="input-group-prepend">
                        <span class="input-group-text"><b>DIA</b></span>
                    </div>
                    <input type="text" class="form-control" value="" id="sigla" name="sigla" disabled>            
                </div>  
                <div class="input-group mb-2 col-4">               
                    <div class="input-group-prepend">
                        <span class="input-group-text"><b>FECHA</b></span>
                    </div>
                    <input type="text" class="form-control" value="" id="sigla" name="sigla" disabled>            
                </div>  
            </div>
            <p class="bg-warning text-center"><b> DATOS DE salida</b></p>
            <div class="row">
                <div class="input-group mb-2 col-4">               
                    <div class="input-group-prepend">
                        <span class="input-group-text"><b>fecha hora</b></span>
                    </div>
                    <input type="text" class="form-control" value="{{\Carbon\Carbon::parse($detalle->salida)->format('d/m/Y H:i:s')}}" id="sigla" name="sigla" disabled>            
                </div>  
                <div class="input-group mb-2 col-4">               
                    <div class="input-group-prepend">
                        <span class="input-group-text"><b>km</b></span>
                    </div>
                    <input type="text" class="form-control" value="{{\Carbon\Carbon::parse($detalle->llegada)->format('d/m/Y H:i:s')}}" id="sigla" name="sigla" disabled>            
                </div>  
                <div class="input-group mb-2 col-4">               
                    <div class="input-group-prepend">
                        <span class="input-group-text"><b>TOTAL KM</b></span>
                    </div>
                    <input type="text" class="form-control" value="{{$ok}}" id="sigla" name="sigla" disabled>            
                </div>  
            </div>
            <p class="bg-warning text-center"><b> DATOS DE LLEGADA</b></p>
            <div class="row">
                <div class="input-group mb-2 col-4">               
                    <div class="input-group-prepend">
                        <span class="input-group-text"><b>fecha hora</b></span>
                    </div>
                    <input type="text" class="form-control" value="{{\Carbon\Carbon::parse($detalle->salida)->format('d/m/Y H:i:s')}}" id="sigla" name="sigla" disabled>            
                </div>  
                <div class="input-group mb-2 col-4">               
                    <div class="input-group-prepend">
                        <span class="input-group-text"><b>km</b></span>
                    </div>
                    <input type="text" class="form-control" value="{{\Carbon\Carbon::parse($detalle->llegada)->format('d/m/Y H:i:s')}}" id="sigla" name="sigla" disabled>            
                </div>  
                <div class="input-group mb-2 col-4">               
                    <div class="input-group-prepend">
                        <span class="input-group-text"><b>TOTAL HORAS</b></span>
                    </div>
                    <input type="text" class="form-control" value="{{$ok}}" id="sigla" name="sigla" disabled>            
                </div>  
            </div>
            <p class="bg-warning text-center"><b> DATOS DE MAQUINARIA Y EQUIPO</b></p>
            <div class="row">
                @foreach($vehiculo as $ve)
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
                    <input type="text" class="form-control" value="{{$ve->tipo->descripcion}}" id="sigla" name="sigla" disabled>            
                </div>  
                <div class="input-group mb-2 col-3">               
                    <div class="input-group-prepend">
                        <span class="input-group-text"><b>MARCA</b></span>
                    </div>
                    <input type="text" class="form-control" value="{{$ve->modelo->marca->descripcion}}" id="sigla" name="sigla" disabled>            
                </div>  
                <div class="input-group mb-2 col-3">               
                    <div class="input-group-prepend">
                        <span class="input-group-text"><b>PLACA</b></span>
                    </div>
                    <input type="text" class="form-control" value="{{$ve->placa}}" id="sigla" name="sigla" disabled>            
                </div> 
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
                            @foreach($funcionarios as $fu)
                                <tr>
                                    <td>{{$fu->funcionario}}</td>    
                                </tr>    
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
            <p class="bg-warning text-center"><b>OBSERVACIONES</b></p>
            <div style="border: solid 1px; padding: 10px; height: 100px;">
                {{$detalle->observacion}}
            </div>
            <div class="row" style="padding: 10px;">
                <div class="col-6" style="border: solid 1px; padding: 10px; height: 150px;">
                    chofer
                </div>
                <div class="col-6 text-center-bottom" style="border: solid 1px; padding: 10px; height: 150px;">
                    supervisor
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