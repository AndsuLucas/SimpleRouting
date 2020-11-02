<?php 
namespace Routing\Http;

final class Request implements \JsonSerializable
{   
    private $rawUrl;
    private $path;
    private $method;
    private $params;
    private $attributes;

    public function __construct()
    {   
        $this->rawUrl = $_SERVER['REQUEST_URI'];
        $this->path = explode('?', $this->rawUrl)[0];
        $this->method = $_SERVER['REQUEST_METHOD'];
        $this->params = $_GET;
        $this->attributes = $_POST;
    }

    public function getParam($name)
    {
        return $this->params[$name];
    }

    public function getUri()
    {
        return $this->path;
    }

    public function jsonSerialize(): array
    {
        return get_object_vars($this);
    }
}