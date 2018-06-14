<?php

?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Ventas</title>
	
	<link rel="stylesheet" href="views/css/fontawesome-all.min.css">
	<link rel="stylesheet" href="views/css/2.css">
	<link rel="stylesheet" href=views/css/estilo.css">
	<link rel="stylesheet" type="text/css" href="views/css/sweetalert/dist/sweetalert.css">
	<script type="text/javascript" src="views/css/sweetalert/dist/sweetalert.js"></script>
	<script type="text/javascript" src="views/css/sweetalert/dist/sweetalert.min.js"></script>
</head>
<body>
	 <?php
        //se validan los tipos de action que hay ya que existen dos menus de navegacion diferentes
       if(isset($_GET["action"])){
      ?>
	<nav class="navbar navbar-inverse navbar-fixed-top">
		<div class="container">
			<div class="navbar-header">
				<a class="navbar-brand" href="#">POS</a>
			</div>
			<div id="navbar" class="collapse navbar-collapse">
				<ul class="nav navbar-nav">
					<li><a href="index.php?action=listar">Productos</a></li>
					<li><a href="index.php?action=vender">Vender</a></li>
					<li><a href="index.php?action=ventas">Ventas</a></li>
					<li><a id="salir" onclick="salir()" href="index.php?action=logout">Salir</a></li>				
				</ul>
			</div>
		</div>
	</nav>
	<?php
		}
	?>
	<div class="container">
		<div class="row">

			<?php
				$MVC = new MvcController();
				$MVC -> linkPageController();

			?>
		</div>
	</div>
</body>
</html>


<script type="text/javascript">
	function salir(){
		var url = document.getElementById("salir").href;
		event.preventDefault();
		swal({
			title: "¿Seguro que desea salir?",
		  	type: "info",
		  	showCancelButton: true,
		  	cancelButtonText: "Cancelar",
		  	cancelButtonClass: "btn-secondary",
		  	confirmButtonClass: "btn-primary",
		  	confirmButtonText: "Salir",
		  	closeOnConfirm: false
		},
		function(){
	  		window.location=url;
		});
	}

</script>

<script type="text/javascript">
	function eliminar(id){
		url = document.getElementById("eliminar"+id).href;
		event.preventDefault();
		swal({
			title: "¿Seguro que desea eliminarlo?",
		  	type: "warning",
		  	showCancelButton: true,
		  	cancelButtonText: "Cancelar",
		  	cancelButtonClass: "btn-secondary",
		  	confirmButtonClass: "btn-danger",
		  	confirmButtonText: "Si, Eliminar",
		  	closeOnConfirm: false
		},
		function(){
			window.location=url;
		});
}

</script>