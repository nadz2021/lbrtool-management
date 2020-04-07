<?php
include "fieldvalues__.php";
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
	select {
		width: 30%;
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

    </style>
</head>
<body>
<div class="container">  	
	<div class="row">
		<div class="col-15">
			<?php include "__rules_sidebar.php"; ?>
		</div>
		<div class="col-85">
			<div class="row">
				<div class="col-100">
					<h2>Field Values</h2>
					<?php if($_SESSION['role_id']==1) { ?>
						<a href="fieldvalues_create.php" class="add-btn">CREATE FIELD VALUES</a>
					<?php } ?>
					<br/><br/><br/><br/>
					<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
						<select name="fieldname_id" id="fieldname_id" onchange="this.form.submit();">
							<option value="" selected="">--</option>
							<?php echo getCategory(); ?>
						</select>							
					</form>
							<br/><br/>
					<?php 
					echo "<table id='brand-list' border='0'>
						<tr>
						<th>Field Value</th>
						<th>Salesforce Value</th>
						<th>Created Date</th>";
						if($_SESSION['role_id']==1) {
							echo "<th style='width:15%;'></th>";							
						}
					echo "</tr>";
				    	$fieldvalue_list = getFieldValueList();
	    				foreach ($fieldvalue_list as $row) {
	    			   	echo '<tr>';	    			   	
					?>
						<td><?php echo $row['fieldvalue']; ?></td>
						<td><?php echo $row['salesforcevalue']; ?></td>
						<td><?php echo $row['createddate']; ?></td>
						<?php if($_SESSION['role_id']==1) { ?>
						<td>
			        		<button><a style='text-decoration:none' href='fieldvalues_edit.php?id=<?php echo $row['fieldvalue_id']; ?>'>edit</a></button>					        		
			        		<a style='text-decoration:none' href='fieldvalues_delete.php?id=<?php echo $row['fieldvalue_id']; ?>' onClick='return confirm('Are you sure you want to delete?')'>delete</a>			        		
			        	</td>
			        	<?php } ?>
					</tr>
					<?php				
						}
					?>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
</body>
</html>