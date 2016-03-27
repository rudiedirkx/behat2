<?php

namespace rdx\behat2\ctx;

use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Behat\Hook\Scope\AfterFeatureScope;
use Behat\Behat\Hook\Scope\AfterStepScope;
use rdx\behat2\ext\Behat2StorageArgumentTransformer;

class Behat2StorageContext implements Context, SnippetAcceptingContext {

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
		$this->lastResult = null;

		$result = $scope->getTestResult();
		if (is_callable(array($result, 'getCallResult'))) {
			$result = $result->getCallResult();
			if (is_callable(array($result, 'getReturn'))) {
				$this->lastResult = $result->getReturn();
			}
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
			throw new \Exception("Can't store empty return value. Have a step method return a value.");
		}

		if (!Behat2StorageArgumentTransformer::validSlotName($slot)) {
			throw new \Exception("Invalid slot name: '$slot'");
		}

		$this->storageSet($slot, $this->lastResult);
		$this->lastResult = null;
	}



	/**
	 *
	 */
	protected function storageSet($name, $value) {
		if (!is_scalar($value)) {
			$type = gettype($value);
			throw new \Exception("Storing value must be scalar, but it's a '$type'.");
		}

		self::$storage[$name] = $value;
	}

	/**
	 *
	 */
	public function storageGet($name) {
		if (!isset(self::$storage[$name])) {
			throw new \Exception("Value for '$name' does not exist.");
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
