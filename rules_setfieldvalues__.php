<?php
session_start();
include "config/functions.php";
isLogin();

$error_msg = '';
$id = $_GET['rid'];
$rsid = $_GET['rsid'];


$rules_info = getFieldValueListInRules($id);

foreach($rules_info as $row) {
	$rsid = $row['rsid'];
	$rid = $row['rid'];
  $fname = $row['name'];
  $fname_id = $row['fname_id'];
}
$ruleset_info = getRuleSetInfo($rsid);
$rule_name = $ruleset_info[0]['rule_name'];

function getRegionValues() {
	$microsite = new Microsite($_SESSION['microsite_db']);	
	if(isset($_POST['region_id'])){
		$rule_id = $_POST['rid'];
		$r_id=$_POST['region_id'];
		if(!empty($r_id)){
			$fieldvalues = $microsite->getRegionValuesByID($r_id);
			foreach($fieldvalues as $row) {	
				$result = $microsite->getFieldValueSetByIDs($rule_id,$row['fieldvalue_id']);
				if(count($result[0])==0) {
					$microsite->insertFieldValueSetByIDs($rule_id,$row['fieldvalue_id']);
				}
			}				
		}
	}	
	$options = '';

	$regionvalues = $microsite->getRegionList();
	foreach($regionvalues as $row) {
		if($r_id == $row['description']){
			$options .= '<option value="'.$row['description'].'" selected>'.$row['description'].'</option>';				
		}
		else {
			$options .= '<option value="'.$row['description'].'">'.$row['description'].'</option>';							
		}
	}
	return $options;
}

function getFieldCountryValues(){
	$microsite = new Microsite($_SESSION['microsite_db']);
	if(isset($_POST['region_id'])){
		$r_id=$_POST['region_id'];
	}	
	$options = '';
	if(empty($r_id)){
		$fieldvalues = $microsite->getFieldValueByCountryList();
	}
	else {
		$fieldvalues = $microsite->getFieldValueCountryListByID($r_id);
	}

	foreach($fieldvalues as $row) {
		$options .= '<option value="'.$row['fieldvalue_id'].'">'.$row['fieldvalue'].'</option>';	
	}
	return $options;
}

if(isset($_POST['submit'])){
	$microsite = new Microsite($_SESSION['microsite_db']);
	$rule_id = $_POST['rid'];
	$fieldvalue_id = $_POST['fieldvalue_id'];
	$fvalue = $_POST['fieldvalue'];

	if(!empty($fieldvalue_id)) {
		$result = $microsite->getFieldValueSetByIDs($rule_id,$fieldvalue_id);
		if(count($result[0])==0) {
			$microsite->insertFieldValueSetByIDs($rule_id,$fieldvalue_id);
			$addedfv = $microsite->getfieldvalueByID($fieldvalue_id);
			$addvalue = $addedfv[0]['fieldvalue'];
			$prev_value = "Rule Name: ".$rule_name."<br/>Field name: ".$fname."<br/>Field value: ".$fvalue.' ';
			$current_value = "<br/>Added Field value: ".$addvalue;
			$user = $_SESSION['username'];	
			$log = new ActivityLog($_SESSION['microsite_db']);
			$result = $log->addNewLog('update',$prev_value,$current_value,$pagename,$user);
  		header('Location: rules_setfieldvalues.php?rid='. $rule_id.'&rsid='.$rsid);
		}
		else {    	
	    	$error_msg ='Field value already assign!';
	    }
	}

}

?>