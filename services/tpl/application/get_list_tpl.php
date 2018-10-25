<?php 

define ("TO_ROOT", '../../..');
require_once TO_ROOT . "/subcore/includes/main.inc.php";

$return_data = array(
    "success"=>0,
    "today"=>mktime(date("H"), date("i"), date("s"), date("m"), date("d"), date("Y")),
    "time"=>array("start"=>microtime(true),"end"=>0,"seconds"=>0),
);

$required_fields = array("print_test","page","limit","recursive");
$filter_fields = array("active","deleted","locked");
$fields = array_merge($required_fields, $filter_fields);

foreach($fields AS $field){
    $return_data[$field] = (isset($_POST[$field])) ? $_POST[$field] : false;
    ( ($return_data[$field] === false) && (isset($_GET[$field])) ) ? $return_data[$field] = $_GET[$field] : false;
}

if($return_data["token"] != false){
        ($return_data["limit"])? Tpl::$limit_paginate = $return_data["limit"] : false;
        
        $summary = Tpl::getTotal($return_data);
        
        $return_data["summary"]["total"]   = (int)$summary["total"];
        $return_data["summary"]["active"]  = (isset($summary["active"]))? $summary["active"] : 0;
        $return_data["summary"]["inactive"]= (isset($summary["inactive"]))? $summary["inactive"] : 0;
        $return_data["summary"]["deleted"] = (isset($summary["deleted"]))? $summary["deleted"] : 0;
        $return_data["summary"]["locked"]  = (isset($summary["locked"]))? $summary["locked"] : 0;
        $return_data["summary"]["unlocked"]= (isset($summary["unlocked"]))? $summary["unlocked"] : 0;
        
        $return_data["pages"]["total"]   = $summary["pages"];
        $return_data["pages"]["current"]  = ($return_data["page"] <= 1 ) ? 1 : $return_data["page"];  
        
        $return_data["pages"]["previous"]        = ($return_data["page"] <= 1 ) ? $summary["pages"] : $return_data["page"] -1;
        $return_data["pages"]["previous_first"]  = ($return_data["page"] -1 >= 1)? $return_data["page"] - 1 : 0;
        $return_data["pages"]["previous_second"] = ($return_data["page"] -2 >= 1)? $return_data["page"] - 2 : 0;
        $return_data["pages"]["previous_three"]  = ($return_data["page"] -3 >= 1)? $return_data["page"] - 3 : 0;
        
        $return_data["pages"]["next"]        = ($return_data["page"] >= $return_data["pages"]["total"] ) ? 1 : $return_data["page"] + 1;
        $return_data["pages"]["next_first"]  = ($return_data["pages"]["total"] >= $return_data["pages"]["current"] + 1)? $return_data["pages"]["current"] + 1 : 0;
        $return_data["pages"]["next_second"] = ($return_data["pages"]["total"] >= $return_data["pages"]["current"] + 2)? $return_data["pages"]["current"] + 2 : 0;
        $return_data["pages"]["next_three"]  = ($return_data["pages"]["total"] >= $return_data["pages"]["current"] + 3)? $return_data["pages"]["current"] + 3 : 0;
        
        ($return_data["recursive"] === false || $return_data["recursive"] == "false")? $summary["pages"] = $return_data["page"] : $return_data["page"] = 1;
        
        if($summary["pages"] >=1 ){   
            for($i = $return_data["page"]; $i <= $summary["pages"]; $i++){ 
                $return_data["page"] = $i;
                $return_data["pages"]["current"] = $i;
                $data_list = Tpl::getList($return_data);
                
                if(!empty($data_list)){
                    foreach ($data_list AS $key => $value){
                        $return_data["data"][] = $value;
                    }
                } else {
                    $return_data["error"] = "EMPTY_LIST";
                } 
            }

            $return_data["success"] = "1";
            $return_data["sql"] = Tpl::$sql;
        } else {
            $return_data["success"] = "0";
            $return_data["error"] = "EMPTY_LIST";
        } 

} else {
    $return_data["error"] = "NOT_FOUND_TOKEN";
}

echo ( !empty($return_data["print_test"]) ) ? Functions::__displayVariable( $return_data ) : json_encode($return_data) ;