

<?php 
	//LLAMADO A LOS ENLACES, CRUD Y CONTROLADORES
	require_once "models/links.php";
	require_once "models/crud.php";
	require_once "controllers/controller.php";

	$MVC = new MvcController();//Instancia de la clase MvcController
	$MVC -> page();//Ejecucion del metodo para desplegar las paginas

	
?>