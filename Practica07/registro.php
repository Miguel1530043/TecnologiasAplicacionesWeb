<?php
session_start();
    require("./utilities.php");
    
    if(isset($_POST["registrar"])){
        $name = $_POST['username'];
        $pass = $_POST['password'];
        $passC = $_POST['passwordC'];
        if($pass == $passC){
            $passEncrypted = md5($pass);
            add_user($name,$passEncrypted);
        }else{
            echo "Error al confirmar conraseñas";
        
        }
        
    
    }

?>



<!doctype html>
<html class="no-js" lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Pracitca 06</title>
        <link rel="stylesheet" href="./css/foundation.css" />
        <script src="./js/vendor/modernizr.js"></script>
    </head>
    <body style="font-family:Century Gothic;">
        <?php require_once('header.php'); ?>
    
        <div class="row" style="background-color:#d3d3d3;border-radius:10px">
            <div class="large-12 columns" align="center">
                <div class="section-container tabs" data-section>
                    <section class="section">
                        <div class="content" data-slug="panel1">
                            <div>
                                <form method="POST" action="registro.php">
                                    <h3>Registro de usuario</h3>
                                    <label style="font-size:30px">User Name <input type="text" name="username" style="width:400px;border-radius:5px"/></label>
                                    <label style="font-size:30px">Password <input type="password" name="password" id="password" style="width:400px;border-radius:5px"/></label>
                                    <label style="font-size:30px">Confirm Password <input onfocus="comparacion()" onblur="comparacion()" type="password" name="passwordC" id="passwordC" style="width:400px;border-radius:5px"/></label>
                                    <label name="error" id="error"></label>
                                    <input type="submit" name="registrar" id="registrar" class="button success" value="Registrarse" style="border-radius:10px"/></br>
                               </form>
                    </section>
                </div>
            </div>
        </div>
    </body>
</html>
        
    

    <?php require_once('footer.php'); ?>

