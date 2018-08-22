<?php
	require_once "connection.php";
	class Data extends Connection{
		

		//Metodoo que muestra todos los grupos, para ser vistos por medio de un select
		public static function selectCategoriasModel($table){
			$statement = Connection::connect()->prepare("SELECT * FROM $table");
			$statement->execute();
			return $statement->fetchAll();
			$statement->close();
		}

		//Metodo para mostrar la informacion de todos los grupos de la academiA
		public static function selectDepartamentosModel($table){
			$statement = Connection::connect()->prepare("SELECT * FROM $table");
			$statement->execute();
			return $statement->fetchAll();
			$statement->close();
		}

		###################################################################################################################################3
		########################################################## ARTICULOS ###############################################################3
		#####################################################################################################################################

		//Metodo que contendra toda la informacion de todos los teachers
		public static function showProductsModel($table){
			$statement = Connection::connect()->prepare("SELECT * from $table");
			$statement->execute();
			return $statement->fetchAll(); 
			$statement->close();
		}
		
		//Metodo que realizara el agregado hacia la base de datos de un teacher, recibiendo todos los datos requeridos para realizar las insercion en la base de datos, mediante el uso de bindParam, para hacer que los datos sean mas seguros.
		public static function addProductModel($data,$table){
			$statement = Connection::connect()->prepare("INSERT INTO $table(clave, clave_alterna, descripcion, servicio, categoria, departamento, unidad_compra,  unidad_venta, factor, iva, precio_compra, precio_compra_iva, precio_compra_promedio, precio_compra_iva_promedio, precio1, precio2, precio3, precio4, precio_venta1, precio_venta2, precio_venta3, precio_venta4, unidades_mayoreo1,  unidades_mayoreo2, unidades_mayoreo3, unidades_mayoreo4, imagen,proveedor) VALUES (:clave, :clave_alterna, :descripcion, :servicio, :categoria, :departamento, :unidad_compra, :unidad_venta, :factor, :iva, :precio_compra, :precio_compra_iva, :precio_compra_promedio, :precio_compra_iva_promedio, :precio1, :precio2, :precio3, :precio4, :precio_venta1, :precio_venta2, :precio_venta3, :precio_venta4, :unidades_mayoreo1, :unidades_mayoreo2, :unidades_mayoreo3, :unidades_mayoreo4, :imagen)");

			$statement ->bindParam(":clave",$data["clave"]);
			$statement ->bindParam(":clave_alterna",$data["clave_alterna"]);
			$statement ->bindParam(":descripcion",$data["descripcion"]);
			$statement ->bindParam(":servicio",$data["servicio"]);
			$statement ->bindParam(":categoria",$data["categoria"]);
			$statement ->bindParam(":departamento",$data["departamento"]);
			$statement ->bindParam(":unidad_compra",$data["unidad_compra"]);
			$statement ->bindParam(":unidad_venta",$data["unidad_venta"]);
			$statement ->bindParam(":factor",$data["factor"]);
			$statement ->bindParam(":iva",$data["iva"]);
			$statement ->bindParam(":precio_compra",$data["precio_compra"]);
			$statement ->bindParam(":precio_compra_iva",$data["precio_compra_iva"]);
			$statement ->bindParam(":precio_compra_promedio",$data["precio_compra_promedio"]);
			$statement ->bindParam(":precio_compra_iva_promedio",$data["precio_compra_iva_promedio"]);
			$statement ->bindParam(":precio1",$data["precio1"]);
			$statement ->bindParam(":precio2",$data["precio2"]);
			$statement ->bindParam(":precio3",$data["precio3"]);
			$statement ->bindParam(":precio4",$data["precio4"]);
			$statement ->bindParam(":precio_venta1",$data["precio_venta1"]);
			$statement ->bindParam(":precio_venta2",$data["precio_venta2"]);
			$statement ->bindParam(":precio_venta3",$data["precio_venta3"]);
			$statement ->bindParam(":precio_venta4",$data["precio_venta4"]);
			$statement ->bindParam(":unidades_mayoreo1",$data["unidades_mayoreo1"]);
			$statement ->bindParam(":unidades_mayoreo2",$data["unidades_mayoreo2"]);
			$statement ->bindParam(":unidades_mayoreo3",$data["unidades_mayoreo3"]);
			$statement ->bindParam(":unidades_mayoreo4",$data["unidades_mayoreo4"]);
			$statement ->bindParam(":imagen",$data["imagen"]);
			

			if($statement->execute()){
				return "success";
			}else{
				return "fail";
			}	
		}

		//Metodo para realizar el borrado de la informacion de un teacher en la base de datos, dependiendo de su identificador el cual es su numero de empleado
		public static function deleteProductModel($data,$table){
			$statement = Connection::connect()->prepare("DELETE FROM $table WHERE id_articulo = :id_articulo");
			$statement->bindParam(":id_articulo",$data);
			if($statement->execute()){
				return "success";
			}else{
				return "fail";
			}
		}

		//Metodo que realizara la edicion de la informacion de un teacher dependiendo de su numero de empleado, el cual es su identificador en la base de datos
		public static function editProductModel($data,$table){
			$statement = Connection::connect()->prepare("SELECT * FROM $table WHERE id_articulo = :id_articulo");
			$statement->bindParam(":id_articulo",$data);
			$statement->execute();
			return $statement->fetch();
			$statement->close();
		}

		//Metodo que realizara la acutalizacion de un teacher tomando los valores correspondientes a cada parte de los campos en la base de datos.
		public static function updateProductModel($data,$table){
			$statement = Connection::connect()->prepare("UPDATE $table SET clave = :clave, clave_alterna = :clave_alterna, descripcion = :descripcion, servicio = :servicio, categoria = :categoria, departamento = :departamento, unidad_compra = :unidad_compra, unidad_venta = :unidad_venta, factor = :factor, iva = :iva, precio_compra = :precio_compra, precio_compra_iva = :precio_compra_iva, precio_compra_promedio = :precio_compra_promedio, precio_compra_iva_promedio = :precio_compra_iva_promedio, precio1 = :precio1, precio2 = :precio2, precio3 = :precio3, precio4 = :precio4, precio_venta1 = :precio_venta1, precio_venta2 = :precio_venta2, precio_venta3 = :precio_venta3, precio_venta4 = :precio_venta4, unidades_mayoreo1 = :unidades_mayoreo1, unidades_mayoreo2 = :unidades_mayoreo2, unidades_mayoreo3 = :unidades_mayoreo3, unidades_mayoreo4 = :unidades_mayoreo4, imagen = :imagen WHERE id_articulo = :id_articulo");

			$statement ->bindParam(":id_articulo",$data["id_articulo"]);
			$statement ->bindParam(":clave",$data["clave"]);
			$statement ->bindParam(":clave_alterna",$data["clave_alterna"]);
			$statement ->bindParam(":descripcion",$data["descripcion"]);
			$statement ->bindParam(":servicio",$data["servicio"]);
			$statement ->bindParam(":categoria",$data["categoria"]);
			$statement ->bindParam(":departamento",$data["departamento"]);
			$statement ->bindParam(":unidad_compra",$data["unidad_compra"]);
			$statement ->bindParam(":unidad_venta",$data["unidad_venta"]);
			$statement ->bindParam(":factor",$data["factor"]);
			$statement ->bindParam(":iva",$data["iva"]);
			$statement ->bindParam(":precio_compra",$data["precio_compra"]);
			$statement ->bindParam(":precio_compra_iva",$data["precio_compra_iva"]);
			$statement ->bindParam(":precio_compra_promedio",$data["precio_compra_promedio"]);
			$statement ->bindParam(":precio_compra_iva_promedio",$data["precio_compra_iva_promedio"]);
			$statement ->bindParam(":precio1",$data["precio1"]);
			$statement ->bindParam(":precio2",$data["precio2"]);
			$statement ->bindParam(":precio3",$data["precio3"]);
			$statement ->bindParam(":precio4",$data["precio4"]);
			$statement ->bindParam(":precio_venta1",$data["precio_venta1"]);
			$statement ->bindParam(":precio_venta2",$data["precio_venta2"]);
			$statement ->bindParam(":precio_venta3",$data["precio_venta3"]);
			$statement ->bindParam(":precio_venta4",$data["precio_venta4"]);
			$statement ->bindParam(":unidades_mayoreo1",$data["unidades_mayoreo1"]);
			$statement ->bindParam(":unidades_mayoreo2",$data["unidades_mayoreo2"]);
			$statement ->bindParam(":unidades_mayoreo3",$data["unidades_mayoreo3"]);
			$statement ->bindParam(":unidades_mayoreo4",$data["unidades_mayoreo4"]);
			$statement ->bindParam(":imagen",$data["imagen"]);
			if($statement->execute()){
				return "success";
			}else{
				return "fail";
			}
		}

		//Metodo que se realizara al termino de una hora de cai, recibiendo la hora de entrada, hora de salida, la fecha, actividade realizada, matricula del alumno y la unidad a la cual se esta realizando la sesion de cai.
		public static function finishHourModel($data,$table,$table2){
			$statement = Connection::connect()->prepare("INSERT INTO $table(hora_entrada,hora_salida,fecha) VALUES (:hora_entrada,:hora_salida,:fecha)");
			$statement->bindParam(":hora_entrada",$data["hora_entrada"]);
			$statement->bindParam(":hora_salida",$data["hora_salida"]);
			$statement->bindParam(":fecha",$data["fecha"]);
			$statement->execute();
			$statement->fetchAll();

			$statement2 = Connection::connect()->prepare("INSERT INTO $table2(id_hora,matricula,actividad,unidad) VALUES (:id_hora,:matricula,:actividad,:unidad)");
			$statement2->bindParam(":id_hora",$data["id_hora"]);
			$statement2->bindParam(":matricula",$data["matricula"]);
			$statement2->bindParam(":actividad",$data["actividad"]);
			$statement2->bindParam(":unidad",$data["unidad"]);
			$statement2->execute();
		}

		//Metodo que muestra las unidades que existen
		public static function showUnitsModel($table){
			$statement = Connection::connect()->prepare("SELECT * FROM $table");
			$statement->execute();
			return $statement->fetchAll();
			$statement->close();
		}	
		
    	####################################################################################################################################
    	##################################################### INVENTARIO ###################################################################
    	####################################################################################################################################

    	public static function operacionesInventarioModel($data,$table){
			$statement = Connection::connect()->prepare("INSERT INTO $table (id_articulo, nombre_articulo, fecha, comentario, referencia, cantidad) VALUES (:id_articulo, :nombre_articulo, :fecha, :comentario, :referencia, :cantidad)");

			$statement->bindParam(":id_articulo",$data["id_articulo"],PDO::PARAM_INT);
			$statement->bindParam(":nombre_articulo",$data["nombre_articulo"],PDO::PARAM_STR);
			$statement->bindParam(":fecha",$data["fecha"],PDO::PARAM_STR);
			$statement->bindParam(":comentario",$data["comentario"],PDO::PARAM_STR);
			$statement->bindParam(":referencia",$data["referencia"],PDO::PARAM_STR);
			$statement->bindParam(":cantidad",$data["cantidad"],PDO::PARAM_INT);
			if($statement->execute()){
				return "success";
			}else{
				return "fail";
			}
			$statement->close();

		
		
		}
		//Funcion que actualizara el stock del producto dependeindo del movimiento de inventario que se haya realizado
		public static function addStockModel($data,$table){
			$statement = Connection::connect()->prepare("UPDATE $table SET unidades_mayoreo1=:unidades_mayoreo1 WHERE id_articulo = :id_articulo");
			$statement->bindParam(":id_articulo",$data["id_articulo"],PDO::PARAM_INT);
			$statement->bindParam(":unidades_mayoreo1",$data["cantidad"],PDO::PARAM_INT);
			if($statement->execute()){
				return "success";
			}
			//$statement->close();
		}
		public static function showProductoInventarioModel($data,$table){
			$statement = Connection::connect()->prepare("SELECT * FROM $table WHERE id_articulo = :id_articulo");
			$statement->bindParam(":id_articulo",$data,PDO::PARAM_INT);
			$statement->execute();
			return $statement->fetchAll();
			$statement->close();
		}
		###############################################################################################################################33
		##################################################3 VENTAS #####################################################################
		################################################################################################################################3
		public static function insertarVentaModel($data,$table){
			$statement = Connection::connect()->prepare("INSERT INTO $table (fecha, total) VALUES (:fecha, :total)");
			$statement->bindParam(":fecha",$data["fecha"],PDO::PARAM_STR);
			$statement->bindParam(":total",$data["total"],PDO::PARAM_STR);
			$statement->execute();

			$statement2 = Connection::connect()->prepare("SELECT id FROM $table WHERE id = (SELECT MAX(id) from $table)");
			$statement2->execute();
			return $statement2->fetch();

		}	
    	public function terminarVentaModel($data,$table){
			$stmt= Connection::connect()->prepare("INSERT INTO $table (id_venta, id_articulo, clave, nombre_articulo, cantidad, precio)VALUES(:id_venta, :id_articulo, :clave, :nombre_articulo, :cantidad, :precio)");
			$stmt->bindParam(":id_venta",$data["id_venta"],PDO::PARAM_INT);
			$stmt->bindParam(":id_articulo",$data["id_articulo"],PDO::PARAM_INT);
			$stmt->bindParam(":clave",$data["clave"],PDO::PARAM_INT);
			$stmt->bindParam(":nombre_articulo",$data["nombre_articulo"],PDO::PARAM_STR);
			$stmt->bindParam(":cantidad",$data["cantidad"],PDO::PARAM_INT);
			$stmt->bindParam(":precio",$data["precio"],PDO::PARAM_INT);
			$stmt->execute();
		}

		public static function verVentasModel($table){
			$statement = Connection::connect()->prepare("SELECT * FROM $table");
			$statement->execute();
			return $statement->fetchAll();
			$statement->close();
		}

		public static function verDetalleVentaModel($data,$table){
			$statement =  Connection::connect()->prepare("SELECT * FROM $table WHERE id_venta = :id");
			$statement->bindParam(":id",$data,PDO::PARAM_INT);
			$statement->execute();
			return $statement->fetchAll();
		}

		public static function actualizarCantidadModel($data,$table){
			$statement = Connection::connect()->prepare("UPDATE $table SET unidades_mayoreo1=unidades_mayoreo1-:cantidad WHERE id_articulo = :id_articulo");
			$statement->bindParam(":cantidad",$data["cantidad"],PDO::PARAM_INT);
			$statement->bindParam(":id_articulo",$data["id_articulo"],PDO::PARAM_INT);
			$statement->execute();

		}
		public function terminarCompraModel($data,$table){
			$stmt= Connection::connect()->prepare("INSERT INTO $table (id_compra, id_articulo, clave, nombre_articulo, cantidad, precio)VALUES(:id_compra, :id_articulo, :clave, :nombre_articulo, :cantidad, :precio)");
			$stmt->bindParam(":id_compra",$data["id_compra"],PDO::PARAM_INT);
			$stmt->bindParam(":id_articulo",$data["id_articulo"],PDO::PARAM_INT);
			$stmt->bindParam(":clave",$data["clave"],PDO::PARAM_INT);
			$stmt->bindParam(":nombre_articulo",$data["nombre_articulo"],PDO::PARAM_STR);
			$stmt->bindParam(":cantidad",$data["cantidad"],PDO::PARAM_INT);
			$stmt->bindParam(":precio",$data["precio"],PDO::PARAM_INT);
			$stmt->execute();

		}
	}

?>