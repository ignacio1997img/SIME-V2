@extends('Layout.HomeAdministracion')
@section('content')



    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div>
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"><i class="fas fa-building"></i> Empresa</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('administracion')}}">Home</a></li>       
              <li class="breadcrumb-item active">Empresa</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- dd(auth()->user()->roles) -->

<div class="container">
   <div style="padding-bottom: 5px;">
      <a class="btn btn-warning" data-toggle="tooltip" href="" title="Volver al menu principal">
         <i class="fas fa-arrow-alt-circle-left" style="width:20; height:20;">
         </i>
         Volver
      </a>
      @can('adm-empresa.store')
        <a class="btn btn-success" data-toggle="modal" data-target="#modalRegistrar" title="Registrar Nueva Empresa">
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
               LISTA DE EMPRESA
               </h4>
            </th>
         </div>
      </div>
      <div class="card-body">
         <table class="table table-bordered table-hover table-sm" id="example2">
            <thead>
               <tr>
                    <th>ID</th>
                    <th>GRUPO</th>
                    <th>SUB GRUPO</th>
                    <th>RUBRO</th>
                    <th>RAZON SOCIAL</th>
                    <th>OPCIONES</th>                         
               </tr>
            </thead>
            <?php $a = 1; ?>
            <tbody>
              @foreach($empresas as $empresa)
              <tr style="text-transform:uppercase">
                <td class="text-center">{{$empresa->id}}</td>
                <td class="text-center">{{$empresa->rubro->subgrupo->grupo->nombre}}</td>
                <td class="text-center">{{$empresa->rubro->subgrupo->descripcion}}</td>
                <td class="text-center">{{$empresa->rubro->descripcion}}</td>
                <td class="text-center">{{$empresa->razonsocial}}</td>

                <td class="text-center">
                  <div class="container">
                    <div class="dropdown">
                      <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                        <i class="fas fa-cogs"></i>Acciones
                      </button>
                      <div class="dropdown-menu">
                        @can('adm-empresa.update')
                          <a class="dropdown-item" data-toggle="modal" data-target="#modalEditar" data-id="{{$empresa->id}}" title="Editar Empresa">Editar</a>
                        @endcan
                        @can('adm-empresa.kardex')
                          <a class="dropdown-item" data-toggle="tooltip" data-target="" href="{{route('adm-empresa.kardex', $empresa->id)}}" title="Ver Informacion">Kardex</a>  
                        @endcan 
                        @can('adm-empresa.funcionario')
                          <a class="dropdown-item" data-toggle="tooltip" data-target="" href="{{route('adm-empresa.funcionario', $empresa->id)}}" title="Ver Informacion">Funcionarios</a> 
                        @endcan               
                      </div>
                    </div>
                  </div>
                </td>
              </tr>              
              <?php $a++; ?>
              @endforeach
            </tbody>
         </table>
      </div>
   </div>
</div>


<div class="modal" id="modalRegistrar">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header bg-success">
          <h4 class="modal-title">Registrar Empresa</h4>
          <button type="button" class="close" data-dismiss="modal">×</button>
        </div>
          
          <!-- Modal body -->
          <div class="modal-body"> 
          {!! Form::open(['route' => 'empresa.store', 'class' => 'was-validated']) !!}      
            <div class="row">
                <!-- select grupo empresa      -->
                <div class="col-4">
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><b>Grupo</b></span>
                        </div>
                        <select class="form-control custom-select rounded-0" id="grupo" style="text-transform:uppercase" required>
                            <option value="">Seleccione un grupo..</option>
                            @foreach($grupos as $grupo)
                                <option value="{{ $grupo->id}}">{{ $grupo->nombre }}</option>
                            @endforeach                   
                        </select>
                        <div class="invalid-feedback">Debes Ingresar datos</div>
                        <div class="valid-feedback">¡Se esta Ingresando Datos!</div>
                    </div>
                </div>
                <!-- select sub grupo empresa      -->
                <div class="col-4">
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><b>Sub Grupo</b></span>                        
                        </div>
                        <select class="form-control custom-select rounded-0" id="subgrupo" style="text-transform:uppercase" required>

                        </select>
                        <div class="invalid-feedback">Debes Ingresar datos</div>
                        <div class="valid-feedback">¡Se esta Ingresando Datos!</div>
                    </div>
                </div>
                <!-- select rubro empresa      -->
                <div class="col-4">
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                        <span class="input-group-text"><b>Rubro</b></span>
                        </div>
                        <select class="form-control custom-select rounded-0" name="rubroempresa_id" id="rubro" style="text-transform:uppercase" required>

                        </select>
                        <div class="invalid-feedback">Debes Ingresar datos</div>
                        <div class="valid-feedback">¡Se esta Ingresando Datos!</div>
                    </div>
                </div>
            </div>
            <div class="row">
              <div class="input-group mb-2 col-md-6">
                <div class="input-group-prepend">
                  <span class="input-group-text"><b>Nit</b></span>
                </div>
                <input type="text" class="form-control" id="nit" name="nit" style="text-transform:uppercase" required>
                <div class="invalid-feedback">Debes Ingresar datos</div>
                <div class="valid-feedback">¡Se esta Ingresando Datos!</div>
              </div>
              <div class="input-group mb-2 col-md-6">
                <div class="input-group-prepend">
                  <span class="input-group-text"><b>Sigla</b></span>
                </div>
                <input type="text" class="form-control" id="sigla" name="sigla" style="text-transform:uppercase">
                <div class="valid-feedback">¡Campo opcional!</div>
              </div>
            </div>
            <div class="input-group mb-2">
              <div class="input-group-prepend">
                <span class="input-group-text"><b>Razon Social</b></span>
              </div>
              <input type="text" class="form-control" id="razonsocial" name="razonsocial" style="text-transform:uppercase" required>
              <div class="invalid-feedback">Debes Ingresar datos</div>
              <div class="valid-feedback">¡Se esta Ingresando Datos!</div>
            </div>
            

            <div class="input-group mb-2">
              <div class="input-group-prepend">
                <span class="input-group-text"><b>Dirección</b></span>
              </div>
              <textarea class="form-control" rows="3" name="direccion" id="direccion" style="text-transform:uppercase"></textarea>
              <div class="valid-feedback">¡Campo opcional!</div>
            </div>
            
            <div class="row">
              <div class="col-6">
                <div class="form-group">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><b>Telefono</b></i></span>
                    </div>
                    <input type="text" class="form-control" name="telempresa" id="telempresa" style="text-transform:uppercase">
                    <div class="valid-feedback">¡Campo opcional!</div>
                  </div>
                </div>
              </div>
              <div class="col-6">
                <div class="form-group">
                  <div class="input-group">
                    <div class="input-group-prepend">
                    <span class="input-group-text"><b>Correo</b></span>
                    </div>
                    <input type="email" class="form-control" name="emailempresa" placeholder="Email">
                    <div class="valid-feedback">¡Campo opcional!</div>
                  </div>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"><b>Contacto</b></span>
                </div>
                <input type="text" class="form-control" name="contacto" id="contacto" style="text-transform:uppercase">
                <div class="valid-feedback">¡Campo opcional!</div>
              </div>
            </div>
            <p class="bg-warning text-center"><b> Datos del Contacto </b></p>

            <div class="row">
              <div class="col-6">
                <div class="form-group">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><b>Telefono</b></span>
                    </div>
                    <input type="text" class="form-control" name="telefonocontacto" id="telefonocontacto" style="text-transform:uppercase">
                    <div class="valid-feedback">¡Campo opcional!</div>
                  </div>
                </div>
              </div>
              <div class="col-6">
                <div class="form-group">
                  <div class="input-group">
                    <div class="input-group-prepend">
                    <span class="input-group-text"><b>Correo</b></span>
                    </div>
                    <input type="email" class="form-control" name="emailcontacto" placeholder="Email">
                    <div class="valid-feedback">¡Campo opcional!</div>
                  </div>
                </div>
              </div>
            </div>  
            <div class="row">     
              <div class="form-group col-6">
                <label>Provee Personal:</label>
                <div class="custom-control custom-radio">
                  <input class="custom-control-input" type="radio" value="1" id="customRadio1" name="personal">
                  <label for="customRadio1" class="custom-control-label text-dark">Si</label>
                </div>
                <div class="custom-control custom-radio">
                  <input class="custom-control-input" type="radio" value="0" id="customRadio2" name="personal" checked>
                  <label for="customRadio2" class="custom-control-label text-dark">No</label>
                </div>                        
              </div>

              <div class="form-group col-6">                    
                <label>Provee Vehiculo:</label>
                <div class="custom-control custom-radio">
                  <input class="custom-control-input custom-control-input" type="radio" value="1" id="customRadio4" name="vehiculo" checked>
                  <label for="customRadio4" class="custom-control-label text-dark">Si</label>
                </div>
                <div class="custom-control custom-radio">
                  <input class="custom-control-input custom-control-input" type="radio" value="0" id="customRadio5" name="vehiculo">
                  <label for="customRadio5" class="custom-control-label text-dark">No</label>
                </div>
              </div>
            </div>     
          </div>



                      
          
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-secondary" data-dismiss="modal" data-toggle="tooltip" title="Volver al Listado">Cancelar</button>
            <button type="submit" class="btn btn-success" title="Continuar">Guardar</button>            
          </div>  
          {!! Form::close() !!} 
      </div>
    </div>
</div> 

<!-- modal de editar empresa -->
<div class="modal" id="modalEditar">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header bg-primary">
          <h4 class="modal-title">Editar Empresa</h4>
          <button type="button" class="close" data-dismiss="modal">×</button>
        </div>
          
          <!-- Modal body -->
          <div class="modal-body"> 
          {!! Form::open(['route' => 'adm-empresa.update', 'class' => 'was-validated']) !!}
            <input type="hidden" id="id" name="id">      
            <div class="row">                
                <!-- select grupo empresa      -->
                <div class="col-4">
                    <h7 id="grupo"></h7>
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><b>Grupo</b></span>
                        </div>
                        <select class="form-control custom-select rounded-0" id="grupoe" style="text-transform:uppercase"  required>
                            <option value="">Seleccione un grupo..</option>
                            @foreach($grupos as $grupo)
                                <option value="{{ $grupo->id}}">{{ $grupo->nombre }}</option>
                            @endforeach                   
                        </select>
                        <div class="invalid-feedback">Debes Ingresar datos</div>
                        <div class="valid-feedback">¡Se esta Ingresando Datos!</div>
                    </div>
                </div>
                <!-- select sub grupo empresa      -->
                <div class="col-4">
                    <h7 id="sub"></h7>
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><b>Sub Grupo</b></span>                        
                        </div>
                        <select class="form-control custom-select rounded-0" id="subgrupoe" style="text-transform:uppercase" required>

                        </select>
                        <div class="invalid-feedback">Debes Ingresar datos</div>
                        <div class="valid-feedback">¡Se esta Ingresando Datos!</div>
                    </div>
                </div>
                <!-- select rubro empresa      -->
                <div class="col-4">
                    <h7 id="rubro"></h7>
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                        <span class="input-group-text"><b>Rubro</b></span>
                        </div>
                        <select class="form-control custom-select rounded-0" name="rubroempresa_id" id="rubroe" style="text-transform:uppercase" required>

                        </select>
                        <div class="invalid-feedback">Debes Ingresar datos</div>
                        <div class="valid-feedback">¡Se esta Ingresando Datos!</div>
                    </div>
                </div>
            </div>
            <div class="row">
              <div class="input-group mb-2 col-md-6">
                <div class="input-group-prepend">
                  <span class="input-group-text"><b>Nit</b></span>
                </div>
                <input type="text" class="form-control" id="nit" placeholder="Enter username" name="nit" style="text-transform:uppercase" required >
                <div class="invalid-feedback">Debes Ingresar datos</div>
                <div class="valid-feedback">¡Se esta Ingresando Datos!</div>
              </div>
              <div class="input-group mb-2 col-md-6">
                <div class="input-group-prepend">
                  <span class="input-group-text"><b>Sigla</b></span>
                </div>
                <input type="text" class="form-control" id="sigla" name="sigla" style="text-transform:uppercase">
                <div class="valid-feedback">¡Campo opcional!</div>
              </div>
            </div>
            <div class="input-group mb-2">
              <div class="input-group-prepend">
                <span class="input-group-text"><b>Razon Social</b></span>
              </div>
              <input type="text" class="form-control" id="razonsocial" placeholder="Enter username" name="razonsocial" style="text-transform:uppercase" required>
              <div class="invalid-feedback">Debes Ingresar datos</div>
              <div class="valid-feedback">¡Se esta Ingresando Datos!</div>
            </div>

            <div class="input-group mb-2">
              <div class="input-group-prepend">
                <span class="input-group-text"><b>Dirección</b></span>
              </div>
              <textarea class="form-control" rows="3" name="direccion" id="direccion" style="text-transform:uppercase"></textarea>
              <div class="valid-feedback">¡Campo opcional!</div>
            </div>
            
            <div class="row">
              <div class="col-6">
                <div class="form-group">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><b>Telefono</b></i></span>
                    </div>
                    <input type="text" class="form-control" name="telempresa" id="telempresa" style="text-transform:uppercase">
                    <div class="valid-feedback">¡Campo opcional!</div>
                  </div>
                </div>
              </div>
              <div class="col-6">
                <div class="form-group">
                  <div class="input-group">
                    <div class="input-group-prepend">
                    <span class="input-group-text"><b>Correo</b></span>
                    </div>
                    <input type="email" class="form-control" id="emailempresa" name="emailempresa" placeholder="Email">
                    <div class="valid-feedback">¡Campo opcional!</div>
                  </div>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"><b>Contacto</b></span>
                </div>
                <input type="text" class="form-control" name="contacto" id="contacto" style="text-transform:uppercase">
                <div class="valid-feedback">¡Campo opcional!</div>
              </div>
            </div>
            <p class="bg-warning text-center"><b> Datos del Contacto </b></p>

            <div class="row">
              <div class="col-6">
                <div class="form-group">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><b>Telefono</b></span>
                    </div>
                    <input type="text" class="form-control" name="telefonocontacto" id="telefonocontacto" style="text-transform:uppercase">
                    <div class="valid-feedback">¡Campo opcional!</div>
                  </div>
                </div>
              </div>
              <div class="col-6">
                <div class="form-group">
                  <div class="input-group">
                    <div class="input-group-prepend">
                    <span class="input-group-text"><b>Correo</b></span>
                    </div>
                    <input type="email" class="form-control" name="emailcontacto" id="emailcontacto" placeholder="Email">
                    <div class="valid-feedback">¡Campo opcional!</div>
                  </div>
                </div>
              </div>
            </div>            
            <div class="form-group">
              <label>Provee Personal:</label>
              <div class="custom-control custom-radio">
                <input class="custom-control-input" type="radio" value="1" id="customRadio3" name="personal">
                <label for="customRadio3" class="custom-control-label text-dark">Si</label>
              </div>
              <div class="custom-control custom-radio">
                <input class="custom-control-input" type="radio" value="0" id="customRadio4" name="personal" checked>
                <label for="customRadio4" class="custom-control-label text-dark">No</label>
              </div>                        
            </div>
              
          </div>
          
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-secondary" data-dismiss="modal" data-toggle="tooltip" title="Volver al Listado">Cancelar</button>
            <button type="submit" class="btn btn-primary" title="Continuar">Guardar</button>            
          </div>  
          {!! Form::close() !!} 
      </div>
    </div>
</div> 



<script type="text/javascript">

    $(function()
    {
        $('#grupo').on('change', onselect_subgrupo);
        $('#subgrupo').on('change', onselect_rubro);

        $('#grupoe').on('change', onselect_subgrupo);
        $('#subgrupoe').on('change', onselect_rubro);
    }); 
    function onselect_subgrupo()
    {      
        var grupo =  $(this).val();
        if(grupo >=1)
        {
          $.get('{{route('selectsubgrupo')}}/'+grupo, function(data){
            var html_subgrupo=    '<option value="">Seleccione Sub Grupo..</option>'
                for(var i=0; i<data.length; ++i)
                html_subgrupo += '<option value="'+data[i].id+'">'+data[i].descripcion+'</option>'

            $('#subgrupo').html(html_subgrupo);
            var html_rubro=    ''       
            $('#rubro').html(html_rubro);    
            
            $('#subgrupoe').html(html_subgrupo);
            var html_rubro=    ''       
            $('#rubroe').html(html_rubro);
            
            
          });
        }
        else
        {
          var html_subgrupo=    ''       
          $('#subgrupo').html(html_subgrupo);
          var html_rubro=    ''       
          $('#rubro').html(html_rubro);

          var html_subgrupo=    ''       
          $('#subgrupoe').html(html_subgrupo);
          var html_rubro=    ''       
          $('#rubroe').html(html_rubro);
        }
    }
    function onselect_rubro()
    {      
        var subgrupo =  $(this).val();
    
        if(subgrupo >=1)
        {
          $.get('{{route('selectrubro')}}/'+subgrupo, function(data){
            var html_rubro=    '<option value="">Seleccione un Rubro..</option>'
                for(var i=0; i<data.length; ++i)
                html_rubro += '<option value="'+data[i].id+'">'+data[i].descripcion+'</option>'

            $('#rubro').html(html_rubro);
            $('#rubroe').html(html_rubro);
          });
        }
        else
        {
          var html_rubro=    ''       
          $('#rubro').html(html_rubro);
          $('#rubroe').html(html_rubro);
        }
    }



    $('#modalEditar').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget) //captura valor del data-empresa=""

      var id = button.data('id')
      var modal = $(this)

      $.get('{{route('selectempresa')}}/'+id, function(data){
        modal.find('.modal-body #grupo').text(data[0].grupo)
        modal.find('.modal-body #sub').text(data[0].sub)
        modal.find('.modal-body #rubro').text(data[0].rubro)

        modal.find('.modal-body #id').val(data[0].id)
        modal.find('.modal-body #nit').val(data[0].nit)
        modal.find('.modal-body #sigla').val(data[0].sigla)
        modal.find('.modal-body #razonsocial').val(data[0].razonsocial)
        modal.find('.modal-body #direccion').val(data[0].direccion)
        modal.find('.modal-body #telempresa').val(data[0].telempresa)
        modal.find('.modal-body #emailempresa').val(data[0].emailempresa)
        modal.find('.modal-body #contacto').val(data[0].contacto)
        modal.find('.modal-body #telefonocontacto').val(data[0].telefonocontacto)
        modal.find('.modal-body #emailcontacto').val(data[0].emailcontacto)
      });

      
    });


  
</script>



@endsection