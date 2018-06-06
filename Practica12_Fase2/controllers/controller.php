
<?php
	class MvcController{
		//Funcion que mandara llamar el archivo template.php, dicho archivo ser mandado llamar en el archivo index.php para aplicar las paginas y estilos
		public static function page(){
			include "views/template.php";
		}

		//Metodo para mandar los enlaces  mediante la variable "action"
		public static function linkPageController(){
			if(isset( $_GET['action'])){//Se condiciona que si se reciba a una "action" se mande al link de dicha accion
				$link = $_GET['action'];
			}else{
				$link = "index";// sino se redirecciona al index, el cual representa el login
			}
			$respuesta = Pages::linkPagesM($link);//Se hace el uso del modelo de los enlaces de las paginas
			include $respuesta;//Se manda llamar el resultado del modelo de los enlaces para incluirlo en le template.php

		}
		//Funcion que permite el login de un usuario dependiendo si el email y el password que se ingresen son iguales a alguno de los registros de la base de datos
		public static function loginController(){
			if(isset($_POST["login"])){//Se condiciona si se utilizo el boton de nombre "login"

				//Se hace el llenado de un arreglo con los datos que se ingresaron en el login
				$data = array( "username"=>$_POST["username"], "password"=>$_POST["password"]);
				
				//Los datos del arreglo se mandan como parametros en el modelo del login y la table user
				$answer = Data::loginModel($data, "user");
				
				//Se condiciona que si los datos ingresados en el login coinciden con los de algun usuario de la base de datos se inicie la sesion
				if($answer["username"] == $_POST["username"] && $answer["password"] == $_POST["password"]){
					session_start();
					$_SESSION["user"] = $answer["id"];//A la variable de sesion se le asigna el valor del id del usuario que ingreso

					//Al iniciar la sesion se redirecciona al dashboard
					header("location:index.php?action=dashboard");
				}else{
					header("location:index.php");//Si no se enceuntran datos que coincidan con los del login, se redirecciona al login
				}
			}
		}
		//Funcion que trae solamente el nombre y el apellido del usario para ser mostrados en la parte superior del dashboard
		public static function userInfoController(){
			$answer = Data::userInfoModel($_SESSION['user'],"user");
			echo $answer["firstname"]." ".$answer["lastname"];
		}	

		############################################################################################################################
		###################################################### PRODUCT CONTROLLER ##################################################
		############################################################################################################################


		//Metodo para imprimir los datos de la tabla Producto dentro de un DataTable, con sus respectivos nombres de categorias
		public static function productViewsController(){
			$answer = Data::productViewsModel("products","category");
			foreach ($answer as $row => $product) {//Ciclo para imprimir cada uno de los registros de la tabla
				echo '
				<tr>
					<td>'.$product['id_prod'].'</td>
					<td>'.$product['code'].'</td>
					<td>'.$product['prod_name'].'</td>
					<td>'.$product['date_added'].'</td>
					<td>$'.$product['price'].'</td>
					<td>'.$product['stock'].'</td>
					<td>'.$product['cat_name'].'</td>
					<td><a href="index.php?action=editProduct&id='.$product['id_prod'].'" class="btn btn-primary">Editar</a></td>
					<td><a href="index.php?action=deleteProduct&id='.$product['id_prod'].'" class="btn btn-danger">Eliminar</a></td>
					<td><a href="index.php?action=viewProduct&id='.$product['id_prod'].'" class="btn btn-info">Operaciones</a></td>
				</tr>';
			}
			
		}

		//Metodo que cuenta el total de productos diferentes que estan registrados
		public static function countProductController(){
			$answer = Data::productViewsModel("products","category");
			echo count($answer);// Se impirmie el total de los registros de la tabla productos
		}

		//Funcion que permite agregar productos, obteniendo los datos a agregar de un formulario mediante el metodo post
		public static function addProductController(){
			if(isset($_POST["add"])){
				
				//Se declara un arreglo asociativo con los valores de los campos del formulario de registro de producto
				$data = array("code"=>$_POST['code'],"prod_name"=>$_POST["prod_name"],"date_added"=>date("Y-m-d"),"price"=>$_POST["price"],"stock"=>$_POST["stock"],"category_id"=>$_POST["category_id"]);
				
				//Se manda como parametro dicho arreglo en el modelo de registro de productos junto con el nombre de la tabla productos
				$answer = Data::addProductModel($data,"products");

				
				if($answer=="success"){//Se condiciona si el Modelo de registro devuelve "success" se redireccione al apartado de productos
					echo "<script>
							window.location='index.php?action=products'

						</script>";
					
				}else if($answer == "fail"){//Si retorna "fail" imprimira un error al registrar
					echo "Error al registrar";
				}
			}
		}

		//Metodo para mostrar los datos del producto dentro de campos de texto para su edicion
		public static function editProductController(){
			$id = $_GET['id'];//Se recibe el id del producto el cual es mandado por variable de url
			$answer = Data::editProductModel($id,"products");//Se decalara una varibale que tendra el resultado del uso del modelo de editar producto
			echo '
				<input type="hidden" value="'.$answer['id_prod'].'" name="id" class="form-control">

				<div class="col-2"></div>
				<div class="col-8">
					<label>Codigo del Producto</label><input type="text" value="'.$answer['code'].'" name="code" class="form-control"><br>
				</div>
				<div class="col-2"></div>

				<div class="col-2"></div>
				<div class="col-4">
					<label>Nombre del Producto</label><input type="text" value="'.$answer['prod_name'].'" name="prod_name" class="form-control">
				</div>
				<div class="col-4">
					<label>Categoria</label><input type="text" value="'.$answer['category_id'].'" name="category_id" class="form-control"><br>
				</div>
				<div class="col-2"></div>
			
				<div class="col-2"></div>
				<div class="col-3">
					<label>Fecha de Registro</label><input type="date" value="'.$answer['date_added'].'" name="date_added" class="form-control">
				</div>
				<div class="col-3">
					<label>Precio</label><input type="number" value="'.$answer['price'].'" name="price" class="form-control">
				</div>
				<div class="col-2">
					<label>Stock</label><input type="number" value="'.$answer['stock'].'" name="stock" class="form-control">
				</div>
				
				<div class="container" align="center">
					<br><input type="submit" value="Actualizar" name="update" class="btn-lg btn-primary">
				</div>
			';
		}

		//Metodo para actualizar un producto 
		public static function updateProductController(){
			
			if(isset($_POST['update'])){//Se condiciona se hizo uso del boton de nombre "update" 
				
				//Se declara un arreglo asociativo con el valor de los campos que se impirmieron de la edicion
				$data= array("id"=>$_POST['id'],"code"=>$_POST["code"],"prod_name"=>$_POST["prod_name"],"date_added"=>$_POST["date_added"],"price"=>$_POST["price"],"stock"=>$_POST["stock"],"category_id"=>$_POST["category_id"]);
				
				//El arreglo anterior se manda como parametro para el uso del modelo de actualizacion de productos junto con la tabla de los productos
				$answer = Data::updateProductModel($data,"products");
				
				if($answer=="success"){//Si el modelo de actualizar Producto devuelve "success" se redirecciona al apartado de productos
						echo "<script>
							window.location='index.php?action=products'

						</script>";
				}else if($answer == "fail"){//Si devuelve "fail" mandara mensaje de error al actualizar
						echo "<br><h1>Error al actualizar<h1>";
				}
			}
		}

		//Metodo para eliminar un producto
		public static function deleteProductController(){
			
			if(isset($_POST['delete'])){//Se condiciona se hizo uso del boton de nombre "delete" 
				
				//Se declara un arreglo asociativo con el valor del id del usuario activo, el id del producto a eliminar y el password del usuario activo
				$data= array("userId"=>$_SESSION["user"],"password"=>$_POST["password"],"id"=>$_GET['id'],"user_id"=>$_SESSION['user']);
				
				//Se manda el arreglo como parametro del modelo de eliminacion de producto junto con las tablas correspondientes
				$answer = Data::deleteProductModel($data,"user","products","historial");
				if($answer=="success"){//Si el modelo retorna "success" se redirecciona al apartado de productos
						echo "<script>
							window.location='index.php?action=products'

						</script>";
				}else if($answer == "fail"){//Si retorna fail maracara un error 
						echo "<br><h1>Error al Eliminar<h1>";
				}
			}

		}

		//Metodo que mostrara la informacion del producto en el apartado de eliminacion
		public static function productController(){
			$id = $_GET['id'];//Se recibira el id mediante variable de url
			
			//Se manda el id como parametro del modelo
			$answer = Data::productModel($id,"products");
			
			echo'
			<input type="hidden" name="product_name" value="'.$answer["prod_name"].'">
			<H3>ID: <label style="color:#109271">'.$answer["id_prod"].'</label></h3>
			<h3>Codigo: <label style="color:#109271">'.$answer["code"].'</label></h3>
			<h3>Producto: <label style="color:#109271">'.$answer["prod_name"].'</label></h3>
			<h3>Precio: <label style="color:#109271">$'.$answer["price"].'</label></h3>
			<h3>Piezas: <label style="color:#109271">'.$answer["stock"].'</label></h3>
			';
		}

		############################################################################################################################
		###################################################### USER CONTROLLER #####################################################
		############################################################################################################################

		//Metodo para imprimir los datos de la tabla User dentro de un DataTable
		public static function userViewController(){

			//Se declara una variable que contendra el resultado que retorna el modelo de Vista de usuario
			$answer = Data::userViewModel("user");
			foreach ($answer as $row => $user) { //Por cada registro de la tabla de usuarios se imprimiran los datos
				echo '
				<tr>
					<td>'.$user['id'].'</td>
					<td>'.$user['firstname'].'</td>
					<td>'.$user['lastname'].'</td>
					<td>'.$user['username'].'</td>
					<td>'.$user['email'].'</td>
					<td>'.$user['date_added'].'</td>
					<td><a href="index.php?action=editUser&id='.$user['id'].'" class="btn btn-primary">Editar</a></td>
					<td><a href="index.php?action=deleteUser&id='.$user['id'].'" class="btn btn-danger">Eliminar</a></td>
				</tr>';
			}
			
		}

		//Metodo para contar los usuarios
		public static function countUserController(){
			//Se declara una vaible que conendra el resultado de la consutla que devuelve el modelo
			$answer = Data::userViewModel("user");
			//Se impirme el totoal de los usuarios
			echo count($answer);

		}

		//Metodo para agregar un usuario
		public static function addUserController(){

			if(isset($_POST["add"])){//Se condiciona si se hizo uso del botton "add"

				//Se decalra un arreglo asociativo que contendra los datos del formulario de registro de usuario
				$data = array("firstname"=>$_POST['firstname'],"lastname"=>$_POST["lastname"],"username"=>$_POST['username'],"password"=>$_POST["password"],"email"=>$_POST["email"],"date_added"=>date("Y-m-d"));

				//Se manda el arreglo como parametro del modelo de agregar usuarios junto con el nombre de la tabla
				$answer = Data::addUserModel($data,"user");

				if($answer=="success"){//Si el modelo retorna "success" se redireccionara al apartado de usuarios
					echo "<script>
						window.location='index.php?action=users'
					</script>";
					
				}else if($answer == "fail"){// Si retorna fail marcara error al registrar
					echo "Error al registrar";
				}
			}
		}

		//Metodo para editar un usuario
		public static function editUserController(){
			
			$id = $_GET['id'];//Se recibe el id del usuario a editar mediante variable de url

			
			//Se manda el id del usuario a editar como parametro del modelo de edicion de usaruio junto con la tabla donde se encuentran los usuarios
			$answer = Data::editUserModel($id,"user");
			echo '
				<input type="hidden" value="'.$answer['id'].'" name="id" class="form-control">
				<div class="col-2"></div>
				<div class="col-4">
					<label>Nombre(s)</label><input type="text" value="'.$answer['firstname'].'" name="firstname" class="form-control">
				</div>
				<div class="col-4">
					<label>Apellido(s)</label><input type="text" value="'.$answer['lastname'].'" name="lastname" class="form-control"><br>
				</div>
				<div class="col-2"></div>
			
				<div class="col-2"></div>
				<div class="col-2">
					<label>username</label><input type="text" value="'.$answer['username'].'" name="username" class="form-control">
				</div>
				<div class="col-3">
					<label>Password</label><input type="password" value="'.$answer['password'].'" name="password" class="form-control">
				</div>
				
				<div class="col-3">
					<label>E-Mail</label><input type="email" value="'.$answer['email'].'" name="email" class="form-control">
				</div>

				<div class="container" align="center">
					<br><input type="submit" value="Actualizar" name="update" class="btn-lg btn-primary">
				</div>
			';
		}

		//Metodo para actualizar usuarios
		public static function updateUserController(){

			if(isset($_POST['update'])){//Se condiciona si se hizo uso del boton "update"

				//Se declara un arreglo el cual contendra los datos que se actualizaran del usuario
				$data= array("id"=>$_POST['id'],"firstname"=>$_POST["firstname"],"lastname"=>$_POST["lastname"],"username"=>$_POST["username"],"password"=>$_POST["password"],"email"=>$_POST["email"]);

				//Se mandara el arregllo como parametro para la actualizacion del usuario
				$answer = Data::updateUserModel($data,"user");
				if($answer=="success"){//Si el modelo retorna "success" redireccionara al apartado de usuarios
						echo "<script>
							window.location='index.php?action=users'

						</script>";
				}else if($answer == "fail"){// si retorna "fail" mandara un mensaje de error
						echo "<br><h1>Error al actualizar<h1>";
				}
			}
		}


		//Metodo para eliminar usuarios
		public static function deleteUserController(){
			
			if(isset($_POST['delete'])){//Se condiciona si se hizo uso del boton "delete"

				//Se declara un arreglo que contendra el id del usuario y el password del usuario activo, y el id del usuario que se eliminara
				$data= array("userId"=>$_SESSION["user"],"password"=>$_POST["password"],"id"=>$_GET['id']);

				//El arreglo se pasa como parametro hacia el modelo junto con la tabla de usuarios e historial
				$answer = Data::deleteUserModel($data,"user","historial");
				
				if($answer=="success"){//Si el modelo retorna "success" se redireccionara al apartado de usuarios
						echo "<script>
							window.location='index.php?action=users'
						</script>";
				}else if($answer == "fail"){//Si retorna "fail" mandara mensaje de error al eliminar
						echo "<br><h1>Error al Eliminar<h1>";
				}
			}

		}

		//Metodo que solo mandarra el nombre y apellido del usuario para agregarlo en la tabla historial
		public static function userController(){
			$id = $_SESSION["user"];
			$answer = Data::userModel($id,"user");
			echo '<input type="hidden" value="'.$answer['firstname'].' '.$answer["lastname"].'" name="user">
				';	
		}

		//Metodo que mostrara los datos del usuario en el apartado de eliminacion
		public static function userDInfoController(){

			$id = $_GET["id"];//Se recibira el id del usuario a eliminar mediante variable por url
			
			//Se mandara el id del usuario hacia el modelo para poder imprimir los datos de ese usuario a eliminar
			$answer = Data::userModel($id,"user");
			echo '
				<input type="hidden" value="'.$answer['id'].'"name="user">
				<H2>Nombre(s): <label style="color:#109271">'.$answer["firstname"].'</label></h2>
				<h2>Apellido(s): <label style="color:#109271">'.$answer["lastname"].'</label></h2>
				<h2>Usuario: <label style="color:#109271">'.$answer["username"].'</label></h2>
				<h2>E-Mail: <label style="color:#109271">$'.$answer["email"].'</label></h2>
				<h2>Fecha de Ingreso: <label style="color:#109271">'.$answer["date_added"].'</label></h2>

			';
		}




		############################################################################################################################
		###################################################### CATEGORY CONTROLLER #################################################
		############################################################################################################################
		
		//Metodo para visualizar todas las categorias
		public static function categoryViewController(){

			//Se manda como parametro el nombre de la tabla donde se encuentran las categorias
			$answer = Data::categoryViewModel("category");
			foreach ($answer as $row => $category) { //Mientras se encuentren registros en la tabla se imprimiran los datos de las categorias
				echo '
				<tr>
					<td>'.$category['cat_id'].'</td>
					<td>'.$category['cat_name'].'</td>
					<td>'.$category['description'].'</td>
					<td>'.$category['date_added'].'</td>
					<td><a href="index.php?action=editCategory&cat_id='.$category['cat_id'].'" class="btn btn-primary">Editar</a></td>
					<td><a href="index.php?action=deleteCategory&id='.$category['cat_id'].'" class="btn btn-danger">Eliminar</a></td>
				</tr>';
			}
			
		}
		//Metodo para contar el total de categorias
		public static function countCategoryController(){
			$answer = Data::categoryViewModel("category");
			echo count($answer);
		}

		//Metodo para agregar una categoria
		public static function addCategoryController(){

			if(isset($_POST["add"])){//Se condiciona si se hizo uso del boton "add"
				
				//Se mandan los datos del formulario de registro de categorias a un arreglo
				$data = array("cat_name"=>$_POST['cat_name'],"description"=>$_POST["description"],"date_added"=>date("Y-m-d"));
				
				//Se manda el arreglo como parametro al modelo junto con la tabla
				$answer = Data::addCategoryModel($data,"category");

				if($answer=="success"){//Si retorna success se redireccionara al apartado de categorias
					echo "<script>
						window.location='index.php?action=categories'
					</script>";
					
				}else if($answer == "fail"){//Si retorna fail mandara un mensaje de error
					echo "Error al registrar";
				}
			}
		}

		//Metodo para editar las categorias 
		public static function editCategoryController(){

			$id = $_GET['cat_id'];//Se recibe el id de la categoria mediante variable url

			//Se manda el id de la categoria como parametro para el modelo junto con la tabla
			$answer = Data::editCategoryModel($id,"category");
			echo '
				<input type="hidden" value="'.$answer['cat_id'].'" name="cat_id" class="form-control">
				<div class="col-2"></div>
				<div class="col-4">
					<label>Nombre</label><input type="text" value="'.$answer['cat_name'].'" name="cat_name" class="form-control">
				</div>
				<div class="col-4">
					<label>Descripcion</label><input type="text" value="'.$answer['description'].'" name="description" class="form-control"><br>
				</div>
				<div class="col-2"></div>
				<div class="container" align="center">
					<br><input type="submit" value="Actualizar" name="update" class="btn-lg btn-primary">
				</div>
			';
		}

		//Metodo para actualizar categorias
		public static function updateCategoryController(){
			
			if(isset($_POST['update'])){//Se condiciona si se hizo uso del boton "update"

				//Se declara un arreglo que contendra los datos que se ingresaran para actualizar la categoria
				$data= array("cat_id"=>$_POST['cat_id'],"cat_name"=>$_POST["cat_name"],"description"=>$_POST["description"]);
				
				//Se manda el arreglo como parametro del modelo junto con la table categoria
				$answer = Data::updateCategoryModel($data,"category");

				if($answer=="success"){//Si el modelo retorna "success" se redireccionara al apartado de categorias
						echo "<script>
							window.location='index.php?action=categories'

						</script>";
				}else if($answer == "fail"){//Si retonra fail se mandara un mensaje de error
						echo "<br><h1>Error al actualizar<h1>";
				}
			}
		}

		//Metodo para mostrar las categorias dentro de un select2
		public static function selectCategory(){
			$answer = Data::categoryViewModel("category");
			foreach ($answer as $row => $category) {
				echo "<option value='$category[cat_id]'>".$category['cat_name']."</option>";
			}
		}

		//Metodo para eliminar una categoria
		public static function deleteCategoryController(){
			if(isset($_POST['delete'])){//Se condiciona si se hizo uso del boton "delete"

				//Se delcara un arrgelo asociativo que contendra el usuario y la contraseña del usuario activo, tambien contendra el id de la categoria
				$data= array("userId"=>$_SESSION["user"],"password"=>$_POST["password"],"id"=>$_GET['id']);

				//Se mandara el arreglo como parameto para el modelo junto con las tablas correspondientes
				$answer = Data::deleteCategoryModel($data,"user","category","products");

				if($answer=="success"){//Si el modelo retorna success se redireccionara a las categorias
						echo "<script>
							window.location='index.php?action=categories'
						</script>";
				}else if($answer == "fail"){//Si retorna fail se mandara un mensaje de error al eliminar
						echo "<br><h1>Error al Eliminar<h1>";
				}
			}
		}

		//Metodo para mostrar la informacion de la categoria en el apartado de eliminacion
		public static function categoryController(){
			$id = $_GET['id'];//Se recibe el id de la categoria mediante variable de url
			
			//Se manda el id como parametro para el modelo de la caregoria
			$answer = Data::categoryModel($id,"category");
			echo'
			<H2>ID: <label style="color:#109271">'.$answer["cat_id"].'</label></h2>
			<h2>Nombre: <label style="color:#109271">'.$answer["cat_name"].'</label></h2>
			<h2>Descripcion: <label style="color:#109271">'.$answer["description"].'</label></h2>
			<h2>Fecha de registro: <label style="color:#109271">'.$answer["date_added"].'</label></h2>
			';
		}


		############################################################################################################################
		###################################################### HISTORIAL CONTROLLER ################################################
		############################################################################################################################

		//Metodo para ver dentro de un DataTable la informacion de los moviemientos que se han realizado de cada
		public static function viewProductHistorialController(){
			$id=$_GET["id"];
			$answer = Data::viewProductHistorialModel($id,"historial");
			foreach ($answer as $row => $productHistory) {
				echo '
				<tr>
					<td>'.$productHistory['id_historial'].'</td>
					<td>'.$productHistory['id_producto'].'</td>
					<td>'.$productHistory['product_name'].'</td>
					<td>'.$productHistory['user_id'].'</td>
					<td>'.$productHistory['user'].'</td>
					<td>'.$productHistory['date_added'].'</td>
					<td>'.$productHistory['note'].'</td>
					<td>'.$productHistory['reference'].'</td>
					<td>'.$productHistory['quantity'].'</td>
				';
			}
		}

		//Metodo para contar cuantos movimientos han sido realizados
		public static function countHistorialController(){
			$answer = Data::viewHistorialModel("historial");
			echo count($answer);		
		}

		//Metodo para visualizar los moviemientos que ha realizado cada usuario
		public static function viewUserHistorialController(){
			$answer = Data::viewUserHistorialModel("historial");
			echo count($answer);
		}

		//Metodo para agregar un historial 
		public static function addHistorialController(){
			
			if(isset($_POST["addStock"])){ //Se condiciona Si se hizo uso del boton addStock

				//Se declara un arreglo que contendra los datos del producto, datos del usuario y los campos del formulario a llenar para realizar un movimiento
				$data = array("id_producto"=>$_GET["id"],"product_name" => $_POST["product_name"], "user_id"=>$_SESSION['user'],"user"=>$_POST["user"], "date_added"=>date("Y-m-d"), "note"=>$_POST["note"],"reference"=>$_POST["reference"],"quantity"=>$_POST["quantity"]);
				
				//El arreglo se mandara como parametro del modelo para agregar al historial junto con el nombre de su respectiva tabla
				$answer = Data::addHistorialModel($data,"historial");
				
				//Se recibira el id del producto por url
				$id = $_GET['id'];

				//El id del producto sera mandado como parametro para mostrar los datos del producto al modelo y poder contar su stock
				$answer2 = Data::productModel($id,"products");
				
				//Se tomara la cantidad que se le ingreso al campo quantity y se le sumara el resultado del stock del producto
				$cant = $_POST['quantity'] + $answer2['stock'];
				
				//Se declarara una array asociativo que contendra el id del producto y la variable que contiene la suma de las cantidades
				$stock = array("id"=>$_GET["id"],"stock"=>$cant);
				
				//El arrgelo se manda como parametro de del modelo que agregara al stock
				$addStock = Data::addStockModel($stock,"products");
				
			}else if(isset($_POST["removeStock"])){//Se condiciona si se hizo uso del boton removeStock

				//Se declara un arreglo que contendra los datos del producto, datos del usuario y los campos del formulario a llenar para realizar un movimiento
				$data = array("id_producto"=>$_GET["id"], "product_name" => $_POST["product_name"] ,"user_id"=>$_SESSION['user'],"user"=>$_POST["user"], "date_added"=>date("Y-m-d"), "note"=>$_POST["note"],"reference"=>$_POST["reference"],"quantity"=>$_POST["quantity"]);
				
				//El arreglo se mandara como parametro del modelo para agregar al historial junto con el nombre de su respectiva tabla
				$answer = Data::addHistorialModel($data,"historial");
				
				//Se recibira el id del producto por url
				$id = $_GET['id'];
				
				//El id del producto sera mandado como parametro para mostrar los datos del producto al modelo y poder contar su stock
				$answer2 = Data::productModel($id,"products");
				
				//Se tomara la cantidad de resultado del stock del producto y se le restara la cantidad ingresada
				$cant =  $answer2['stock'] - $_POST['quantity'];
				
				//Se declarara una array asociativo que contendra el id del producto y la variable que contiene la suma de las cantidades
				$stock = array("id"=>$_GET["id"],"stock"=>$cant);

				//El arrgelo se manda como parametro de del modelo que agregara al stock
				$addStock = Data::addStockModel($stock,"products");
				
			}
		}
	}
?>