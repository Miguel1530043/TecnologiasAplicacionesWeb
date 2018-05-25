<!--Es la plantilla que vera el usuario al ejecutar la aplicación -->
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="select2-4.0.6-rc.1/dist/css/select2.min.css">
	<script type="text/javascript" src="select2-4.0.6-rc.1/dist/js/select2.min.js"></script>
	<title>Practica 08</title>

	<style>
		h1{
			font-family: Century Gothic;
			color:#018fa8;
		}
		table{
			font-family: Century Gothic;
			border-color:#018fa8;
			border-radius:10px;

		}
		thead{
			color:#dfdfdf;
			background-color:#018FA8;
			
		}
		nav{
			position:relative;
			margin:auto;
			width:100%;
			height:auto;
			background:#018FA8;
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
<?php include "modules/navegacion.php"; ?>
<section>
<?php 
$mvc = new MvcCont();
$mvc -> linkPagesC();
 ?>
</section>
</body>
</html>