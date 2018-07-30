
<?php
    if($_SESSION["user"] == "admin"){
?>
<section class="content">
    <nav>
    	<div class="nav-wrapper light-blue darken-4">
    		<a href="index.php?action=home" class="brand-logo">C<label style="font-size:20px">ENTRO DE </label> A<label style="font-size:20px">PRENDIZAJE DE </label> I<label style="font-size:20px">DIOMAS</label></a>
    		<ul class="right hide-on-med-and-down ">
                <li class="grey"><a href="index.php?action=home">Home</a></li>
    			<li class="grey"><a href="index.php?action=teachers" >Teachers</a></li>
    			<li class="grey"><a href="index.php?action=alumnos" >Students</a></li>
    			<li class="grey"><a href="index.php?action=grupos">Groups</a></li>
    			<li class="grey darken-1"><a href="index.php?action=logout" class="material-icons" style="height:50px">exit_to_app</a></li>
    		</ul>
    	</div>
    </nav>
</section>
<?php
    }else if($_SESSION["user"]!="admin"){
?>
<section class="content">
    <nav>
        <div class="nav-wrapper light-blue darken-4">
            <a href="index.php?action=home" class="brand-logo">C<label style="font-size:20px">ENTRO DE </label> A<label style="font-size:20px">PRENDIZAJE DE </label> I<label style="font-size:20px">DIOMAS</label></a>
            <ul class="right hide-on-med-and-down ">
                <li class="grey"><a href="index.php?action=home">Home</a></li>
                <li class="grey"><a href="index.php?action=grupos">My Groups</a></li>
                <li class="grey darken-1"><a href="index.php?action=logout" class="material-icons" style="height:50px">exit_to_app</a></li>
            </ul>
        </div>
    </nav>
</section>
<?php
    }
?>