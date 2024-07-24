<?php

namespace MhShuvo\QuickPhp\Core\Foundation\Http;

use MhShuvo\QuickPhp\Core\Contracts\HttpKernel as HttpKernelContract;

class Kernel implements HttpKernelContract
{
    /**
     * The application implementation.
     *
     * @var Application
     */
    public $app;
    public function __construct()
    {
//        $this->app = new Application();
    }

    public function handle()
    {
        echo "Your system is booting...";
    }
}