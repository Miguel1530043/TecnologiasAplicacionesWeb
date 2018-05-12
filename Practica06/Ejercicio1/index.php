<?php
    include("../db/connection.php");//Manda llamar la conexión a la base de datos
    
    //TOTAL DE USUARIOS
    $query = "SELECT COUNT(*) as total_users FROM user";//Se declara una variable que contendra la cadena de la consulta para obtener el total de usuarios
    $statement = $pdo->prepare($query);//Declaracion de una variable la cual contendra la varibale que represetnara PDO en el archivo "connection.php" y recibira como parametro la consulta anterior
    $statement->execute();//Se ejecutara la consulta con PDO
    $results = $statement->fetchAll();//Se asigna el resultado de la consulta como un array asociativo
    $total_users = $results[0]['total_users'];//El resultado del array en la fila 0,con el identificador de "total_users" se asigna a una variable, ya solo recogera el total(numero) de los usuarios 

    //TOTAL DE TIPOS DE USURIOS
    $query = "SELECT COUNT(*) as total_users_type FROM user_type";//Se declara una variable que contendra la cadena de la consulta para obtener el total de tipos de usuarios
    $statement = $pdo->prepare($query);//Declaracion de una variable la cual contendra la varibale que represetnara PDO en el archivo "connection.php" y recibira como parametro la consulta anterior
    $statement->execute();//Se ejecutara la consulta con PDO
    $results = $statement->fetchAll();//Se asigna el resultado de la consulta como un array asociativo
    $total_users_type = $results[0]['total_users_type'];//El resultado del array en la fila 0,con el identificador de "total_users_type" se asigna a una variable, ya solo recogera el total(numero) de los tipos de usuarios 

    //TOTAL DE STAUTS
    $query = "SELECT COUNT(*) as total_status FROM status";//Se declara una variable que contendra la cadena de la consulta para obtener el total de status
    $statement = $pdo->prepare($query);//Declaracion de una variable la cual contendra la varibale que represetnara PDO en el archivo "connection.php" y recibira como parametro la consulta anterior
    $statement->execute();//Se ejecutara la consulta con PDO
    $results = $statement->fetchAll();//Se asigna el resultado de la consulta como un array asociativo
    $total_status = $results[0]['total_status'];//El resultado del array en la fila 0,con el identificador de "total_status" se asigna a una variable, ya solo recogera el total(numero) de los status

    //TOTAL DE USUARIOS LOGGEADOS
    $query = "SELECT COUNT(*) as total_logged FROM user_log";//Se declara una variable que contendra la cadena de la consulta para obtener el total de usuarios loggeados
    $statement = $pdo->prepare($query);//Declaracion de una variable la cual contendra la varibale que represetnara PDO en el archivo "connection.php" y recibira como parametro la consulta anterior
    $statement->execute();//Se ejecutara la consulta con PDO
    $results = $statement->fetchAll();//Se asigna el resultado de la consulta como un array asociativo
    $total_logged = $results[0]['total_logged'];//El resultado del array en la fila 0,con el identificador de "total_logged" se asigna a una variable, ya solo recogera el total(numero) de los usuarios loggeados

    //TOTAL DE USUARIOS ACTIVOS
    $query = "SELECT COUNT(*) as total_active_users FROM user where status_id = 1";//Se declara una variable que contendra la cadena de la consulta para obtener el total de usuarios activos
    $statement = $pdo->prepare($query);//Declaracion de una variable la cual contendra la varibale que represetnara PDO en el archivo "connection.php" y recibira como parametro la consulta anterior
    $statement->execute();//Se ejecutara la consulta con PDO
    $results = $statement->fetchAll();//Se asigna el resultado de la consulta como un array asociativo
    $total_active_users = $results[0]['total_active_users'];//El resultado del array en la fila 0,con el identificador de "total_active_users" se asigna a una variable, ya solo recogera el total(numero) de los usuarios activos

    //TOTAL DE USUARIOS INACTIVOS
    $query = "SELECT COUNT(*) as total_inactive_users FROM user WHERE status_id <>1";//Se declara una variable que contendra la cadena de la consulta para obtener el total de usuarios inactivos
    $statement = $pdo->prepare($query);//Declaracion de una variable la cual contendra la varibale que represetnara PDO en el archivo "connection.php" y recibira como parametro la consulta anterior
    $statement->execute();//Se ejecutara la consulta con PDO
    $results = $statement->fetchAll();//Se asigna el resultado de la consulta como un array asociativo
    $total_inactive_users = $results[0]['total_inactive_users'];//El resultado del array en la fila 0,con el identificador de "total_inactive_users" se asigna a una variable, ya solo recogera el total(numero) de los usuarios inactivos

    //DATOS TABLA USUARIOS
    $query = "SELECT *  FROM user";//Se declara una variable que contendra la cadena de la consulta para obtener todo el contenido de la tabla usuario
    $statement = $pdo->prepare($query);//Declaracion de una variable la cual contendra la varibale que represetnara PDO en el archivo "connection.php" y recibira como parametro la consulta anterior
    $statement->execute();//Se ejecutara la consulta con PDO
    $user = $statement->fetchAll();//Se asigna el resultado de la consulta como un array asociativo

    //DATOS TABLA STATUS
    $query = "SELECT *  FROM status";//Se declara una variable que contendra la cadena de la consulta para obtener todo el contenido de la tabla status
    $statement = $pdo->prepare($query);//Declaracion de una variable la cual contendra la varibale que represetnara PDO en el archivo "connection.php" y recibira como parametro la consulta anterior
    $statement->execute();//Se ejecutara la consulta con PDO
    $status = $statement->fetchAll();//Se asigna el resultado de la consulta como un array asociativo

    $query = "SELECT s.name  FROM user as u INNER JOIN status as s WHERE u.status_id = s.id";//Se realiza esta consulta para saber cual es el status de cada usuario, esta consulta se realiza para poder mostrar mejor el contenido de las tablas
    $statement = $pdo->prepare($query);//Declaracion de una variable la cual contendra la varibale que represetnara PDO en el archivo "connection.php" y recibira como parametro la consulta anterior
    $statement->execute();//Se ejecutara la consulta con PDO
    $user_status = $statement->fetchAll();//Se asigna el resultado de la consulta como un array asociativo

    
    //DATOS TABLE USER LOG
     $query = "SELECT *  FROM user_log";//Se declara una variable que contendra la cadena de la consulta para obtener todo el contenido de la tabla user_log
    $statement = $pdo->prepare($query);//Declaracion de una variable la cual contendra la varibale que represetnara PDO en el archivo "connection.php" y recibira como parametro la consulta anterior
    $statement->execute();//Se ejecutara la consulta con PDO
    $log = $statement->fetchAll();//Se asigna el resultado de la consulta como un array asociativo

    $query = "SELECT u.email  FROM user as u INNER JOIN user_log as l WHERE u.id = l.user_id";//Se realiza esta consulta para saber cuando se ha loggeado un usuario, esta consulta se realiza para poder mostrar de una mejor manera el contenido de las tablas
    $statement = $pdo->prepare($query);//Declaracion de una variable la cual contendra la varibale que represetnara PDO en el archivo "connection.php" y recibira como parametro la consulta anterior
    $statement->execute();//Se ejecutara la consulta con PDO
    $user_log = $statement->fetchAll();//Se asigna el resultado de la consulta como un array asociativo


    //DATOS TABLE USER TYPE
    $query = "SELECT *  FROM user_type";//Se declara una variable que contendra la cadena de la consulta para obtener todo el contenido de la tabla user_type
    $statement = $pdo->prepare($query);//Declaracion de una variable la cual contendra la varibale que represetnara PDO en el archivo "connection.php" y recibira como parametro la consulta anterior
    $statement->execute();//Se ejecutara la consulta con PDO
    $type = $statement->fetchAll();//Se asigna el resultado de la consulta como un array asociativo

    $query = "SELECT t.name FROM user AS u INNER JOIN user_type AS t WHERE u.user_type_id = t.id";//Se realiza esta consulta para saber que tipo de usuario es cada usuario, esta consulta se raliza con el proposito de poder mostrar de una mejor manera las tablas
    $statement = $pdo->prepare($query);//Declaracion de una variable la cual contendra la varibale que represetnara PDO en el archivo "connection.php" y recibira como parametro la consulta anterior
    $statement->execute();//Se ejecutara la consulta con PDO
    $user_type = $statement->fetchAll();//Se asigna el resultado de la consulta como un array asociativo
   

?>

<!doctype html>
<html class="no-js" lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Practica 06 | Ejercicio N°1</title>
        <link rel="stylesheet" href="../css/foundation.css" />
        <script src="../js/vendor/modernizr.js"></script>
    </head>
    <body>
        <?php require_once('header.php'); ?>
        
        <div class="row"> 
            <div class="large-12 columns" align="center">
                <div class="section-container tabs" data-section>
                    <section class="section">
                        <div class="content" data-slug="panel1">
                            <div class="row">
                                <H1>TOTAL</H1>
                                <table>
                                    <thead>
                                        <tr>
                                            <th width="200">Usuarios</th>
                                            <th width="250">Tipos</th>
                                            <th width="250">Status</th>
                                            <th width="250">Accesos</th>
                                            <th widht="250">Usuarios Activos</th>
                                            <th widht="250">Usuarios Inactivos</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr> 
                                            <!--Impresion del total del conteo de todas los usuarios, tipos de usuarios, status, log de usuarios, activos e inactivos-->
                                            <td><?php echo $total_users;?></td>
                                            <td><?php echo $total_users_type;?></td>
                                            <td><?php echo $total_status;?></td>
                                            <td><?php echo $total_logged;?></td>
                                            <td><?php echo $total_active_users;?></td>
                                            <td><?php echo $total_inactive_users;?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                    </section>

                    <!--#########################TABLA DE USUARIOS#########################33-->
                    <section class="section">
                        <h3>Contenido Tabla Usuarios</h3>
                         <div class="content" data-slug="panel1">
                            <div class="row">
                                <table>
                                    <thead>
                                        <tr>
                                            <th width="200">ID</th>
                                            <th width="250">E-Mail</th>
                                            <th width="250">Password</th>
                                            <th width="250">Stauts</th>
                                            <th widht="250">UserType</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $i=0;//Variable controladora del ciclo
                                            while($i<$total_users){//Mientras la variable que controla el ciclo sea menor al numero total de usuarios se impirmiran los resultados de la tabla user
                                        ?>
                                            <tr> 
                                                <td><?php echo $user[$i]['id']?></td>
                                                <td><?php echo $user[$i]['email'];?></td>
                                                <td><?php echo $user[$i]['password'];?></td>
                                                <td><?php echo $user[$i]['status_id']. " - " . $user_status[$i]['name'];?></td>
                                                <td><?php echo $user[$i]['user_type_id']. " - " . $user_type[$i]['name'];?></td>
                                            </tr>
                                        <?php
                                            $i++;
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                    </section>

                     <!--#########################TABLA DE STATUS#########################33-->
                    <section class="section">
                        <h3>Contenido Tabla Status</h3>
                         <div class="content" data-slug="panel1">
                            <div class="row">
                                <table>
                                    <thead>
                                        <tr>
                                            <th width="200">ID</th>
                                            <th width="250">Nombre</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $i=0;//variable controladora del ciclo
                                            while($i<$total_status){//Mientras la variable que controla el ciclo sea menor al numero total de usuarios se impirmiran los resultados de la tabla status
                                        ?>
                                            <tr> 
                                                <td><?php echo $status[$i]['id']?></td>
                                                <td><?php echo $status[$i]['name'];?></td>
                                            </tr>
                                        <?php
                                            $i++;
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                    </section>
                    <!--#########################TABLA DE STATUS#########################33-->
                    <section class="section">
                        <h3>Contenido Tabla User Log</h3>
                         <div class="content" data-slug="panel1">
                            <div class="row">
                                <table>
                                    <thead>
                                        <tr>
                                            <th width="200">ID</th>
                                            <th width="250">Fecha de Sesion</th>
                                            <th width="250">Usuario</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $i=0;//variable controladora del ciclo
                                            while($i<$total_logged){//Mientras la variable que controla el ciclo sea menor al numero total de usuarios se impirmiran los resultados de la tabla user_log
                                        ?>
                                            <tr> 
                                                <td><?php echo $log[$i]['id']?></td>
                                                <td><?php echo $log[$i]['date_logged_in'];?></td>
                                                <td><?php echo $log[$i]['user_id'] . " - " . $user_log[$i]['email'];?></td>
                                            </tr>
                                        <?php
                                            $i++;
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                    </section>

                     <!--#########################TABLA DE USER TYEP#########################33-->
                    <section class="section">
                        <h3>Contenido Tabla User Type</h3>
                         <div class="content" data-slug="panel1">
                            <div class="row">
                                <table>
                                    <thead>
                                        <tr>
                                            <th width="200">ID</th>
                                            <th width="250">Nombre</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $i=0;//variable controladora del ciclo
                                            while($i<$total_status){//Mientras la variable que controla el ciclo sea menor al numero total de usuarios se impirmiran los resultados de la tabla status
                                        ?>
                                            <tr> 
                                                <td><?php echo $type[$i]['id']?></td>
                                                <td><?php echo $type[$i]['name'];?></td>
                                            </tr>
                                        <?php
                                            $i++;
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                    </section>
                </div>
            </div>
        </div>
    <?php require_once('footer.php'); ?>