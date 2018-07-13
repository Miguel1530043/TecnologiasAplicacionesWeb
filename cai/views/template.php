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
   function show5(){
        if (!document.layers&&!document.all&&!document.getElementById)
        return

         var Digital=new Date()
         var hours=Digital.getHours()
         var minutes=Digital.getMinutes()
         var seconds=Digital.getSeconds()

        var dn="PM"
        if (hours<12)
        dn="AM"
        if (hours>12)
        hours=hours-12
        if (hours==0)
        hours=12

         if (minutes<=9)
         minutes="0"+minutes
         if (seconds<=9)
         seconds="0"+seconds
        //change font size here to your desire
        myclock="<font size='5' face='Arial' ><b><font size='1'>Hora actual:</font></br>"+hours+":"+minutes+":"
         +seconds+" "+dn+"</b></font>"
        if (document.layers){
        document.layers.liveclock.document.write(myclock)
        document.layers.liveclock.document.close()
        }
        else if (document.all)
        liveclock.innerHTML=myclock
        else if (document.getElementById)
        document.getElementById("liveclock").innerHTML=myclock
        setTimeout("show5()",1000)
  }


        window.onload=show5

  // Or with jQuery
</script>
