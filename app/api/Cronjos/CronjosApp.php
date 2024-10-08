<?php
namespace App\Cronjos;

use App\Cronjos\Http\Routes\CronjosRoutes;

class CronjosApp
{
    public static function Create($app)
    {
        CronjosRoutes::Routes($app);
    }
}
