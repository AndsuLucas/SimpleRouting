<?php 
namespace Routing\Http\Requests;

abstract class RequestInterface
{   
    public abstract function getParam(string $name);
    public abstract function getAttribute(string $name);
    public abstract function getMethod(): string;
    public abstract function getUri(): string;
}