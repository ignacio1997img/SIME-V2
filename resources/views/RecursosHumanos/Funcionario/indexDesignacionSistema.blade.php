@extends('Layout.HomeRecursosHumanos')
@section('content')


<div class="content-header">
  <div class="row mb-2">
    <div class="col-sm-6">
      <h1 class="m-0 text-dark"><i class="fas fa-cubes"></i> Designacion de Permisos Especiales</h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{route('recursoshumanos')}}">Home</a></li>   
        <li class="breadcrumb-item"><a href="{{route('funcionario.index')}}">funcionarios</a></li> 
        <li class="breadcrumb-item active">Asignacion</li>
      </ol>
    </div><!-- /.col -->
  </div><!-- /.row -->
</div>

<a class="btn btn-warning" data-toggle="tooltip" href="{{route('funcionario.index')}}" title="Volver al listado de usuarios">
  <i class="fas fa-arrow-alt-circle-left" ></i>
  Volver
</a>
<p>Funcionario: {{$funcionario->persona->nombrecompleto()}}</p>


<div class="container-fluid">
  <div class="row">
    <div class="col-5">
      <div class="card">
        <div class="card-header text-center bg-warning">
          <i class="far fa-check-square"></i>&nbsp;
          <b>Designaciones Por Asignar</b>
        </div>
        <div class="card-body" id="div1"> 
          {!! Form::model($funcionario, ['route' => ['funcionariodesignacionsi.update', $funcionario->id], 'method' => 'PUT']) !!}  
            <table class="table table-bordered table-hover table-striped table-sm" >
                <?php 
                  $ok=true;
                ?>

                @foreach($designacion as $des) 
                      @foreach($pivote as $piv)
                        @if($piv->designaciones_id == $des->id)
                          <?php 
                             $ok=false;
                          ?>
                        @endif
                      @endforeach 
                      
                      @if($ok== true)
                          <tr style="text-transform:uppercase">
                                      <td>
                                        &nbsp;{{Form::checkbox('dess[]', $des->id, null)}}
                                        &nbsp;{{$des->descripcion}}
                                      </td>
                          </tr>
                      @endif
                      <?php 
                        $ok=true;
                      ?>
                @endforeach
            </table>
        </div>
      </div>
    </div>
    <!-- BOTONES ---->
    <div class="col-2 text-center">
      <br><br><br><br><br><br><br>
      <div>
        @can('adm-usuario.asignarroles')
          <button class="btn btn-success" type="submit">
            <i class="far fa-check-circle"></i> 
            Actualizar
          </button>
        @endcan
      </div>
    </div>
    {!! Form::close() !!}
    <div class="col-5">
      <div class="card">
        <div class="card-header text-center bg-primary">
          <i class="far fa-list-alt"></i>&nbsp;
          <b>Designaciones Asignadas</b>
        </div>
        <div class="card-body"id="div1">
          
            <table class="table table-bordered table-hover table-striped table-sm" >
                @foreach($asignados as $asig)
                    <tr style="text-transform:uppercase">
                        <td>{{$asig->descripcion}} </td>
                        <td class="text-center">
                              <a class="btn-sm" data-toggle="modal" data-target="#deletedetalle" data-name="{{$asig->descripcion}}"   data-id={{$asig->id}}><i class="far fa-trash-alt" style="color: red;"></i></a>
                        </td>
                    </tr>
                @endforeach
            </table> 
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="deletedetalle" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
      <div class="modal-dialog" role="document">
            <div class="modal-content">
                  <div class="modal-header">
                        <h5 class="modal-title text-center">Estas seguro que deseas Eliminar la Designacion?</h5>
                  </div>
                  {!! Form::open(['route' => 'deletedetallecompra', 'method' => 'DELETE']) !!}
                  <div class="modal-body text-center">
                        <div class="text-center">
                              <i class="far fa-trash-alt" style="color: red; font-size: 5em;"></i>
                        </div>

                        {{ form::hidden('id', null, ['class' => 'form-control col-md-10', 'id' => 'id']) }}

                        <b><p id="idname" style="font-size: 20px;"></p></b>
                  </div>
                  <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal" data-toggle="tooltip" title="Volver al Detalle de Compra">Cancelar</button>
                        <button type="submit" class="btn btn-warning btn-sm" data-toggle="tooltip" title="Quitar del Detalle">Eliminar</button>
                  </div>
                  {!! Form::close()!!}
            </div>
      </div>
</div>


<script type="text/javascript">
$('#deletedetalle').on('show.bs.modal', function (event) {
var button = $(event.relatedTarget) //se realiza el evento
var id = button.data('id') // se extrae el dato de la propiedad
var detalle = button.data('name')
var modal = $(this)
modal.find('.modal-body #id').val(id)
modal.find('.modal-body #idname').text(detalle)
});
</script>


@endsection