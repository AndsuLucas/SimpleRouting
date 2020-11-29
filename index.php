<?php declare(strict_types=0);

require_once __DIR__ . "/vendor/autoload.php";

use Routing\Router\SimpleRouter;
use Routing\Http\Requests\Request;
use Routing\Router\Factory\Entity\EntitySignatureFactory;
use Routing\Router\Factory\Method\MethodSignatureFactory;

$request = new Request();
$router = new SimpleRouter(
    (new EntitySignatureFactory()),
    (new MethodSignatureFactory())
);

$router->add('/', function($request) {
    echo $request->json();
});


$router->add('/sum', 'Routing\Examples\Controller\SumController@getSum');

$router->listen($request);

