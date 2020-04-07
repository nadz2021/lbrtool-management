<?php
session_start();
include "config/functions.php";
isLogin();

$id = $_GET['id'];
$rid = $_GET['rule_id'];
$rsid = $_GET['rsid'];

deleteAssignBrand($id);
header('Location: rules_leadbrand.php?rid='. $rid.'&rsid='.$rsid);		
	
	
?>

