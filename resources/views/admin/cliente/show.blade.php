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
	<!-- Default box -->
      <div class="box box-warning">
        <div class="box-header with-border">
          <br>
          <h3 class="box-title">Cliente</h3>
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
					<h3><strong>Nombre : </strong></h3>
					<h4>{{$cliente->nombres}}</h4></br>
				</div>
				<div class='col-sm-2'>
					<h3><strong>DNI : </strong></h3>
					<h4>{{$cliente->dni}}</h4>
				</div>
				<div class='col-sm-2'>
					<h3><strong>Telefono : </strong></h3>
					<h4>{{$cliente->telefono}}</h4>
				</div>

				<div class='col-sm-2'>
					<h3><strong>Celular : </strong></h3>
					<h4>{{$cliente->celular}}</h4>
				</div>
				<div class='col-sm-12'>
					<h3><strong>Email : </strong></h3>
					<h4>{{$cliente->email}}</h4></br>
				</div>

			</div>
			<div class="row">
				<div class='col-sm-12'>
					<h3><strong>Direccion : </strong></h3>
					<h4>{{$cliente->direccion}}</h4></br>
				</div>
				<div class='col-sm-12'>
					<h3><strong>Tienda : </strong></h3>
					<h4>{{$cliente->tienda}}</h4></br>
				</div>
			</div>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
        	<a href="{{route('cliente.list')}}" class="btn btn btn-success">
              Cancelar
			</a>
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
