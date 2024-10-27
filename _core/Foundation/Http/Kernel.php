<?php
namespace Atova\Eshoper\Foundation\Http;
use Atova\Eshoper\Contract\Http\KernelContract;
use Atova\Eshoper\Foundation\Application;
use Atova\Eshoper\Foundation\Bootstrap\LoadConfiguration;
use Atova\Eshoper\Foundation\Bootstrap\LoadEnvironment;
use Atova\Eshoper\Foundation\Providers\RouteServiceProvider;
use Atova\Eshoper\Contract\ServiceProviderContract;
use Atova\Eshoper\Foundation\Bootstrap\LoadSession;

class Kernel implements KernelContract{

    protected $app;

    protected $environmentClasses = [
        LoadEnvironment::class,
    ];

    protected $providerClasses = [
        RouteServiceProvider::class,
    ];
    
    protected $bootstrapClasses = [
        LoadSession::class,
        LoadConfiguration::class,
    ];

    public function __construct(Application $app){
        $this->app = $app;
    }


    protected function loadEnvironment(){

        foreach($this->environmentClasses as $classPath){
            $class = new $classPath();
            $class->bootstrap($this->app);
        }
    }

    protected function loadBootstrapFiles(){

        foreach($this->bootstrapClasses as $classPath){
            $class = new $classPath();
            $class->bootstrap($this->app);
        }
    }

    protected function loadProviders(){
        foreach($this->providerClasses as $classPath){
            $class = new $classPath();

            try{
                $this->loadSingleProvider($class);
            }catch(\Exception $exc){
                echo sprintf("Unsupported provider %s",$classPath);
            }
            
        }
    }

    private function loadSingleProvider(ServiceProviderContract $provider){
        $provider->boot();
    }

    public function handle(){
        $this->loadEnvironment();
        $this->loadBootstrapFiles();
        $this->loadProviders();

    }

}
