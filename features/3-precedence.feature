Feature: Precedence and order
	Operator precedence and argument order

	Scenario: Unnatural precedence: 2 + 3 * 4
		Given we start with "2"
		When we add "3"
		And we multiply by "4"
		Then we have "20"

	Scenario: Natural precedence (by argument order): 3 * 4 + 2
		Given we start with "3"
		When we multiply by "4"
		And we add "2"
		Then we have "14"

	Scenario: Unnatural double precedence: 2 + 3 + 4 * 5
		Given we start with "2"
		When we add "3"
		And we add "4"
		And we multiply by "5"
		Then we have "45"

	Scenario: Natural double precedence (by argument order): 4 * 5 + 2 + 3
		Given we start with "4"
		When we multiply by "5"
		And we add "2"
		And we add "3"
		Then we have "25"

	Scenario: Impossible double precedence (with any argument order): (2 + 3) * (4 + 5)
		Given we start with "2"
		When we add "3"
		And we multiply by "4"
		And we add "5"
		Then we have "25"
