<?php
namespace Atova\Eshoper\Contract;
use Atova\Eshoper\Foundation\Application;
interface BootstrapContract{
    public function bootstrap(Application $app);
}