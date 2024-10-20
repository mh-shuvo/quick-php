<?php
define("PROJECT_PATH",__DIR__);

if(file_exists(PROJECT_PATH."/storage/framework/maintainenance.php")){
    require PROJECT_PATH."/storage/framework/maintainenance.php";
    return;
}


require "./vendor/autoload.php";

require "./bootstrap/app.php";