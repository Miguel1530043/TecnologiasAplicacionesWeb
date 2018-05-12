<?php

$dsn = 'mysql:dbname=practica06;host=localhost';//conexion al manejador de base de datos, nombre de la base de datos la cual se usuara, y servidor

$user = 'root';//Usuario del servidor de Base de Datos
$password = '';//Contraseña del servidor de base de datos

try{

    $pdo = new PDO( $dsn, 

                    $user, 

                    $password

    );

}catch( PDOException $e ){

    echo 'Error al conectarnos: ' . $e->getMessage();

}