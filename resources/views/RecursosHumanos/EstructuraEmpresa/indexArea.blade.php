@extends('Layout.HomeRecursosHumanos')
@section('content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div>
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"><i class="fas fa-sitemap"></i> Areas</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('recursoshumanos')}}">Home</a></li>       
              <li class="breadcrumb-item active">Areas</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    
<div class="container">
   <div style="padding-bottom: 5px;">
      <a class="btn btn-warning" data-toggle="tooltip" href="" title="Volver al menu principal">
         <i class="fas fa-arrow-alt-circle-left" style="width:20; height:20;">
         </i>
         Volver
      </a>
      @can('rrhh-area.store')
        <a class="btn btn-success" data-toggle="modal" data-target="#modalRegistrar" title="Registrar Area">
          <i class="fas fa-plus"></i>Registrar
        </a>
      @endcan
   </div>
   <div class="card table-responsive card-outline card-info">
      <div class="card-header">
         <div>
            <th>
               <h4 class="card-title text-center ">
               LISTA DE AREAS
               </h4>
            </th>
         </div>
      </div>
      <div class="card-body">
         <table class="table table-bordered table-hover table-sm" id="example2">
            <thead>
               <tr>
                  <th class="text-center" width="50">NRO</th>
                  <th class="text-center">EMPRESA</th> 
                  <th class="text-center">DESCRIPCION</th> 
                  @can('rrhh-area.update')
                    <th class="text-center"></th> 
                  @endcan                            
               </tr>
            </thead>
            <tbody>
              @foreach($areas as $area)
                <tr style="text-transform:uppercase">
                  <td class="text-center">{{$area->id}}</td> 
                  <td class="text-center">{{$area->empresa->razonsocial}}</td> 
                  <td class="text-center">{{$area->descripcion}}</td> 
                  @can('rrhh-area.update')
                    <td class="text-center" style="width: 5%">
                      <a class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalEditar"
                        data-id="{{$area->id}}" data-empresa="{{$area->empresa->razonsocial}}" data-desc="{{$area->descripcion}}" title="Editar Area">
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
          <h4 class="modal-title">Registrar Area</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
        {!! Form::open(['route' => 'area.store', 'class' => 'was-validated'])!!}

            <div class="input-group mb-2">
                <div class="input-group-prepend">
                <span class="input-group-text"><b>Empresa</b></span>
                </div>
                <select class="form-control custom-select rounded-0" name="empresa_id" id="empresa_id" required>
                <option value="">Seleccione una Empresa..</option>
                @foreach($empresas as $empresa)
                    <option style="text-transform:uppercase" value="{{$empresa->id}}">{{$empresa->razonsocial}}</option>
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

  <!-- The Modal Editar-->
<div class="modal fade" id="modalEditar">
    <div class="modal-dialog">
        <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header bg-primary">
            <h4 class="modal-title">Edita Area</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
            
        <!-- Modal body -->
        <div class="modal-body">
        {!! Form::open(['route' => 'rrhh-area.update','class' => 'was-validated']) !!}

            <input type="hidden" id="id"  name="id">

            <h7 id="empresa"></h7>
            <div class="input-group mb-2">
                <div class="input-group-prepend">
                    <span class="input-group-text"><b>Empresa</b></span>
                </div>
                <select class="form-control custom-select rounded-0"  name="empresa_id"  required>
                  <option value="">Seleccione una Empresa..</option>
                  @foreach($empresas as $empresa)
                    <option style="text-transform:uppercase" value="{{$empresa->id}}">{{$empresa->razonsocial}}</option>
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
  var empresa = button.data('empresa')

  var modal = $(this)

  modal.find('.modal-body #id').val(id)
  modal.find('.modal-body #desc').val(desc)
  modal.find('.modal-body #empresa').text(empresa)

});
</script>
@endsection