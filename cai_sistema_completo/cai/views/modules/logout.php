<?php
  $mvc = new MvcController();
  unset($_SESSION["user"]);

  echo"<script>
    window.location='index.php';
    </script>";
?>