
<?php
session_start();
include "config/functions.php";
isLogin();
$new_order = $_GET["new_order"];
$table = $_GET["table"];
$tid = $_GET["tid"];
$rsid = $_GET["rsid"];
$rid = $_GET["rid"];

$new_order = explode(",",$new_order);
$new_arry = $new_order;
asort($new_order);
$sort_order = array();

$i=0;
foreach($new_order as $key => $value) {
    $sort_order[$i] = $value;
    $i++;
}


$id=10001;
for($i=0;$i < count($new_arry);$i++) {
    sortRules($table,$id,$new_arry[$i]);
    $id++;
}

$id=10001;
for($i=0;$i < count($sort_order);$i++) {
  sortRules($table,$sort_order[$i],$id);
  $id++;
}

header('location:https://palibriopublishing.com/v2/rules.php?id='.$rid);

?>