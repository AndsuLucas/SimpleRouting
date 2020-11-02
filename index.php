<?php declare(strict_types=1);
require_once __DIR__ . "/vendor/autoload.php";

use Routing\Router\SimpleRouter;
use Routing\Http\Request;

$request = new Request();
$router = new SimpleRouter($request);

$router->add('/', function($request) {
    echo json_encode($request);
});

$router->add('/sum', 'Routing\Controller\SumController@getSum');

$router->listen($request);