<?php

namespace Atova\Eshoper\Foundation\Bootstrap;

use Atova\Eshoper\Contract\BootstrapContract;
use Atova\Eshoper\Foundation\Application;
use Dotenv\Dotenv;


class LoadEnvironment implements BootstrapContract{

    public function bootstrap(Application $app){
        
        $this->loadEnv();
        $this->handleErrorConfiguration();
    }

    private function loadEnv(){
        $dotenv = Dotenv::createImmutable(PROJECT_PATH);
        $dotenv->load();
    }

    private function handleErrorConfiguration(){
        $appDebug = filter_var(env("APP_DEBUG",false),FILTER_VALIDATE_BOOLEAN);
        $logErrors = filter_var(env('LOG_ERRORS',false), FILTER_VALIDATE_BOOLEAN);
        $errorLogPath = env('ERROR_LOG_PATH',base_path("error.log"));


        if($appDebug){
            error_reporting(E_ALL);
            ini_set('display_errors',1);
        }else{
            error_reporting(0);
            ini_set('display_errors',0);
        }
        
        // Configure error logging
        if ($logErrors) {
            ini_set('log_errors', 1); // Enable error logging
            ini_set('error_log', $errorLogPath); // Set the log file path
        } else {
            ini_set('log_errors', 0); // Disable error logging
        }
    }

}