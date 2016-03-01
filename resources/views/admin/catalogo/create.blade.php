@extends('layouts.admin')

@section('nombreusuario')
{!!Auth::user()->name!!}
@stop

@section('titulopagina')
Administracion de Usuarios
@stop

@section('subtitulopagina')

@stop

@section('clasecuerpo')
box box-primary
@stop

@section('titulocuerpo')
Editar de Usuario
@stop

@section('cuerpo')
	{!!Form::open(['route'=> 'admin.catalogo.store','method'=> 'POST','class'=>''])!!}
	@include('alerts.success')
	 <div class="box box-primary">

        <div class="box-header with-border">
          <h3 class="box-title">Ingresar Tabla</h3>

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
					{!!Form::label('lblIdTable', 'IdTable')!!}</br>
					{!!Form::text('idtable',null, ['class'=>'form-control','placeholder'=> 'Ingresar idtable'])!!}</br>
				</div>
				<div class='col-sm-12'>
					{!!Form::label('lblIdItem', 'IdItem')!!}</br>
					{!!Form::text('iditem',null, ['class'=>'form-control','placeholder'=> 'Ingresar iditem'])!!}</br>
				</div>
				<div class='col-sm-12'>
					{!!Form::label('lblCodigo', 'Codigo')!!}</br>
					{!!Form::text('codigo',null, ['class'=>'form-control','placeholder'=> 'Ingresar Codigo'])!!}
				</div>
				<div class='col-sm-12'>
					{!!Form::label('lblNombre', 'Nombre')!!}</br>
					{!!Form::text('nombre',null, ['class'=>'form-control','placeholder'=> 'Ingresar nombre'])!!}
				</div>
				<div class='col-sm-12'>
					{!!Form::label('lblDescripcion', 'Descripcion')!!}</br>
					{!!Form::text('descripcion',null, ['class'=>'form-control','placeholder'=> 'Ingresar Descripcion'])!!}
				</div>
				<div class='col-sm-12'>
					{!!Form::label('lblValor', 'Valor')!!}</br>
					{!!Form::text('valor',null, ['class'=>'form-control','placeholder'=> 'Ingresar Valor'])!!}
				</div>
				<div class='col-sm-12'>
					{!!Form::label('lblActivo', 'Activo')!!}</br>
					{!!Form::text('activo',null, ['class'=>'form-control','placeholder'=> 'Ingresar Activo'])!!}
				</div>
			</div>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          {!!Form::submit('Guardar',['class'=>'btn btn-primary'])!!}
        </div>
      <!-- /.box-footer-->
      </div>
      <!-- /.box -->
	{!!Form::close()!!}
@stop