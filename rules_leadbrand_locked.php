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

	$rid = $_GET['rid'];
	$rsid = $_GET['rsid'];
	$asid = $_GET['asid'];
	$locked = $_GET['locked'];
	
	if($locked==0){
		@mysql_query("UPDATE assignbrand SET locked=1 where assignbrand_id=$asid");		
	}
	else {
		@mysql_query("UPDATE assignbrand SET locked=0 where assignbrand_id=$asid");		
	}

	header('Location: rules_leadbrand.php?rid='.$rid.'&rsid='.$rsid);		
	
	
?>

