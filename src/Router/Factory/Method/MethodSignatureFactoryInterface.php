<?php
namespace Routing\Router\Factory\Method;
use ReflectionFunction;

interface MethodSignatureFactoryInterface
{
    public function getSignature(string $method, object $object = null): ReflectionFunction;

}