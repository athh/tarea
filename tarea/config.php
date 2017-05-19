<?php
 
/*
    Configuration file 
    
    Contains database credentials and paths to specific resources.
*/
 
$config = array(
    "db" => array(
        "db1" => array(
            "dbname" => "trippotravel",
            "username" => "root",
            "password" => "123456",
            "host" => "localhost"
        )
    )
);
  
/*
    Constants for easily access to some paths
*/     

//path to layout    
defined("LAYOUT_PATH")
    or define("LAYOUT_PATH", realpath(dirname(__FILE__) . '/public/views/layout'));

//public path
defined("PUBLIC_PATH")
    or define("PUBLIC_PATH", realpath(dirname(__FILE__) . '/public'));
 
?>