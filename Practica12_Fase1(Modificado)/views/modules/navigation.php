<body style="background-color:#efefef">
<div class="container">
	<div class="container-fluid">
		<div class="btn-group">
			<div class="btn-group">
				<button type="button" class="btn disabled btn-info" style="width:210px">Productos</button>
				<button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
				<span class="caret"></span>
				<span class="sr-only">Toggle Dropdown</span>
				</button>    
				<div class="dropdown-menu" role="menu">
					<a class="dropdown-item" href="index.php?action=products">Ver Productos</a>
			 		<a class="dropdown-item" href="index.php?action=addProduct">Agregar Producto</a>
				</div>
			</div>

			<div class="btn-group">
				<button type="button" class="btn disabled btn-info" style="width:210px">Categorias</button>
				<button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
				<span class="caret"></span>
				<span class="sr-only">Toggle Dropdown</span>
				</button>    
				<div class="dropdown-menu" role="menu">
					<a class="dropdown-item" href="index.php?action=categories">Ver Categorias</a>
			 		<a class="dropdown-item" href="index.php?action=addCategory">Agregar Categoria</a>
				</div>
			</div>

			<div class="btn-group">
				<button type="button" class="btn disabled btn-info" style="width:210px">Usuarios</button>
				<button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
				<span class="caret"></span>
				<span class="sr-only">Toggle Dropdown</span>
				</button>    
				<div class="dropdown-menu" role="menu">
					<a class="dropdown-item" href="index.php?action=users">Ver Usuarios</a>
			 		<a class="dropdown-item" href="index.php?action=addUser">Agregar Usuario</a>
					
				</div>
			</div>
			<a href="index.php?action=historial"><input type="button" name="" class="btn btn-info" value="Historial" style="width:250px"></a>
			<a href="index.php"><input type="button" name="" class="btn btn-danger" value="Salir" style="width: 115px"></a>
		</div>
	</div>
</div>
</body>