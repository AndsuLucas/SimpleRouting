<?php
namespace Routing\Router\Factory\Method;
use Routing\Router\Factory\Method\MethodSignatureFactoryInterface;

/**
 * 
 * refactor this
 * /
class MethodSignatureFactory implements MethodSignatureFactoryInterface
{
    private $object;

    public function createMethodSignature(string $method, object $object = null): 
    {
        $this->object = $object;
        $this->checkIfMethodExists($method);

        if (is_null($this->object)) {
            return new ReflectionFunction($method);
        }

        return new ReflectionMethod($this->object, $method)
    }


    private function checkIfMethodExists(string $method)
    {
        if (is_null($this->object)) {
            $this->checkMethod($method);
            return;
        }
    }

    private function checkMethod(string $method): void
    {
       if (!method_exists($this->object, $method)) {
            throw new \DomainException('Cannot resolve method', $method);
       }
    }

    private function checkFunction(string $method): void
    {
        if (!function_exists($method)) {
            throw new \DomainException('Cannot resolve function', $method);    
        }
    }
}