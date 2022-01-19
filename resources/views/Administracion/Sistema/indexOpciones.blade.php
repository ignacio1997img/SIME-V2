@extends('Layout.HomeAdministracion')
@section('content')



    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div>
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"><i class="fas fa-cubes"></i> Opciones</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('administracion')}}">Home</a></li>       
              <li class="breadcrumb-item active">Opciones del Sistema</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    
<div class="container" style="width: 800px;">
   <div style="padding-bottom: 5px;">
      <a class="btn btn-warning" data-toggle="tooltip" href="" title="Volver al menu principal">
         <i class="fas fa-arrow-alt-circle-left" style="width:20; height:20;">
         </i>
         Volver
      </a>
      @can('adm-opcion.store')
        <a class="btn btn-success" data-toggle="modal" data-target="#modalRegistrar" title="Nuevo Registro">
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
               LISTA DE OPCIONES DEL SISTEMA
               </h4>
            </th>
         </div>
      </div>
      <div class="card-body">
         <table class="table table-bordered table-hover table-sm" id="example2">
            <thead>
               <tr>
                  <th class="text-center" width="50">NRO</th>
                  <th class="text-center">MODULO</th> 
                  <th class="text-center">OPCIONES</th> 
                  @can('adm-opcion.update')
                    <th class="text-center"></th>    
                  @endcan                         
               </tr>
            </thead>
            <tbody>
                @foreach($opciones as $opcion)
                    <tr style="text-transform:uppercase">
                        <td  class="text-center">{{$opcion->id}}</td>
                        <td>{{$opcion->modulo->nombre}}</td>
                        <td>{{$opcion->descripcion}}</td>
                        @can('adm-opcion.update')
                          <td class="text-center" style="width: 5%">
                              <a class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalEditar"
                                  data-id="{{$opcion->id}}" data-modulo="{{$opcion->modulo->nombre}}" data-desc="{{$opcion->descripcion}}"><i class="fas fa-edit"></i>
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
          <h4 class="modal-title">registar Opciones</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
        {!! Form::open(['route' => 'opciones.store', 'class' => 'was-validated'])!!}

            <div class="input-group mb-2">
                <div class="input-group-prepend">
                <span class="input-group-text"><b>Modulo</b></span>
                </div>
                <select class="form-control custom-select rounded-0" name="modulo_id" id="modulo_id" style="text-transform:uppercase" required>
                    <option value="">Seleccione un modulo..</option>
                    @foreach($modulos as $modulo)                    
                        <option value="{{$modulo->id}}">{{$modulo->nombre}}</option>
                    @endforeach
                </select>
                <div class="invalid-feedback">Debes Ingresar datos</div>
                <div class="valid-feedback">¡Se esta Ingresando Datos!</div>
            </div>

            <div class="input-group mb-2">
                <div class="input-group-prepend">
                <span class="input-group-text"><b>Descripcion</b></span>
                </div>
                <input type="text" id="descripcion" name="descripcion" class="form-control" style="text-transform:uppercase" required>
                <div class="invalid-feedback">Debes Ingresar datos</div>
                <div class="valid-feedback">¡Se esta Ingresando Datos!</div>
            </div>
        
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal" data-toggle="tooltip"
            title="Volver al Listado">Cancelar
          </button>
          <button type="submit" class="btn btn-success btn-sm" data-toggle="tooltip" title="Continuar">
            Guardar
          </button>
        </div>
        {!! Form::close()!!} 
        
      </div>
    </div>
</div>


  <!-- The Modal editar-->
  <div class="modal fade" id="modalEditar">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header bg-primary">
          <h4 class="modal-title">Editar Opciones</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
        {!! Form::open(['route' => 'adm-opcion.update', 'class' => 'was-validated'])!!}

            <input type="hidden" id="id" name="id">
            <h7 id="modulo"></h7>
            <div class="input-group mb-2">
                <div class="input-group-prepend">
                <span class="input-group-text"><b> Modulo</b></span>
                </div>
                <select class="form-control custom-select rounded-0" name="modulo_id" id="modulo_id" style="text-transform:uppercase" required>
                    <option value="">Seleccione un modulo..</option>
                    @foreach($modulos as $modulo)                    
                        <option value="{{$modulo->id}}">{{$modulo->nombre}}</option>
                    @endforeach
                </select>
                <div class="invalid-feedback">Debes Ingresar datos</div>
                <div class="valid-feedback">¡Se esta Ingresando Datos!</div>
            </div>

            <div class="input-group mb-2">
                <div class="input-group-prepend">
                <span class="input-group-text"><b>Descripcion</b></span>
                </div>
                <input type="text" id="desc" name="descripcion" class="form-control" style="text-transform:uppercase" required>
                <div class="invalid-feedback">Debes Ingresar datos</div>
                <div class="valid-feedback">¡Se esta Ingresando Datos!</div>
            </div>
        
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal" data-toggle="tooltip"
            title="Volver al Listado">Cancelar
          </button>
          <button type="submit" class="btn btn-primary btn-sm" data-toggle="tooltip" title="Continuar">
            Guardar
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
  var modulo =button.data('modulo')

  var modal = $(this)

  modal.find('.modal-body #id').val(id)
  modal.find('.modal-body #desc').val(desc)
  modal.find('.modal-body #modulo').text(modulo)

});
</script>
@endsection