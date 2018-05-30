
<?php
	class MvcController{

		public static function page(){
			include "views/template.php";
		}

		public static function linkPageController(){
			if(isset( $_GET['action'])){
				$link = $_GET['action'];
			}else{
				$link = "index";
			}
			$respuesta = Pages::linkPagesM($link);
			include $respuesta;
		}

		//Funcion que permite el login de un usuario dependiendo si el email y el password que se ingresen son iguales a alguno de los registros de la base de datos
		public static function loginController(){
			if(isset($_POST["login"])){
				$data = array( "email"=>$_POST["email"], "password"=>$_POST["password"]);
				$answer = Data::loginModel($data, "user");
				if($answer["email"] == $_POST["email"] && $answer["password"] == $_POST["password"]){
					//session_start();
					//$_SESSION["maestro"] = $answer["id"];
					header("location:index.php?action=products&id=$answer[id]");
				}else{
					header("location:index.php?action=login");
				}
			}
		}	

		public static function productViewsController(){
			$answer = Data::productViewsModel("products");
			foreach ($answer as $row => $product) {
				echo '
				<tr>
					<td>'.$product['id'].'</td>
					<td>'.$product['name'].'</td>
					<td>'.$product['description'].'</td>
					<td>'.$product['price'].'</td>
					<td>'.$product['stock'].'</td>
					<td><a href="index.php?action=editProduct&id='.$product['id'].'">Editar</a></td>
					<td></td>
				</tr>';
			}
			
		}
		//Funcion que permite agregar productos, obteniendo los datos a agregar de un formulario mediante el metodo post
		public static function addProductController(){
			if(isset($_POST["add"])){
				$data = array("id"=>$_POST['id'],"name"=>$_POST["name"],"description"=>$_POST['description'],"price"=>$_POST["price"],"stock"=>$_POST["stock"]);
				$answer = Data::addProductModel($data,"products");

				if($answer=="success"){
					echo "<br><h1>Registro exitoso<h1>";
				}else if($answer == "fail"){
					echo "Error al registrar";
				}
			}
		}

		public static function editProductController(){
			$id = $_GET['id'];
			$answer = Data::editProductModel($id,"products");
			echo '
				<input type="text" value="'.$answer['id'].'" name="id" hidden>
				<input type="text" value="'.$answer['name'].'" name="name">
				<input type="text" value="'.$answer['description'].'" name="description">
				<input type="text" value="'.$answer['price'].'" name="price">
				<input type="number" value="'.$answer['stock'].'" name="stock">
				<input type="submit" value="Actualizar" name="update">
			';
		}

		public static function updateProductController(){
			if(isset($_POST['update'])){
				$data= array("id"=>$_POST['id'],"name"=>$_POST["name"],"description"=>$_POST['description'],"price"=>$_POST["price"],"stock"=>$_POST["stock"]);
				$answer = Data::updateProductModel($data,"products");
				if($answer=="success"){
						header("location: index.php?action=products");
				}else if($answer == "fail"){
						echo "<br><h1>Error al actualizar<h1>";
				}
			}
		}



	}



?>