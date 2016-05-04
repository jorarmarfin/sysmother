@extends('layouts.admin')

@section('links')
<!-- DataTables -->
  <link rel="stylesheet" href={{asset("plugins/datatables/dataTables.bootstrap.css")}}>
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
Lista de Productos
@stop

@section('cuerpo')
@include('alerts.success')
@include('alerts.warning')
	<!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
        	<a href="{{route('producto.create')}}" class="btn btn btn-primary">
              <i class="fa fa fa-plus" ></i>
              Nuevo Producto
			</a>
          <br>
          <br>
          <h3 class="box-title">Lista de Productos</h3>
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
				      <th>nombre</th>
				      <th>precio venta</th>
				      <th>estado</th>
				      <th>Opciones</th>
				    </tr>
			    </thead>
			    <tbody>
			    @foreach($Lista as $lista)
			    	<tr>
			        <td>{{$lista->id}}</td>
			        <td>{{$lista->nombre}}</td>
			        <td>{{$lista->precio_venta}}</td>

			        <td>
			        	<a href="{{route('producto.estado',$lista->id)}}">
			        	@if($lista->estado=='Activo')
			      			<span class="label label-success">{{$lista->estado}}</span>
				      	@else
				      		<span class="label label-danger">{{$lista->estado}}</span>
				    	@endif
				    	</a>
			        </td>
			        <td>
			            <a href="{{route('producto.edit',$lista->id)}}" class="btn btn-primary" >
			              <i class="fa fa-pencil" ></i>
			            </a>
			            <a href="{{route('producto.show',$lista->id)}}" class="btn btn-danger">
			              <i class="fa fa-trash-o" ></i>
			            </a>
			        </td>
			      </tr>

			    @endforeach
			    </tbody>
			    <tfoot>
			    <tr>
			      <th>Id</th>
			      <th>nombre</th>
			      <th>precio venta</th>
			      <th>estado</th>
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
