<?php
    session_start();
    require("utilities.php");
    $id=$_GET['id'];
    delete_user($id);
    header("location: usuarios.php");

?>