<?php
session_start();
include "config/functions.php";
isLogin();

$id = $_GET['id'];
$path = $_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
$pagename = basename($path); // $pagename is set to "{pagename}.php"

deleteFieldName($id);
$fieldname_result = getFieldNameInfo($id);
$fname_result = $fieldname_result[0]['name'];

$current_value = "Field name: ".$fname_result;
$user = $_SESSION['username'];	
deleteLog('deleted',$current_value,$pagename,'fieldname_id',$id,'fieldname',$user);
header("Location: fieldnames.php");
?>

