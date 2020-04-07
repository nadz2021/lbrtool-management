<?php
session_start();
if($_SESSION['isLogin'] != 1){header("location:index.php");}
if(!isset($_SESSION['counter']))
{
  if(!isset($_SESSION['authenticity']))
  {
    header('Location: index.php');
  }
}
    include "../data_con.php";

	$rsid = $_GET['rsid'];
	$id = $_GET['id'];


	@mysql_query("DELETE FROM `rule_set_lp` WHERE `id`=$id");
	header("Location: rules_set_lp.php?rsid=".$rsid);
?>

