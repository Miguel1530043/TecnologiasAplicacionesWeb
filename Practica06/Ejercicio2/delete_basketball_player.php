<?php
	include("utilities.php");//Llamado al archivo utilities.php el cual incluye las funciones y conexion a la base de datos
	$id = $_GET['id'];//Se recibe el id del jugador mediante el metodo GET
	$sport = "BasketBall";//Se declara el deporte como BasketBall
	delete($id,$sport);//Ejecución de la funcion delete para eliminar el registo
	header("location: basketball.php");//Redireccionamiento al apartado de basketball
?>