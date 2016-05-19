@extends('layouts.admin')

@section('links')
<!-- bootstrap datepicker -->
  <link rel="stylesheet" href={{asset("plugins/datepicker/datepicker3.css")}}>
<!-- Bootstrap time Picker -->
  <link rel="stylesheet" href={{asset("plugins/timepicker/bootstrap-timepicker.min.css")}}>
@stop

@section('nombreusuario')
{!!Auth::user()->name!!}
@stop

@section('titulopagina')
Administracion de Cuentas
@stop

@section('subtitulopagina')

@stop

@section('cuerpo')
	{!!Form::model($cuentasdetalles,['route'=> ['cuentasdetalles.destroy',$cuentasdetalles],'method'=> 'DELETE','class'=>''])!!}
		@include('alerts.errors')
		@include('alerts.success')
	<!-- Default box -->
    @if($cuentasdetalles->entrada!=0)
      <div class="box box-danger">
	@else
      <div class="box box-info">
	@endif
        <div class="box-header with-border">
          <br>
          <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-ban"></i> Alert!</h4>
                Esta seguro que desea eliminar esta cuenta no podra desahacer esta opcion
              </div>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
        	<div class="form-group">
	            @if($cuentasdetalles->entrada!=0)
	            	{!!Form::label('lblCobro', 'Cobro')!!}</br>
	            	{!!Form::number('entrada',old('entrada'), ['class'=>'form-control','placeholder'=> 'Cobro','step'=>'any'])!!}
	            @else
	            	{!!Form::label('lblVenta', 'Venta')!!}</br>
	            	{!!Form::number('salida',old('salida'), ['class'=>'form-control','placeholder'=> 'Venta','step'=>'any'])!!}
	            @endif
	           	 	{!!Form::label('lblFecha', 'Fecha')!!}</br>
	            	{!!Form::date('fecha',null, ['class'=>'form-control','placeholder'=> 'Fecha'])!!}
        	</div>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
        	{!!Form::submit('Eliminar',['class'=>'btn btn-danger'])!!}
        	<a href="{{route('cuentasdetalles.list',$cuentasdetalles->idtransaccion)}}" class="btn btn btn-success">
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
