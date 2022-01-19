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
                
                <table class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th class="text-center">NOMBRE</th> 
                        <th class="text-center">TELEFONO</th> 
                        <th class="text-center">DIRECCION</th>  
                        <th class="text-center">REFERENCIA</th>                      
                    </tr>
                    </thead>  
                    <?php
                        $ok=true;
                        $i=0;
                    ?>
                    <tbody>
                        @foreach($nombres as $nom) 
                            <tr style="text-transform:uppercase">                     
                                <td colspan="4" style="background-color: yellow;"><b>{{$nom->descripcion}}</b> </td>
                                <?php
                                    $i++;
                                ?>
                            </tr>
                            @foreach($distritos as $dist)                                
                                @if($nom->id == $dist->id)
                                    <?php
                                        $ok=false;
                                    ?>
                                    <tr style="text-transform:uppercase" >
                                        <td><font size=2>{{$dist->nombrecompleto}}</font></td>
                                        <td><font size=2>{{$dist->telefono}}</font></td>
                                        <td><font size=2>{{$dist->direccion}}</font></td>
                                        <td><font size=2>{{$dist->referencia}}</font></td>
                                        <?php
                                            $i++;
                                        ?>
                                    </tr>
                                @endif                                
                            @endforeach  
                            @if($ok)
                                <td colspan="4"><span class="badge badge-danger"><h6> Sin Registro </h6></span></td>
                                <?php
                                    $i++;
                                ?>
                            @endif
                            <?php
                                $ok=true;
                            ?>
                            @if($i >= 24)
                                <div style="padding-bottom: 2px;">
                                    <table style="width: 100%; page-break-before: always;">
                                        <tr style="height: 60px;">
                                            <td style="width: 12%;" valign="bottom">
                                                <img height="65" src="{{ asset('dist/img/Emaut.ico')}}" width="150 px;"></img>
                                            </td>
                                            <td style="border-color: black; width: 55%; text-align: center;">

                                                <h4><b class="titulo">LISTADO DE DISTRITOS</b></h4>
                                            </td>
                                            <td class="text-left" valign="top" style="border-color: black; width: 20%">
                                                <font size="2">FECHA IMPRESO: {{$fechaprint}}</font><br>
                                                <font size="2">HORA IMPRESO: {{$hraprint}}</font><br>
                                                <font size="1">USUARIO: {{ Auth::user()->funcionario->persona->nombrecompleto() }}</font>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <table class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th class="text-center">NOMBRE</th> 
                                        <th class="text-center">TELEFONO</th> 
                                        <th class="text-center">DIRECCION</th>  
                                        <th class="text-center">REFERENCIA</th>                      
                                    </tr>
                                    </thead> 
                                
                                <?php
                                    $i=0;
                                ?>
                            @endif

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