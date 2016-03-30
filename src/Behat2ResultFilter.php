<?php

namespace rdx\behat2;

use Behat\Testwork\Call\CallResult;
use Behat\Testwork\Call\Filter\ResultFilter;

class Behat2ResultFilter implements ResultFilter {

	public function supportsResult(CallResult $result) {
		// print_r($result);
	}

	public function filterResult(CallResult $result) {

	}

}
