<?php
session_start();
include "config/functions.php";
isLogin();
$path = $_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
$pagename = basename($path); // $pagename is set to "{pagename}.php"
$error_msg = '';

if(isset($_POST['submit'])){
    $rule_name = 	$_POST['rule_name'];
    $result = checkRuleName($rule_name);
	if(count($result) == 0) {
	    // row not found, do stuff...
	    insertRuleName($rule_name);		
		$current_value = "Rule name: ".$rule_name;
		$user = $_SESSION['username'];
		$prev_value = "";
		insertLog('add',$prev_value,$current_value,$pagename,$user);
		echo '<br/>Added Succesfully!';
		header('location:rules_set.php');	
	} 
	else {
	    // do other stuff...
	    $error_msg ='Rule already exist!';
	}
    
}


?>