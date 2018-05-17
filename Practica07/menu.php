<?php
    session_start();
?>


<!doctype html>
<html class="no-js" lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Pracitca 07</title>
        <link rel="stylesheet" href="./css/foundation.css" />
        <script src="./js/vendor/modernizr.js"></script>
    </head>
    <body>
        <?php require_once('header.php'); ?>
    	
        <div class="row">
        	<a href="index.php?action=logout" class="button tiny raduis alert">Log Out</a>
            <div class="large-12 columns" align="center">
                <div class="section-container tabs" data-section>
                    <section class="section">
                        <div class="content" data-slug="panel1">
                            <div class="row">
                                </br><a href="ventas.php"><input type="button" name="ex1" class="button" value="Ventas" style="width:300px;height:100px;font-size:30px; border-radius:10px"></a></br>
                                </br><a href="productos.php"><input type="button" name="ex2" class="button" value="Productos" style="width:300px;height:100px;font-size:30px; border-radius:10px"></a></br>
                                </br><a href="usuarios.php"><input type="button" name="ex2" class="button" value="Usuarios" style="width:300px;height:100px;font-size:30px; border-radius:10px"></a></br></br></br>
                            </div>
                    </section>
                </div>
            </div>
        </div>
    

    <?php require_once('footer.php'); ?>