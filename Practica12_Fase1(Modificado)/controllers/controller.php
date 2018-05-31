
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
					<td>'.$product['code'].'</td>
					<td>'.$product['name'].'</td>
					<td>'.$product['date_added'].'</td>
					<td>'.$product['price'].'</td>
					<td>'.$product['stock'].'</td>
					<td>'.$product['category_id'].'</td>
					<td><a href="index.php?action=editProduct&id='.$product['id'].'" class="btn btn-primary">Editar</a></td>
					<td><a href="index.php?action=products&id='.$product['id'].'" class="btn btn-danger">Eliminar</a></td>
				</tr>';
			}
			
		}
		//Funcion que permite agregar productos, obteniendo los datos a agregar de un formulario mediante el metodo post
		public static function addProductController(){
			if(isset($_POST["add"])){
				$data = array("code"=>$_POST['code'],"name"=>$_POST["name"],"date_added"=>$_POST['date_added'],"price"=>$_POST["price"],"stock"=>$_POST["stock"],"category_id"=>$_POST["category_id"]);
				$answer = Data::addProductModel($data,"products");

				if($answer=="success"){
					echo "<br><h1>Registro exitoso<h1>";
					header("location: index.php?action=products");
				}else if($answer == "fail"){
					echo "Error al registrar";
				}
			}
		}

		public static function editProductController(){
			$id = $_GET['id'];
			$answer = Data::editProductModel($id,"products");
			echo '
				<label>ID del Producto</label><input type="text" value="'.$answer['id'].'" name="id" class="form-control">
				<label>Codigo del Producto</label><input type="text" value="'.$answer['code'].'" name="code" class="form-control">
				<label>Nombre del Producto</label><input type="text" value="'.$answer['name'].'" name="name" class="form-control">
				<label>Fecha de Registro</label><input type="text" value="'.$answer['date_added'].'" name="date_added" class="form-control">
				<label>Precio</label><input type="number" value="'.$answer['price'].'" name="price" class="form-control">
				<label>Stock</label><input type="number" value="'.$answer['stock'].'" name="stock" class="form-control">
				<label>Categoria</label><input type="number" value="'.$answer['category_id'].'" name="category_id" class="form-control"><br>
				<div class="container" align="center">
					<input type="submit" value="Actualizar" name="update" class="btn-lg btn-primary">
				</div>
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