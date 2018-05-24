<?php

	class MvcProdController{

		public function template(){
			include "views/template.php";
		}

		public function linkPagesC(){
			if(isset($_GET["action"])){
				$link = $_GET["action"];

			}else{
				$link = "index";
			}

			$resp = Pages::linkPagesM($link);

			include $resp;
		}


		public static function registroProductoC(){
			if(isset($_POST["registro"])){
				$data = array("nombre" => $_POST["nombre"],"descripcion"=>$_POST["descripcion"],"bPrice"=>$_POST["bPrice"], "sPrice"=>$_POST["sPrice"],"price"=>$_POST["price"]);
				$resp = DatosProd::registroProductoM("producto",$data);

				if($resp == "1"){
					header("location: index.php?action=ok");
				}else{
					header("location: index.php");
				}
			}

		}

		public static function ingresoUsuarioC(){
		if(isset($_POST["user"])){
			$datos = array( "user"=>$_POST["user"], "pass"=>$_POST["pass"]);
			$respuesta = DatosProd::ingresoUsuarioM("usuario",$datos);
			//Valiación de la respuesta del modelo para ver si es un usuario correcto.
			if($respuesta["usuario"] == $_POST["user"] && $respuesta["password"] == $_POST["pass"]){
				session_start();
				$_SESSION["validar"] = true;
				header("location:index.php?action=usuarios");
			}else{
				header("location:index.php?action=fallo");
			}

		}	

	}
	}


?>