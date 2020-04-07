<?php
session_start();
include "config/functions.php";
isLogin();

$error_msg = '';
$a_id = $_GET['id'];
$rid = $_GET['rule_id'];
$rsid = $_GET['rsid'];




$imprint_info = getAssignBrandInfo($a_id);

foreach($imprint_info as $row) {
	$id = $row['imprint_id'];
  	$impname = $row['imprint_name'];
	$ratio = $row['ratio'];
	$current = $row['status'];
}

$ruleset_info = getRuleSetInfo($rsid);
$rulename = $ruleset_info[0]['rule_name'];

$prev_value = "Rule Name: ".$rulename."<br/>Rule ID: ".$rid."<br/>Imprint Name: ".$impname."<br/>Ratio: ".$ratio."<br/>Current: ".$current;


if(isset($_POST['submit'])){
	$id = $_POST['id'];
	$rid = $_POST['rid'];
	$rsid = $_POST['rsid'];
	$ratio = $_POST['ratio'];
	$status = $_POST['status'];
	$pvalue = $_POST['prev_value'];
	

	updateAssignBrand($ratio,$status,$id);


	$current_value = "Ratio: ".$ratio."<br/>Current: ".$status;
	$user = $_SESSION['username'];		
	insertLog('update',$pvalue,$current_value,$pagename,$user);
   	header('Location: rules_leadbrand.php?rid='. $rid.'&rsid='.$rsid);
}

?>