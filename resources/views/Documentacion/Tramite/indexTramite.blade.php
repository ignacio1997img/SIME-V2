@extends('Layout.HomeDocumentacion')
@section('content')
    <div class="content-header">
      <div>
        <div class="row mb-2">
          <div class="col-sm-8">
            <h1 class="m-0 text-dark">
              <i class="fas fa-cubes"></i>              
              Tramite {{$dat}}
            </h1>
          </div><!-- /.col -->
          <div class="col-sm-4">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('documentaciones')}}">Home</a></li>       
              <li class="breadcrumb-item active">Tramite {{$dat}}</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
              <form>
                <select name="area" onChange="location = form.area.options[form.area.selectedIndex].value;">
                  <option value="">Seleccione Cargo o Reemplazo...</option>
                  @foreach($selectcargo as $c)
                    <option value="{{route('documentacion.index')}}">{{$c->sigla}}</option>
                  @endforeach
                  @foreach($selectreemplazo as $r)
                    @if($r->n2 == null)
                      <option value="{{route('doc-tramite.select', $r->id1)}}">{{$r->n1}} ai</option>
                    @else
                      <option  value="{{route('doc-tramite.select', $r->id2)}}">{{$r->n2}} ai</option>
                    @endif
                  @endforeach
                </select>
              </form>



    <body>


    <div class="card-header">
        <div class="row">
          <div class="col-10">

            <!-- HOJA DEL TAB -->
            <div class="container mt-3">
              <ul class="nav nav-tabs">
                  <li class="nav-item">
                      <a class="nav-link active" data-toggle="tab" href="#entrada"><b>Entrada</b></a>
                  </li>
                  <li class="nav-item">                    
                      <a class="nav-link" data-toggle="tab" href="#pendiente"> <b>Pendiente</b>  <span></span> </a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" data-toggle="tab" href="#despachada"><b>Despachada</b></a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" data-toggle="tab" href="#incompleta"><b>Incompleto</b></a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" data-toggle="tab" href="#cerradas"> <b>Cerrada</b></a>
                  </li>
              </ul>
            </div>

          </div>
          <div class="col-2">
            <div class="dropdown dropleft float-right">
              <a class="btn btn-success" data-toggle="tooltip" href="{{route ('documentacion.create') }}"
                title="Nuevo"><i class="fas fa-plus"></i>
                Nuevo
              </a>
            </div>
          </div>
        </div> 
      </div>



        
        <!-- CONTENIDO DEL TAB -->
        <div class="tab-content">
            <!-- BANDEJA DE ENTRADA -->
            @include('Documentacion.Tramite.Includes_tabs.entrada')

            <!--                INDEX PENDIENTE           -->
            @include('Documentacion.Tramite.Includes_tabs.pendiente')
        </div>
    </body>
             


@endsection