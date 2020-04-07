
<?php
session_start();
include "config/functions.php";
isLogin();

$id = $_GET['id'];
$path = $_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
$pagename = basename($path); // $pagename is set to "{pagename}.php"

deleteFieldValue($id);
$fieldvalue_result = getFieldValueInfo($id);
$fvalue_result = $fieldvalue_result[0]['fieldvalue'];

$current_value = "Field value: ".$fvalue_result;
$user = $_SESSION['username'];
deleteLog('deleted',$current_value,$pagename,'fieldvalue_id',$id,'fieldvalue',$user);
header("Location: fieldvalues.php");
?>

