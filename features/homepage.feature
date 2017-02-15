@homepage
Feature: Homepage default behavior
  
  @javascript
  Scenario: The Page content display with selenium
    When I am on the homepage
    Then I should see "Hello World Continuous"
