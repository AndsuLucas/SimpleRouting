<?php 
namespace Routing\Router;

interface RouterInterface
{
	public function add(string $path, $action);
	public function listen(\Routing\Http\Request $request);
}