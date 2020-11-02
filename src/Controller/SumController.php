<?php
namespace Routing\Controller;

use Routing\ControllerDependences\Calculator;
use Routing\Http\Request;

final class SumController
{
	protected $calculator;

	public function __construct(Calculator $calculator)
	{
		$this->calculator = $calculator;
	}

	public function getSum(Request $request)
	{	
		$a = $request->getParam('a');
		$b = $request->getParam('b');
		echo $this->calculator->sum($a, $b);
	}
}