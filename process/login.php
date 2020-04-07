<?php
session_start();
include "../config/functions.php";
$flag = 0;
if (isset($_POST["username"])&&isset($_POST["password"])) {
	$user = $_POST["username"];	
	$pass = $_POST["password"];

	$clean_user = preg_replace("/['\";]/i","",$user); // remove the special characters that triggered to SQL injection
	$clean_pass = preg_replace("/['\";]/i","",$pass); // remove the special characters that triggered to SQL injection
	$result = loginUser($clean_user, $clean_pass);
	if($result==1) {
		$flag = 1;
		$_SESSION['authenticity'] = 1;
		$_SESSION['isLogin'] = 1;
		$_SESSION['username']= $clean_user;

		$role = getRole($clean_user);
	  $_SESSION['role_id'] = $role[0]['role_id'];	    
  	
  	header('Location: //lbrtool.xlibris.info/v2/microsite_db.php');
  }
	else {
		header('Location: //lbrtool.xlibris.info/v2/index.php');	
	}
}
	

?>