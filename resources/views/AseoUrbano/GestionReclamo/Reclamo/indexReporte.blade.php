@extends('Layout.HomeAseoUrbano')
@section('content')

    <div class="content-header">
      <div>
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"><i class="fas fa-print"></i> Reporte</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('aseourbano')}}">Home</a></li>       
              <li class="breadcrumb-item active">Reporte Gestion Reclamo</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

<div class="container-fluid" >
  <div class="card card-outline card-info">
    {!! Form::open(['route' => 'au-gestionreclamo.reclamo.reporte.printf', 'class' => 'was-validated'])!!}
    <div class="card-header">
      <div class="row">
        <div class="col-9">
          <h3>            
            <b>CONSTRUCTOR DE REPORTES</b>
          </h3>
        </div>
    
          <div class="col-3">
            <div class="dropdown dropleft float-right">
              <button type="submit" class="btn btn-success">
                <i class="fas fa-plus"></i>
                Generar
              </button>
            </div>
          </div>
  
      </div> 
    </div>
    
    <div class="card-body">
        
        <div class="row">
            <div class="input-group mb-2 col-4">
              <div class="input-group-prepend">
                  <span class="input-group-text"><b>Distrito</b></span>
              </div>
              <select class="form-control custom-select rounded-0" name="distrito_id" id="distrito_id" style="text-transform:uppercase" required>
                  <option value="">Seleccione un distrito..</option>
                  <option value="TODO">TODOS LOS DISTRITOS..!</option>
                  @foreach ($distritos as $dis)
                      <option value="{{$dis->id}}">{{$dis->descripcion}}</option>
                  @endforeach                    
              </select>
              <div class="invalid-feedback">Debes Ingresar datos</div>
              <div class="valid-feedback">¡Se esta Ingresando Datos!</div>
            </div>
            <div class="input-group mb-2 col-4">
                <div class="input-group-prepend">
                    <span class="input-group-text"><b>Barrio</b></span>
                </div>
                <select class="form-control custom-select rounded-0" name="barrio_id" id="barrio_id" style="text-transform:uppercase" required>
                                     
                </select>
                <div class="invalid-feedback">Debes Ingresar datos</div>
                <div class="valid-feedback">¡Se esta Ingresando Datos!</div>
            </div>
            <div class="input-group mb-2 col-4">
              <div class="input-group-prepend">
                  <span class="input-group-text"><b>Calles</b></span>
              </div>
              <select class="form-control custom-select rounded-0" name="calle_id" id="calle_id" style="text-transform:uppercase" required>
                                   
              </select>
              <div class="invalid-feedback">Debes Ingresar datos</div>
              <div class="valid-feedback">¡Se esta Ingresando Datos!</div>
          </div>
        </div>
        <div class="row">
          <div class="input-group mb-2 col-4">
              <div class="input-group  ">
                  <div class="input-group-prepend">
                      <span class="input-group-text"><b>Inicio</b></span>
                  </div>
                  <input type="date" class="form-control" id="inicio"  name="inicio" required>
                  <div class="invalid-feedback">Debes Ingresar datos</div>
                  <div class="valid-feedback">¡Se esta Ingresando Datos!</div>
              </div>
          </div>
          <div class="input-group mb-2 col-4">
              <div class="input-group  ">
                  <div class="input-group-prepend">
                      <span class="input-group-text"><b>Fin</b></span>
                  </div>
                  <input type="date" class="form-control" id="fin"  name="fin" required>
                  <div class="invalid-feedback">Debes Ingresar datos</div>
                  <div class="valid-feedback">¡Se esta Ingresando Datos!</div>
              </div>
          </div>
      </div>      
    </div>
    {!! Form::close()!!} 
  </div>
</div>



<script>
    $(function()
    {
        // $('#barrio_id').on('change', onselect_calle);
    });
    var html_distrito='';    
    var html_calle ='';

    $('#distrito_id').on('change', function (event) {
      var distrito =  $(this).val();   
      html_distrito='';
      $('#barrio_id').html(html_distrito);  
      html_calle='';
      $('#calle_id').html(html_calle);  
     
      if(distrito != 'TODO')
      {
          $.get('{{route('reclamo-reporte.barrio')}}/'+distrito, function(data){
            // alert(data)
            
            if(data.length >=1)
            {
              html_distrito=    '<option value="">Seleccione una opcion..</option>'
              html_distrito +=  '<option value="TODO">TODOS LOS BARRIOS</option>'
            }
            else
            {
              html_calle=    '<option value="">Sin registro..</option>'
            }
            for(var i=0; i<data.length; ++i)
                html_distrito += '<option value="'+data[i].id+'">'+data[i].descripcion+'</option>'

            $('#barrio_id').html(html_distrito);           
          });
        }
        else
        {
          html_distrito +=  '<option value="TODO">TODOS LOS BARRIOS</option>'
          $('#barrio_id').html(html_distrito);  
          html_calle +=  '<option value="TODO">TODAS LAS CALLES</option>'
          $('#calle_id').html(html_calle);  
        }
      
    });


    $('#barrio_id').on('change', function (event) {
      var barrio =  $(this).val();    
     
          $.get('{{route('reclamo-reporte.calle')}}/'+barrio, function(data){
            // alert(data)            
            if(data.length >=1)
            {
              html_calle=    '<option value="">Seleccione una opcion..</option>'
              html_calle +=  '<option value="TODO">TODAS LAS CALLES</option>'
            }
            else
            {
              html_calle=    '<option value="">Sin registro..</option>'
            }
            for(var i=0; i<data.length; ++i)
                html_calle += '<option value="'+data[i].id+'">'+data[i].calle+'</option>'

            $('#calle_id').html(html_calle);       
          });
      
    });
</script>
@endsection