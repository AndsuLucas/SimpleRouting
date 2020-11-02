<?php 
namespace Routing\Router\Decorators;

use Routing\Http\Request;

trait RouterActionHandler
{
    protected function handle($action, Request $request)
    {
        /**
        * TODO: CREATE A FACTORY
        */
        if (is_callable($action)) {
            $action($request);
            return;
        }

        $actionInfo = explode('@', $action);
        $class = $actionInfo[0];
        $method = $actionInfo[1];
        
        if (empty($class) || empty($method)) {
            return;
        }

        if (!class_exists($class)) {
            return;
        }

        $reflectionClass = new \ReflectionClass($class);
        if (!$reflectionClass->hasMethod('__construct')) {
            return;
        }

        if (!$reflectionClass->hasMethod($method)) {
            return;
        }

        $constructor = $reflectionClass->getConstructor();
        $parameters = array_map(function($parameter) use($reflectionClass) {
            // ignore for a while
            if (!class_exists($parameter->getType())) {
                return;
            }

            // for a while whitout recursive construct      
            return (
                new \ReflectionClass((string) $parameter->getType())
            )->newInstance();
        }, 
            $constructor->getParameters($constructor)
        );
        
        $instance = $reflectionClass->newInstanceArgs($parameters);
        $instance->$method($request);   
    }   
}