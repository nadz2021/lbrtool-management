<?php
$flag = 0;

if (isset($_POST["username"])&&isset($_POST["password"]))
{
	$user = $_POST["username"];	
	$pass = $_POST["password"];
	
	$con = mysql_connect("localhost","root","");
	if (!$con)
  	{
  		die('Could not connect: ' . mysql_error());
  	}
	mysql_select_db("trafford_micrositeLeads", $con);

	$clean_user = preg_replace("/['\";]/i","",$user); // remove the special characters that triggered to SQL injection
	$clean_pass = preg_replace("/['\";]/i","",$pass); // remove the special characters that triggered to SQL injection
	$sql = "SELECT * FROM users Where login ='".$clean_user."' AND crypted_password ='".$clean_pass."' and deleted!='Y' ";
	$result = mysql_query($sql);
	
	if(mysql_fetch_array($result))
  	{
		$flag = 1;
		$_SESSION['authenticity'] = 1;
		$_SESSION['isLogin'] = 1;
		$_SESSION['username']= $clean_user;

		$sql = "SELECT role_id FROM users Where login ='".$clean_user."' ";
		$role = mysql_query($sql);
	    while($row = mysql_fetch_array($role)) {
	    	$_SESSION['role_id'] = $row['role_id'];
	    }
	    
  		header('Location: microsite_db.php');
  	}
	else
	{ 
		$_SESSION['username']= $_POST["username"];
		header('Location: index.php');
	}
	mysql_close($con);
}
	
if (isset($_SESSION['username']))
{
	if($flag==0)
	{
		$user = $_SESSION['username'];
	}
	else
	{
		$user = "";
	}
}
else 
	$user = "";
	
if (isset($_SESSION['password']))
{
	if($flag==0)
	{
		$pass = $_SESSION['password'];
	}
	else
	{
		$pass = "";
	}
}
else 
	$pass = "";	


?>