<?php
  session_start();
  require('utilities.php');//Llamado al archivo utilities.php el cual incluye las funciones y conexion a la base de datos
  $id = $_GET['id'];//Se recibe el id del jugador mediante el metodo GET

  if(isset($_POST['modificar'])){//Se condiciona si se hizo el uso del elemento 'modificar'
    $id = $_GET['id'];//Se recibe el id del jugador mediante el metodo GET
    $name = $_POST['name'];//Se recibe el elemento name mediante el metodo POST
    $price = $_POST['price'];//Se recibe el elemento position mediante el metodo POST
    

    update_product($id,$name,$price);//Se ejecuta la funcion update para actualizar el registro
    header("location: productos.php");//Redireccion al apartado de BasketBall
  }
  product_data($id);//Se ejecuta la funcion data para obtener la informacion del jugador
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
        <p style="font-size:30px">Modificacion de Producto</p>
        <a href="productos.php" class="button">Regresar</a>
        <div class="section-container tabs" data-section>
          <form method="POST">
	          <section class="section">
	            <div class="content" data-slug="panel1">

              <!--Dentro de cada input, es su value se encuentran etiquetas de PHP, en las cuales se utiliza la funcion echo para impresion, dentro de dicha funcion se imprime el resultado de hacer la consulta para obetener los datos del jugador, mediante los parametros que son el id y el deporte, y asi poder mostrar los datos del jugador-->
              
	            <input type="text" name="id" value="<?php echo $result[0]['id']?>" disabled><br>
	            <input type="text" name="name" value="<?php echo $result[0]['nombre']?>"></br>
              <input type="text" name="price" value="<?php echo $result[0]['precio']?>"></br>
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
