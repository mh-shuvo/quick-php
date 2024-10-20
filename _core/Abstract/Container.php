<?php

namespace Atova\Eshoper\Abstract;

/**
 * This is a Singleton class. So that there is only one instance.
 */

class Container{

    protected static $instance;

    protected $bindings = [];


    public static function getInstance(){

        if(is_null(self::$instance)){
            self::$instance = new static;
        }

        return self::$instance;
    }

    public function bind($key, $value)
    {
        $this->bindings[$key] = $value;
    }


    public function get($key, $default = null)
    {
        return $this->bindings[$key] ?? $default;
    }

    public static function setInstance($container = null)
    {
        return static::$instance = $container;
    }

}