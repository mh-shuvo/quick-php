<?php
use \MhShuvo\QuickPhp\Core\Contracts\HttpKernel as Kernel;
define('QUICK_PHP_START', microtime(true));

require_once __DIR__ . '/../vendor/autoload.php';


// Determine if the application is in maintenance mode...
if (file_exists($maintenance = __DIR__.'/storage/framework/maintenance.php')) {
    require $maintenance;
    exit;
}

// Bootstrap PHP Skeleton Project
$app = require_once __DIR__.'/bootstrap/app.php';

$container = MhShuvo\QuickPhp\Core\Container\Container::getInstance();
$kernel = $app->make(Kernel::class);
$kernel->handle();