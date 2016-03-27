Feature: Temporary variables
	Store numbers per-scenario to make more complex calculations

	Scenario: Save
		Given we start with "0"
		When we add "7"
		And we save that in "A"
		Then we have "A"

	Scenario: Save and load
		Given we start with "10"
		When we save that in "A"
		And we start with "0"
		And we add "A"
		And we add "A"
		And we clear "A"
		And we show storage
		Then we have "20"

	Scenario: Possible double precedence: (2 + 3) * (4 + 5)
		Given we start with "2"
		When we add "3"
		And we save that in "A"
		And we show storage
		And we start with "4"
		And we add "5"
		And we save that in "B"
		And we show storage
		And we start with "A"
		And we multiply by "B"
		And we save that in "C"
		And we show storage
		Then we have "45"

	Scenario: Storage cleanup
		Given we start with "2"
		And we save that in "X"
		When we show storage
