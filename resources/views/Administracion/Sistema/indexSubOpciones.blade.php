@extends('Layout.HomeAdministracion')
@section('content')



    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div>
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"><i class="fas fa-cubes"></i> Sub Opciones</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('administracion')}}">Home</a></li>       
              <li class="breadcrumb-item active">Sub Opciones</li>
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
      @can('adm-subopcion.store')
        <a class="btn btn-success" data-toggle="modal" data-target="#modalRegistrar" title="Registrar Subopciones">
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
               LISTA DE SUB OPCIONES
               </h4>
            </th>
         </div>
      </div>
      <div class="card-body">
         <table class="table table-bordered table-hover table-sm" id="example2">
            <thead>
               <tr>
                  <th class="text-center" width="50">ID</th>
                  <th class="text-center">MODULOS</th> 
                  <th class="text-center">OPCIONES</th> 
                  <th class="text-center">DESCRIPCION</th> 
                  @can('adm-subopcion.update')
                    <th class="text-center"></th>          
                  @endcan                   
               </tr>
            </thead>
            <tbody>
              @foreach($subs as $sub)
              <tr style="text-transform:uppercase">
                <td class="text-center">{{$sub->id}}</td> 
                <td class="text-center">{{$sub->opcion->modulo->nombre}}</td>
                <td class="text-center">{{$sub->opcion->descripcion}}</td>
                <td class="text-center">{{$sub->descripcion}}</td> 
                @can('adm-subopcion.update')
                  <td class="text-center" style="width: 5%">
                    <a class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalEditar"
                      data-id="{{$sub->id}}" data-modulo="{{$sub->opcion->modulo->nombre}}" data-opcion="{{$sub->opcion->descripcion}}" data-nombre="{{$sub->descripcion}}" ><i class="fas fa-edit"></i>
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
          <h4 class="modal-title">Registrar Sub Opciones</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
        {!! Form::open(['route' => 'subopciones.store', 'class' => 'was-validated'])!!}

            <div class="input-group mb-2">
                <div class="input-group-prepend">
                <span class="input-group-text"><b>Modulos</b></span></span>
                </div>
                <select class="form-control custom-select rounded-0" id="modulo" style="text-transform:uppercase" required>
                  <option value="">Seleccione un Modulo..</option>
                  @foreach($modulos as $modulo)
                      <option value="{{$modulo->id}}">{{$modulo->nombre}}</option>
                  @endforeach    
                </select>
                <div class="invalid-feedback">Debes Ingresar datos</div>
                <div class="valid-feedback">¡Se esta Ingresando Datos!</div>
            </div>

            <div class="input-group mb-2">
                <div class="input-group-prepend">
                    <span class="input-group-text"><b>Opciones</b></span>
                </div>
                <select class="form-control custom-select rounded-0" name="opciones_id" id="opciones" style="text-transform:uppercase" required>
                
                
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

  <!-- The Modal Editar-->
  <div class="modal fade" id="modalEditar">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header bg-primary">
          <h4 class="modal-title">Editar Sub Opciones</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
        {!! Form::open(['route' => 'adm-subopcion.update', 'class' => 'was-validated'])!!}

            <input type="hidden" name="id" id="idd">

            <h7 id="modulod"></h7>
            <div class="input-group mb-2">
                <div class="input-group-prepend">
                <span class="input-group-text"><b>Modulos</b></span></span>
                </div>
                <select class="form-control custom-select rounded-0" id="modulos" style="text-transform:uppercase" required>
                  <option value="">Seleccione un Modulo..</option>
                  @foreach($modulos as $modulo)
                      <option value="{{$modulo->id}}">{{$modulo->nombre}}</option>
                  @endforeach    
                </select>
                <div class="invalid-feedback">Debes Ingresar datos</div>
                <div class="valid-feedback">¡Se esta Ingresando Datos!</div>
            </div>
            <h7 id="opciond"></h7>
            <div class="input-group mb-2">
                <div class="input-group-prepend">
                    <span class="input-group-text"><b>Opciones</b></span>
                </div>
                <select class="form-control custom-select rounded-0" name="opciones_id" id="opcioness" style="text-transform:uppercase" required>
                
                
                </select>
                <div class="invalid-feedback">Debes Ingresar datos</div>
                <div class="valid-feedback">¡Se esta Ingresando Datos!</div>
            </div>

            <div class="input-group mb-2">
                <div class="input-group-prepend">
                <span class="input-group-text"><b>Descripcion</b></span>
                </div>
                <input type="text" id="nombred" name="descripcion" class="form-control" style="text-transform:uppercase" required>
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
    $(function()
    {
        $('#modulo').on('change', onselect_opciones);
        $('#modulos').on('change', onselect_opcioness);
    });

    function onselect_opciones()
    {
        var modulo =  $(this).val();    
        
        if(modulo >=1)
        {
          $.get('{{route('selectopciones')}}/'+modulo, function(data){
            var html_opciones=    '<option value="">Seleccione una Opcion..</option>'
                for(var i=0; i<data.length; ++i)
                html_opciones += '<option value="'+data[i].id+'">'+data[i].descripcion+'</option>'

            $('#opciones').html(html_opciones);;            
          });
        }
        else
        {
          var html_opciones=    ''       
          $('#opciones').html(html_opciones);
        }
    };
    function onselect_opcioness()
    {
        var modulos =  $(this).val();    
        
        if(modulos >=1)
        {
          $.get('{{route('selectopciones')}}/'+modulos, function(data){
            var html_opcioness=    '<option value="">Seleccione una Opcion..</option>'
                for(var i=0; i<data.length; ++i)
                html_opcioness += '<option value="'+data[i].id+'">'+data[i].descripcion+'</option>'

            $('#opcioness').html(html_opcioness);;            
          });
        }
        else
        {
          var html_opcioness=    ''       
          $('#opcioness').html(html_opcioness);
        }
    };






    $('#modalEditar').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget) //captura valor del data-empresa=""

      var id = button.data('id')
      var modulo = button.data('modulo')
      var opcion = button.data('opcion')
      var nombre = button.data('nombre')

      var modal = $(this)

      modal.find('.modal-body #idd').val(id)
      modal.find('.modal-body #modulod').text(modulo)
      modal.find('.modal-body #opciond').text(opcion)
      modal.find('.modal-body #nombred').val(nombre)

    });
    
</script>
@endsection