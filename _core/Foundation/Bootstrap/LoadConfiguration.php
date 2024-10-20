<?php

namespace Atova\Eshoper\Foundation\Bootstrap;

use Atova\Eshoper\Contract\BootstrapContract;
use Atova\Eshoper\Foundation\Application;

class LoadConfiguration implements BootstrapContract{


    public function bootstrap(Application $app){
        $data = [];
        foreach ($this->getConfigurationFiles($app->getConfigurationPath()) as $key => $file) {
            $config = require $file;
            $data[$key] = $config;
        }
        
        $app->bind("config",$data);

    }

    private function getConfigurationFiles($path){
        $files = [];
        foreach (glob($path."/*.php") as $file) {
            $files[basename($file,".php")] = $file;
        }
        return $files;
    }

    public function getConfigData(){
        return $this->config;
    }

}