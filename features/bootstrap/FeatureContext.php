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
	protected $storage = [];

	static protected $database = [];

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
		return $this->amount = $this->getAmount($amount);
	}

	/**
	 * @Given we create user :user in organization :organization
	 */
	public function weCreateUserInOrganization($user, $organization) {
		self::$database['users'][$userId = rand()] = $user;
		self::$database['organizations'][$orgId = rand()] = $organization;

		return [$userId, $orgId];
	}



	/**
	 * @When we add :amount
	 */
	public function weAdd($amount) {
		return $this->amount += $this->getAmount($amount);
	}

	/**
	 * @When we subtract :amount
	 */
	public function weSubtract($amount) {
		return $this->amount -= $this->getAmount($amount);
	}

	/**
	 * @When we multiply by :amount
	 */
	public function weMultiplyBy($amount) {
		return $this->amount *= $this->getAmount($amount);
	}

	/**
	 * @When we divide by :amount
	 */
	public function weDivideBy($amount) {
		return $this->amount /= $this->getAmount($amount);
	}

	/**
	 * @When we :exponent power it
	 */
	public function wePowerIt($exponent) {
		return $this->amount = pow($this->amount, (float) $exponent);
	}

	/**
	 * @When we :exponent root it
	 */
	public function weRootIt($exponent) {
		return $this->amount = pow($this->amount, 1 / (float) $exponent);
	}

	/**
	 * @When we save that in :slot
	 */
	public function weSaveThatIn($slot) {
		$this->storage[$slot] = $this->amount;
	}

	/**
	 * @When we show storage
	 */
	public function weShowStorage() {
		if (empty($this->storage)) {
			echo "<empty>";
			return;
		}

		$rows = [];
		foreach ($this->storage as $slot => $amount) {
			$rows[] = [$slot, $amount];
		}

		$table = new TableNode($rows);
		echo $table;
	}

	/**
	 * @When we clear :slot
	 */
	public function weClear($slot) {
		unset($this->storage[$slot]);
	}



	/**
	 * @Then we have :amount
	 *
	 * The amount to check against can be a fraction, e.g. "1/3"
	 */
	public function weHave($amount) {
		$this->assertAmount($this->getAmount($amount), $amount);
	}

	/**
	 * @Then user :userId should be :user
	 */
	public function userShouldBe($userId, $user) {
		$this->assertDatabaseItem('users', $userId, $user);
	}

	/**
	 * @Then organization :orgId should be :organization
	 */
	public function organizationShouldBe($orgId, $organization) {
		$this->assertDatabaseItem('organizations', $orgId, $organization);
	}



	/**
	 *
	 */
	protected function assertDatabaseItem($table, $id, $value) {
		if (@self::$database[$table][$id] !== $value) {
			throw new \Exception("Record '$table [$id]' does match the given value.");
		}
	}

	/**
	 *
	 */
	protected function getAmount($amount) {
		// Float: 4 or 2.5
		if (preg_match('#^\-?\d+(\.\d+)?$#', $amount)) {
			return (float) $amount;
		}

		// Fraction: 1/3
		if (preg_match('#^(\d+)/(\d+)$#', $amount, $match)) {
			return (float) $match[1] / (float) $match[2];
		}

		// Storage: A
		if (preg_match('#^[A-Z]$#', $amount)) {
			if (!isset($this->storage[$amount])) {
				throw new \Exception("Storage for '$amount' is empty");
			}

			return (float) $this->storage[$amount];
		}

		throw new \Exception("Invalid format for amount: '$amount'");
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
