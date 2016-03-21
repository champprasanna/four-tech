<?php
	 @session_start();
	 define("SITE_NAME", "http://localhost/four-tech/");
//	 define("SITE_NAME", "http://www.fourtech.com/");
	 $strAction = (isset($_GET['action']) && trim($_GET['action']) != '') ? trim($_GET['action']) : "home" ;
	 //include("includes/functions.php");	
	 $arrValidActions = array("home","aboutus","products","services","facilities","contact");
	 
	 if(!in_array($strAction, $arrValidActions))
	 {
		  include("404.php");
		  exit;
	 }
?>