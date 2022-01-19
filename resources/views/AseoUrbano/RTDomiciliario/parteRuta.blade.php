@extends('Layout.HomeAseoUrbano')
@section('content')

<script src="{{asset('01.js')}}"></script>

<style>
    #div2 {
        overflow-y:scroll;
        height:400px;
    }
</style>
    <div class="content-header">
        <div>
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"><i class="fas fa-receipt"></i> Parte Diario</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('aseourbano')}}">Home</a></li>       
                        <li class="breadcrumb-item"><a href="{{route('despacho.index')}}">Despacho</a></li> 
                        <li class="breadcrumb-item"><a href="{{route('detalledespachos', $detalle->despacho_id)}}">Detalle Despacho</a></li> 
                        <li class="breadcrumb-item active">Parte Diario</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    {!! Form::open(['route' => 'despachoparte.store', 'class' => 'was-validated', 'enctype' => 'multipart/form-data'])!!}
    <div class="container-fluid container-responsive" id="app">

        <div class="card table-responsive card-outline card-success">
            <div class="card-header">
                <div class="row">
                    <div class="col-6" style="text-transform:uppercase">
                        <h4><b>PARTE DIARIO DE LA {{$detalle->ruta->descripcion}}</b></h4>
                    </div>
                    <div class="col-3">
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><b>Nro Parte</b></span>
                            </div>
                            <input type="text" name="parte" id="parte" value="{{old('parte')}}" class="form-control" onkeypress='return validaNumericos(event)' required>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="dropdown dropleft float-right">
                            <button type="submit" class="btn btn-success" data-toggle="modal" data-target="#modalRegistrar">
                            <i class="far fa-save"></i> Siguiente
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body" id="div2">
                <div class="row">
                    <div class="input-group mb-2 col-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><b>Dia y Fecha</b></span>
                        </div>
                        <input type="text" class="form-control" value="{{\Jenssegers\Date\Date::parse($detalle->fecha)->format('l j F Y')}}" disabled>
                    </div> 
                    <div class="input-group mb-2 col-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><b>Zona</b></span>
                        </div>
                        <input type="text" class="form-control" value="{{$detalle->ruta->zona->nombre}}" disabled>
                    </div>
                    <div class="input-group mb-2 col-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><b>Turno</b></span>
                        </div>
                        <select class="form-control custom-select rounded-0" name="turno" required>
                            <option value="">Seleccione un turno..</option>
                            <option value="DIURNO">DIURNO</option>
                            <option value="NOCTURNO">NOCTURNO</option>              
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="input-group mb-2 col-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><b>Trabajo</b></span>
                        </div>
                        <select class="form-control custom-select rounded-0" name="cotidiano" required>
                            <option value="">Seleccione opcion..</option>
                            <option value="1">COTIDIANO</option>
                            <option value="0">CONTROL</option>              
                        </select>
                    </div>
                    <div class="input-group mb-2 col-5">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><b>Vehiculo</b></span>
                        </div>
                        <input type="text" class="form-control" value="{{$vehiculo[0]->interno}} - {{$vehiculo[0]->tipo->descripcion}} - {{$vehiculo[0]->modelo->marca->descripcion}} - {{$vehiculo[0]->placa}}" disabled>
                    </div>
                    @if($cantCombustible != 1)                    
                        <div class="input-group mb-2 col-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><b>Combustible</b></span>
                            </div>
                            <select class="form-control custom-select rounded-0" name="combustible" id = "select" onchange = "myFunction()" required>
                                <option value="">Seleccione opcion..</option>
                                <option value="0">NO</option>   
                                <option value="1">SI</option>                                    
                            </select>
                        </div>
                    @else
                        <div class="input-group mb-2 col-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><b>Combustible</b></span>
                            </div>
                            <input type="text" class="form-control" value="Si" disabled>
                            <input type="hidden" class="form-control" name="combustible" value="1">
                            <a class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modalCombustibleBorrar" title="Borrar Combustible">
                                <i class="far fa-trash-alt"></i>
                            </a>
                        </div>
                    @endif
                </div>
                <div class="row">
                    <div class="input-group mb-2 col-6">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><b>Chofer</b></span>
                        </div>
                        <select class="form-control custom-select rounded-0" name="chofer" id="chofer" required>
                            
                        </select>
                    </div>
                    <div class="input-group mb-2 col-6">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><b>Registrado Por:</b></span>
                        </div>
                        <select class="form-control custom-select rounded-0" name="registradorparte_id" id="registradorparte_id" required>
                        <option value="">Seleccione un ..</option>     
                            @foreach($registrado as $reg)  
                                <option value="{{$reg->id}}" {{ old("registradorparte_id") == $reg->id ? "selected" : "" }}>{{$reg->nombre}} {{$reg->apellidopaterno}} {{$reg->apellidomaterno}}</option>
                            @endforeach  
                                  
                        </select>
                    </div>
                </div>

                @if($cantCombustible >= 1)
                <p class="bg-warning text-center"><b>Datos del Combustible <i class="fas fa-gas-pump"></i></b></p>
                <div class="row">
                    <div class="input-group mb-2 col-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><b>Nro. Boleta</b></span>
                        </div>
                        <input type="text" class="form-control" value="{{$combustible[0]->boleta}}" disabled>
                    </div>
                    <div class="input-group mb-2 col-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><b>Nro. Factura</b></span>
                        </div>
                        <input type="text" class="form-control" value="{{$combustible[0]->factura}}" disabled>
                    </div> 
                    <div class="input-group mb-2 col-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><b>Nro. Orden</b></span>
                        </div>
                        <input type="text" class="form-control" value="{{$combustible[0]->orden}}" disabled>
                    </div> 
                </div>
                <div class="row">
                    <div class="input-group mb-2 col-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><b>Nro. Contrato</b></span>
                        </div>
                        <input type="text" class="form-control" value="{{$combustible[0]->contrato}}" disabled>
                    </div>
                    <div class="input-group mb-2 col-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><b>Tipo</b></span>
                        </div>
                        <input type="text" class="form-control" value="{{$vehiculo[0]->combustible}}" disabled>
                    </div>
                    <div class="input-group mb-2 col-2">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><b>Litros</b></span>
                        </div>
                        <input type="text" class="form-control" value="{{$combustible[0]->litro}}" disabled>
                    </div>
                    <div class="input-group mb-2 col-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><b>Bs.</b></span>
                        </div>
                        <input type="text" class="form-control" value="{{$combustible[0]->bs}}" disabled>
                    </div>
                </div>
                @endif



                <div class="input-group mb-2">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><b>Observaciones</b></span>
                    </div>
                    <textarea class="form-control" rows="5" name="obsparte" id="obsparte" style="text-transform:uppercase"></textarea>
                    <div class="valid-feedback">¡Campo opcional!</div>
                </div>  
                <div class="form-row" id="deexterna">
                    <!-- Ingresa el Nombre y Cargo de la documentacion externa -->      
                </div>

                <input type="hidden" name="fecha" value="{{$detalle->fecha}}"> 
                <input type="hidden" name="despachodetalle_id" value="{{$detalle->id}}">          
            </div>
        </div>
    </div>
    {!! Form::close()!!} 



<div id="modalCombustible" class="modal hide fade in" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog">
      <div class="modal-content">      
        <!-- Modal Header -->
        @if($vehiculo[0]->combustible == "GASOLINA")
            <div class="modal-header bg-danger">
                <h4 class="modal-title"><i class="fas fa-gas-pump"></i> {{$vehiculo[0]->combustible}}</h4>
                <button type="button" onclick="selectFunction()" class="close" data-dismiss="modal">&times;</button>
            </div>
        @else
            <div class="modal-header bg-primary">
                <h4 class="modal-title"><i class="fas fa-gas-pump"></i> {{$vehiculo[0]->combustible}}</h4>
                <button type="button" onclick="selectFunction()" class="close" data-dismiss="modal">&times;</button>
            </div>     
        @endif   
        <!-- Modal body -->
        <div class="modal-body">
        {!! Form::open(['route' => 'combustibles.store', 'class' => 'was-validated','method' => 'POST', 'id' => 'formcontacto'])!!}

        <input type="hidden" id="parte" name="parte">
        <input type="hidden" id="registradorparte_id" name="registradorparte_id">
        <input type="hidden" id="chofer" name="chofer">

            <input type="hidden" name="despachodetalle_id" value="{{$detalle->id}}"> 
            
            <div class="input-group mb-2">
                    <div class="input-group-prepend">
                    <span class="input-group-text"><b>Nro. Boleta</b></span>
                    </div>
                    <input type="text" name="boleta" class="form-control" onkeypress='return validaNumericos(event)' required>
                    <div class="invalid-feedback">Debes Ingresar datos</div>
                    <div class="valid-feedback">¡Se esta Ingresando Datos!</div>                    
            </div>
            <div class="input-group mb-2">
                    <div class="input-group-prepend">
                    <span class="input-group-text"><b>Nro. Factura</b></span>
                    </div>
                    <input type="text" name="factura" class="form-control" onkeypress='return validaNumericos(event)'>
                    <div class="valid-feedback">¡Campo opcional!</div>             
            </div>
            <div class="input-group mb-2">
                    <div class="input-group-prepend">
                    <span class="input-group-text"><b>Nro. Orden</b></span>
                    </div>
                    <input type="text" name="orden" class="form-control" onkeypress='return validaNumericos(event)'>
                    <div class="valid-feedback">¡Campo opcional!</div>               
            </div>
            <div class="input-group mb-2">
                    <div class="input-group-prepend">
                    <span class="input-group-text"><b>Nro. Contrato</b></span>
                    </div>
                    <input type="text" name="contrato" class="form-control" onkeypress='return validaNumericos(event)'>
                    <div class="valid-feedback">¡Campo opcional!</div>                 
            </div>
            <div class="row">
                <div class="input-group mb-2 col-6">
                    <div class="input-group-prepend">
                    <span class="input-group-text"><b>Litros</b></span>
                    </div>
                    <input type="number" step="any" id="inputDecimal" name="litro" class="form-control" required>
                    <div class="invalid-feedback">Debes Ingresar datos</div>
                    <div class="valid-feedback">¡Se esta Ingresando Datos!</div>
                    
                </div>
                <div class="input-group mb-2 col-6">
                    <div class="input-group-prepend">
                    <span class="input-group-text"><b>Bs.</b></span>
                    </div>
                    <input type="number" step="any" id="inputDecimal1" name="bs" class="form-control" required>
                    <div class="invalid-feedback">Debes Ingresar datos</div>
                    <div class="valid-feedback">¡Se esta Ingresando Datos!</div>                    
                </div>
            </div>

            
        
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer justify-content-between">
            <button type="button" onclick="selectFunction()" class="btn btn-secondary btn-sm" data-dismiss="modal" data-toggle="tooltip" title="Volver al Listado">Cancelar
            </button>
            @if($vehiculo[0]->combustible == "GASOLINA")
                <button type="submit" class="btn btn-danger btn-sm" title="Continuar"> Guardar
                </button>
            @else
                <button type="submit" class="btn btn-primary btn-sm" title="Continuar"> Guardar
                </button>
            @endif
        </div>
        {!! Form::close()!!} 
        
      </div>
    </div>
</div>


<div id="modalCombustibleBorrar" class="modal hide fade in" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog">
      <div class="modal-content">      
        <!-- Modal Header -->
        <div class="modal-header bg-danger">
          <h4 class="modal-title"><i class="fas fa-gas-pump"></i> Borrar Combustible</h4>
          <button type="button" onclick="selectFunction()" class="close" data-dismiss="modal">&times;</button>
        </div>        
        <!-- Modal body -->
        <div class="modal-body">
        {!! Form::open(['route' => 'destroy.combustible', 'method' => 'DELETE']) !!}
            <input type="hidden" name="despachodetalle_id" value="{{$detalle->id}}"> 

            <div class="text-center" style="text-transform:uppercase">
                <i class="far fa-trash-alt" style="color: red; font-size: 5em;"></i>
                <br>
                
                <p><b>Eliminar Combustible.</b></p>
            </div>
        
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal" data-toggle="tooltip" title="Volver al Listado">Cancelar
          </button>
          <button type="submit" class="btn btn-danger btn-sm" title="Continuar">Borrar
          </button>
        </div>
        {!! Form::close()!!} 
        
      </div>
    </div>
</div>



<script type="text/javascript">
    var despacho=0;
    $(function()
    {
        despacho = "<?php echo $detalle->despacho_id; ?>";
        onselect_elaboradorpartediario();
        
        

        // select_sigla()
    });

    function myFunction() {
        var option_value = document.getElementById("select").value;
        if (option_value == "1") {
            $("#modalCombustible").modal();
        }
    }

    //para volver al select een su estado por defecto o default 
    var selectFunction = function() {
        document.getElementById("select").value = "";
    };

    
    function onselect_elaboradorpartediario()
    {
        // alert(despacho)
          $.get('{{route('selectpersonas')}}/'+1+'/'+despacho, function(data){ 
      
            var html_persona=    '<option value="">Seleccione una persona..</option>'
                for(var i=0; i<data.length; ++i)
                html_persona += '<option value="'+data[i].id+'" {{ old("chofer") == '+data[i].id+' ? "selected" : "" }}>'+data[i].nombre +'</option>'

            $('#chofer').html(html_persona);          
          });
    };

    $('#modalCombustible').on('show.bs.modal', function (event) {
                $('#formcontacto').trigger('reset');
                var button     = $(event.relatedTarget)
                var parte     = $('#parte').val();
                var registradorparte_id     = $('#registradorparte_id').val();
                var chofer     = $('#chofer').val();
               
                alert(chofer)
                var modal = $(this)
           
                modal.find('.modal-body #parte').val(parte)
                modal.find('.modal-body #registradorparte_id').val(registradorparte_id)
                modal.find('.modal-body #chofer').val(chofer)
    });


</script>

@endsection