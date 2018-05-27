<?php

session_start();

if(isset($_SESSION["maestro"])){	
	$id = $_SESSION["maestro"];
}else if(!$_SESSION["validar"]){
	header("location:index.php");
	exit();
}

?>


<h1>TUTORIAS</h1>
	<?php echo '<a href="index.php?action=registroTutoria&id=$id"><input type="button" name="registrar" value="Registrar"></a>';?>
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
				<th></th>
			</tr>
		</thead>
		<tbody>
			
			<?php
			$vistaAlumno = new MvcCont();
				
			if(isset($_SESSION["maestro"])){
				$vistaAlumno -> vistaTutoriaPorMaestroC($id);
			}else if(isset($_SESSION["validar"])){
				$vistaAlumno ->vistaTutoriaC();
			}
	
			
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