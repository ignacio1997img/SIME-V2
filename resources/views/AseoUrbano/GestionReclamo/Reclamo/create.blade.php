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
                        <li class="breadcrumb-item"><a href="{{route('reclamo.index')}}">Reclamo</a></li>
                        <li class="breadcrumb-item active">Registrar Reclamo</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->




    <div class="container" style="width: 800px;">
        <div class="card card-outline card-info">
            <div class="card-header text-center">
                <h4 class="card-title">REGISTRAR RECLAMO</h4>
            </div>
            <div class="card-body">
                {!! Form::open(['route' => 'reclamo.store', 'class' => 'was-validated'])!!}

                <div class="row">
                    <div class="input-group mb-2 col-5">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><b>Fecha</b></span>
                        </div>
                        <input type="datetime-local" class="form-control"  name="fechareclamo" id="fechareclamo" value="{{old('fechareclamo')}}" required>
                        <div class="invalid-feedback">Debes Ingresar datos</div>
                        <div class="valid-feedback">¡Se esta Ingresando Datos!</div>
                    </div>
                    <div class="input-group mb-2 col-7">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><b>Contacto</b></span>
                        </div>
                        <select class="form-control select2bs4" name="contacto_id" id="contacto_id" style="text-transform:uppercase" required>
                            <option value="">Seleccione un contacto..</option>
                                @foreach ($contactos as $con)
                                    <option value="{{$con->id}}" {{ old('contacto_id') == $con->id ? 'selected' : '' }}>{{strtoupper($con->nombrecompleto)}}</option>
                                @endforeach                         
                        </select>
                        <div class="input-group-append">
                            <a class="btn btn-outline-success" data-toggle="modal" data-target="#modalcontacto" href="" id="contactos"><i class="fas fa-user-plus fa-fw"></i></a>
                        </div>
                        <div class="invalid-feedback">Debes Ingresar datos</div>
                        <div class="valid-feedback">¡Se esta Ingresando Datos!</div>
                    </div>                
                </div>
                <div class="row">
                    <div class="input-group mb-2 col-5">
                        <div class="input-group-prepend">
                        <span class="input-group-text"><b>Barrio</b></span>
                        </div>
                        <select class="form-control select2bs4" id="barrio" style="text-transform:uppercase" required>
                        <option value="">Seleccione un barrio..</option>
                            @foreach ($barrios as $barrio)
                                <option value="{{$barrio->id}}" {{ old('barrio') == $barrio->id ? 'selected' : '' }}>{{$barrio->descripcion}}</option>
                            @endforeach                         
                        </select>
                        <div class="invalid-feedback">Debes Ingresar datos</div>
                        <div class="valid-feedback">¡Se esta Ingresando Datos!</div>
                    </div>
                    <div class="input-group mb-2 col-7">
                        <div class="input-group-prepend">
                        <span class="input-group-text"><b>Calle</b></span>
                        </div>
                        <select class="form-control select2bs4" id="calle_id" name="calle_id"  style="text-transform:uppercase" required>
                    
                        </select>
                        <div class="input-group-append">
                            <a class="btn btn-outline-success" data-toggle="modal" data-target="#modalCalle" href="" id="calle"><i class="fas fa-road"></i></a>
                        </div>
                        <div class="invalid-feedback">Debes Ingresar datos</div>
                        <div class="valid-feedback">¡Se esta Ingresando Datos!</div>
                    </div>
                </div>
                <div class="input-group mb-2 ">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><b>Descripcion</b></span>
                    </div>
                    <textarea class="form-control col-md-11" rows="3" name="descripcion" id="descripcion" style="text-transform:uppercase" maxlength="500" required>{{old('descripcion')}}</textarea>
                    <div class="invalid-feedback">Debes Ingresar datos</div>
                    <div class="valid-feedback">¡Se esta Ingresando Datos!</div>
                </div>  
                


                <div>
                    <a href="{{route ('reclamo.index') }}" class="btn btn-warning" data-toggle ="tooltip" data-placement="bottom" title="Volver al Listado"><i class="fas fa-arrow-alt-circle-left" style="width:20px; height:20px;">
                        </i> Cancelar</a>

                    <button type="submit" class="btn btn-primary"><i class="far fa-check-circle" style="width:20px; height:20px;"></i> Guardar</button>
                </div>

                {!! Form::close() !!}

            </div>
        </div>
    </div>

    <div class="modal fade" id="modalcontacto">
        <div class="modal-dialog" role="document">
            <div class="modal-content">        
                <!-- Modal Header -->
                <div class="modal-header bg-success">
                    <h4 class="modal-title">Registrar Contacto</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                
                <!-- Modal body -->
                <div class="modal-body">
                {!! Form::open(['route' => 'contacto.store', 'class' => 'was-validated', 'id'=> 'formcontacto'])!!}

                    <input type="hidden" id="fechareclamo" name="fechareclamo">
                    <input type="hidden" id="barrio" name="barrio">
                    {{-- <input type="hidden" id="contacto_id" name="contacto_id"> --}}
                    <input type="hidden" id="calle_id" name="calle_id">
                    <input type="hidden" id="descripcion" name="descripcion">
    
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                        <span class="input-group-text"><b>Nombre</b></span>
                        </div>
                        <input type="text" id="nombrecompleto" name="nombrecompleto" class="form-control" style="text-transform:uppercase" minlength="3" maxlength="150" required>
                        <div class="invalid-feedback">Debes Ingresar datos</div>
                        <div class="valid-feedback">¡Se esta Ingresando Datos!</div>
                    </div>
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                        <span class="input-group-text"><b>Telefono</b></span>
                        </div>
                        <input type="text" id="telefono" name="telefono" class="form-control" style="text-transform:uppercase" maxlength="50">
                        <div class="invalid-feedback">Debes Ingresar datos</div>
                        <div class="valid-feedback">¡Se esta Ingresando Datos!</div>
                    </div>
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><b>Dirección</b></span>
                        </div>
                        <textarea class="form-control" rows="3" name="direccion" id="direccion" style="text-transform:uppercase" maxlength="500"></textarea>
                        <div class="valid-feedback">¡Campo opcional!</div>
                    </div>
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><b>Referencia</b></span>
                        </div>
                        <textarea class="form-control" rows="3" name="referencia" id="referencia" style="text-transform:uppercase" maxlength="500"></textarea>
                        <div class="valid-feedback">¡Campo opcional!</div>
                    </div>
                    
                </div>
                
                <!-- Modal footer -->
                <div class="modal-footer justify-content-between">
                    <button type="button text-left" class="btn btn-secondary btn-sm" data-dismiss="modal" data-toggle="tooltip" title="Volver al Listado">Cancelar
                    </button>
                    <button type="submit" class="btn btn-success btn-sm" title="Continuar">
                        Guardar
                    </button>
                </div>
                {!! Form::close()!!} 
                
            </div>
        </div>
    </div>

         <!-- The Modal Registrar-->
         <div class="modal fade" id="modalCalle">
            <div class="modal-dialog">s
                <div class="modal-content">        
                    <!-- Modal Header -->
                    <div class="modal-header bg-success">
                        <h4 class="modal-title">Registrar Calle</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    
                    <!-- Modal body -->
                    <div class="modal-body">
                    {!! Form::open(['route' => 'calle.store', 'class' => 'was-validated', 'id'=> 'formcalle'])!!}

                    <input type="hidden" id="fechareclamo" name="fechareclamo">
                    <input type="hidden" id="barrio" name="barrio">
                    <input type="hidden" id="contacto_id" name="contacto_id">
                    {{-- <input type="hidden" id="calle_id" name="calle_id"> --}}
                    <input type="hidden" id="descripcion" name="descripcion">

                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><b>Barrios</b></span>
                            </div>
                            <select class="form-control select2bs4" name="barrio_id" id="barrio_id" style="text-transform:uppercase" required>
                                <option value="">Seleccione un barrio..</option>
                                @foreach($barrios as $bar)
                                    <option value="{{$bar->id}}">{{strtoupper($bar->descripcion)}}</option>
                                @endforeach    
                            </select>
                            <div class="invalid-feedback">Debes Ingresar datos</div>
                            <div class="valid-feedback">¡Se esta Ingresando Datos!</div>
                        </div>
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                            <span class="input-group-text"><b>Calle</b></span>
                            </div>
                            <input type="text" id="calle" name="calle" class="form-control" style="text-transform:uppercase" minlength="3" maxlength="100" required>
                            <div class="invalid-feedback">Debes Ingresar datos</div>
                            <div class="valid-feedback">¡Se esta Ingresando Datos!</div>
                        </div>
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><b>Descripcion</b></span>
                            </div>
                            <textarea class="form-control" rows="3" name="desc" id="desc" style="text-transform:uppercase"></textarea>
                            <div class="invalid-feedback">Debes Ingresar datos</div>
                            <div class="valid-feedback">¡Se esta Ingresando Datos!</div>
                        </div>
                    </div>
                    
                    <!-- Modal footer -->
                    <div class="modal-footer justify-content-between">
                    <button type="button text-left" class="btn btn-secondary btn-sm" data-dismiss="modal" data-toggle="tooltip" title="Volver al Listado">Cancelar
                    </button>
                    <button type="submit" class="btn btn-success btn-sm" title="Continuar">
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
        arrio = "{{ old('descripcion')}}";
        // alert(arrio)
        onselect_barrio(1)
        $('#barrio').on('change', onselect_barrio);

        // alert(1)
    });

    var barrios=0;
    $('#modalcontacto').on('show.bs.modal', function (event) {
                $('#formcontacto').trigger('reset');
                var button     = $(event.relatedTarget)
                var fecha     = $('#fechareclamo').val();
                var barrio     = $('#barrio').val();
                var contacto_id     = $('#contacto_id').val();
                var calle_id     = $('#calle_id').val();
                // alert(calle_id)
                var descripcion     = $('#descripcion').val();
                // alert(descripcion)
               
                var modal = $(this)
                modal.find('.modal-body #fechareclamo').val(fecha)
                modal.find('.modal-body #barrio').val(barrio)
                modal.find('.modal-body #calle_id').val(calle_id)
                modal.find('.modal-body #descripcion').val(descripcion)

                // onselect_barrio();
            });

            $('#modalCalle').on('show.bs.modal', function (event) {
                $('#formcalle').trigger('reset');
                var button     = $(event.relatedTarget)
                var fecha     = $('#fechareclamo').val();
                var barrio     = $('#barrio').val();
                var contacto_id     = $('#contacto_id').val();
                // var calle_id     = $('#calle_id').val();
                // alert(calle_id)
                var descripcion     = $('#descripcion').val();
                // alert(descripcion)
               
                var modal = $(this)
                modal.find('.modal-body #fechareclamo').val(fecha)
                modal.find('.modal-body #barrio').val(barrio)
                modal.find('.modal-body #contacto_id').val(contacto_id)
                modal.find('.modal-body #descripcion').val(descripcion)

                // onselect_barrio();
            });

    function onselect_barrio(ok)
    {
        if(ok == 1)
        {            
            barrio = "{{ old('barrio')}}";
        }
        else
        {
            barrio =  $(this).val(); 
        }
        $.get('{{route('selecreclamocalle')}}/'+barrio, function(data){
                var html_calle=    '<option value="">Seleccione una calle..</option>'
                    for(var i=0; i<data.length; ++i)
                    html_calle += '<option value="'+data[i].id+'" {{ old("calle_id") == '+data[i].id+' ? "selected" : "" }}>'+data[i].calle+'</option>'

                $('#calle_id').html(html_calle);           
            });
        
        
          
    }


 
    
</script>
   



@endsection
