<?php
session_start();
include "config/functions.php";
isLogin();
$error_msg = '';
$rsid = $_GET['rsid'];

$ruleset_info = getRuleSetInfo($rsid);
$rulename = $ruleset_info[0]['rule_name'];

$ruleset_pages = getPagesByRule($rsid);
$page_name='';
foreach($ruleset_pages as $row) {
    $page_name .= $row['lp_name'].'<br/>';
}
$pages_list = getAllPages();

if(isset($_POST['submit'])){
	$page_id = $_POST['page_id'];
	$rule_set_id = $_POST['rsid'];
	$rulename = $_POST['rulename'];
	$page_name = $_POST['page_name'];

	if(!empty($page_id)) {
		$result = checkPageRule($page_id);
		if (count($result[0])==0) { 
			insertPageRuleSet($rule_set_id,$page_id);
			$prev_value = "Rule Name: ".$rulename."<br/>Pages: ".$page_name;
			$addedpage = getPageName($page_id);
			$addvalue = $addedpage[0]['page_name'];
			$current_value = "<br/>Added Pages: ".$addvalue;
			$user = $_SESSION['username'];

			insertLog('add',$prev_value,$current_value,$pagename,$user);
    		header('Location: rules_set_lp.php?rsid='.$rule_set_id);
		}
		else {    	
	    	$error_msg ='Landing Page is already assign!';
	    }
	}


}

?>