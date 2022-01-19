@extends('Layout.HomeAdministracion')
@section('content')

  <style>
    #div2 {
     overflow-y:scroll;
     height:380px;
    }
  </style>

    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div>
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"><i class="fas fa-cubes"></i> Permisos</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('administracion')}}">Home</a></li>       
              <li class="breadcrumb-item active">Permisos</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

<div class="container-fluid" style="width: 70%;">
    <div style="padding-bottom: 5px;">
      <a class="btn btn-warning" data-toggle="tooltip" href="" title="Volver al menu principal">
         <i class="fas fa-arrow-alt-circle-left" style="width:20; height:20;"></i>
         Volver
      </a>
      @can('adm-permission.store')
        <a class="btn btn-success" data-toggle="modal" data-target="#modalRegistrar" title="Nuevo Registro">
          <i class="fas fa-plus">
          </i>
          Registrar
        </a>      
      @endcan
    </div>
      <div class="card">
        <div class="card-header text-center bg-warning">
          <i class="far fa-check-square"></i>&nbsp;
          <b>LISTA DE PERMISOS</b></div>
          <div class="card-body" id="div2">          
           
            <table class="table table-bordered table-hover table-sm">
              <tbody>
                @foreach($modulos as $modulo)
                  <tr>
                    @foreach($permissions as $permis)
                      @if(($permis->fk_id == $modulo->id) && ($permis->tipo == 1))
                        <td style="text-transform:uppercase"><b>*{{$modulo->nombre}} - (Modulo)  </b></td>
                        <td>{{$permis->name}}</td>
                      @endif
                    @endforeach
                                  
                    <!-- estructura de las opciones -->
                    @foreach($opciones as $opcion)
                      <tr>
                        @if($opcion->modulo_id == $modulo->id)

                          @foreach($permissions as $permis)
                            @if(($permis->fk_id == $opcion->id) && ($permis->tipo == 2))
                              <td style="text-transform:uppercase">
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                {{$opcion->descripcion}} - (Opcion)
                              </td>
                              <td>{{$permis->name}}</td>
                            @endif
                          @endforeach
                          <!-- estructura de las sub opciones -->
                          @foreach($subs as $sub)
                            <tr>
                              @if($sub->opciones_id == $opcion->id)

                                @foreach($permissions as $permis)
                                  @if(($permis->fk_id == $sub->id) && ($permis->tipo == 3))
                                    <td style="text-transform:uppercase">
                                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                      {{$sub->descripcion}}
                                    </td>
                                    <td>{{$permis->name}}</td>
                                  @endif
                                @endforeach

                                <!-- estructura de las permissionss -->
                                @foreach($permissions as $permis)
                                  <tr>
                                    
                                      @if(($permis->fk_id == $sub->id) && ($permis->tipo == 4) )
                                        <td style="text-transform:uppercase">
                                          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                          {{$permis->descripcion}}
                                        </td>
                                        <td>{{$permis->name}}</td>
                                      @endif
                                    
                                  </tr>
                                @endforeach

                              @endif
                            </tr>
                          @endforeach
                        @endif
                      </tr>
                    @endforeach
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
          <h4 class="modal-title">Registrar Permisos</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
        {!! Form::open(['route' => 'permiso.store', 'class' => 'was-validated'])!!}

            <div class="input-group mb-2">
                <div class="input-group-prepend">
                <span class="input-group-text"><b>Rutas</b></span>
                </div>
                <input type="text" id="name" name="name" class="form-control" required>
                <div class="invalid-feedback">Debes Ingresar datos</div>
                <div class="valid-feedback">¡Se esta Ingresando Datos!</div>
            </div> 
            <div class="input-group mb-2">
                <div class="input-group-prepend">
                <span class="input-group-text"><b> Descripcion</b></span>
                </div>
                <input type="text" id="descripcion" name="descripcion" class="form-control" style="text-transform:uppercase" required>
                <div class="invalid-feedback">Debes Ingresar datos</div>
                <div class="valid-feedback">¡Se esta Ingresando Datos!</div>
            </div>


            <div class="input-group mb-2">
                <div class="input-group-prepend">
                <span class="input-group-text"><b>Tipo</b></span></span>
                </div>
                <select class="form-control custom-select rounded-0" id="tipo" name="tipo" style="text-transform:uppercase" required>
                  <option value="">Seleccione una Opcion</option>
                  <option value="1">Modulo</option>
                  <option value="2">Opcion</option>
                  <option value="3">Sub Opciopn</option> 
                  <option value="4">Permisos</option> 
                </select>
                <div class="invalid-feedback">Debes Ingresar datos</div>
                <div class="valid-feedback">¡Se esta Ingresando Datos!</div>
            </div>

            <!-- MODULOS -->
            <div class="input-group mb-2" id="div_modulo">

            </div>

            <!-- OPCION -->
            <div class="input-group mb-2" id="div_opcion">
                
            </div>

            <!-- SUB OPCIONES -->
            <div class="input-group mb-2" id="div_sub">

            </div>
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer justify-content-between">
          <button type="button text-left" class="btn btn-secondary btn-sm" data-dismiss="modal" data-toggle="tooltip"
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



<script type="text/javascript">
    var html_modulo=''
    var html_opcion=''
    var html_sub=''
    
    $(function()
    {
        $('#tipo').on('change', onselect_tipo);
        
        // $('#opciones').on('change', onselect_subopciones);
    });

    function onselect_tipo()
    {
      var tipo =  $(this).val(); 

      if(tipo == 1)
      {
        select_modulo()

        html_opcion=''
        $('#div_opcion').html(html_opcion);
        html_sub=''
        $('#div_sub').html(html_sub);
      }
      else
      {
        if(tipo == 2)
        {
          select_modulo()
          select_opcion()
        }
        else
        {
          if(tipo == 3)
          {
            select_modulo()
            select_opcion()
            select_sub_opcion()
          }
          else
          {
            if(tipo == 4)
            {
              select_modulo()
              select_opcion()
              select_sub_opcion()

            }
            else
            {
              html_modulo=''
              $('#div_modulo').html(html_modulo);
              html_opcion=''
              $('#div_opcion').html(html_opcion);
              html_sub=''
              $('#div_sub').html(html_sub);
            }
          }
        }        
      }
    }

    function select_modulo()
    {
      html_modulo=''
      html_modulo+= '<div class="input-group-prepend">'
      html_modulo+=   '<span class="input-group-text"><b>Modulos</b></span></span>'
      html_modulo+= '</div>'
      html_modulo+= '<select class="form-control custom-select rounded-0" name="fk_id" id="modulo" required>'
      html_modulo+=   '<option value="">Seleccione un Modulo..</option>'
      html_modulo+=   '@foreach($modulos as $modulo)'
      html_modulo+=     '<option value="{{$modulo->id}}">{{$modulo->nombre}}</option>'
      html_modulo+=   '@endforeach'   
      html_modulo+= '</select>'
      html_modulo+= '<div class="invalid-feedback">Debes Ingresar datos</div>'
      html_modulo+= '<div class="valid-feedback">¡Se esta Ingresando Datos!</div>'

      $('#div_modulo').html(html_modulo);
      $('#modulo').on('change', onselect_opciones);
    }
    function select_opcion()
    {
      html_opcion=''
      html_opcion+= '<div class="input-group-prepend">'
      html_opcion+=   '<span class="input-group-text"><b>Opciones</b></span>'
      html_opcion+=  '</div>'
      html_opcion+=   '<select class="form-control custom-select rounded-0" name="fk_id" id="opciones" required>'
                
                
      html_opcion+=   '</select>'
      html_opcion+=   '<div class="invalid-feedback">Debes Ingresar datos</div>'
      html_opcion+= '<div class="valid-feedback">¡Se esta Ingresando Datos!</div>'

      $('#div_opcion').html(html_opcion);
      $('#opciones').on('change', onselect_subopciones);
    }

    function select_sub_opcion()
    {
      html_sub=''
      html_sub+= '<div class="input-group-prepend">'
      html_sub+=   '<span class="input-group-text"><b>Sub Opcion</b></span>'
      html_sub+=  '</div>'
      html_sub+=   '<select class="form-control custom-select rounded-0" name="fk_id" id="sub" required>'
                
                
      html_sub+=   '</select>'
      html_sub+=   '<div class="invalid-feedback">Debes Ingresar datos</div>'
      html_sub+= '<div class="valid-feedback">¡Se esta Ingresando Datos!</div>'

      $('#div_sub').html(html_sub);

    }




    function onselect_opciones()
    {
        var modulo =  $(this).val();    
        
        if(modulo >=1)
        {
          $.get('{{route('selectopciones')}}/'+modulo, function(data){
            var html_opciones=    '<option value="">Seleccione una Opcion..</option>'
                for(var i=0; i<data.length; ++i)
                html_opciones += '<option value="'+data[i].id+'">'+data[i].descripcion+'</option>'

            $('#opciones').html(html_opciones);
            var html_sub=    ''       
            $('#sub').html(html_sub);         
          });
        }
        else
        {
          var html_opciones=    ''       
          $('#opciones').html(html_opciones);
          var html_sub=    ''       
          $('#sub').html(html_sub);
        }
    };

    function onselect_subopciones()
    {
        var opcion =  $(this).val();    
        if(opcion >=1)
        {
          $.get('{{route('selectsubopcion')}}/'+opcion, function(data){
            var html_sub=    '<option value="">Seleccione Sub Opciones..</option>'
                for(var i=0; i<data.length; ++i)
                html_sub += '<option value="'+data[i].id+'">'+data[i].descripcion+'</option>'

            $('#sub').html(html_sub);;            
          });
        }
        else
        {
          var html_sub=    ''       
          $('#sub').html(html_sub);
        }
    };

</script>
@endsection