<?php
include "rules_leadbrand__.php";
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
			<div class="content">
				<?php if(!empty($error_msg)){ ?>
					<div class="alert alert-danger">
					  <strong><?php echo $error_msg; ?></strong>
					</div>
				<?php } ?>
				<form method="POST" action="rules_leadbrand.php?rid=<?php echo $id; ?>&rsid=<?php echo $rsid; ?>">
					<input type="hidden" name="rid" value="<?php echo $id; ?>" >
					<input type="hidden" name="rsid" value="<?php echo $rsid; ?>" >
					<h2>Filter Information</h2>
					<?php 
						$imprint_list = getBrandAssignListByRule($id);
					?>
					<table class="brand-list">
					  <tr>
					    <th>Rule Name</th>
					    <th>Field Name</th>
					    <th>Imprint Value</th>
					  </tr>
					  <tr>
					  	<td><?php echo $rulename; ?></td>
					    <td><?php echo $fname; ?></td>
					    <td><?php echo $fvalue; ?><input type="hidden" name="imprintname" value="<?php echo $fvalue; ?>">
					    </td>
					  </tr>
					</table>
					<br/><br/>
					<h2>Assign Imprint</h2>
					<div class="row">
						<div class="col-25">
							<select name="imprint_id" id="imprint_id" required>
								<option value="" selected>Select Brand</option>
								<?php echo getBrand(); ?>
							</select>
						</div>
					</div>
					<div class="row">
						<div class="col-25">
							<label>Ratio</label>
							<input type="number" name="ratio" min="1" required />
						</div>
					</div>
					<div class="row">
						<div class="col-25">
							<input type="submit" name="submit" value="ADD" style="margin:0;float:right;">
						</div>
					</div>				
				<br/><br/>
				</form>
				<?php 
				
				$imprint_list = getBrandAssignListByRule($id);
	    		?>
				<table class="brand-list">
					<thead>
					  <tr>
					    <th>Imprint</th>
					    <th>Ratio</th>
					    <th>Current Ratio</th>
					    <th style="width:15%">Actions</th>
					  </tr>
					</thead>
					<tbody id="sortable-rows">

						<?php if (count($imprint_list[0])==1) {  
							foreach($imprint_list as $row) { ?>
						  	<tr id='<?php echo $row['assignbrand_id']; ?>'>
							    <td><input type="hidden" name="rid" value="<?php echo $id; ?>" >
									<input type="hidden" name="rsid" value="<?php echo $rsid; ?>" >
							    	<?php echo $row['impname']; ?></td>
							    <td><?php echo $row['ratio']; ?></td>
							    <td><?php echo $row['status']; ?></td>
							    <td>
				        			<a style='text-decoration:none;padding-right:10px;' href='rules_leadbrand_edit.php?id=<?php echo $row['assignbrand_id']; ?>&rule_id=<?php echo $id; ?>&rsid=<?php echo $rsid; ?>'>edit</a>
					        	</td>					        	
						  	</tr>
					  	  <?php } ?>
						<?php } 
						else { 
							foreach($imprint_list as $row) { ?>
						  	<tr id='<?php echo $row['assignbrand_id']; ?>'>
							    <td><input type="hidden" name="rid" value="<?php echo $id; ?>" >
									<input type="hidden" name="rsid" value="<?php echo $rsid; ?>" >
							    	<?php echo $row['impname']; ?></td>
							    <td><?php echo $row['ratio']; ?></td>
							    <td><?php echo $row['status']; ?></td>
							    <td>
				        			<a style='text-decoration:none;padding-right:10px;' href='rules_leadbrand_edit.php?id=<?php echo $row['assignbrand_id']; ?>&rule_id=<?php echo $id; ?>&rsid=<?php echo $rsid; ?>'>edit</a>
				        			<a style='text-decoration:none' href='rules_leadbrand_delete.php?id=<?php echo $row['assignbrand_id']; ?>&rule_id=<?php echo $id; ?>&rsid=<?php echo $rsid; ?>' onClick='return confirm('Are you sure you want to delete?')'>delete</a>			        		
					        	</td>	
						  	</tr>
					  	  	<?php } ?>
						<?php } ?>
				  </tbody>
				</table>
				<div class="row">
					<br/><br/>
					<a class="btn-back" href="rules.php?id=<?php echo $rsid; ?>">BACK</a>
				</div>		
			</div> 
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
	var dbtablename =  'assignbrand';
	var rsid = $('input[name=rsid]').val();
	var rid = $('input[name=rid]').val();
	var new_order = new Array();
	$('tbody tr').each(function() {
		new_order.push($(this).attr("id"));		
	});	
	new_order = new_order.filter(function(e){return e}); 


	var dataString = 'new_order='+new_order+'&table='+dbtablename+'&tid=assignbrand_id&rsid='+rsid+'&rid='+rid;	
	window.location.href = 'https://lbrtool.xlibris.info/v2/rules_sort.php?' + dataString;
	
	
}
// --> 
</script>
</html>