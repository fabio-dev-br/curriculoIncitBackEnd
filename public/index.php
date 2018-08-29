<?php

//Everything is relative to the application root now.
chdir(dirname(__DIR__));

$settings = require 'app/config/settings.php';

if(file_exists('app/config/settings.local.php')) {
    $settings = array_replace_recursive($settings, require 'app/config/settings.local.php');
}

if($settings['display_errors']) {
    error_reporting(E_ALL);
    ini_set("display_errors", 1);
};

if (!file_exists('./vendor/autoload.php')) {
    echo 'Please run `composer install` first!';
}

include './vendor/autoload.php';

use Intec\Router\SimpleRouter;
use IntecPhp\Middleware\HttpMiddleware;
use IntecPhp\Middleware\AllowOriginMiddleware;
use Pimple\Psr11\Container;
use Pimple\Container as PimpleContainer;

SimpleRouter::setRoutes(require 'app/config/routes.php');


SimpleRouter::setDefaultMiddlewares([
    AllowOriginMiddleware::class . ':process'
]);
SimpleRouter::setNotFoundFallback(HttpMiddleware::class . ':pageNotFound');
SimpleRouter::setErrorFallback(HttpMiddleware::class . ':fatalError');

$dependencies = new PimpleContainer();
$dependencies['settings'] = $settings;

require 'app/config/dependencies.php';

SimpleRouter::match($_SERVER['REQUEST_URI'], new Container($dependencies));
