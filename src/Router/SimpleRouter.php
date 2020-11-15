<?php
namespace Routing\Router;

use Routing\Http\Requests\RequestInterface;
use Routing\Router\Factory\Entity\EntitySignatureFactoryInterface;

final class SimpleRouter extends RouterInterface
{   
    use Decorators\RouterActionHandler;

    private $paths = [];
    private $request;

    public function __construct(EntitySignatureFactoryInterface $entityFactory) {
        $this->entityFactory = $entityFactory;
    }

    public function add(string $path, $action)
    {
        $this->paths[$path] = $action;
        return; 
    }

    public function listen(RequestInterface $request)
    {
        $action = $this->paths[$request->getUri()] ?? null;
        if (!empty($action)) {
            $this->handle($action, $request);
        }
    }
    
}