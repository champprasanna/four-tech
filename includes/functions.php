<?php

function fnLinkBuilder($strAction="home")
{
	$strLink = SITE_NAME."?action=$strAction";
	return $strLink; 	
}

function fnCheckValidationerror() {
	
	return (count($_SESSION['error'])) ? true : false;
}

function fnValidationMsg() {
	$error_msg = '';
	if(count($_SESSION['error'])) {
		
		$error_msg = '<ul class=\"errormsg\"><li>Error:</li>';
			foreach($_SESSION['error'] as $current_error) {
				$error_msg .= '<li>'.$current_error[1].'</li>';	
			}
		$error_msg .= '</ul>';
		
		unset($_SESSION['error']);
	}
	
	return $error_msg;
}
?>