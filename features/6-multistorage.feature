Feature: Multi storage
	Remember/save several variables at once

	Scenario: Create 2 things
		Given we create user "Fred" in organization "Freddy's"
		And behat saves it into "UID,ORG"
		Then user "<<UID>>" should be "Fred"
		And organization "<<ORG>>" should be "Freddy's"
