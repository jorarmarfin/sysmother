@extends('layouts.admin')

@section('links')
@stop

@section('nombreusuario')
{!!Auth::user()->name!!}
@stop

@section('titulopagina')
Administracion de Clientes
@stop

@section('subtitulopagina')

@stop


@section('titulocuerpo')
@stop

@section('cuerpo')
	{!!Form::open(['route'=> 'cliente.store','method'=> 'POST','class'=>''])!!}
		@include('alerts.errors')
		@include('alerts.success')
	<!-- Default box -->
      <div class="box box-warning">
        <div class="box-header with-border">
          <br>
          <h3 class="box-title">Nuevo Cliente</h3>
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
					{!!Form::label('lblNombre', 'Nombres')!!}</br>
					{!!Form::text('idcliente', null,['class'=>'form-control']);!!}</br>
				</div>
				<div class='col-sm-2'>
					{!!Form::label('lblDNI', 'DNI')!!}</br>
					{!!Form::text('dni',null, ['class'=>'form-control','placeholder'=> 'ingrese su DNI'])!!}
				</div>
				<div class='col-sm-2'>
					{!!Form::label('lblTelefono', 'Telefono')!!}</br>
					{!!Form::text('telefono',null, ['class'=>'form-control','placeholder'=> 'ingrese su Telefono'])!!}
				</div>

				<div class='col-sm-2'>
					{!!Form::label('lblCelular', 'Celular')!!}</br>
					{!!Form::text('celular',null, ['class'=>'form-control','placeholder'=> 'ingrese su celular'])!!}
				</div>
				<div class='col-sm-12'>
					{!!Form::label('lblEmail', 'Email')!!}</br>
					{!!Form::text('email', null,['class'=>'form-control','placeholder'=> 'ingrese su email']);!!}</br>
				</div>

			</div>
			<div class="row">
				<div class='col-sm-12'>
					{!!Form::label('lblDireccion', 'Direccion')!!}</br>
					{!!Form::text('email', null,['class'=>'form-control','placeholder'=> 'ingrese su Direccion']);!!}</br>
				</div>
				<div class='col-sm-12'>
					{!!Form::label('lblTienda', 'Tienda')!!}</br>
					{!!Form::text('tienda', null,['class'=>'form-control','placeholder'=> 'ingrese su Tienda']);!!}</br>
				</div>
				<div class='col-sm-6'>
					<img src="{{asset('storage/fotos/nofoto.jpg')}}" alt="Mountain View" style="width:304px;height:400px;">
				</div>
			</div>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
        	{!!Form::submit('Guardar',['class'=>'btn btn-primary'])!!}
        	<a href="{{route('prestamo.list')}}" class="btn btn btn-success">
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
