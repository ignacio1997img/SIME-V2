@extends('Layout.HomeRecursosHumanos')
@section('content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div>
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"><i class="fas fa-user-tie"></i> Funcionarios</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('recursoshumanos')}}">Home</a></li>    
              <li class="breadcrumb-item active">Funcionarios</li>
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
      @can('rrhh-funcionario.store')
        <a class="btn btn-success" data-toggle="modal" data-target="#modalRegistrar" title="Nuevo Registro">
          <i class="fas fa-plus">
          </i>
          Registrar
        </a>
      @endcan
      @can('rrhh-funcionario.viewinactivo')
      <a class="btn btn-primary" data-toggle="tootip" href="{{route('rrhh-funcionario.viewinactivo')}}" title="Nuevo Registro">
         <i class="fas fa-plus">
         </i>
         Inactivo
      </a>
      @endcan
   </div>
   <div class="card table-responsive card-outline card-info">
      <div class="card-header">
         <div>
            <th>
               <h4 class="card-title text-center ">
               LISTA DE FUNCIONARIOS
               </h4>
            </th>
         </div>
      </div>
      <div class="card-body">
         <table class="table table-bordered table-hover" id="example2">
            <thead>
               <tr>
                  <th class="text-center" width="50">ID</th>
                  <th class="text-center">EMPRESA</th> 
                  <th class="text-center">CARGO</th> 
                  <th class="text-center">NOMBRE</th> 
                  
                  <th class="text-center"></th>                             
               </tr>
            </thead>
            <tbody>
                @foreach($activos as $activo)
                    <tr style="text-transform:uppercase">
                        <td class="text-center">{{ $activo->id}}</td>
                        <td class="text-center">{{ $activo->razonsocial}}</td>
                        <td class="text-center">{{ $activo->cargo}}</td>
                        <td class="text-center">{{ $activo->nombre}} {{ $activo->ap1}} {{ $activo->ap2}}</td> 
                        <td class="text-center" style="width: 5%">
                            <div class="container">
                                <div class="dropdown">
                                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                                        <i class="fas fa-cogs"></i>
                                        Acciones
                                    </button>
                                    <div class="dropdown-menu">
                                        @can('rrhh-funcionario.designacion')
                                          <a class="dropdown-item" data-toggle="tooltip"  href="{{route('rrhh-funcionario.designacion', $activo->id)}}">Designacion</a>
                                        @endcan
                                          <a class="dropdown-item" data-toggle="tooltip"  href="{{route('rrhh-funcionario.designacionsistema', $activo->id)}}">Permisos Especiales</a>
                                        @can('rrhh-funcionario.bajafuncionario')
                                          <a class="dropdown-item" data-toggle="modal" data-target="#modalBaja"
                                            data-funcionario_id="{{ $activo->id}}" data-nombre="{{$activo->nombre}} {{ $activo->ap1}} {{ $activo->ap2}}">Baja</a>  
                                        @endcan
                                        @can('rrhh-funcionario.historial')
                                          <a class="dropdown-item" data-toggle="tooltip"  href="{{route('rrhh-funcionario.historial', $activo->id)}}">Historial</a>   
                                        @endcan
                                    </div>
                                </div>
                            </div>
                        </td>                       
                    </tr>
                @endforeach
            </tbody>
         </table>
      </div>
   </div>
</div>


  <!-- The Modal Registrar-->
  
<div class="modal fade" id="modalRegistrar">
    <div class="modal-dialog modal-dialog-scrollable">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header bg-success">
          <h4 class="modal-title">Registrar Funcionario</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
        {!! Form::open(['route' => 'funcionario.store', 'class' => 'was-validated'])!!}

              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"><b>Persona</b> </span>
                </div>
                <select class="form-control select2bs4" style="width: 60%; height: 50%; " name="persona_id" id="persona_id" style="text-transform:uppercase" required>
                  <option value="">SELECCIONE UNA PERSONA..</option>
                  @foreach($personas as $persona)
                    <option value="{{$persona->id}}">{{strtoupper($persona->nombrecompleto())}}</option>
                  @endforeach
                </select>
                <div class="invalid-feedback">Debes Ingresar datos</div>
                <div class="valid-feedback">¡Se esta Ingresando Datos!</div>
            </div>
            <div class="input-group mb-2">
                <div class="input-group-prepend">
                <span class="input-group-text"><b>Empresa</b> </span>
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
                <select class="form-control custom-select rounded-0" id="area" style="text-transform:uppercase" required>
                
                
                </select>
                <div class="invalid-feedback">Debes Ingresar datos</div>
                <div class="valid-feedback">¡Se esta Ingresando Datos!</div>
            </div>
            <div class="input-group mb-2">
                <div class="input-group-prepend">
                    <span class="input-group-text"><b>Cargo</b> </span>
                </div>
                <select class="form-control custom-select rounded-0" name="cargo_id" id="cargo" style="text-transform:uppercase" required>
                
                
                </select>
                <div class="invalid-feedback">Debes Ingresar datos</div>
                <div class="valid-feedback">¡Se esta Ingresando Datos!</div>
            </div>

            
            <div class="row">
              <div class="col-12">
                <div class="input-group  ">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><b>Fecha</b></span>
                  </div>
                    <input type="date" class="form-control" id="inicio"  name="inicio" required>
                  <div class="invalid-feedback">Debes Ingresar datos</div>
                  <div class="valid-feedback">¡Se esta Ingresando Datos!</div>
                </div>
              </div>              
            </div>
            <div class="input-group mb-2">
              <div class="input-group-prepend">
                <span class="input-group-text"><b>Detalle</b></span>
              </div>
              <textarea class="form-control" rows="3" name="detalle" id="detalle" style="text-transform:uppercase"></textarea>
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

  <!-- The Modal Baja-->
  <div class="modal" id="modalBaja">
    <div class="modal-dialog modal-dialog-scrollable">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header bg-primary">
          <h4 class="modal-title">Baja Funcionario</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
        {!! Form::open(['route' => 'rrhh-funcionario.bajafuncionario', 'class' => 'was-validated'])!!}
            <input type="hidden"  name="funcionario_id" id="funcionario_id" >
            
            <input type="hidden"  name="pivote_id" id="pivote_id" >

            <h7 id="nombre"></h7>
            <div class="input-group mb-2">
                <div class="input-group-prepend">
                <span class="input-group-text"><b>Baja</b></span>
                </div>
                <select class="form-control custom-select rounded-0" name="tipo_baja" id="tipo_baja" style="text-transform:uppercase" required>
                  <option value="">Seleccione una Baja..</option>    
                  <option value="1">Baja Definitiva</option>
                  <option value="2">Baja Medica</option>
                  <option value="3">Baja Vacaciones</option>
                  <option value="4">Baja Comision</option>
                </select>
                <div class="invalid-feedback">Debes Ingresar datos</div>
                <div class="valid-feedback">¡Se esta Ingresando Datos!</div>
            </div>

            <div class="row" id="div_inicio">
                            
            </div>
            <div class="row" id="div_fin">
                            
            </div>

            <div class="input-group mb-2" id="div_documento">
              
            </div> 
            <div class="input-group mb-2">
              <div class="input-group-prepend">
                <span class="input-group-text"><b>Observacion</b></span>
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
    var html_inicio=''
    var html_fin=''
    var html_documento=''

    $(function()
    {    
        $('#empresa').on('change', onselect_area);
        $('#area').on('change', onselect_cargo);
        $('#tipo_baja').on('change', onselect_baja);

    });

    function onselect_area()
    {
        var area =  $(this).val();    
        if(area >=1)
        {
          $.get('{{route('selectarea')}}/'+area, function(data){
            var html_area=    '<option value="">Seleccione una Area..</option>'
                for(var i=0; i<data.length; ++i)
                html_area += '<option value="'+data[i].id+'">'+data[i].descripcion+'</option>'

            $('#area').html(html_area);;            
          });
        }
        else
        {
          var html_area=    ''       
          $('#area').html(html_area);
          var html_cargo=    ''       
          $('#cargo').html(html_cargo);
        }
    };

    function onselect_cargo()
    {
        var cargo =  $(this).val(); 
        if(cargo >=1)
        {
          $.get('{{route('selectcargo')}}/'+cargo, function(data){ 
            var html_cargo=    '<option value="">Seleccione un Cargo..</option>'
                for(var i=0; i<data.length; ++i)
                html_cargo += '<option value="'+data[i].id+'">'+data[i].nombre+'</option>'

            $('#cargo').html(html_cargo);;            
          });
        }
        else
        {
          var html_cargo=    ''       
          $('#cargo').html(html_cargo);
        }
    };

    function onselect_baja()
    {
      var tipo =  $(this).val(); 
      if(tipo == 1)
      {
        div_fin()

        html_inicio=''
        $('#div_inicio').html(html_inicio)
        html_documento=''
        $('#div_documento').html(html_documento)
      }
      else
      {
        if(tipo >= 2)
        {
          div_inicio()
          div_fin()
          div_documento()
        }
        else
        {
          html_inicio=''
          $('#div_inicio').html(html_inicio)
          html_fin=''
          $('#div_fin').html(html_fin)
          html_documento=''
          $('#div_documento').html(html_documento)
        }
      }
    };


    function div_inicio()
    {
      html_inicio=  '<div class="col-12">'
      html_inicio+=   '<div class="input-group  ">'
      html_inicio+=     '<div class="input-group-prepend">'
      html_inicio+=       '<span class="input-group-text"><b>Fecha Inicio</b></span>'
      html_inicio+=     '</div>'
      html_inicio+=     '<input type="date" class="form-control" id="inicio"  name="inicio" required>'
      html_inicio+=     '<div class="invalid-feedback">Debes Ingresar datos</div>'
      html_inicio+=     '<div class="valid-feedback">¡Se esta Ingresando Datos!</div>'
      html_inicio+=   '</div>'
      html_inicio+= '</div>'
      $('#div_inicio').html(html_inicio)
    };

    function div_fin()
    {
      html_fin=  '<div class="col-12">'
      html_fin+=   '<div class="input-group  ">'
      html_fin+=     '<div class="input-group-prepend">'
      html_fin+=       '<span class="input-group-text"><b>Fecha Fin</b></span>'
      html_fin+=     '</div>'
      html_fin+=     '<input type="date" class="form-control" id="fin"  name="fin" required>'
      html_fin+=     '<div class="invalid-feedback">Debes Ingresar datos</div>'
      html_fin+=     '<div class="valid-feedback">¡Se esta Ingresando Datos!</div>'
      html_fin+=   '</div>'
      html_fin+= '</div>'
      $('#div_fin').html(html_fin)
    };
    function div_documento()
    {
      html_documento=   '<div class="input-group mb-2">'
      html_documento+=    '<div class="input-group-prepend">'
      html_documento+=      '<span class="input-group-text"><b>Documento</b></span>'
      html_documento+=    '</div>'
      html_documento+=    '<input type="text" class="form-control" id="documento"  name="documento" style="text-transform:uppercase">'
      html_documento+=    '<div class="valid-feedback">¡Campo opcional!</div>'
      html_documento+=  '</div>'
      $('#div_documento').html(html_documento)
    };

    
    $('#modalBaja').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget) //captura valor del data-empresa=""
      
      var funcionario_id = button.data('funcionario_id')
      var nombre = button.data('nombre')
      var modal = $(this)
      $.get('{{route('selectactivo')}}/'+funcionario_id, function(data)
      {
        modal.find('.modal-body #funcionario_id').val(funcionario_id)
        modal.find('.modal-body #nombre').text(nombre)
        modal.find('.modal-body #pivote_id').val(data.id)
      });
    })




</script>
@endsection