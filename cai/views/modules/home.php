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
<?PHP
  echo "<h1>".date("H:i:s")."</h1>";
?>
</div>
<div class="row">
    <div class="col s6">
         <div class="card">
          <div class="card-header teal darken-4">
              <h3 style="color:white">
                Students in CAI
            </h3>
           </div>
           <div>
             <h3>
               0
             </h3>
           </div>
         </div>
    </div>
    <div class="col s6">
    <div class="card">
      <div class="card-header light-blue darken-4">
        <h3 style="color:white">
          Total Performed Activities
        </h3>
      </div>
      <div>
        <h3>
          120
        </h3>
      </div>
    </div>
  </div>
</div>

