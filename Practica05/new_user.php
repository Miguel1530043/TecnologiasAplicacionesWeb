<?php
	include("db/database_utilities.php");
	if(isset($_POST['agregar'])){//Se verifica si existe mediante POST el campo agregar, si es asi se hace lo siguiente
		$email = $_POST['email'];//La variable $email tomara el valor del campo email del formulario
		$password = $_POST['password'];//La variable $password tomara el valor de campo password en el formulario

		add($email,$password);//Se ejecuta la funcion "add()" que agregara un nuevo usuario, funcion que se encuentra dentro de database_utilities.php
		header("location: index.php");//Redireccionar a la pagina principal index.php
	}
?>

<!doctype html>
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Curso PHP |  Bienvenidos</title>
    <link rel="stylesheet" href="./css/foundation.css" />
    <script src="./js/vendor/modernizr.js"></script>
  </head>
  <body>
    
    <?php require_once('header.php'); ?>

     
    <div class="row">
 
      <div class="large-9 columns">
        <h3>Agregar nuevo usuario</h3>
        <div class="section-container tabs" data-section>
          <form method="POST">
	          <section class="section">
	            <div class="content" data-slug="panel1">
	            <input type="email" name="email" placeholder="E-mail"><br>
	            <input type="password" name="password" placeholder="Contraseña"></br>
	            <input type="submit" name="agregar" value="Agregar" class="button success">
	            </div>
	          </section>
          </form>
        </div>
      </div>

    </div>
    

    <?php require_once('footer.php'); ?>

