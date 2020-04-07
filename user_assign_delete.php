<?php
    include "config/functions.php";

	$id = $_GET['umid'];
	$user_id = $_GET['user_id'];
	
	deleteMicrositeToUser($id);	
	header('Location: user_assign.php?id='.$user_id);
?>

