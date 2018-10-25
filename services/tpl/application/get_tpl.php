<?php define ("TO_ROOT", '../../..');

// header("Content-Type: application/json");
// header("Access-Control-Allow-Origin: *");

require_once TO_ROOT . "/subcore/includes/main.inc.php";

$return_data["token"] = (isset($_POST["token"])) ? $_POST["token"] : false;
$return_data["token"] = ( ($return_data["token"] === false) && (isset($_GET["token"])) ) ? $_GET["token"] : $return_data["token"];

$return_data["message"] = (isset($_POST["message"])) ? $_POST["message"] : false;
$return_data["message"] = ( ($return_data["message"] === false) && (isset($_GET["message"])) ) ? $_GET["message"] : $return_data["message"];

$return_data["print_test"] = (isset($_POST["print_test"])) ? $_POST["print_test"] : false;
$return_data["print_test"] = ( ($return_data["print_test"] === false) && (isset($_GET["print_test"])) ) ? $_GET["print_test"] : $return_data["print_test"];

    	$Row = Tpl::getResponse($return_data["message"]);

		if(!empty($Row))
		{
			$return_data["success"] = "1";
			foreach ($Row AS $key => $value){
                        $return_data["data"][] = $value;
                    }
			$return_data["success"] = "1";

		} else {
			$return_data["success"] = "0";
			$return_data["error"] = "EMPTY_DATA";

		}
echo ( !empty($return_data["print_test"]) ) ? Functions::__displayVariable( $return_data ) : json_encode($return_data) ;