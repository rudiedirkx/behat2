Feature: Feature variables
	Remember specific results across Scenarios

	Scenario: Set a variable
		Given we start with "100"
		And behat saves it into "A"
		When we start with "20"
		And behat saves it into "B"

	Scenario: Get a variable 1
		Given we start with "15"
		When we add "15"
		And we add "<<A>>0"
		Then we have "1030"

	Scenario: Get a variable 2
		Given we start with "<<A>>"
		When we subtract "80"
		And behat saves it into "C"
		And we start with "<<C>><<B>>"
		Then we have "2020"