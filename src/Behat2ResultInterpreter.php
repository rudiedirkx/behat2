<?php

namespace rdx\behat2;

use Behat\Testwork\Tester\Result\Interpretation\ResultInterpretation;
use Behat\Testwork\Tester\Result\TestResult;

class Behat2ResultInterpreter implements ResultInterpretation {

	public function isFailure(TestResult $result) {
		// print_r($result);
	}

}
