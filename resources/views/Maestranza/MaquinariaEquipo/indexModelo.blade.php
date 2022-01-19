@extends('Layout.HomeMaestranza')
@section('content')



    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div>
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"><i class="far fa-object-group"></i> Modelo Vehiculo</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('maestranza')}}">Home</a></li>       
              <li class="breadcrumb-item active">Modelo Vehiculo</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    
<div class="container" style="width: 80%">
   <div style="padding-bottom: 5px;">
      <a class="btn btn-warning" data-toggle="tooltip" href="{{route('maestranza')}}" title="Volver al menu principal">
         <i class="fas fa-arrow-alt-circle-left" style="width:20; height:20;">
         </i>
         Volver
      </a>
      @can('ma-modelovehiculo.store')
        <a class="btn btn-success" data-toggle="modal" data-target="#modalRegistrar" title="Registrar modelo de vehiculo">
          <i class="fas fa-plus"></i>
          Registrar
        </a>
      @endcan
   </div>
   <div class="card table-responsive card-outline card-info">
      <div class="card-header">
         <div>
            <th>
               <h4 class="card-title text-center ">
               LISTA DE MODELO DE VEHICULO
               </h4>
            </th>
         </div>
      </div>
      <div class="card-body">
         <table class="table table-bordered table-hover table-sm" id="example2">
            <thead>
               <tr>
                  <th class="text-center" width="50">ID</th>
                  <th class="text-center">MARCA</th> 
                  <th class="text-center">MODELO</th>
                  @can('ma-modelovehiculo.update')
                    <th class="text-center"></th>        
                  @endcan                      
               </tr>
            </thead>
            <tbody>
              @foreach($modelos as $modelo)
                <tr style="text-transform:uppercase" class="text-center">
                    <td class="text-center">{{$modelo->id}}</td> 
                    <td>{{$modelo->marca->descripcion}}</td> 
                    <td>{{$modelo->descripcion}}</td> 
                    @can('ma-modelovehiculo.update')
                        <td style="width: 5%">
                        <a class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalEditar"
                            data-id="{{$modelo->id}}" data-marca="{{$modelo->marca->descripcion}}" data-desc="{{$modelo->descripcion}}" title="Editar modelo de vehiculo">
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
          <h4 class="modal-title">Registrar Modelo de Vehiculo</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
        {!! Form::open(['route' => 'modelo.store', 'class' => 'was-validated'])!!}

            <div class="input-group mb-2">
                <div class="input-group-prepend">
                <span class="input-group-text"><b>Marca</b></span>
                </div>
                <select class="form-control custom-select rounded-0" name="marca_id" id="marca_id" style="text-transform:uppercase" required>
                    <option value="">Seleccione una marca..</option>
                    @foreach($marcas as $marca)
                        <option value="{{$marca->id}}">{{$marca->descripcion}}</option>
                    @endforeach    
                </select>
                <div class="invalid-feedback">Debes Ingresar datos</div>
                <div class="valid-feedback">¡Se esta Ingresando Datos!</div>
            </div>

            <div class="input-group mb-2">
                <div class="input-group-prepend">
                <span class="input-group-text"><b>Nombre</b></span>
                </div>
                <input type="text" id="descripcion" name="descripcion" class="form-control" style="text-transform:uppercase" required>
                <div class="invalid-feedback">Debes Ingresar datos</div>
                <div class="valid-feedback">¡Se esta Ingresando Datos!</div>
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

  <!-- The Modal Editar-->
<div class="modal fade" id="modalEditar">
    <div class="modal-dialog">
        <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header bg-primary">
            <h4 class="modal-title">Edita Modelo de Vehiculo<b></b></h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
            
        <!-- Modal body -->
        <div class="modal-body">
        {!! Form::open(['route' => 'ma-modelovehiculo.update','class' => 'was-validated']) !!}

            <input type="hidden" id="marca_id"  name="id">

            <h7 id="marca" style="text-transform:uppercase"></h7>
            <div class="input-group mb-2">
                <div class="input-group-prepend">
                    <span class="input-group-text"><b>Marca</b></span>
                </div>
                <select class="form-control custom-select rounded-0" id="nombre" name="marca_id" style="text-transform:uppercase" required>
                    <option value="">Seleccione un grupo..</option>
                    @foreach($marcas as $marca)
                        <option value="{{$marca->id}}">{{$marca->descripcion}}</option>
                    @endforeach    
                </select>
                <div class="invalid-feedback">Debes Ingresar datos</div>
                <div class="valid-feedback">¡Se esta Ingresando Datos!</div>
            </div>

            <div class="input-group mb-2">
                <div class="input-group-prepend">
                    <span class="input-group-text"><b>Nombre</b></span>
                </div>
                <input type="text" id="desc" name="descripcion" class="form-control" style="text-transform:uppercase" required>
                <div class="invalid-feedback">Debes Ingresar datos</div>
                <div class="valid-feedback">¡Se esta Ingresando Datos!</div>
            </div>
            
        </div>        
            <!-- Modal footer -->
        <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal" data-toggle="tooltip" title="Volver al Listado">Cancelar
            </button>
            <button type="submit" class="btn btn-primary btn-sm" title="Continuar">Guardar
            </button>
        </div>
        {!! Form::close()!!}         
        </div>
    </div>
</div>



<script type="text/javascript">
$('#modalEditar').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) //captura valor del data-empresa=""

  var id = button.data('id')
  var desc = button.data('desc')
  var marca = button.data('marca')

  var modal = $(this)

  modal.find('.modal-body #marca_id').val(id)
  modal.find('.modal-body #marca').text(marca)
  modal.find('.modal-body #desc').val(desc)

});
</script>
@endsection