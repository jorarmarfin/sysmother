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
Administracion de Prestamos
@stop

@section('subtitulopagina')

@stop


@section('titulocuerpo')
Lista de Prestamos
@stop

@section('cuerpo')
	{!!Form::model($cuota,['route'=> ['cuotas.destroy',$cuota],'method'=> 'DELETE','class'=>''])!!}
		@include('alerts.errors')
		@include('alerts.success')
	<!-- Default box -->
      <div class="box box-warning">
        <div class="box-header with-border">
          <br>
          <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-ban"></i> Alert!</h4>
                Esta seguro que desea eliminar este prestamo no podra desahacer esta opcion
              </div>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
        	<div class="row">
        		<div class='col-sm-2'>
					{!!Form::label('lblMonto', 'Monto')!!}</br>
					{!!Form::number('entrada',null, ['class'=>'form-control','placeholder'=> 'Monto'])!!}
				</div>
				<div class='col-sm-12'>
					{!!Form::label('lblFecha', 'Fecha')!!}</br>
					<div class="input-group date">
	                  <div class="input-group-addon">
	                    <i class="fa fa-calendar"></i>
	                  </div>
	                  {!!Form::text('fecha',null, ['class'=>'form-control pull-right','id'=> 'datepicker'])!!}

	                </div>
	            	</br>
				</div>
				<div class='col-sm-12'>
					{!!Form::label('lblHora', 'Hora')!!}</br>
					<div class="bootstrap-timepicker">
		                <div class="form-group">
		                  <div class="input-group">
		                    <div class="input-group-addon">
		                      <i class="fa fa-clock-o"></i>
		                    </div>
		                    <input name="hora" type="text" class="form-control timepicker">

		                  </div>
		                  <!-- /.input group -->
		                </div>
		                <!-- /.form group -->
		            </div>
	            	</br>
				</div>


			</div>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
        	{!!Form::submit('Eliminar',['class'=>'btn btn-danger'])!!}
        	<a href="{{route('cuotas.list',$cuota->idtransaccion)}}" class="btn btn btn-success">
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
<!-- bootstrap datepicker -->
<script src={{asset("plugins/datepicker/bootstrap-datepicker.js")}}></script>
<!-- bootstrap time picker -->
<script src={{asset("plugins/timepicker/bootstrap-timepicker.min.js")}}></script>
@stop

@section('javascript')
<script>
	//Date picker
	    $('#datepicker').datepicker({
	      autoclose: true,
      	  format: "yyyy-mm-dd"
	    });
	    // $('#datepicker').inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
	//Timepicker
	    $(".timepicker").timepicker({
	      showInputs: false
	    });
</script>
@stop
