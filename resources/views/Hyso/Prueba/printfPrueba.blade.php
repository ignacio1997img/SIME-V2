@extends('Layout.HomeHyso')
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
      
            <button onclick="printcontent('print')" class="btn btn-success"><i class="fas fa-print"></i> Imprimir</button>

    </div>

    <div id="print">
        @for($i=1; $i<=2; $i++)
            <div style="padding-bottom: 2px;">
                <table style="width: 100%;">
                    <tr style="height: 60px;">
                        <td  style="border: solid 1px; border-radius: 10px;  padding: 10px; text-align: center; width: 12%;" valign="bottom">
                            <img height="65" src="{{ asset('dist/img/Emaut.ico')}}" width="150 px;"></img>
                        </td>
                        <td style="border: solid 1px; border-radius: 10px;  padding: 10px; text-align: center;">
                            <h4><b class="titulo">PRUEBA DE GLICEMIA</b></h4>
                        </td>
                        <td class="text-left" valign="top"  style="border: solid 1px; border-radius: 10px;  padding: 10px; text-align: center; width: 20%">
                            <font size="2">FECHA IMPRESO: {{$fechaprint}}</font><br>
                            <font size="2">HORA IMPRESO: {{$hraprint}}</font><br>
                            <font size="1">USUARIO: {{ Auth::user()->funcionario->persona->nombrecompleto() }}</font>
                        </td>
                    </tr>
                </table>
            </div>
            
            <div class="text-center"  style="border: solid 1px; padding: 10px; text-align: center; padding: 5px;">
                <div class="row" style="padding: 5px;"> 
                    <div class="col-4 input-group mb-2">               
                        <div class="input-group-prepend">
                            <span class="input-group-text"><b>ID</b></span>
                        </div>
                        <input type="text" style="color: red;" class="form-control" value="{{$glicemias->id}}" id="id" name="id" disabled>            
                    </div>   
                    <div class="col-4 input-group mb-2">               
                        <div class="input-group-prepend">
                            <span class="input-group-text"><b>FECHA</b></span>
                        </div>
                        <input type="text" class="form-control" value="{{\Carbon\Carbon::parse($glicemias->created_at)->format('d/m/Y H:i:s')}}" id="id" name="id" disabled>            
                    </div>                                 
                   
                    <div class="col-4 input-group mb-2">               
                        <div class="input-group-prepend">
                            <span class="input-group-text"><b>VALOR</b></span>
                        </div>
                        <input type="text" class="form-control" value="{{$glicemias->valor}} mg/dl" id="ci" name="ci" style="text-transform:uppercase" disabled>            
                    </div>            
                </div>
                <div class="input-group mb-2" style="padding: 5px;">               
                        <div class="input-group-prepend">
                            <span class="input-group-text"><b>FUNCIONARIO</b></span>
                        </div>
                        <input type="text" class="form-control" value="{{$glicemias->funcionario->persona->nombrecompleto()}}" id="id" name="id" disabled>            
                    </div>   
            </div>
            <div class="row">
                <div class="text-center col-6">
                    <br>
                    <br>
                    <br>
                    <br>
                    ________________________________________
                    <br>
                    Funcionario
                    <br>
                    {{$glicemias->funcionario->persona->nombrecompleto()}}
                </div>
                <div class="text-center col-6">
                    <br>
                    <br>
                    <br>
                    <br>
                    ________________________________________
                    <br>
                    Realizada por
                    <br>
                    {{$glicemias->realizado}}
                </div>
            </div>
            <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
            @if($i==1)
            ------------------------------------------------------------------------------------------------------------------------------------------------------------------
            @endif
            <br><br><br>
        @endfor


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