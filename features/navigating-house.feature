@home-owner @potential-buyer
Feature: Home owner navigating the house

  Scenario: Entering the house
    Given I am in the "front garden"
    When I enter through the front door
    Then I should be in the "hallway"

  Scenario: Getting room info
    Given there are the following locations in the house
      | name          | type   | width | height |
      | front garden  | garden | 300   | 300    |
      | hallway       | room   | 300   | 300    |
      | living room   | room   | 300   | 300    |
      | kitchen       | room   | 300   | 300    |
    And I am in the "hallway"
    When I request room info
    Then I should have dimensions "300 x 300"
    And I should have exits

  Scenario: Leaving the house
    Given I am in the "hallway"
    When I leave through the front door
    Then I should be in the "front garden"

  Scenario: Enter a room that does exist
    Given there are the following locations in the house
      | name          | type   | width | height |
      | front garden  | garden | 300   | 300    |
      | hallway       | room   | 300   | 300    |
      | living room   | room   | 300   | 300    |
      | kitchen       | room   | 300   | 300    |
    And I am in the "hallway"
    Then I should be able to enter the "living room" room

  Scenario: Entering a room that doesn't exist
    Given I am in the "hallway"
    Then I should not be able to enter the "made up" room

  Scenario: Entering a new room holds information of your previous location
    Given there are the following locations in the house
      | name          | type   | width | height |
      | front garden  | garden | 300   | 300    |
      | hallway       | room   | 300   | 300    |
      | living room   | room   | 300   | 300    |
      | kitchen       | room   | 300   | 300    |
    And I am in the "hallway"
    When I enter the "living room" room
    Then I should know that I came from the "hallway"