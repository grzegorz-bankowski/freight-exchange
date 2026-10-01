<?php

const PATH = __DIR__.'/../';

require PATH . 'app/Helpers/functions.php';

spl_autoload_register(function ($class) {
    require base_path($class . '.php');
});

use App\Classes\Database;
use App\Classes\Router;

$db = new Database();
$router = new Router();

$routes = require base_path('routes.php');
$uri = parse_url($_SERVER['REQUEST_URI'])['path'];

$method = $_POST['_method'] ?? $_SERVER['REQUEST_METHOD'];

$router->route($uri, $method, $db);