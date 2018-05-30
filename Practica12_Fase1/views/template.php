<!--Es la plantilla que vera el usuario al ejecutar la aplicación -->
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>Practica 12</title>
	<style>



		.container{

			margin:auto;
			height: 300px;
			width: auto;


		}
		input{
			font-family: Century Gothic;
		}

		input[type=email]{
			width: 400px;
			height: 25px;
			border-radius:10px;
		}	

		input[type=password]{
			width: 400px;
			height: 25px;
			border-radius:10px;
		}	

		input[type=submit]{
			width: 200px;
			height: 40px;
			border-radius: 10px;
			border-color:#C0392B;
			background-color:#C0392B;
			color:#FFFFFF;
		}
		input[type=submit]:hover{
			border-radius:10px;
			border-color:#7B241C;
			background-color:#7B241C;
			color:#FFFFFF;
		}

		h1{
			font-family: Century Gothic;
			color:#C0392B  ;
		}
		nav{
			position:relative;
			margin:auto;
			width:100%;
			height:auto;
			background:#C0392B;
		}

		nav ul{
			position:relative;
			margin:auto;
			width:50%;
			text-align: center;
		}

		nav ul li{
			display:inline-block;
			width:24%;
			line-height: 50px;
			list-style: none;
		}

		nav ul li a{
			font-family:Century Gothic;
			color:#dfdfdf;
			text-decoration: none;
		}

		section{
			position: relative;
			margin: auto;
			width:400px;
		}

		section h1{
			position: relative;
			margin: auto;
			padding:10px;
			text-align: center;
		}

		section form{
			position:relative;
			margin:auto;
			width:400px;
		}

		section form input{
			display:inline-block;
			padding:10px;
			width:95%;
			margin:5px;
		}

		section form input[type="submit"]{
			position:relative;
			margin:20px auto;
			left:4.5%;

		}

		table{
			position:relative;
			margin:auto;
			width:100%;
			left:-10%;
		}

		table thead tr th{
			padding:10px;
		}

		table tbody tr td{
			padding:10px;
		}
	</style>

</head>
<body>
<?php 
	session_start();
	if(isset($_SESSION['user'])){
		include "modules/navigation.php";
	}
?>
<section>
<?php 
$MVC = new MvcController();
$MVC -> linkPageController();
 ?>
</section>
</body>
</html>