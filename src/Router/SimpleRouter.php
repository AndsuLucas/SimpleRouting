<?php
namespace Routing\Router;

use Routing\Http\Requests\RequestInterface;
use Routing\Router\Factory\Entity\EntitySignatureFactoryInterface;
use Routing\Router\Factory\Method\MethodSignatureFactoryInterface;

final class SimpleRouter extends RouterInterface
{   
    use Decorators\RouterActionHandler;

    private $paths = [];
    private $request;

    protected $entityFactory;
    protected $methodFactory;

    public function __construct(
        EntitySignatureFactoryInterface $entityFactory,
        MethodSignatureFactoryInterface $methodFactory
    ) {
        $this->entityFactory = $entityFactory;
        $this->methodFactory = $methodFactory;
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