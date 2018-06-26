<?php
  $mvc = new MvcController();
  session_destroy();

  echo"<script>
    window.location='index.php';
    </script>";
?>