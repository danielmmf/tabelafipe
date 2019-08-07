Feature: fipe
  In order to find car address
  As a user
  I need to send a car brand and model

Scenario: Buscando Endereço pelo Nome
  Given i have a brand car with value "toyota" 
  And i have a model car with value "etios hatch x man"
  When i go to find table fipe
  Then i get url