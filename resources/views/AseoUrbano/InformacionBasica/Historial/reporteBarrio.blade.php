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
                <li class="breadcrumb-item"><a href="{{route('distrito.index')}}">Distrito</a></li>        
                <li class="breadcrumb-item active">Historial</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>



    <style>
		/* cuando vayamos a imprimir ... */
		@media print{
			/* indicamos el salto de pagina */
			.saltoDePagina{
				display:block;
				break-after:always;
			}
		}

        .table
        {
            width: 100%;
            border-collapse: collapse;
            border: 3px solid black;
        },
        .td
        {
            border: 3px solid black;
        }
	</style>
    <!-- /.content-header -->
    <!-- dd(auth()->user()->roles) -->

    <div style="padding-bottom: 5px;">
        <a class="btn btn-warning" data-toggle="tooltip" href="{{ URL::previous() }}" 
            title="Volver al Listado" data-placement="right"><i class="fas fa-arrow-alt-circle-left" ></i>
            Volver
        </a>       
        @can('au-distritos.historialprintf')
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

                        <h4><b class="titulo">LISTADO DE DISTRITOS</b></h4>
                    </td>
                    <td class="text-left" valign="top" style=" width: 20%">
                        <font size="2">FECHA IMPRESO: {{$fechaprint}}</font><br>
                        <font size="2">HORA IMPRESO: {{$hraprint}}</font><br>
                        <font size="1">USUARIO: {{ Auth::user()->funcionario->persona->nombrecompleto() }}</font>
                    </td>
                </tr>
            </table>
        </div>
        
        <div class="text-center" style="padding: 5px;">    
            <div class="container text-center" style="padding: 5px;">
                
                <table class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th class="text-center">BARRIO</th> 
                        @if($ok == 1)
                            <th class="text-center">NOMBRE</th> 
                            <th class="text-center">TELEFONO</th>   
                        @endif               
                    </tr>
                    </thead>  
                    <?php
                        $dat = true;
                        $i=0;
                    ?>
                    <tbody>
                        @foreach($distritos as $dist) 
                            <tr style="text-transform:uppercase">        
                                @if($ok == 1)             
                                    <td colspan="3" class="bg-warning"><b>{{$dist->descripcion}}</b> </td>
                                @else
                                    <td colspan="1" class="bg-warning"><b>{{$dist->descripcion}}</b> </td>
                                @endif  
                            </tr>
                            @foreach($barrios as $barrio)                                
                                @if(($dist->id == $barrio->id) && ($barrio->activo == 1 ||  $barrio->activo === NULL ))
                                    <tr style="text-transform:uppercase" >
                                        <td><font size=2>{{$barrio->barrio}}</font></td>
                                        @if($ok == 1)
                                            @if($barrio->nombrecompleto == null)
                                                <td colspan="2"><b>SIN REGISTRO</b> </td>
                                            @else
                                                <td ><font size=2>{{$barrio->nombrecompleto}}</font></td>
                                                <td><font size=2>{{$barrio->telefono}}</font></td>
                                            @endif
                                        @endif   
                                    </tr>
                                    {{$dat = false}}
                                @endif                                
                            @endforeach
                            
                            @if($dat)
                                <tr style="text-transform:uppercase">        
                                    @if($ok == 1)             
                                        <td style="border: 2px;" colspan="3" class="bg-danger"><b>SIN REGISTRO</b> </td>
                                    @else
                                        <td colspan="1" class="bg-danger"><b>SIN REGISTRO</b> </td>
                                    @endif  
                                </tr>                              
                            @endif

                            <?php
                                $dat = true;
                            ?>
                        @endforeach  
                    </tbody>                    
                </table> 
                
                
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