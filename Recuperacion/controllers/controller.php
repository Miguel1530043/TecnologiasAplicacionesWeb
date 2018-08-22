<?php
	class MvcController{

		//Controlador para incluir el template en el index y mostrarlo en todas las paginas
		public static function page(){
      session_start();
			include "views/template.php";
		}

		//Controlador que llevara a cabo el mandejo de las direcciones de las paginas mediante acciones
		public static function linkPageController(){
			if(isset($_GET["action"])){
				$link = $_GET["action"];
			}else{
				$link = "index";
			}
			$answer = Pages::linkPageModel($link);
			include $answer;
		}

		###############################################################################################################################
		############################################################ ARTICULOS ########################################################
		###############################################################################################################################
		
		//Metodo para mostrar los articulos registrados
		public static function showProductsController(){
			$answer = Data::showProductsModel("articulos");//Utilizacion del modelo para poder tomar todos los datos de todos los articulos
			

			foreach ($answer as $row => $product) {//Ciclo el cual mediante cada articulo que se encuentre en la base de datos mostrara parte de su informacion
				
				//Impresion de los datos en una tabla, mostrando solo algunos de sus datos relevantes
				echo'
					<tr>
						<td>'.$product['clave'].'</td>
						<td>'.$product['descripcion'].'</td>
						<td>'.$product['unidades_mayoreo1'].'</td>
						<td>$'.$product['precio_venta1'].'</td>';

						//Se condiciona si el articulo no cuenta con una imagen, entonces se le asignara un icono en representacion de imagen	
						if($product["imagen"]=="views/img/" || $product["imagen"]==""){
							echo'<td><button class="btn" disabled><i class="material-icons">image</i></button></td>';
						}else{
							//Sino, se mostrara su imagen
							echo'<td><img class="materialboxed" src="'.$product['imagen'].'" style="height:50px;width:50px"></td>';
						}
						//Se asignan 2 botos, el boton de ediatar que mediante id del articulo mandara llamara un modal el cual se encuentra en la funcion "editProductController" y el boton de eliminar el cual mandara a llamar otro modal mediante el id del atriculo.
					echo '<td><a class="btn-floating btn-large waves-effect waves-light cyan darken-3 btn modal-trigger" href="#'.$product["id_articulo"].'"><i class="material-icons">edit</i></a></td>
						<td><a class="btn-floating btn-large waves-effect waves-light red darken-4 btn modal-trigger" href="#delete'.$product["id_articulo"].'"><i class="material-icons" >delete</i></a></td>
					</tr>';


					//Modal que realizara la eliminacion del producto, este es llamado por el boton de eliminar. Si se preciona el boton "No" del modal, se cerrara la venta y no se realizara ninguna accion, si se presiona el boton de "Si" entonces se procedera a ir al link donde se encuentra el controlador de eliminacion de producto, mediante paso de variable pro URL se transfiere el id del articulo.
					echo'
					<div id="delete'.$product["id_articulo"].'" class="modal modal-fixed-footer" style="height:270px" align="center">
						<div class="modal-content">
							<h4>¿Seguro que desea eliminar este articulo?</h4><br>
							<button class="waves-effect waves-light red darken-4 btn-large modal-close">No</button>
							<a class="waves-effect waves-light blue darken-4 btn-large" href="index.php?action=eliminar_articulo&id_articulo='.$product["id_articulo"].'">Si</a>
						</div>

					</div>
				';
			}
			echo "</tbody>
				</table>";
			//Ciclo para asignar un modal de edicion a cada uno de los articulos mediante su id.
			foreach ($answer as $row => $product) {
				MvcController::editProductController($product["id_articulo"]);
			}
		}

		//Metodo para realizar la agregación de articulos
		public static function addProductController(){
			
			if(isset($_POST["add"])){//SI se realizo el metodo post y el boton de nombre Add, fue clickeado o posteado se realizara la aregacion de producto
					
					$target_dir = "views/img/";//Variable que se le asignara la ruta donde se guardaran las imagenes de los productos

					$target_file = $target_dir . basename($_FILES["imagen"]["name"]);//Variable que combina la direccion de guardado de imagenes junto con el nombre de la imagen seleccionaada
					
					$uploadOk = 1;
					// Check if file already exists

	    			if (move_uploaded_file($_FILES["imagen"]["tmp_name"], $target_file)) {//Se realiza la copia de la imagen hacia la copia, si esta se realiza con exito la imagen sera guardada
	    				$ruta = basename($_FILES["imagen"]["name"]);
	    			}

	    			$iva=$_POST["precio_compra"];//Varible que se le asigna el precio de comprra

	    			$ivaPromedio=$_POST["precio_compra_promedio"];//Variable que se le asigna el precio de compra promedio
	    			
	    			if(isset($_POST["iva"])){//Se condiciona si se envio o se posteo el campo de nombre "iva"

	    				if($_POST["iva"]==1){//Se condiciona si su valor es igual a 1

	    					$iva = $_POST["precio_compra"]+($_POST["precio_compra"]*.16);//Se le asigna precio de compra mas iva
	    					$ivaPromedio = $_POST["precio_compra_promedio"]+($_POST["precio_compra_promedio"]*.16);//Se asigna precio de compra promedio mas iva
	    				}
	    			}

	    		//Arreglo contenedor de todos los datos del formulario de agregado de articulos
				$data = array("clave"=>$_POST["clave"],"clave_alterna"=>$_POST["clave_alterna"], "descripcion"=>$_POST["descripcion"],"servicio"=>$_POST["servicio"],"categoria"=>$_POST["categoria"],"departamento"=>$_POST["departamento"] , "unidad_compra"=>$_POST["unidad_compra"],"unidad_venta"=>$_POST["unidad_venta"],"factor"=>$_POST["factor"],"iva"=>$_POST["iva"],"precio_compra"=>$_POST["precio_compra"],"precio_compra_iva"=>$iva,"precio_compra_promedio"=>$_POST["precio_compra_promedio"],"precio_compra_iva_promedio"=>$ivaPromedio,"precio1"=>$_POST["precio1"],"precio2"=>$_POST["precio2"],"precio3"=>$_POST["precio3"],"precio4"=>$_POST["precio4"],"precio_venta1"=>$_POST["precio_venta1"],"precio_venta2"=>$_POST["precio_venta2"],"precio_venta3"=>$_POST["precio_venta3"],"precio_venta4"=>$_POST["precio_venta4"],"unidades_mayoreo1"=>$_POST["unidades_mayoreo1"],"unidades_mayoreo2"=>$_POST["unidades_mayoreo2"],"unidades_mayoreo3"=>$_POST["unidades_mayoreo3"],"unidades_mayoreo4"=>$_POST["unidades_mayoreo4"],"imagen"=>$target_file,"proveedor"=>$_POST["proveedor"]);
				
				$answer = Data::addProductModel($data,"articulos");//Se mandara el arreglo de datos hacia el modelo para realizar la insercion en la base de datos, junto con la tabla a la cual se desea realizar dicha insercion.

				
				if($answer=="success"){//Si el modelo retorna "success", se determina que la insercion fue realizada con exito y se redirecciona hacia la pagina de los articulos
					echo "<script>
						window.location='index.php?action=articulos';
					</script>";

				}else{//Sino, mostrara un error ya que no se realizo con exito la insercion.
					echo "Error al registrar";
				}
			}
		}


		
		//Metodo para realizar la elimincacion de articulos
		public static function deleteProductController(){
			$data = $_GET["id_articulo"];//Se recibe mediante el metodo GET (metodo que recibe variables por URL) el id del articulo a eliminar
			
			$answer= Data::deleteProductModel($data,"articulos");//Se manda el id del articulo al modal junto con la tabla de la cual se quiere eliminar el registro
			if($answer == "success"){//Si retonra "success" la eliminacion se realizo con exito
				echo "<script>
					window.location='index.php?action=articulos';
				</script>";
			}else{//Sino, sucedio algun error.
				echo "Error al Eliminar";
			}
		}

		//Metodo para hacer el llamdado al modal de edicion de productos para cada unos de los articulos mediante su id, y mostrar su informacion completa
		public static function editProductController($data){
			$answer = Data::editProductModel($data,"articulos");//Se id del artiuclo,  el cual se  recibe del controlador "showProductsController",
			
			//Se imprime un formulario con toda la infomacion del articulo
			echo'
			<form method="post" enctype="multipart/form-data">
				<div id="'.$answer["id_articulo"].'" class="modal modal-fixed-footer">
					<div class="modal-content">
					<nav class="cyan darken-3">
						<ul >
							<input type="hidden" name="id_articulo" value="'.$answer["id_articulo"].'" required>
							<li><h4>Informacion del Artiuclo</h4></li>
						</ul>
					</nav>
					<div class="row">
		                <div class="input-field col s4">
                    		<input type="text" name="clave" value="'.$answer["clave"].'" required>
                    		<label for="clave">Clave</label>    
                		</div>
                		<div class="input-field col s4">
                    		<input type="text" name="clave_alterna" value="'.$answer["clave_alterna"].'" required>
                    		<label for="clave_alterna">Clave Alterna</label>    
                		</div>
                		<div class="input-field col s4">
                        <select name="servicio">
                            <option>'.$answer["servicio"].'</option>
                            <option value="1">Si</option>
                            <option value="0">No</option>
                        </select>
                    </div>
						<div class="input-field col s12">
							<input type="text" name="descripcion" value="'.$answer["descripcion"].'">
							<label for="descripcion">Descripcion</label>
						</div>
						<div class="input-field col s3">
							<select name="categoria">
							<option value="'.$answer["categoria"].'">'.$answer["categoria"].'</option>';

							MvcController::selectCategoriaController();
							echo'
							</select>
						</div>
						<div class="input-field col s3">
							<select name="departamento">
							<option value="'.$answer["departamento"].'">'.$answer["departamento"].'</option>';

							MvcController::selectDepartamentoController();
							echo'
							</select>
						</div>
						<div class="input-field col s2">
							<input type="text" name="unidad_compra" value="'.$answer["unidad_compra"].'">
							<label for="unidad_compra">Unidad Compra</label>
						</div>
						<div class="input-field col s2">
							<input type="text" name="unidad_venta" value="'.$answer["unidad_venta"].'">
							<label for="unidad_venta">Unidad Venta</label>
						</div>
						<div class="input-field col s2">
							<input type="text" name="factor" value="'.$answer["factor"].'">
							<label for="factor">Factor</label>
						</div>
						<div class="input-field col s4">
                        <select name="iva">
                            <option>'.$answer["iva"].'</option>
                            <option value="1">Si</option>
                            <option value="0">No</option>
                        </select>
                    </div>
						<div class="input-field col s4">
							<input type="text" name="precio_compra" value="'.$answer["precio_compra"].'">
							<label for="precio_compra">Precio de Compra</label>
						</div>
						<div class="input-field col s4">
							<input type="text" name="precio_compra_promedio" value="'.$answer["precio_compra_promedio"].'">
							<label for="precio_compra_promedio">Precio de Compra Promedio</label>
						</div>
						<div class="input-field col s3">
							<input type="text" name="precio1" value="'.$answer["precio1"].'">
							<label for="precio1">Precio 1</label>
						</div>
						<div class="input-field col s3">
							<input type="text" name="precio2" value="'.$answer["precio2"].'">
							<label for="precio2">Precio 2</label>
						</div>
						<div class="input-field col s3">
							<input type="text" name="precio3" value="'.$answer["precio3"].'">
							<label for="precio3">Precio 3</label>
						</div>
						<div class="input-field col s3">
							<input type="text" name="precio4" value="'.$answer["precio4"].'">
							<label for="precio4">Precio 4</label>
						</div>
						<div class="input-field col s3">
							<input type="text" name="precio_venta1" value="'.$answer["precio_venta1"].'">
							<label for="precio_venta1">Precio Venta 1</label>
						</div>
						<div class="input-field col s3">
							<input type="text" name="precio_venta2" value="'.$answer["precio_venta2"].'">
							<label for="precio_venta2">Precio Venta 2</label>
						</div>
						<div class="input-field col s3">
							<input type="text" name="precio_venta3" value="'.$answer["precio_venta3"].'">
							<label for="precio_venta3">Precio Venta3</label>
						</div>
						<div class="input-field col s3">
							<input type="text" name="precio_venta4" value="'.$answer["precio_venta4"].'">
							<label for="precio_venta4">Precio Venta 4</label>
						</div>
						<div class="input-field col s3">
							<input type="text" name="unidades_mayoreo1" value="'.$answer["unidades_mayoreo1"].'">
							<label for="unidades_mayoreo1">U. Mayoreo 1</label>
						</div>
						<div class="input-field col s3">
							<input type="text" name="unidades_mayoreo2" value="'.$answer["unidades_mayoreo2"].'">
							<label for="unidades_mayoreo2">U. Mayoreo 2</label>
						</div>
						<div class="input-field col s3">
							<input type="text" name="unidades_mayoreo3" value="'.$answer["unidades_mayoreo3"].'">
							<label for="unidades_mayoreo3">U. Mayoreo 3</label>
						</div>
						<div class="input-field col s3">
							<input type="text" name="unidades_mayoreo4" value="'.$answer["unidades_mayoreo4"].'">
							<label for="unidades_mayoreo4">U. Mayoreo 4</label>
						</div>
						<div class="input-field col s4">
							<input type="file" name="imagen">
							<input type="hidden" name="imagenActual" value="'.$answer['imagen'].'">
						</div>
						<div class="col s5"><img src="'.$answer['imagen'].'"  style="width:150px;height:150px"></div>
							<div id="verImagenEdit" class="col s5" style="width: auto; height: auto;"></div>

						</div>
					</div>
					<div class="modal-footer">
						<button type="submit" class="waves-effect waves-light cyan darken-3 btn-small" name="update">Update Information</button>
					</div>
				</div>
			</form>
			';

		}

		//Metodo para actualizar la informacion de un articulo.
		public static function updateProductController(){

			if(isset($_POST["update"])){//Se condiciona si se posteo
				if($_FILES["imagen"]["name"]!=null){
					$target_dir = "views/img/";
					$target_file = $target_dir . basename($_FILES["imagen"]["name"]);
					$uploadOk = 1;
					// Check if file already exists
		    		if (move_uploaded_file($_FILES["imagen"]["tmp_name"], $target_file)) {
		    			$ruta = basename($_FILES["imagen"]["name"]);
		        		//echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
		    		}
		    	}else{
		    		$target_file = $_POST["imagenActual"];
		    	}
		    	$iva=$_POST["precio_compra"];
	    			$ivaPromedio=$_POST["precio_compra_promedio"];
	    			if(isset($_POST["iva"])){
	    				if($_POST["iva"]==1){
	    					$iva = $_POST["precio_compra"]+($_POST["precio_compra"]*.16);
	    					$ivaPromedio = $_POST["precio_compra_promedio"]+($_POST["precio_compra_promedio"]*.16);
	    				}
	    		}
	    	

				$data = array("id_articulo"=>$_POST["id_articulo"],"clave"=>$_POST["clave"],"clave_alterna"=>$_POST["clave_alterna"], "descripcion"=>$_POST["descripcion"],"servicio"=>$_POST["servicio"],"categoria"=>$_POST["categoria"],"departamento"=>$_POST["departamento"] , "unidad_compra"=>$_POST["unidad_compra"],"unidad_venta"=>$_POST["unidad_venta"],"factor"=>$_POST["factor"],"iva"=>$_POST["iva"],"precio_compra"=>$_POST["precio_compra"],"precio_compra_iva"=>$iva,"precio_compra_promedio"=>$_POST["precio_compra_promedio"],"precio_compra_iva_promedio"=>$ivaPromedio,"precio1"=>$_POST["precio1"],"precio2"=>$_POST["precio2"],"precio3"=>$_POST["precio3"],"precio4"=>$_POST["precio4"],"precio_venta1"=>$_POST["precio_venta1"],"precio_venta2"=>$_POST["precio_venta2"],"precio_venta3"=>$_POST["precio_venta3"],"precio_venta4"=>$_POST["precio_venta4"],"unidades_mayoreo1"=>$_POST["unidades_mayoreo1"],"unidades_mayoreo2"=>$_POST["unidades_mayoreo2"],"unidades_mayoreo3"=>$_POST["unidades_mayoreo3"],"unidades_mayoreo4"=>$_POST["unidades_mayoreo4"],"imagen"=>$target_file);
				
				$answer = Data::updateProductModel($data, "articulos");

				if($answer == "success"){
					echo "<script>
						window.location='index.php?action=articulos';
					</script>";
				}
				else{
					echo "Error al Actualizar";
				}
				var_dump($data);

			}

		}


		#########################################################################################################################
		################################################# SELECTORES ############################################################
		#########################################################################################################################

		//Metodo para poder visualizar el nombre de los grupos en un select y que en cada opcion el valor contenga el id del grupo
		public static function selectCategoriaController(){
			$answer = Data::selectCategoriasModel("categorias");
			foreach ($answer as $row => $categoria) {
				echo "<option value='$categoria[nombre_categoria]'>".$categoria['nombre_categoria']."</option>";
			}
		}			

		//Metodo para poder visualizar el nombre de los grupos en un select y que en cada opcion el valor contenga el id del grupo
		public static function selectDepartamentoController(){
			$answer = Data::selectDepartamentosModel("departamentos");
			foreach ($answer as $row => $departamento) {
				echo '<option value="'.$departamento['nombre_departamento'].'">'.$departamento['nombre_departamento'].'</option>';
			}
		}

		//Metodo para poder visualizar el nombre de las alumnas en un select y que en cada opcion el valor contenga el id de la alumna
		public static function selectProductosController(){
			$answer = Data::showProductsModel("articulos");
			foreach ($answer as $row => $product) {
				echo "<option value='$product[id_articulo]'>".$product["clave"]." - ".$product['descripcion']."</option>"; 
			}
		}



		

		########################################################################################################################################
		###########3##################################################### COMPRA ############################################################### 
		########################################################################################################################################
		//Metodo para ir agregando articulos a la venta

		public static function agregarCompra(){

			if(isset($_POST["agregar"])){
				$cantidad = $_POST["cantidad"];
				$datosArticulo = Data::editProductModel($_POST["articulo"],"articulos");
				$arreglo = array("id_articulo"=>$datosArticulo["id_articulo"],"clave"=>$datosArticulo["clave"],"nombre_articulo"=>$datosArticulo["descripcion"],"cantidad"=>$cantidad,"precio"=>$datosArticulo["precio_venta1"]*$cantidad);
				if(isset($_SESSION["ventas"])){
					for ($i=0;$i<count($_SESSION["venta"]);$i++){
						if($_SESSION["venta"]["id_articulo"] == $arreglo["id_articulo"]){
							$_SESSION["venta"]["cantidad"]+= $arreglo["cantidad"];
							$_SESSION["venta"]["precio"]+= $arreglo["precio"];
						
						}else{
							$_SESSION["venta"][]=$arreglo;
						}
					}
				}else{
					$_SESSION["venta"][]=$arreglo;
				}
				
				
				
			}
		}
		//Metodo para ir mostrando lso productos de la venta
		public static function mostrarCompra(){
			$total=0;
			echo'
			<input type="button" name="" class="btn cyan" style="width:1115px" value="Lista de Venta">
			<table class="hover cell-border responsive" id="example">
				<thead>
					<tr align="center">
						<th>Id</th>
						<th>Clave</th>
						<th>Descripcion</th>
						<th>Cantidad</th>
						<th>Precio</th>
						
					</tr>
				</thead>
				<tbody>';
			foreach ($_SESSION["venta"] as $row => $articulo) {
				echo '<tr>
						<td>'.$articulo["id_articulo"].'</td>
						<td>'.$articulo["clave"].'</td>
						<td>'.$articulo["nombre_articulo"].'</td>
						<td>'.$articulo["cantidad"].'</td>
						<td>$'.$articulo["precio"].'</td>
					</tr>';
					$total=$total+$articulo["precio"];

			}
			echo'</tbody>
			</table>';
			echo "
				<input type='hidden' value='".$total."' name='total'>
				<H4>TOTAL DE COMPRA: $".$total."</H4>
				<input type='submit' name='terminar' class='btn' value='Terminar COMPRA'>";
		}
		//Metodo para cancelar venta
		public static function cancelarCompra(){
			if(isset($_POST["cancelar"])){
				session_destroy();//Se destruye la sesion de la venta
				$_SESSION["venta"]=[];//Se inciializa en limpio el arreglo de la venta
			}
		}

		//Metodo apra terminar la venta
		public static function terminarCompra(){
			
			if(isset($_POST["terminar"])){
				$datos = array("fecha"=>date("Y-m-d"),"total"=>$_POST["total"]);
		
				$venta = Data::insertarVentaModel($datos,"compras");

				foreach ($_SESSION["venta"] as $rrow => $articulo) {//Siempre que hayan registros se insertaran con las funciones correspondientes
						$datosCompra = array("id_compra"=>$venta[0],"id_articulo"=>$articulo["id_articulo"],"clave"=>$articulo["clave"],"nombre_articulo"=>$articulo["nombre_articulo"],"cantidad"=>$articulo["cantidad"],"precio"=>$articulo["precio"]);
						
						$venta_prod = Data::terminarCompraModel($datosCompra,"compras_articulo");
						$arreglo = array("id_articulo"=>$articulo["id_articulo"],"cantidad"=>$articulo["cantidad"]);
						$bajarStock = Data::actualizarCantidadModel($arreglo,"articulos");
						unset($_SESSION["venta"]);
						$_SESSION["venta"]=[];
				}

					

			}
		}

		//Metodo para visualizar las ventar
		public static function verCompras(){
			$answer = Data::verVentasModel("compras");
			foreach ($answer as $row => $ventas) {
				echo '
				<tr>
					<td>'.$ventas['id'].'</td>
					<td>'.$ventas['fecha'].'</td>
					<td>'.$ventas['total'].'</td>
					<td><a class="btn-floating btn-large waves-effect waves-light cyan darken-3 btn modal-trigger" href="index.php?action=detalles_venta&id='.$ventas["id"].'"><i class="material-icons">assignment</i></a></td>
				</tr>';

			}

		}
		//Metodo para ver detalles de la vente mediante el id
		public static function verDetalleCompra(){
			$id=$_GET["id"];
			$answer = Data::verDetalleVentaModel($id,"compras_articulo");
			foreach ($answer as $row => $venta) {
				echo '
				<tr>
					<td>'.$venta['id_venta'].'</td>
					<td>'.$venta['id_articulo'].'</td>
					<td>'.$venta['clave'].'</td>
					<td>'.$venta['nombre_articulo'].'</td>
					<td>'.$venta['cantidad'].'</td>
					<td>'.$venta['precio'].'</td>
				</tr>';

			}

		
		}

		########################################################################################################################################
		###########3##################################################### VENTA ################################################################
		########################################################################################################################################

		//Metodo para ir agregando articulos a la venta
		public static function agregarVenta(){

			if(isset($_POST["agregar"])){
				$cantidad = $_POST["cantidad"];
				$datosArticulo = Data::editProductModel($_POST["articulo"],"articulos");
				$arreglo = array("id_articulo"=>$datosArticulo["id_articulo"],"clave"=>$datosArticulo["clave"],"nombre_articulo"=>$datosArticulo["descripcion"],"cantidad"=>$cantidad,"precio"=>$datosArticulo["precio_venta1"]*$cantidad);
				if(isset($_SESSION["ventas"])){
					for ($i=0;$i<count($_SESSION["venta"]);$i++){
						if($_SESSION["venta"]["id_articulo"] == $arreglo["id_articulo"]){
							$_SESSION["venta"]["cantidad"]+= $arreglo["cantidad"];
							$_SESSION["venta"]["precio"]+= $arreglo["precio"];
						
						}else{
							$_SESSION["venta"][]=$arreglo;
						}
					}
				}else{
					$_SESSION["venta"][]=$arreglo;
				}
				
				
				
			}
		}
		//Metodo para ir mostrando lso productos de la venta
		public static function mostrarVenta(){
			$total=0;
			echo'
			<input type="button" name="" class="btn cyan" style="width:1115px" value="Lista de Venta">
			<table class="hover cell-border responsive" id="example">
				<thead>
					<tr align="center">
						<th>Id</th>
						<th>Clave</th>
						<th>Descripcion</th>
						<th>Cantidad</th>
						<th>Precio</th>
						
					</tr>
				</thead>
				<tbody>';
			foreach ($_SESSION["venta"] as $row => $articulo) {
				echo '<tr>
						<td>'.$articulo["id_articulo"].'</td>
						<td>'.$articulo["clave"].'</td>
						<td>'.$articulo["nombre_articulo"].'</td>
						<td>'.$articulo["cantidad"].'</td>
						<td>$'.$articulo["precio"].'</td>
					</tr>';
					$total=$total+$articulo["precio"];

			}
			echo'</tbody>
			</table>';
			echo "
				<input type='hidden' value='".$total."' name='total'>
				<H4>TOTAL DE VENTA: $".$total."</H4>
				<input type='submit' name='terminar' class='btn' value='Terminar Venta'>";
		}
		//Metodo para cancelar venta
		public static function cancelarVenta(){
			if(isset($_POST["cancelar"])){
				session_destroy();//Se destruye la sesion de la venta
				$_SESSION["venta"]=[];//Se inciializa en limpio el arreglo de la venta
			}
		}

		//Metodo apra terminar la venta
		public static function terminarVenta(){
			
			if(isset($_POST["terminar"])){
				$datos = array("fecha"=>date("Y-m-d"),"total"=>$_POST["total"]);
		
				$venta = Data::insertarVentaModel($datos,"ventas");

				foreach ($_SESSION["venta"] as $rrow => $articulo) {//Siempre que hayan registros se insertaran con las funciones correspondientes
						$datosCompra = array("id_venta"=>$venta[0],"id_articulo"=>$articulo["id_articulo"],"clave"=>$articulo["clave"],"nombre_articulo"=>$articulo["nombre_articulo"],"cantidad"=>$articulo["cantidad"],"precio"=>$articulo["precio"]);
												
						$venta_prod = Data::terminarVentaModel($datosCompra,"venta_articulo");
						$arreglo = array("id_articulo"=>$articulo["id_articulo"],"cantidad"=>$articulo["cantidad"]);
						$bajarStock = Data::actualizarCantidadModel($arreglo,"articulos");
						unset($_SESSION["venta"]);
						$_SESSION["venta"]=[];
				}

					

			}
		}

		//Metodo para visualizar las ventar
		public static function verVentas(){
			$answer = Data::verVentasModel("ventas");
			foreach ($answer as $row => $ventas) {
				echo '
				<tr>
					<td>'.$ventas['id'].'</td>
					<td>'.$ventas['fecha'].'</td>
					<td>'.$ventas['total'].'</td>
					<td><a class="btn-floating btn-large waves-effect waves-light cyan darken-3 btn modal-trigger" href="index.php?action=detalles_venta&id='.$ventas["id"].'"><i class="material-icons">assignment</i></a></td>
				</tr>';

			}

		}
		//Metodo para ver detalles de la vente mediante el id
		public static function verDetalleVenta(){
			$id=$_GET["id"];
			$answer = Data::verDetalleVentaModel($id,"venta_articulo");
			foreach ($answer as $row => $venta) {
				echo '
				<tr>
					<td>'.$venta['id_venta'].'</td>
					<td>'.$venta['id_articulo'].'</td>
					<td>'.$venta['clave'].'</td>
					<td>'.$venta['nombre_articulo'].'</td>
					<td>'.$venta['cantidad'].'</td>
					<td>'.$venta['precio'].'</td>
				</tr>';

			}

		
		}

		########################################################################################################################################
		###########3################################################# INVENTARIO ############################################################### 
		########################################################################################################################################
		//Metodo para mostrar los articulos
		public static function showProductosInventario(){
			$answer = Data::showProductsModel("articulos");
			foreach ($answer as $row => $product) {
				//Impresion de los datos en una tabla, mostrando solo algunos de sus datos relevantes
				echo'
					<tr>
						<td>'.$product['clave'].'</td>
						<td>'.$product['descripcion'].'</td>
						<td>'.$product['unidades_mayoreo1'].'</td>
						<td><a class="btn-floating btn-large waves-effect waves-light cyan darken-3 btn modal-trigger" href="index.php?action=detalles_inventario&id_articulo='.$product["id_articulo"].'"><i class="material-icons">assignment</i></a></td>';
			}	
		}
		//Meotodo para realizar el movimiento de inventario
		public static function inventarioController(){
			$id = $_GET["id_articulo"];
			$answer = Data::editProductModel($id,"articulos");
			echo '
				
				<div class="col s4">';

					if($answer["imagen"]=="views/img/"){
						echo '<i class="material-icons" style="font-size:300px">image</i>';
					}else{
						echo'<img src="'.$answer["imagen"].'" style="width:300px;height:300px">';
					
					}
				echo'
				</div>
				<div class="col s4">
					<input type="hidden" value="'.$answer["descripcion"].'" name="nombre_articulo">
					<h5>Clave</h5>
					<input type="text" disabled value="'.$answer["clave"].'"">
					<h5>Descripcion</h5>
					<input type="text" disabled value="'.$answer["descripcion"].'"">
					<h5>Unidades</h5>
					<input type="text" disabled value="'.$answer["unidades_mayoreo1"].'"">
				</div>'
			;
		}

		//Metodo para agregar un Inventario
		public static function operacionesInventarioController(){
			
			if(isset($_POST["addStock"])){ //Se condiciona Si se hizo uso del boton addStock

				//Se declara un arreglo que contendra los datos del producto, datos del usuario y los campos del formulario a llenar para realizar un movimiento
				$data = array("id_articulo"=>$_GET["id_articulo"],"nombre_articulo" => $_POST["nombre_articulo"], "fecha"=>date("Y-m-d"), "comentario"=>$_POST["comentario"],"referencia"=>$_POST["referencia"],"cantidad"=>$_POST["cantidad"]);
				
				//El arreglo se mandara como parametro del modelo para agregar al historial junto con el nombre de su respectiva tabla
				$answer = Data::operacionesInventarioModel($data,"inventario");
				
				//Se recibira el id del producto por url
				$id = $_GET['id_articulo'];

				//El id del producto sera mandado como parametro para mostrar los datos del producto al modelo y poder contar su stock
				$answer2 = Data::editProductModel($id,"articulos");
				
				//Se tomara la cantidad que se le ingreso al campo quantity y se le sumara el resultado del stock del producto
				$cant = $_POST['cantidad'] + $answer2['unidades_mayoreo1'];
				
				//Se declarara una array asociativo que contendra el id del producto y la variable que contiene la suma de las cantidades
				$stock = array("id_articulo"=>$_GET["id_articulo"],"cantidad"=>$cant);
				
				//El arrgelo se manda como parametro de del modelo que agregara al stock
				$addStock = Data::addStockModel($stock,"articulos");
				
			}else if(isset($_POST["removeStock"])){//Se condiciona si se hizo uso del boton removeStock

				//Se declara un arreglo que contendra los datos del producto, datos del usuario y los campos del formulario a llenar para realizar un movimiento
				$data = array("id_articulo"=>$_GET["id_articulo"],"nombre_articulo" => $_POST["nombre_articulo"], "fecha"=>date("Y-m-d"), "comentario"=>$_POST["comentario"],"referencia"=>$_POST["referencia"],"cantidad"=>$_POST["cantidad"]);

				//El arreglo se mandara como parametro del modelo para agregar al historial junto con el nombre de su respectiva tabla
				
				
				//Se recibira el id del producto por url
				$id = $_GET['id_articulo'];
				
				//El id del producto sera mandado como parametro para mostrar los datos del producto al modelo y poder contar su stock
				$answer2 = Data::editProductModel($id,"articulos");
				
				//Se tomara la cantidad de resultado del stock del producto y se le restara la cantidad ingresada
				$cant =  $answer2['unidades_mayoreo1'] - $_POST['cantidad'];
				
				//Se declarara una array asociativo que contendra el id del producto y la variable que contiene la suma de las cantidades
				$stock = array("id_articulo"=>$_GET["id_articulo"],"cantidad"=>$cant);

				if($cant<=0){
					echo "<script type='text/javascript'>
    						function link(){
						        M.toast({html: 'No existe suficiente producto'});
						    }
						    link();
						</script>";
					
				}else{
				//El arrgelo se manda como parametro de del modelo que agregara al stock
					$addStock = Data::addStockModel($stock,"articulos");
					$answer = Data::operacionesInventarioModel($data,"inventario");
				}
			}
		}

		//Metodo para mostrar los moviemientos de inventario que ha tenido un producto
		public static function showProductoInventarioController(){
			$id=$_GET["id_articulo"];
			$answer = Data::showProductoInventarioModel($id,"inventario");
			foreach ($answer as $row => $productHistory) {
				echo '
				<tr>
					<td>'.$productHistory['id'].'</td>
					<td>'.$productHistory['id_articulo'].'</td>
					<td>'.$productHistory['nombre_articulo'].'</td>
					<td>'.$productHistory['referencia'].'</td>
					<td>'.$productHistory['comentario'].'</td>
					<td>'.$productHistory['cantidad'].'</td>
					<td>'.$productHistory['fecha'].'</td>
				</tr>';

			}

		}

		
	}
?>
