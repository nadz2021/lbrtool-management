<?php
session_start();
include "config/functions.php";
isLogin();

$id = $_GET['id'];
$path = $_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
$pagename = basename($path); // $pagename is set to "{pagename}.php"

deleteImprintName($id);
$imprint_result = getImprintInfo($id);
$imp_result = $imprint_result[0]['imprint_name'];
$current_value = "Imprint name: ".$imp_result;
$user = $_SESSION['username'];
deleteLog('deleted',$current_value,$pagename,'imprint_id',$id,'imprint',$user);
header("Location: imprintbrand.php");
?>

