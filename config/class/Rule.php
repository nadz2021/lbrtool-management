<?php 

class Rule {
  private $micro;
  private $db_handle;
    
  function __construct($micro = null) {
    $this->micro  = !empty($micro) ? $micro : "db_main";
    $this->db_handle = new DBController($this->micro);
  }

  function addBrandToRuleByIDs($rule_id,$imprint_id,$ratio) {
    $query ="INSERT INTO assignbrand(rule_id,imprint_id,ratio,status) VALUES (?,?,?,?)";
    $paramType = "iiii";
    $paramValue = array(
      $rule_id,$imprint_id,$ratio,$ratio
    );
    
    $insertId = $this->db_handle->insert($query, $paramType, $paramValue);
    return $insertId;
  }

  function addNewRuleName($rule_name) {
    $query = "INSERT INTO rules_set(rule_name) VALUES (?)";
    $paramType = "s";
    $paramValue = array(
      $rule_name
    );
    
    $insertId = $this->db_handle->insert($query, $paramType, $paramValue);
    return $insertId;
  }

  function addNewPageToRuleSet($rule_set_id,$page_id) {
    $query = "INSERT  INTO rule_set_lp(rule_set_id,page_id) VALUES (?, ?)";
    $paramType = "ii";
    $paramValue = array(
      $rule_set_id,$page_id
    );
    
    $insertId = $this->db_handle->insert($query, $paramType, $paramValue);
    return $insertId;
  }

  function checkRuleNameExist($rule_name) {
    $sql = "SELECT rule_name FROM rules_set WHERE rule_name = '$rule_name' ";
    $result = $this->db_handle->runBaseQuery($sql);
    return $result;
  }

  function checkPageRuleSetExist($id) {
    $sql = "SELECT * FROM rule_set_lp where page_id=$id";
    $result = $this->db_handle->runBaseQuery($sql);
    return $result;
  }

  function deleteAssignBrandByID($id) {
    $query = "DELETE FROM `assignbrand` WHERE assignbrand_id=?";    
    $paramType = "i";
    $paramValue = array(
      $id
    );    
    $this->db_handle->update($query, $paramType, $paramValue);    
  }

  function deleteRuleSetByID($id) {
    $query = "UPDATE rules_set SET deleted='Y' where id=?";    
    $paramType = "i";
    $paramValue = array(
      $id
    );    
    $this->db_handle->update($query, $paramType, $paramValue);
  }

  function deleteRuleByID($id) {
    $query = "UPDATE rules SET deleted='Y' where id=?";    
    $paramType = "i";
    $paramValue = array(
      $id
    );    
    $this->db_handle->update($query, $paramType, $paramValue);
  }

  function hasDefaultRuleAssignByID($id) {
    $sql = "SELECT * FROM rules where rule_set_id=$id and fieldname_id=1";
    $result = $this->db_handle->runBaseQuery($sql);
    return $result;
  }

  function getAssignBrandInfoByID($id) {
    $sql = "SELECT * from imprint INNER JOIN assignbrand on imprint.imprint_id = assignbrand.imprint_id where assignbrand.assignbrand_id=$id";
    $result = $this->db_handle->runBaseQuery($sql);
    return $result;
  }

  function getLeadBrandRuleListByID($id) {
    $sql = "SELECT rules_set.id as rs_id, rules.id as sort_id, rules.rule_id as rid, fieldname.name as fname, rules.createddate as cdate 
      FROM rules 
      INNER JOIN fieldname 
      on fieldname.fieldname_id = rules.fieldname_id 
      INNER JOIN rules_set 
      on rules_set.id = rules.rule_set_id 
      where rules_set.id=$id and rules.fieldname_id!=1 and fieldname.deleted!='Y' and rules.deleted!='Y' order by rules.id";
    $result = $this->db_handle->runBaseQuery($sql);
    return $result;
  }

  function getFieldValueListByRuleID($id) {
    $sql = "SELECT fieldvalue.fieldvalue_id as fid,fieldvalue.fieldvalue as fvalue 
      FROM fieldvalueset 
      INNER JOIN rules 
      on fieldvalueset.rule_id = rules.rule_id 
      INNER JOIN fieldvalue 
      on fieldvalueset.fieldvalue_id = fieldvalue.fieldvalue_id 
      where rules.rule_id = $id and fieldvalueset.deleted!='Y' and fieldvalue.deleted!='Y'";
    $result = $this->db_handle->runBaseQuery($sql);
    return $result; 
  }

  function getDefaultFieldValueListByRuleID($id) {
   $sql = "SELECT rules_set.id as rs_id, rules.id as sort_id, rules.rule_id as rid, fieldname.name as fname, fieldvalue.fieldvalue as fvalue, rules.createddate as cdate FROM rules 
      INNER JOIN fieldname 
        on fieldname.fieldname_id = rules.fieldname_id 
      INNER JOIN fieldvalue 
        on fieldvalue.fieldname_id = fieldname.fieldname_id 
      INNER JOIN rules_set 
        on rules_set.id = rules.rule_set_id where rules.rule_set_id=$id and rules.fieldname_id = 1 order by rules.id";
    $result = $this->db_handle->runBaseQuery($sql);
    return $result;  
  }

  function getFieldValueSetByRuleID($id) {
    $sql = "SELECT fieldvalueset.fieldvalueset_id as fsid, fieldvalue.fieldvalue_id as fid, fieldvalue.salesforcevalue as fsvalue, fieldvalue.fieldvalue as fvalue 
      FROM fieldvalueset 
      INNER JOIN rules 
      on fieldvalueset.rule_id = rules.rule_id 
      INNER JOIN fieldvalue 
      on fieldvalueset.fieldvalue_id = fieldvalue.fieldvalue_id 
      where rules.rule_id =$id and fieldvalue.deleted!='Y' and fieldvalueset.deleted!='Y' ";
    $result = $this->db_handle->runBaseQuery($sql);
    return $result; 
  }

  function getFieldValueListInRulesByID($id) {
    $sql = "SELECT rules_set.id as rsid, rules.rule_id as rid, fieldname.name as name, rules.fieldname_id as fname_id
    FROM rules 
    INNER JOIN fieldname 
      on fieldname.fieldname_id = rules.fieldname_id 
    INNER JOIN rules_set 
      on rules_set.id = rules.rule_set_id 
      where fieldname.deleted!='Y' and rules.rule_id=$id";
    $result = $this->db_handle->runBaseQuery($sql);
    return $result;  
  }

  function getBrandAssignListByRuleID($id) {
    $sql = "SELECT imprint.imprint_name as impname, assignbrand.ratio as ratio, assignbrand.status as status, assignbrand.assignbrand_id as assignbrand_id
      FROM assignbrand 
      INNER JOIN imprint
      on imprint.imprint_id = assignbrand.imprint_id
      where assignbrand.rule_id=$id and assignbrand.deleted!='Y'and imprint.deleted!='Y'";
    $result = $this->db_handle->runBaseQuery($sql);
    return $result; 
  }

  function getAllLeadBrandRulesByID($id) {
    $sql = "SELECT rules_set.rule_name as rule_name, page.page_name as page_name FROM rules_set INNER JOIN rule_set_lp on rule_set_lp.rule_set_id = rules_set.id INNER JOIN page on page.id = rule_set_lp.page_id WHERE page.deleted!='Y' and rules_set.id=$id";    
    $result = $this->db_handle->runBaseQuery($sql);
    return $result;
  }  
  
  function getPageNameByID($id) {
    $sql = "SELECT page_name FROM page WHERE id=$id";
    $result = $this->db_handle->runBaseQuery($sql);
    return $result;
  }
  
  function getPagesByRuleByID($id) {
    $sql = "SELECT page.page_name as lp_name FROM rule_set_lp INNER JOIN page ON page.id = rule_set_lp.page_id WHERE rule_set_lp.rule_set_id=$id";
    $result = $this->db_handle->runBaseQuery($sql);
    return $result;
  }

  function getRuleByID($id) {    
    $sql = "SELECT * FROM rules_set where id=$id";
    $result = $this->db_handle->runBaseQuery($sql);
    return $result;
  }

  function getRuleSetInfoByID($id) {
    $sql = "SELECT rule_name FROM rules_set where rules_set.id=$id";
    $result = $this->db_handle->runBaseQuery($sql);
    return $result;  
  }


  function insertRuleByIDs($fid,$rsid) {
   $query = "INSERT INTO rules(fieldname_id,rule_set_id) VALUES  (?,?)";
    $paramType = "ii";
    $paramValue = array(
      $fid,$rsid
    );
    
    $insertId = $this->db_handle->insert($query, $paramType, $paramValue);
    return $insertId;
  }

  function insertDefaultRuleByID($id) {
   $query = "INSERT INTO rules(fieldname_id,rule_set_id) VALUES  (1,?)";
    $paramType = "i";
    $paramValue = array(
      $id
    );
    
    $insertId = $this->db_handle->insert($query, $paramType, $paramValue);
    return $insertId;
  }

  function sortRulesIDs($table,$old_id,$new_id) {
    $query = "UPDATE ".$table." SET id=? where id=?";
    $paramType = "ii";
    $paramValue = array(
      $old_id,$new_id
    );    
    $this->db_handle->update($query, $paramType, $paramValue);
  }

  function sortAssignBrandIDs($table,$old_id,$new_id) {
    $query = "UPDATE ".$table." SET assignbrand_id=? where assignbrand_id=?";
    $paramType = "ii";
    $paramValue = array(
      $old_id,$new_id
    );    
    $this->db_handle->update($query, $paramType, $paramValue);
  }

  function updateRuleByNewID($id) {
    $query = "UPDATE rules SET rule_id=? WHERE id=?";    
    $paramType = "ii";
    $paramValue = array(
      $id, $id
    );    
    $this->db_handle->update($query, $paramType, $paramValue);
  }

  function updateAssignBrandID($ratio,$status,$id) {
    $query = "UPDATE assignbrand SET ratio=?,status=? where assignbrand_id=?";    
    $paramType = "iii";
    $paramValue = array(
      $ratio,$status,$id
    );    
    $this->db_handle->update($query, $paramType, $paramValue);
  }

  function updateRuleByID($rule_name,$id) {
    $query = "UPDATE rules_set SET rule_name=? WHERE id=?";    
    $paramType = "si";
    $paramValue = array(
      $rule_name, $id
    );    
    $this->db_handle->update($query, $paramType, $paramValue);
  }

}
?>