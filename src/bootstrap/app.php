<?php
$app = new \MhShuvo\QuickPhp\Core\Foundation\Application(
    $_ENV['APP_BASE_PATH'] ?? dirname(__DIR__)
);

$app->singleton(
    \MhShuvo\QuickPhp\Core\Contracts\HttpKernel::class,
    \MhShuvo\QuickPhp\App\Http\Kernel::class
);

$kernel = $app->make(\MhShuvo\QuickPhp\Core\Contracts\HttpKernel::class);
$kernel->app = "Testing is Okay";

// $app->singleton('random',function (){
//     return mt_rand(1,20);
// });

return $app;