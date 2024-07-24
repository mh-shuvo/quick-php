<?php

namespace MhShuvo\QuickPhp\Core\Foundation;

use MhShuvo\QuickPhp\Core\Contracts\Application as AppContract;
use MhShuvo\QuickPhp\Core\Container\Container;

class Application extends Container implements AppContract
{
    const VERSION = "";


    public function __construct($basePath = null)
    {
        if($basePath){
            $this->setBasePath($basePath);
        }
        $this->registerBaseBindings();
    }

    public function version()
    {
        return static::VERSION;
    }

    public function basePath($path = '')
    {
        return $this->basePath.($path != '' ? DIRECTORY_SEPARATOR.$path : '');
    }

    /**
     * Set the base path for the application.
     *
     * @param  string  $basePath
     * @return $this
     */
    public function setBasePath($basePath)
    {
        $this->basePath = rtrim($basePath, '\/');

        $this->bindPathsInContainer();

        return $this;
    }

    private function bindPathsInContainer()
    {
        $this->is_instance('path.base',$this->basePath());
    }

    /**
     * Register the basic bindings into the container.
     *
     * @return void
     */
    protected function registerBaseBindings()
    {
        $this->instance('app', $this);

        static::setInstance($this);

    }
}