@extends('Layout.HomeMaestranza')
@section('content')
<div class="content-header">
    <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"><i class="fab fa-medium-m"></i>  Marcas</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('maestranza')}}">Home</a></li>       
              <li class="breadcrumb-item active">Marcas</li>
            </ol>
          </div><!-- /.col -->
    </div><!-- /.row -->
</div>


<div class="container" style="width: 70%">
   <div style="padding-bottom: 5px;">
      <a class="btn btn-warning" data-toggle="tooltip" href="{{route('maestranza')}}" title="Volver al menu principal">
         <i class="fas fa-arrow-alt-circle-left" style="width:20; height:20;"></i>
         Volver
      </a>
      @can('ma-marca.store')
        <a class="btn btn-success" data-toggle="modal" data-target="#modalRegistrar" title="Registrar Nuevo Grupo">
          <i class="fas fa-plus">
          </i>
          Registrar
        </a>
      @endcan
   </div>
   <div class="card table-responsive card-outline card-info">
      <div class="card-header">
         <div>
            <th>
               <h4 class="card-title text-center ">
               LISTA DE MARCAS
               </h4>
            </th>
         </div>
      </div>
      <div class="card-body">
         <table class="table table-bordered table-hover table-sm" id="example2">
            <thead>
               <tr>
                    <th class="text-center" width="50">ID</th>
                    <th class="text-center">NOMBRE</th> 
                    @can('ma-marca.update')
                        <th class="text-center"></th> 
                    @endcan            
               </tr>
            </thead>          
            <tbody>
                @foreach($marcas as $marca)
                    <tr style="text-transform:uppercase">
                        <td class="text-center">{{$marca->id}}</td> 
                        <td class="text-center">{{$marca->descripcion}}</td>
                        @can('ma-marca.update')
                            <td class="text-center" style="width: 5%">
                                <a class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalEditar" data-id="{{$marca->id}}" data-nombre="{{$marca->descripcion}}" title="Editar Grupo">
                                <i class="fas fa-edit"></i>
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

  <!-- The Modal Registrar-->
<div class="modal fade" id="modalRegistrar">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header bg-success">
          <h4 class="modal-title">Registrar Marca</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
        {!! Form::open(['route' => 'marca.store', 'class' => 'was-validated'])!!}

          <div class="input-group mb-2">
            <div class="input-group-prepend">
              <span class="input-group-text"><b>Nombre</b></span>
            </div>
            <input type="text" id="descripcion" name="descripcion" class="form-control" style="text-transform:uppercase" required>
            <div class="invalid-feedback">Debes Ingresar datos</div>
            <div class="valid-feedback">??Se esta Ingresando Datos!</div>
          </div>
        
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer justify-content-between">
          <button type="button text-left" class="btn btn-secondary btn-sm" data-dismiss="modal" data-toggle="tooltip" title="Volver al Listado">Cancelar
          </button>
          <button type="submit" class="btn btn-success btn-sm" title="Continuar">
          Guardar
        </button>
        </div>
        {!! Form::close()!!} 
        
      </div>
    </div>
</div>


  <!-- The Modal Editar-->
<div class="modal fade" id="modalEditar">
  <div class="modal-dialog">
    <div class="modal-content">
      <!-- Modal Header -->
      <div class="modal-header bg-primary">
        <h4 class="modal-title">Editar Marca</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
        
      <!-- Modal body -->
      <div class="modal-body">
      {!! Form::open(['route' => 'ma-marca.update','class' => 'was-validated']) !!}

        <input type="hidden" id="idmarca"  name="id">

        <div class="input-group mb-2">
          <div class="input-group-prepend">
            <span class="input-group-text"><b>Nombre</b></span>
          </div>
          <input type="text" id="marca" name="descripcion" class="form-control" style="text-transform:uppercase" required>
          <div class="invalid-feedback">Debes Ingresar datos</div>
          <div class="valid-feedback">??Se esta Ingresando Datos!</div>
        </div>
        
      </div>        
        <!-- Modal footer -->
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal" data-toggle="tooltip" title="Volver al Listado">Cancelar</button>
        <button type="submit" class="btn btn-primary btn-sm" title="Continuar">Guardar</button>
      </div>
      {!! Form::close()!!}         
    </div>
  </div>
</div>



<script type="text/javascript">
$('#modalEditar').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) //captura valor del data-empresa=""

  var id = button.data('id')
  var nombre = button.data('nombre')

  var modal = $(this)

  modal.find('.modal-body #idmarca').val(id)
  modal.find('.modal-body #marca').val(nombre)

});
</script>

    @endsection