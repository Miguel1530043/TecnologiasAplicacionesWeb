<?php
    session_start();

	include("utilities.php");
	$id = $_GET['id'];
	sold_data($id);
	product_sold_data($id);
	$query = "SELECT COUNT(*) as ventas FROM venta_producto WHERE id_venta = $id";
	$statement=$pdo->prepare($query);
	$statement->execute();
	$ventas = $statement->fetchAll();
	$total_ventas = $ventas[0]['ventas'];

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
        <p style="font-size:30px">Detalle de Venta</p>
        <a href="ventas.php" class="button">Regresar</a>
        <div class="section-container tabs" data-section>
          <form method="POST">
	          <section class="section">
	            <table>
                        <thead>
                            <tr>
                                <th width="200">Producto</th>
                                <th width="250">Cantidad</th>
                                <th width="250">Monto</th>
                                <th width="250">Promedio</th>
                            </tr>
                        </thead>
                        <tbody>
                    <?php
                        $i=0;//Variable controladora del ciclo
                 
                        while($i<$total_ventas){//Mientras la variable $i sea menor al total de jugadores
                        	$id_producto = $result2[$i]['id_producto'];
                        	

                       		$query = "SELECT nombre FROM producto WHERE id = $id_producto";
							$statement=$pdo->prepare($query);
							$statement->execute();
							$producto = $statement->fetchAll();

							$monto = $result2[$i]['costo']/$result2[$i]['cantidad'];
                    ?>
                            <tr>
                                <!--Se realiza la impresion de los datos del jugador, en los botones se pasas por url la variable $id_player, para poder realizar la modificacion o eliminacion del jugador-->
                                <td> <?php echo $result2[$i]['id_producto']." - ".$producto[0]['nombre'];?> </td>
                                <td> <?php echo $result2[$i]['cantidad'];?> </td>
                                <td> <?php echo $result2[$i]['costo'];?> </td>
                                <td> <?php echo $monto;?></td>
                                
                            </tr>
                    <?php
                            
                            $i++;
                        }

                    ?>
                            <tr>
                                <td colspan="4"><b>Total: $ </b><?php echo $result[0]['monto'];//Se imprime el contador de jugadores de basket ball como el total de registros?></td>
                            </tr>
                        </tbody>
                    </table>
	            </div>
	          </section>
          </form>
        </div>
      </div>

    </div>
    

    <?php require_once('footer.php'); ?>