@extends('Layout.HomeDocumentacion')
@section('content')
<div class="content-header">
    <div>
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"><i class="fas fa-cubes"></i> Derivar</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('documentaciones')}}">Home</a></li>      
              <li class="breadcrumb-item"><a href="{{route('documentacion.index')}}">Derivar Tramite</a></li>      
              <li class="breadcrumb-item active">Nuevo Tramite</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>

<div class="text-center card-outline card-info">
        <h5 style="padding: 1px; border: solid 1px; border-radius: 5px; background: #ece41e">
            <b> ORIGEN DE LA DOCUMENTACIÓN</b>
        </h5>
    </div>
    {!! Form::open(['route' => 'movdoc.store','class' => 'was-validated']) !!}
    <div class="card card-outline card-info" style=" border: solid 1px; border-radius: 10px;">
        <input type="hidden" name="documento_id" value="{{ $doc->id}}">
        
        <div class="card-body">
            <div class="row" >
                <div class="input-group mb-2 col-sm-3" style="text-transform:uppercase">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><b>Documento</b></span>
                    </div>
                    @if($doc->interna == 1)
                        <input type="text" class="form-control" id="documento_id" name="documento_id" value  = "INTERNA" disabled>
                    @else
                        <input type="text" class="form-control" id="documento_id" name="documento_id" value  = "EXTERNA" disabled>
                    @endif
                </div> 

                <div class="input-group mb-2 col-sm-4">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><b>Fecha Hora</b></span>
                    </div>
                    <input type="text" class="form-control" id="inicio"  name="inicio" value="{{\Carbon\Carbon::parse($doc->fechacrear)->format('d/m/Y H:i A')}}" disabled>
                </div> 

                <div class="input-group mb-2 col-sm-5">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><b>Cite</b></span>
                    </div>
                    <input type="text" class="form-control" id="inicio"  name="inicio" value="{{ $doc->sigla}}" style="text-transform:uppercase" disabled>
                </div> 

            </div>
            <div class="row">
            
                <div class="input-group mb-2 col-sm-12">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><b>Dirigido A:</b></span>
                    </div>
                    <select class="form-control select2bs4" multiple="multiple" name="dirigidos[]" id="cargo_id" style="text-transform:uppercase" required>
                        @foreach($cargos as $c)
                            <option value="{{$c->id}}-{{$c->nombre}} {{$c->apellidopaterno}} {{$c->apellidomaterno}} - {{$c->c}}">{{$c->nombre}} {{$c->apellidopaterno}} {{$c->apellidomaterno}} - {{$c->c}}</option>
                        @endforeach
                        @foreach($reemplazos as $r)
                            @if($r->n2 == null)
                                 <option value="{{$r->id1}}-{{$r->nombre}} {{$r->apellidopaterno}} {{$r->apellidomaterno}} - {{$r->n1}} ai">{{$r->nombre}} {{$r->apellidopaterno}} {{$r->apellidomaterno}} - {{$r->n1}} ai </option>
                            @endif
                            @if($r->n1 == null)
                                 <option value="{{$r->id2}}-{{$r->nombre}} {{$r->apellidopaterno}} {{$r->apellidomaterno}} - {{$r->n2}} ai">{{$r->nombre}} {{$r->apellidopaterno}} {{$r->apellidomaterno}} - {{$r->n2}} ai </option>
                            @endif
                         @endforeach
                    </select>
                    <div class="invalid-feedback">Debes Ingresar datos</div>
                    <div class="valid-feedback">¡Se esta Ingresando Datos!</div>
                </div>
                
                @if($doc->interna==0)
                    <div class="input-group mb-2 col-sm-12">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><b>Recibido Por:</b></span>
                        </div>
                        <input type="text" class="form-control" value="{{$doc->de}}" style="text-transform:uppercase" disabled>
                        <input type="hidden" name="de" value="{{$doc->de}}">
                    </div>
                @endif
            </div>
            <div class="input-group mb-2">
                <div class="input-group-prepend">
                    <span class="input-group-text"><b>De:</b></span>
                </div>
                @if($doc->interna==1)    
                    <input type="text" class="form-control" value="{{$doc->de}}" style="text-transform:uppercase" disabled>
                    <input type="hidden" name="de" value="{{$doc->de}}">
                @else
                    <input type="text" class="form-control" name="de_fuera" value="{{$doc->de_fuera}}" style="text-transform:uppercase" disabled>
                    <input type="hidden" name="de_fuera" value="{{$doc->de_fuera}}">
                @endif
            </div>

            @if($doc->interna==1)
                <div class="input-group mb-2">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><b>Via:</b></span>
                    </div>
                    <input type="text" class="form-control" value="{{$doc->via}}" style="text-transform:uppercase" disabled>
                </div>
                <div class="input-group mb-2">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><b>Vo. Bo.:</b></span>
                    </div>
                    <input type="text" class="form-control" value="{{$doc->vb}}" style="text-transform:uppercase" disabled>
                </div>               
            @endif
            <div class="input-group mb-2">
                <div class="input-group-prepend">
                    <span class="input-group-text"><b>Referencia:</b></span>
                </div>
                <textarea class="form-control" rows="3" style="text-transform:uppercase" disabled>{{$doc->referencia}}</textarea>
            </div>
            
            <div class="input-group mb-2">
                <div class="input-group-prepend">
                    <span class="input-group-text"><b>Nota:</b></span>
                </div>
                <textarea class="form-control" rows="3" name="nota" id="nota"  style="text-transform:uppercase" required></textarea>
                <div class="invalid-feedback">Debes Ingresar datos</div>
                <div class="valid-feedback">¡Se esta Ingresando Datos!</div>   
            </div>
        </div>
        
    </div>
    
    <div class="row">
        <div class="col-md-6 text-left">
            <a href="" class="btn btn-warning" data-toggle="tooltip" title="Volver a la Bandeja de Entrada">CANCELAR</a>
        </div>    
        <div class="col-md-6 text-right">
            <button type="submit" class="btn btn-primary" >
                <i class="far fa-arrow-alt-circle-right" style="width:20px; height:20px;"></i>
                Derivar
            </button>
            {!! Form::close() !!}
        </div>

    </div>

<script type="text/javascript">

</script>


@endsection