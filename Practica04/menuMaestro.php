<?php
include_once('utilities.php');
//$user_access = [];
$i=0;
foreach ($user_access as $user) {//Se hace un ciclo para determinar cuantos registros de usuarios son alumnos
  if($user['ocupacion'] == 'M'){//Se verifica cada usuario que tenga la etiqueta en 'ocupacion' igual a 'M' para saber cuantos maestros hay
    $i=$i+1;//Se lleva un contador de los maestros
  }
}
$total_users = $i;//Se asigna el total de maestros a la variable $total_users
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
        <h3>Maestros</h3>
        <div>
          <p>Listado</p>
        </div>
        <div>
          <a href="formMaestro.php"><input type="button" name="form" value="Registrar" class="button"></a>
        </div>
        <div class="section-container tabs" data-section>
          <section class="section">
            <div class="content" data-slug="panel1">
              <div class="row">
              </div>
              <?php if($total_users){ ?>
              <table>
                <thead>
                  <tr>
                    <th width="200">ID</th>
                    <th width="250">Nombre</th>
                    <th width="250">Correo</th>
                    <th width="250">Acción</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach( $user_access as $id => $user ){ ?>
                  <tr>
                    <?php 
                      if($user['ocupacion']=='M'){//Se condiciona para saber si la etiqueta de 'ocupacion' es de un maestro
                    ?>
                      <td><?php echo $id ?></td>
                      <td><?php echo $user['name'] ?></td>
                      <td><?php echo $user['email'] ?></td>
                      <td><a href="./key.php?id=<?php echo $id; ?>" class="button radius tiny secondary">Ver detalles</a></td>
                    </tr>

                  <?php 
                      }
                    } 
                  ?>
                  <tr>
                    <td colspan="4"><b>Total de Maestros: </b> <?php echo $total_users; ?></td>
                  </tr>
                </tbody>
              </table>
              <?php }else{ ?>
              No hay registros
              <?php } ?>
            </div>
          </section>
        </div>
      </div>

    </div>
    

    <?php require_once('footer.php'); ?>