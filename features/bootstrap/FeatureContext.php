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
	 * @Then we have :amount
	 */
	public function weHave($amount) {
		$this->assertAmount($amount);
	}



	/**
	 *
	 */
	protected function assertAmount($amount) {
		if ((float) $amount != $this->amount) {
			throw new \Exception("Result amount should be $amount, but it is {$this->amount}");
		}
	}

}
