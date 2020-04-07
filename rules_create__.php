<?php
session_start();
include "config/functions.php";
isLogin();

$path = $_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
$pagename = basename($path); // $pagename is set to "{pagename}.php"
$id = $_GET['id'];

$error_msg = '';
if(isset($_POST['btnCreate'])){
	$rsid = $_POST['rsid'];
	$fieldname_id = $_POST['fieldname'];
	insertRule($fieldname_id,$rsid);

  	$ruleset_info = getRuleSetInfo($rsid);
	$rule_name = $ruleset_info[0]['rule_name'];

	$fieldname = getFieldNameInfo($fieldname_id);	
	$field_name = $fieldname[0]['name'];

	$current_value = "Rule name: ".$rule_name."<br/>Field name: ".$field_name;
	$user = $_SESSION['username'];
	$previous_value ='';
	insertLog('add',$previous_value,$current_value,$pagename,$user);
 	header('Location: rules.php?id='. $rsid);
}

function postFieldName() {
	$SelectedFieldName = '';
	if(isset($_POST['fieldname'])) {
		$SelectedFieldName = $_POST['fieldname'];
	}
	return getFieldName($SelectedFieldName);
}

?>