@extends('Layout.HomeAseoUrbano')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div>
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"><i class="fas fa-map-marked-alt"></i> Zonas</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('aseourbano')}}">Home</a></li>       
              <li class="breadcrumb-item active">Zonas</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    
<div class="container">
   <div style="padding-bottom: 5px;">
      <a class="btn btn-warning" data-toggle="tooltip" href="" title="Volver al menu principal">
         <i class="fas fa-arrow-alt-circle-left" style="width:20; height:20;"></i>
         Volver
      </a>
      @can('au-zonas.store')
        <a class="btn btn-success" data-toggle="modal" data-target="#modalRegistrar" title="Registrar Nuevo Grupo">
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
               LISTA DE ZONAS
               </h4>
            </th>
         </div>
      </div>
      <div class="card-body" >
         <table class="table table-bordered table-hover table-sm" id="example2">
            <thead>
               <tr>
                  <th class="text-center" width="50">ID</th>
                  <th class="text-center">NOMBRE</th> 
                  <th class="text-center">FRECUENCIA</th>                             
               </tr>
            </thead>
            <tbody>
              @foreach($zonas as $zona)
                <tr style="text-transform:uppercase">
                    <td class="text-center">{{$zona->id}}</td> 
                    <td class="text-center">{{$zona->nombre}}</td>
                    <?php 
                        $aux = '';
                        $cadena='';
                    ?>
                  @foreach($zonadia as $zd)   
                    @if($zona->id == $zd->id)      
                        <?php 
                            $aux =$aux.' '.$zd->nombre.' - ';
                        ?>
                        
                    @endif                    
                  @endforeach
                  <?php 
                    for($i=0; $i< (strlen($aux)-2); $i++)
                    {
                        $cadena = $cadena.$aux[$i];
                    }
                  ?>
                  <td >{{$cadena}}</td>
                    <!-- <td class="text-center" style="width: 5%">
                      <a class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalEditar"  title="Editar Grupo">
                        <i class="fas fa-edit"></i>
                      </a>
                    </td> -->
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
          <h4 class="modal-title">Registrar Zona</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
        {!! Form::open(['route' => 'zona.store', 'class' => 'was-validated'])!!}

            <div class="input-group mb-2">
                <div class="input-group-prepend">
                    <span class="input-group-text"><b>Nombre</b></span>
                </div>
                <input type="text" id="nombre" name="nombre" class="form-control" style="text-transform:uppercase" required>
                <div class="invalid-feedback">Debes Ingresar datos</div>
                <div class="valid-feedback">¡Se esta Ingresando Datos!</div>
            </div>

            <h3>LISTA DE DIAS</h3>
            <div class="form-group">
                <ul class="list-unstyled">
                    <div class="row">
                        @foreach($dias as $dia)
                            <div class="col-md-3">
                                <li>
                                    <label>
                                        {{Form::checkbox('dias[]', $dia->id, null)}}
                                        {{$dia->nombre}}
                                    </label>
                                </li>
                            </div>
                        @endforeach
                    </div>
                </ul>
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
        <h4 class="modal-title">Editar Grupo</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
        
      <!-- Modal body -->
      <div class="modal-body">
      {!! Form::open(['route' => 'adm-grupoempresa.update','class' => 'was-validated']) !!}

        <input type="hidden" id="idempresa"  name="id">

        <div class="input-group mb-2">
          <div class="input-group-prepend">
            <span class="input-group-text"><b>Nombre</b></span>
          </div>
          <input type="text" id="nombreempresa" name="nombre" class="form-control" style="text-transform:uppercase" required>
          <div class="invalid-feedback">Debes Ingresar datos</div>
          <div class="valid-feedback">¡Se esta Ingresando Datos!</div>
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

  modal.find('.modal-body #idempresa').val(id)
  modal.find('.modal-body #nombreempresa').val(nombre)

});
</script>
@endsection