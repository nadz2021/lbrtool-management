<?php
    include "../data_con.php";

	$id = $_GET['id'];
    $path = $_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
	$pagename = basename($path); // $pagename is set to "{pagename}.php"

	@mysql_query("UPDATE users SET deleted='Y' where id=$id");
	$userinfo = @mysql_query('SELECT login FROM users where id='.$id.'');
	while($row = mysql_fetch_array($userinfo)) {
	    $username = $row['login'];
	}

	$current_value = "User Name: ".$username;
	@mysql_query("INSERT INTO logs(event,current_value,page,table_idname,table_did,table_name) VALUES ('deleted','$current_value','$pagename','id','$id','users')");
	header("Location: users.php");
?>

