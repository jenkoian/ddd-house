Feature: Entering the house

Scenario: Entering the house
  Given I am outside of the house
  When I enter through the front door
  Then I should be in the hallway

Scenario: Getting room info
  Given I am in the hallway
  When I request room info
  Then I should have room size and adjacent rooms

Scenario: Leaving the house
  Given I am in the hallway
  When I leave through the front door
  Then I should be outside

Scenario: Entering a room that doesn't exist
  Given I am in the hallway
  Then I should not be able to enter the "made up" room

Scenario: Enter a room that does exist
  Given there are the following locations in the house
    | name          | type   |
    | front garden  | garden |
    | hallway       | room   |
    | living room   | room   |
    | kitchen       | room   |
  And I am in the hallway
  Then I should be able to enter the "living room" room