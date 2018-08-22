Feature: Blog

  Scenario: User cannot GET a different User's personal data
    Given 2014
    When I send a "GET" request to "/article/articles"
