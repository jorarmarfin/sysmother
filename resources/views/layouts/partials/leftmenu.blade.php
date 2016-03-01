<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- Sidebar user panel (optional) -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src={{asset("dist/img/user2-160x160.jpg")}} class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>@yield('nombreusuario','Nombre usuario')</p>
          <!-- Status -->
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>

      <!-- search form (Optional) -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->

      <!-- Sidebar Menu -->
      <ul class="sidebar-menu">
        <li class="header">HEADER</li>
        <!-- Optionally, you can add icons to the links -->
        <li class="active"><a href="#"><i class="fa fa-table"></i> <span>Lista de Usuarios</span></a></li>
        <li><a href="#"><i class="fa fa-link"></i> <span>Another Link</span></a></li>
        <li class="treeview">
          <a href="#"><i class="fa fa-user"></i> <span>Usuarios</span> <i class="fa fa-angle-left pull-right"></i></a>
          <ul class="treeview-menu">
            <li><a href={{route('admin.user.index')}} ><i class="fa fa-table"></i><span> Lista de Usuarios</span></a></li>
            <li><a href={{route('admin.user.create')}} ><i class="fa fa-user-plus"></i><span> Registrar Usuarios</span></a></li>
            <li><a href="#">Link in level 2</a></li>
          </ul>
        </li>
      </ul>
      <ul class="sidebar-menu">
        <li class="treeview">
          <a href="#"><i class="fa fa-user"></i> <span>Catalogo</span> <i class="fa fa-angle-left pull-right"></i></a>
          <ul class="treeview-menu">
            <li><a href={{route('admin.catalogo.index')}} ><i class="fa fa-table"></i><span> Lista de Tablas</span></a></li>
            <li><a href={{route('admin.catalogo.create')}} ><i class="fa fa-plus"></i><span> Registrar Tabla</span></a></li>
            <li><a href="#">Link in level 2</a></li>
          </ul>
        </li>
      </ul>
      <ul class="sidebar-menu">
        <li class="treeview">
          <a href="#"><i class="fa fa-user"></i> <span>Pruebas</span> <i class="fa fa-angle-left pull-right"></i></a>
          <ul class="treeview-menu">
            <li><a href={{route('prueba.prueba.index')}} ><i class="fa fa-table"></i><span> Maestro detalle</span></a></li>
            <li><a href="#">Link in level 2</a></li>
          </ul>
        </li>
      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>
