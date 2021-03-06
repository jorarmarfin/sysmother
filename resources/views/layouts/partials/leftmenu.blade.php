<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- Sidebar Menu -->
      <ul class="sidebar-menu">
        <!-- Optionally, you can add icons to the links -->
        <li><a href={{route('home')}}><i class="fa fa-dashboard fa-fw"></i> <span>Panel</span></a></li>
        <li><a href="{{route('prestamo.list')}}"><i class="fa fa-money"></i> <span>Prestamos</span></a></li>
        <li><a href="{{route('ahorro.list')}}"><i class="fa fa-bank"></i> <span>Ahorros</span></a></li>
        <li><a href="{{route('cliente.list')}}"><i class="fa fa-user"></i> <span>Clientes</span></a></li>
        <li><a href="{{route('venta.list')}}"><i class="fa fa-shopping-cart"></i> <span>Ventas</span></a></li>
        <li><a href="{{route('producto.list')}}"><i class="fa fa-th"></i> <span>Productos</span></a></li>
        <li><a href="{{route('cuentas.list')}}"><i class="fa fa-book"></i> <span>Cuentas</span></a></li>

      </ul>

      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>
