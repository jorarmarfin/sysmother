@extends('layouts.admin')

@section('links')
@stop

@section('nombreusuario')
{!!Auth::user()->name!!}
@stop

@section('titulopagina')
Administracion de Ventas
@stop

@section('subtitulopagina')

@stop


@section('titulocuerpo')
Lista de Detalle Ventas
@stop

@section('cuerpo')
@include('alerts.errors')
@include('alerts.success')
  <!-- Default box -->
      <div class="box box-warning">
        <div class="box-header with-border">

        <a href="{{route('ventadetalle.list',$id)}}" class="btn btn btn-success">
                <i class="fa fa-mail-reply " ></i>
                 Regresar
        </a>

        </div>
        <div class="box-body table-responsive">
            <iframe src="{{route('ventadetalle.showpdf')}}" width="100%" height="700px" frameborder="0"></iframe>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">

        </div>
        <!-- /.box-footer-->
      </div>
      <!-- /.box -->


@stop

@section('librerias')
<!-- FastClick -->
<script src={{asset("plugins/fastclick/fastclick.js")}}></script>
<!-- AdminLTE for demo purposes -->
<script src={{asset("dist/js/demo.js")}}></script>
@stop
@section('javascript')

@stop
