<?php 
include ("class/DBController.php");
include ("class/Microsite.php");
include ("class/User.php");
include ("class/Rule.php");
include ("class/ActivityLog.php");
include ("class/Response.php");


function assignBrandToRule($rule_id,$imprint_id) {
	$microsite = new Microsite($_SESSION['microsite_db']);
	$results = $microsite->assignBrandToRuleByIDs($rule_id,$imprint_id);	
	return $results;
}

function loginUser($username, $password) {
	$user = new User();
	$result = $user->processLogin($username, $password);	
	$_SESSION['user_id'] = $result[0]['id'];
	if(empty($result)){
		return false;
	}
	else {
		return true;
	}		
}

function isLogin() {
	if($_SESSION['isLogin'] != 1) {
		header("location:index.php");
	}
	if(!isset($_SESSION['counter'])) {
		if(!isset($_SESSION['authenticity'])) {
	  	header('Location: index.php');
		}
	}	
}

function isAdmin() {
	if($_SESSION['microsite_name']=="Main" && $_SESSION['role_id']!=1) {
		header('location:microsite_db.php');
	}
}

function checkFieldName($name,$fieldname) {
	$microsite = new Microsite($_SESSION['microsite_db']);
	$result = $microsite->checkFieldNameByNames($name,$fieldname);
	return $result;	
}

function checkFieldValueOnFieldName($fieldvalue,$salesforcevalue) {
	$microsite = new Microsite($_SESSION['microsite_db']);
	$result = $microsite->checkFieldValueOnFieldNameByNames($fieldvalue,$salesforcevalue);
	return $result;		
}

function checkImprintName($imprint_name,$salesforcevalue) {
	$microsite = new Microsite($_SESSION['microsite_db']);
	$result = $microsite->checkImprintNameExist($imprint_name,$salesforcevalue);
	return $result;
}

function checkMicrositeToUser($user_id,$microsite_id) {
	$user = new User();
	$result = $user->checkMicrositeToUserExist($user_id,$microsite_id);
	return $result;
}

function checkPageRule($page_id) {
	$rule = new Rule($_SESSION['microsite_db']);
	$result = $rule->checkPageRuleSetExist($page_id);
	return $result;
}

function checkRuleName($rule_name) {
	$rule = new Rule($_SESSION['microsite_db']);
	$result = $rule->checkRuleNameExist($rule_name);
	return $result;	
}

function checkUser($login,$email) {
	$user = new User();
	$result = $user->checkUserNameExist($login,$email);
	return $result;	
}

function deleteFieldName($id) {
	$microsite = new Microsite($_SESSION['microsite_db']);
	$result = $microsite->deleteFieldNameByID($id);
	return $result;
}

function deleteMicrosite($id) {
	$microsite = new Microsite();
	$result = $microsite->deleteMicrositeByID($id);
	return $result;
}

function deleteFieldValue($id) {
	$microsite = new Microsite($_SESSION['microsite_db']);
	$result = $microsite->deleteFieldValueByID($id);
	return $result;
}

function deletePage($id) {
	$microsite = new Microsite($_SESSION['microsite_db']);
	$result = $microsite->deletePageByID($id);
	return $result;
}

function deleteImprintName($id) {
	$microsite = new Microsite($_SESSION['microsite_db']);
	$result = $microsite->deleteImprintNameByID($id);
	return $result;
}

function deleteRuleSet($id) {
	$rule = new Rule($_SESSION['microsite_db']);
	$result = $rule->deleteRuleSetByID($id);
	return $result;
}

function deleteRule($id) {
	$rule = new Rule($_SESSION['microsite_db']);
	$result = $rule->deleteRuleByID($id);
	return $result;
}

function deleteAssignBrand($id) {
	$rule = new Rule($_SESSION['microsite_db']);
	$result = $rule->deleteAssignBrandByID($id);
	return $result;
}
                   
function deleteLog($event,$current_value,$page,$table_idname,$table_did,$table_name,$user) {	
	$log = new ActivityLog($_SESSION['microsite_db']);
	$result = $log->deleteLogData($event,$current_value,$page,$table_idname,$table_did,$table_name,$user);
	return $result;
}

function getActivityLogs() {
	$microsite = new Microsite($_SESSION['microsite_db']);
	$results = $microsite->getAllActivityLogs();
	return $results;
}

function getActivityLimit($offset,$no_of_records_per_page) {
	$microsite = new Microsite($_SESSION['microsite_db']);
	$results = $microsite->getActivityLimitByNumber($offset,$no_of_records_per_page);
	return $results;
}


function getBrand() {
	$microsite = new Microsite($_SESSION['microsite_db']);
	$brand = $microsite->getAllBrand();
	$options = '';
	foreach($brand as $row) {
		$options .= '<option value="'.$row['imprint_id'].'">'.$row['imprint_name'].'</option>';	
	}
	return $options;
}

function getAssignBrandInfo($id) {
	$rule = new Rule($_SESSION['microsite_db']);
	$result = $rule->getAssignBrandInfoByID($id);
	return $result;
}

function getFieldNameList() {
	$microsite = new Microsite($_SESSION['microsite_db']);
	$results = $microsite->getAllFieldName();
	return $results;
}

function getImprintList() {
	$microsite = new Microsite($_SESSION['microsite_db']);
	$results = $microsite->getAllImprint();
	return $results;
}

function getFieldName($SelectedFieldName) {
	$options = '';
	$microsite = new Microsite($_SESSION['microsite_db']);
	$fieldname_list = $microsite->getAllFieldName();
	
	foreach ($fieldname_list as $row) {
		if($row['fieldname_id'] == $SelectedFieldName){
			$options .= '<option value="'.$row['fieldname_id'].'" selected>'.$row['name'].'</option>';	
		}
		else {
			$options .= '<option value="'.$row['fieldname_id'].'">'.$row['name'].'</option>';			
		}
	}
	return $options;
}

function getFieldNameInfo($id) {
	$rule = new Microsite($_SESSION['microsite_db']);
	$result = $rule->getFieldNameInfoByID($id);
	return $result;
}

function getFieldValueInfo($id) {
	$micrsoite = new Microsite($_SESSION['microsite_db']);
	$result = $micrsoite->getFieldValueInfoByID($id);
	return $result;
}

function getImprintInfo($id) {
	$micrsoite = new Microsite($_SESSION['microsite_db']);
	$result = $micrsoite->getImprintInfoByID($id);
	return $result;
}

function getResponseInfo($id) {
	$response = new Response($_SESSION['microsite_db']);
	$result = $response->getResponseInfoByID($id);
	return $result;
}

function getFieldValueListByRule($rid) {
	$rule = new Rule($_SESSION['microsite_db']);
	$result = $rule->getFieldValueListByRuleID($rid);
	return $result;
}

function getDefaultFieldValueListByRule($rid) {
	$rule = new Rule($_SESSION['microsite_db']);
	$result = $rule->getDefaultFieldValueListByRuleID($rid);
	return $result;
}

function getFieldValueListInRules($id) {
	$rule = new Rule($_SESSION['microsite_db']);
	$result = $rule->getFieldValueListInRulesByID($id);
	return $result;
}

function getFieldValues($fname_id) {
	$microsite = new Microsite($_SESSION['microsite_db']);
	$fieldvalues = $microsite->getFieldValuesByID($fname_id);		

	$options = '';
	foreach ($fieldvalues as $row) {
		$options .= '<option value="'.$row['fieldvalue_id'].'">'.$row['fieldvalue'].'</option>';	
	}
	return $options;
}

function getFieldValueSetByRule($id) {
	$rule = new Rule($_SESSION['microsite_db']);
	$result = $rule->getFieldValueSetByRuleID($id);
	return $result;
}

function getBrandAssignListByRule($rid) {
	$rule = new Rule($_SESSION['microsite_db']);
	$result = $rule->getBrandAssignListByRuleID($rid);
	return $result;
}

function getLeadBrandRulesInfo($id) {
	$rule = new Rule($_SESSION['microsite_db']);
	$result = $rule->getAllLeadBrandRulesByID($id);
	return $result;
}

function getLeadBrandRuleList($id) {
	$rule = new Rule($_SESSION['microsite_db']);
	$result = $rule->getLeadBrandRuleListByID($id);
	return $result;
}

function getMicrosite() {

	$options = '';
	$options .= '<option>Select</option>';	
	$microsite = new Microsite();
	if($_SESSION['role_id'] != 2) {
		$options .= '<option value="trafford_micrositeLeads">Main</option>';
		$microsite_list = $microsite->getAllMicrosites();		
	}
	else {
		$user = $_SESSION['username'];
		$microsite_list = $microsite->getAllMicrositesByUser($user);
	}
	foreach ($microsite_list as $row) {
		$options .= '<option value="'.$row['microsite_db'].'">'.$row['microsite_name'].'</option>';				
	}
	return $options;
}

function getMicrositeListByUsers() {
	$microsite = new Microsite();
	$microsite_list = $microsite->getAllMicrosites();
	$options = '';
	$options .= '<option>Select Microsite</option>';
	foreach($microsite_list as $row) {
		$options .= '<option value="'.$row['id'].'">'.$row['microsite_name'].'</option>';				
	}
	return $options;
}

function getMicrositeName($microsite_db) {
	$microsite = new Microsite();
	$microsite_name = $microsite->getMicrositeNamebyDBname($microsite_db);
	return $microsite_name[0]['microsite_name'];
}

function getMicrositeList() {
	$microsite = new Microsite();
	$results = $microsite->getAllMicrositeList();
	return $results;
}

function getMicrositeListToUser($id) {
	$user = new User();
	$results = $user->getMicrositeListToUserByID($id);
	return $results;
}

function getRuleList() {
	$microsite = new Microsite($_SESSION['microsite_db']);
	$results = $microsite->getAllRulesByDB();	
	return $results;
}

function getUsers() {
	$users = new User($_SESSION['microsite_db']);
	$results = $users->getAllUsers();	
	return $results;
}

function getRuleSetInfo($rsid) {
	$rule = new Rule($_SESSION['microsite_db']);
  $result = $rule->getRuleSetInfoByID($rsid);	
	return $result;
}

function getPageInfo($page_name) {
	$microsite = new Microsite($_SESSION['microsite_db']);
  $result = $microsite->getPageInfoByName($page_name);	
	return $result;
}

function getMicrositeInfo($microsite_name,$microsite_db) {
	$microsite = new Microsite();
  $result = $microsite->getMicrositeInfoByNames($microsite_name,$microsite_db);	
	return $result;
}

function getPageInfoID($id) {
	$microsite = new Microsite($_SESSION['microsite_db']);
  $result = $microsite->getPageInfoByID($id);	
	return $result;
}

function getMicrositeInfoID($id) {
	$microsite = new Microsite();
  $result = $microsite->getMicrositeInfoByID($id);	
	return $result;
}

function getAllPagesWithStatus() {
	$microsite = new Microsite($_SESSION['microsite_db']);
	$results = $microsite->getAllPagesWithStatus();
	return $results;
}

function getAllPages() {
	$microsite = new Microsite($_SESSION['microsite_db']);
	$results = $microsite->getAllPagesByMicrosite();
	return $results;
}

function getPagesByRuleSetID($id) {
	$microsite = new Microsite($_SESSION['microsite_db']);
	$results = $microsite->getSelectedPagesByRuleSetID($id);
	return $results;
}

function getPageName($page_id) {
	$rule = new Rule($_SESSION['microsite_db']);
	$result = $rule->getPageNameByID($page_id);
	return $result;	
}

function getPagesByRule($rsid) {
	$rule = new Rule($_SESSION['microsite_db']);
  $result = $rule->getPagesByRuleByID($rsid);	
	return $result;
}

function getResponseLogs($start,$end,$status) {
	$response = new Response($_SESSION['microsite_db']);
	if(!empty($status)){
		$result = $response->getAllResponseLogsWithStatus($start,$end,$status);
	}
	else {
  	$result = $response->getAllResponseLogs($start,$end);
	}
  return $result;
}

function getRole($username) {
	$user = new User();
  $result = $user->getRoleIDbyUsername($username);
  return $result;
}

function getRoles($role_id) {
	$user = new User();
	$results = $user->getAllUserRoles();
	$options = '';
	
	foreach($results as $row) {	
		if($role_id==$row['id']){
			$options .= '<option value="'.$row['id'].'" selected>'.$row['role_name'].'</option>';	
		}
		else {
			$options .= '<option value="'.$row['id'].'">'.$row['role_name'].'</option>';	
		}
	}
	return $options;
}

function getUserRoles() {
	$user = new User();
	$results = $user->getAllUserRoles();
  $options = '';	
	foreach($results as $row) {	
		$options .= '<option value="'.$row['id'].'">'.$row['role_desc'].'</option>';
	}
	return $options;
}


function getRuleName($id) {
	$rule = new Rule($_SESSION['microsite_db']);
  $result = $rule->getRuleByID($id);
  return $result;	
}

function getImprintName($id) {
	$rule = new Microsite($_SESSION['microsite_db']);
  $result = $rule->getImprintByID($id);
  return $result;	
}

function getUserInfo($id) {
	$user = new User();
  $result = $user->getUserInfoByID($id);
  return $result;	
}

function hasDefaultRule($id) {
	$rule = new Rule($_SESSION['microsite_db']);
	$result = $rule->hasDefaultRuleAssignByID($id);
	return $result;
}

function insertFieldName($name,$fieldname,$microsite_fieldname) {
	$microsite = new Microsite($_SESSION['microsite_db']);
	$result = $microsite->addNewFieldName($name,$fieldname,$microsite_fieldname);
	return $result;
}

function insertFieldValue($fieldvalue,$salesforcevalue,$fieldname_id) {
	$microsite = new Microsite($_SESSION['microsite_db']);
	$result = $microsite->addNewFieldValue($fieldvalue,$salesforcevalue,$fieldname_id);
	return $result;
}

function insertImprintName($imprint_name,$imprint_desc,$salesforcevalue) {
	$microsite = new Microsite($_SESSION['microsite_db']);
	$result = $microsite->addNewImprintName($imprint_name,$imprint_desc,$salesforcevalue);
	return $result;
}

function insertPage($page_name) {
	$microsite = new Microsite($_SESSION['microsite_db']);
	$result = $microsite->addNewPageName($page_name);
	return $result;
}

function insertMicrosite($microsite_name,$microsite_db) {
	$microsite = new Microsite($_SESSION['microsite_db']);
	$result = $microsite->addNewMicrosite($microsite_name,$microsite_db);
	return $result;
}

function insertMicrositeToUser($user_id,$microsite_id) {
	$user = new User();
	$result = $user->addNewMicrositeToUser($user_id,$microsite_id);
	return $result;
}

function deleteMicrositeToUser($id) {
	$user = new User();
	$result = $user->deleteMicrositeToUserByID($id);
	return $result;
}

function updateAssignBrand($ratio,$status,$id) {
	$rule = new Rule($_SESSION['microsite_db']);
	$result = $rule->updateAssignBrandID($ratio,$status,$id);
	return $result;
}


function updateRule($rule_name,$id) {
	$rule = new Rule($_SESSION['microsite_db']);
	$result = $rule->updateRuleByID($rule_name,$id);
	return $result;
}

function updateUser($login,$crypted_password,$email,$role_id,$id) {
	$user = new User();
	$result = $user->updateUserByID($login,$crypted_password,$email,$role_id,$id);
	return $result;
}

function updateFieldName($name,$fieldname,$microsite_fieldname,$id) {
	$microsite = new Microsite($_SESSION['microsite_db']);
	$result = $microsite->updateFieldNameByID($name,$fieldname,$microsite_fieldname,$id);
	return $result;
}

function updateFieldValue($fieldvalue,$salesforcevalue,$fieldname_id,$id) {
	$microsite = new Microsite($_SESSION['microsite_db']);
	$result = $microsite->updateFieldValueByID($fieldvalue,$salesforcevalue,$fieldname_id,$id);
	return $result;
}

function updateImprintName($imprint_name,$imprint_desc,$salesforcevalue,$id) {
	$microsite = new Microsite($_SESSION['microsite_db']);
	$result = $microsite->updateImprintNameByID($imprint_name,$imprint_desc,$salesforcevalue,$id);
	return $result;
}

function updatePage($page_name,$id) {
	$microsite = new Microsite($_SESSION['microsite_db']);
	$result = $microsite->updatePageByID($page_name,$id);
	return $result;
}

function updateMicrosite($microsite_name,$microsite_db,$id) {
	$microsite = new Microsite();
	$result = $microsite->updateMicrositeByID($microsite_name,$microsite_db,$id);
	return $result;
}

function updateResponseStatus($status,$request,$response,$id) {	
	$response = new Response($_SESSION['microsite_db']);
	$result = $response->updateResponseStatusByID($status,$request,$response,$id);
	return $result;
}

function insertLog($event,$previous_value,$current_value,$page,$user) {
	$log = new ActivityLog($_SESSION['microsite_db']);
	$result = $log->addNewLog($event,$previous_value,$current_value,$page,$user);
	return $result;
}

function insertAssignBrand($rule_id,$imprint_id,$ratio) {
	$rule = new Rule($_SESSION['microsite_db']);
  $result_id = $rule->addBrandToRuleByIDs($rule_id,$imprint_id,$ratio);
  return $result_id;	
}

function insertRule($fid,$rsid) {
	$rule = new Rule($_SESSION['microsite_db']);
  $result_id = $rule->insertRuleByIDs($fid,$rsid);
  $result = $rule->updateRuleByNewID($result_id);  
  return $result_id;		
}

function insertDefaultRule($id) {
	$rule = new Rule($_SESSION['microsite_db']);
  $result_id = $rule->insertDefaultRuleByID($id);
  $result = $rule->updateRuleByNewID($result_id);  
  return $result_id;		
}

function sortRules($table,$old_id,$new_id) {
	$rule = new Rule($_SESSION['microsite_db']);
  $result = $rule->sortRulesIDs($table,$old_id,$new_id);
  return $result;	
}

function sortAssignBrand($table,$old_id,$new_id) {
	$rule = new Rule($_SESSION['microsite_db']);
  $result = $rule->sortAssignBrandIDs($table,$old_id,$new_id);
  return $result;	
}

function insertPageRuleSet($rule_set_id,$page_id) {
	$rule = new Rule($_SESSION['microsite_db']);
	$result = $rule->addNewPageToRuleSet($rule_set_id,$page_id);
	return $result;
}

function insertRuleName($rule_name) {
	$rule = new Rule($_SESSION['microsite_db']);
	$result = $rule->addNewRuleName($rule_name);
	return $result;
}

function insertUser($login,$crypted_password,$email,$role_id) {
	$user = new User($_SESSION['microsite_db']);
	$result = $user->addNewUser($login,$crypted_password,$email,$role_id);
	return $result;
}

function sendXmlOverPost($xml) {
	$keypass = array('AuthenticationKey: API_KEY'); // authentication key of WS provided by Author Solutions
	$URL = "SERVICE_LINK"; // this is the web service or 3rd party link to 
 
	$ch = curl_init($URL); // curl function to communicate with the service
	//curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_HTTPHEADER, $keypass);
	curl_setopt($ch, CURLOPT_POSTFIELDS, "$xml");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$response = curl_exec($ch);
	curl_close($ch);  

	$response =  htmlentities($response);	
	return $response;
}


?>