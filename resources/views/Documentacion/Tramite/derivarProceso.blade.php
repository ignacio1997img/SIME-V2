@extends('Layout.HomeDocumentacion')
@section('content')

<!-- <style>
    #myDiv {
    transform: rotate(-90deg); /* Standard syntax */
}

</style> -->

    <div class="content-header">
        <div>
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"><i class="fas fa-inbox"></i>&nbsp;Detalles de la Documentación</h1>
                    <h5>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;De: {{$car->nombre}}</h5>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('documentaciones')}}">Documentación</a></li>
                        <li class="breadcrumb-item active">Detalles de la Documentación</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
<!-- {{$doc->documento->id}} -->
    <div class="container">
        <div class="dropdown text-right">
            <a class="btn btn-warning" data-toggle="tooltip" href="" title="Volver al menu principal">
                <i class="fas fa-arrow-alt-circle-left" style="width:20; height:20;"></i>
                Volver
            </a>
            <button class="btn btn-sm btn-primary dropdown-toggle" type="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-align-left"></i> Opciones
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" data-toggle="modal" data-target="#modalDerivar">
                    <i class="fas fa-share-square"></i> Derivar
                </a>
                                    
                <a class="dropdown-item" data-toggle="modal" data-target="#observardocumento" >
                    <i class="fas fa-search"></i> Observar
                </a>

                <a class="dropdown-item" data-toggle="modal" data-target="#finalizardocumentacion" >
                    <i class="fas fa-check-square"></i> Finalizar Proceso
                </a>
                
                    <a class="dropdown-item" href="">
                        <i class="fas fa-info-circle"></i> Historial
                    </a>
               
            </div>
        </div>
    </div>
    
    <div id="print" class="container-fluid" style="border: solid 1px; border-color: black; padding: 10px;  border-radius: 5px;">
        <div class="container text-center" style="border: solid 1px; border-radius: 5px; background: #ece41e" id="myDiv">
            <h5 >INFORMACION DE LA DOCUMENTACION</h5>
        </div>
        <div class="container" style="border: solid 1px; border-radius: 5px;">
            <div class="card-body"  id="div1">
                <div class="row" >
                    <div class="input-group mb-2 col-sm-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><b>Documento</b></span>
                        </div>
                        @if($doc->documento->interna == 1)
                            <input type="text" class="form-control" id="documento_id" name="documento_id" value  = "INTERNA" disabled>
                        @else
                            <input type="text" class="form-control" id="documento_id" name="documento_id" value  = "EXTERNA" disabled>
                        @endif
                    </div> 
                    <div class="col-sm-4"></div>
                    <div class="input-group mb-2 col-sm-5">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><b>Fecha y Hora del Registo</b></span>
                        </div>
                        <input type="text" class="form-control" id="inicio"  name="inicio" value="{{\Carbon\Carbon::parse($doc->fechahraposenvio)->format('d/m/Y H:i A')}}" disabled>
                    </div> 
                </div>
                <div class="row">
                    <div class="input-group mb-2 col-sm-12">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><b>Dirigido A: </b></span>
                        </div>
                        <input type="text" class="form-control" id="inicio"  name="inicio" value="{{$doc->dirigido}}" disabled>
                    </div> 
                    @if($doc->documento->interna == 1)                        
                        @if($doc->cabecera == 1)
                            <div class="input-group mb-2 col-sm-12">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><b>Via: </b></span>
                                </div>
                                <input type="text" class="form-control" id="inicio"  name="inicio" value="{{$doc->documento->via}}" disabled>
                            </div>
                            <div class="input-group mb-2 col-sm-12">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><b>Vo. Bo.: </b></span>
                                </div>
                                <input type="text" class="form-control" id="inicio"  name="inicio" value="{{$doc->documento->vb}}" disabled>
                            </div>
                        @endif
                        <div class="input-group mb-2 col-sm-12">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><b>De: </b></span>
                            </div>
                            <input type="text" class="form-control" id="inicio"  name="inicio" value="{{$doc->de}}" disabled>
                        </div>
                    @else
                        <div class="input-group mb-2 col-sm-12">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><b>De: </b></span>
                            </div>
                            <input type="text" class="form-control" id="inicio"  name="inicio" value="{{$doc->de_fuera}}" disabled>
                        </div>
                        <div class="input-group mb-2 col-sm-12">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><b>Recibido Por: </b></span>
                            </div>
                            <input type="text" class="form-control" id="inicio"  name="inicio" value="{{$doc->de}}" disabled>
                        </div>
                    @endif

                    
                    <div class="input-group mb-2 col-sm-12">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><b>Referencia: </b></span>
                        </div>
                        <textarea class="form-control" rows="2" disabled>{{$doc->documento->referencia}}</textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="input-group mb-2 col-sm-12">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><b>Nota: </b></span>
                        </div>
                        <textarea class="form-control" rows="10" disabled>{{$doc->nota}}</textarea>
                    </div>
                </div>
            </div>            
        </div>
    </div>
        <!-- MODAL PARA DERIVAR -->
    <div class="modal fade" id="modalDerivar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <div class="modal-header bg-success">
                    <h5 class="modal-title" id="exampleModalLabel">Derivar</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                {!! Form::open(['route' => 'movdoc.store','class' => 'was-validated']) !!}
                <div class="modal-body">
                    
                    <div class="col-md">
                        {{ form::label('fechahraposenvio', 'Fecha y Hora de Salida : ', ['class'=> 'col-form-label'])}}
                            <input type="datetime-local" class="form-control custom-control" id="fechahraposenvio" name="fechahraposenvio" required>
                            <div class="invalid-feedback">Debes Ingresar Fecha y Hora</div>
                            <div class="valid-feedback">¡Se ve bien!</div>
                    </div>
                    <div class="col-md" >
                            {{ form::label('dirigido_id', 'Dirigido A : ', ['class'=> 'col-form-label'])}}
                            <select class="select2 select2-hidden-accessible custom-select" name="dirigido_id[]"
                                    id="dirigido_id"
                                    multiple="multiple" data-placeholder="Seleccion una Opción..." style="width: 100%;"
                                    tabindex="-1" aria-hidden="true" required>
                                @foreach($dirigidos as $dirigido)
                                    <option value={{$dirigido->id}}>{{$dirigido->lastname}}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">Debes Seleccionar al menos una Opción</div>
                            <div class="valid-feedback">¡Se ve bien!</div>
                    </div>
                    <div class="col-md">
                        {{ form::label('nota', 'Nota : ', ['class'=> 'col-form-label'])}}
                        {{ form::textarea('nota', old('nota'), ['style'=>'text-transform:uppercase','class' => 'form-control', 'id' => 'nota', 'rows' => 3, 'required']) }}
                        <div class="invalid-feedback">Debes Ingresar una Nota</div>
                        <div class="valid-feedback">¡Se ve bien!</div>
                        @if($errors->has('nota'))
                            <p class="text-danger"><i class="fas fa-times"></i> {{ $errors->first('nota')}}</p>
                        @endif
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="container">
                        <div class="dropleft float-left">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        </div>
                        <div class="dropright float-right">
                            <button type="submit" class="btn btn-success">Derivar</button>
                        </div>
                    </div>
                </div>
                {!! Form::close()!!}
                
            </div>
        </div>
    </div>

@endsection