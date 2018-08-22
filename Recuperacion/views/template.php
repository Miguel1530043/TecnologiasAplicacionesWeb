<?php
  error_reporting(0);
  date_default_timezone_set('America/Mexico_City');
   session_start();
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" type="text/css" href="views/materialize-1-dev/dist/css/materialize.css">
    <link rel="stylesheet" type="text/css" href="views/materialize-1-dev/dist/css/materialize.min.css">
    <link rel="stylesheet" type="text/css" href="views/DataTables/datatables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">

    <script type="text/javascript" src="views/materialize-1-dev/dist/js/materialize.min.js"></script>
    <script type="text/javascript" src="views/materialize-1-dev/dist/js/materialize.js"></script>
    <script type="text/javascript" src="views/materialize-1-dev/dist/js/jquery-3.3.1.js"></script>
    <script type="text/javascript" src="views/DataTables/datatables.js"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  </head>
  <body class="hold-transition sidebar-mini" style="background-color:#eeeeee">
    <?php
        include "views/modules/navegacion.php";
    ?>
    <section>
      <?php
         $mvc = new MvcController();

        //Se manda a llamar el controlador de las paginas
        $mvc->linkPageController();
      ?>
      <?php
        include "views/modules/footer.php";
      ?>
    </section>
</body>
</html>




<script type="text/javascript">


    document.addEventListener('DOMContentLoaded', function() {
        var elems = document.querySelectorAll('select');
        var instances = M.FormSelect.init(elems);
    });

    document.addEventListener('DOMContentLoaded', function() {
        var elems = document.querySelectorAll('.modal');
        var instances = M.Modal.init(elems);
    });

  
    $(document).ready(function() {
        $('#example').DataTable( {
            dom: 'Bfrtip',
        buttons: [
            {
                extend: 'print',
                title: document.getElementById('title').value
            }
        ]
        } );
    } );
    document.addEventListener('DOMContentLoaded', function() {
        var elems = document.querySelectorAll('.materialboxed');
        var instances = M.Materialbox.init(elems);
    });

    document.getElementById("foto").onchange = function(e) {
  // Creamos el objeto de la clase FileReader
      let reader = new FileReader();
  // Leemos el archivo subido y se lo pasamos a nuestro fileReader
      reader.readAsDataURL(e.target.files[0]);
  // Le decimos que cuando este listo ejecute el código interno
      reader.onload = function(){
        let preview = document.getElementById('verImagen'),
      image = document.createElement('img');
      image.width=200;
      image.height=200;
      image.src = reader.result;
      preview.innerHTML = '';
      preview.append(image);
      };
  }
   document.addEventListener('DOMContentLoaded', function() {
    var elems = document.querySelectorAll('.timepicker');
    var instances = M.Timepicker.init(elems);
    var instance = M.Timepicker.getInstance(elem);
    instance.open();
    instance.close();
    instance.showView("hours");
  });
 $('.timepicker').pickatime({
    default: 'now',
    twelvehour: false, // change to 12 hour AM/PM clock from 24 hour
    donetext: 'OK',
  autoclose: false,
  vibrate: true // vibrate the device when dragging clock hand
});

 
  


  // Or with jQuery
</script>
