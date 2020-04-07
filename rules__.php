<?php
session_start();
include "config/functions.php";
isLogin();
$id = $_GET['id'];
$ruleset_info = getRuleSetInfo($id);
$rule_name = $ruleset_info[0]['rule_name'];


$rules_info = getLeadBrandRulesInfo($id);
$affected_pages = '';
foreach($rules_info as $row) {
	$affected_pages .= $row['page_name'].'<br/>';
}
$check = hasDefaultRule($id);
if(count($check[0])==0) {
	$new_rid = insertDefaultRule($id);
    header('Location: rules_leadbrand.php?rsid='.$id.'&rid='.$new_rid);
}

$rules_list = getLeadBrandRuleList($id);

?>