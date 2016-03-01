@extends('layouts.admin')

@section('links')
<!-- DataTables -->
  <link rel="stylesheet" href={{asset("plugins/datatables/dataTables.bootstrap.css")}}>
@stop

@section('nombreusuario')
{!!Auth::user()->name!!}
@stop

@section('titulopagina')
Administracion de Catalogo
@stop

@section('subtitulopagina')

@stop


@section('titulocuerpo')
Lista de Usuarios
@stop

@section('cuerpo')
	@include('alerts.success')
	<!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Lista de Tablas</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
	        <table id="tabla1" class="table table-bordered table-hover">
			    <thead>
			    <tr>
			      <th>Id</th>
			      <th>IdTable</th>
			      <th>IdItem</th>
			      <th>Codigo</th>
			      <th>Nombre</th>
			      <th>Descripcion</th>
			      <th>valor</th>
			      <th>Activo</th>
			      <th>Opciones</th>
			    </tr>
			    </thead>
			    <tbody>
			    @foreach($Lista as $lista)
			      <tr>
			        <td>{{$lista->id}}</td>
			        <td>{{$lista->idtable}}</td>
			        <td>{{$lista->iditem}}</td>
			        <td>{{$lista->codigo}}</td>
			        <td>{{$lista->nombre}}</td>
			        <td>{{$lista->descripcion}}</td>
			        <td>{{$lista->valor}}</td>
			        <td>{{$lista->activo}}</td>
			        <td>
			            <a href={{route('admin.catalogo.edit',$lista->id)}} class="btn btn-info btn-flat  btn-xs">
			              <i class="fa fa-edit" style="color:black;"></i>
			              Editar
			            </a>
			            <a href={{route('admin.user.edit',$lista->id)}} class="btn btn-warning btn-flat  btn-xs">
			              <i class="fa fa-user-times" style="color:black;"></i>
			              Eliminar
			            </a>
			        </td>
			      </tr>

			    @endforeach
			    </tbody>
			    <tfoot>
			    <tr>
			      <th>Id</th>
			      <th>IdTable</th>
			      <th>IdItem</th>
			      <th>Codigo</th>
			      <th>Nombre</th>
			      <th>Descripcion</th>
			      <th>valor</th>
			      <th>Activo</th>
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
<script src="../../plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../dist/js/demo.js"></script>
<!-- DataTables -->
<script src={{asset("plugins/datatables/jquery.dataTables.min.js")}}></script>
<script src={{asset("plugins/datatables/dataTables.bootstrap.min.js")}}></script>
<script src={{asset("js/table.js")}}></script>
@stop
