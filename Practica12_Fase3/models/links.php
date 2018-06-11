<?php 
error_reporting(0);
session_start();
$id = $_SESSION['user'];
class Pages{
	//Metodo que direccionara las acciones del index
	public static function linkPagesM($link){
		$module =  "views/modules/".$link.".php";
		if($link == "index"){
			$module =  "views/modules/login.php";
		}
		return $module;
	}
}

?>