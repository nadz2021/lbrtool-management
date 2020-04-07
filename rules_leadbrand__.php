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

$brandassign_list = getBrandAssignListByRule($row['rid']);
$fvalue='';
foreach($brandassign_list as $brand) {
	$fvalue .= $brand['impname'].'<br/>';
}

$ruleset_info = getRuleSetInfo($rsid);
$rulename = $ruleset_info[0]['rule_name'];


if(isset($_POST['submit'])){

	$rule_id = $_POST['rid'];
	$imprint_id = $_POST['imprint_id'];
	$ratio = $_POST['ratio'];
	$impvalue = $_POST['imprintname'];
	

	if(!empty($imprint_id)) {
		$result = assignBrandToRule($rule_id,$imprint_id);
		if (count($result[0])==0) { 
			insertAssignBrand($rule_id,$imprint_id,$ratio,$ratio);
			
			$prev_value = "Rule Name: ".$rulename."<br/>Field name: ".$fname."<br/>Assign Imprint/s: ".$impvalue;
			$addedimp = getImprintName($imprint_id);

			$addvalue= $addedimp[0]['imprint_name'];
			$current_value = "<br/>Added Assign Imprint: ".$addvalue.'<br/>Ratio: '.$ratio;
			$user = $_SESSION['username'];	
			insertLog($event,$prev_value,$current_value,$pagename,$user);
    	header('Location: rules_leadbrand.php?rid='. $rule_id.'&rsid='.$rsid);
		}
		else {    	
	    	$error_msg ='Imprint already assign!';
	    }
	}

}

?>