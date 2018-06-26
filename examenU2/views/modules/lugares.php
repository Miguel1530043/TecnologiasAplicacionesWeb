<?php
    $mvc = new MvcController();
 if(isset($_SESSION["user"])){
    echo"<script>
      window.location='index.php?action=dashboard';
      </script>";
  }

?>

    <section class="content">
        <div class="card">
            <div class="card-header" style="background-color: purple">
                <div class="row">
                    <div class="col-6">
                        <label class="card-title" style="color:white;">Danzlife</label>
                    </div>
                    <div class="col-6" align="right" >
                        <a href="index.php" class="btn" style="color:white">Inicio</a>
                        <a href="index.php?action=lugares" class="btn" style="color:white">Lugares</a>
                    </div>
                </div>
            </div>
          <div class="row" align="center">
            <div class="col-1"></div>
                <div class="col-10">
              <h1 style="color:purple">Lugares</h1>
                    <table class="table table-bordered table-striped">
                        <thead style="background-color:purple;color:white">
                            <tr align="center">
                                <th>Folio</th>
                                <th>Alumna</th>
                                <th>Grupo</th>
                                <th>Nombre de la Madre</th>
                                <th>Fecha de Pago</th>
                                <th>Fecha de Envio</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $mvc ->showPaymentsController();
                            ?>                          
                        </tbody>
                    </table>
                </div>
            <div class="col-1"></div>
          </div>
            
        </div>
    </section>