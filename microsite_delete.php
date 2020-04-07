<?php
session_start();
include "config/functions.php";
isLogin();
$id = $_GET['id'];
deleteMicrosite($id);
header("Location: microsite.php");
?>

