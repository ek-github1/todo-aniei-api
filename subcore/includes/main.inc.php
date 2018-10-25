<?php header("Content-Type: charset=UTF-8");

////////------ Auto loader, Core Libraries the most important ----------//////////
if( file_exists(TO_ROOT . "/spiderframe/includes/Autoloader.php") )
{
    define("SPIDERFRAME", TO_ROOT . "/spiderframe");
} else if( file_exists(TO_ROOT . "/../spiderframe/includes/Autoloader.php") ){
    define("SPIDERFRAME", TO_ROOT . "/../spiderframe");
}

require_once SPIDERFRAME . "/includes/Autoloader.php";

session_start();
Autoloader::registerAutoload();

$ConfigSystem = Config::getInstance();
$ConfigSystem->load();

date_default_timezone_set("America/Mexico_City");
//date_default_timezone_set("UTC");

////////------ Instance Connection application ----------//////////

// LOCAL
// $host_root  ="localhost";

// $user_root	="root";

// $pass_root	="";

// $name_root 	="ek_cucei_news";

// WEB
$host_root  ="localhost";

$user_root	="ekcucei2_admin";

$pass_root	="Ekcuceinews";

$name_root 	="ekcucei2_app";

$DbConnection_root = DbConnection::getInstance("_root", $host_root, $user_root, $pass_root, $name_root);

////////------ Instance Connection world ----------//////////
//
$host_world	="localhost";

//
$user_world	="user_world";

//
$pass_world	="pass_world";

//
$name_world ="app_world";

$DbConnection_world = DbConnection::getInstance("_world", $host_world, $user_world, $pass_world, $name_world);

////////------ Main Global Variables ----------//////////
define("COMPANY",$ConfigSystem->__system["COMPANY"]);
define("RFC",$ConfigSystem->__system["RFC"]);
define("ENTERPRISE",$ConfigSystem->__system["ENTERPRISE"]);
define("PROJECT",$ConfigSystem->__system["PROJECT"]);
define("DESCRIPTION",$ConfigSystem->__application["DESCRIPTION"]);
define("PROJECT_VERSION", $ConfigSystem->__system["PROJECT_VERSION"]);
define("WEB_SITE",$ConfigSystem->__system["WEB_SITE"]);
define("TELEPHONE",$ConfigSystem->__system["TELEPHONE"]);
define("COMPANY_PHONE",$ConfigSystem->__system["COMPANY_PHONE"]);
define("LANGUAGE", ( isset($_SESSION["language"]) ) ? $_SESSION["language"] : $ConfigSystem->__system["LANGUAGE"]);
define("PRODUCTION", $ConfigSystem->__framework["FRAMEWORK_PRODUCTION"]);
define("STRING_TOKEN", $ConfigSystem->__system["STRING_TOKEN"]);
define("TOKEN_KEY", Functions::__spiderCryption($ConfigSystem->__system["STRING_TOKEN"]));
define("TOKEN_ID", $ConfigSystem->__application["TOKEN_ID"]);

Autoloader::registerApp();

// Application on production ?
if(PRODUCTION) 
{
	ini_set("error_reporting", E_ALL | E_NOTICE | E_STRICT);
	ini_set("display_errors", "1");
} else {
	ini_set("display_errors", "0");
}


