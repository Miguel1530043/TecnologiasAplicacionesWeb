<?php
include_once('utilities.php');

$total_users = count($user_access);
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
 
      <div class="large-12 columns" align="center">
        <h3>Captura de Maestros y Alumnos</h3>
          <a href="menuAlumno.php"><input type="button" name="menuA" value="Alumnos" class="button"></a></br>
          <a href="menuMaestro.php"><input type="button" name="menuM" value="Maestros" class="button"></a>
      </div>
      <b>Total de registros: </b> <?php echo $total_users-1; ?>
    </div>
    

    <?php require_once('footer.php'); ?>