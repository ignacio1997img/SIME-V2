@extends('Layout.HomeAdministracion')
@section('content')



    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div>
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"><i class="fas fa-tasks"></i> Rubro Empresa</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('administracion')}}">Home</a></li>       
              <li class="breadcrumb-item active">Rubro Empresa</li>
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
      @can('adm-rubro.store')
        <a class="btn btn-success" data-toggle="modal" data-target="#modalRegistrar" title="Registrar Nuevo Rubro">
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
               LISTA DE RUBRO DE EMPRESA
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
                  <th class="text-center">RUBRO</th> 
                  @can('adm-rubro.update')
                    <th class="text-center"></th>   
                  @endcan                          
               </tr>
            </thead>
            <?php $a = 1; ?>
            <tbody>
              @foreach($rubros as $rubro)
              <tr style="text-transform:uppercase">
                <td class="text-center">{{$a}}</td> 
                <td class="text-center">{{$rubro->subgrupo->grupo->nombre}}</td>
                <td class="text-center">{{$rubro->subgrupo->descripcion}}</td>
                <td class="text-center">{{$rubro->descripcion}}</td> 
                @can('adm-rubro.update')
                  <td class="text-center" style="width: 5%">
                    <a class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalEditar"
                      data-id="{{$rubro->id}}" data-desc="{{$rubro->descripcion}}"
                      data-grupo="{{$rubro->subgrupo->grupo->nombre}}" data-subgrupo="{{$rubro->subgrupo->descripcion}}" title="Editar Rubro">
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
          <h4 class="modal-title">Registrar Rubro</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
        {!! Form::open(['route' => 'rubro.store', 'class' => 'was-validated'])!!}

            <div class="input-group mb-2">
                <div class="input-group-prepend">
                <span class="input-group-text"><b>Grupo</b></span>
                </div>
                <select class="form-control custom-select rounded-0" id="grupo" style="text-transform:uppercase" required>
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
                    <span class="input-group-text"><b>Sub Grupo</b></span>
                </div>
                <select class="form-control custom-select rounded-0" name="subgrupo_id" id="subgrupo" style="text-transform:uppercase" required>
                
                
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
          <button type="submit" class="btn btn-success btn-sm" title="Continuar"> Guardar
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
            <h4 class="modal-title">Edita Rubro</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
            
        <!-- Modal body -->
        <div class="modal-body">
        {!! Form::open(['route' => 'adm-rubro.update','class' => 'was-validated']) !!}

            <input type="hidden" id="idrubro"  name="id">

            <h7 id="grupo"></h7>
            <div class="input-group mb-2">
              
                <div class="input-group-prepend">
                  <span class="input-group-text"><b>Grupo</b></span>
                </div>
                <select class="form-control custom-select rounded-0" id="grupos" style="text-transform:uppercase" required>
                <option value="">Seleccione un grupo..</option>
                @foreach($grupos as $grupo)
                    <option value="{{$grupo->id}}">{{$grupo->nombre}}</option>
                @endforeach    
                </select>
                <div class="invalid-feedback">Debes Ingresar datos</div>
                <div class="valid-feedback">¡Se esta Ingresando Datos!</div>
            </div>

            <h7 id="subgrupo"></h7>
            <div class="input-group mb-2">              
                <div class="input-group-prepend">
                    <span class="input-group-text"><b>Sub Grupo</b></span>
                </div>
                <select class="form-control custom-select rounded-0" name="subgrupo_id" id="subgrupos" style="text-transform:uppercase" required>
                
                
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
            <button type="submit" class="btn btn-primary btn-sm" title="Continuar">
            Guardar
            </button>
        </div>
        {!! Form::close()!!}         
        </div>
    </div>
</div>



<script type="text/javascript">
    $('#grupo').on('change', function (event) {
        grupo =  $(this).val(); 
    });
    //editar
    $('#grupos').on('change', function (event) {
        grupo =  $(this).val(); 
    });

    $(function()
    {
        $('#grupo').on('change', onselect_subgrupo);
        $('#grupos').on('change', onselect_subgrupos);
    });

    function onselect_subgrupo()
    {
        var grupo =  $(this).val();    
        if(grupo >=1)
        {
          $.get('{{route('selectsubgrupo')}}/'+grupo, function(data){
            var html_subgrupo=    '<option value="">Seleccione Sub Grupo Empresa..</option>'
                for(var i=0; i<data.length; ++i)
                html_subgrupo += '<option value="'+data[i].id+'">'+data[i].descripcion+'</option>'

            $('#subgrupo').html(html_subgrupo);;            
          });
        }
        else
        {
          var html_subgrupo=    ''       
          $('#subgrupo').html(html_subgrupo);
        }
    };
    function onselect_subgrupos()
    {
        var grupo =  $(this).val();    
        if(grupo >=1)
        {
          $.get('{{route('selectsubgrupo')}}/'+grupo, function(data){
            var html_subgrupo=    '<option value="">Seleccione Sub Grupo Empresa..</option>'
                for(var i=0; i<data.length; ++i)
                html_subgrupo += '<option value="'+data[i].id+'">'+data[i].descripcion+'</option>'

            $('#subgrupos').html(html_subgrupo);;            
          });
        }
        else
        {
          var html_subgrupo=    ''       
          $('#subgrupos').html(html_subgrupo);
        }
    };

    $('#modalEditar').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget) //captura valor del data-empresa=""

      var id = button.data('id')
      var desc = button.data('desc')
      var grupo = button.data('grupo')
      var subgrupo = button.data('subgrupo')

      var modal = $(this)

      modal.find('.modal-body #idrubro').val(id)
      modal.find('.modal-body #desc').val(desc)
      modal.find('.modal-body #grupo').text(grupo)
      modal.find('.modal-body #subgrupo').text(subgrupo)

    });
    
</script>
@endsection