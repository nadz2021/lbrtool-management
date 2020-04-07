<?php 

class ActivityLog {    
  private $micro;
  private $db_handle;
    
  function __construct($micro = null) {
    $this->micro  = !empty($micro) ? $micro : "db_main";
    $this->db_handle = new DBController($this->micro);
  }    

  function addNewLog($event,$previous_value,$current_value,$page,$user) {
    $query = "INSERT INTO logs(event,previous_value,current_value,page,user) VALUES (?, ?, ?, ?, ?)";
    $paramType = "sssss";
    $paramValue = array(
      $event, $previous_value, $current_value, $page, $user
    );
    
    $insertId = $this->db_handle->insert($query, $paramType, $paramValue);
    return $insertId;
  }

  function deleteLogData($event,$current_value,$page,$table_idname,$table_did,$table_name,$user) {
    $query = "INSERT INTO logs(event,current_value,page,table_idname,table_did,table_name,user) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $paramType = "ssssiss";
    $paramValue = array(
      $event,$current_value,$page,$table_idname,$table_did,$table_name,$user
    );
    
    $insertId = $this->db_handle->insert($query, $paramType, $paramValue);
    return $insertId;
  }
  
}
?>