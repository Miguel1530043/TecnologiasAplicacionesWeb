<?php
	include("db/database_utilities.php");//Se incluye el arcivho de "database_utilities.php"
  $id = $_GET['id'];//Se agigna el valor del id pasado por el metodo postro
	if(isset($_POST['modificar'])){//Se verifica si existio la accion con el boton modificar
    $id = $_GET['id'];//Variable que alamacena e id
		$email = $_POST['email'];//Variable que amazamos
		$password = $_POST['password'];//Variable que contendra la constraseña ingresada en el formulro
		update($id,$email,$password);//Se ejecuta la funcion de update para actualizar
   header("location: index.php");//Redicrecciona al inicio o pagina principal "index.php"
  }
  data($id);//se ejecut la funcion add
  $user = mysqli_fetch_array($query);
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
        <h3>Modificar usuario</h3>
        <div class="section-container tabs" data-section>
          <section class="section">
          <form method="POST" <?php echo "action='details.php?id=$id'";?> >
            <div class="content" data-slug="panel1">
            <input type="email" name="email" placeholder="E-mail" value="<?php echo $user['email']?>"><br>
            <input type="password" name="password" placeholder="Contraseña" value="<?php echo $user['password']?>"></br>
            <input type="submit" name="modificar" value="Modificar" class="button success">
            </div>
          </form>
          </section>
        </div>
      </div>

    </div>
    

    <?php require_once('footer.php'); ?>