<?php

function env($key,$default=NULL){
    return isset($_ENV[$key]) ? $_ENV[$key] : $default;
}

function config($key,$default=null): mixed{
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

function session(){
    $container = Atova\Eshoper\Abstract\Container::getInstance();
    return $container->get('session');
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
       return handleException(sprintf("Views %s not found.",base_path($absoluteFilePath)));
    }

    require_once base_path($absoluteFilePath);
}

function baseURL(){
    $protocol = env("APP_PROTOCOL","http");
    $port = env("APP_PORT",8000);
    $host = env("APP_HOST","localhost");
    $url_root = sprintf("%s://%s:%d",$protocol,$host,$port);
    return $url_root;
}

function url($path=null){
    $absoluteFilePath = baseURL()."/".$path;
    return $absoluteFilePath;
}


function asset($path=null){
    $absoluteFilePath = baseURL()."/public/".$path;
    return $absoluteFilePath;
}

function redirectTo($url=null){
    $absoluteFilePath = baseURL()."/".$url;
    header("Location:".$absoluteFilePath);
}