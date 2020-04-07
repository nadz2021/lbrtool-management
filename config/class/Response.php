<?php 

class Response {    
  private $micro;
  private $db_handle;
    
  function __construct($micro = null) {
    $this->micro  = !empty($micro) ? $micro : "db_main";
    $this->db_handle = new DBController($this->micro);
  }    

  function getAllResponseLogsWithStatus($start,$end,$status) {        
    $sql = "SELECT *FROM response WHERE date BETWEEN '".$start."' AND '".$end."' AND status = '".$status."' ";
    $result = $this->db_handle->runBaseQuery($sql);
    return $result;
  }

  function getAllResponseLogs($start,$end) {
    $sql = "SELECT *FROM response Where date between '".$start."' AND '".$end."' ";
    $result = $this->db_handle->runBaseQuery($sql);
    return $result;
  }

  function getResponseInfoByID($id) {        
    $sql = "SELECT * FROM response where id=$id";
    $result = $this->db_handle->runBaseQuery($sql);
    return $result;
  }

  function updateResponseStatusByID($status,$request,$response,$id) { 
    $query = "UPDATE response SET status=?, request=?, response=? WHERE id=?";  
    $paramType = "sssi";
    $paramValue = array(
      $status,$request,$response,$id
    );    
    $this->db_handle->update($query, $paramType, $paramValue);
  }

  
}
?>