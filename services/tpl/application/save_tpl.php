<?php 

define("TO_ROOT", "../../..");
require_once TO_ROOT . "/subcore/includes/main.inc.php";

$return_data = array(
    "success"=>0,
    "today"=>mktime(date("H"), date("i"), date("s"), date("m"), date("d"), date("Y")),
    "time"=>array("start"=>microtime(true),"end"=>0,"seconds"=>0),
);

$fields = array("print_test", "tpl_id");

foreach($fields AS $field){
    $return_data[$field] = (isset($_POST[$field])) ? $_POST[$field] : false;
    ( ($return_data[$field] === false) && (isset($_GET[$field])) ) ? $return_data[$field] = $_GET[$field] : false;
}
		
		$Row_tpl = Tpl::getInstance($return_data["tpl_id"]);
		$Row_response = Row::getNewInstance("0", "response");
		if(!empty($data_tpl = $Row_tpl->DbConnection->getFieldStructure("tpl"))){
			unset($data_tpl["tpl_id"]);
			foreach($data_tpl AS $key => $value) {
				$return_data[$key] = (isset($_POST[$key])) ? $_POST[$key] : false;
				( ($return_data[$key] === false) && (isset($_GET[$key])) ) ? $return_data[$key] = $_GET[$key] : false;
				$Row_tpl->data[$key] = $return_data[$key];
				($key == "active" && empty($return_data["active"]))? $Row_tpl->data[$key] = 1 : false; 
				($key == "locked" && empty($return_data["locked"]))? $Row_tpl->data[$key] = 0 : false; 
				($key == "deleted" && empty($return_data["deleted"]))? $Row_tpl->data[$key] = 0 : false; 
			}

			if($Row_tpl->save()) {	
				$Row_tpl->load();
				$return_data["success"] = "1";
				$return_data["data"]["keyword"] = $Row_tpl->data;
				if($return_data["success"] == "1"){
					if(!empty($data_response = $Row_tpl->DbConnection->getFieldStructure("response"))){
						foreach($data_response AS $key => $value) {
							$return_data[$key] = (isset($_POST[$key])) ? $_POST[$key] : false;
							( ($return_data[$key] === false) && (isset($_GET[$key])) ) ? $return_data[$key] = $_GET[$key] : false;
							$Row_response->data[$key] = $return_data[$key];
							($key == "active" && empty($return_data["active"]))? $Row_response->data[$key] = 1 : false; 
							($key == "locked" && empty($return_data["locked"]))? $Row_response->data[$key] = 0 : false; 
							($key == "deleted" && empty($return_data["deleted"]))? $Row_response->data[$key] = 0 : false;
							($key == "tpl_id")? $Row_response->data[$key] = $Row_tpl->getId() : false;
						}
						unset($Row_response->data["response_id"]);
						if($Row_response->save()) {
							$Row_response->load();
							$return_data["success"] = "1";
							$return_data["data"]["response"] = $Row_response->data;
						}else{
							$return_data["success"] = "0";
							$return_data["error"] = "NOT_SAVE";
							$return_data["reason"] = $Row_response->getErrorString();
						}
					}
			} else {
				$return_data["success"] = "0";
				$return_data["error"] = "NOT_SAVE";
				$return_data["reason"] = $Row_tpl->getErrorString();
			} 
		} else {
			$return_data["success"] = "0";
			$return_data["error"] = "EMPTY_DATA_ROW";
		}  

    }
echo ( !empty($return_data["print_test"]) ) ? Functions::__displayVariable( $return_data ) : json_encode($return_data) ;