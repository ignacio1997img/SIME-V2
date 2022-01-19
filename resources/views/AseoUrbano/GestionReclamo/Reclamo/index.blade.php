@extends('Layout.HomeAseoUrbano')
@section('content')
    <!-- ENCABEZADO DE LA PAGINA -->
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div>
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"><i class="fas fa-phone-volume"></i> Reclamos</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('aseourbano')}}">Aseo Urbano</a></li>
                        <li class="breadcrumb-item active">Reclamos</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <body>


        <div class="card-header">
          <div class="row">
            <div class="col-10">
  
              <!-- HOJA DEL TAB -->
              <div class="container mt-3">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#novisto"><b><i class="fas fa-eye-slash"></i> No Visto @if($pendiente->count() >= 1 ) <span class="badge badge-warning badge-pill">{{$pendiente->count()}}</span> @endif </b></a>
                    </li>
                    
                    <li class="nav-item">
                        {{-- <a class="nav-link" data-toggle="tab" href="#retrazado"><b><i class="fas fa-stopwatch"></i> Retrasados @if($retrazados->count() >= 1 ) <span class="badge badge-danger badge-pill">{{$retrazados->count()}}</span> @endif </b></a> --}}
                    </li>
                    <li class="nav-item">                    
                        <a class="nav-link" data-toggle="tab" href="#pendiente"> <b><i class="fas fa-business-time"></i> Pendientes @if($pendientesi->count() >= 1 ) <span class="badge badge-warning badge-pill">{{$pendientesi->count()}}</span> @endif </b></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#realizado"><b><i class="fas fa-sync-alt"></i> Realizados</b></a>
                    </li>
                </ul>
              </div>
  
            </div>
            @can('au-reclamos.store')
                <div class="col-2">
                    <div class="dropdown dropleft float-right">
                        <a class="btn btn-success" data-toggle="tooltip" href="{{route ('reclamo.create') }}"  title="Nuevo Reclamo">
                            <i class="fas fa-plus"></i>
                            Registrar
                        </a>
                    </div>              
                </div>
            @endcan
          </div> 
        </div>
  
  
  
          
          <!-- CONTENIDO DEL TAB -->
        <div class="tab-content">
            @include('AseoUrbano.GestionReclamo.Reclamo.Includes_tabs.NoVisto')

            <!--                INDEX PENDIENTE           -->
            {{-- @include('AseoUrbano.GestionReclamo.Reclamo.Includes_tabs.Retrazado') --}}
            @include('AseoUrbano.GestionReclamo.Reclamo.Includes_tabs.Pendiente')
            @include('AseoUrbano.GestionReclamo.Reclamo.Includes_tabs.Realizado')
    
        
        </div>
      </body>

 

  <!-- The Modal Registrar-->
<div class="modal hide fade in" data-keyboard="false" data-backdrop="static" id="modalRegistrar">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header bg-success">
          <h4 class="modal-title"><i class="fas fa-phone-volume"></i> Registrar Reclamo</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
        {!! Form::open(['route' => 'reclamo.store', 'class' => 'was-validated'])!!}
                <div class="input-group mb-2">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><b>Fecha</b></span>
                    </div>
                    <input type="datetime-local" class="form-control"  name="fechareclamo" required>
                    <div class="invalid-feedback">Debes Ingresar datos</div>
                    <div class="valid-feedback">¡Se esta Ingresando Datos!</div>
                </div>

                <div class="input-group mb-2">
                    <div class="input-group-prepend">
                    <span class="input-group-text"><b>Barrio</b></span>
                    </div>
                    <select class="form-control select2bs4" id="barrio" style="text-transform:uppercase" required>
                    <option value="">Seleccione un barrio..</option>
                        @foreach ($barrios as $barrio)
                            <option value="{{$barrio->id}}">{{$barrio->descripcion}}</option>
                        @endforeach                         
                    </select>
                    <div class="invalid-feedback">Debes Ingresar datos</div>
                    <div class="valid-feedback">¡Se esta Ingresando Datos!</div>
                </div>
                <div class="input-group mb-2">
                    <div class="input-group-prepend">
                    <span class="input-group-text"><b>Calle</b></span>
                    </div>
                    <select class="form-control custom-select" id="calle" name="calle_id" style="text-transform:uppercase" required>
                
                    </select>
                    <div class="invalid-feedback">Debes Ingresar datos</div>
                    <div class="valid-feedback">¡Se esta Ingresando Datos!</div>
                </div>

                <div class="input-group mb-2">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><b>Contacto</b></span>
                    </div>
                    <select class="form-control select2bs4" name="contacto_id" id="contacto_id" style="text-transform:uppercase" required>
                        <option value="">Seleccione un contacto..</option>
                            @foreach ($contactos as $con)
                                <option value="{{$con->id}}">{{$con->nombrecompleto}}</option>
                            @endforeach                         
                    </select>
                    <div class="invalid-feedback">Debes Ingresar datos</div>
                    <div class="valid-feedback">¡Se esta Ingresando Datos!</div>
                </div>      
                <div class="input-group mb-2">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><b>Descripcion</b></span>
                    </div>
                    <textarea class="form-control" rows="3" name="descripcion" id="descripcion" style="text-transform:uppercase" maxlength="500" required></textarea>
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


<div class="modal hide fade in" data-keyboard="false" data-backdrop="static" id="modalReiteracion">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header bg-danger">
          <h4 class="modal-title"><i class="fas fa-phone-volume"></i> Reiteración de Reclamo</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
        {!! Form::open(['route' => 'reiteracion.store', 'class' => 'was-validated'])!!}
                <input type="hidden" id="reclamo_id" name="reclamo_id">
                <div class="input-group mb-2">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><b>Observación</b></span>
                    </div>
                    <textarea class="form-control" rows="2" name="observacion" id="observacion" style="text-transform:uppercase" maxlength="500" required></textarea>
                    <div class="invalid-feedback">Debes Ingresar datos</div>
                    <div class="valid-feedback">¡Se esta Ingresando Datos!</div>
                </div>  
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal" data-toggle="tooltip" title="Volver al Listado">Cancelar
          </button>
          <button type="submit" class="btn btn-danger btn-sm" title="Continuar">Guardar
          </button>
        </div>
        {!! Form::close()!!} 
        
      </div>
    </div>
</div>


<script type="text/javascript">
    // $('#barrio').on('change', function (event) {
    //     barrio =  $(this).val(); 
    //     alert(barrio)
    // });

    $(function()
    {
        $('#barrio').on('change', onselect_barrio);
    });

    function onselect_barrio()
    {
        barrio =  $(this).val(); 
          $.get('{{route('selecreclamocalle')}}/'+barrio, function(data){
            var html_calle=    '<option value="">Seleccione una calle..</option>'
                for(var i=0; i<data.length; ++i)
                html_calle += '<option value="'+data[i].id+'">'+data[i].calle+'</option>'

            $('#calle').html(html_calle);;            
          });
    }


    $('#modalReiteracion').on('show.bs.modal', function (event) {
            // $('#formreiteracion').trigger('reset');
            var button     = $(event.relatedTarget) //se realiza el evento
            var reclamo = button.data('reclamo')

            var modal = $(this)
            modal.find('.modal-body #reclamo_id').val(reclamo)


            // $('#formcontacto').trigger('reset');
            //     var button     = $(event.relatedTarget)
            //     var fecha     = $('#fechareclamo').val();
            //     var tipo   = $('#mensaje_id').val();
            //     var barrio   = $('#barrio_id').val();
            //     var descripcion = $('#descripcion').val();
            //     var modal = $(this)
            //     modal.find('.modal-body #fechareclamo').val(fecha)
            //     modal.find('.modal-body #mensaje_id').val(tipo)
            //     modal.find('.modal-body #barrio_id').val(barrio)
            //     modal.find('.modal-body #descripcion').val(descripcion)
        });
    
</script>
   



@endsection
