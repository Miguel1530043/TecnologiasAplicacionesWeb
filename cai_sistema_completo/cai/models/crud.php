<?php
	require_once "connection.php";
	class Data extends Connection{
		
		//Metodo para mostrar la informacion de todas las alumnas de la academia
		public static function showStudentsModel($table,$table2){
			$statement = Connection::connect()->prepare("SELECT a.nombre_alumno, a.apellidos_alumno, a.matricula, a.carrera, a.email, g.nombre_grupo, g.nivel,t.nombre_teacher, t.apellidos_teacher FROM $table as a INNER JOIN $table2 as g on a.grupo = g.id_grupo INNER JOIN teachers as t on g.teacher = t.num_empleado");

			$statement->execute();
			return $statement->fetchAll();
			$statement->close();
		}
    	//Metodo para mostrar todos los estudiantes dependiendo del grupo
    	public static function showStudentsGroupModel($data,$table){
			$statement = Connection::connect()->prepare("SELECT * FROM $table  WHERE grupo = :grupo");
      		$statement->bindParam(":grupo",$data,PDO::PARAM_INT);
			$statement->execute();
			return $statement->fetchAll();
			$statement->close();
		}
    
    

		//Metodo para realizar la consulta en la base de datos y poder realizar la insercion en la tabla alumnas, los datos a insertar seran el arreglo que se recibira como parametro.
		public static function addStudentModel($data,$table){
			$statement = Connection::connect()->prepare("INSERT INTO $table(matricula,nombre_alumno,apellidos_alumno,carrera,grupo,email) VALUES (:matricula,:nombre_alumno,:apellidos_alumno,:carrera,:grupo,:email)");
			$statement ->bindParam(":matricula",$data["matricula"],PDO::PARAM_INT);
			$statement ->bindParam(":nombre_alumno",$data["nombre_alumno"],PDO::PARAM_STR);
			$statement ->bindParam(":apellidos_alumno",$data["apellidos_alumno"],PDO::PARAM_STR);
			$statement ->bindParam(":carrera",$data["carrera"],PDO::PARAM_STR);
			$statement ->bindParam(":grupo",$data["grupo"],PDO::PARAM_INT);
			$statement ->bindParam(":email",$data["email"],PDO::PARAM_STR);
			if($statement->execute()){
				return "success";
			}else{
				return "fail";
			}
		}

		//Metodo para realizar la consulta que devolvera los datos de la alumna la cual se desea editar
		public static function editStudentModel($data,$table,$table2){
			$statement = Connection::connect()->prepare("SELECT * FROM $table as a INNER JOIN $table2 as g on a.grupo = g.id_grupo WHERE matricula = :matricula");
			$statement->bindParam(":matricula",$data,PDO::PARAM_INT);
			$statement->execute();
			return $statement->fetch();
		}

		//Metodo para editar los datos de la alumna dependiendo de los datos que se obtenieron en la funcion editStudentModel.
		public static function updateStudentModel($data,$table){
			$statement = Connection::connect()->prepare("UPDATE $table SET nombre_alumno = :nombre_alumno, apellidos_alumno=:apellidos_alumno, carrera = :carrera,grupo = :grupo, email=:email WHERE matricula = :matricula");
			$statement->bindParam(":nombre_alumno",$data["nombre_alumno"],PDO::PARAM_STR);
			$statement->bindParam(":apellidos_alumno",$data["apellidos_alumno"],PDO::PARAM_STR);
			$statement->bindParam(":carrera",$data["carrera"],PDO::PARAM_STR);
			$statement->bindParam(":email",$data["email"],PDO::PARAM_STR);
			$statement->bindParam(":grupo",$data["grupo"],PDO::PARAM_INT);
			$statement->bindParam(":matricula",$data["matricula"],PDO::PARAM_INT);
			if($statement->execute()){
				return "success";
			}else{
				return "fail";
			}
		}

		//Metodo que realizara la eliminacion de la alumna dependiendo del id que se haya recibido como parametro
		public static function deleteStudentModel($data,$table){
			$statement = Connection::connect()->prepare("DELETE FROM $table WHERE matricula = :matricula");
			$statement->bindParam(":matricula",$data,PDO::PARAM_INT);
			if($statement->execute()){
				return "success";
			}else{
				return "fail";
			}
		}

		//Metodoo que muestra todos los grupos, para ser vistos por medio de un select
		public static function selectGroupModel($table){
			$statement = Connection::connect()->prepare("SELECT * FROM $table");
			$statement->execute();
			return $statement->fetchAll();
			$statement->close();
		}


		//Metodo para mostrar la informacion de todos los grupos de la academiA
		public static function showGroupsModel($table,$table2){
			$statement = Connection::connect()->prepare("SELECT * FROM $table as g inner join $table2 as t WHERE g.teacher = t.num_empleado");
			$statement->execute();
			return $statement->fetchAll();
			$statement->close();
		}

		//Metodo que realiza la consulta que contendra todos los grupos de un teacher seleccionado
    	public static function showTeachersGroupsModel($data,$table){
			$statement = Connection::connect()->prepare("SELECT * FROM $table WHERE teacher =:teacher");
      		$statement->bindParam("teacher",$data,PDO::PARAM_INT);
			$statement->execute();
			return $statement->fetchAll();
			$statement->close();
		}

		//Metodo para realizar la inserion de un grupo en la base de datos,.
		public static function addGroupModel($data,$table){
			$statement = Connection::connect()->prepare("INSERT INTO $table(nombre_grupo,nivel,teacher) VALUES (:nombre_grupo,:nivel,:teacher)");
			$statement ->bindParam(":nombre_grupo",$data["nombre_grupo"],PDO::PARAM_STR);
			$statement ->bindParam(":nivel",$data["nivel"],PDO::PARAM_INT);
			$statement ->bindParam(":teacher",$data["teacher"],PDO::PARAM_INT);
			
			if($statement->execute()){
				return "success";
			}else{
				return "fail";
			}
		}

		//Metodo para realizar la consulta que devolvera los datos del grupo la cual se desea editar
		public static function editGroupModel($data,$table,$table2){
			$statement = Connection::connect()->prepare("SELECT * FROM $table as g inner join $table2 as t WHERE t.num_empleado = g.teacher AND g.id_grupo = :id_grupo");
			$statement->bindParam(":id_grupo",$data,PDO::PARAM_INT);
			$statement->execute();
			return $statement->fetch();
			$statement->close();
		}

		//Metodo para editar los datos del grupo dependiendo de los datos que se obtenieron en la funcion editStudentModel.
		public static function updateGroupModel($data,$table){
			$statement = Connection::connect()->prepare("UPDATE $table SET nombre_grupo = :nombre_grupo,teacher=:teacher WHERE id_grupo = :id_grupo");
			$statement->bindParam(":nombre_grupo",$data["nombre_grupo"],PDO::PARAM_STR);
			$statement->bindParam(":teacher",$data["teacher"],PDO::PARAM_INT);
			$statement->bindParam(":id_grupo",$data["id_grupo"],PDO::PARAM_INT);

			if($statement->execute()){
				return "success";
			}else{
				return "fail";
			}
		}

		//Metodo que realizara la eliminacion del grupodependiendo del id que se haya recibido como parametro
		public static function deleteGroupModel($data,$table){
			
			$statement = Connection::connect()->prepare("DELETE FROM $table WHERE id_grupo = :id_grupo");
			$statement->bindParam(":id_grupo",$data,PDO::PARAM_INT);
			$statement->execute();
			return "success";
			
		}

		//Metodo que recibira los datos que se ingresaron en el formulario del login para comparar si son iguales a los de algun registro de la tabla usuario en la base de datos
		public static function loginModel($data, $table){
			$statement = Connection::connect() -> prepare("SELECT * FROM $table WHERE email = :email and password = :password");
			$statement -> bindParam(":email",$data['email'],PDO::PARAM_STR);
			$statement -> bindParam(":password",$data['password'],PDO::PARAM_STR);
			$statement -> execute();
			return $statement -> fetch();
			$statement -> close();
		}

		###################################################################################################################################3
		########################################################## TEACHERS ###############################################################3
		#####################################################################################################################################

		//Metodo que contendra toda la informacion de todos los teachers
		public static function showTeachersModel($table){
			$statement = Connection::connect()->prepare("SELECT * from $table");
			$statement->execute();
			return $statement->fetchAll(); 
			$statement->close();
		}
		
		//Metodo que realizara el agregado hacia la base de datos de un teacher, recibiendo todos los datos requeridos para realizar las insercion en la base de datos, mediante el uso de bindParam, para hacer que los datos sean mas seguros.
		public static function addTeacherModel($data,$table){
			$statement = Connection::connect()->prepare("INSERT INTO $table(num_empleado,nombre_teacher,apellidos_teacher,email,password,foto,telefono) VALUES (:num_empleado,:nombre_teacher,:apellidos_teacher,:email,:password,:foto,:telefono)");
			$statement ->bindParam(":num_empleado",$data["num_empleado"],PDO::PARAM_INT);
			$statement ->bindParam(":nombre_teacher",$data["nombre_teacher"],PDO::PARAM_STR);
			$statement ->bindParam(":apellidos_teacher",$data["apellidos_teacher"],PDO::PARAM_STR);
			$statement ->bindParam(":email",$data["email"],PDO::PARAM_STR);
			$statement ->bindParam(":password",$data["password"],PDO::PARAM_STR);
			$statement ->bindParam(":foto",$data["foto"],PDO::PARAM_STR);
			$statement ->bindParam(":telefono",$data["telefono"],PDO::PARAM_STR);
			if($statement->execute()){
				return "success";
			}else{
				return "fail";
			}	
		}

		//Metodo para realizar el borrado de la informacion de un teacher en la base de datos, dependiendo de su identificador el cual es su numero de empleado
		public static function deleteTeacherModel($data,$table){
			$statement = Connection::connect()->prepare("DELETE FROM $table WHERE num_empleado = :num_empleado");
			$statement->bindParam(":num_empleado",$data,PDO::PARAM_INT);
			if($statement->execute()){
				return "success";
			}else{
				return "fail";
			}
		}

		//Metodo que realizara la edicion de la informacion de un teacher dependiendo de su numero de empleado, el cual es su identificador en la base de datos
		public static function editTeacherModel($data,$table){
			$statement = Connection::connect()->prepare("SELECT * FROM $table WHERE num_empleado = :num_empleado");
			$statement->bindParam(":num_empleado",$data,PDO::PARAM_INT);
			$statement->execute();
			return $statement->fetch();
			$statement->close();
		}

		//Metodo que realizara la acutalizacion de un teacher tomando los valores correspondientes a cada parte de los campos en la base de datos.
		public static function updateTeacherModel($data,$table){
			$statement = Connection::connect()->prepare("UPDATE $table SET nombre_teacher = :nombre_teacher, apellidos_teacher = :apellidos_teacher, email = :email, password = :password, foto = :foto, telefono = :telefono WHERE num_empleado = :num_empleado");
			$statement->bindParam(":nombre_teacher",$data["nombre_teacher"],PDO::PARAM_STR);
			$statement->bindParam(":apellidos_teacher",$data["apellidos_teacher"],PDO::PARAM_STR);
			$statement->bindParam(":email",$data["email"],PDO::PARAM_STR);
			$statement->bindParam(":password",$data["password"],PDO::PARAM_STR);
			$statement->bindParam(":foto",$data["foto"],PDO::PARAM_STR);
			$statement->bindParam(":telefono",$data["telefono"],PDO::PARAM_STR);
			$statement->bindParam(":num_empleado",$data["num_empleado"],PDO::PARAM_INT);
			if($statement->execute()){
				return "success";
			}else{
				return "fail";
			}
		}

		//Metodo que se realizara al termino de una hora de cai, recibiendo la hora de entrada, hora de salida, la fecha, actividade realizada, matricula del alumno y la unidad a la cual se esta realizando la sesion de cai.
		public static function finishHourModel($data,$table,$table2){
			$statement = Connection::connect()->prepare("INSERT INTO $table(hora_entrada,hora_salida,fecha) VALUES (:hora_entrada,:hora_salida,:fecha)");
			$statement->bindParam(":hora_entrada",$data["hora_entrada"],PDO::PARAM_STR);
			$statement->bindParam(":hora_salida",$data["hora_salida"],PDO::PARAM_STR);
			$statement->bindParam(":fecha",$data["fecha"],PDO::PARAM_STR);
			$statement->execute();
			$statement->fetchAll();

			$statement2 = Connection::connect()->prepare("INSERT INTO $table2(id_hora,matricula,actividad,unidad) VALUES (:id_hora,:matricula,:actividad,:unidad)");
			$statement2->bindParam(":id_hora",$data["id_hora"],PDO::PARAM_INT);
			$statement2->bindParam(":matricula",$data["matricula"],PDO::PARAM_INT);
			$statement2->bindParam(":actividad",$data["actividad"],PDO::PARAM_STR);
			$statement2->bindParam(":unidad",$data["unidad"],PDO::PARAM_INT);
			$statement2->execute();
		}

		//Metodo que muestra las unidades que existen
		public static function showUnitsModel($table){
			$statement = Connection::connect()->prepare("SELECT * FROM $table");
			$statement->execute();
			return $statement->fetchAll();
			$statement->close();
		}	
		//Metodo que permite editar la unidad de cai
		public static function editUnitModel($data,$table){
			$statement = Connection::connect()->prepare("SELECT * FROM $table WHERE id_unidad = :id_unidad");
			$statement->bindParam(":id_unidad",$data,PDO::PARAM_INT);
			$statement->execute();
			return $statement->fetch();
			$statement->close();
		}
		//Metodo que realizara la acutalizacion de un teacher tomando los valores correspondientes a cada parte de los campos en la base de datos.
		public static function updateUnitModel($data,$table){
			$statement = Connection::connect()->prepare("UPDATE $table SET fecha_inicio = :fecha_inicio, fecha_termino = :fecha_termino WHERE id_unidad = :id_unidad");
			$statement->bindParam(":fecha_inicio",$data["fecha_inicio"],PDO::PARAM_STR);
			$statement->bindParam(":fecha_termino",$data["fecha_termino"],PDO::PARAM_STR);
			$statement->bindParam(":id_unidad",$data["id_unidad"],PDO::PARAM_INT);
			if($statement->execute()){
				return "success";
			}else{
				return "fail";
			}
		}
    	
    	//Metodo que contiene el resultadod de consultar las sesiones de los alumnos de cada teacher, dependiendo de su matricula y el id del grupo
    	public static function teacherStudentSessionsModel($data,$table,$table2){
    		$statement = Connection::connect()->prepare("SELECT *,COUNT(ha.matricula_alumno) as 'total_horas' FROM $table AS a INNER JOIN $table2 AS ha ON a.matricula = ha.matricula_alumno WHERE grupo = :grupo");
    		$statement->bindParam(":grupo",$data,PDO::PARAM_INT);
    		$statement->execute();
    		return $statement->fetchAll();
    		$statement->close();
    	}
    	//Metodo que contendra la informacion de los detalles de cada sesion de cai de cada alumno
    	public static function studentHoursDetailModel($data,$table,$table2){
    		$statement = Connection::connect()->prepare("SELECT * FROM $table as ha INNER JOIN $table2 as h ON ha.id_hora = h.id_hora WHERE matricula_alumno = :matricula_alumno");
    		$statement->bindParam(":matricula_alumno",$data,PDO::PARAM_INT);
    		$statement->execute();
    		return $statement->fetchAll();
    		$statement->close();
    	}
    
    

	}

?>