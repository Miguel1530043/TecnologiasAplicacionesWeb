<?php
	session_start();
	if(!$_SESSION["validar"]){
		header("location:index.php?action=ingresar");
		exit();
	}
?>

<h1>REGISTRO DE USUARIO</h1>

<form method="post">
	
	<input type="text" placeholder="Nombre Producto" name="nombre" required>

	<input type="text" placeholder="descripcion" name="descripcion" required>

	<input type="text" placeholder="Buy Price" name="bPrice" required>

	<input type="text" placeholder="Sale Price" name="sPrice" required>

	<input type="text" placeholder="Price" name="price" required>
	
	<input type="submit" name="registro" value="Enviar">


</form>

<?php
//Enviar los datos al controlador MvcController (es la clase principal de controller.php)
$registro = new MvcProdController();
//se invoca la función registroUsuarioController de la clase MvcController:
$registro -> registroProductoC();

if(isset($_GET["action"])){

	if($_GET["action"] == "ok"){

		echo "Registro Exitoso";
	
	}

}

?>
