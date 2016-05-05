@extends('layouts.admin')

@section('nombreusuario')
{!!Auth::user()->name!!}
@stop

@section('titulopagina')
Bienvenido
@stop

@section('subtitulopagina')
Al sistema de administración
@stop

@section('cuerpo')
<div class="row">
        <div class="col-lg-4 col-xs-4">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>{{$cntVentas}}</h3>
              <p>Ventas por cobrar</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="{{route('venta.list')}}" class="small-box-footer">Mas informacion <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-4 col-xs-4">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3>{{$cntPrestamos}}</h3>

              <p>Prestamos por cobrar</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="{{route('prestamo.list')}}" class="small-box-footer">Mas informacion <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-4 col-xs-4">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3>{{$cntAhorros}}</h3>

              <p>Ahorros abierto</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="{{route('ahorro.list')}}" class="small-box-footer">Mas informacion <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>
<!-- PRODUCT LIST -->
<div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Productos recien agregados</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <ul class="products-list product-list-in-box">
              	@foreach($products as $product)
	                <li class="item">
	                  <div class="product-info">
	                    <a href="javascript:void(0)" class="product-title">{{$product->nombre}}
	                      <span class="label label-warning pull-right">S/ {{$product->precio_venta}}</span></a>
	                  </div>
	                </li>
	            @endforeach
                <!-- /.item -->
              </ul>
            </div>
            <!-- /.box-body -->
            <div class="box-footer text-center">
              <a href="{{route('producto.list')}}" class="uppercase">Mirar todos los productos</a>
            </div>
            <!-- /.box-footer -->
          </div>
@stop