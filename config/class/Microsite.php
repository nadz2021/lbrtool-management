<?php 

class Microsite {
  private $micro;
  private $db_handle;
    
  function __construct($micro = null) {
    $this->micro  = !empty($micro) ? $micro : "db_main";
    $this->db_handle = new DBController($this->micro);
  }    
  

  function addNewFieldName($name,$fieldname,$microsite_fieldname) {
    $query = "INSERT INTO fieldname(name,fieldname,microsite_fieldname) VALUES  (?,?,?)";
    $paramType = "sss";
    $paramValue = array(
      $name,$fieldname,$microsite_fieldname
    );
    
    $insertId = $this->db_handle->insert($query, $paramType, $paramValue);
    return $insertId;
  }

  function addNewFieldValue($fieldvalue,$salesforcevalue,$fieldname_id) {
    $query = "INSERT INTO fieldvalue(fieldvalue, salesforcevalue, fieldname_id, status) VALUES  (?,?,?,1)";
    $paramType = "ssi";
    $paramValue = array(
      $fieldvalue,$salesforcevalue,$fieldname_id
    );
    
    $insertId = $this->db_handle->insert($query, $paramType, $paramValue);
    return $insertId;
  }

  function addNewImprintName($imprint_name,$imprint_desc,$salesforcevalue) {
    $query = "INSERT INTO imprint(imprint_name, imprint_desc, salesforcevalue, status) VALUES (?,?,?,1)";  
    $paramType = "sss";
    $paramValue = array(
      $imprint_name,$imprint_desc,$salesforcevalue
    );
    
    $insertId = $this->db_handle->insert($query, $paramType, $paramValue);
    return $insertId;
  }

  function addNewPageName($page_name) {
    $query = "INSERT INTO page(page_name) VALUES (?)";  
    $paramType = "s";
    $paramValue = array(
      $page_name
    );
    
    $insertId = $this->db_handle->insert($query, $paramType, $paramValue);
    return $insertId;
  }

  function addNewMicrosite($microsite_name,$microsite_db) {
    $query = "INSERT INTO microsite_db(microsite_name,microsite_db) VALUES  (?,?)";  
    $paramType = "ss";
    $paramValue = array(
      $microsite_name,$microsite_db
    );
    
    $insertId = $this->db_handle->insert($query, $paramType, $paramValue);
    return $insertId;
  }

  function checkImprintNameExist($imprint_name,$salesforcevalue) {
    $sql = "SELECT * FROM imprint WHERE imprint_name='".$imprint_name."' or salesforcevalue='".$salesforcevalue."' ";
    $result = $this->db_handle->runBaseQuery($sql);
    return $result;
  }

  function checkFieldValueOnFieldNameByNames($fieldvalue,$salesforcevalue) {
    $sql = "SELECT * FROM fieldvalue WHERE fieldvalue = '".$fieldvalue."' or salesforcevalue = '".$salesforcevalue."' ";
    $result = $this->db_handle->runBaseQuery($sql);
    return $result;
  }

  function deleteFieldNameByID($id) {
    $query = "UPDATE fieldname SET deleted='Y' where fieldname_id=?";
    $paramType = "i";
    $paramValue = array(
      $id
    );    
    $this->db_handle->update($query, $paramType, $paramValue);
  }

  function deleteMicrositeByID($id) {
    $sql = "DELETE FROM microsite_db WHERE id=$id";
    $result = $this->db_handle->runBaseQuery($sql);
    return $result;
  }

  function deleteFieldValueByID($id) {
    $query = "UPDATE fieldvalue SET deleted='Y' where fieldvalue_id=?";
    $paramType = "i";
    $paramValue = array(
      $id
    );    
    $this->db_handle->update($query, $paramType, $paramValue);
  }

  function deletePageByID($id) {
    $query = "UPDATE page SET deleted='Y' where id=?";
    $paramType = "i";
    $paramValue = array(
      $id
    );    
    $this->db_handle->update($query, $paramType, $paramValue);
  }

  function deleteImprintNameByID($id) {
    $query ="UPDATE imprint SET deleted='Y' where imprint_id=$id";
    $paramType = "i";
    $paramValue = array(
      $id
    );    
    $this->db_handle->update($query, $paramType, $paramValue);
  }

  function assignBrandToRuleByIDs($rule_id,$imprint_id) {
    $sql = "SELECT * FROM assignbrand WHERE rule_id=$rule_id AND imprint_id=$imprint_id";
    $result = $this->db_handle->runBaseQuery($sql);
    return $result;
  }

  function checkFieldNameByNames($name,$fieldname) {  
    $sql = "SELECT * FROM fieldname WHERE name ='".$name."' or fieldname = '".$fieldname."' ";
    $result = $this->db_handle->runBaseQuery($sql);
    return $result;
  }
  function getAllMicrosites() {
    $sql = "SELECT * FROM microsite_db order by microsite_name asc";
    $result = $this->db_handle->runBaseQuery($sql);
    return $result;
  }

  function getImprintByID($id) {
    $sql = "SELECT imprint_name FROM imprint WHERE deleted!='Y' and imprint_id=$id";
    $result = $this->db_handle->runBaseQuery($sql);
    return $result; 
  }

  function getAllBrand() {
    $sql = "SELECT * FROM imprint WHERE deleted!='Y' ";
    $result = $this->db_handle->runBaseQuery($sql);
    return $result;
  }

  function getAllActivityLogs() {
    $sql = "SELECT *from logs order by id desc";
    $result = $this->db_handle->runBaseQuery($sql);
    return $result;
  }

  function getActivityLimitByNumber($page,$number) {
    $sql = "SELECT *FROM logs ORDER BY id desc LIMIT $page, $number";
    $result = $this->db_handle->runBaseQuery($sql);
    return $result; 
  }

  function getAllFieldName() {
    $sql = "SELECT * FROM fieldname where fieldname_id>1 and deleted!='Y' ";
    $result = $this->db_handle->runBaseQuery($sql);
    return $result;
  }

  function getAllMicrositeList() {
    $sql = "SELECT *from microsite_db group by microsite_db";
    $result = $this->db_handle->runBaseQuery($sql);
    return $result;
  }

  function getAllImprint() {
    $sql = "SELECT * FROM imprint where deleted!='Y'";
    $result = $this->db_handle->runBaseQuery($sql);
    return $result;
  }
  
  function getFieldValueListByID($id) {
    $sql = "SELECT * FROM fieldvalue INNER JOIN fieldname  on fieldname.fieldname_id = fieldvalue.fieldname_id where fieldvalue.deleted!='Y' and fieldvalue.fieldname_id=$id";
    $result = $this->db_handle->runBaseQuery($sql);
    return $result; 
  }

  function getFieldValuesByID($id) {
    $sql = "SELECT fieldvalue_id, fieldvalue FROM fieldvalue WHERE deleted!='Y' and fieldname_id=$id";
    $result = $this->db_handle->runBaseQuery($sql);
    return $result; 
  }

  function getFieldNameInfoByID($id) {
    $sql = "SELECT * FROM fieldname where fieldname_id=$id";
    $result = $this->db_handle->runBaseQuery($sql);
    return $result; 
  }

  function getPageInfoByName($page_name) {
    $sql = "SELECT * FROM page WHERE page_name = '".$page_name."' ";
    $result = $this->db_handle->runBaseQuery($sql);
    return $result; 
  }

  function getMicrositeInfoByNames($microsite_name,$microsite_db) {
    $sql = "SELECT * FROM microsite_db WHERE microsite_name = '".$microsite_name."' or microsite_db='".$microsite_db."' ";
    $result = $this->db_handle->runBaseQuery($sql);
    return $result; 
  }

  function getPageInfoByID($id) {
    $sql = "SELECT * FROM page WHERE id=$id";
    $result = $this->db_handle->runBaseQuery($sql);
    return $result; 
  }

  function getMicrositeInfoByID($id) {
    $sql =" SELECT * FROM microsite_db where id=$id";
    $result = $this->db_handle->runBaseQuery($sql);
    return $result; 
  }

  function getFieldValueInfoByID($id) {
    $sql = "SELECT * FROM fieldvalue where fieldvalue_id=$id";
    $result = $this->db_handle->runBaseQuery($sql);
    return $result; 
  }

  function getImprintInfoByID($id) {
    $sql = "SELECT * FROM imprint where imprint_id=$id";
    $result = $this->db_handle->runBaseQuery($sql);
    return $result; 
  }

  function getRegionValuesByID($id) {
    $sql = "SELECT fieldvalue_id FROM fieldvalue WHERE deleted!='Y' and description='".$id."' ";
    $result = $this->db_handle->runBaseQuery($sql);
    return $result; 
  }

  function getFieldValueSetByIDs($rid,$fid) {
    $sql = "SELECT * FROM fieldvalueset WHERE rule_id=$rid AND fieldvalue_id=$fid";
    $result = $this->db_handle->runBaseQuery($sql);
    return $result; 
  }

  function getAllMicrositesByUser($user) {
    $sql = "SELECT * FROM microsite_db  INNER JOIN user_microsite  ON microsite_db.id = user_microsite.microsite_id  INNER JOIN users  ON users.id = user_microsite.user_id  WHERE users.login='".$user."' order by microsite_db asc";
    $result = $this->db_handle->runBaseQuery($sql);
    return $result;
  }
  
  function getMicrositeNamebyDBname($db_name) {
    $sql = "SELECT microsite_name FROM microsite_db  WHERE microsite_db='".$db_name."' ";
    $result = $this->db_handle->runBaseQuery($sql);
    return $result;
  }

  function getRegionList() {
    $sql = "SELECT DISTINCT description FROM fieldvalue WHERE fieldname_id=4 ORDER BY description";
    $result = $this->db_handle->runBaseQuery($sql);
    return $result; 
  }

  function getFieldValueByCountryList() {
    $sql = "SELECT fieldvalue_id, fieldvalue FROM fieldvalue WHERE deleted!='Y' and fieldname_id=4";
    $result = $this->db_handle->runBaseQuery($sql);
    return $result; 
  }  

  function getFieldValueCountryListByID($id) {
    $sql = "SELECT fieldvalue_id, fieldvalue from fieldvalue where deleted!='Y' and description='".$id."'";
    $result = $this->db_handle->runBaseQuery($sql);
    return $result; 
  }  

  function getAllRulesByDB() {    
    $sql = "SELECT *FROM rules_set WHERE id>1 and deleted!='Y' ";
    $result = $this->db_handle->runBaseQuery($sql);
    return $result;
  }

  function getAllPagesByMicrosite() {
    $sql = "SELECT * FROM page WHERE deleted!='Y' group by page_name asc";    
    $result = $this->db_handle->runBaseQuery($sql);
    return $result;
  }

  function getAllPagesWithStatus() {
    $sql = "SELECT page.id as id, page.page_name as pname, page.date as date_created, rule_set_lp.id as assign from page left join rule_set_lp on page.id = rule_set_lp.page_id where page.deleted!='Y' group by page.page_name asc";
    $result = $this->db_handle->runBaseQuery($sql);
    return $result;
  }

  function getfieldvalueByID($id) {
    $sql = "SELECT * FROM fieldvalue where fieldvalue_id=$id";    
    $result = $this->db_handle->runBaseQuery($sql);
    return $result;
  }

  function getSelectedPagesByRuleSetID($id) {    
    $sql = "SELECT page.page_name as lp_name 
      FROM rule_set_lp 
      INNER JOIN rules_set
        ON rules_set.id = rule_set_lp.rule_set_id
      INNER JOIN page
        ON page.id = rule_set_lp.page_id WHERE rules_set.id=$id and rules_set.deleted!='Y' and rule_set_lp.deleted!='Y' and page.deleted!='Y' and rule_set_lp.deleted!='Y' ";
    $result = $this->db_handle->runBaseQuery($sql);
    return $result;
  }

  function deleteFieldValueSetByID($id) {
    $query = "DELETE FROM fieldvalueset WHERE fieldvalueset_id=?";
    $paramType = "i";
    $paramValue = array(
      $id
    );    
    $this->db_handle->update($query, $paramType, $paramValue);
  }

  function insertFieldValueSetByIDs($rid,$fid) {
   $query = "INSERT INTO fieldvalueset(rule_id,fieldvalue_id) VALUES  (?,?)";
    $paramType = "ii";
    $paramValue = array(
      $rid,$fid
    );
    
    $insertId = $this->db_handle->insert($query, $paramType, $paramValue);
    return $insertId;
  }

  function updateFieldNameByID($name,$fieldname,$microsite_fieldname,$id) {
    $query = "UPDATE fieldname SET name=?, fieldname=?, microsite_fieldname =? WHERE fieldname_id=?";
    $paramType = "sssi";
    $paramValue = array(
      $name,$fieldname,$microsite_fieldname,$id
    );    
    $this->db_handle->update($query, $paramType, $paramValue);
  }

  function updateFieldValueByID($fieldvalue,$salesforcevalue,$fieldname_id,$id) {    
    $query = "UPDATE fieldvalue SET fieldvalue=?, salesforcevalue=?, fieldname_id=? WHERE fieldvalue_id=?";
    $paramType = "ssii";
    $paramValue = array(
      $fieldvalue,$salesforcevalue,$fieldname_id,$id
    );    
    $this->db_handle->update($query, $paramType, $paramValue);
  }

  function updateImprintNameByID($imprint_name,$imprint_desc,$salesforcevalue,$id) { 
    $query = "UPDATE imprint SET imprint_name=?, imprint_desc=?, salesforcevalue=? WHERE imprint_id=?";
    $paramType = "sssi";
    $paramValue = array(
      $imprint_name,$imprint_desc,$salesforcevalue,$id
    );    
    $this->db_handle->update($query, $paramType, $paramValue);
  }

  function updatePageByID($page_name,$id) { 
    $query = "UPDATE page SET page_name =? WHERE id=?";  
    $paramType = "si";
    $paramValue = array(
      $page_name,$id
    );    
    $this->db_handle->update($query, $paramType, $paramValue);
  }

  function updateMicrositeByID($microsite_name,$microsite_db,$id) { 
    $query = "UPDATE microsite_db SET microsite_name =?, microsite_db =? WHERE id=?";  
    $paramType = "ssi";
    $paramValue = array(
      $microsite_name,$microsite_db,$id
    );    
    $this->db_handle->update($query, $paramType, $paramValue);
  }

}
?>