<?php
namespace Atova\Eshoper\Foundation;
use Atova\Eshoper\Abstract\Container;

class Application extends Container{

    protected $basePath;

    public function __construct($basePath=null){

        if(isset($basePath)){
            $this->setBasePath($basePath);
        }

        $this->registerBindings();

    }

    private function setBasePath($path){
        $this->basePath = $path;
        $this->bind("PROJECT_ROOT",$path);
    }

    protected function registerBindings(){
        static::setInstance($this);
    }

    public function getConfigurationPath($path = ''): string
    {
        // Return the path to the config directory
        return $this->basePath.DIRECTORY_SEPARATOR.'config'.($path ? DIRECTORY_SEPARATOR.$path : $path);
    }


}