@extends('layouts.admin')

@section('nombreusuario')
{!!Auth::user()->name!!}
@stop

@section('titulopagina')
Bienvenidos
@stop

@section('subtitulopagina')
Al sistema de administración
@stop

@section('cuerpo')

Cuerpo
@stop