<?php
    include "../data_con.php";

	$id = $_GET['id'];
	$table_idname = $_GET['table_idname'];
	$table_did = $_GET['table_did'];
	$table_name = $_GET['table_name'];
	print_r($table_did);
	print_r($table_name);
	print_r($table_idname);

	@mysql_query("UPDATE $table_name SET deleted='' where $table_idname=$table_did");
	@mysql_query("UPDATE logs SET event='restored' where id=$id");
	header("Location: activitylogs.php");
	
	
?>

