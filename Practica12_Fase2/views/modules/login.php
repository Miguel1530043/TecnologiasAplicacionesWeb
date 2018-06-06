<?php
    $MVC = new MvcController();
    session_start();
    if(isset($_SESSION["user"])){
        header("location: index.php?action=dashboard");
    }
?>

<body style="background-color:#001928">
    <div class="login-box">
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <div class="login-logo">
                    <img src="views/dist/img/images.png" style="width:100px;height:90px;">
                </div>
                <h3 class="login-box-msg">Sistema de Inventario</h3>

                <form method="post">
                    <div class="form-group has-feedback">
                        <input type="text" class="form-control" placeholder="Usuario" name="username" required>
                        <span class="fa fa-user form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <input type="password" class="form-control" placeholder="Password" name="password" required>
                        <span class="fa fa-lock form-control-feedback"></span>
                    </div>
                    <div class="row">
                        <div class="col-3">
                        </div>
                        <!-- /.col -->
                        <div class="col-6">
                            <button type="submit" class="btn btn-primary btn-block btn-flat" name="login" >Iniciar Sesion</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
                <?php
                    $MVC -> loginController();
                ?>


            </div>
        <!-- /.login-card-body -->
        </div>
    </div>
</body>

<?php
	$MVC = new MvcController();
	$MVC->loginController();
	
?>

