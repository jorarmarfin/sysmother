@extends('layouts.admin')

@section('links')
<!-- DataTables -->
  <link rel="stylesheet" href={{asset("plugins/datatables/dataTables.bootstrap.css")}}>
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
Lista de cuotas
@stop

@section('cuerpo')
@include('alerts.success')
	<!-- Default box -->
      <div class="box box-warning">
        <div class="box-header with-border">
        	<a href="{{route('cuotas.create')}}" class="btn btn btn-success">
              <i class="fa fa-plus" ></i>
               Nueva Cuota
			</a>
			<a href="{{route('prestamo.list')}}" class="btn btn btn-success">
              <i class="fa fa-mail-reply " ></i>
               Regresar a Prestamos
			</a>
          <br>
          <br>
          <div class="box box-widget widget-user-2 col-sm-6">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header bg-yellow">
              <div class="widget-user-image">
                <img class="img-circle" src={{$Lista[0]['foto'] }} alt="User Avatar">
              </div>
              <!-- /.widget-user-image -->
              <h3 class="widget-user-username">{{$Lista[0]['nombres'] }}</h3>
              <h5 class="widget-user-desc">cuotas del Cliente </h5>
            </div>
            <div class="box-footer no-padding col-sm-4">
              <ul class="nav nav-stacked">
                <li><a href="#">Total <span class="pull-right badge bg-blue">{{$Lista[0]['total'] }}</span></a></li>
                <li><a href="#">Pagado <span class="pull-right badge bg-green">{{$pagado[0]['suma'] }}</span></a></li>
                <li><a href="#">debe <span class="pull-right badge bg-red">{{$Lista[0]['total'] - $pagado[0]['suma'] }}</span></a></li>
              </ul>
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
				      <th>Fecha</th>
				      <th>Hora</th>
				      <th>Opciones</th>
				    </tr>
			    </thead>
			    <tbody>
			    @foreach($Lista[0]['transacciondetalle'] as $lista)
			    	@if($lista->estado=='Pagado')
			      		<tr class="info">
			      	@else
			      		<tr>
			    	@endif
			        <td>{{$lista->id}}</td>
			        <td>{{$lista->entrada}}</td>
			        <td>{{$lista->fecha}}</td>
			        <td>{{$lista->hora}}</td>
			        <td>
			            <a href="{{route('prestamo.edit',$lista->id)}}" class="btn btn-primary" >
			              <i class="fa fa-pencil" ></i>
			            </a>
			            <a href="{{route('prestamo.show',$lista->id)}}" class="btn btn-danger">
			              <i class="fa fa-trash-o" ></i>
			            </a>
			            <a href="#" class="btn btn-success">
			              <i class="fa fa-eye" ></i>
			            </a>
			        </td>
			      </tr>

			    @endforeach
			    </tbody>
			    <tfoot>
			    <tr>
			      <th>Id</th>
			      <th>Entrada</th>
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
