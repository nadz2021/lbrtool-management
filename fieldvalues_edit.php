<?php
session_start();
include "config/functions.php";
isLogin();
$id = $_GET['id'];
 if(isset($_POST['submit'])){
    $id = 	$_POST['id'];
    $fieldvalue = $_POST['fieldvalue'];
    $salesforcevalue = $_POST['salesforcevalue'];
    $fieldname_id = $_POST['fieldname_id'];
    $prev_value = 	$_POST['prev_value'];
    $user = $_SESSION['username'];

    if($fieldvalue !='' && $salesforcevalue !=''){  
    	$current_value = "Field Value: ".$fieldvalue."<br/>Salesforce Value : ".$salesforcevalue;
    	updateFieldValue($fieldvalue,$salesforcevalue,$fieldname_id,$id);
    	if($prev_value!=$current_value){
    		insertLog('update',$prev_value,$current_value,$pagename,$user);
		}
    	header("Location: fieldvalues.php");
    	
    }
    else {
    	echo '<br/>Error';
    }
  }
  
$filevalue_list = getFieldValueInfo($id);
	foreach ($filevalue_list as $row) {
    $fieldvalue = $row['fieldvalue'];
    $salesforcevalue = $row['salesforcevalue'];
    $fieldname_id = $row['fieldname_id'];
		
	}

function getCategory($id) {
	$options = '';
	$fieldname_list = getFieldNameList();	
	foreach ($fieldname_list as $row) {
		if($id == $row['fieldname_id']){
			$options .= '<option value="'.$row['fieldname_id'].'" selected>'.$row['name'].'</option>';	
		}
		else {
			$options .= '<option value="'.$row['fieldname_id'].'">'.$row['name'].'</option>';				
		}
	}
	return $options;
}
?>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Lead Brand Rule Tool</title>
  <style>
* {
box-sizing: border-box;
}
body {
	background-color: #eee;
}	
.sidenav {
    height: 100%;
    width: 220px;
    position: fixed;
    z-index: 1;
    top: 0;
    left: 0;
    background-color: #4CAF50;
    overflow-x: hidden;
    padding-top: 20px;
}

.sidenav a {
    padding: 6px 8px 6px 16px;
    text-decoration: none;
    font-size: 25px;
    color: #333;
    display: block;
}

.sidenav a:hover {
    color: #fff;
}
input[type=text], input[type=number], select {
width: 100%;
padding: 12px;
border: 1px solid #ccc;
border-radius: 4px;
resize: vertical;
}

label {
padding: 12px 12px 12px 0;
display: inline-block;
}

input[type=submit] {
background-color: #4CAF50;
color: white;
padding: 12px 20px;
border: none;
border-radius: 4px;
cursor: pointer;
float: right;
}

input[type=submit]:hover {
background-color: #45a049;
}

.container {
border-radius: 5px;
background-color: #eee;
padding: 20px;
}

.col-10 {
float: left;
width: 10%;
margin-top: 6px;
}

.col-15 {
float: left;
width: 15%;
margin-top: 6px;
}

.col-25 {
float: left;
width: 25%;
margin-top: 6px;
}

.col-75 {
float: left;
width: 75%;
margin-top: 6px;
}

.col-85 {
float: left;
width: 85%;
margin-top: 6px;
}

.col-90 {
float: left;
width: 90%;
margin-top: 6px;
}

/* Clear floats after the columns */
.row:after {
content: "";
display: table;
clear: both;
}
#brand-list {
    font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
    border-collapse: collapse;
    width: 100%;
}

#brand-list td, #brand-list th {
    border: 1px solid #ddd;
    padding: 8px;
}

#brand-list tr:nth-child(even){background-color: #f2f2f2;}

#brand-list tr:hover {background-color: #ddd;}

#brand-list th {
    padding-top: 12px;
    padding-bottom: 12px;
    text-align: left;
    background-color: #4CAF50;
    color: white;
}
#brand-list tr:nth-child(2) td:last-child button:nth-child(2), 
#brand-list tr:last-child td:last-child button:nth-child(3) {
	visibility: hidden;
}
.add-btn {
	background-color: #4CAF50;
    color: white;
    padding: 12px 20px;
    border: none;
    border-radius: 4px;
    text-decoration: none;
    float: right;
}
.content {
	padding-left: 10px;
}

  </style>
</head>
<body>
<div class="container">  	
<div class="row">
	<div class="col-15">
		<?php include "__rules_sidebar.php"; ?>
	</div>
	<div class="col-85">
		<div class="content">
			<h2>Edit Field Values</h2>
			<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
				<input type="hidden" name="id" value=<?php echo $id;?>>
				<div class="row">
					<div class="col-25">
						<label for="bname">Field Value</label>
					</div>
				</div>
				<div class="row">
					<div class="col-25">
						<input type="text" name="fieldvalue" value="<?php echo $fieldvalue; ?>" required>
					</div>
				</div>					
				<div class="row">
					<div class="col-25">
						<label for="bname">Salesforce Value</label>
					</div>
				</div>
				<div class="row">
					<div class="col-25">
						<input type="text" name="salesforcevalue" value="<?php echo $salesforcevalue; ?>" required>
					</div>
				</div>					
				<div class="row">
					<div class="col-25">
						<label for="bname">Category Change</label>
					</div>
				</div>
				<div class="row">
					<div class="col-25">
						<select name="fieldname_id" id="fieldname_id" onchange="this.form.submit();">
							<?php echo getCategory($fieldname_id); ?>
						</select>
					</div>
				</div>					
				<div class="row">
					<br/><br/>
					<?php 
						$prev_value = "Field Value: ".$fieldvalue."<br/>Salesforce Value : ".$salesforcevalue;
					?>
					<input type="hidden" name="prev_value" value="<?php echo $prev_value; ?>">
					<a class="btn-back" href="fieldvalues.php">BACK</a>
					<input type="submit" name="submit" value="UPDATE">
				</div>		
			</form>	
		</div> 
	</div>
</div>
</div>
</div>
</body>

</html>