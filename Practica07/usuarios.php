<?
    session_start();
    include_once('utilities.php');//Llamado al archivo utilities.php el cual incluye las funciones y conexion a la base de datos

    $query = "SELECT COUNT(*) as usuarios FROM usuario";//Consulta para determinar el numero de jugadores
    $statement = $pdo->prepare($query);//Declaracion de una variable la cual contendra la varibale que represetnara PDO en el archivo "connection.php" y recibira como parametro la consulta anterior
    $statement->execute();//Se ejecutara la consulta con PDO
    $res = $statement->fetchAll();//Se asigna el resultado de la consulta como un array asociativo
    $total_usuarios = $res[0]['usuarios'];//El resultado del array en la fila 0,con el identificador de "total_players" se asigna a una variable, ya solo recogera el total(numero) de los jugadores

    $query = "SELECT * FROM usuario";//Consulta para obtener todos los datos de la tabla sport
    $statement = $pdo->prepare($query);//Declaracion de una variable la cual contendra la varibale que represetnara PDO en el archivo "connection.php" y recibira como parametro la consulta anterior
    $statement->execute();//Se ejecutara la consulta con PDO
    $usuarios = $statement->fetchAll();//Se asigna el resultado de la consulta como un array asociativo
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
                <a href="menu.php" class="button">Menu</a>
                <a href="registro.php" class="button success">Registrar Usuario</a>

                <div class="section-container tabs" data-section>
                    <section class="section">
                        <div class="content" data-slug="panel1">
                            <div class="row">
                            </div>
                <?php 
                    if($total_usuarios){//Si la variable total_player tiene un valor diferente de 0, null o vacio, se realiza la impresion de la tabla contenedora de la informacion de los jugadores 
                ?>
                           <h3>Usuarios</h3>
                           
                            <table>
                                <thead>
                                    <tr>
                                        <th width="200">ID</th>
                                        <th width="250">Nombre</TH>
                                        <th width="250"></th>
                                        <th widht="250"></th>
                                    </tr>
                                </thead>
                                <tbody>
                            <?php
                                $i=0;//Variable controladora del ciclo
                                while($i<$total_usuarios){//Mientras la variable $i sea menor al total de jugadores
                                 $id_usuario = $usuarios[$i]['id'];//Se asigna el id del jugador a una varibale.
                            ?>
                                    <tr>
                                        <!--Se realiza la impresion de los datos del jugador, en los botones se pasas por url la variable $id_player, para poder realizar la modificacion o eliminacion del jugador-->
                                        <td> <?php echo $usuarios[$i]['id'];?> </td>
                                        <td> <?php echo $usuarios[$i]['user_name'];?> </td>
                                        <td><a <?php echo "href='modificarUsuario.php?id=$id_usuario'"; ?> class="button radius tiny secondary">Ver detalles</a></td>
                                        <td><a <?php echo "href='eliminarUsuario.php?id=$id_usuario'"; ?> class="button radius tiny alert" onclick="alertaEliminar()">Eliminar</a></td>
                                    </tr>
                            <?php
                                    
                                    $i++;
                                }

                            ?>
                                    <tr>
                                        <td colspan="4"><b>Total de registros: </b><?php echo $i;//Se imprime el contador de jugadores de basket ball como el total de registros?></td>
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
    //Funcion para escribir una alerta y validar si se desaea realizar la accion de eliminar
      function alertaEliminar(){
        var alerta = confirm("Seguro que desea eliminarlo?");
        if(alerta == false){
            event.preventDefault();
        }
      }
</script>
