<?php

use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Behat\Tester\Exception\PendingException;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use rdx\behat2\Number;

class FeatureContext implements Context, SnippetAcceptingContext {

	protected $number;
	protected $amount = 0;

	/**
	 * Initializes context.
	 */
	public function __construct() {
		$this->number = new Number($this->amount);
	}



	/**
	 * @Given we start with :amount
	 */
	public function weStartWith($amount) {
		$this->amount = (float) $amount;
	}



	/**
	 * @When we add :amount
	 */
	public function weAdd($amount) {
		$this->amount += (float) $amount;
	}

	/**
	 * @When we subtract :amount
	 */
	public function weSubtract($amount) {
		$this->amount -= (float) $amount;
	}

	/**
	 * @When we multiply by :amount
	 */
	public function weMultiplyBy($amount) {
		$this->amount *= (float) $amount;
	}

	/**
	 * @When we divide by :amount
	 */
	public function weDivideBy($amount) {
		$this->amount /= (float) $amount;
	}

	/**
	 * @When we :exponent power it
	 */
	public function wePowerIt($exponent) {
		$this->amount = pow($this->amount, (float) $exponent);
	}

	/**
	 * @When we :exponent root it
	 */
	public function weRootIt($exponent) {
		$this->amount = pow($this->amount, 1 / (float) $exponent);
	}



	/**
	 * @Then we have :amount
	 *
	 * The amount to check against can be a fraction, e.g. "1/3"
	 */
	public function weHave($amount) {
		$check = (float) $amount;
		if (preg_match('#^(\d+)/(\d+)$#', $amount, $match)) {
			$check = (float) $match[1] / (float) $match[2];
		}

		$this->assertAmount($check, $amount);
	}



	/**
	 * Assert result amount.
	 */
	protected function assertAmount($amount, $amountLabel = null) {
		$precision = (ini_get('precision') ?: 14) / 2;

		if (round((float) $amount, $precision) != round($this->amount, $precision)) {
			$amountLabel or $amountLabel = $amount;
			throw new \Exception("Result amount should be $amountLabel, but it is {$this->amount}");
		}
	}

}
