<?php 
namespace Routing\Router\Decorators;

use\Routing\Http\Requests\RequestInterface;
use Routing\Router\Factory\EntitySignatureFactory;

trait RouterActionHandler
{

    protected function handle($action, RequestInterface $request)
    {
        if (is_callable($action)) {
            $action($request);
            return;
        }

        $classInfo = $this->exctratClassMethod($action);
        $className = $classInfo[0];
        $method = $classInfo[1];

        if (empty($className) || empty($method)) {
            throw new \Exception('Please use the pattern "class@method"', 1);
        }

        $instance = $this->entityFactory->getSignature($classInfo[0]);

        if (!method_exists($className, $method)) {
            throw new \Exception("Class $class don't have method $method.", 1);
        }

        $this->execute($instance, $method, $request);
    }

    private function exctratClassMethod(string $actionString): array
    {
        $classInfo = explode('@', $actionString);
        if (!$classInfo[0] || !$classInfo[1]) {
            return [];
        }

        return $classInfo;
    }

    private function execute(object $class = null, $action, $req)
    {
        $class->$action($req);
    }
}