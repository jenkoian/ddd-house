Feature: Entering the house

Scenario: Entering the house
  Given I am outside of the house
  When I enter through the front door
  Then I should be in the hallway

Scenario: Leaving the house
  Given I am in the hallway
  When I leave through the front door
  Then I should be outside