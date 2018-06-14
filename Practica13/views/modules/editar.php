<?php
	//error_reporting(0);
	session_start();
	if(!$_SESSION['user']){
		echo "
		<script type='text/javascript'>
			window.location='index.php';
		</script>";
	}	
	$MVC = new MvcController();
?>
	<div class="col-xs-12">
		<h1>Editar producto con el ID </h1>
		<form method="post" id="form-edit">
			<?php
				$MVC->editProductController();
				$MVC->updateProductController();

			?>
		</form>
	</div>

