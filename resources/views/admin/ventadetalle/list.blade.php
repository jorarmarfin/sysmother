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
Lista de Detalle Ventas
@stop

@section('cuerpo')
@include('alerts.errors')
@include('alerts.success')
	<!-- Default box -->
      <div class="box box-warning">
        <div class="box-header with-border">
        	<a href="#" class="btn btn btn-success" data-toggle="modal" data-target="#myModal">
              <i class="fa fa-plus" ></i>
               Registrar Producto
			</a>
			<a href="{{route('venta.list')}}" class="btn btn btn-success">
              <i class="fa fa-mail-reply " ></i>
               Regresar a Ventas
			</a>
          <br>
          <br>
          <div class="box box-widget widget-user-2 col-sm-6">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header bg-yellow">
              <div class="widget-user-image">
              </div>
              <!-- /.widget-user-image -->
              <h3 class="widget-user-username">{{$Lista[0]['nombres'] }}</h3>
              <h5 class="widget-user-desc">cuotas del Cliente </h5>
            </div>
            <div class="box-footer no-padding col-sm-4">
              <ul class="nav nav-stacked">
                <li><a href="#">Total <span class="pull-right badge bg-blue">{{$Lista[0]['total'] }}</span></a></li>
                <li><a href="#">Pagado <span class="pull-right badge bg-green">{{$pagado[0]['suma'] }}</span></a></li>
                <li><a href="#">Debe <span class="pull-right badge bg-red">{{$Lista[0]['total'] - $pagado[0]['suma'] }}</span></a></li>
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
			            <a href="{{route('cuotas.edit',$lista->id)}}" class="btn btn-primary" >
			              <i class="fa fa-pencil" ></i>
			            </a>
			            <a href="{{route('cuotas.show',$lista->id)}}" class="btn btn-danger">
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

<!-- Modal -->
{!!Form::open(['route'=> 'cuotas.store','method'=> 'POST','class'=>''])!!}
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Nueva cuota de {{$Lista[0]['nombres'] }}</h4>
      </div>
      <div class="modal-body">

        <div class="form-group">
          <label for="exampleInputName2">Monto</label>
          {!!Form::number('entrada',old('entrada'), ['class'=>'form-control','placeholder'=> 'Monto','step'=>'any'])!!}
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
