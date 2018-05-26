<?php

session_start();

if(!$_SESSION["validar"]){
	header("location:index.php");
	exit();
}else if(!$_SESSION["maestro"]){
	header("location:index.php?action=alumnos");
	exit();
}

?>

<h1>MAESTROS</h1>
	<a href="index.php?action=registro"><input type="button" value="Registrar"/></a>
	<table>
		
		<thead>
			
			<tr>
				<th>Numero de Empleado</th>
				<th>Nombre</th>
				<th>E-Mail</th>
				<th>Carrera</th>
				<th>Editar?</th>
				<th>Eliminar?</th>
			</tr>
		</thead>
		<tbody>
			
			<?php

			$vistaMaestros = new MvcCont();
			$vistaMaestros -> vistaMaestrosC();
			$vistaMaestros -> borraMaestroC();

			?>

		</tbody>

	</table>



<?php

if(isset($_GET["action"])){

	if($_GET["action"] == "cambio"){

		echo "Cambio Exitoso";
	
	}

}

?>