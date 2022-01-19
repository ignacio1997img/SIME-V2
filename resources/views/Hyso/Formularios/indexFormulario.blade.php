@extends('Layout.HomeHyso')
@section('content')
  <div class="content-header">
    <div>
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark"><i class="fab fa-wpforms"></i> Formularios</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('hyso')}}">Home</a></li>       
            <li class="breadcrumb-item active">Formularios</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <div class="container-fluid container responsive">
    <div style="padding-bottom: 5px;">
      <a class="btn btn-warning" data-toggle="tooltip" href="" title="Volver al menu principal">
         <i class="fas fa-arrow-alt-circle-left" style="width:20; height:20;"></i>
         Volver
      </a>
      <a class="btn btn-success" data-toggle="modal" data-target="#modalRegistrar" title="Registrar Nuevo Grupo">
          <i class="fas fa-plus">
          </i>
          Nuevo
        </a>
      
    <div class="card table-responsive card-outline card-info">
      <div class="card-header">
        <div>
          <th><h4 class="card-title text-center ">LISTA DE FORMULARIOS</h4></th>
        </div>
      </div>
      <div class="card-body">
        <table class="table table-bordered table-hover table-sm" id="example2">
          <thead>
            <tr class="text-center">
              <th width="8%">FECHA</th>
              <th width="13%">NUMERO</th>
              <th>NOMBRE</th>
              <th>DESCRIPCION</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            @foreach($forms as $form)
              <tr>
                <td class="text-center">{{\Carbon\Carbon::parse($form->fecha)->format('m/Y')}}</td>
                <td  style="text-transform:uppercase">{{$form->numero}}</td>
                <td  style="text-transform:uppercase">{{$form->nombre}}</td>
                <td  style="text-transform:uppercase">{{$form->descripcion}}</td>
                <td class="text-center" style="width: 5%">
                  <a class="btn btn-warning" data-toggle="tooltip" onclick="showFile('{{$form->id}}')">
                    <i class="far fa-eye"></i>
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
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header bg-success">
          <h4 class="modal-title">Nuevo Formulario</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
          {!! Form::open(['route' => 'guardar', 'class' => 'was-validated', 'enctype' => 'multipart/form-data']) !!}  
          <div class="input-group mb-2">
            <div class="input-group-prepend">
              <span class="input-group-text"><b>Fecha</b></span>
            </div>
            <input type="date" class="form-control" id="fecha"  name="fecha" required>
            <div class="invalid-feedback">Debes Ingresar datos</div>
            <div class="valid-feedback">¡Se esta Ingresando Datos!</div>
          </div>
          <div class="input-group mb-2">
            <div class="input-group-prepend">
              <span class="input-group-text"><b>Numero</b></span>
            </div>
            <input type="text" id="numero" name="numero" class="form-control" style="text-transform:uppercase" required>
            <div class="invalid-feedback">Debes Ingresar datos</div>
            <div class="valid-feedback">¡Se esta Ingresando Datos!</div>
          </div>
          <div class="input-group mb-2">
            <div class="input-group-prepend">
              <span class="input-group-text"><b>Nombre</b></span>
            </div>
            <input type="text" id="nombre" name="nombre" class="form-control" style="text-transform:uppercase" required>
            <div class="invalid-feedback">Debes Ingresar datos</div>
            <div class="valid-feedback">¡Se esta Ingresando Datos!</div>
          </div>
          <div class="input-group mb-2">
            <div class="input-group-prepend">
              <span class="input-group-text"><b>Descripcion</b></span>
            </div>
            <textarea class="form-control" rows="3" name="descripcion" id="descripcion" style="text-transform:uppercase" required></textarea>
            <div class="invalid-feedback">Debes Ingresar datos</div>
            <div class="valid-feedback">¡Se esta Ingresando Datos!</div>
          </div>
          <input type="file" name="urlpdf" required>
          <!-- <input type="submit" value="subir"> -->
        </div>
        <!-- Modal footer -->
        <div class="modal-footer justify-content-between">
          <button type="button text-left" class="btn btn-secondary btn-sm" data-dismiss="modal" data-toggle="tooltip" title="Volver al Listado">Cancelar</button>
          <button type="submit" class="btn btn-success btn-sm" title="Continuar">
            Guardar
          </button>
        </div>
        {!! Form::close() !!}
      </div>
    </div>
  </div>

  <script>
    function showFile(id)
      {
        $.ajax({
        url: "{{ asset('/thesis/file/') }}/"+id,
        type: "get",
        dataType: "html",
        contentType: false,
        processData: false
        }).done(function(res)
          {
            url = JSON.parse(res).response.urlpdf
            // window.open(url,'_blank');plabic
            window.open('../storage/files/pdf/'+url,'_blank');
            
          }).fail(function(res)
            {
              console.log(res)
            });
        }
  </script>
@endsection
