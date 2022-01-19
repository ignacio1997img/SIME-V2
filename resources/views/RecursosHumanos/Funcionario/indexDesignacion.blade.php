@extends('Layout.HomeRecursosHumanos')
@section('content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div>
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"><i class="fas fa-paste"></i> Designacion</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('recursoshumanos')}}">Home</a></li>    
              <li class="breadcrumb-item"><a href="{{route('funcionario.index')}}">Funcionario</a></li> 
              <li class="breadcrumb-item active">Designacion</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <div style="padding-bottom: 5px;">
        <a class="btn btn-warning" data-toggle="tooltip" href="{{ route('funcionario.index') }}" title="Volver al Listado"><i
            class="fas fa-arrow-alt-circle-left"></i> Volver
        </a> 
        @can('rrhh-funcionario.designacion.store') 
            <a href="#" class="btn btn-success" data-toggle="modal" data-target="#modalRegistrar">
                Registar
            </a>  
        @endcan
    </div>

    <div class="card card-outline card-info">
        <div class="card-header">
            <div class="input-group mb-2" Style="width: 15%">               
                <div class="input-group-prepend">
                    <span class="input-group-text"><b>ID</b></span>
                </div>
                <input type="text" class="form-control" value="{{$funcionarios[0]->id}}" disabled>            
            </div> 
            <div class="row">
                <div class="col-6">
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><b>Nombre</b></span>
                        </div>
                        <input type="text" class="form-control" value="{{$funcionarios[0]->nombre}} {{$funcionarios[0]->apellidopaterno}} {{$funcionarios[0]->apellidomaterno}} " style="text-transform:uppercase" disabled>
                    </div>
                </div>
                <div class="col-6">
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><b>Cargo</b></span>
                        </div>
                        <input type="text" class="form-control" value="{{$funcionarios[0]->cargo}}" style="text-transform:uppercase" disabled>
                    </div>
                </div>    
            </div>


        </div>
        <div class="card-body" id="div1">
            <div class="container text-center">
                <div class="bg-warning">
                    <h5>DESIGNACIONES</h5>
                </div>
                <table class="table table-bordered table-striped" >
                    <thead>
                        <tr>
                            <th class="text-center" width="4%">ID</th> 
                            <th class="text-center" width="20%">NOMBRE</th>                  
                            <th class="text-center" width="20%">DOCUMENTO</th> 
                            <th class="text-center" width="5%">INICIO</th>
                            <th class="text-center" width="5%">CORTE</th>  
                            <th class="text-center" width="5%">FIN</th>
                            <th class="text-center" width="10%">ESTADO</th>   
                            <th class="text-center" width="30%">OBSERVACION</th>                                               
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($listas as $lista)
                            <tr style="text-transform:uppercase">
                                <td><font size=2>{{$lista->id}}</font></td>
                                <td><font size=2>{{$lista->nombre}}</font></td>
                                <td><font size=2>{{$lista->documento}}</font></td>
                                <td><font size=2>{{\Carbon\Carbon::parse($lista->inicio)->format('d/m/Y')}}</font></td>
                                <td><font size=2>
                                    @if($lista->fins != null)
                                        {{\Carbon\Carbon::parse($lista->fins)->format('d/m/Y')}}
                                    @endif
                                </font></td>
                                <td><font size=2>{{\Carbon\Carbon::parse($lista->fin)->format('d/m/Y')}}</font></td>
                                <td><font size=2>
                                    @if($lista->activo == 1)
                                        <span>Activo</span>
                                    @else
                                        <span>Inactivo</span>
                                    @endif
                                </font></td>
                                <td><font size=2>{{$lista->observacion}}</font>

                                @can('rrhh-funcionario.designacioncorte')
                                   <font size=2>
                                        @if($lista->activo == 1)
                                            <button type="button" data-toggle="modal" data-target="#modalFinalizar" class="btn btn-danger btn-sm" data-id="{{$lista->id}}">
                                                Corte
                                            </button>                                        
                                        @endif
                                    </font></td>
                                @endcan
                            </tr>
                        @endforeach   
                                       
                    </tbody>
                </table> 
            </div>
        </div>  
    </div>



<!-- The Modal Registrar-->
<div class="modal" id="modalRegistrar">
    <div class="modal-dialog modal-dialog-scrollable">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header bg-success">
          <h4 class="modal-title">Registrar Designacion</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
        {!! Form::open(['route' => 'designacion.store', 'class' => 'was-validated'])!!}
            <input type="hidden"  name="funcionario_id" value="{{$funcionarios[0]->id}}" >
                
            <div class="input-group mb-2">
                <div class="input-group-prepend">
                    <span class="input-group-text"><b>Nombre</b></span>
                </div>
                <input type="text" class="form-control" id="nombre"  name="nombre" style="text-transform:uppercase" required>
                <div class="invalid-feedback">Debes Ingresar datos</div>
                <div class="valid-feedback">¡Se esta Ingresando Datos!</div>
            </div>
            <div class="input-group mb-2">
                <div class="input-group-prepend">
                    <span class="input-group-text"><b>Documento</b></span>
                </div>
                <input type="text" class="form-control" id="documento"  name="documento" style="text-transform:uppercase" required>
                <div class="invalid-feedback">Debes Ingresar datos</div>
                <div class="valid-feedback">¡Se esta Ingresando Datos!</div>
            </div>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><b>Inicio</b></span>
                </div>
                <input type="date" class="form-control" id="inicio"  name="inicio" required>
                <div class="invalid-feedback">Debes Ingresar datos</div>
                <div class="valid-feedback">¡Se esta Ingresando Datos!</div>
            </div>

            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><b>Fin</b></span>
                </div>
                <input type="date" class="form-control" id="fin"  name="fin" required>
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


<div class="modal fade" id="modalFinalizar">
    <div class="modal-dialog modal-dialog-scrollable">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header bg-danger">
          <h4 class="modal-title">Finalizar Designación</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
        {!! Form::open(['route' => 'rrhh-funcionario.designacioncorte', 'class' => 'was-validated'])!!}
            <input type="hidden" name="funcionario_id" value="{{$funcionarios[0]->id}}">
            <input type="hidden" name="id" id="id">
            <div class="input-group" style="padding: 10px;">
                <div class="input-group-prepend">
                    <span class="input-group-text"><b>Corte</b></span>
                </div>
                <input type="date" class="form-control" id="fins"  name="fins" required>
                <div class="invalid-feedback">Debes Ingresar datos</div>
                <div class="valid-feedback">¡Se esta Ingresando Datos!</div>
            </div>
            <div class="input-group mb-2" style="padding: 10px;">
                <div class="input-group-prepend">
                    <span class="input-group-text"><b>Observacion</b></span>
                </div>
                <textarea class="form-control" rows="3" name="observacion" id="observacion" style="text-transform:uppercase" required></textarea>
                <div class="invalid-feedback">Debes Ingresar datos</div>
                <div class="valid-feedback">¡Se esta Ingresando Datos!</div>
            </div> 

          
        
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer justify-content-between">
          <button type="button text-left" class="btn btn-secondary btn-sm" data-dismiss="modal" data-toggle="tooltip" title="Volver al Listado">Cancelar
          </button>
          <button type="submit" class="btn btn-danger btn-sm" title="Continuar">
          Guardar
        </button>
        </div>
        {!! Form::close()!!} 
        
      </div>
    </div>
</div>


<script type="text/javascript">
    $('#modalFinalizar').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget)
        var id = button.data('id')   

        var modal = $(this)
        modal.find('.modal-body #id').val(id)
    });
    
  </script>


@endsection