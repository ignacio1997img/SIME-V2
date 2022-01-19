@extends('Layout.HomeAdministracion')
@section('content')



    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div>
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"><i class="far fa-object-group"></i>Sub Grupo Empresa</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('administracion')}}">Home</a></li>       
              <li class="breadcrumb-item active">Sub Grupo Empresa</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    
<div class="container" style="width: 80%">
   <div style="padding-bottom: 5px;">
      <a class="btn btn-warning" data-toggle="tooltip" href="" title="Volver al menu principal">
         <i class="fas fa-arrow-alt-circle-left" style="width:20; height:20;">
         </i>
         Volver
      </a>
      @can('adm-subgrupo.store')
        <a class="btn btn-success" data-toggle="modal" data-target="#modalRegistrar" title="Registrar Nuevo Sub Grupo">
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
               LISTA DE SUB GRUPO
               </h4>
            </th>
         </div>
      </div>
      <div class="card-body">
         <table class="table table-bordered table-hover table-sm" id="example2">
            <thead>
               <tr>
                  <th class="text-center" width="50">NRO</th>
                  <th class="text-center">GRUPO</th> 
                  <th class="text-center">SUB GRUPO</th>
                  @can('adm-subgrupo.update') 
                    <th class="text-center"></th>       
                  @endcan                      
               </tr>
            </thead>
            <?php $a = 1; ?>
            <tbody>
              @foreach($subgrupos as $sub)
                <tr style="text-transform:uppercase" class="text-center">
                  <td class="text-center">{{$a}}</td> 
                  <td>{{$sub->grupo->nombre}}</td> 
                  <td>{{$sub->descripcion}}</td> 
                  @can('adm-subgrupo.update')
                    <td style="width: 5%">
                      <a class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalEditar"
                        data-id="{{$sub->id}}" data-grupo="{{$sub->grupo->nombre}}" data-desc="{{$sub->descripcion}}" title="Editar Sub Srupo">
                        <i class="fas fa-edit"></i>
                      </a>
                    </td>
                  @endcan
                </tr>              
                <?php $a++; ?>
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
        {!! Form::open(['route' => 'subgrupo.store', 'class' => 'was-validated'])!!}

            <div class="input-group mb-2">
                <div class="input-group-prepend">
                <span class="input-group-text"><b>Grupo</b></span>
                </div>
                <select class="form-control custom-select rounded-0" name="grupo_id" id="grupo_id" style="text-transform:uppercase" required>
                <option value="">Seleccione un grupo..</option>
                @foreach($grupos as $grupo)
                    <option value="{{$grupo->id}}">{{$grupo->nombre}}</option>
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
            <h4 class="modal-title">Edita Sub Grupo<b></b></h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
            
        <!-- Modal body -->
        <div class="modal-body">
        {!! Form::open(['route' => 'adm-subgrupo.update','class' => 'was-validated']) !!}

            <input type="hidden" id="idempresa"  name="id">

            <h7 id="grupo"></h7>
            <div class="input-group mb-2">
                <div class="input-group-prepend">
                    <span class="input-group-text"><b>Grupo</b></span>
                </div>
                <select class="form-control custom-select rounded-0" id="nombre" name="grupo_id" style="text-transform:uppercase" required>
                    <option value="">Seleccione un grupo..</option>
                    @foreach($grupos as $grupo)
                        <option value="{{$grupo->id}}">{{$grupo->nombre}}</option>
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
  var grupo = button.data('grupo')

  var modal = $(this)

  modal.find('.modal-body #idempresa').val(id)
  modal.find('.modal-body #grupo').text(grupo)
  modal.find('.modal-body #desc').val(desc)

});
</script>
@endsection