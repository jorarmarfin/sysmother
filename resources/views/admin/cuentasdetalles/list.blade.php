@extends('layouts.admin')

@section('links')
<!-- DataTables -->
  <link rel="stylesheet" href={{asset("plugins/datatables/dataTables.bootstrap.css")}}>
@stop

@section('nombreusuario')
{!!Auth::user()->name!!}
@stop

@section('titulopagina')
Administracion de Cuentas
@stop

@section('subtitulopagina')

@stop


@section('titulocuerpo')
Lista de Detalle Cuentas
@stop

@section('cuerpo')
@include('alerts.errors')
@include('alerts.success')
@include('alerts.warning')
	<!-- Default box -->
<div class="box box-warning">
  <div class="box-header with-border">
  	<a href="#" class="btn btn btn-info" data-toggle="modal" data-target="#myModalVendo">
        <i class="fa fa-plus" ></i>
         Vendo
		</a>
    <a href="#" class="btn btn btn-danger" data-toggle="modal" data-target="#myModalCobro">
        <i class="fa fa-plus" ></i>
         Cobro
    </a>
		<a href="{{route('venta.list')}}" class="btn btn btn-success">
            <i class="fa fa-mail-reply " ></i>
             Regresar a Ventas
		</a>
    <a href="{{route('ventadetalle.imprimir')}}" class="btn btn btn-primary">
            <i class="fa fa-print " ></i>
             Imprimir
    </a>
    <br>
    <br>
    <div class="box box-widget widget-user-2 col-sm-6">
      <!-- Add the bg color to the header using any of the bg-* classes -->
      <div class="widget-user-header bg-yellow">
        <!-- /.widget-user-image -->
        <h3 class="widget-user-username">{{$Lista[0]['cliente'] }}</h3>
      </div>
      <div class="box-footer no-padding col-sm-6">
        <div class="text-left"><h1>Total : S/ </h1></div>

      </div>
    </div>
    <div class="box-tools pull-right">
      <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
        <i class="fa fa-minus"></i></button>
      <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
        <i class="fa fa-times"></i></button>
    </div>
  </div>
  <div class="box-body table-responsive">
    <table id="tabla1" class="table table-bordered table-hover ">
		    <thead>
			    <tr>
			      <th>Id</th>
            <th>Entrada</th>
            <th>Salida</th>
			      <th>Fecha</th>
			      <th>Hora</th>
			      <th>Opciones</th>
			    </tr>
		    </thead>
		    <tbody>
		    @foreach($Lista as $lista)
	      		<tr>
		        <td>{{$lista->id}}</td>
            <td>{{$lista->entrada}}</td>
            <td>{{$lista->salida}}</td>
		        <td>{{$lista->fecha}}</td>
		        <td>{{$lista->hora}}</td>
		        <td>
		            <a href="{{route('ventadetalle.edit',$lista->id)}}" class="btn btn-primary" >
		              <i class="fa fa-pencil" ></i>
		            </a>
		            <a href="{{route('ventadetalle.show',$lista->id)}}" class="btn btn-danger">
		              <i class="fa fa-trash-o" ></i>
		            </a>
		        </td>
		      </tr>

		    @endforeach
		    </tbody>
		    <tfoot>
		    <tr>
		      <th>Id</th>
          <th>Entrada</th>
          <th>Salida</th>
          <th>Fecha</th>
          <th>Hora</th>
          <th>Opciones</th>
		    </tr>
		    </tfoot>
		</table>
  </div>
  <!-- /.box-body -->
  <div class="box-footer">

  </div>
  <!-- /.box-footer-->
</div>
<!-- /.box -->

<!-- Modal Entrada -->
{!!Form::open(['route'=> 'cuentasdetalles.store','method'=> 'POST','class'=>''])!!}
<div class="modal fade modal-info" id="myModalVendo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">ENTRADA de {{$Lista[0]['cliente'] }}</h4>
      </div>
      <div class="modal-body">

        <div class="form-group">
            {!!Form::label('lblCantidad', 'Cantidad')!!}</br>
            {!!Form::number('cantidad',old('cantidad'), ['class'=>'form-control','placeholder'=> 'cantidad','step'=>'any'])!!}
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
        {!!Form::submit('Guardar',['class'=>'btn btn-primary'])!!}
      </div>
    </div>
  </div>
</div>
{!!Form::close()!!}
<!-- Modal Salida-->
{!!Form::open(['route'=> 'cuentasdetalles.store','method'=> 'POST','class'=>''])!!}
<div class="modal fade modal-danger" id="myModalCobro" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">SALIDA de {{$Lista[0]['cliente'] }}</h4>
      </div>
      <div class="modal-body">

        <div class="form-group">
            {!!Form::label('lblCantidad', 'Cantidad')!!}</br>
            {!!Form::number('cantidad',old('cantidad'), ['class'=>'form-control','placeholder'=> 'cantidad','step'=>'any'])!!}
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
        {!!Form::submit('Guardar',['class'=>'btn btn-primary'])!!}
      </div>
    </div>
  </div>
</div>
{!!Form::close()!!}
@stop

@section('librerias')
<!-- FastClick -->
<script src={{asset("plugins/fastclick/fastclick.js")}}></script>
<!-- AdminLTE for demo purposes -->
<script src={{asset("dist/js/demo.js")}}></script>
<!-- DataTables -->
<script src={{asset("plugins/datatables/jquery.dataTables.min.js")}}></script>
<script src={{asset("plugins/datatables/dataTables.bootstrap.min.js")}}></script>
<script src={{asset("js/table.js")}}></script>
@stop
@section('javascript')
<script>
	$('#myModal').on('shown.bs.modal', function () {
	  $('#myInput').focus()
	})
</script>
@stop
