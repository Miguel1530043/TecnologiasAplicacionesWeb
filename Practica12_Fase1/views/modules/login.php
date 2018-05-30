
<div class="container">
	<H1>INICIO DE SESION</H1>
	<div align="center">
		<form method="post">
			<input type="email" name="email" placeholder="Correo Electronico"><br><br>
			<input type="password" name="password" placeholder="Contraseña"><br><br>
			<input type="submit" name="login" value="Ingresar" align="center">
		</form>
	</div>
	<?php
		$MVC = new MvcController();
		$MVC->loginController();
		
	?>

</div>