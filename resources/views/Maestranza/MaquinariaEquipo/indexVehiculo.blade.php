@extends('Layout.HomeMaestranza')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div>
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"><i class="fas fa-file-alt"></i> Vehiculo</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('maestranza')}}">Home</a></li>       
              <li class="breadcrumb-item active">Vehiculo</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <div class="container-fluid">
   <div style="padding-bottom: 5px;">
      <a class="btn btn-warning" data-toggle="tooltip" href="{{route('maestranza')}}" title="Volver al menu principal">
         <i class="fas fa-arrow-alt-circle-left" style="width:20; height:20;"></i>
         Volver
      </a>
     
        <a class="btn btn-success" data-toggle="modal" data-target="#modalRegistrar" title="Registrar Tipos de Documentos">
          <i class="fas fa-plus">
          </i>
          Registrar
        </a> @can('ma-tipovehiculo.store')
      @endcan
   </div>
   <div class="card table-responsive card-outline card-info">
      <div class="card-header">
         <div>
            <th>
               <h4 class="card-title text-center ">
               LISTA DE TIPO DE VEHICULO
               </h4>
            </th>
         </div>
      </div>
      <div class="card-body">
         <table class="table table-bordered table-hover table-sm" id="example2">
            <thead>
               <tr>
                  <th class="text-center" width="50">ID</th>
                  <th class="text-center">TIPO</th> 
                  <th class="text-center">MARCA</th>      
                  <th class="text-center">MODELO</th>   
                  <th class="text-center">PERTENECE A</th> 
                    
               </tr>
            </thead>
            <tbody>
                @foreach($vehiculos as $ve)
                    <tr>
                        <td>{{$ve->interno}}</td>
                        <td>{{$ve->tipo->descripcion}}</td>
                        <td>{{$ve->modelo->marca->descripcion}}</td>
                        <td>{{$ve->modelo->descripcion}}</td>
                        <td>{{$ve->empresa->razonsocial}}</td>
                    </tr>
                @endforeach              
            </tbody>
         </table>
      </div>
   </div>
</div>



  <!-- The Modal Registrar-->
<div class="modal" id="modalRegistrar">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header bg-success">
          <h4 class="modal-title">Registrar Vehiculo</h4>
          <button type="button" class="close" data-dismiss="modal">×</button>
        </div>
          
          <!-- Modal body -->
          <div class="modal-body"> 
          {!! Form::open(['route' => 'vehiculo.store', 'class' => 'was-validated']) !!}      
            <div class="row">
                <div class="col-4">
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><b>Propiedad</b></span>
                        </div>
                        <select class="form-control custom-select rounded-0" name="propiedad" id="propiedad" required>
                            <option value="">Seleccione una opcion..</option>
                            <option value="1">PROPIA</option>
                            <option value="2">ALQUILADA</option>
                            <option value="3">PRESTADA</option>
                        </select>
                        <div class="invalid-feedback">Debes Ingresar datos</div>
                        <div class="valid-feedback">¡Se esta Ingresando Datos!</div>
                    </div>
                </div>
                <div class="col-8">
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><b>Empresa</b></span>
                        </div>
                        <select class="form-control custom-select rounded-0" name="empresa_id" id="empresa_id" required>
                            
                        </select>
                        <div class="invalid-feedback">Debes Ingresar datos</div>
                        <div class="valid-feedback">¡Se esta Ingresando Datos!</div>
                    </div>
                </div>
                
            </div>
            
            <div class="row">                    
                <div class="col-3">
                    <div class="input-group mb-2" id="div_sugerencia">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><b>Interno</b></span>
                        </div>
                        <input type="text" class="form-control" id="interno"  name="interno" style="text-transform:uppercase" required>
                        <div class="invalid-feedback">Debes Ingresar datos</div>
                        <div class="valid-feedback">¡Se esta Ingresando Datos!</div>
                    </div>
                </div>

                <div class="col-5">
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><b>Tipo de Vehiculo</b></span>
                        </div>
                        <select class="form-control custom-select rounded-0" name="tipo_id" id="tipo_id" required>
                            <option value="">Seleccione un tipo...</option>
                            @foreach($tipos as $tipo)
                                <option value="{{$tipo->id}}">{{$tipo->descripcion}}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback">Debes Ingresar datos</div>
                        <div class="valid-feedback">¡Se esta Ingresando Datos!</div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><b>Estado</b></span>
                        </div>
                        <select class="form-control custom-select rounded-0" name="estado" id="estado" required>
                            <option value="">Seleccione una opcion..</option>
                            <option value="FUNCIONAMIENTO">FUNCIONAMIENTO</option>
                            <option value="REPARACION">REPARACION</option>
                        </select>
                        <div class="invalid-feedback">Debes Ingresar datos</div>
                        <div class="valid-feedback">¡Se esta Ingresando Datos!</div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><b>Marca</b></span>
                        </div>
                        <select class="form-control custom-select rounded-0" id="marca_id" required>
                            <option value="">Seleccione un tipo...</option>
                            @foreach($marcas as $marca)
                                <option value="{{$marca->id}}">{{$marca->descripcion}}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback">Debes Ingresar datos</div>
                        <div class="valid-feedback">¡Se esta Ingresando Datos!</div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><b>Modelo</b></span>
                        </div>
                        <select class="form-control custom-select rounded-0" name="modelo_id" id="modelo_id" required>
                            
                        </select>
                        <div class="invalid-feedback">Debes Ingresar datos</div>
                        <div class="valid-feedback">¡Se esta Ingresando Datos!</div>
                    </div>
                </div>
            </div>
            
            <div class="row">                    
                <div class="col-4">
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><b>Año Fabricacion</b></span>
                        </div>
                        <input type="text" class="form-control" id="year" name="year" style="text-transform:uppercase">
                        <div class="valid-feedback">¡Campo opcional!</div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><b>Color</b></span>
                        </div>
                        <input type="text" class="form-control" id="colorunidad" name="colorunidad" style="text-transform:uppercase" required>
                        <div class="valid-feedback">¡Campo opcional!</div>
                    </div>
                </div>

                <div class="col-4">
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><b>Placa</b></span>
                        </div>
                        <input type="text" class="form-control" id="placa" name="placa" style="text-transform:uppercase">
                        <div class="valid-feedback">¡Campo opcional!</div>
                    </div>
                </div>
            </div>

            <div class="row">                    
                <div class="col-4">
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><b>Serie Nro.</b></span>
                        </div>
                        <input type="text" class="form-control" id="serieunidad" name="serieunidad" style="text-transform:uppercase">
                        <div class="valid-feedback">¡Campo opcional!</div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><b>Chasis Nro.</b></span>
                        </div>
                        <input type="text" class="form-control" id="chasis" name="chasis" style="text-transform:uppercase">
                        <div class="valid-feedback">¡Campo opcional!</div>
                    </div>
                </div>

                <div class="col-4">
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><b>Motor Nro.</b></span>
                        </div>
                        <input type="text" class="form-control" id="motor" name="motor" style="text-transform:uppercase" required>
                        <div class="valid-feedback">¡Campo opcional!</div>
                    </div>
                </div>
            </div>

            <div class="row">                    
                <div class="col-4">
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><b>Peso Vehiculo</b></span>
                        </div>
                        <input type="text" class="form-control" id="pesovehiculo" name="pesovehiculo" style="text-transform:uppercase">
                        <div class="valid-feedback">¡Campo opcional!</div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><b>Capacidad Kg</b></span>
                        </div>
                        <input type="text" class="form-control" id="capacidadkg" name="capacidadkg" style="text-transform:uppercase">
                        <div class="valid-feedback">¡Campo opcional!</div>
                    </div>
                </div>

                <div class="col-4">
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><b>Capacidad M3</b></span>
                        </div>
                        <input type="text" class="form-control" id="capacidadm3" name="capacidadm3" style="text-transform:uppercase">
                        <div class="valid-feedback">¡Campo opcional!</div>
                    </div>
                </div>
            </div>

            <div class="row">                    
                <div class="col-4">
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><b>Combustible</b></span>
                        </div>
                        <select class="form-control custom-select rounded-0" name="combustible" id="combustible" required>
                            <option value="">Seleccione una opcion..</option>
                            <option value="GASOLINA">GASOLINA</option>
                            <option value="DIESEL">DIESEL</option>
                        </select>
                        <div class="invalid-feedback">Debes Ingresar datos</div>
                        <div class="valid-feedback">¡Se esta Ingresando Datos!</div>
                    </div>
                </div>
                <div class="col-4" id="div_fechacompra">
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><b>Fecha Compra</b></span>
                        </div>
                        <input type="date" class="form-control" id="fechacompra" name="fechacompra" style="text-transform:uppercase">
                        <div class="valid-feedback">¡Campo opcional!</div>
                    </div>
                </div>

                <div class="col-4" id="div_costo">
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><b>Costo Bs.-</b></span>
                        </div>
                        <input type="text" class="form-control" id="montocompra" name="montocompra" style="text-transform:uppercase">
                        <div class="valid-feedback">¡Campo opcional!</div>
                    </div>
                </div>
            </div>
            <div class="col-4">
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><b>Peso Bascula</b></span>
                        </div>
                        <input type="text" class="form-control" id="bascula" name="bascula" style="text-transform:uppercase" required>
                        <div class="invalid-feedback">Debes Ingresar datos</div>
                        <div class="valid-feedback">¡Se esta Ingresando Datos!</div>
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


<script type="text/javascript">

var html_fecha='';
var html_costo='';
var html_suge =''
    $(function()
    {
        $('#marca_id').on('change', onselect_marca);
        $('#propiedad').on('change', onselect_empresa);
    });

    function onselect_marca()
    {
        var marca =  $(this).val();    
        if(marca >=1)
        {            
            
            $.get('{{route('selectmodelo')}}/'+marca, function(data){
                var html_modelo=    '<option value="">Seleccione un modelo...</option>'
                    for(var i=0; i<data.length; ++i)
                    html_modelo += '<option value="'+data[i].id+'">'+data[i].descripcion+'</option>'

                $('#modelo_id').html(html_modelo);;            
            });
        }
        else
        {
          var html_modelo=    ''       
          $('#modelo_id').html(html_modelo);
        }
    };

    function onselect_empresa()
    {
        var propiedad =  $(this).val();    
        if(propiedad >=1)
        {
            div_suge(propiedad)
            if(propiedad == 1)
            {
                div_costo()
                div_fecha()
            }
            else
            {
                html_fecha=''
                $('#div_fechacompra').html(html_fecha);
                html_costo=''
                $('#div_costo').html(html_costo);
            }
          $.get('{{route('selecthibridoempresa')}}/'+propiedad, function(data){
            var html_empresa=    '<option value="">Seleccione una empresa...</option>'
                for(var i=0; i<data.length; ++i)
                html_empresa += '<option value="'+data[i].id+'">'+data[i].razonsocial+'</option>'

            $('#empresa_id').html(html_empresa);;            
          });
        }
        else
        {
            interno(0)
            var html_empresa=    ''       
            $('#empresa_id').html(html_empresa);
            html_fecha=''
            $('#div_fechacompra').html(html_fecha);
            html_costo=''
            $('#div_costo').html(html_costo);
        }
    };


    function div_fecha()
    {
        html_fecha=     '<div class="input-group mb-2">'
        html_fecha+=        '<div class="input-group-prepend">'
        html_fecha+=            '<span class="input-group-text"><b>Fecha Compra</b></span>'
        html_fecha+=        '</div>'
        html_fecha+=        '<input type="date" class="form-control" id="fechacompra" name="fechacompra" style="text-transform:uppercase">'
        html_fecha+=        '<div class="valid-feedback">¡Campo opcional!</div>'
        html_fecha+=    '</div>'
        $('#div_fechacompra').html(html_fecha);
    }

    function div_costo()
    {
        html_costo=     '<div class="input-group mb-2">'
        html_costo+=        '<div class="input-group-prepend">'
        html_costo+=            '<span class="input-group-text"><b>Costo Bs.-</b></span>'
        html_costo+=        '</div>'
        html_costo+=        '<input type="text" class="form-control" id="montocompra" name="montocompra" style="text-transform:uppercase">'
        html_costo+=        '<div class="valid-feedback">¡Campo opcional!</div>'
        html_costo+=    '</div>'
        $('#div_costo').html(html_costo);
    }

    var aux=''
    var cad=''
    function div_suge(tip)
    {
        if(tip == 1)
        {
            aux='PROPIA'
        }
        else
        {
            if(tip == 2)
            {
                aux='ALQUILADA'
            }
            else
            {
                aux='PRESTADA'
            }
        }
        $.get('{{route('ajaxcalculo')}}/'+aux, function(data){

            if(tip == 1)
            {
                cad =data
            }
            else
            {
                if(tip == 2)
                {
                    cad ='ALQ-'+data
                }
                else
                {
                    if(tip == 3)
                    {
                        cad ='PRE-'+data
                    }
                    
                }
            }
            interno(cad)
        });
    }

    function interno(cad)
    {
        html_suge =     '<div class="input-group-prepend">'
            html_suge+=                    '<span class="input-group-text"><b>Interno</b></span>'
            html_suge+=                '</div>'
            if(cad== 0)
            {
                html_suge+=                '<input type="text" class="form-control" id="interno"  name="interno" style="text-transform:uppercase" required>'
            }
            else
            {
                html_suge+=                '<input type="text" class="form-control" id="interno"  name="interno" value="'+cad+'" style="text-transform:uppercase" required>'
            }            
            html_suge+=                '<div class="invalid-feedback">Debes Ingresar datos</div>'
            html_suge+=                '<div class="valid-feedback">¡Se esta Ingresando Datos!</div>'

            $('#div_sugerencia').html(html_suge);
    }

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