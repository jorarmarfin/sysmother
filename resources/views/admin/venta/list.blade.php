@extends('layouts.admin')

@section('links')
<!-- DataTables -->
  <link rel="stylesheet" href={{asset("plugins/datatables/dataTables.bootstrap.css")}}>
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
Lista de Ventas
@stop

@section('cuerpo')
@include('alerts.success')
	<!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
        	<a href="{{route('venta.create')}}" class="btn btn btn-primary">
              <i class="fa fa fa-plus" ></i>
              Nueva Venta
			</a>
          <br>
          <br>
          <h3 class="box-title">Lista de Ventas</h3>
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
				      <th>Lugar</th>
				      <th>Cliente</th>
				      <th>Vendido</th>
				      <th>Cobrado</th>
				      <th>Debe</th>
				      <th>Estado</th>
				      <th>Fecha</th>
				      <th>Hora</th>
				      <th>Opciones</th>
				    </tr>
			    </thead>
			    <tbody>
			    @foreach($Lista as $lista)
			    	@if($lista->estado=='Pagado')
			      		<tr class="info">
			      	@else
			      		<tr>
			    	@endif
			        <td>{{$lista->id}}</td>
			        <td>{{$lista->lugar}}</td>
			        <td>{{$lista->cliente}}</td>
			        <td>{{$lista->vendido}}</td>
			        <td>{{$lista->pagado}}</td>
			        <td>{{$lista->vendido-$lista->pagado}}</td>
			        <td>{{$lista->estado}}</td>
			        <td>{{$lista->fecha}}</td>
			        <td>{{$lista->hora}}</td>
			        <td>
			            <a href="{{route('venta.edit',$lista->id)}}" class="btn btn-primary" >
			              <i class="fa fa-pencil" ></i>
			            </a>
			            <a href="{{route('venta.show',$lista->id)}}" class="btn btn-danger">
			              <i class="fa fa-trash-o" ></i>
			            </a>
			            <a href="{{route('ventadetalle.list',$lista->id)}}" class="btn btn-warning">
			              <i class="fa fa-shopping-cart" ></i>
			            </a>
			            <a href="{{route('pagos.list',$lista->id)}}" class="btn btn-success">
			              <i class="fa fa-eye" ></i>
			            </a>
			        </td>
			      </tr>

			    @endforeach
			    </tbody>
			    <tfoot>
			    <tr>
			      <th>Id</th>
			      <th>Lugar</th>
			      <th>Cliente</th>
			      <th>Vendido</th>
			      <th>Cobrado</th>
			      <th>Debe</th>
			      <th>Estado</th>
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
