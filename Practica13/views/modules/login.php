<?php
    error_reporting(0);
    $MVC = new MvcController();
    session_start();
    if(isset($_SESSION["user"])){
        echo '<script>
            window.location="index.php?action=listar";
        </script>';
    }
?>

<body style="background-color:#001928">
    <div class="login-box">
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <h3 class="login-box-msg" style="color:white">Login</h3>
                <form method="post">
                    <div class="form-group has-feedback">
                        <input type="text" class="form-control" placeholder="Usuario" name="username" required>
                    </div>
                    <div class="form-group has-feedback">
                        <input type="password" class="form-control" placeholder="Password" name="password" required>
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

