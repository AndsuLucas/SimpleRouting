<?php
namespace Routing\Router;

use Routing\Http\Request;

final class SimpleRouter implements RouterInterface
{   
    use Decorators\RouterActionHandler;

    private $paths = [];
    private $request;


    public function add(string $path, $action): void
    {
        $this->paths[$path] = $action;
        return; 
    }

    public function listen(Request $request)
    {
        $action = $this->paths[$request->getUri()] ?? null;
        if (!empty($action)) {
            $this->handle($action, $request);
        }
    }
    
}