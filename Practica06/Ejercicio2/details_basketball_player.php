<?php

  require('utilities.php');//Llamado al archivo utilities.php el cual incluye las funciones y conexion a la base de datos
  $id = $_GET['id'];//Se recibe el id del jugador mediante el metodo GET
  $sport = "BasketBall";//Se declara el deporte como BasketBall

  if(isset($_POST['modificar'])){//Se condiciona si se hizo el uso del elemento 'modificar'
    $id = $_GET['id'];//Se recibe el id del jugador mediante el metodo GET
    $name = $_POST['name'];//Se recibe el elemento name mediante el metodo POST
    $position = $_POST['position'];//Se recibe el elemento position mediante el metodo POST
    $carrier = $_POST['carrier'];//Se recibe el elemento carrier mediante el metodo POST
    $email = $_POST['email'];//Se recibe el elemento email mediante el metodo POST
    

    update($id,$name,$position,$carrier,$email,$sport);//Se ejecuta la funcion update para actualizar el registro
    header("location: basketball.php");//Redireccion al apartado de BasketBall
  }
  data($id,$sport);//Se ejecuta la funcion data para obtener la informacion del jugador
?>

<!doctype html>
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Curso PHP |  Bienvenidos</title>
    <link rel="stylesheet" href="../css/foundation.css" />
    <script src="../js/vendor/modernizr.js"></script>
  </head>
  <body>
    
    <?php require_once('header.php'); ?>

     
    <div class="row">
 
      <div class="large-9 columns">
        <p style="font-size:30px">Modificacion de Jugador de BasketBall</p>
        <a href="basketball.php" class="button">Regresar</a>
        <div class="section-container tabs" data-section>
          <form method="POST">
	          <section class="section">
	            <div class="content" data-slug="panel1">

              <!--Dentro de cada input, es su value se encuentran etiquetas de PHP, en las cuales se utiliza la funcion echo para impresion, dentro de dicha funcion se imprime el resultado de hacer la consulta para obetener los datos del jugador, mediante los parametros que son el id y el deporte, y asi poder mostrar los datos del jugador-->
              
	            <input type="text" name="id" value="<?php echo $result[0]['id']?>" disabled><br>
	            <input type="text" name="name" value="<?php echo $result[0]['name']?>"></br>
              <input type="text" name="position" value="<?php echo $result[0]['position']?>"></br>
              <select name="carrier">
                  <option><?php echo $result[0]['carrier']?></option>
                  <option value="Ingenieria en Tecnologias de la Informacion">Ingenieria en Tecnologias de la Informacion</option>
                  <option value="Ingenieria en Tecnologias de la Manufactura">Ingenieria en Tecnologias de la Manufactura</option>
                  <option value="Ingenieria en Mecatronica">Ingenieria en Mecatronica</option>
                  <option value="Ingenieria en Sistemas Automotrices">Ingenieria en Sistemas Automotrices</option>
                  <option value="Licenciatura en Administracion y Gestion de PYMES">Licenciatura en Administracion y Gestion de PYMES</option>
              </select>
              <input type="text" name="email" value="<?php echo $result[0]['email']?>"></br>
              <select name="sport" disabled>
                  <option value="BasketBall">BasketBall</option>
                  <option value="FootBall">FootBall</option>
              </select>
	            <input type="submit" name="modificar" value="Modificar" class="button success" onclick="alertaAccion()">
	            </div>
	          </section>
          </form>
        </div>
      </div>

    </div>
    

    <?php require_once('footer.php'); ?>
<script type="text/javascript">
  //Funcion para escribir una alerta y validar si se desaea realizar la accion de modificar
      function alertaAccion(){
        var alerta = confirm("Seguro que desea modificarlo?");
        if(alerta == false){
            event.preventDefault();
        }
      }
</script>