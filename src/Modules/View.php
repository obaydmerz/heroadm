<?php
namespace OMerz\HeroADM\Modules;

use App\Http\Controllers\Controller;

class View extends Controller {
    public static function Self($view)
    {
        return static::$response->view($view);
    }
    public static function View($view)
    {
        return view($view);
    }
}
