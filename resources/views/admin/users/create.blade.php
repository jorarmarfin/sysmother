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
	{!!Form::open(['route'=> 'admin.user.store','method'=> 'POST','class'=>''])!!}
	@include('alerts.success')
	 <div class="box box-primary">

        <div class="box-header with-border">
          <h3 class="box-title">Ingresar Usuario</h3>

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
					{!!Form::label('lblName', 'Nombre')!!}</br>
					{!!Form::text('name',null, ['class'=>'form-control','placeholder'=> 'Nombre de usuario'])!!}</br>
				</div>
				<div class='col-sm-12'>
					{!!Form::label('lblEmail', 'Email')!!}</br>
					{!!Form::email('email',null, ['class'=>'form-control','placeholder'=> 'Email'])!!}</br>
				</div>
				<div class='col-sm-12'>
					{!!Form::label('lblPassword', 'Password')!!}</br>
					{!!Form::password('password', ['class'=>'form-control','placeholder'=> 'Password'])!!}
				</div>
				<div class='col-sm-12'>
					{!!Form::label('lblRol', 'Rol de Usuario')!!}</br>
					{!!Form::select('idrole',$Roles ,null,['class'=>'form-control','id'=>'idrole'])!!}
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