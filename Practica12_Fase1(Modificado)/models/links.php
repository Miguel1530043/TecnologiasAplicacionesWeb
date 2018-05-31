<?php 
class Pages{
	public static function linkPagesM($link){
		$module =  "views/modules/".$link.".php";
		if($link == "index"){
			$module =  "views/modules/login.php";
		}
		return $module;
	}
}

?>