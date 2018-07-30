<?php
    $MVC = new MvcController();
    if(isset($_SESSION["user"])){
        header("location: index.php?action=home");
    }
?>

<body style="background-color:#D9D9D9">
    <div class="container" align="center">
        <!-- /.login-logo -->
        <br>
            <div class="card">
                <div class="card-body login-card-body">
                    <br><br>
                    <h4 class="login-box-msg" style="color:gray">Centro de <br>Aprendizaje de Idiomas</h4>
                    <form method="post" class="col s12">
                        <div class="row">
                            <div class="col s2"></div>
                            <div class="input-field col s8">
                                <input type="text" name="email" required>
                                <label for="email">E-mail</label>
                               
                            </div>
                        </div>
                        <div class="row">
                            <div class="col s2"></div>
                            <div class="input-field col s8">
                                <input type="password"  name="password" required>
                                <label for="password">Password</label>
                                
                            </div>
                         </div>
                            <div class="input-field col s8">
                                <button type="submit" class="waves-effect waves-light btn-large blue darken-4" name="login">Iniciar Sesion</button>
                            </div>
                            
                            <br><br>
                            </div>
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

