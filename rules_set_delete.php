<?php
session_start();
include "config/functions.php";
isLogin();

$id = $_GET['id'];
$path = $_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
$pagename = basename($path); // $pagename is set to "{pagename}.php"
$user = $_SESSION['username'];	
deleteRuleSet($id);
$rules = getRuleName($id);
foreach($rules as $row) {
   $rule_name = $row['rule_name'];
}
$current_value = "Rule name: ".$rule_name;
deleteLog('deleted',$current_value,$pagename,'id',$id,'rules_set',$user);
header("Location: rules_set.php");
?>

