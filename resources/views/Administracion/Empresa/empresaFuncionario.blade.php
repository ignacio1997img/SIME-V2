@extends('Layout.HomeAdministracion')
@section('content')


    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div>
        <div class="row mb-2">
          <div class="col-sm-6">
            
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{route('administracion')}}">Home</a></li> 
                <li class="breadcrumb-item"><a href="{{route('empresa.index')}}">Empresa</a></li>        
                <li class="breadcrumb-item active">Listado Funcionario</li>
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
        @can('adm-empresa.listafuncionarioprint')
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

                        <h4><b class="titulo">LISTADO DE PERSONAL</b></h4>
                    </td>
                    <td class="text-left" valign="top" style="border-color: black; width: 20%">
                        <font size="2">FECHA IMPRESO: {{$fechaprint}}</font><br>
                        <font size="2">HORA IMPRESO: {{$hraprint}}</font><br>
                        <font size="1">USUARIO: {{ Auth::user()->funcionario->persona->nombrecompleto() }}</font>
                    </td>
                </tr>
            </table>
        </div>
        
        <div class="container ">
            <div class="text-center bg-warning">
                <h5>{{$empresa->razonsocial}}</h5>
            </div>
            @if($listac > 0 )
            <table class="table table-bordered table-striped" >
                <thead>
                    <tr> 
                        <th class="text-center" width="10%">ID</th> 
                        <th class="text-center">AREA</th>
                        <th class="text-center">CARGO</th>                    
                        <th class="text-center">NOMBRE</th>      
                        <th class="text-center">CI</th>
                        <th class="text-center">TELEFONO</th>                   
                    </tr>
                </thead>
                <tbody>
                    @foreach($listas as $lista)
                        <tr style="text-transform:uppercase">
                            <td class="text-center"><font size=2>{{$lista->id}}</font></td> 
                            <td><font size=2>{{$lista->area}}</font></td> 
                            <td><font size=2>{{$lista->cargo}}</font></td>
                            <td><font size=2>{{$lista->nombre}} {{$lista->p1}} {{$lista->p2}}</font></td>
                            <td><font size=2>{{$lista->ci}}{{$lista->expedido}}</font></td>   
                            <td><font size=2>{{$lista->telefono}}</font></td>                            
                        </tr>        
                    @endforeach
                </tbody>
            </table> 
            @else
                <span class="text-center badge badge-danger"><h6> Sin Registro </h6></span>
            @endif
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