<?php
include "rules_setfieldvalues__.php";
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
	margin-left: 25px;
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
	.col-50 {
	float: left;
	width: 50%;
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
	.brand-list {
	    font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
	    border-collapse: collapse;
	    width: 100%;
	}

	.brand-list td, .brand-list th {
	    border: 1px solid #ddd;
	    padding: 8px;
	}

	.brand-list tr:nth-child(even){background-color: #f2f2f2;}

	.brand-list tr:hover {background-color: #ddd;}

	.brand-list th {
	    padding-top: 12px;
	    padding-bottom: 12px;
	    text-align: left;
	    background-color: #4CAF50;
	    color: white;
	}
	.brand-list tr:first-child td:last-child button:first-child, 
	.brand-list tr:last-child td:last-child button:nth-child(2) {
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
	.alert-danger {
	    color: #a94442;
	    background-color: #f2dede;
	    border-color: #ebccd1;
	}
	.alert {
	    padding: 15px;
	    margin-bottom: 20px;
	    border: 1px solid transparent;
	    border-radius: 4px;
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
				<?php if(!empty($error_msg)){ ?>
					<div class="alert alert-danger">
					  <strong><?php echo $error_msg; ?></strong>
					</div>
				<?php } ?>
				<form method="POST" action="rules_setfieldvalues.php?rid=<?php echo $id; ?>&rsid=<?php echo $rsid; ?>">
					<input type="hidden" name="rid" value="<?php echo $id; ?>" >
					<input type="hidden" name="rsid" value="<?php echo $rsid; ?>" >
					<h2>Filter Information</h2>
					<table class="brand-list">
					  <tr>
					    <th>Rule Name</th>
					    <th>Field Name</th>
					    <th>Field Value</th>
					  </tr>
					  <tr>
					    <td><?php echo $rule_name; ?></td>
					    <td><?php echo $fname;  ?></td>
					    <td><?php 
					    	$afv = '';
					    $afv_list = getFieldValueSetByRule($id);							
				    	foreach ($afv_list as $row) {
					    		echo $row['fvalue'].'<br/>';
					    		$afv .= $row['fvalue'].'<br/>';
					    }
					    	?>
					    	<input type="hidden" name="fieldvalue" value="<?php echo $afv; ?>" >
					    </td>
					  </tr>
					</table>
					<br/><br/>
					<?php if($fname == 'Country') { ?> 
					<h2>Region</h2>
					<div class="row">
						<div class="col-25">
							<select name="region_id" id="region_id">
								<option value="" selected>All</option>
								<?php echo getRegionValues(); ?>
							</select>
						</div>
					</div>
					<div class="row">
						<div class="col-25">
							<input type="submit" name="enter" value="CHANGE REGION" style="margin:0;float:right;">
						</div>
					</div>				
					<h2>Add Country Value/s</h2>
					<div class="row">
						<div class="col-25">
							<select name="fieldvalue_id" id="fieldvalue_id">
								<option value="" selected>--</option>
								<?php echo getFieldCountryValues(); ?>
							</select>
						</div>
					</div>					
					<?php } 
					else { ?> 
					<h2>Add Value/s</h2>
					<div class="row">
						<div class="col-25">
							<select name="fieldvalue_id" id="fieldvalue_id" required>
								<option value="" selected>--</option>
								<?php echo getFieldValues($fname_id); ?>
							</select>
						</div>
					</div>
					<?php } ?>
					<div class="row">
						<div class="col-25">
							<input type="submit" name="submit" value="ADD" style="margin:0;float:right;">
						</div>
					</div>				
				<br/><br/>
				<?php 
				
				$addedfieldvalue_list = getFieldValueSetByRule($id);
	    		?>
				<table class="brand-list">
					<thead>
					  <tr>
					  	<th style="display:none;"></th>
					    <th>Salesforce Value</th>
					    <th>Field Value</th>
					    <th style="width:15%">Action</th>
					  </tr>
					</thead>
					<tbody id="sortable-rows">
					  <?php foreach($addedfieldvalue_list as $row) { ?>
					  <tr id='<?php echo $row['fid']; ?>'>
					  	<td style="display:none;"><?php echo $row['fsid']; ?></td>
					    <td><?php echo $row['fsvalue']; ?></td>
					    <td><?php echo $row['fvalue']; ?></td>
					    <td>
			        		<a style='text-decoration:none' href='rules_setfieldvalues_delete.php?id=<?php echo $row['fsid']; ?>&rule_id=<?php echo $id; ?>&rsid=<?php echo $rsid; ?>' onClick='return confirm('Are you sure you want to delete?')'>delete</a>
			        	</td>
					  </tr>
				  	  <?php } ?>
				  </tbody>
				</table>
				</form>
				<div class="row">
					<br/><br/>
					<a class="btn-back" href="rules.php?id=<?php echo $rsid; ?>">BACK</a>
				</div>		
			</div> 
		</div>
	</div>
</div>
</body>
</html>