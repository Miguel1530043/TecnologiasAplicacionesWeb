<?php
    session_start();
    require("utilities.php");
    $id=$_GET['id'];
    delete_product($id);
    header("location: productos.php");

?>
