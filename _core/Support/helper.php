<?php

function env($key,$default){
    return isset($_ENV[$key]) ? $_ENV[$key] : $default;
}

function config($key,$default=null){
    $container = Atova\Eshoper\Abstract\Container::getInstance();
    $configValues = $container->get("config",[]);

    $keys = explode('.', $key);

    foreach ($keys as $part) {
        if (isset($configValues[$part])) {
            $configValues = $configValues[$part];
        } else {
            return $default;
        }
    }

    return $configValues;
}

function base_path($path=null){
    $container = Atova\Eshoper\Abstract\Container::getInstance();
    return $container->get("PROJECT_ROOT")."/".$path;
}


function handleException($msg,$statusCode=404,$data=[]){
    echo sprintf("<b>Error:  %d</b>. <br> %s",$statusCode,$msg);
    return;
}


function view($fileName,$data=[]){

    $absoluteFilePath = "views/".str_replace(".","/",$fileName).".php";

    if(!file_exists(base_path($absoluteFilePath))){
       return displayException(sprintf("Views %s not found.",base_path($absoluteFilePath)));
    }

    require_once base_path($absoluteFilePath);
}