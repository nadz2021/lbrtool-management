<?php
session_start();
include "config/functions.php";
isLogin();
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
	.add-btn {
		background-color: #4CAF50;
	    color: white;
	    padding: 12px 20px;
	    border: none;
	    border-radius: 4px;
	    text-decoration: none;
	    float: right;
	}
	input:checked + .slider {
	  background-color: #4CAF50;
	}

	input:focus + .slider {
	  box-shadow: 0 0 1px #2196F3;
	}

	input:checked + .slider:before {
	  -webkit-transform: translateX(26px);
	  -ms-transform: translateX(26px);
	  transform: translateX(26px);
	}
	.switch {
	    position: relative;
	    display: inline-block;
	    width: 61px;
	    height: 34px;
	}
	.switch input { display: none; }
	.slider {
	    position: absolute;
	    cursor: pointer;
	    top: 0;
	    left: 0;
	    right: 0;
	    bottom: 0;
	    background-color: #ccc;
	    -webkit-transition: .4s;
	    transition: .4s;
	}

	.slider:before {
	    position: absolute;
	    content: "";
	    height: 26px;
	    width: 26px;
	    left: 4px;
	    bottom: 4px;
	    background-color: white;
	    -webkit-transition: .4s;
	    transition: .4s;
	}
	.badge {
	    background: #4CAF50;
	    border-radius: 4px;
	    border: 1px solid #4CAF50;
	    color: white;
		padding: 3px 10px;
	}
	.badge-x {
	    background: red;
	    border: 1px solid red;
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
			<h2>List of Landing Page</h2>
		
			<a href="landing_page_create.php" class="add-btn">ADD LANDING PAGE</a>
			<br/><br/><br /><br />	
		<?php
			$lp_list = getAllPagesWithStatus();
		      echo "<table id='brand-list' border='0'>";
			      echo "<tr>
			      <th>Landing Page Name</th>
			      <th>Created Date</th>
			      <th>Assigned</th>
			      <th>Action</th>
			      </tr>";
		        

		      

		    foreach ($lp_list as $row) {

		        echo '<tr>';
		?>
	        	<td>
	        		<p><?php echo $row['pname']; ?></p>
	        	</td>
	        	<td>
	        		<p><?php echo $row['date_created']; ?></p>
	        	</td>
	        	<td>
	        		<p><?php if(!empty($row['assign'])){?>
	        			<span class="badge">Assigned</span>
	        			<?php } else {?>
	        			<span class="badge badge-x">Not Assigned</span>
	        			<?php } ?>

	        		</p>
	        	</td>
	        	<td>
	        		<a style='text-decoration:none' href='landing_page_edit.php?id=<?php echo $row['id']; ?>'>edit |</a>	        		
	        		<a style='text-decoration:none' href='landing_page_delete.php?id=<?php echo $row['id']; ?>' onClick='return confirm('Are you sure you want to delete?')'>delete</a>	        		
	        	</td>
	        </tr>
		<?php }  ?>
		</div>
	</div>
</div>
</body>
</html>