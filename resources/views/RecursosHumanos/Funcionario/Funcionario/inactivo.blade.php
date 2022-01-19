@extends('Layout.HomeRecursosHumanos')
@section('content')



    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div>
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"><i class="fas fa-user-alt-slash"></i> Funcionario Inactivo</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('recursoshumanos')}}">Home</a></li>    
              <li class="breadcrumb-item"><a href="{{route('funcionario.index')}}">Funcionario</a></li>      
              <li class="breadcrumb-item active">Funcionario Inactivo</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    
<div class="container">
   <div style="padding-bottom: 5px;">
      <a class="btn btn-warning" data-toggle="tooltip" href="{{route('funcionario.index')}}" title="Volver al menu principal">
         <i class="fas fa-arrow-alt-circle-left" style="width:20; height:20;">
         </i>
         Volver
      </a>
   </div>
   <div class="card table-responsive card-outline card-info">
      <div class="card-header">
         <div>
            <th>
               <h4 class="card-title text-center ">
               LISTA DE FUNCIONARIOS INACTIVOS
               </h4>
            </th>
         </div>
      </div>
      <div class="card-body">
         <table class="table table-bordered table-hover table-sm" id="example2">
            <thead>
               <tr >
                  <th class="text-center" width="50">ID</th>
                  <th class="text-center">EMPRESA</th> 
                  <th class="text-center">CARGO</th> 
                  <th class="text-center">NOMBRE</th> 
                  <th class="text-center">TIPO</th> 
                  @can('rrhh-funcionario.historialinactivo') 
                     <th class="text-center"></th> 
                  @endcan                             
               </tr>
            </thead>
            <tbody>
                @foreach($funcionarios as $funcionario)
                    <tr  style="text-transform:uppercase">
                        <td class="text-center" width="5%"><font size=2>{{ $funcionario->id}}</font></td>
                        <td><font size=2>{{ $funcionario->sigla}}</font></td>
                        <td><font size=2>{{ $funcionario->cargo}}</font></td>
                        <td><font size=2>{{ $funcionario->nombre}} {{ $funcionario->ap1}} {{ $funcionario->ap2}}</font></td> 
                        <td><font size=3>
                           @if($funcionario->activo === 0)
                              <span class="badge badge-danger">{{ $funcionario->tipo}}</span>
                           @else
                              <span class="badge badge-warning">{{ $funcionario->tipo}}</span>
                           @endif
                        
                        </font></td> 
                        @can('rrhh-funcionario.historialinactivo') 
                           <td style="width: 5%" class="text-center">
                              <a class="btn btn-sm btn-warning" data-toggle="tooltip"  href="{{route('rrhh-funcionario.historial', $funcionario->id)}}" title="Historial">
                                 <i class="fas fa-clipboard-list"></i>
                              </a>
                           </td>    
                        @endcan                     
                    </tr>
                @endforeach
            </tbody>
         </table>
      </div>
   </div>
</div>





<script type="text/javascript">

</script>
@endsection