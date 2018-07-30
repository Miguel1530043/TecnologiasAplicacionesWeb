<?php
	$mvc = new MvcController();
		if(!isset($_SESSION["user"])){
  		echo"<script>
			window.location='index.php?action=login';
			</script>
		";
	}
  
	
?>
<div class="container" align ="center">
<h5>
<?php echo "Date: ".date("Y-m-d");?>
<br>
  <span>Time: </span>
  <span id="hora"></span>
  <span>:</span>
  <span id="minutos"></span>
  <span>:</span>
  <span id="segundos"></span>
</h5>
<?php
  if($_SESSION["user"]==1){
?>
<h1>WELCOME ADMINISTRATOR</h1>
</div>
<div class="row">
    <div class="col s4" align="center"> 
      <a href="index.php?action=teachers"><button class="waves-effect waves-light blue darken-4 btn modal-trigger btn btn-floating btn-large" style="width:200px;height:200px"><i class="material-icons" style="font-size:80px">person</i>TEACHERS</button></a>
    </div>
    <div class="col s4" align="center">
      <a href="index.php?action=alumnos"><button class="waves-effect waves-light red darken-4 btn modal-trigger btn btn-floating btn-large" style="width:200px;height:200px"><i class="material-icons" style="font-size:80px">group</i>STUDENTS</button></a>
    </div>
    <div class="col s4" align="center">
      <a href="index.php?action=grupos"><button class="waves-effect waves-light green darken-4 btn modal-trigger btn btn-floating btn-large" style="width:200px;height:200px"><i class="material-icons" style="font-size:80px">library_books</i>GROUPS</button></a>
    </div>
</div>
<?php
  }else{
    echo '<h1>WELCOME TEACHER</h1>
    <a href="index.php?action=grupos"><button class="waves-effect waves-light green darken-4 btn modal-trigger btn btn-floating btn-large" style="width:200px;height:200px"><i class="material-icons" style="font-size:80px">library_books</i>YOUR GROUPS</button></a>
      ';
  }
?>

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