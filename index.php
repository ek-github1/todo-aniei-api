<?php define("TO_ROOT", ".");

require_once TO_ROOT . "/subcore/includes/main.inc.php";

//$Page = Page::getInstance();

//
//    if( !file_exists("spiderframe") && file_exists("core") )
//    {
//          rename ("core", "spiderframe");
//    }
//
//    if( !file_exists("apps") || !file_exists("subcore") )
//    {
//          header('Location: spiderframe/spiderframe/index.php');
//    }
//
//    require_once TO_ROOT . "/subcore/includes/main.inc.php";
//    
//    $Page = new Page("Home", "index");
//
//    if(file_exists(TO_ROOT . "/apps/home/index.php"))
//    {
//    	 $Page->goToPage(TO_ROOT . "/apps/home/index.php");
//    } 
//
//    if(file_exists(TO_ROOT . "/apps/login/login.php")) 
//    {
//    	 $Page->goToPage(TO_ROOT . "/apps/login/login.php");
//    } 
//    
  //  $Page->display();