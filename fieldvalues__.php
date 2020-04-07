<?php
session_start();
include "config/functions.php";
isLogin();
function getCategory() {
	$postfieldname_id = '';
	if(isset($_POST['fieldname_id'])){
		$postfieldname_id = $_POST['fieldname_id'];
	}
	$options = '';
	$fieldname_list = getFieldNameList();	
	foreach ($fieldname_list as $row) {
		if($postfieldname_id == $row['fieldname_id']){
			$options .= '<option value="'.$row['fieldname_id'].'" selected>'.$row['name'].'</option>';	
		}
		else {
			$options .= '<option value="'.$row['fieldname_id'].'">'.$row['name'].'</option>';				
		}
	}
	return $options;
}

function getFieldValueList(){
	if(isset($_POST['fieldname_id'])){
		$id=$_POST['fieldname_id'];
	}	
	if(!empty($id)){
		$microsite = new Microsite($_SESSION['microsite_db']);
		$result = $microsite->getFieldValueListByID($id);
		return $result;	
	}	
}
?>