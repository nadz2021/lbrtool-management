<?php
session_start();
include "config/functions.php";
isLogin();
$id = $_GET['id'];
$path = $_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
$pagename = basename($path); // $pagename is set to "{pagename}.php"

deletePage($id);
$ruleset = getPageInfoID($id);
$page_name = $ruleset[0]['page_name'];
$user = $_SESSION['username'];
$current_value = "Page name: ".$page_name;
deleteLog('deleted',$current_value,$pagename,'id',$id,'page',$user);
header("Location: landing_page.php");
?>

