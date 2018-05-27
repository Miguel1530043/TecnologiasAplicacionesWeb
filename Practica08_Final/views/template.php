<!--Es la plantilla que vera el usuario al ejecutar la aplicación -->
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>Practica 08</title>
   <link rel="stylesheet" type="text/css" href="views/css/select2.css">
   <link rel="stylesheet" type="text/css" href="views/css/select2.min.css">
   <script src="views/js/jquery-3.3.1.js"></script>
   <script src="views/js/select2.js"></script>
   <script src="views/js/select2.min.js"></script>
   <link rel="stylesheet" type="text/css" href="views/css/datatables.min.css"/>
	<script type="text/javascript" src="views/js/datatables.min.js"></script>
	<link rel="stylesheet" type="text/css" href="views/css/datatables.css"/>
	<script type="text/javascript" src="views/js/datatables.js"></script>
	<script type="text/javascript" src="views/js/jquery.dataTables.min.js"></script>
	<link rel="stylesheet" type="text/css" href="views/css/jquery.dataTables.min.css">
	<style>
		h1{
			font-family: Century Gothic;
			color:#018fa8;
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