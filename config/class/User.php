<?php 

class User {
  private $micro;
  private $db_handle;
    
  function __construct($micro = null) {
    $this->micro  = !empty($micro) ? $micro : "db_main";
    $this->db_handle = new DBController($this->micro);
  }    

  function checkMicrositeToUserExist($user_id,$microsite_id) {
    $sql = "SELECT * FROM user_microsite where user_id=$user_id and microsite_id=$microsite_id ";
    $result = $this->db_handle->runBaseQuery($sql);
    return $result;
  }

  function processLogin($username, $password) {
    $sql = "SELECT * FROM users Where login ='".$username."' AND crypted_password ='".$password."' and deleted!='Y' ";
    $result = $this->db_handle->runBaseQuery($sql);
    return $result;
  }

  function getRoleIDbyUsername($username) {
    $sql = "SELECT role_id FROM users Where login ='".$username."' ";
    $result = $this->db_handle->runBaseQuery($sql);
    return $result;
  }

  function checkUserNameExist($login,$email) {
    $sql = "SELECT * FROM users WHERE login = '$login' or email = '$email' ";
    $result = $this->db_handle->runBaseQuery($sql);
    return $result;
  }

  function getAllUsers() {
    if($_SESSION['role_id']==1){ 
      $sql = "SELECT users.id as id, users.login as username, users.email as email, user_role.role_desc as role_desc from users 
        INNER JOIN user_role
        ON users.role_id = user_role.id
        where users.id>1 and deleted!='Y' ";
    }

    else {
    $sql = "SELECT users.id as id, users.login as username, users.email as email, user_role.role_desc as role_desc from users 
        INNER JOIN user_role
        ON users.role_id = user_role.id
        where users.id>1 and user_role.id>1 and deleted!='Y' ";       
    }
    $result = $this->db_handle->runBaseQuery($sql);
    return $result;
  }

  function getAllUserRoles() {
    if($_SESSION['role_id']==1) { 
      $sql = "SELECT * FROM user_role";
    }
    else {
      $sql = "SELECT * FROM user_role where id>1";
    }
    $result = $this->db_handle->runBaseQuery($sql);
    return $result;
  }

  function getUserInfoByID($id) {
    $sql = "SELECT * FROM users where id=$id";  
    $result = $this->db_handle->runBaseQuery($sql);
    return $result;
  }

  function getMicrositeListToUserByID($id) {
    $sql = "SELECT microsite_name, user_microsite.id as umid FROM user_microsite INNER JOIN microsite_db ON user_microsite.microsite_id = microsite_db.id WHERE user_microsite.user_id=$id";  
    $result = $this->db_handle->runBaseQuery($sql);
    return $result;    
  }

  function addNewUser($login,$crypted_password,$email,$role_id) {
    $query ="INSERT INTO users(login,crypted_password,email,role_id) VALUES  (?,?,?,?) ";  
    $paramType = "sssi";
    $paramValue = array(
      $login,$crypted_password,$email,$role_id
    );
    
    $insertId = $this->db_handle->insert($query, $paramType, $paramValue);
    return $insertId;
  }

  function addNewMicrositeToUser($user_id,$microsite_id) {
    $query =  "INSERT INTO user_microsite(user_id,microsite_id) VALUES (?,?)"; 
    $paramType = "ii";
    $paramValue = array(
      $user_id,$microsite_id
    );
    
    $insertId = $this->db_handle->insert($query, $paramType, $paramValue);
    return $insertId;
  }

  function deleteMicrositeToUserByID($id) {
    $query =  "DELETE FROM user_microsite WHERE id=?"; 
    $paramType = "i";
    $paramValue = array(
      $id
    );
    
    $this->db_handle->update($query, $paramType, $paramValue);
  }

  function updateUserByID($login,$crypted_password,$email,$role_id,$id) {
    $query = "UPDATE users SET login =?,crypted_password=?,email=?,role_id=? WHERE id=?";
    $paramType = "sssii";
    $paramValue = array(
      $login,$crypted_password,$email,$role_id,$id
    );
    
    $this->db_handle->update($query, $paramType, $paramValue);
  }      

  // function insertLeadData($row, $values) {
  //   $sql = "INSERT INTO leads($row)  VALUES ($values)";
  //   $result = $this->db_handle->runBaseQuery($sql);
  //   return $result;
  // }

  // function insertLIPData($request,$response,$status,$brand_name) {
  //   $query = "INSERT INTO response(request,response,status,brand_name) VALUES (?, ?, ?, ?)";
  //   $paramType = "ssss";
  //   $paramValue = array(
  //     $request,
  //     $response,
  //     $status,
  //     $brand_name
  //   );
    
  //   $insertId = $this->db_handle->insert($query, $paramType, $paramValue);
  //   return $insertId;
  // }

  // function deleteAttendanceByDate($attendance_date) {
  //   $query = "DELETE FROM tbl_attendance WHERE attendance_date = ?";
  //   $paramType = "s";
  //   $paramValue = array(
  //     $attendance_date
  //   );
  //   $this->db_handle->update($query, $paramType, $paramValue);
  // }      
}
?>