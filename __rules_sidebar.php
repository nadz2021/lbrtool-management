<style>
  .sidenav { width: 200px; }
  .sidenav a { font-size: 20px; }
  .microsite_title { position: absolute; top: 0; width: 98%; text-align: center; }
  .container > .row > .col-85 { padding-top: 30px; }
</style>

<h1 class="microsite_title"><?php echo $_SESSION['microsite_name']; ?></h1>
<div class="sidenav">
  <?php if($_SESSION['role_id']>1) {  ?>
    <a href="user_info.php?id=<?php echo $_SESSION['user_id']; ?>">User Info</a>
  <?php } ?>
  <a href="microsite_db.php">Select Microsite</a>  
  <?php if($_SESSION['role_id']!=4) {  ?>
    <a href="response.php">Response Log</a>  
  <?php } ?>
  <?php if(($_SESSION['microsite_name']!="www.GEMINI.com") && ($_SESSION['microsite_name']!="www.findpublishinghelp.com")) { 
    if($_SESSION['role_id']!=4) { ?>

    <a href="rules_set.php">Rules</a>
  <?php } } 
  
    
  if(($_SESSION['role_id']!=2) && ($_SESSION['role_id']!=4)) {     
  echo '<a href="fieldnames.php">Form Field Names</a>';
  echo '<a href="fieldvalues.php">Form Field Values</a>';
  echo '<a href="imprintbrand.php">Imprint Brand</a>';
  echo '<a href="landing_page.php">Landing Page</a>';

  if(($_SESSION['role_id']!=2) && ($_SESSION['microsite_name']=="Main")){ 
    if($_SESSION['role_id']==1){ ?>
      <a href="microsite.php">Microsite URL/DB</a>   
    <?php } ?>
    <a href="users.php">Users</a>   
  <?php } ?>
   <a href="activitylogs.php">Log/s History</a>
  <?php } ?>
</div>