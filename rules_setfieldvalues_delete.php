<?php
session_start();
include "config/functions.php";
isLogin();

$user = $_SESSION['username'];	
$id = $_GET['id'];
$rid = $_GET['rule_id'];
$rsid = $_GET['rsid'];
$microsite = new Microsite();
$microsite->deleteFieldValueSetByID($id);
header('Location: rules_setfieldvalues.php?rid='.$rid.'&rsid='.$rsid);
	
	
?>

