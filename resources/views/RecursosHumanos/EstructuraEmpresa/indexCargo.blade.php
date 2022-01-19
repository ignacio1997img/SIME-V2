@extends('Layout.HomeRecursosHumanos')
@section('content')



    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div>
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"><i class="fas fa-id-card-alt"></i> Cargos</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('recursoshumanos')}}">Home</a></li>       
              <li class="breadcrumb-item active">Cargos</li>
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
      @can('rrhh-cargo.store')
        <a class="btn btn-success" data-toggle="modal" data-target="#modalRegistrar" title="Registrar Nuevo Cargo">
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
               LISTA DE CARGOS
               </h4>
            </th>
         </div>
      </div>
      <div class="card-body">
         <table class="table table-bordered table-hover table-sm" id="example2">
            <thead>
               <tr>
                  <th class="text-center" width="50">CODIGO</th>
                  <th class="text-center">EMPRESA</th> 
                  <th class="text-center">AREA</th> 
                  <th class="text-center">SIGLA</th> 
                  <th class="text-center">CARGO</th>
                  @can('rrhh-cargo.update') 
                    <th class="text-center"></th>    
                  @endcan                         
               </tr>
            </thead>
            <tbody>
              @foreach($cargos as $cargo)
              <tr style="text-transform:uppercase">
                <td class="text-center">{{$cargo->codigo}}</td> 
                <td class="text-center">{{$cargo->area->empresa->razonsocial}}</td>
                <td class="text-center">{{$cargo->area->descripcion}}</td>
                <td class="text-center">{{$cargo->sigla}}</td> 
                <td class="text-center">{{$cargo->nombre}}</td> 
                @can('rrhh-cargo.update') 
                  <td class="text-center" style="width: 5%">
                    <a class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalEditar"
                      data-id="{{$cargo->id}}" data-nombre="{{$cargo->nombre}}" data-observacion="{{$cargo->observacion}}" data-tipo="{{$cargo->tipocargo->descripcion}}"tipocargo
                      data-sigla="{{$cargo->sigla}}" data-tipo="{{$cargo->tipo}}" data-empresa="{{$cargo->area->empresa->razonsocial}}" data-area="{{$cargo->area->descripcion}}" title="Editar Cargo">
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
          <h4 class="modal-title">Registrar Cargo</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
        {!! Form::open(['route' => 'cargo.store', 'class' => 'was-validated'])!!}

            <div class="input-group mb-2">
                <div class="input-group-prepend">
                <span class="input-group-text"><b>Empresa</b></span>
                </div>
                <select class="form-control custom-select rounded-0" id="empresa" style="text-transform:uppercase" required>
                <option value="">Seleccione una Empresa..</option>
                @foreach($empresas as $empresa)
                    <option value="{{$empresa->id}}">{{$empresa->razonsocial}}</option>
                @endforeach 
                </select>
                <div class="invalid-feedback">Debes Ingresar datos</div>
                <div class="valid-feedback">¡Se esta Ingresando Datos!</div>
            </div>

            <div class="input-group mb-2">
                <div class="input-group-prepend">
                    <span class="input-group-text"><b>Area</b> </span>
                </div>
                <select class="form-control custom-select rounded-0" name="area_id" id="area" style="text-transform:uppercase" required>                
                
                </select>
                <div class="invalid-feedback">Debes Ingresar datos</div>
                <div class="valid-feedback">¡Se esta Ingresando Datos!</div>
            </div>
            <div class="row">
              <div class="col-6">
                <div class="input-group mb-2">
                  <div class="input-group-prepend">
                  <span class="input-group-text"><b>Tipo</b></span>
                  </div>
                  <select class="form-control custom-select rounded-0" name="tipocargo_id" id="tipocargo_id" style="text-transform:uppercase" required>
                  <option value="">Seleccione un Tipo..</option>
                  @foreach($tipos as $tipo)
                      <option value="{{$tipo->id}}">{{$tipo->descripcion}}</option>
                  @endforeach 
                  </select>
                  <div class="invalid-feedback">Debes Ingresar datos</div>
                  <div class="valid-feedback">¡Se esta Ingresando Datos!</div>
                </div>
              </div>
              <div class="col-6">
                <div class="input-group mb-2">
                  <div class="input-group-prepend">
                  <span class="input-group-text"><b>Sigla</b></span>
                  </div>
                  <input type="text" id="sigla" name="sigla" class="form-control" style="text-transform:uppercase" required>
                  <div class="invalid-feedback">Debes Ingresar datos</div>
                  <div class="valid-feedback">¡Se esta Ingresando Datos!</div>
                </div>
              </div>
            </div>    
            <div class="input-group mb-2">
                <div class="input-group-prepend">
                <span class="input-group-text"><b>Nombre</b></span>
                </div>
                <input type="text" id="nombre" name="nombre" class="form-control" style="text-transform:uppercase" required>
                <div class="invalid-feedback">Debes Ingresar datos</div>
                <div class="valid-feedback">¡Se esta Ingresando Datos!</div>
            </div>
            <div class="input-group mb-2">
              <div class="input-group-prepend">
                <span class="input-group-text"><b>Observaciones</b></span>
              </div>
              <textarea class="form-control" rows="3" name="observacion" id="observacion" style="text-transform:uppercase"></textarea>
              <div class="valid-feedback">¡Campo opcional!</div>
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
          <h4 class="modal-title">Editar Cargo</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
        {!! Form::open(['route' => 'rrhh-cargo.update', 'class' => 'was-validated'])!!}
            <input type="hidden" id="id" name="id">
            <h7 id="empresa"></h7>
            <div class="input-group mb-2">
                <div class="input-group-prepend">
                <span class="input-group-text"><b>Empresa</b></span>
                </div>
                <select class="form-control custom-select rounded-0" id="empresas" style="text-transform:uppercase" required>
                <option value="">Seleccione una Empresa..</option>
                @foreach($empresas as $empresa)
                    <option value="{{$empresa->id}}">{{$empresa->razonsocial}}</option>
                @endforeach 
                </select>
                <div class="invalid-feedback">Debes Ingresar datos</div>
                <div class="valid-feedback">¡Se esta Ingresando Datos!</div>
            </div>
            <h7 id="area"></h7>
            <div class="input-group mb-2">
                <div class="input-group-prepend">
                    <span class="input-group-text"><b>Area</b> </span>
                </div>
                <select class="form-control custom-select rounded-0" name="area_id" id="areas" style="text-transform:uppercase" required>                
                
                </select>
                <div class="invalid-feedback">Debes Ingresar datos</div>
                <div class="valid-feedback">¡Se esta Ingresando Datos!</div>
            </div>
            <h7 id="tipo"></h7>
            <div class="row">
              <div class="col-6">
                <div class="input-group mb-2">
                  <div class="input-group-prepend">
                  <span class="input-group-text"><b>Tipo</b></span>
                  </div>
                  <select class="form-control custom-select rounded-0" name="tipocargo_id" id="tipocargo_id" style="text-transform:uppercase" required>
                  <option value="">Seleccione un Tipo..</option>
                  @foreach($tipos as $tipo)
                      <option value="{{$tipo->id}}">{{$tipo->descripcion}}</option>
                  @endforeach 
                  </select>
                  <div class="invalid-feedback">Debes Ingresar datos</div>
                  <div class="valid-feedback">¡Se esta Ingresando Datos!</div>
                </div>
              </div>
              <div class="col-6">
                <div class="input-group mb-2">
                  <div class="input-group-prepend">
                  <span class="input-group-text"><b>Sigla</b></span>
                  </div>
                  <input type="text" id="sigla" name="sigla" class="form-control" style="text-transform:uppercase" required>
                  <div class="invalid-feedback">Debes Ingresar datos</div>
                  <div class="valid-feedback">¡Se esta Ingresando Datos!</div>
                </div>
              </div>
            </div>    
            <div class="input-group mb-2">
                <div class="input-group-prepend">
                <span class="input-group-text"><b>Nombre</b></span>
                </div>
                <input type="text" id="nombre" name="nombre" class="form-control" style="text-transform:uppercase" required>
                <div class="invalid-feedback">Debes Ingresar datos</div>
                <div class="valid-feedback">¡Se esta Ingresando Datos!</div>
            </div>
            <div class="input-group mb-2">
              <div class="input-group-prepend">
                <span class="input-group-text"><b>Observaciones</b></span>
              </div>
              <textarea class="form-control" rows="3" name="observacion" id="observacion" style="text-transform:uppercase"></textarea>
              <div class="valid-feedback">¡Campo opcional!</div>
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
    // $('#empresa').on('change', function (event) {
    //     grupo =  $(this).val(); 
    // });

    $(function()
    {
        $('#empresa').on('change', onselect_area);
        $('#empresas').on('change', onselect_areas);
    });

    function onselect_area()
    {
        var empresa =  $(this).val();    
        if(empresa >=1)
        {
          $.get('{{route('selectarea')}}/'+empresa, function(data){
            var html_area=    '<option value="">Seleccione una Area..</option>'
                for(var i=0; i<data.length; ++i)
                html_area += '<option value="'+data[i].id+'">'+data[i].descripcion+'</option>'

            $('#area').html(html_area)
            // $('#areas').html(html_area);;            
          });
        }
        else
        {
          var html_area=    ''       
          $('#area').html(html_area);
          // $('#areas').html(html_area)
        }
    };

    function onselect_areas()
    {
        var empresa =  $(this).val();    
        if(empresa >=1)
        {
          $.get('{{route('selectarea')}}/'+empresa, function(data){
            var html_area=    '<option value="">Seleccione una Area..</option>'
                for(var i=0; i<data.length; ++i)
                html_area += '<option value="'+data[i].id+'">'+data[i].descripcion+'</option>'

            // $('#area').html(html_area)
            $('#areas').html(html_area)        
          });
        }
        else
        {
          var html_area=    ''       
          // $('#area').html(html_area);
          $('#areas').html(html_area)
        }
    }

    $('#modalEditar').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget) //captura valor del data-empresa=""

      var id = button.data('id')
      var empresa = button.data('empresa')
      var area = button.data('area')
      var tipo = button.data('tipo')
      var sigla = button.data('sigla')
      var nombre = button.data('nombre')
      var observacion = button.data('observacion')

      var modal = $(this)
      modal.find('.modal-body #id').val(id)
      modal.find('.modal-body #empresa').text(empresa)
      modal.find('.modal-body #area').text(area)
      modal.find('.modal-body #tipo').text(tipo)
      modal.find('.modal-body #sigla').val(sigla)
      modal.find('.modal-body #nombre').val(nombre)
      modal.find('.modal-body #observacion').val(observacion)
    });
    
</script>
@endsection