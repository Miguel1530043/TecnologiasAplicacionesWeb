<?php
	class MvcController{

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


		public static function loginController(){
			if(isset($_POST["login"])){//Se condiciona si se utilizo el boton de nombre "login"

				//Se hace el llenado de un arreglo con los datos que se ingresaron en el login
				$data = array( "username"=>$_POST["username"], "password"=>$_POST["password"]);
				
				//Los datos del arreglo se mandan como parametros en el modelo del login y la table user
				$answer = Data::loginModel($data, "usuario");
				
				//Se condiciona que si los datos ingresados en el login coinciden con los de algun usuario de la base de datos se inicie la sesion
				if($answer["username"] == $_POST["username"] && $answer["password"] == $_POST["password"]){
					session_start();
					$_SESSION["user"] = $answer["id_usuario"];//A la variable de sesion se le asigna el valor del id del usuario que ingreso

					//Al iniciar la sesion se redirecciona al dashboard
					echo"<script>
						window.location='index.php?action=listar'
					</script>";
				}else{
					echo "<script>
						window.location='index.php'
					</script>";//Si no se enceuntran datos que coincidan con los del login, se redirecciona al login
				}
			}
		}

		public static function productsViewController(){
			$answer = Data::productsViewModel("producto");
			
			foreach ($answer as $row => $product) {//Ciclo para imprimir cada uno de los registros de la tabla
				echo '
				<tr>
					<td>'.$product['id_producto'].'</td>
					<td>'.$product['codigo'].'</td>
					<td>'.$product['descripcion'].'</td>
					<td>$'.$product['precio_compra'].'</td>
					<td>$'.$product['precio_venta'].'</td>
					<td>'.$product['existencia'].'</td>
					<td><a href="index.php?action=editar&id='.$product['id_producto'].'" class="btn btn-primary">Editar <i class="fa fa-edit"></i></a></td>
					<td><a id="eliminar'.$product["id_producto"].'" onclick="eliminar('.$product['id_producto'].')" href="index.php?action=eliminarProducto&id_producto='.$product["id_producto"].'" class="btn btn-danger" >Eliminar <i class="fa fa-trash"></i></a></td>
				</tr>
				';
			}
			
			
		}

		public static function addProductController(){
			if(isset($_POST["add"])){
				
				//Se declara un arreglo asociativo con los valores de los campos del formulario de registro de producto
				$data = array("codigo"=>$_POST['codigo'],"descripcion"=>$_POST["descripcion"],"precio_venta"=>$_POST["precio_venta"],"precio_compra"=>$_POST["precio_compra"],"existencia"=>$_POST["existencia"]);
				
				//Se manda como parametro dicho arreglo en el modelo de registro de productos junto con el nombre de la tabla productos
				$answer = Data::addProductModel($data,"producto");

				
				if($answer=="success"){//Se condiciona si el Modelo de registro devuelve "success" se redireccione al apartado de productos
					echo "<script>
							window.location='index.php?action=listar'

						</script>";
					
				}else if($answer == "fail"){//Si retorna "fail" imprimira un error al registrar
					echo "Error al registrar";
				}
			}
		}



		public static function editProductController(){
			$id = $_GET['id'];//Se recibe el id del producto el cual es mandado por variable de url
			$answer = Data::editProductModel($id,"producto");//Se decalara una varibale que tendra el resultado del uso del modelo de editar producto
			echo '
				<input type="hidden" value="'.$answer['id_producto'].'" name="id_producto" class="form-control">

				<div class="col-2"></div>
				<div class="col-8">
					<label>Codigo del Producto</label><input type="text" value="'.$answer['codigo'].'" name="codigo" class="form-control"><br>
				</div>
				<div class="col-2"></div>

				<div class="col-2"></div>
				<div class="col-4">
					<label>Descripcion</label><input type="text" value="'.$answer['descripcion'].'" name="descripcion" class="form-control">
				</div>
				<div class="col-4">
					<label>Precio venta</label><input type="text" value="'.$answer['precio_venta'].'" name="precio_venta" class="form-control"><br>
				</div>
				<div class="col-2"></div>
			
				<div class="col-2"></div>
				<div class="col-3">
					<label>Precio Compra</label><input type="text" value="'.$answer['precio_compra'].'" name="precio_compra" class="form-control">
				</div>
				<div class="col-3">
					<label>Existencia</label><input type="number" value="'.$answer['existencia'].'" name="existencia" class="form-control">
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
				$data= array("id_producto"=>$_POST['id_producto'],"codigo"=>$_POST["codigo"],"descripcion"=>$_POST["descripcion"],"precio_venta"=>$_POST["precio_venta"],"precio_compra"=>$_POST["precio_compra"],"existencia"=>$_POST["existencia"]);
				
				//El arreglo anterior se manda como parametro para el uso del modelo de actualizacion de productos junto con la tabla de los productos
				$answer = Data::updateProductModel($data,"products");
			
				if($answer=="success"){//Si el modelo de actualizar Producto devuelve "success" se redirecciona al apartado de productos
						echo "<script>
							window.location='index.php?action=listar';
						</script>";
				}else if($answer == "fail"){//Si devuelve "fail" mandara mensaje de error al actualizar
						echo "<br><h1>Error al actualizar<h1>";
				}
			}
		}
		public static function deleteProductController(){
			
			//if(isset($_POST['delete'])){//Se condiciona se hizo uso del boton de nombre "delete" 
				//Se declara un arreglo asociativo con el valor del id del usuario activo, el id del producto a eliminar y el password del usuario activo
				$data = $_GET['id_producto'];
				
				//Se manda el arreglo como parametro del modelo de eliminacion de producto junto con las tablas correspondientes
				$answer = Data::deleteProductModel($data,"producto");
				if($answer=="success"){//Si el modelo retorna "success" se redirecciona al apartado de productos
						echo "<script>
							window.location='index.php?action=listar';
						</script>";
				}else if($answer == "fail"){//Si retorna fail maracara un error 
						echo "<br><h1>Error al Eliminar<h1>";
				}
			//}

		}

		#########################################################################################################################################
		################################################################# VENDER ################################################################
		#########################################################################################################################################

		public static function venderController(){
			if(isset($_GET["status"])){
				if($_GET["status"] === "1"){
					?>
						<div class="alert alert-success">
							<strong>¡Correcto!</strong> Venta realizada correctamente
						</div>
					<?php
				}else if($_GET["status"] === "2"){
					?>
					<div class="alert alert-info">
							<strong>Venta cancelada</strong>
						</div>
					<?php
				}else if($_GET["status"] === "3"){
					?>
					<div class="alert alert-info">
							<strong>Ok</strong> Producto quitado de la lista
						</div>
					<?php
				}else if($_GET["status"] === "4"){
					?>
					<div class="alert alert-warning">
							<strong>Error:</strong> El producto que buscas no existe
						</div>
					<?php
				}else if($_GET["status"] === "5"){
					?>
					<div class="alert alert-danger">
							<strong>Error: </strong>El producto está agotado
						</div>
					<?php
				}else{
					?>
					<div class="alert alert-danger">
							<strong>Error:</strong> Algo salió mal mientras se realizaba la venta
						</div>
					<?php
				}
			}
		}

		public static function cancelarVenta(){
			unset($_SESSION["carrito"]);
			$_SESSION["carrito"] = [];
			echo"<script>
				window.location='index.php?action=vender&status=2';

			</script>";
		}

		public static function agregarCarritoController(){
			if(!isset($_POST["codigo"])){
				return;
			}
			$codigo = $_POST["codigo"];
	
			$producto = Data::agregarCarritoModel($codigo,"producto");
			if($producto){
				if($producto->existencia < 1){
					echo"<script>
						window.location=index.php?action=vender&status=5
					</script>";
					exit;
				}
				//session_start();
				$indice = false;
				for ($i=0; $i < count($_SESSION["carrito"]); $i++) { 
					if($_SESSION["carrito"][$i]->codigo === $codigo){
						$indice = $i;
						break;
					}
				}
				if($indice === FALSE){
					$producto->cantidad = 1;
					$producto->total = $producto->precio_venta;
					array_push($_SESSION["carrito"], $producto);
				}else{
					$_SESSION["carrito"][$indice]->cantidad++;
					$_SESSION["carrito"][$indice]->total = $_SESSION["carrito"][$indice]->cantidad * $_SESSION["carrito"][$indice]->precio_venta;
				}
				echo"<script>
						window.location=index.php?action=vender
					</script>";
			}else
				echo"<script>
						window.location=index.php?action=vender&status=4
					</script>";
		}

		public static function verCarritoController(){
			$granTotal=0;
			foreach ($_SESSION["carrito"] as $indice => $producto) {
				$granTotal += $producto->total;
				echo'
					<tr>
						<td>'.$producto->codigo.'</td>
						<td>'.$producto->descripcion.'</td>
						<td>$'.$producto->precio_venta.'</td>
						<td>'.$producto->cantidad.'</td>
						<td>$'.$producto->total.'</td>
						<td><a class="btn btn-danger" href="index.php?action=quitarDelCarrito&indice='. $indice.'"><i class="fa fa-trash"></i></a></td>
					</tr>
				</tbody>';
			}

			echo '
			</table>
			<h3>Total: $'. $granTotal.'</h3>
			<form method="POST">
				<input name="total" type="hidden" value="'.$granTotal.'"/>
				<input type="submit" class="btn btn-success" value="Terminar Venta">
				<a href="index.php?action=cancelarVenta" class="btn btn-danger">Cancelar venta</a>
			</form>';
		}


		public static function ventasController(){
			$answer = Data::ventasModel("venta");
			foreach ($answer as $row => $venta) {//Ciclo para imprimir cada uno de los registros de la tabla
				echo '
				<tr>
					<td>'.$venta['numero'].'</td>
					<td>'.$venta['fecha'].'</td>
					<td>'.$venta['total'].'</td>
					<td><a href="index.php?action=ventas&numero='.$venta['numero'].'" class="btn btn-danger">Eliminar</a></td>
				</tr>
				';
			}
		}

		public static function eliminarVentaController(){
			if(isset($_GET["numero"])){
				$answer = Data::eliminarVentaModel($_GET["numero"],"venta");

			}
		}

		public static function quitarDeVenta(){
			if(!isset($_GET["indice"])) return;
				$indice = $_GET["indice"];
				session_start();
				array_splice($_SESSION["carrito"], $indice,1);
				echo "<script>
					window.location = 'index.php?action=vender&status=3';
				</script>";
		}

		public static function terminarVentaController(){
			if(!isset($_POST["total"])){
				exit;
			}else{
			
				$total = $_POST["total"];
				$data = array( "fecha"=>date("Y-m-d"), "total"=>$total);
				$venta = Data::terminarVentaModel($data,"venta");
			
				$idVenta = $venta === false ? 1 : $venta->id;

				foreach ($_SESSION['carrito'] as $producto) {
					$idProd = $producto->id_producto;
					$cantidad = $producto->cantidad;
					$data = array("id_producto"=>$idProd,"numero_venta"=>$idVenta,"cantidad"=>$cantidad);
					$tVenta1 = Data::terminarVentaModel2($data);
				}
				unset($_SESSION["carrito"]);
				$_SESSION["carrito"] = [];
				echo "<script>
					window.location='index.php?action=vender&status=1';
				</script>";	
			}

		}
	}
?>