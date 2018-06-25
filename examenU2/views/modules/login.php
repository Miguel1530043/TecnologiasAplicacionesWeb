<?php
    $mvc = new MvcController();
    //session_start();
    if(isset($_SESSION["user"])){
        echo '<script>
            window.location="index.php?action=dashboard";
        </script>';
    }
?>
<body style="background-color:#DFDFDF">
    <div class="login-box">
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body" align="center">
                
                <img src="views/dist/img/danzlife.jpeg" style="width:200px;height:150px">

                <form method="post">
                    <div class="form-group has-feedback">
                        <input type="text" class="form-control" placeholder="Usuario" name="usuario" required>
                    </div>
                    <div class="form-group has-feedback">
                        <input type="password" class="form-control" placeholder="Password" name="password" required>
                       
                    </div>
                    <div class="row">
                        <div class="col-3">
                        </div>
                        <!-- /.col -->
                        <div class="col-6">
                            <button type="submit" class="btn btn-primary btn-block btn-flat" style="background-color: purple;" name="login" >Iniciar Sesion</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
                 <?php
                    $mvc -> loginController();
                ?>
            </div>
        <!-- /.login-card-body -->
        </div>
    </div>
</body>

