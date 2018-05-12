<?php
  if(isset($_POST['submit'])){//Se verifica si la variable obtenida 'submit' por el metodo post es Verdadera
    $registro = array('A',$_POST['matricula'],$_POST['nombre'],$_POST['carrera'],$_POST['email'],$_POST['telefono']);//Se crea un arreglo contenedor de una etiqueta y de todos los valores del formulario
    $archivo = fopen("capturas.txt","a+")or die("El archivo no existe, realizar un registro para crearlo");;//Se declara una variable la cual tendra como valor la apertura del archivo.txt y las funciones que podra realizar, en este caso la escritura, lectura y creacion.
    $registro2 = implode(",", $registro);//Se declara una variable la cual se le asignara el valor que retorna la funcion 'implode' la cual devuelve el array completo de manera de string, separando por comas cada una de sus indices.
    fwrite($archivo,$registro2);//Se utiliza la funcion 'fwrite()' para la escritura de la variable contenedora del string del array en el archivo .txt en este caso "capturas.txt"-
    fwrite($archivo, "\r\n");//Se escribe un salto de linea despues del registro
    fclose($archivo);//Se utiliza la funcion 'fclose()' para cerrar el archivo
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
 
      <div class="large-12 columns" align="center">
        <div class="large-2 columns">
          <a href="menuAlumno.php"><input type="button" name="regresar" value="Back" class="button"></a>
        </div>
        <div class="large-8 columns">
          <h3>Registro de Alumnos</h3>
        </div>
        <form method="POST" action="formAlumno.php">
          <input type="text" name="matricula" placeholder="Matrícula" required><br>
          <input type="text" name="nombre" placeholder="Nombre" required><br>
          <input type="text" name="carrera" placeholder="Carrera" required><br>
          <input type="email" name="email" placeholder="E-Mail" required><br>
          <input type="text" name="telefono" placeholder="Télefono" required><br>
          <input type="submit" name="submit" value="Registrar" class="button">
        </form>
      </div>

    </div>
    

    <?php require_once('footer.php'); ?>