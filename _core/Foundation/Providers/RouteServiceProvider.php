<?php

namespace Atova\Eshoper\Foundation\Providers;

use Atova\Eshoper\Contract\ServiceProviderContract;
use Atova\Eshoper\Foundation\Http\Route;

class RouteServiceProvider implements ServiceProviderContract
{

    public function boot(): void
    {
        require base_path('routes/api.php');
        require base_path('routes/web.php');
        Route::notFound();
    }
}