Feature: Feature storage
	Remember specific results across scenarios

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

	Scenario Outline: Storage from table
		Given we start with "0"
		When we add <Age>
		And behat saves it into "D"
		And we subtract "1<<D>>"
		Then we have "-100"

		Examples:
			| Name | Age |
			| Fred | 37  |
			| Phil | 19  |
			| Jenn | 23  |
