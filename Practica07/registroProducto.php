<?php
    session_start();
   require("utilities.php");
    if(isset($_POST['registrar'])){
        $id = $_POST['id'];
        $name = $_POST['name'];
        $price = $_POST['price'];
        
        add_product($id,$name,$price);
        header("location:productos.php");
    
    }


?>

<!doctype html>
<html class="no-js" lang="en">
    <head>
        <meta charset="ut
        f-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Pracitca 06</title>
        <link rel="stylesheet" href="./css/foundation.css" />
        <script src="./js/vendor/modernizr.js"></script>
    </head>
    <body style="font-family:Century Gothic;">
        <?php require_once('header.php'); ?>
    
        <div class="row" style="background-color:#d3d3d3;border-radius:10px">
        <a href="productos.php" class="button tiny radius">Regresar</a>
            <div class="large-12 columns" align="center">
            
                <div class="section-container tabs" data-section>
                    <section class="section">
                        <div class="content" data-slug="panel1">
                            <div>
                                <h3>Registro de Productos</h3>
                                <form action="registroProducto.php" method="post">                       
                                    <label style="font-size:30px">Codigo(id) <input type="text" name="id" style="width:400px;border-radius:5px"/></label>
                                    <label style="font-size:30px">Nombre <input type="text" name="name" style="width:400px;border-radius:5px"/></label>
                                    <label style="font-size:30px">Precio <input type="text" name="price" style="width:400px;border-radius:5px"/></label>
                                    <input type="submit" class="button success" value="Registrar" name="registrar" style="border-radius:10px"/></br>
                                    
                                </form>
                            </div>
                    </section>
                </div>
            </div>
        </div>
     </body>
</html>
    

    <?php require_once('footer.php'); ?>
