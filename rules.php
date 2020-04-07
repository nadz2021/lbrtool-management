<?php
include "rules__.php";
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
	#brand-list tr:nth-child(2) td:nth-child(5) button:first-child, 
	#brand-list tr:last-child td:nth-child(5) button:nth-child(2) {
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
	#sortable-rows tr { margin-bottom:4px; margin-top:4px; padding:10px; cursor:move;}
	#sortable-rows tr.ui-state-highlight { height: 1.0em;  border:#ccc 2px dotted;}
    </style>
</head>
<body>
<div class="container">  	
	<div class="row">
		<div class="col-15">
			<?php include "__rules_sidebar.php"; ?>
		</div>
		<div class="col-85">
			<table id="brand-list">
			  <tr>
			    <th>Rule Name</th>
			    <th>Affected Pages</th>
			  </tr>
			  <tr>
			    <td><?php echo $rule_name; ?></td>
			    <td><?php echo $affected_pages; ?></td>
			  </tr>
			</table>
			<br/><br/>
			<a href="rules_create.php?id=<?php echo $id; ?>" class="add-btn">CREATE FILTER</a>
			<br/><br/>
			<h2>List of Filters</h2>
			<?php
				echo "<table id='brand-list' border='0'>";
	        if (count($rules_list[0])!=0) {
		      echo "<tr>
		      <th>Field Name</th>
		      <th>Field Value</th>
		      <th>Brand Assignment</th>
		      <th>Created Date</th>
		      <th>Actions</th>
		      </tr><tbody id='sortable-rows'>";

			    foreach($rules_list as $row) {
			?>	
				<tr id='<?php echo $row['sort_id']; ?>'>
        	<td>
        		<p><?php echo $row['fname']; ?></p>
        	</td>
        	<td>
        		<select name="fieldvalue" id="fieldvalue" multiple="multiple" style="resize: none;">
	        			<?php
	        			$fieldvalue_list = getFieldValueListByRule($row['rid']);
	        			foreach($fieldvalue_list as $fieldvalue) { ?>
	        				<option value="<?php echo $fieldvalue['fid']; ?>"><?php echo $fieldvalue['fvalue']; ?></option>
	        			<?php } ?>
        			</select>
						<br/><br/>
						<button style="display:block;margin: 0 auto;"><a style='text-decoration:none' href='rules_setfieldvalues.php?rid=<?php echo $row['rid']; ?>&rsid=<?php echo $row['rs_id']; ?>'>Add/Change Set Value/s</a></button>
					</td>
		        	<td>
		        		<select name="imprint" id="imprint" multiple="multiple" style="resize: none;">
		        			<?php
		        			$brandassign_list = getBrandAssignListByRule($row['rid']);
		        			foreach($brandassign_list as $brand) { ?>
		        				<option value="<?php echo $brand['impname']; ?>"><?php echo $brand['impname']; ?></option>
		        			<?php } ?>
		        		</select>
						<br/><br/>
						<button style="display:block;margin: 0 auto;"><a style='text-decoration:none' href='rules_leadbrand.php?rid=<?php echo $row['rid']; ?>&rsid=<?php echo $row['rs_id']; ?>'>Add/Change Brand/s</a></button>
		        	</td>
		        	<td>
		        		<p><?php echo $row['cdate']; ?></p>
		        	</td>        	
		        	<td>
		        		<a style='text-decoration:none' href='rules_delete.php?id=<?php echo $row['rid']; ?>&rsid=<?php echo $row['rs_id']; ?>' onClick='return confirm('Are you sure you want to delete?')'>delete</a>	        		
		        	</td>
		        </tr>
			<?php	        	
			    }
			    echo '</table><br/><br/>';
			}
		  
		?>
			<input name="rid" type="hidden" value="<?php echo $id; ?>">
		<?php

			$rules_default = getDefaultFieldValueListByRule($id);

	    	if (count($rules_default[0])!=0) {
		    echo "<table id='brand-list' border='0'>
		      <tr>
		      <th>Brand Assignment</th>
		      </tr>";
		    }

		    foreach($rules_default as $row) {
		        echo '<tr>';
		?>
	        	<td>
	        		<select name="imprint" id="imprint" multiple="multiple" style="resize: none;">
					<?php 
						$brandassign_list = getBrandAssignListByRule($row['rid']);
						foreach ($brandassign_list as $output) {
					?>
						<option value="<?php echo $output['impname']; ?>"><?php echo $output['impname']; ?></option>
					<?php				
						}
					?>
					</select>
					<br/><br/>
					<button style="display:block;margin: 0 auto;"><a style='text-decoration:none' href='rules_leadbrand.php?rid=<?php echo $row['rid']; ?>&rsid=<?php echo $row['rs_id']; ?>'>Add/Change Brand/s</a></button>
	        	</td>	        	
	        </tr>
		<?php
		    }
		    	echo '</table>';
		?>	
		<br/>
		<a class="btn-back" href="rules_set.php">BACK</a>
		</div>
	</div>
</div>
</body>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script> 
<script src="//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.js"></script> 
<script type="text/javascript">
<!--
 $('tbody').sortable({
 	update: function( event, ui ) {
		updateDisplayOrder();
	}
 });
// function to save display sort order  
function updateDisplayOrder() {
	var dbtablename =  'rules';
	var rid = $('input[name=rid]').val();
	var new_order = new Array();
	$('tbody tr').each(function() {
		new_order.push($(this).attr("id"));		
	});	
	new_order = new_order.filter(function(e){return e}); 


	var dataString = 'new_order='+new_order+'&table='+dbtablename+'&tid=id&rid='+rid;	
	window.location.href = 'https://lbrtool.xlibris.info/v2/rules_sort.php?' + dataString;
	
}
// --> 
</script>
</html>