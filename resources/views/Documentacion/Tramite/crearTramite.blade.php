@extends('Layout.HomeDocumentacion')
@section('content')
<style>

#crear {
    overflow-y:scroll;
    height:420px;
}

</style>
    <div class="content-header">
      <div>
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"><i class="fas fa-cubes"></i> Nuevo Tramite</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('documentaciones')}}">Home</a></li>    
              <li class="breadcrumb-item"><a href="{{route('documentacion.index')}}">Bandeja</a></li>      
              <li class="breadcrumb-item active">Nuevo Tramite</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

    <div id="insertardoc">
        <div class="card card-outline card-info">
            <div class="card-header">
                <h4 class="card-title text-center">REGISTRAR TRÁMITE</h4>
            </div>

            <div class="card-body" id="crear">
            {!! Form::open(['route' => 'documentacion.store','class' => 'was-validated']) !!}
                
                <div class="form-row">
                    <div class="col-md-4">
                        {{ form::label('interna', 'Correspondencia : ', ['class'=> 'col-form-label'])}}
                        {{ form::select('interna',['1' => 'INTERNA', '2' => 'EXTERNA'], null, ['class' => 'form-control custom-select', 'placeholder'=>'Seleccione', 'id' => 'interna' ,'required']) }}
                         <div class="invalid-feedback">Debes Seleccionar un tipo de correspondencia</div>
                        <div class="valid-feedback">¡Se ve bien!</div>
                    </div>
                    <div class="col-md-3" id="mediante">
                        {{ form::label('tipo_id', '..... : ', ['class'=> 'col-form-label'])}}
                            <select class="form-control custom-select rounded-0" id="tip" name="tipo" required>
                            <option value="">Seleccione......</option>      
                            <option value="1">Cargo</option>
                            <option value="2">Reemplazo</option>
                        </select>
                        <div class="invalid-feedback">Debes Seleccionar un Tipo</div>
                        <div class="valid-feedback">¡Se ve bien!</div>                        
                    </div>
                    <!-- <div class="col-md-2" id="tipo_cargo">
                        
                    </div> -->
                    <div class="col-md-5" id="cargo">
                        {{ form::label('cargo_id', 'Cargo : ', ['class'=> 'col-form-label'])}}
                        <select name="cargo_id" id="cargo_ibrido" class="form-control custom-select" autofocus="autofocus" style="text-transform:uppercase" required>
                        
                        </select>
                        <div class="invalid-feedback">Debes Seleccionar un Cargo</div>
                        <div class="valid-feedback">¡Se ve bien!</div>                      
                    </div>
                </div>

                <div class="form-row" id="deexterna">
                    <!-- Ingresa el Nombre y Cargo de la documentacion externa -->      
                </div>

                <div class="form-row">
                    <div class="col-md-4">
                        {{ form::label('tipo_id', 'Tipo Documento : ', ['class'=> 'col-form-label'])}}
                            <select name="tipodocumento" id="tipo_id" class="form-control custom-select" style="text-transform:uppercase" required>
                                <option value="">Seleccione el Tipo de Documento..</option>
                                @foreach($tipodoc as $tipos)
                                    <option value="{{$tipos->descripcion}}">{{$tipos->descripcion}}</option>            
                                @endforeach                                
                            </select>
                            <div class="invalid-feedback">Debes Seleccionar un Tipo</div>
                            <div class="valid-feedback">¡Se ve bien!</div>
                    </div>

                    <div class="col-md-4">
                        {{ form::label('fechahra', 'Fecha y Hora : ', ['class'=> 'col-form-label'])}}
                            <input type="datetime-local" class="form-control custom-control" id="fechacrear" name="fechacrear" required>
                            <div class="invalid-feedback">Debes Ingresar Fecha y Hora</div>
                            <div class="valid-feedback">¡Se ve bien!</div>
                            @if($errors->has('fechahra'))
                                <p class="text-danger"><i class="fas fa-times"></i> {{ $errors->first('fechahra')}}</p>
                            @endif
                    </div>

                    <div class="col-md-4">
                        <div class="form-group" id="siglas">
                            <label class="col-form-label" for="sigla">Cite:</label>
                            <input type="text" class="form-control"  style="text-transform:uppercase;" id="sigla" value="" name="sigla" required>
                            <div class="valid-feedback">OK</div>
                            <div class="invalid-feedback">Debes Ingresar Sigla..</div>
                        </div>
                    </div>
                </div>
               

                <div class="form-row" id="via_vobo">
                    
                </div>

                <div class="form-row form-group">
                    <div class="col-md-12">
                        {{ form::label('referencia', 'Referencia : ', ['class'=> 'col-form-label'])}}
                            {{ form::textarea('referencia', old('referencia'), ['style'=>'text-transform:uppercase', 'class' => 'form-control', 'id' => 'referencia', 'rows' => 3, 'required' ]) }}
                            <div class="invalid-feedback">Debes Ingresar una Referencia</div>
                            <div class="valid-feedback">¡Se ve bien!</div>
                            @if($errors->has('referencia'))
                                <p class="text-danger"><i class="fas fa-times"></i> {{ $errors->first('referencia')}}</p>
                            @endif
                    </div>
                </div>
               
                <div>
                    <a href="" class="btn btn-warning" data-toggle="tooltip" title="Volver al Listado"><i class="fas fa-arrow-alt-circle-left" style="width:20px; height:20px;">
                        </i> Cancelar</a>
                    <button type="submit" class="btn btn-primary" ><i class="far fa-check-circle" style="width:20px; height:20px;"></i> Guardar</button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>


<script type="text/javascript">
    var html_externa=''
    var html_mediante=''
    var html_cargo=''
    var html_vobo=''


    var car=0
    var doc =0
    

    $(function()
    {
        $('#interna').on('change', onselect_interna);
        $('#cargo_ibrido').on('change', onselect_sigla); //cuando selecciona el cargo
        // $('#cargo_ibrido').on('change', cargar );
        select_cargos()
        // select_sigla()
    });

    //funcion para ver si es interno o externooo
    function onselect_interna()
    {
        var interno =  $(this).val();
    
        if(interno == 1)
        {
            div_vobo()
            html_externa=''
            $('#deexterna').html(html_externa);
        }
        else
        {
            if(interno == 2)
            {
                div_fuera()
                html_vobo=''
                $('#via_vobo').html(html_vobo);
            }
            else
            {
                html_externa=''
                $('#deexterna').html(html_externa);
                html_vobo=''
                $('#via_vobo').html(html_vobo);
            }
        }
    }

    function div_fuera()
    {        
        html_externa=  '<label class="col-form-label" for="de_fuera">De:</label>'
        html_externa+= '<input type="text" class="form-control"  style="text-transform:uppercase;" id="de_fuera" value="" placeholder="Ingrese una externa" name="de_fuera" required>'
        html_externa+= '<div class="valid-feedback">OK</div>'
        html_externa+= '<div class="invalid-feedback">Debes Ingresar un Nombre..</div>'
        $('#deexterna').html(html_externa);

    }

    function div_vobo()
    {
        html_vobo=   '<div class="col-md-6 ">'
        html_vobo+=     '{{ form::label('via_id', 'Via : ', ['class'=> 'col-form-label col-md-3'])}}'
        html_vobo+=     '<select name="via" id="via" class="form-control custom-select" style="text-transform:uppercase;" id="sigla">'
        html_vobo+=         '<option value="">Seleccione una Opción...</option>'
        html_vobo+=             '@foreach($cargos as $c)'
        html_vobo+=                '<option value="{{$c->nombre}} {{$c->apellidopaterno}} {{$c->apellidomaterno}} - {{$c->c}}">{{$c->nombre}} {{$c->apellidopaterno}} {{$c->apellidomaterno}} - {{$c->c}} </option>'
        html_vobo+=             '@endforeach'
        html_vobo+=             '@foreach($reemplazos as $r)'
        html_vobo+=                '@if($r->n2 == null)'
        html_vobo+=                     '<option value="{{$r->nombre}} {{$r->apellidopaterno}} {{$r->apellidomaterno}} - {{$r->n1}} ai">{{$r->nombre}} {{$r->apellidopaterno}} {{$r->apellidomaterno}} - {{$r->n1}} ai </option>'
        html_vobo+=                '@endif'
        html_vobo+=                '@if($r->n1 == null)'
        html_vobo+=                     '<option value="{{$r->nombre}} {{$r->apellidopaterno}} {{$r->apellidomaterno}} - {{$r->n2}} ai">{{$r->nombre}} {{$r->apellidopaterno}} {{$r->apellidomaterno}} - {{$r->n2}} ai </option>'
        html_vobo+=                '@endif'
        html_vobo+=             '@endforeach'
        html_vobo+=     '</select>'
        html_vobo+=     '<div class="valid-feedback">¡Información Opcional!</div>'
        html_vobo+=  '</div>'
        html_vobo+=  '<div class="col-md-6">'
        html_vobo+=     '{{ form::label('vb_id', 'V.B. : ', ['class'=> 'col-form-label'])}}'
        html_vobo+=     '<select name="vb" id="vb" class="form-control custom-select">'
        html_vobo+=        '<option value="">Seleccione una Opción...</option>'
        html_vobo+=             '@foreach($cargos as $c)'
        html_vobo+=                '<option value="{{$c->nombre}} {{$c->apellidopaterno}} {{$c->apellidomaterno}} - {{$c->c}}">{{$c->nombre}} {{$c->apellidopaterno}} {{$c->apellidomaterno}} - {{$c->c}} </option>'
        html_vobo+=             '@endforeach'
        html_vobo+=             '@foreach($reemplazos as $r)'
        html_vobo+=                '@if($r->n2 == null)'
        html_vobo+=                     '<option value="{{$r->nombre}} {{$r->apellidopaterno}} {{$r->apellidomaterno}} - {{$r->n1}} ai">{{$r->nombre}} {{$r->apellidopaterno}} {{$r->apellidomaterno}} - {{$r->n1}} ai </option>'
        html_vobo+=                '@endif'
        html_vobo+=                '@if($r->n1 == null)'
        html_vobo+=                     '<option value="{{$r->nombre}} {{$r->apellidopaterno}} {{$r->apellidomaterno}} - {{$r->n2}} ai">{{$r->nombre}} {{$r->apellidopaterno}} {{$r->apellidomaterno}} - {{$r->n2}} ai </option>'
        html_vobo+=                '@endif'
        html_vobo+=             '@endforeach'
        html_vobo+=     '</select>'
        html_vobo+=     '<div class="valid-feedback">¡Información Opcional!</div>'
        html_vobo+=  '</div>'
        $('#via_vobo').html(html_vobo);
    }
    function select_cargos()
    {
        $('#tip').on('change', function (event) {
            mediante =  $(this).val(); 
            if(mediante == 1)
                $.get('{{route('selectcargoibrido')}}/'+mediante, function(data){
                    var html_ibrido=    '<option value="">Seleccione una opcion..</option>'
                        for(var i=0; i<data.length; ++i)
                        html_ibrido += '<option value="'+data[i].id+'">'+data[i].nombre+'</option>'
                        $('#cargo_ibrido').html(html_ibrido)  
                });
            else
            {
                if(mediante == 2)
                {
                    $.get('{{route('selectcargoibrido')}}/'+mediante, function(data){
                        var html_ibrido=    '<option value="">Seleccione una opcion..</option>'
                            for(var i=0; i<data.length; ++i)
                            {
                                if(data[i].n1 != null)
                                {
                                    html_ibrido += '<option value="'+data[i].id1+'">'+data[i].n1+ ' ai'+'</option>'
                                }
                                else
                                {
                                    html_ibrido += '<option value="'+data[i].id2+'">'+data[i].n2+' ai'+'</option>'
                                }
                            }                            
                            $('#cargo_ibrido').html(html_ibrido)    
                    });sigla_reset()
                }
                else
                {
                    html_ibrido=''
                    $('#cargo_ibrido').html(html_ibrido) 
                    sigla_reset() 
                }
            }
        });
    }

    
    function onselect_sigla()
    {      
        var id =  $(this).val();

            if(id >= 1)
            {
                $.get('{{route('selectsigla')}}/'+id, function(data){
                    var html_sigla = '<label class="col-form-label" for="sigla">Cite:</label>'
                        html_sigla+= '<input type="text" class="form-control" style="text-transform:uppercase;" id="sigla" value="'+data.sigla+'" placeholder="Ingrese una sigla" name="sigla" required>'
                        html_sigla+='<div class="valid-feedback">OK</div>'
                        html_sigla+='<div class="invalid-feedback">Debes Ingresar Sigla..</div>'
                        $('#siglas').html(html_sigla)
                    
                });
            }
            else
            {
                sigla_reset()
            }
      
    }
    function sigla_reset()
    {
        var html_vacia = '<label class="col-form-label" for="sigla">Cite:</label>'
            html_vacia+= '<input type="text" class="form-control" style="text-transform:uppercase;" id="sigla" value="" name="sigla" required>'
            html_vacia+='<div class="valid-feedback">OK</div>'
            html_vacia+='<div class="invalid-feedback">Debes Ingresar Sigla..</div>'
            $('#siglas').html(html_vacia)
    }


</script>





@endsection