<?php
session_start();
include "config/functions.php";
isLogin();
$activity_logs = getActivityLogs();

if (isset($_GET['pageno'])) {
    $pageno = $_GET['pageno'];
} else {
    $pageno = 1;
}
$no_of_records_per_page = 10;
$offset = ($pageno-1) * $no_of_records_per_page; 
$total_rows = count($activity_logs);
$total_pages = ceil($total_rows / $no_of_records_per_page);
$activity_list = getActivityLimit($offset,$no_of_records_per_page);

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
	

	.container {
	border-radius: 5px;
	background-color: #eee;
	padding: 20px;
	}


	.col-15 {
	float: left;
	width: 15%;
	margin-top: 6px;
	}


	.col-85 {
	float: left;
	width: 85%;
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
	
	.pagination {
    display: inline-block;
    padding-left: 0;
	}

	.pagination li {
    list-style-type: none;
    color: black;
    float: left;
    text-decoration: none;
	}

	.pagination a {
		border-radius: 5px;
	  color: black;
	  float: left;
	  padding: 8px 16px;
	  text-decoration: none;
	}

	.pagination a.active {
		border-radius: 5px;
	  background-color: #4CAF50;
	  color: white;
	}

	.pagination a:hover:not(.active) {background-color: #ddd;}
	
    </style>
</head>
<body>
<div class="container">  	
	<div class="row">
		<div class="col-15">
			<?php include "__rules_sidebar.php"; ?>
		</div>
		<div class="col-85">
			<h2>Activity Logs</h2>
		<?php

	    	
	    	

		      echo "<table id='brand-list' border='0'>";
			      echo "<tr>
			      <th>Event</th>
			      <th>Previous Value</th>
			      <th>Current Value</th>
			      <th>Page</th>
			      <th>Created Date</th>
			      <th>User Name</th>
			      </tr>";
		        

		      

		    foreach ($activity_list as $row) {
		        echo '<tr>';
		?>
	        	<td><p><?php echo $row['event']; 
	        		if($row['event']=='deleted') { ?>
	        			| <a href="activitylogs_retrieve.php?id=<?php echo $row['id']; ?>&table_idname=<?php echo $row['table_idname']; ?>&table_did=<?php echo $row['table_did']; ?>&table_name=<?php echo $row['table_name']; ?>" class="add-btn">restore?</a>
	        		<?php } ?>
	        		</p>
	        	</td>
	        	<td><p><?php echo $row['previous_value']; ?></p></td>
	        	<td><p><?php echo $row['current_value']; ?></p></td>
	        	<td><p><?php echo $row['page']; ?></p></td>
	        	<td><p><?php echo $row['date']; ?></p></td>
	        	<td><p><?php echo $row['user']; ?></p></td>
	        </tr>
		<?php }  ?>
	        </table>
			<ul class="pagination">
			    <li><a href="?pageno=1" class="<?php if($pageno == 1){ echo 'active'; } ?>">First</a></li>
			    <?php for($i=2;$i<=$total_pages-1;$i++) { ?>
			    <li>
			        <a href="<?php echo "?pageno=".$i; ?>" class="<?php if($pageno == $i){ echo 'active'; } ?>"><?php echo $i; ?></a>
			    </li>
			        <?php } ?>
			    <li><a href="?pageno=<?php echo $total_pages; ?>" class="<?php if($pageno == $total_pages){ echo 'active'; } ?>">Last</a></li>
			</ul>	
			<br/>		
			<ul class="pagination">
			    <li class="<?php if($pageno <= 1){ echo 'disabled'; } ?>">
			        <a href="<?php if($pageno <= 1){ echo '#'; } else { echo "?pageno=".($pageno - 1); } ?>">«</a>
			    </li>			    
			    <li class="<?php if($pageno >= $total_pages){ echo 'disabled'; } ?>">
			        <a href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo "?pageno=".($pageno + 1); } ?>">»</a>
			    </li>
			</ul>			
		</div>
	</div>
</div>
</body>
</html>