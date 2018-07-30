<?php
  date_default_timezone_set('America/Mexico_City');
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

    <script type="text/javascript" src="views/materialize-1-dev/dist/js/materialize.min.js"></script>
    <script type="text/javascript" src="views/materialize-1-dev/dist/js/materialize.js"></script>
    <script type="text/javascript" src="views/materialize-1-dev/dist/js/jquery-3.3.1.js"></script> 
    <script src="jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="views/DataTables/datatables.js"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  </head>
  <body class="hold-transition sidebar-mini">
    <?php
      if(isset($_SESSION["user"])){
        include "views/modules/navegacion.php";
      }
      
    ?>
    <section>
      <?php
         $mvc = new MvcController();
        //Se manda a llamar el controlador de las paginas
        $mvc->linkPageController();
      ?>
    </section>
</body>
</html>




<script type="text/javascript">
    function imprimir(id){
      document.getElementById("imp").style.visibility="hidden";
      var div = "3"+id;
      var prtContent = document.getElementById(div);
      
      var WinPrint = window.open('', '', 'left=0,top=0,width=800,height=900,toolbar=0,scrollbars=0,status=0');
      WinPrint.document.write('<html><head>');

      WinPrint.document.write(prtContent.innerHTML);
      WinPrint.document.close();
      WinPrint.focus();
      WinPrint.print();
      WinPrint.close();
    }


    document.addEventListener('DOMContentLoaded', function() {
        var elems = document.querySelectorAll('select');
        var instances = M.FormSelect.init(elems);
    });

    document.addEventListener('DOMContentLoaded', function() {
        var elems = document.querySelectorAll('.modal');
        var instances = M.Modal.init(elems);
    });

    $(document).ready(function() {
        $('#example').DataTable();
    });

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
