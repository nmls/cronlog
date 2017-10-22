Feature: for successful request data should be stored

  Scenario Outline: valid request should be stored and response should be success
    Given request with uuid <uuid>
    Then response should be success

    Examples:
      | uuid           |
      | "123"          |
      | "345"          |
      | "456"          |
      | "vcxhjkfda789" |

  Scenario Outline: invalid request should not be stored and response should be failure
    Given request with uuid <uuid>
    Then response should be failure

    Examples:
      | uuid   |
      | "12-3" |
      | ""     |
      | "$"    |