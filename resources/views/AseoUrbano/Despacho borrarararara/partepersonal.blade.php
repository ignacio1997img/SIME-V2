@extends('Layout.HomeAseoUrbano')
@section('content')

    <div class="content-header">
      <div>
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"><i class="fas fa-receipt"></i> Detalle Parte Personal</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('aseourbano')}}">Home</a></li>   
              <li class="breadcrumb-item"><a href="{{route('despacho.index')}}">Despachos</a></li>      
              <li class="breadcrumb-item"><a href="#">Detalle Despacho</a></li>    
              <li class="breadcrumb-item active">Detalle Parte Personal</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

<div class="container-fluid">
  <div class="card">
    <div class="card-header">
      <div class="row">
        <div class="col-6">
          <h3>            
            <b></b>
          </h3>
        </div>
        <div class="col-6">
          <div class="dropdown dropleft float-right">
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalRegistrar">
              <i class="fas fa-plus"></i>
              Funcionario
            </button>
          </div>
        </div>
      </div> 
    </div>
    <div class="card-body" id="div1">
    <table id="example2" class="table table-md table-bordered table-hover table-striped">
        <thead>
          <tr>
            <th class="text-center">FUNCIONARIO</th>
            <th class="text-center">REEMPLAZO</th>
            <th class="text-center">OPCIONES</th>
          </tr>
        </thead>
        <tbody>
            @foreach($funcionarios as $fun)    
                <tr>
                    <td>{{$fun->funcionario}}</td>
                    <td></td>
                    <td class="text-center" style="width: 5%">
                      <a class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalEditar" title="">
                      <i class="fas fa-arrows-alt-h"></i>
                      </a>
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
          <h4 class="modal-title">Registrar Ruta</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
        {!! Form::open(['route' => 'partepersona.store', 'class' => 'was-validated'])!!}
            <input type="hidden" value="{{$detalle->id}}" name="detalledespacho_id">
            <div class="input-group mb-2">
                <div class="input-group-prepend">
                <span class="input-group-text">Empresa</span>
                </div>
                <select class="form-control custom-select rounded-0" id="empresa" name="empresa" style="text-transform:uppercase" required>
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
                    <span class="input-group-text">Area</span>
                </div>
                <select class="form-control custom-select rounded-0" id="area" style="text-transform:uppercase" required>
                
                
                </select>
                <div class="invalid-feedback">Debes Ingresar datos</div>
                <div class="valid-feedback">¡Se esta Ingresando Datos!</div>
            </div>
            <div class="input-group mb-2">
                <div class="input-group-prepend">
                    <span class="input-group-text">Cargo</span>
                </div>
                <select class="form-control custom-select rounded-0" name="cargo" id="cargo" style="text-transform:uppercase" required>
                
                
                </select>
                <div class="invalid-feedback">Debes Ingresar datos</div>
                <div class="valid-feedback">¡Se esta Ingresando Datos!</div>
            </div>


                <div class="input-group mb-2 col-sm-12">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><b>Funcionario:</b></span>
                    </div>
                    <select class="form-control select2bs4" multiple="multiple" name="func[]" id="funcionario" style="text-transform:uppercase" required>
                        
                    </select>
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
    




<script type="text/javascript">

    $(function()
    {    
        $('#empresa').on('change', onselect_area);
        $('#area').on('change', onselect_cargo);
        $('#cargo').on('change', onselect_funcionario);

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

    function onselect_funcionario()
    {
        var funcionario =  $(this).val(); 
        if(funcionario >=1)
        {
          $.get('{{route('au_select_ajax_personal')}}/'+funcionario, function(data){ 
                var html_funcionario=''
                for(var i=0; i<data.length; ++i)
                 html_funcionario+= '<option value="'+data[i].id+'">'+data[i].nombre+' '+data[i].apellidopaterno+' '+data[i].apellidomaterno+'</option>'

            $('#funcionario').html(html_funcionario);;            
          });
        }
        else
        {
          var html_funcionario=    ''       
          $('#funcionario').html(html_funcionario);
        }
    };








</script>













@endsection