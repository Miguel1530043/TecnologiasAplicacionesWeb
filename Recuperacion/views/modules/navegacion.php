<section class="content">
    <nav >
    	<div class="nav-wrapper pink darken-4">	
            <a href="index.php" class="brand-logo">Punto de Venta</a>
    		<ul class="right hide-on-med-and-down ">
                <li><a href="index.php"><i class="material-icons">home</i></a></li>
                <li><a href='index.php?action=articulos'>Articulos</a></li>
                <li><a href='index.php?action=comprar'>Comprar</a></li>
                <li><a href='index.php?action=vender'>Vender</a></li>
                <li><a href='index.php?action=inventario'>Inventario</a></li>
                <li>
                    <a class='dropdown-trigger pink accent-4 btn-large' href='#' >
                        <?php echo "Fecha: ".date("Y-m-d");?>
                    </a>
                </li>
                <li>
                    <a class='dropdown-trigger pink accent-4 btn-large' href='#' >
                        <span>Hora: </span>
                        <span id="hora"></span>
                        <span>:</span>
                        <span id="minutos"></span>
                        <span>:</span>
                        <span id="segundos"></span>
                    </a>
                </li>
    		</ul>
    	</div>
    </nav>
</section>


<script>
  function hora(){
    var date = new Date();
    var h = date.getHours();
    var m = date.getMinutes();
    var s = date.getSeconds();

    var hora = document.getElementById('hora');
    var minutos = document.getElementById('minutos');
    var segundos = document.getElementById('segundos');

    if(h<10){
    h = "0"+h;
  };
  if(m<10){
    m = "0"+m;
  };
  if(s<10){
    s = "0"+s;
  };

    hora.textContent = h;
    minutos.textContent=m;
    segundos.textContent=s;
  }
  

  hora();
  var repetir = setInterval(hora,1000);


</script>