<?php

namespace rdx\behat2;

class Number {

	protected $value = 0;

	public function __construct($number) {
		$this->value = (float) $number;
	}

}
