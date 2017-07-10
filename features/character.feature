Feature: Create Character
    In order to create a character
    Vist your localhost:8000
    And click Create New Character

    Scenario: Create New Character
        Given I am in localhost:8000
        When i click create new character
        Then i should fill the name with "BDD"
        Then i should pick the hero type "1"
