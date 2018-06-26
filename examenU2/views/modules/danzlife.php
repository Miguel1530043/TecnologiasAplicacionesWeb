	<?php
		$mvc = new MvcController();
		$groupStudent = $mvc->studentGroupController();
  if(isset($_SESSION["user"])){
    echo"<script>
      window.location='index.php?action=dashboard';
      </script>";
  }
	?>

	<section class="content">
    	<div class="card">
      		<div class="card-header" style="background-color: purple">
	      		<div class="row">
	      			<div class="col-6">
	      				<label class="card-title" style="color:white;">Danzlife</label>
	      			</div>
	      			<div class="col-6" align="right" >
	      				<a href="index.php" class="btn" style="color:white">Inicio</a>
	      				<a href="index.php?action=lugares" class="btn" style="color:white">Lugares</a>
	      			</div>
        		</div>
      		</div>
      		
			<form method="post" role="form" enctype="multipart/form-data">
				<div class="card-body" align="center">
					<div class="row">
						<div class="col-2"></div>
						<div class="col-8">
							<H1 style="color:purple">Envío de Comprobantes</H1>
							<select class="form-control" name="grupo" id="grupo" onchange="alumnasGrupo();">
								<option disabled selected>Seleccionar Grupo</option>
								<?php
									$mvc ->selectGroup();
								?>

							</select><br>
						</div>
						<div class="col-2"></div>
						<div class="col-2"></div>
						<div clasS="col-8">
							<select class="form-control" name="alumna" id="alumna">
								<option disabled selected>Seleccionar alumna</option>
								<?php
									$mvc->selectStudent();
								?>
							</select><br>
						</div>
						<div class="col-2"></div>
						<div class="col-2"></div>
						<div class="col-4">
							<input type="text" name="nombreMama" placeholder="Nombre de la madre" class="form-control"><br>
						</div>
						<div class="col-4">
							<input type="text" name="apellidoMama" placeholder="Apellidos de la madre" class="form-control"><br>
						</div>
						<div class="col-2"></div>
						<div class="col-2"></div>
						<div class="col-8">
							<input type="date" name="fechaPago" class="form-control"><br>
						</div>
						<div class="col-2"></div>
						<div class="col-2"></div>
						<div class="col-4">
							<input type="file" name="imagenFolio" id="imagenFolio" class="form-control"><br>
						</div>
						<div class="col-4">
							<input type="text" name="folio" placeholder="Folio" class="form-control"><br>
						</div>
						<div class="col-2"></div>
						<br><br>
						<div class="container" align="center">
							<input type="submit" name="aceptar" value="Aceptar" class="btn-lg btn-info">
						</div>
					</div>
				</div>
			</form>
			<input type="hidden" name="students" id="students" value="<?php echo $groupStudent ?>">
			<?php
				$mvc -> addPaymentController();
			?>
		</div>
	</section>
