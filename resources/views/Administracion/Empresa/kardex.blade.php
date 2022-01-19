@extends('Layout.HomeAdministracion')
@section('content')


    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div>
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"><i class="fas fa-building"></i> Empresa</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('administracion')}}">Home</a></li> 
              <li class="breadcrumb-item"><a href="{{route('empresa.index')}}">Empresa</a></li>        
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
        
        @can('adm-empresa.kardeximprimir')
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

                        <h4><b class="titulo">KARDEX DE EMPRESA </b></h4>
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
                <div class="input-group mb-2 col-9">           
                    <div class="input-group-prepend">
                        <span class="input-group-text"><b>RAZON SOCIAL</b></span>
                    </div>
                    <input type="text" class="form-control" value="{{$empresas->razonsocial}}" id="nit" name="nit" style="text-transform:uppercase" disabled>   
                </div>
                <div class="input-group mb-2 col-3">               
                    <div class="input-group-prepend">
                        <span class="input-group-text"><b>SIGLA</b></span>
                    </div>
                    <input type="text" class="form-control" value="{{$empresas->sigla}}" id="sigla" name="sigla" disabled>            
                </div>  
            </div>  
            <div class="row" style="padding: 10px;"> 
                <div class="col-4 input-group mb-2">               
                    <div class="input-group-prepend">
                        <span class="input-group-text"><b>FECHA REGISTRO</b></span>
                    </div>
                    <input type="text" class="form-control" value="{{ \Carbon\Carbon::parse($empresas->created_at)->format('d/m/Y')}}" id="id" name="id" disabled>            
                </div>
                <div class="col-2 input-group mb-2">               
                    <div class="input-group-prepend">
                        <span class="input-group-text"><b>ID</b></span>
                    </div>
                    <input type="text" class="form-control" value="{{$empresas->id}}" id="id" name="id" disabled>            
                </div>         
                <div class="col-3 input-group mb-2 ">               
                    <div class="input-group-prepend">
                        <span class="input-group-text"><b>NIT</b></span>
                    </div>
                    <input type="text" class="form-control" value="{{$empresas->nit}}" id="nit" name="nit" style="text-transform:uppercase" disabled>            
                </div>                  
                <div class="col-3 input-group mb-2">               
                    <div class="input-group-prepend">
                        <span class="input-group-text"><b>PROVEE PERSONAL</b></span>
                    </div>
                    @if($empresas->personal == 1)
                        <input type="text" class="form-control" value="SI" id="id" name="id" disabled>  
                    @else   
                        <input type="text" class="form-control" value="NO" id="id" name="id" disabled> 
                    @endif       
                </div>               
            </div>
            <div class="row"  style="padding: 10px;"> 
                <div class="col-4 input-group mb-2">               
                    <div class="input-group-prepend">
                        <span class="input-group-text"><b>GRUPO</b></span>
                    </div>
                    <input type="text" class="form-control" value="{{$empresas->rubro->subgrupo->grupo->nombre}}" id="id" name="id" style="text-transform:uppercase" disabled>            
                </div>
                <div class="col-4 input-group mb-2">               
                    <div class="input-group-prepend">
                        <span class="input-group-text"><b>SUB GRUPO</b></span>
                    </div>
                    <input type="text" class="form-control" value="{{$empresas->rubro->subgrupo->descripcion}}" id="id" name="id" style="text-transform:uppercase" disabled>            
                </div>  
                <div class="col-4 input-group mb-2 ">               
                    <div class="input-group-prepend">
                        <span class="input-group-text"><b>RUBRO</b></span>
                    </div>
                    <input type="text" class="form-control" value="{{$empresas->rubro->descripcion}}" id="nit" name="nit" style="text-transform:uppercase" disabled>            
                </div>                
            </div>        
            <div class="input-group mb-2" style="padding: 10px;">
              <div class="input-group-prepend">
                <span class="input-group-text"><b>DIRECCION</b></span>
              </div>
              <textarea class="form-control" rows="3" name="direccion" id="direccion" style="text-transform:uppercase" disabled> {{$empresas->direccion}}</textarea>
            </div>     
            <div class="row" style="padding: 10px;">

                <div class="col-4 input-group mb-2 ">               
                    <div class="input-group-prepend">
                        <span class="input-group-text"><b>TELEFONO</b></span>
                    </div>
                    <input type="text" class="form-control" value="{{$empresas->telempresa}}" id="telempresa" name="telempresa" style="text-transform:uppercase" disabled>            
                </div> 
                <div class="col-8 input-group mb-2 ">               
                    <div class="input-group-prepend">
                        <span class="input-group-text"><b>E-MAIL</b></span>
                    </div>
                    <input type="text" class="form-control" value="{{$empresas->emailempresa}}" id="emailempresa" name="emailempresa" disabled>            
                </div> 
            </div>
            <div class="input-group mb-2"  style="padding: 10px;">           
                <div class="input-group-prepend">
                    <span class="input-group-text"><b>CONTACTO EMPRESA</b></span>
                </div>
                <input type="text" class="form-control" value="{{$empresas->contacto}}" id="contacto" name="contacto" style="text-transform:uppercase" disabled>   
            </div> 
            <p class="bg-warning text-center"><b> DATOS DEL CONTACTO</b></p>
            <div class="row" style="padding: 10px;">
                <div class="col-4 input-group mb-2 ">               
                    <div class="input-group-prepend">
                        <span class="input-group-text"><b>TELEFONO</b></span>
                    </div>
                    <input type="text" class="form-control" value="{{$empresas->telefonocontacto}}" id="telefonocontacto" name="telefonocontacto" style="text-transform:uppercase" disabled>            
                </div> 
                <div class="col-8 input-group mb-2 ">               
                    <div class="input-group-prepend">
                        <span class="input-group-text"><b>E-MAIL</b></span>
                    </div>
                    <input type="text" class="form-control" value="{{$empresas->emailcontacto}}" id="emailcontacto" name="emailcontacto" disabled>            
                </div> 
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