<?php
session_start();
include "config/functions.php";
isLogin();
$error_msg = '';
if(isset($_POST['submit'])){
  $name = 	$_POST['name'];
  $fieldname = 		$_POST['fieldname'];  
  $microsite_fieldname = $_POST['microsite_fieldname'];

  if($name !='' && $fieldname !=''){  
  	$result = checkFieldName($name,$fieldname);
	if(count($result[0]) == 0) {
		insertFieldName($name,$fieldname,$microsite_fieldname);
    $current_value = "Form Field: ".$name."<br/>Database : ".$fieldname."<br/>Mirosite Fieldname: ".$microsite_fieldname;
    $user = $_SESSION['username'];	
		insertLog('add','',$current_value,$pagename,$user);
    	echo '<br/>Added Succesfully!';    	
    	header('location:fieldnames.php');
    } 
	else {
	    // do other stuff...
	    $error_msg ='Field name already exist!';
	}
  }
  else {
  	$error_msg ='Error Field!';
  }
}


?>