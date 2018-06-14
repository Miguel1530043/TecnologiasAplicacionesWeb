
<?php
	require_once "connection.php";

	class Data extends Connection{
		//Funcion utilizada para verificar los datos del usuario y permiitir el login.
		public static function loginModel($data, $table){
			$statement = Connection::connect() -> prepare("SELECT * FROM $table WHERE username = :username and password = :password");
			$statement -> bindParam(":username",$data['username'],PDO::PARAM_STR);
			$statement -> bindParam(":password",$data['password'],PDO::PARAM_STR);
			$statement -> execute();
			return $statement -> fetch();
			$statement -> close();
		}


		//Metodo para ver extraer los productos de la base de datos
		public static function productsViewModel($table){
			$statement = Connection::connect()->prepare("SELECT * FROM $table");
			$statement->execute();
			return $statement->fetchAll();
			$statement->close();
		}

		//Meotodo que hara las inserciones en la base de datos para agregar los productos
		public static function addProductModel($data, $table){
			$statement = Connection::connect() -> prepare("INSERT INTO producto (id_producto,codigo,descripcion,precio_venta,precio_compra,existencia) VALUES (NULL,:codigo,:descripcion,:precio_venta,:precio_compra,:existencia)");
			$statement->bindParam(":codigo",$data['codigo'],PDO::PARAM_INT);
			$statement->bindParam(":descripcion",$data['descripcion'],PDO::PARAM_STR);
			$statement->bindParam(":precio_venta",$data['precio_venta'],PDO::PARAM_INT);
			$statement->bindParam(":precio_compra",$data['precio_compra'],PDO::PARAM_INT);
			$statement->bindParam(":existencia",$data['existencia'],PDO::PARAM_INT);
			if($statement->execute()){
				return "success";
			}else{
				return "fail";
			}
			$statement->close();
		}

		//Metodo para mandar llamar los dato de la base de datos para editar el producto
		public static function editProductModel($data, $table){
			$statement = Connection::connect()->prepare("SELECT *  FROM $table WHERE id_producto = :id");
			$statement -> bindParam(":id",$data,PDO::PARAM_INT);
			$statement -> execute();
			return $statement -> fetch();
			$statement->close();
		}
		//Metodo para actualizar la base de datos
		public static function updateProductModel($data, $table){
			$statement = Connection::connect() -> prepare("UPDATE producto SET codigo=:codigo,descripcion=:descripcion,precio_venta=:precio_venta,precio_compra=:precio_compra,existencia=:existencia WHERE id_producto = :id_producto");
			$statement->bindParam(":id_producto",$data['id_producto'],PDO::PARAM_INT);
			$statement->bindParam(":codigo",$data['codigo'],PDO::PARAM_STR);
			$statement->bindParam(":descripcion",$data['descripcion'],PDO::PARAM_STR);
			$statement->bindParam(":precio_venta",$data['precio_venta'],PDO::PARAM_STR);
			$statement->bindParam(":precio_compra",$data['precio_compra'],PDO::PARAM_INT);
			$statement->bindParam(":existencia",$data['existencia'],PDO::PARAM_INT);
			if($statement->execute()){
				return "success";
			}else{
				return "fail";
			}
			$statement->close();

		} 
		//Metodo que realizara la eliminacion del producto junto con los registros de historial que se enceuntren del producto, validando que el usuario activo ingrese su contraseña para eliminar dicho producto
		public static function deleteProductModel($data,$table){
			$statement = Connection::connect()->prepare("DELETE FROM $table WHERE id_producto = :id_producto");
			$statement->bindParam(":id_producto",$data,PDO::PARAM_INT);
			if($statement->execute()){
				return "success";
			}else{
				return "fail";
			}
			$statement->close();
				
		}
		//Metodo para extraer las ventas de la base de datos
		public static function ventasModel($table){
			$statement = Connection::connect()->prepare("SELECT * FROM $table");
			$statement->execute();
			return $statement->fetchAll();
			$statement->close();
		}
		//Metodo para eliminar un venta
		public static function eliminarVentaModel($data,$table){

			$statement2= Connection::connect()->prepare("DELETE FROM venta_producto WHERE numero_venta = :numero");
			$statement2->bindParam(":numero",$data,PDO::PARAM_INT);
			$statement2->execute();

			$statement= Connection::connect()->prepare("DELETE FROM $table WHERE numero = :numero");
			$statement->bindParam(":numero",$data,PDO::PARAM_INT);
			$statement->execute();
			
		}
		//Metodo para agregar al carrito
		public static function agregarCarritoModel($data,$table){
			$statement =  Connection::connect()->prepare("SELECT * FROM $table WHERE codigo =:codigo LIMIT 1;");
			$statement->bindParam(":codigo",$data,PDO::PARAM_INT);
			$statement->execute();
			return $statement->fetch(PDO::FETCH_OBJ);
			$statement->close();

		}

		//Metodo para terminar la venta
		public static function terminarVentaModel($data,$table){
			$statement = Connection::connect()->prepare("INSERT INTO venta (fecha,total) VALUES (:fecha,:total)");
			$statement->bindParam(":fecha",$data['fecha']);
			$statement->bindParam(":total",$data['total']);
			$statement->execute();


			$statement2 = Connection::connect()->prepare("SELECT id FROM venta ORDER BY id DESC LIMIT 1");
			$statement2->execute();
			return $statement2->fetch(PDO::FETCH_OBJ);
		}

		//Metodo para seguir con el terminoo de la venta
		public static function terminarVentaModel2($data){
			$statement = Connection::connect()->prepare("INSERT INTO venta_producto (numero_venta,id_producto,cantidad) VALUES (:numero_venta, :id_producto, :cantidad)");
			$statement->bindParam(":numero_venta",$data["numero_venta"],PDO::PARAM_INT);
			$statement->bindParam(":id_producto",$data["id_producto"],PDO::PARAM_INT);
			$statement->bindParam(":cantidad",$data["cantidad"],PDO::PARAM_INT);
			$statement->execute();

			$statement2 = Connection::connect()->prepare("UPDATE productos SET existencia = existencia - :cantidad WHERE id = :id_producto;");
			$statement2->bindParam(":cantidad",$data["cantidad"],PDO::PARAM_INT);
			$statement2->bindParam(":id_producto",$data["id_producto"],PDO::PARAM_INT);
			$statement2->execute();

		}

	}
?>