
<?php
include "../data_con.php";
$new_order = $_GET["new_order"];
$table = $_GET["table"];
$tid = $_GET["tid"];
$rid = $_GET["rid"];
$rsid = $_GET["rsid"];

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
    @mysql_query("UPDATE $table SET $tid='$id' where $tid=$new_arry[$i]");    
    $id++;
}

$id=10001;
for($i=0;$i < count($sort_order);$i++) {
    @mysql_query("UPDATE $table SET $tid='$sort_order[$i]' where $tid=$id");    
    $id++;
}

if(empty($rsid)){
	header('location:rules_defaultleadbrand.php?id='.$rid);
}
else {
	header('location:rules_leadbrand.php?rid='.$rid.'&rsid='.$rsid);	
}

?>