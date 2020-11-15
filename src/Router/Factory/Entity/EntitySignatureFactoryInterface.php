<?php
namespace Routing\Router\Factory\Entity;

interface EntitySignatureFactoryInterface
{
    public function getSignature(string $class): object;
}