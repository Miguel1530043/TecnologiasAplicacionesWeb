<?php
    require("utilities.php");    
if( isset($_COOKIE) &&is_array($_COOKIE) && count($_COOKIE)>0 && isset($_COOKIE['username']) && $_COOKIE['username']!=null){
    session_start();
    $_SESSION['username']=$_COOKIE['username'];

    
}

if(isset($_GET['action']) && $_GET['action']=='logout'){
    session_destroy();
    unset($_SESSION['username']);
    setcookie("username","",time()-3600);

}
if (isset($_POST['formu']) && $_POST['formu']['nombre']!="" && $_POST['formu']['pass']!=""){
    $username = $_POST['formu']['nombre'];           
    $password = $_POST['formu']['pass'];
    $encryptedPassword = md5($password);
    info($username,$encryptedPassword);
            
    if($username == $result[0]['user_name'] && $encryptedPassword == $result[0]['password']){
        $_SESSION['username']=$_POST['formu']['nombre'];
        setcookie("username", $_POST['formu']['nombre']);
        session_start();                   
    }
}
if(isset($_SESSION['username'])){
    header("location:menu.php");
}else{

?>

<!doctype html>
<html class="no-js" lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Pracitca 07</title>
        <link rel="stylesheet" href="./css/foundation.css" />
        <script src="./js/vendor/modernizr.js"></script>
    </head>
    <body style="font-family:Century Gothic;">
        <?php require_once('header.php'); ?>
    
        <div class="row" style="background-color:#d3d3d3;border-radius:10px">
            <div class="large-12 columns" align="center">
                <div class="section-container tabs" data-section>
                    <section class="section">
                        <div class="content" data-slug="panel1">
                            <div>
                                <form action="index.php" name="formu" method="post">                       
                                    <label style="font-size:30px">User Name <input type="text" name="formu[nombre]" style="width:400px;border-radius:5px"/></label>
                                    <label style="font-size:30px">Password <input type="password" name="formu[pass]" style="width:400px;border-radius:5px"/></label>
                                    <input type="submit" class="button success" value="Iniciar Sesion" style="border-radius:10px"/></br>
                                    
                                </form>
                            </div>
                    </section>
                </div>
            </div>
        </div>
    

    <?php }
    require_once('footer.php'); 
    ?>
