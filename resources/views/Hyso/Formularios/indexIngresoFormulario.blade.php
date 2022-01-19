@extends('Layout.HomeHyso')
@section('content')
    <div class="content-header">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark" style="text-transform:uppercase">{{$formu->numero}}</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('hyso')}}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{route('formulario.index')}}">Formularios</a></li>
                    <li class="breadcrumb-item active" style="text-transform:uppercase">{{$formu->numero}}</li>
                </ol>
            </div>
        </div>
    </div>
    <div class="container-fluid container-responsive">
        <div style="padding-bottom: 5px;">
            <a class="btn btn-warning" data-toggle="tooltip" href="{{route('formulario.index')}}" title="Volver al menu principal">
                <i class="fas fa-arrow-alt-circle-left"></i>
                Volver
            </a>  
            <a class="btn btn-success" data-toggle="modal" data-target="#modalRegistrar" title="Registrar Nuevo Dsitrito">
                <i class="fas fa-plus"></i>
                Registrar
            </a>
        </div>
        <div class="card table-responsive card-outline card-success">
            <div class="card-header">
                <th>
                    <h4 class="card-title text-center" style="text-transform:uppercase">
                        LISTA DE {{$formu->numero}}
                    </h4>
                </th>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-hover table-sm" id="example2">
                    <thead>
                        <tr>
                            <th class="text-center" width="50">NRO</th>
                            <th class="text-center">NOMBRE</th> 
                        </tr>
                    </thead>
                </table>
            </div>
        </div>


    </div>


  @endsection