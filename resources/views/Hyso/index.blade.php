@extends('Layout.HomeHyso')
@section('content')

<div class="container">

    <div id="demo" class="carousel slide" data-ride="carousel">
                <!-- Indicators -->
        <ul class="carousel-indicators">
            <li data-target="#demo" data-slide-to="0" class="active"></li>
            <li data-target="#demo" data-slide-to="1"></li>
            <li data-target="#demo" data-slide-to="2"></li>
        </ul>
        <!-- The slideshow -->
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img src="{{asset('dist/img/hyso/img/hyso.png')}}" alt="Hyso" class="mx-auto d-block" width="46%">
          </div>
          <div class="carousel-item">
            <img src="{{asset('dist/img/hyso/img/hyso1.png')}}" alt="Hyso1" class="mx-auto d-block" width="32%">
          </div>
          <div class="carousel-item">
            <img src="{{asset('dist/img/hyso/img/hyso2.png')}}" alt="Hyso2" class="mx-auto d-block" width="37%">
          </div>
          <div class="carousel-item">
            <img src="{{asset('dist/img/hyso/img/hyso3.png')}}" alt="Hyso3" class="mx-auto d-block" width="32%">
          </div>
          <div class="carousel-item">
            <img src="{{asset('dist/img/hyso/img/hyso4.png')}}" alt="Hyso4" class="mx-auto d-block" width="40%">
          </div>
          <div class="carousel-item">
            <img src="{{asset('dist/img/hyso/img/hyso5.png')}}" alt="Hyso5" class="mx-auto d-block" width="35%">
          </div>
        </div>
                <!-- Left and right controls -->
        <a class="carousel-control-prev" href="#demo" data-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </a>
        <a class="carousel-control-next" href="#demo" data-slide="next">
            <span class="carousel-control-next-icon"></span>
        </a>
    </div>


    <div class="text-center">
        <h1><b>HIGIENE Y SEGURIDAD OCUPACIONAL</b></h1>
    </div>
</div>
@endsection