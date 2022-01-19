@extends('Layout.HomeAseoUrbano')
@section('content')

    <div class="content-header">
      <div>
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"><i class="fas fa-dumpster"></i> Reporte</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('aseourbano')}}">Home</a></li>       
              <li class="breadcrumb-item active">Reporte Domiciliario</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

<div class="container-fluid">
  <div class="card">
    {!! Form::open(['route' => 'au-rtdomiciliario.reporte.prinft', 'class' => 'was-validated'])!!}
    <div class="card-header">
      <div class="row">
        <div class="col-6">
          <h3>            
            <b>CONSTRUCTOR DE REPORTES</b>
          </h3>
        </div>
    
          <div class="col-6">
            <div class="dropdown dropleft float-right">
              <button type="submit" class="btn btn-success" data-toggle="modal" data-target="#modalRegistrar">
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
                    <span class="input-group-text"><b>Ruta</b></span>
                </div>
                <select class="form-control custom-select rounded-0" name="ruta" id="ruta" style="text-transform:uppercase" required>
                    <option value="">Seleccione una Opcion..</option>
                                    
                </select>
                <div class="invalid-feedback">Debes Ingresar datos</div>
                <div class="valid-feedback">¡Se esta Ingresando Datos!</div>
            </div>
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
        <div class="row">
            
              <div class="custom-control custom-radio">
                <input class="custom-control-input custom-control-input" type="radio" value="1" id="customRadio4" onclick="myFunctionfalse()" name="tododia" checked>
                <label for="customRadio4" class="custom-control-label text-dark">Todos los dias</label>
              </div>
              <div class="custom-control custom-radio">
                <input class="custom-control-input custom-control-input" type="radio" value="0" id="customRadio5" onclick="myFunctiontrue()" name="tododia">
                <label for="customRadio5" class="custom-control-label text-dark">Seleccionar los dias</label>
            </div>       
        </div>

        <div class="row" id="text" style="display:none">
            {{-- <label for="myCheck">Checkbox:</label> 
            <input type="checkbox" id="myCheck" onclick="myFunctiontrue()" checked> --}}
                
                {{-- <p  >Checkbox is CHECKED!</p> --}}
                <div class="input-group" >                    
                    <span ><b>Lune</b></span>                   
                    <input type="checkbox" name="lunes" value="1">               
                    
                    <span ><b>Marte</b></span>
                    <input type="checkbox" name="martes" value="1">            
                    
                    <span ><b>Miercole</b></span>                   
                    <input type="checkbox" name="miercoles" value="1">

                    <span ><b>Jueve</b></span>                   
                    <input type="checkbox" name="jueves" value="1">

                    <span ><b>Vierne</b></span>                   
                    <input type="checkbox" name="viernes" value="1">

                    <span ><b>Sabado</b></span>                   
                    <input type="checkbox" name="sábado" value="1">

                    <span ><b>Domingo</b></span>                   
                    <input type="checkbox" name="domingo" value="1">
                </div>
        </div>
        
    </div>
    {!! Form::close()!!} 
  </div>

  <div class="card">
    {!! Form::open(['route' => 'au-rtdomiciliario.reporte.mes.prinft', 'class' => 'was-validated'])!!}
    <div class="card-header">
      <div class="row">
        <div class="col-6">
          <h3>            
            <b>CONSTRUCTOR DE REPORTES</b>
          </h3>
        </div>
    
          <div class="col-6">
            <div class="dropdown dropleft float-right">
              <button type="submit" class="btn btn-success" data-toggle="modal" data-target="#modalRegistrar">
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
                <div class="input-group  ">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><b>Inicio</b></span>
                    </div>
                    <input type="month" class="form-control" id="iniciom"  name="iniciom" required>
                    <div class="invalid-feedback">Debes Ingresar datos</div>
                    <div class="valid-feedback">¡Se esta Ingresando Datos!</div>
                </div>
            </div>
            <div class="input-group mb-2 col-4">
                <div class="input-group  ">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><b>Fin</b></span>
                    </div>
                    <input type="month" class="form-control" id="finm"  name="finm" required>
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
function myFunctionfalse() {
    var checkBox = document.getElementById("customRadio4");
  var text = document.getElementById("text");

    text.style.display = "none";
 
}
function myFunctiontrue() {
  var checkBox = document.getElementById("customRadio5");
  var text = document.getElementById("text");
//   if (checkBox.checked == true){
    text.style.display = "block";
//   } else {
//      text.style.display = "none";
//   }
}
</script>
@endsection