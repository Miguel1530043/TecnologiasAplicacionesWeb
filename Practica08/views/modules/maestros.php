<?php

session_start();

if(!$_SESSION["validar"]){

	header("location:index.php?action=ingresar");

	exit();

}

?>

<h1>MAESTROS</h1>

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