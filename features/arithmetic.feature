Feature: Arithmetic
	Do some simple calculations

	Scenario: Addition
		Given we start with "0"
		When we add "5"
		And we add "3"
		Then we have "8"

	Scenario: Subtraction
		Given we start with "10"
		When we subtract "3"
		And we subtract "4"
		Then we have "3"

	Scenario: Multiplication
		Given we start with "2"
		When we multiply by "3"
		And we multiply by "4"
		Then we have "24"

	Scenario: Divisions
		Given we start with "24"
		When we divide by "2"
		And we divide by "6"
		Then we have "2"

	Scenario: Mix all operators into a float
		Given we start with "0"
		When we add "3"
		And we multiply by "4"
		And we subtract "2"
		And we divide by "4"
		Then we have "2.5"

	Scenario: Sober maths
		Given we start with "5"
		When we add "5"
		And we subtract "25"
		Then we have "-15"
