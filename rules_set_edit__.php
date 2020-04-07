<?php
session_start();
include "config/functions.php";
isLogin();
$path = $_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
$pagename = basename($path); // $pagename is set to "{pagename}.php"
$user = $_SESSION['username'];
$id = $_GET['id'];
	if(isset($_POST['submit'])){
    $rule_name  = 	$_POST['rule_name'];
    $prev_value = 	$_POST['prev_value'];
		$id 				= 	$_POST['id'];

		$current_value = "Rule Name: ".$rule_name;
		updateRule($rule_name,$id);
  	if($prev_value!=$current_value){
  		insertLog('update',$prev_value,$current_value,$pagename,$user);
		}
  	header("Location: rules_set.php");
  }

  $rules = getRuleName($id);
	foreach($rules as $row) {
	    $rule_name = $row['rule_name'];
	}
?>