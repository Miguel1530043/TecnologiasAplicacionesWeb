<?php
session_start();
include("utilities.php");

$query = "SELECT COUNT(*) as prodcutos FROM producto";//Consulta para determinar el numero de jugadores
    $statement = $pdo->prepare($query);//Declaracion de una variable la cual contendra la varibale que represetnara PDO en el archivo "connection.php" y recibira como parametro la consulta anterior
    $statement->execute();//Se ejecutara la consulta con PDO
    $res = $statement->fetchAll();//Se asigna el resultado de la consulta como un array asociativo
    $total_productos = $res[0]['prodcutos'];//El resultado del array en la fila 0,con el identificador de "total_players" se asigna a una variable, ya solo recogera el total(numero) de los jugadores

    $query = "SELECT * FROM producto";//Consulta para obtener todos los datos de la tabla sport
    $statement = $pdo->prepare($query);//Declaracion de una variable la cual contendra la varibale que represetnara PDO en el archivo "connection.php" y recibira como parametro la consulta anterior
    $statement->execute();//Se ejecutara la consulta con PDO
    $productos = $statement->fetchAll();//Se asigna el resultado de la consulta como un array asociativo

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
                <a href="ventas.php" class="button">Menu</a>
                <a href="ventas.php" class="button success">Reporte de Ventas</a>

                <div class="section-container tabs" data-section>
                    <section class="section">
                        <div class="content" data-slug="panel1">
                            <div class="row">
                            </div>
                            <h4>Productos</h4>
                            <input type="button" name="hola" value="Ocultar Productos" onclick="func()">
                            <input type="button" name="hola" value="Ver Productos" onclick="func2()">
                    <div id="p">
                    <form method="POST">




                <?php 
                    if($total_productos){//Si la variable total_player tiene un valor diferente de 0, null o vacio, se realiza la impresion de la tabla contenedora de la informacion de los jugadores 
                    	
                ?>	
                		<!--<select>-->
                <?php
                    	$i=0;//Variable controladora del ciclo
                    	while($i<$total_productos){//Mientras la variable $i sea menor al total de jugadores
    	            		$id_producto = $productos[$i]['id'];
                ?>

                			<div class="large-4 columns">
                			<!--<option><?php //echo $productos[$i]['nombre']." - Precio: $".$productos[$i]['precio'];?></option>-->
                			<label><?php echo "
                				<input type='checkbox' name='prod".$i."' value='$id_producto'/>".$productos[$i]['nombre']." - <b>Precio: $".$productos[$i]['precio']."</b>" ?></label>
                				<input min="1" type="number" name="<?php echo 'cant'.$i;?>" placeholder="Cantidad"/>
                			</div>
                 <?php 
             				$i++;
             			}

             	?>
             				<input type="submit" name="generar" value="Generar Venta" class="button tiny radius">
             			</form>
             			</div>
             			<!--</select>-->
             	<?php
             	  }else{
             	?>
              ?>
              No hay registros
              <?php 
                  }

              ?>
              		<?php
              			if(isset($_POST['generar'])){
              				$i=0;
              				$cont =0;
              				while($i<$total_productos){
              					
              					if(isset($_POST['prod'.$i]) && isset($_POST['cant'.$i])){
              						$cont++;
              						$idProd = $_POST['prod'.$i];
              						$query = "SELECT * FROM producto WHERE id = $idProd";
              						$statement = $pdo->prepare($query);
              						$statement->execute();
              						$resCons = $statement->fetchAll();

              						$cantidad = $_POST['cant'.$i];
              						if($cantidad==""||is_null($cantidad)){
              							$cantidad=1;
              						}
              						$monto = $cantidad * $resCons[0]['precio'];

              						$arreglo[]= ['id'=>$resCons[0]['id'],'nombre'=>$resCons[0]['nombre'],'precio'=>$resCons[0]['precio'],'cantidad'=>$cantidad,'total'=>$monto];
              					}
              					
              					$i++;
              				}
              		?>
              		<!--##################################################################################################-->
              				<form method="post" action="realizarVenta.php">
              					<h3>Venta</h3>
              					<table>
              						<thead>
                                    	<tr>
                                        	<th width="200">ID Producto</th>
                                        	<th width="250">Nombre</th>
                                        	<th width="250">Cantidad</th>
                                        	<th width="250">Total por Producto</th>
                                    	</tr>
                                	</thead>
                                	<tbody>
                                	<?php
                            			$i=0;
                            			$total=0;
                            			while($i<$cont){
                            		?>
	                            		<tr>
	                                        <!--Se realiza la impresion de los datos del jugador, en los botones se pasas por url la variable $id_player, para poder realizar la modificacion o eliminacion del jugador-->
	                                        <td><input type="text" name="<?php echo 'id'.$i?>"value="<?php echo $arreglo[$i]['id'] ?>"readonly></td>
	                                        <td><input type="text" name="<?php echo 'name'.$i?>" value="<?php echo $arreglo[$i]['nombre']?>" readonly></td>
	                                        <td><input type="text" name="<?php echo 'cantidad'.$i?>" value="<?php echo $arreglo[$i]['cantidad']?>" readonly> </td>
	                                        <td><input type="text" name="<?php echo 'montotal'.$i?>" value="<?php echo$arreglo[$i]['total']?>" readonly></td>
	                                        
	                                    </tr>
	                                <?php
											$total = $total+$arreglo[$i]['total'];
											$i++;
										}
									?>

                                    	<tr>
                                       		<td colspan="4"><b>Total a Pagar: </b>$<input readonly type="text" name="total" value="<?php echo $total;//Se imprime el contador de jugadores de basket ball como el total de registros?>"></td>
                                    	</tr>
                                    </tbody>
                            </table>

                            <input type="submit" name="venta" class="button tiny radius success" value="Realizar Venta">
                        </form>
              		<!--##################################################################################################-->



              		<?php
                        }
                   
                    ?>

                    <?php

              			if(isset($_POST['venta'])){
              				$fecha = date("y-m-d");
  							$total = $_POST['total'];
  							$query = "INSERT INTO venta(fecha,monto) VALUES ('$fecha',$total)";
  							$statement=$pdo->prepare($query);
  							$statement->execute();

  							$query = "SELECT id FROM venta WHERE id = (SELECT MAX(id)FROM venta)";
  							$statement=$pdo->prepare($query);
  							$statement->execute();
  							$maxid = $statement->fetchAll();
  							$idpv = $maxid[0]['id'];

              				$i=0;
              				while($i<$total_productos){
              					if(isset($_POST['id'.$i])){
              						$idproducto = $_POST['id'.$i];
              						$cantidadP = $_POST['cantidad'.$i];
              						$montotal = $_POST['montotal'.$i];
              						$query = "INSERT INTO venta_producto(id_venta,id_producto,cantidad,costo) VALUES ($idpv,$idproducto,$cantidadP,$montotal)";
  									$statement=$pdo->prepare($query);
  									$statement->execute();
              					}
              					$i++;
              				}
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
      function func(){
        document.getElementById('p').style.visibility="hidden";
      	
      }
      function func2(){
      	document.getElementById('p').style.visibility="visible";
      }
</script>