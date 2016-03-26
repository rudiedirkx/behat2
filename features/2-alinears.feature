Feature: A-linears
	Do some highschool maths

	Scenario: Positive power
		Given we start with "2"
		When we "8" power it
		Then we have "256"

	Scenario: Negative power
		Given we start with "5"
		When we "-1" power it
		Then we have "0.2"

	Scenario: More negative power
		Given we start with "2"
		When we "-2" power it
		Then we have "0.25"

	Scenario: Negative base
		Given we start with "-2"
		When we "3" power it
		Then we have "-8"

	Scenario: Positive root
		Given we start with "9"
		When we "2" root it
		Then we have "3"

	Scenario: Small root
		Given we start with "5"
		When we "0.5" root it
		Then we have "25"

	Scenario: Negative root
		Given we start with "5"
		When we "-1" root it
		Then we have "0.2"

	Scenario: More negative root
		Given we start with "9"
		When we "-2" root it
		Then we have "1/3"
