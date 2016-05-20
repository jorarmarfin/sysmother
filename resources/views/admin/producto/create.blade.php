@extends('layouts.admin')

@section('links')

@stop

@section('nombreusuario')
{!!Auth::user()->name!!}
@stop

@section('titulopagina')
Administracion de Productos
@stop

@section('subtitulopagina')

@stop


@section('titulocuerpo')
@stop

@section('cuerpo')
	{!!Form::open(['route'=> 'producto.store','method'=> 'POST','class'=>''])!!}
		@include('alerts.errors')
		@include('alerts.success')
	<!-- Default box -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <br>
          <h3 class="box-title">Nuevo Producto</h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
        	<div class="row">
				<div class='col-sm-12'>
					{!!Form::label('lblNombre', 'Nombre')!!}</br>
					{!!Form::text('nombre',null, ['class'=>'form-control','placeholder'=> 'Nombre'])!!}</br>
				</div>
				<div class='col-sm-12'>
					{!!Form::label('lblprecioVenta', 'Precio de Venta')!!}</br>
					{!!Form::number('precio_venta',null, ['class'=>'form-control','placeholder'=> 'precio de venta'])!!}</br>
				</div>
			</div>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
        	{!!Form::submit('Guardar',['class'=>'btn btn-primary'])!!}
        	<a href="{{route('producto.list')}}" class="btn btn btn-success">
              Cancelar
			</a>
        </div>
        <!-- /.box-footer-->
      </div>
      <!-- /.box -->
	{!!Form::close()!!}
@stop

@section('librerias')
<!-- FastClick -->
<script src={{asset("plugins/fastclick/fastclick.js")}}></script>
<!-- AdminLTE for demo purposes -->
<script src={{asset("dist/js/demo.js")}}></script>
@stop

@section('javascript')

@stop
