<?php declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Routing\Http\Requests\Request;

final class RequestTest extends TestCase
{
    public function testGetParamWithExistentParam()
    {   
        $_GET['name'] = 'Anderson';
        $request = new Request();
        $this->assertEquals($request->getParam('name'), $_GET['name']);
    }

    public function testGetParamWithInexistentParam()
    {
        $_GET['name'] = '';
        $request = new Request();
        $this->assertEmpty($request->getParam('name'));
    }

    public function testGetAttributeWithExistentAttribute()
    {
        $_POST['name'] = 'Anderson';
        $request = new Request();
        $this->assertEquals($request->getAttribute('name'), $_POST['name']);
    }

    public function testGetAttributeWithInexistentAttribute()
    {
        $_POST['name'] = '';
        $request = new Request();
        $this->assertEmpty($request->getAttribute('name'));
    }

    public function testGetUriReturnParsedUri()
    {
        $_SERVER['REQUEST_URI'] = 'www.mypath?test=1#principal';
        $request = new Request();
        $this->assertEquals($request->getUri(), 'www.mypath');
    }

    public function testGetMethod()
    {
        $_SERVER['REQUEST_METHOD'] = 'POST';
        $request = new Request();
        $this->assertEquals($request->getMethod(), $_SERVER['REQUEST_METHOD']);
    }

    public function testRequestAsJson()
    {
        $_GET = [
            'page' => 'test'
        ];

        $_POST = [
            'email' => 'a@a.com',
            'name' => 'Anderson'
        ];

        $request = new Request();
        $this->assertEquals($request->json(), '{"attributes":{"email":"a@a.com","name":"Anderson"},"params":{"page":"test"}}');
    }
}