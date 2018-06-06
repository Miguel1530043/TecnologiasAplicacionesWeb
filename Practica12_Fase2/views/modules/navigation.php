<?php
	$MVC = new MvcController();
  session_start();

 
?>
<body style="background-color:#efefef" align="center">
	<nav class="main-header navbar navbar-expand bg-gray navbar-dark border-bottom">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      	<li class="nav-item">
        	<a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
      	</li>
    </ul>
	</nav>

	<aside class="main-sidebar sidebar-dark-primary elevation-4" style="background-color:#001928">
    <!-- Brand Logo -->
    <a href="index.php?action=dashboard" class="brand-link">
      
      <span class="brand-text font-weight-light">Control de Inventario</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="index.php?action=dashboard" class="nav-link">
              <i class="nav-icon  fa fa-line-chart"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-user"></i>
              <p>
                Usuarios
                <i class="fa fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="index.php?action=users" class="nav-link">
                  <i class="fa fa-users nav-icon"></i>
                  <p>Ver Usuarios</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="index.php?action=addUser" class="nav-link">
                  <i class="fa fa-user-plus nav-icon"></i>
                  <p>Agregar Usuario</p>
                </a>
              </li>
            </ul>
          </li>


          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-cube"></i>
              <p>
                Inventario
                <i class="right fa fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="index.php?action=products" class="nav-link">
                  <i class="fa fa-cubes nav-icon"></i>
                  <p>Ver Productos</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="index.php?action=addProduct" class="nav-link">
                  <i class="fa fa-plus-square nav-icon"></i>
                  <p>Agregar Producto</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-tag"></i>
              <p>
               	Categorias
                <i class="fa fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="index.php?action=categories" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Ver Categorias</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="index.php?action=addCategory" class="nav-link">
                  <i class="fa fa-plus-square nav-icon"></i>
                  <p>Agregar Categoria</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="index.php?action=logout" class="nav-link">
              <i class="nav-icon fa  fa-power-off"></i>
              <p>
                Salir
              </p>
            </a>
          </li>

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
</body>