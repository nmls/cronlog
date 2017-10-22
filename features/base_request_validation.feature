@e2e
Feature: HTTP Endpoint for submitting UUID

  Scenario: Valid request responds with 'ok'
    Given I am on "/" and I have the following GET parameter "uuid" with "1234578910"
    Then I should get success response

  Scenario: Invalid request responds with 'fail'
    Given I am on "/" and I do not have any GET parameters
    Then I should get failure response
