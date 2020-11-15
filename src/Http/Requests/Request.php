<?php 
namespace Routing\Http\Requests;
use  Routing\Http\Requests\RequestInterface;

/**
*TODO: CREATE FACTORY/SERVICE FOR REQUESTS
* And insert dependences injection on constructor
*/
final class Request extends RequestInterface
implements \JsonSerializable
{   
    private $rawUrl;
    private $path;
    private $method;
    private $params;
    private $attributes;

    public function __construct()
    {   
        $this->rawUrl = $_SERVER['REQUEST_URI'] ?? '';
        $this->path = explode('?', $this->rawUrl)[0] ?? '';
        $this->method = $_SERVER['REQUEST_METHOD'] ?? '';
        $this->params = $_GET;
        $this->attributes = $_POST;
    }

    public function getParam(string $name)
    {
        return $this->params[$name];
    }

    public function getAttribute($name)
    {
        return $this->attributes[$name];
    }

    public function getUri(): string
    {
        return $this->path;
    }

    public function getMethod(): string
    {
        return $this->method;
    }
    
    public function hasAttribute(string $value)
    {
        return array_key_exists($value, $this->attributes);
    }

    public function hasParam(string $value)
    {
        return array_key_exists($value, $this->params);
    }

    public function json()
    {
        return json_encode($this);
    }

    public function jsonSerialize(): array
    {
        return [
            'attributes' => $this->attributes,
            'params' => $this->params
        ];
    }
}