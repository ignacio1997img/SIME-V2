@extends('errors::layout')

@section('tittle', 403)
@section('message', 'Acceso no autorizado')
    <a class="btn btn-warning" data-toggle="tooltip" href="{{ URL::previous() }}" title="Volver al menu principal">
         <i class="fas fa-arrow-alt-circle-left" style="width:20; height:20;"></i>
         Volver
    </a>
