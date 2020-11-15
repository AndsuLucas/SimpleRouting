<?php
namespace Routing\Examples\Controller;

use Routing\Examples\ControllerDependences\Calculator;
use Routing\Http\Requests\Request;

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