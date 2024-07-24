<?php

namespace MhShuvo\QuickPhp\Core\Container;

use MhShuvo\QuickPhp\Core\Contracts\Container as ContainerContract;

class Container implements ContainerContract
{


    /**
     * The current globally available container (if any).
     *
     * @var static
     */
    protected static $instance;

    /**
     * The container's bindings.
     *
     * @var array[]
     */
    protected $bindings = [];


    /**
     * An array of the types that have been resolved.
     *
     * @var bool[]
     */
    protected $resolved = [];

    /**
     * The container's shared instances.
     *
     * @var object[]
     */
    protected $instances = [];

    /**
     * The container's scoped instances.
     *
     * @var array
     */
    protected $scopedInstances = [];

    /**
     * The registered type aliases.
     *
     * @var string[]
     */
    protected $aliases = [];

    /**
     * The parameter override stack.
     *
     * @var array[]
     */
    protected $with = [];

    public function is_instance($abstract,$instance){

    }

    public function singleton($abstract, $concrete=null)
    {
        $this->bind($abstract, $concrete, true);
    }

    public function bind($abstract, $concrete = null, $shared = false)
    {
        $this->bindings[$abstract] = compact("concrete","shared");
    }

    public function make($abstract, array $parameters = [])
    {
        return $this->resolve($abstract, $parameters);
    }

    /**
    * Resolve the given type from the container.
    *
    * @param  string|callable  $abstract
    * @param  array  $parameters
    * @param  bool  $raiseEvents
    * @return mixed
    *
    */
    protected function resolve($abstract, $parameters = [], $raiseEvents = true)
    {
        $needToResolve = isset($this->resolved[$abstract]) ?? false;
        $needsContextualBuild = ! empty($parameters);

        // If an instance of the type is currently being managed as a singleton we'll
        // just return an existing instance instead of instantiating new instances
        // so the developer can keep using the same objects instance every time.
        if (isset($this->instances[$abstract]) && $this->isShared($abstract)) {
            return $this->instances[$abstract];
        }

        $concrete = $this->getConcrete($abstract);

        $this->with[] = $parameters;
        // We're ready to instantiate an instance of the concrete type registered for
        // the binding. This will instantiate the types, as well as resolve any of
        // its "nested" dependencies recursively until all have gotten resolved.
        if ($this->isBuildable($concrete, $abstract)) {
            $object = $this->build($concrete);
        } else {
            $object = $this->make($concrete);
        }

        if ($this->isShared($abstract) && ! $needsContextualBuild) {
            $this->instances[$abstract] = $object;
        }

        // Before returning, we will also set the resolved flag to "true" and pop off
        $this->resolved[$abstract] = true;

        return $object;
    }

    /**
     * Get the concrete type for a given abstract.
     *
     * @param  string|callable  $abstract
     * @return mixed
     */
    protected function getConcrete($abstract)
    {
        // If we don't have a registered resolver or concrete for the type, we'll just
        // assume each type is a concrete name and will attempt to resolve it as is
        // since the container should be able to resolve concretes automatically.
        if (isset($this->bindings[$abstract])) {
            return $this->bindings[$abstract]['concrete'];
        }

        return $abstract;
    }

    /**
     * Determine if the given concrete is buildable.
     *
     * @param  mixed  $concrete
     * @param  string  $abstract
     * @return bool
     */
    protected function isBuildable($concrete, $abstract)
    {
        return $concrete === $abstract || $concrete instanceof \Closure;
    }

    public function build($concrete){

        if ($concrete instanceof \Closure) {
            return $concrete(...$this->getLastParameterOverride());
        }

        try {
            $reflector = new \ReflectionClass($concrete);
        } catch (\ReflectionException $e) {
            throw new \Exception("Target class [$concrete] does not exist.", 0, $e);
        }

        return new $concrete;
    }

    /**
     * Get the last parameter override.
     *
     * @return array
     */
    protected function getLastParameterOverride()
    {
        return count($this->with) ? end($this->with) : [];
    }



    protected function isShared($abstract){
        return isset($this->instances[$abstract]) ||
            (isset($this->bindings[$abstract]['shared']) &&
                $this->bindings[$abstract]['shared'] === true);
    }

    /**
     * Get the globally available instance of the container.
     *
     * @return static
     */
    public static function getInstance()
    {
        if (is_null(static::$instance)) {
            static::$instance = new static;
        }

        return static::$instance;
    }

    /**
     * Set the shared instance of the container.
     *
     * @param  ContainerContract|null  $container
     */
    public static function setInstance(ContainerContract $container = null)
    {
        return static::$instance = $container;
    }
    /**
     * Register an existing instance as shared in the container.
     *
     * @param  string  $abstract
     * @param  mixed  $instance
     * @return mixed
     */
    public function instance($abstract, $instance){
        $this->instances[$abstract] = $instance;

        return $instance;
    }

}