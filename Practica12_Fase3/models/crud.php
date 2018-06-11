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

	//Metodo para imprimir la informacion del usuario logeado
	public static function userInfoModel($data,$table){
		$statement = Connection::connect()->prepare("SELECT * FROM user WHERE id = :id");
		$statement->bindParam(":id",$data,PDO::PARAM_INT);
		$statement->execute();
		return $statement->fetch();
		$statement->close();

	}
	############################################################################################################################
	###################################################### STORE MODEL #########################################################
	############################################################################################################################

	public static function storeViewsModel($table){
		$statement = Connection::connect()->prepare("SELECT * FROM $table");
		$statement->execute();
		return $statement->fetchAll();
		$statement->close();
	}
	public static function addStoreModel($data,$table){
		$statement =  Connection::connect()->prepare("INSERT INTO $table (store_name,store_description,store_address,status) VALUES (:store_name,:store_description,:store_address,:status)");
		$statement->bindParam(":store_name",$data["store_name"],PDO::PARAM_STR);
		$statement->bindParam(":store_description",$data["store_description"],PDO::PARAM_STR);
		$statement->bindParam(":store_address",$data["store_address"],PDO::PARAM_STR);
		$statement->bindParam(":status",$data["status"],PDO::PARAM_INT);
		if($statement->execute()){
			return "success";
		}else{
			return "fail";
		}
		$statement->close();

	}
	public static function editStoreModel($data, $table){
		$statement = Connection::connect()->prepare("SELECT *  FROM $table WHERE store_id = :store_id");
		$statement -> bindParam(":store_id",$data,PDO::PARAM_INT);
		$statement -> execute();
		return $statement -> fetch();
		$statement->close();
	}

	public static function updateStoreModel($data,$table){
		$statement =  Connection::connect()->prepare("UPDATE $table SET store_name = :store_name, store_description = :store_description, store_address = :store_address,status = :status WHERE store_id = :store_id");
		$statement->bindParam(":store_id",$data["store_id"],PDO::PARAM_INT);
		$statement->bindParam(":store_name",$data["store_name"],PDO::PARAM_STR);
		$statement->bindParam(":store_description",$data["store_description"],PDO::PARAM_STR);
		$statement->bindParam(":store_address",$data["store_address"],PDO::PARAM_STR);
		$statement->bindParam(":status",$data["status"],PDO::PARAM_INT);
		if($statement->execute()){
			return "success";
		}else{
			return "fail";
		}
		$statement->close();
	}


	public static function storeInfoModel($data,$table){
		$statement = Connection::connect()->prepare("SELECT * FROM $table WHERE store_id = :id");
		$statement->bindParam(":id",$data,PDO::PARAM_INT);
		$statement->execute();
		return $statement->fetch();
		$statement->close();

	}
	

	############################################################################################################################
	###################################################### PRODUCT MODEL #######################################################
	############################################################################################################################
	
	//Metodo que realizara la consulta para obtener los datos de los productos
	public static function productViewsModel($table, $table2){
		$statement = Connection::connect() -> prepare("SELECT * FROM $table as p INNER JOIN $table2 as c WHERE p.category_id = c.cat_id");
		$statement -> execute();
		return $statement->fetchAll();
		$statement->close();
	}

	public static function productStoreViewsModel($table, $table2,$id){
		$statement = Connection::connect() -> prepare("SELECT * FROM $table as p INNER JOIN $table2 as c WHERE p.category_id = c.cat_id AND p.id_store = :id_store");
		$statement->bindParam(":id_store",$id,PDO::PARAM_INT);
		$statement -> execute();
		return $statement->fetchAll();
		$statement->close();
	}
	
	//Meotodo que hara las inserciones en la base de datos para agregar los productos
	public static function addProductModel($data, $table){
		$statement = Connection::connect() -> prepare("INSERT INTO products (id_prod,code,prod_name,date_added,price,stock,category_id,id_store) VALUES (NULL,:code,:prod_name,:date_added,:price,:stock,:category_id,:id_store)");
		$statement->bindParam(":code",$data['code'],PDO::PARAM_STR);
		$statement->bindParam(":prod_name",$data['prod_name'],PDO::PARAM_STR);
		$statement->bindParam(":date_added",$data['date_added'],PDO::PARAM_STR);
		$statement->bindParam(":price",$data['price'],PDO::PARAM_INT);
		$statement->bindParam(":stock",$data['stock'],PDO::PARAM_INT);
		$statement->bindParam(":category_id",$data['category_id'],PDO::PARAM_INT);
		$statement->bindParam(":id_store",$data['id_store'],PDO::PARAM_INT);
		if($statement->execute()){
			return "success";
		}else{
			return "fail";
		}
		$statement->close();
	}
	
	//Metodo que realiazara la consulta para obtener los datos del produto a editar
	public static function editProductModel($data, $table){
		$statement = Connection::connect()->prepare("SELECT *  FROM $table WHERE id_prod = :id");
		$statement -> bindParam(":id",$data,PDO::PARAM_INT);
		$statement -> execute();
		return $statement -> fetch();
		$statement->close();
	}

	//Metodo que realizara el update para actualizar el producto en la base de datos
	public static function updateProductModel($data, $table){
		$statement = Connection::connect() -> prepare("UPDATE products SET code=:code,prod_name=:prod_name,date_added=:date_added,price=:price,stock=:stock,category_id = :category_id WHERE id_prod = :id");
		$statement->bindParam(":id",$data['id'],PDO::PARAM_INT);
		$statement->bindParam(":code",$data['code'],PDO::PARAM_STR);
		$statement->bindParam(":prod_name",$data['prod_name'],PDO::PARAM_STR);
		$statement->bindParam(":date_added",$data['date_added'],PDO::PARAM_STR);
		$statement->bindParam(":price",$data['price'],PDO::PARAM_INT);
		$statement->bindParam(":stock",$data['stock'],PDO::PARAM_INT);
		$statement->bindParam(":category_id",$data['category_id'],PDO::PARAM_INT);
		if($statement->execute()){
			return "success";
		}else{
			return "fail";
		}
		$statement->close();

	} 
	//Metodo que realizara la eliminacion del producto junto con los registros de historial que se enceuntren del producto, validando que el usuario activo ingrese su contraseña para eliminar dicho producto
	public static function deleteProductModel($data,$table,$table2,$table3){
		$statement = Connection::connect() -> prepare("SELECT password FROM $table WHERE id = :userId");
		$statement->bindParam(":userId",$data['userId'],PDO::PARAM_INT);
		$statement->execute();
		$password = $statement->fetch();
		
		if($password['password'] == $data["password"]){

			$statement3 = Connection::connect()->prepare("DELETE FROM $table3 WHERE id_producto = :id AND user_id = :user_id");
			$statement3->bindParam(":id",$data['id'],PDO::PARAM_INT);
			$statement3->bindParam(":user_id",$data['user_id'],PDO::PARAM_INT);
			$statement3->execute();

			$statement2 = Connection::connect()->prepare("DELETE FROM $table2 WHERE id_prod = :id");
			$statement2->bindParam(":id",$data['id'],PDO::PARAM_INT);
			$statement2->execute();
			


			return "success";
			
		}else{
			return "fail";
		}
		$statement->close();
			
	}
	//Metodo que realizara la consulta que mostrara los datos de un producto
	public static function productModel($data,$table){
		$statement= Connection::connect()->prepare("SELECT * FROM $table WHERE id_prod = :id");
		$statement->bindParam(":id",$data,PDO::PARAM_INT);
		$statement->execute();
		return $statement->fetch();
		$statement->close();
	}

	############################################################################################################################
	###################################################### USER MODEL ##########################################################
	############################################################################################################################
	
	//Metodo que realizara la consulta para obtener los datos de los usuarios
	public static function userViewModel($table){
		$userid = $_SESSION['user'];
		$statement = Connection::connect() -> prepare("SELECT * FROM $table WHERE id <> :userid");
		$statement->bindParam(":userid",$userid,PDO::PARAM_INT);
		$statement->execute();
		return $statement->fetchAll();
		$statement->close();
	}

	public static function userStoreViewModel($table){
		$userid = $_SESSION['user'];
		$id_store = $_GET['id_store'];
		$statement = Connection::connect() -> prepare("SELECT * FROM $table WHERE id <> :userid AND id_store = :id_store");
		$statement->bindParam(":userid",$userid,PDO::PARAM_INT);
		$statement->bindParam(":id_store",$id_store,PDO::PARAM_INT);
		$statement->execute();
		return $statement->fetchAll();
		$statement->close();
	}
	//Meotodo que hara las inserciones en la base de datos para agregar los usuarios
	public static function addUserModel($data, $table){
		$statement = Connection::connect() -> prepare("INSERT INTO user (firstname,lastname,username,password,email,date_added,id_store) VALUES (:firstname,:lastname,:username,:password,:email,:date_added,:id_store)");
		$statement->bindParam(":firstname",$data['firstname'],PDO::PARAM_STR);
		$statement->bindParam(":lastname",$data['lastname'],PDO::PARAM_STR);
		$statement->bindParam(":username",$data['username'],PDO::PARAM_STR);
		$statement->bindParam(":password",$data['password'],PDO::PARAM_INT);
		$statement->bindParam(":email",$data['email'],PDO::PARAM_INT);
		$statement->bindParam(":date_added",$data['date_added'],PDO::PARAM_INT);
		$statement->bindParam(":id_store",$data['id_store'],PDO::PARAM_INT);
		if($statement->execute()){
			return "success";
		}else{
			return "fail";
		}
		$statement->close();
	}

	//Metodo que realiazara la consulta para obtener los datos del usuario a editar
	public static function editUserModel($data, $table){
		$statement = Connection::connect()->prepare("SELECT *  FROM $table WHERE id = :id");
		$statement -> bindParam(":id",$data,PDO::PARAM_INT);
		$statement -> execute();
		return $statement -> fetch();
		$statement->close();
	}

	//Metodo que realizara el update para actualizar el usuario en la base de datos
	public static function updateUserModel($data, $table){
		$statement = Connection::connect() -> prepare("UPDATE $table SET firstname=:firstname,lastname=:lastname,username=:username,password=:password,email=:email, date_added=date_added WHERE id = :id");
		$statement->bindParam(":id",$data['id'],PDO::PARAM_INT);
		$statement->bindParam(":firstname",$data['firstname'],PDO::PARAM_STR);
		$statement->bindParam(":lastname",$data['lastname'],PDO::PARAM_STR);
		$statement->bindParam(":username",$data['username'],PDO::PARAM_STR);
		$statement->bindParam(":password",$data['password'],PDO::PARAM_STR);
		$statement->bindParam(":email",$data['email'],PDO::PARAM_STR);
		if($statement->execute()){
			return "success";
		}else{
			return "fail";
		}
		$statement->close();

	}

	//Metodo que realizara la eliminacion del usuarioo junto con los registros de historial que se enceuntren del usuario, validando que el usuario activo ingrese su contraseña para eliminar dicho usuario
	public static function deleteUserModel($data,$table,$table2){
		$statement = Connection::connect() -> prepare("SELECT password FROM $table WHERE id = :userId");
		$statement->bindParam(":userId",$data['userId'],PDO::PARAM_INT);
		$statement->execute();
		$password = $statement->fetch();
		
		if($password['password'] == $data["password"]){
			$statement2 = Connection::connect()->prepare("DELETE FROM $table2 WHERE user_id = :id");
			$statement2->bindParam(":id",$data['id'],PDO::PARAM_INT);
			$statement2->execute();

			$statement3 = Connection::connect()->prepare("DELETE FROM $table WHERE id = :id");
			$statement3->bindParam(":id",$data['id'],PDO::PARAM_INT);
			$statement3->execute();
			return "success";
		}else{
			return "fail";
		}
		$statement->close();
			
	}
	//Metodo que realizara la consulta que mostrara los datos de un usuario
	public static function userModel($data,$table){
		$statement = Connection::connect()->prepare("SELECT * FROM user WHERE id = :id");
		$statement->bindParam(":id",$data,PDO::PARAM_INT);
		$statement->execute();
		return $statement->fetch();
		$statement->close();
	}


	############################################################################################################################
	###################################################### CATEGORY MODEL ######################################################
	############################################################################################################################

	//Metodo que realizara la consulta para obtener los datos de las categorias
	public static function categoryViewModel($table){
		$statement = Connection::connect() -> prepare("SELECT * FROM $table");
		$statement->execute();
		return $statement->fetchAll();
		$statement->close();
	}

	public static function categoryStoreViewModel($table,$id_store){
		$statement = Connection::connect() -> prepare("SELECT * FROM $table WHERE id_store = :id_store");
		$statement->bindParam(":id_store",$id_store,PDO::PARAM_INT);
		$statement->execute();
		return $statement->fetchAll();
		$statement->close();
	}

	//Meotodo que hara las inserciones en la base de datos para agregar las categorias
	public static function addCategoryModel($data, $table){
		$statement = Connection::connect() -> prepare("INSERT INTO $table (cat_name,description,date_added) VALUES (:cat_name,:description,:date_added)");
		$statement->bindParam(":cat_name",$data['cat_name'],PDO::PARAM_STR);
		$statement->bindParam(":description",$data['description'],PDO::PARAM_STR);
		$statement->bindParam(":date_added",$data['date_added'],PDO::PARAM_INT);
		if($statement->execute()){
			return "success";
		}else{
			return "fail";
		}
		$statement->close();
	}

	//Metodo que realiazara la consulta para obtener los datos de la categoria a editar
	public static function editCategoryModel($data, $table){
		$statement = Connection::connect()->prepare("SELECT *  FROM $table WHERE cat_id = :id");
		$statement -> bindParam(":id",$data,PDO::PARAM_INT);
		$statement -> execute();
		return $statement -> fetch();
		$statement->close();
	}

	//Metodo que realizara el update para actualizar la categoria en la base de datos
	public static function updateCategoryModel($data, $table){
		$statement = Connection::connect() -> prepare("UPDATE $table SET cat_name=:cat_name,description = :description ,date_added=date_added WHERE cat_id = :cat_id");
		$statement->bindParam(":cat_id",$data['cat_id'],PDO::PARAM_INT);
		$statement->bindParam(":cat_name",$data['cat_name'],PDO::PARAM_STR);
		$statement->bindParam(":description",$data['description'],PDO::PARAM_STR);
		if($statement->execute()){
			return "success";
		}else{
			return "fail";
		}
		$statement->close();

	}

	//Metodo que realizara la eliminacion de la categoria, validando que el usuario activo ingrese su contraseña para eliminar dicho usuario
	public static function deleteCategoryModel($data,$table,$table2,$table3){
		$statement = Connection::connect() -> prepare("SELECT password FROM $table WHERE id = :userId");
		$statement->bindParam(":userId",$data['userId'],PDO::PARAM_INT);
		$statement->execute();
		$password = $statement->fetch();
		
		if($password['password'] == $data["password"]){

			

			$statement2 = Connection::connect()->prepare("DELETE FROM $table3 WHERE category_id = :id");
			$statement2->bindParam(":id",$data['id'],PDO::PARAM_INT);
			
			if($statement2->execute()){
				$statement3 = Connection::connect()->prepare("DELETE FROM $table2 WHERE cat_id = :id");
				$statement3->bindParam(":id",$data['id'],PDO::PARAM_INT);
				$statement3->execute();	
				return "success";		
			}			

			
		}else{
			return "fail";
		}
		$statement->close();
	}

	//Metodo que realizara la consulta que mostrara los datos de una categoria
	public static function categoryModel($data,$table){
		$statement= Connection::connect()->prepare("SELECT * FROM $table WHERE cat_id= :id");
		$statement->bindParam(":id",$data,PDO::PARAM_INT);
		$statement->execute();
		return $statement->fetch();
		$statement->close();

	}



	############################################################################################################################
	###################################################### HISTORIAL MODEL #####################################################
	############################################################################################################################

	//Metodo que retornara los registros del historial

	public static function viewStoreHistorialModel($table){
		$id_store = $_GET["id_store"];
		$statement = Connection::connect()->prepare("SELECT * FROM $table WHERE id_store = :id_store");
		$statement->bindParam(":id_store",$id_store,PDO::PARAM_INT);
		$statement->execute();

		return $statement->fetchAll();
		$statement->close();
	}

	//Metodo que retornara los registros del historial de un producto
	public static function viewProductHistorialModel($data,$table){
		$statement = Connection::connect()->prepare("SELECT * FROM $table WHERE id_producto = :id_producto");
		$statement->bindParam(":id_producto",$data,PDO::PARAM_INT);
		$statement->execute();
		return $statement->fetchAll();
		$statement->close();
	}	

	//Metodo que retornara los registros del historia que haya realizado cada usuario
	public static function viewUserHistorialModel($table){
		$user_id = $_SESSION['user'];
		$statement = Connection::connect()->prepare("SELECT * from $table WHERE user_id = :user_id");
		$statement->bindParam(":user_id",$user_id,PDO::PARAM_INT);
		$statement->execute();
		return $statement->fetchAll();
		$statement->close();
	}
	//Metodo que realizara la insercion de los moviemientos en el historial
	public static function addHistorialModel($data,$table){
		$statement = Connection::connect()->prepare("INSERT INTO $table (id_producto,product_name,user_id,user,date_added,note,reference,quantity) VALUES(:id_producto,:product_name,:user_id,:user,:date_added,:note,:reference,:quantity)");
		$statement->bindParam(":id_producto",$data["id_producto"],PDO::PARAM_INT);
		$statement->bindParam(":user_id",$data["user_id"],PDO::PARAM_INT);
		$statement->bindParam(":product_name",$data["product_name"],PDO::PARAM_STR);
		$statement->bindParam(":user",$data["user"],PDO::PARAM_STR);
		$statement->bindParam(":date_added",$data["date_added"],PDO::PARAM_STR);
		$statement->bindParam(":note",$data["note"],PDO::PARAM_STR);
		$statement->bindParam(":reference",$data["reference"],PDO::PARAM_STR);
		$statement->bindParam(":quantity",$data["quantity"],PDO::PARAM_INT);
		if($statement->execute()){
			return "success";
		}else{
			return "fail";
		}
		$statement->close();
	}	

	//Funcion que actualizara el stock del producto dependeindo del movimiento de inventario que se haya realizado
	public static function addStockModel($data,$table){
		$statement = Connection::connect()->prepare("UPDATE $table SET stock=:stock WHERE id_prod = :id");
		$statement->bindParam(":id",$data["id"],PDO::PARAM_INT);
		$statement->bindParam(":stock",$data["stock"],PDO::PARAM_INT);
		if($statement->execute()){
			return "success";
		}
		//$statement->close();
	}

}
?>



