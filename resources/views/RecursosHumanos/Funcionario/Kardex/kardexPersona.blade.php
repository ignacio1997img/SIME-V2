@extends('Layout.HomeRecursosHumanos')
@section('content')


    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div>
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"><i class="fas fa-users"></i>Persona</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{route('recursoshumanos')}}">Home</a></li> 
                <li class="breadcrumb-item"><a href="{{route('persona.index')}}">Persona</a></li>        
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
            title="Volver al Listado" data-placement="right"><i class="fas fa-arrow-alt-circle-left"></i>
            Volver
        </a>       
        @can('rrhh-personas.kardeximprimir')
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

                        <h4><b class="titulo">KARDEX PERSONA </b></h4>
                    </td>
                    <td class="text-left" valign="top" style="border-color: black; width: 20%">
                        <font size="2">FECHA IMPRESO: {{$fechaprint}}</font><br>
                        <font size="2">HORA IMPRESO: {{$hraprint}}</font><br>
                        <font size="1">USUARIO: {{ Auth::user()->funcionario->persona->nombrecompleto() }}</font>
                    </td>
                </tr>
            </table>
        </div>


        <div style=" border: solid 1px; border-radius: 10px;  padding: 10px;">
            <div class="row" style="padding: 10px;"> 
                <div class="col-4 input-group mb-2">               
                    <div class="input-group-prepend">
                        <span class="input-group-text"><b>FECHA REGISTRO</b></span>
                    </div>
                    <input type="text" class="form-control" value="{{ \Carbon\Carbon::parse($personas->created_at)->format('d/m/Y')}}" id="id" name="id" disabled>            
                </div>
                <div class="col-2 input-group mb-2">               
                    <div class="input-group-prepend">
                        <span class="input-group-text"><b>ID</b></span>
                    </div>
                    <input type="text" class="form-control" value="{{$personas->id}}" id="id" name="id" disabled>            
                </div>         
                <div class="col-3 input-group mb-2 ">               
                    <div class="input-group-prepend">
                        <span class="input-group-text"><b>CI</b></span>
                    </div>
                    <input type="text" class="form-control" value="{{$personas->cicompleto()}}" id="ci" name="ci" style="text-transform:uppercase" disabled>            
                </div>           
            </div>

            <div class="row" style="padding: 10px;">                    
                <div class="col-6">
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><b>Nombre</b></span>
                        </div>
                        <input type="text" class="form-control" value="{{$personas->nombre}}" id="nombre"  name="nombre" style="text-transform:uppercase" disabled>
                    </div>
                </div>

                <div class="col-6">
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><b>Apellido Paterno</b></span>
                        </div>
                        <input type="text" class="form-control" value="{{$personas->apellidopaterno}}"  id="apellidopaterno"  name="apellidopaterno" style="text-transform:uppercase" disabled>
                    </div>
                </div>   
            </div>
            <!-- apellido Materno y de esposo -->
            <div class="row" style="padding: 10px;">                    
                <div class="col-6">
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><b>Apellido Materno</b></span>
                        </div>
                        <input type="text" class="form-control" value="{{$personas->apellidomaterno}}" id="apellidomaterno"  name="apellidomaterno" style="text-transform:uppercase" disabled>
                    </div>
                </div>

                <div class="col-6">
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><b>Apellido Esposo</b></span>
                        </div>
                        <input type="text" class="form-control" value="{{$personas->apellidoesposo}}" id="apellidoesposo"  name="apellidoesposo" style="text-transform:uppercase" disabled>
                        <div class="valid-feedback">¡Campo opcional!</div>
                    </div>
                </div>   
            </div>
            <!-- sexo fecha de nacimiento -->
            <div class="row" style="padding: 10px;">
                <!-- ci      -->
                <div class="input-group mb-2 col-md-6">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><b>Fecha Nacimiento</b></span>
                    </div>
                    <input type="date" class="form-control" value="{{$personas->fechanacimiento}}" id="fechanacimiento"  name="fechanacimiento" disabled>
                </div>
                <div class="col-6">
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><b>Sexo</b></span>
                        </div>
                        <select class="form-control custom-select rounded-0" name="sexo" id="sexo" disabled>
                            <option value="{{$personas->sexo}}">{{$personas->sexo}}</option>
                        </select>
                    </div>
                </div>
            </div>
            <!-- telefono y de Direccion -->
            <div class="row" style="padding: 10px;">                    
                <div class="col-6">
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><b>Telefono</b></span>
                        </div>
                        <input type="text" class="form-control" value="{{$personas->telefono}}" id="telefono"  name="telefono" style="text-transform:uppercase" disabled>
                    </div>
                </div>
                <div class="col-6">
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><b>Correo</b></span>
                        </div>
                        <input type="email" class="form-control" value="{{$personas->correo}}" id="correo"  name="correo" disabled>
                    </div>
                </div>                    
            </div>   

            <div class="input-group mb-2" style="padding: 10px;">
                <div class="input-group-prepend">
                        <span class="input-group-text"><b>Dirección</b></span>
                </div>
                <textarea class="form-control" rows="3" name="direccion" id="direccion" style="text-transform:uppercase" disabled>{{$personas->direccion}}</textarea>
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