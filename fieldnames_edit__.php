<?php
session_start();
include "config/functions.php";
isLogin();
$path = $_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
$pagename = basename($path); // $pagename is set to "{pagename}.php"
$id = $_GET['id'];
if(isset($_POST['submit'])){
  $id = 	$_POST['id'];
  $name = $_POST['name'];
$fieldname = $_POST['fieldname'];
$microsite_fieldname = $_POST['microsite_fieldname'];		
$prev_value = 	$_POST['prev_value'];
$user = $_SESSION['username'];

  if($name !='' && $fieldname !=''){  
  	$current_value = "Form Field: ".$name."<br/>Database : ".$fieldname."<br/>Mirosite Fieldname: ".$microsite_fieldname;
  	updateFieldName($name,$fieldname,$microsite_fieldname,$id);
  	if($prev_value!=$current_value){
  		insertLog('update',$prev_value,$current_value,$pagename,$user);
		}
  	header("Location: fieldnames.php");  	
  }
  else {
  	echo '<br/>Error';
  }
}

$filename_list = getFieldNameInfo($id);
foreach ($filename_list as $row) {
  $name = $row['name'];
  $fieldname = $row['fieldname'];
  $microsite_fieldname = $row['microsite_fieldname'];
}

?>