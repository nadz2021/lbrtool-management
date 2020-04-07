<?php
session_start();
include "../config/functions.php";

if(isset($_POST['microsite_db'])){	
  $_SESSION['microsite_db'] = $_POST['microsite_db'];
  $microsite_name = getMicrositeName($_POST['microsite_db']);    
  if($microsite_name!='') {
  	$_SESSION['microsite_name'] = $microsite_name;  
  }
}
else {	
	$_SESSION['microsite_db'] 	=	"trafford_micrositeLeads";	
	$_SESSION['microsite_name'] = 	'Main';
}

header('location: //lbrtool.xlibris.info/v2/rules_set.php');	  	

?>