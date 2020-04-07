<?php
session_start();
include "config/functions.php";
isLogin();

	$id = $_GET['id'];
	$rsid = $_GET['rsid'];
	$path = $_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
	$pagename = basename($path); // $pagename is set to "{pagename}.php"

	deleteRule($id);
	$ruleset_info = getRuleSetInfo($rsid);
	$rulename = $ruleset_info[0]['rule_name'];

	$fieldvalueset = getFieldValueSetByRule($id);
	$fvset ='';
	foreach($fieldvalueset as $row) {
	    $fvset .= $row['fvalue'].', ';
	}

	$brandassign_list = getBrandAssignListByRule($id);
	$imp='';
	foreach($brandassign_list as $brand) {
		$imp .= $brand['impname'].'<br/>';
	}
	
	$current_value = "Rule name: ".$rulename."<br/>Field name/s: ".$fvset."<br/>Brand/s: ".$imp;
	$user = $_SESSION['username'];	
	deleteLog('deleted',$current_value,$pagename,'rule_id',$id,'rules',$user);
	header("Location: rules.php?id=".$rsid);
	
	
?>

