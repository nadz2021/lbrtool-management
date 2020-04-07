<?php 
	session_start();
	$_SESSION = array();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head> 
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
	<script type="text/javascript" src="javascripts/jquery-1.6.1.js"></script>
	<title>Leads Brand Rule</title> 
	<script type="text/javascript" src="retrieval.js"></script>
	<link rel="stylesheet" type="text/css" href="stylesheets/retrieval.css" />
</head> 

<body>

<form action="process/login.php" method="post" name="authentication" id="" onSubmit="return validate_form();">

<div id="authentication">

	<h1 align="center">User Authentication</h1><br/>

	<div id="usernamediv" align="center">

		<label for="username">Username</label>&nbsp;&nbsp;

		<input type="text" name="username" id="username" size="40" autocomplete="off" />

	</div>

	<div id="passworddiv" align="center">

		<label for="password">Password</label>&nbsp;&nbsp;

		<input type="password" name="password" id="password" size="40" autocomplete="off" />

	</div>

	<?php 

		if(isset($_SESSION['username'])) {

				echo '<div id="error">';
					echo "<span style=color:red>Error Login.</span>";
				echo "</div>";
		}

	?>

	<div id="login">

	<input type="submit" name="mysubmit" value="Log-in" />

	</div>

</div>

</form>

</body>

</html>