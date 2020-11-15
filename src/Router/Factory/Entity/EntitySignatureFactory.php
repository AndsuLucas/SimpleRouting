<?php 
namespace Routing\Router\Factory\Entity;

use ReflectionClass;
use ReflectionParameter;
use Routing\Router\Factory\Entity\EntitySignatureFactoryInterface;

final class EntitySignatureFactory implements EntitySignatureFactoryInterface
{
    public function getSignature(string $class): object
    {
        if (!class_exists($class)) {
            throw new \Exception("Class $class don't exists.", 1);
        }

        $refClass = new ReflectionClass($class);

        if (!$refClass->hasMethod('__construct')) {
            return $refClass->newInstance();
        }

        return $this->constructClass($refClass);
    }

    private function constructClass(ReflectionClass $ref): object
    {
        $constructor = $ref->getConstructor();
        $parameters = array_map(function($parameter) use($ref) {

            $dependence = $parameter->getType()->getName();
            return (new ReflectionClass($dependence))->newInstance();

        }, $constructor->getParameters());

        $instance = $ref->newInstance(...$parameters);
        return $instance;
    }
}
