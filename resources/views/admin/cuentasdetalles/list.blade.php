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
         Vendo
		</a>
    <a href="#" class="btn btn btn-danger" data-toggle="modal" data-target="#myModalCobro">
         Cobro
    </a>
		<a href="{{route('cuentas.list')}}" class="btn btn btn-success">
            <i class="fa fa-mail-reply " ></i>
             Regresar a Cuentas
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
        <div class="text-left"><h1>Total : S/ {{$Resumen[0]['sumventa']-$Resumen[0]['sumcobro']}}</h1></div>

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
            <th>Cuentas</th>
            <th>Lugar Pago</th>
			      <th>Fecha</th>
			      <th>Hora</th>
			      <th>Opciones</th>
			    </tr>
		    </thead>
		    <tbody>
		    @foreach($Lista as $lista)
	      		<tr>
		        <td>{{$lista->id}}</td>
            <td>
              @if($lista->salida>0)
                <span class="badge bg-light-blue">{{$lista->salida}}  +</span>
              @else
                <span class="text-red">({{$lista->entrada}})  -</span>
              @endif
            </td>
            <td>{{$lista->lugarpago}}</td>
		        <td>{{$lista->fecha}}</td>
		        <td>{{$lista->hora}}</td>
		        <td>
		            <a href="{{route('cuentasdetalles.edit',$lista->id)}}" class="btn btn-primary" >
		              <i class="fa fa-pencil" ></i>
		            </a>
		            <a href="{{route('cuentasdetalles.show',$lista->id)}}" class="btn btn-danger">
		              <i class="fa fa-trash-o" ></i>
		            </a>
		        </td>
		      </tr>

		    @endforeach
		    </tbody>
		    <tfoot>
		    <tr>
		      <th>Id</th>
          <th>Cuentas</th>
          <th>Lugar Pago</th>
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
        <h4 class="modal-title" id="myModalLabel">VENDO a {{$Lista[0]['cliente'] }}</h4>
      </div>
      <div class="modal-body">

        <div class="form-group">
            {!!Form::label('lblCantidad', 'Cantidad')!!}</br>
            {!!Form::number('salida',old('salida'), ['class'=>'form-control','placeholder'=> 'cantidad','step'=>'any'])!!}
            {!!Form::label('lblIdLugar', 'Lugar Pago')!!}</br>
            {!!Form::select('idlugarpago', ['-1' => 'Seleccionar Lugar']+ $lugarpago,null,['class'=>'form-control','id'=>'idlugar']);!!}</br>
            {!!Form::label('lblFecha', 'Fecha')!!}</br>
            {!!Form::date('fecha',null, ['class'=>'form-control','placeholder'=> 'Fecha'])!!}
        </div>
      </div>
      <div class="modal-footer">
        {!!Form::button('Cerrar',['class'=>'btn btn-outline pull-left','data-dismiss'=>'modal'])!!}
        {!!Form::submit('Guardar',['class'=>'btn btn-outline'])!!}
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
        <h4 class="modal-title" id="myModalLabel">COBRO A {{$Lista[0]['cliente'] }}</h4>
      </div>
      <div class="modal-body">

        <div class="form-group">
            {!!Form::label('lblCantidad', 'Cantidad')!!}</br>
            {!!Form::number('entrada',old('entrada'), ['class'=>'form-control','placeholder'=> 'cantidad','step'=>'any'])!!}
            {!!Form::label('lblLuagrPago', 'Lugar Pago')!!}</br>
            {!!Form::select('idlugarpago', ['-1' => 'Seleccionar Lugar']+ $lugarpago,null,['class'=>'form-control','id'=>'idlugar']);!!}</br>
            {!!Form::label('lblFecha', 'Fecha')!!}</br>
            {!!Form::date('fecha',null, ['class'=>'form-control','placeholder'=> 'Fecha'])!!}
        </div>
      </div>
      <div class="modal-footer">
        {!!Form::button('Cerrar',['class'=>'btn btn-outline pull-left','data-dismiss'=>'modal'])!!}
        {!!Form::submit('Guardar',['class'=>'btn btn-outline'])!!}
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
