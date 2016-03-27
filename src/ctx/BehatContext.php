<?php

namespace rdx\behat2\ctx;

use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Behat\Hook\Scope\AfterFeatureScope;
use Behat\Behat\Hook\Scope\AfterStepScope;
use rdx\behat2\ext\BehatTransformer;

class BehatContext implements Context, SnippetAcceptingContext {

	protected $lastResult = null;

	static protected $storage = array();

	/**
	 * Initializes context.
	 */
	public function __construct() {

	}



	/**
	 * @AfterStep
	 */
	public function afterStep(AfterStepScope $scope) {
		$result = $scope->getTestResult()->getCallResult();
		$return = $result->getReturn();
		if ($return) {
			$this->lastResult = $return;
		}
	}

	/**
	 * @AfterFeature
	 */
	static public function afterFeature(AfterFeatureScope $scope) {
		self::storageClear();
	}



	/**
	 * @When behat saves it into :slot
	 */
	public function behatSavesItInto($slot) {
		if ($this->lastResult === null) {
			throw new \Exception("Can't store empty return value. First 'save it'.");
		}

		if (!BehatTransformer::validSlotName($slot)) {
			throw new \Exception("Invalid slot name: '$slot'");
		}

		$this->storageSet($slot, $this->lastResult);
		$this->lastResult = null;
	}



	/**
	 *
	 */
	protected function storageSet($name, $value) {
		self::$storage[$name] = $value;
	}

	/**
	 *
	 */
	public function storageGet($name) {
		if (!isset(self::$storage[$name])) {
			throw new \Exception("Value for $name does not exist.");
		}

		return self::$storage[$name];
	}

	/**
	 *
	 */
	static protected function storageClear() {
		self::$storage = array();
	}

}
