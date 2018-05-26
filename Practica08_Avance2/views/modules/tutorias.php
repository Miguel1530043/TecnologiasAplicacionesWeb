<?php

session_start();

if(!$_SESSION["validar"]){
	header("location:index.php");
	exit();
}
?>

<h1>TUTORIAS</h1>
	<a href="index.php?action=registroTutoria"><input type="button" value="Registrar"/></a>
	<table>
		<thead>
			
			<tr>
				<th>ID</th>
				<th>Tutor</th>
				<th>Fecha</th>
				<th>Hora</th>
				<th>Descripcion</th>
				<th>Tipo</th>
				<th>Editar?</th>
				<th>Eliminar?</th>
			</tr>
		</thead>
		<tbody>
			
			<?php
			$vistaAlumno = new MvcCont();
				
			$vistaAlumno -> vistaTutoriaC();	
			
			$vistaAlumno -> borraTutoriaC();

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