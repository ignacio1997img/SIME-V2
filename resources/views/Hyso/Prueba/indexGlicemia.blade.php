@extends('Layout.HomeHyso')
@section('content')



    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div>
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"><i class="far fa-object-group"></i> Glicemia</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('administracion')}}">Home</a></li>       
              <li class="breadcrumb-item active">Glicemia</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    
<div class="container" style="width: 90%">
   <div style="padding-bottom: 5px;">
        <a class="btn btn-warning" data-toggle="tooltip" href="" title="Volver al menu principal">
            <i class="fas fa-arrow-alt-circle-left" style="width:20; height:20;">
            </i>
            Volver
        </a>
  
        <a class="btn btn-success" data-toggle="modal" data-target="#modalRegistrar" title="Registrar Nuevo Sub Grupo">
          <i class="fas fa-plus"></i>
          Registrar
        </a>

   </div>
   <div class="card table-responsive card-outline card-info">
      <div class="card-header">
         <div>
            <th>
               <h4 class="card-title text-center ">
               LISTA
               </h4>
            </th>
         </div>
      </div>
      <div class="card-body">
         <table class="table table-bordered table-hover table-sm" id="example2">
            <thead>
               <tr>
                    <th class="text-center" width="20%">FECHA</th>
                    <th class="text-center">FUNCIONARIO</th>                   
                    <th class="text-center" width="12%">VALOR</th>        
                    <th class="text-center">REALIZADO POR</th>     
                    <th></th>         
               </tr>
            </thead>         
            <tbody>
                @foreach($glicemias as $gli)
                    <tr>
                        <td>{{\Carbon\Carbon::parse($gli->created_at)->format('d/m/Y H:i:s')}}</td>
                        <td >{{$gli->funcionario->persona->nombrecompleto()}}</td>
                        <td class="text-center">{{$gli->valor}} mg/dl</td>
                        <td class="text-center">{{$gli->realizado}}</td>
                        <td class="text-center" style="width: 5%">
                            <a class="btn btn-warning" data-toggle="tooltip" href="{{route('hy-prueba.printf',$gli->id)}}" >
                                <i class="far fa-eye"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
         </table>
      </div>
   </div>
</div>


  <!-- The Modal Registrar-->
<div class="modal fade" id="modalRegistrar">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header bg-success">
          <h4 class="modal-title">Registrar Sub Grupo</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
        {!! Form::open(['route' => 'glicemia.store', 'class' => 'was-validated'])!!}

            <div class="input-group mb-2">
                <div class="input-group-prepend">
                <span class="input-group-text"><b>Funcionario</b></span>
                </div>
                <select class="form-control custom-select rounded-0" name="funcionario_id" id="funcionario_id" style="text-transform:uppercase" required>
                    <option value="">Seleccione un grupo..</option>
                    @foreach($funcionarios as $fun)
                        <option value="{{$fun->id}}">{{$fun->nombre}} {{$fun->apellidopaterno}} {{$fun->apellidomaterno}}</option>
                    @endforeach    
                </select>
                <div class="invalid-feedback">Debes Ingresar datos</div>
                <div class="valid-feedback">¡Se esta Ingresando Datos!</div>
            </div>

            <div class="input-group mb-2">
                <div class="input-group-prepend">
                <span class="input-group-text"><b>Valor</b></span>
                </div>
                <input type="text" id="valor" name="valor" onkeypress='return validaNumericos(event)' class="form-control" style="text-transform:uppercase" required>
                <div class="invalid-feedback">Debes Ingresar datos</div>
                <div class="valid-feedback">¡Se esta Ingresando Datos!</div>
            </div>

            <div class="input-group mb-2">
                <div class="input-group-prepend">
                    <span class="input-group-text"><b>Realizado Por:</b></span>
                </div>
                <select class="form-control custom-select rounded-0" name="realizado" required>
                    <option value="">Seleccione un ..</option>     
                    @foreach($registrado as $reg)  
                        <option value="{{$reg->nombre}} {{$reg->apellidopaterno}} {{$reg->apellidomaterno}}">{{$reg->nombre}} {{$reg->apellidopaterno}} {{$reg->apellidomaterno}}</option>
                    @endforeach  
                                  
                </select>
            </div>
        
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal" data-toggle="tooltip" title="Volver al Listado">Cancelar
          </button>
          <button type="submit" class="btn btn-success btn-sm" title="Continuar">Guardar
          </button>
        </div>
        {!! Form::close()!!} 
        
      </div>
    </div>
</div>

@endsection