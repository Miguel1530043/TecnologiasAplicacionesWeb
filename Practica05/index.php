<?php
    include_once('db/database_utilities.php');//Se incluye el archivo "database_utilities.php" el cual contiene todas las funciones del CRUD
    run_query();//Se ejecuta la funcion runquery()
    $consulta = $query;//Se toma la variable global del archivo "database_utilities" la cual almacena la consulta sql hecha en el archivo de utilities.
    $total_users=mysqli_num_rows($consulta);//El total de usuario se determina mediante la funcion "mysqli_num_rows" para contar los usuarios que existen segun las filas de la base de datos.
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
        <h3>Listado</h3>
        <a href="new_user.php"><input type="button" name="new" value="Nuevo" class="button success"></a>
        <div class="section-container tabs" data-section>
          <section class="section">
            <div class="content" data-slug="panel1">
              <div class="row">
              </div>
              <?php 
                  if($total_users){ 
              ?>
              <table>
                <thead>
                  <tr>
                    <th width="200">ID</th>
                    <th width="250">Nombre</th>
                    <th width="250">Correo</th>
                    <th width="250"></th>
                    <th widht="250"></th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                      while($usuarios = mysqli_fetch_array($consulta)){//Se realiza un ciclo que iterara siempre y cuando la funcion "mysqli_fetch_array()" obtenga datos de la Base de Datos.

                      //Se imprimen los datos de todos los usuarios.

                      //En los botones Ver detalles y Eliminar, se les aregra un link el cual llevara a diferentes interface
                  ?>
                  <tr>

                    <td><?php echo $usuarios['id'];?></td>
                    <td><?php echo $usuarios['email']; ?></td>
                    <td><?php echo $usuarios['password']; ?></td>
                    <td><a <?php echo "href='details.php?id=$usuarios[id]'";?> class="button radius tiny secondary">Ver detalles</a></td>
                    <td><a <?php echo "href='delete_user.php?id=$usuarios[id]'"?>><input type="button" name="eliminar" value="Eliminar" onclick="alertaEliminar()" class="button radius tiny alert"></a></td>
                  </tr>
                  <?php 
                      } 
                  ?>
                  <tr>
                    <td colspan="4"><b>Total de registros: </b> <?php echo $total_users; ?></td>
                  </tr>
                </tbody>
              </table>
              <?php 
                  }else{ 
              ?>
              No hay registros
              <?php 
                  }
              ?>
            </div>
          </section>
        </div>
      </div>

    </div>
    

    <?php require_once('footer.php'); ?>

    <script type="text/javascript">
      //Funcion para escribir una alerta y validar si se desaea o no se desea eliminarlo
      function alertaEliminar(){
        var alerta = confirm("Seguro que desea eliminarlo?");
        if(alerta == false){
            event.preventDefault();
        }
      }
    </script>